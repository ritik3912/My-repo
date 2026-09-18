/**
 * Turns the Trek meta boxes' pipe/line/packing-delimited textareas into
 * editable tables (add row / remove row) instead of asking the editor to
 * type "Place | What happens here" by hand. The textarea stays in the DOM
 * (hidden) and is kept in sync on every keystroke, so save handling in
 * inc/meta-boxes.php and the parsing helpers in inc/template-tags.php need
 * no changes at all — this is purely a friendlier way to fill them in.
 */
( function () {
	'use strict';

	function parseRows( format, raw, columnCount ) {
		var lines = ( raw || '' ).split( /\r\n|\r|\n/ ).map( function ( l ) { return l.trim(); } ).filter( function ( l ) { return l !== ''; } );

		if ( 'packing' === format ) {
			return lines.map( function ( line ) {
				var idx = line.indexOf( ':' );
				if ( -1 === idx ) {
					return [ line, '' ];
				}
				return [ line.slice( 0, idx ).trim(), line.slice( idx + 1 ).trim() ];
			} );
		}

		if ( 'lines' === format ) {
			return lines.map( function ( line ) {
				return [ line ];
			} );
		}

		return lines.map( function ( line ) {
			var cells = line.split( '|' ).map( function ( c ) { return c.trim(); } );
			while ( cells.length < columnCount ) {
				cells.push( '' );
			}
			return cells.slice( 0, columnCount );
		} );
	}

	function serializeRows( format, rows ) {
		var lines = rows
			.map( function ( row ) {
				if ( 'packing' === format ) {
					var category = ( row[ 0 ] || '' ).trim();
					var items = ( row[ 1 ] || '' ).trim();
					return category ? category + ': ' + items : '';
				}
				if ( 'lines' === format ) {
					return ( row[ 0 ] || '' ).trim();
				}
				return row.map( function ( c ) { return ( c || '' ).trim(); } ).join( ' | ' );
			} )
			.filter( function ( line ) {
				return line.replace( /\|/g, '' ).trim() !== '';
			} );
		return lines.join( '\n' );
	}

	function initRepeater( wrap ) {
		var field = wrap.getAttribute( 'data-repeater-field' );
		var format = wrap.getAttribute( 'data-repeater-format' ) || 'pipe';
		var columns = [];
		try {
			columns = JSON.parse( wrap.getAttribute( 'data-columns' ) || '[]' );
		} catch ( e ) {
			columns = [];
		}
		if ( 'lines' === format ) {
			columns = columns.slice( 0, 1 );
		}

		var textarea = wrap.querySelector( 'textarea.tn-repeater-raw' );
		var table = wrap.querySelector( 'table.tn-repeater-table' );
		var thead = table.querySelector( 'thead tr' );
		var tbody = table.querySelector( 'tbody' );
		var addBtn = wrap.querySelector( '.tn-repeater-add' );
		var toggleBtn = wrap.querySelector( '.tn-repeater-toggle-raw' );

		var rows = parseRows( format, textarea.value, columns.length || 1 );

		function sync() {
			textarea.value = serializeRows( format, rows );
		}

		function renderRow( row, rowIndex ) {
			var tr = document.createElement( 'tr' );
			columns.forEach( function ( colLabel, colIndex ) {
				var td = document.createElement( 'td' );
				var isLong = 'lines' === format || columns.length <= 2;
				var input = document.createElement( isLong ? 'textarea' : 'input' );
				if ( ! isLong ) {
					input.type = 'text';
				} else {
					input.rows = 2;
				}
				input.value = row[ colIndex ] || '';
				input.placeholder = colLabel;
				input.addEventListener( 'input', function () {
					row[ colIndex ] = input.value;
					sync();
				} );
				td.appendChild( input );
				tr.appendChild( td );
			} );

			var actionTd = document.createElement( 'td' );
			actionTd.className = 'tn-repeater-actions';
			var removeBtn = document.createElement( 'button' );
			removeBtn.type = 'button';
			removeBtn.className = 'button-link tn-repeater-remove';
			removeBtn.setAttribute( 'aria-label', 'Remove row' );
			removeBtn.textContent = '✕';
			removeBtn.addEventListener( 'click', function () {
				var at = rows.indexOf( row );
				if ( at > -1 ) {
					rows.splice( at, 1 );
				}
				sync();
				render();
			} );
			actionTd.appendChild( removeBtn );
			tr.appendChild( actionTd );

			return tr;
		}

		function render() {
			thead.innerHTML = '';
			columns.forEach( function ( colLabel ) {
				var th = document.createElement( 'th' );
				th.textContent = colLabel;
				thead.appendChild( th );
			} );
			thead.appendChild( document.createElement( 'th' ) );

			tbody.innerHTML = '';
			if ( 0 === rows.length ) {
				rows.push( columns.map( function () { return ''; } ) );
			}
			rows.forEach( function ( row, i ) {
				tbody.appendChild( renderRow( row, i ) );
			} );
		}

		addBtn.addEventListener( 'click', function () {
			rows.push( columns.map( function () { return ''; } ) );
			sync();
			render();
		} );

		if ( toggleBtn ) {
			toggleBtn.addEventListener( 'click', function () {
				var showingRaw = 'none' !== textarea.style.display;
				if ( showingRaw ) {
					// Switching back to the table: re-read whatever was typed by hand.
					rows = parseRows( format, textarea.value, columns.length || 1 );
					render();
					textarea.style.display = 'none';
					table.style.display = '';
					addBtn.style.display = '';
					toggleBtn.textContent = wrap.getAttribute( 'data-label-raw' );
				} else {
					sync();
					textarea.style.display = '';
					table.style.display = 'none';
					addBtn.style.display = 'none';
					toggleBtn.textContent = wrap.getAttribute( 'data-label-table' );
				}
			} );
		}

		render();
		sync();
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		document.querySelectorAll( '.tn-repeater[data-repeater-field]' ).forEach( initRepeater );
	} );
} )();
