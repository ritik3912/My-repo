/**
 * Real photo & video uploads for the Trek "Photo Journal" and "Trek Videos"
 * meta boxes, using the WordPress Media Library (wp.media) instead of the
 * old placeholder-count textarea. Each widget keeps its state as a small
 * JS array and mirrors it into a hidden textarea as JSON on every change,
 * so the normal WordPress save (inc/meta-boxes.php) just reads plain POST
 * fields — no AJAX required.
 */
( function () {
	'use strict';

	if ( 'undefined' === typeof wp || ! wp.media ) {
		return;
	}

	function readJSON( el ) {
		try {
			var data = JSON.parse( el.value || '[]' );
			return Array.isArray( data ) ? data : [];
		} catch ( e ) {
			return [];
		}
	}

	/* ---------- Photo galleries (grouped, multi-image) ---------- */
	function initPhotoGallery( wrap ) {
		var hidden = wrap.querySelector( '.tn-media-json' );
		var groupsEl = wrap.querySelector( '.tn-photo-groups' );
		var addGroupBtn = wrap.querySelector( '.tn-add-group' );
		var groups = readJSON( hidden );

		function save() {
			hidden.value = JSON.stringify( groups );
		}

		function attachmentThumb( id ) {
			var box = document.createElement( 'div' );
			box.className = 'tn-thumb';
			var img = document.createElement( 'img' );
			img.alt = '';
			box.appendChild( img );

			var attachment = wp.media.attachment( id );
			attachment.fetch().done( function () {
				var json = attachment.toJSON();
				var sized = json.sizes && ( json.sizes.thumbnail || json.sizes.medium );
				img.src = sized ? sized.url : json.url;
			} );

			return box;
		}

		function render() {
			groupsEl.innerHTML = '';
			groups.forEach( function ( group, groupIndex ) {
				group.ids = group.ids || [];

				var card = document.createElement( 'div' );
				card.className = 'tn-photo-group';

				var head = document.createElement( 'div' );
				head.className = 'tn-group-head';

				var label = document.createElement( 'input' );
				label.type = 'text';
				label.value = group.label || '';
				label.placeholder = 'Group label, e.g. Day 1 or Summit Day';
				label.addEventListener( 'input', function () {
					group.label = label.value;
					save();
				} );
				head.appendChild( label );

				var removeGroup = document.createElement( 'button' );
				removeGroup.type = 'button';
				removeGroup.className = 'button-link tn-remove-group';
				removeGroup.textContent = 'Remove group';
				removeGroup.addEventListener( 'click', function () {
					groups.splice( groupIndex, 1 );
					save();
					render();
				} );
				head.appendChild( removeGroup );

				card.appendChild( head );

				var thumbs = document.createElement( 'div' );
				thumbs.className = 'tn-thumbs';
				group.ids.forEach( function ( id, photoIndex ) {
					var thumb = attachmentThumb( id );
					var remove = document.createElement( 'button' );
					remove.type = 'button';
					remove.className = 'tn-thumb-remove';
					remove.setAttribute( 'aria-label', 'Remove photo' );
					remove.textContent = '✕';
					remove.addEventListener( 'click', function () {
						group.ids.splice( photoIndex, 1 );
						save();
						render();
					} );
					thumb.appendChild( remove );
					thumbs.appendChild( thumb );
				} );
				card.appendChild( thumbs );

				var addPhotos = document.createElement( 'button' );
				addPhotos.type = 'button';
				addPhotos.className = 'button tn-add-photos';
				addPhotos.textContent = 'Add Photos';
				addPhotos.addEventListener( 'click', function () {
					var frame = wp.media( {
						title: 'Select photos for this group',
						button: { text: 'Add to group' },
						multiple: true,
						library: { type: 'image' },
					} );
					frame.on( 'select', function () {
						frame.state().get( 'selection' ).each( function ( attachment ) {
							group.ids.push( attachment.get( 'id' ) );
						} );
						save();
						render();
					} );
					frame.open();
				} );
				card.appendChild( addPhotos );

				groupsEl.appendChild( card );
			} );
		}

		addGroupBtn.addEventListener( 'click', function () {
			groups.push( { label: '', ids: [] } );
			save();
			render();
		} );

		render();
		save();
	}

	/* ---------- Videos (uploaded file or YouTube/Vimeo URL) ---------- */
	function initVideoList( wrap ) {
		var hidden = wrap.querySelector( '.tn-media-json' );
		var listEl = wrap.querySelector( '.tn-video-list' );
		var addBtn = wrap.querySelector( '.tn-add-video' );
		var items = readJSON( hidden );

		function save() {
			hidden.value = JSON.stringify( items );
		}

		function render() {
			listEl.innerHTML = '';
			items.forEach( function ( item, index ) {
				item.type = item.type || 'embed';

				var row = document.createElement( 'div' );
				row.className = 'tn-video-row';

				var label = document.createElement( 'input' );
				label.type = 'text';
				label.value = item.label || '';
				label.placeholder = 'Label, e.g. Summit sunrise timelapse';
				label.addEventListener( 'input', function () {
					item.label = label.value;
					save();
				} );
				row.appendChild( label );

				var typeSelect = document.createElement( 'select' );
				[ [ 'embed', 'YouTube / Vimeo URL' ], [ 'upload', 'Uploaded video file' ] ].forEach( function ( opt ) {
					var option = document.createElement( 'option' );
					option.value = opt[ 0 ];
					option.textContent = opt[ 1 ];
					if ( item.type === opt[ 0 ] ) {
						option.selected = true;
					}
					typeSelect.appendChild( option );
				} );
				typeSelect.addEventListener( 'change', function () {
					item.type = typeSelect.value;
					item.value = '';
					save();
					render();
				} );
				row.appendChild( typeSelect );

				if ( 'upload' === item.type ) {
					var pickBtn = document.createElement( 'button' );
					pickBtn.type = 'button';
					pickBtn.className = 'button';
					pickBtn.textContent = item.value ? 'Replace video' : 'Choose video file';
					pickBtn.addEventListener( 'click', function () {
						var frame = wp.media( {
							title: 'Select a video',
							button: { text: 'Use this video' },
							multiple: false,
							library: { type: 'video' },
						} );
						frame.on( 'select', function () {
							var attachment = frame.state().get( 'selection' ).first();
							item.value = attachment.get( 'id' );
							save();
							render();
						} );
						frame.open();
					} );
					row.appendChild( pickBtn );
					if ( item.value ) {
						var chosen = document.createElement( 'span' );
						chosen.className = 'tn-video-chosen';
						chosen.textContent = 'Video file selected (ID ' + item.value + ')';
						row.appendChild( chosen );
					}
				} else {
					var urlInput = document.createElement( 'input' );
					urlInput.type = 'url';
					urlInput.value = item.value || '';
					urlInput.placeholder = 'https://www.youtube.com/watch?v=...';
					urlInput.addEventListener( 'input', function () {
						item.value = urlInput.value;
						save();
					} );
					row.appendChild( urlInput );
				}

				var remove = document.createElement( 'button' );
				remove.type = 'button';
				remove.className = 'button-link tn-remove-video';
				remove.textContent = 'Remove';
				remove.addEventListener( 'click', function () {
					items.splice( index, 1 );
					save();
					render();
				} );
				row.appendChild( remove );

				listEl.appendChild( row );
			} );
		}

		addBtn.addEventListener( 'click', function () {
			items.push( { label: '', type: 'embed', value: '' } );
			save();
			render();
		} );

		render();
		save();
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		document.querySelectorAll( '.tn-photo-gallery-field' ).forEach( initPhotoGallery );
		document.querySelectorAll( '.tn-video-field' ).forEach( initVideoList );
	} );
} )();
