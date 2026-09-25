/**
 * Azure Isle: header state, overlay menu, scroll reveal, review slider,
 * scroll-snap carousels and the video pop-up.
 */
(function () {
	'use strict';

	/* ---------- Header: transparent over hero, solid after scroll ---------- */
	var header = document.getElementById( 'az-header' );
	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 60 );
		};
		onScroll();
		window.addEventListener( 'scroll', onScroll, { passive: true } );
	}

	/* ---------- Overlay menu ---------- */
	var toggle = document.getElementById( 'az-menu-toggle' );
	var menu = document.getElementById( 'az-menu' );
	var close = document.getElementById( 'az-menu-close' );

	function setMenu( open ) {
		menu.classList.toggle( 'is-open', open );
		menu.setAttribute( 'aria-hidden', open ? 'false' : 'true' );
		toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		document.body.style.overflow = open ? 'hidden' : '';
		( open ? close : toggle ).focus();
	}

	if ( toggle && menu && close ) {
		toggle.addEventListener( 'click', function () {
			setMenu( true );
		} );
		close.addEventListener( 'click', function () {
			setMenu( false );
		} );
		menu.querySelectorAll( 'a' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				setMenu( false );
			} );
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key && menu.classList.contains( 'is-open' ) ) {
				setMenu( false );
			}
		} );
	}

	/* ---------- Scroll reveal ---------- */
	var revealEls = document.querySelectorAll( '.reveal' );
	if ( 'IntersectionObserver' in window ) {
		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
						observer.unobserve( entry.target );
					}
				} );
			},
			{ threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
		);
		revealEls.forEach( function ( el ) {
			observer.observe( el );
		} );
	} else {
		revealEls.forEach( function ( el ) {
			el.classList.add( 'is-visible' );
		} );
	}

	/* ---------- Review slider ---------- */
	var slider = document.querySelector( '[data-az-slider]' );
	if ( slider ) {
		var slides = slider.querySelectorAll( '.az-slide' );
		var dots = slider.querySelectorAll( '[data-az-dot]' );
		var current = 0;
		var timer;

		var show = function ( index ) {
			current = ( index + slides.length ) % slides.length;
			slides.forEach( function ( slide, i ) {
				slide.classList.toggle( 'is-active', i === current );
				slide.setAttribute( 'aria-hidden', i === current ? 'false' : 'true' );
			} );
			dots.forEach( function ( dot, i ) {
				dot.classList.toggle( 'is-active', i === current );
			} );
		};

		var start = function () {
			clearInterval( timer );
			timer = setInterval( function () {
				show( current + 1 );
			}, 6000 );
		};

		dots.forEach( function ( dot ) {
			dot.addEventListener( 'click', function () {
				show( parseInt( dot.getAttribute( 'data-az-dot' ), 10 ) );
				start();
			} );
		} );

		if ( slides.length > 1 && ! window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
			start();
		}
	}

	/* ---------- Carousels (image strip, room slider) ---------- */
	document.querySelectorAll( '[data-az-carousel]' ).forEach( function ( carousel ) {
		var track = carousel.querySelector( '[data-az-track]' );
		var prev = carousel.querySelector( '[data-az-prev]' );
		var next = carousel.querySelector( '[data-az-next]' );
		var dotWrap = carousel.querySelector( '[data-az-dot-wrap]' );
		if ( ! track ) {
			return;
		}

		var step = function () {
			var slide = track.firstElementChild;
			if ( ! slide ) {
				return track.clientWidth;
			}
			var gap = parseFloat( getComputedStyle( track ).columnGap ) || 0;
			return slide.getBoundingClientRect().width + gap;
		};

		var pageCount = function () {
			return Math.max( 1, Math.round( ( track.scrollWidth - track.clientWidth ) / track.clientWidth ) + 1 );
		};

		var go = function ( dir ) {
			var max = track.scrollWidth - track.clientWidth - 2;
			if ( dir > 0 && track.scrollLeft >= max ) {
				track.scrollTo( { left: 0, behavior: 'smooth' } );
			} else if ( dir < 0 && track.scrollLeft <= 2 ) {
				track.scrollTo( { left: track.scrollWidth, behavior: 'smooth' } );
			} else {
				track.scrollBy( { left: dir * step(), behavior: 'smooth' } );
			}
		};

		if ( prev ) {
			prev.addEventListener( 'click', function () {
				go( -1 );
			} );
		}
		if ( next ) {
			next.addEventListener( 'click', function () {
				go( 1 );
			} );
		}

		if ( ! dotWrap ) {
			return;
		}
		var buildDots = function () {
			var count = pageCount();
			dotWrap.innerHTML = '';
			dotWrap.hidden = count < 2;
			for ( var i = 0; i < count; i++ ) {
				var dot = document.createElement( 'button' );
				dot.type = 'button';
				dot.className = 'az-dot';
				dot.setAttribute( 'aria-label', 'Page ' + ( i + 1 ) );
				dot.addEventListener( 'click', ( function ( page ) {
					return function () {
						track.scrollTo( { left: page * track.clientWidth, behavior: 'smooth' } );
					};
				} )( i ) );
				dotWrap.appendChild( dot );
			}
			syncDots();
		};
		var syncDots = function () {
			var dots = dotWrap.children;
			var max = track.scrollWidth - track.clientWidth;
			var page = max > 0 ? Math.round( ( track.scrollLeft / max ) * ( dots.length - 1 ) ) : 0;
			for ( var i = 0; i < dots.length; i++ ) {
				dots[ i ].classList.toggle( 'is-active', i === page );
			}
		};
		track.addEventListener( 'scroll', syncDots, { passive: true } );
		window.addEventListener( 'resize', buildDots );
		buildDots();
	} );

	/* ---------- Video pop-up ---------- */
	var play = document.querySelector( '[data-az-video]' );
	var embed = document.getElementById( 'az-video-embed' );
	if ( play && embed ) {
		var modal = document.createElement( 'div' );
		modal.className = 'az-modal';
		modal.setAttribute( 'role', 'dialog' );
		modal.setAttribute( 'aria-modal', 'true' );
		modal.innerHTML = '<button type="button" class="az-menu-close" aria-label="Close">&times;</button><div class="az-modal-frame"></div>';
		document.body.appendChild( modal );
		var frame = modal.querySelector( '.az-modal-frame' );
		var closeBtn = modal.querySelector( 'button' );

		var closeModal = function () {
			modal.classList.remove( 'is-open' );
			frame.innerHTML = '';
			document.body.style.overflow = '';
			play.focus();
		};

		play.addEventListener( 'click', function () {
			frame.innerHTML = embed.innerHTML;
			var iframe = frame.querySelector( 'iframe' );
			if ( iframe && iframe.src ) {
				iframe.src += ( iframe.src.indexOf( '?' ) > -1 ? '&' : '?' ) + 'autoplay=1';
				iframe.setAttribute( 'allow', 'autoplay; fullscreen; picture-in-picture' );
			}
			modal.classList.add( 'is-open' );
			document.body.style.overflow = 'hidden';
			closeBtn.focus();
		} );
		closeBtn.addEventListener( 'click', closeModal );
		modal.addEventListener( 'click', function ( e ) {
			if ( e.target === modal ) {
				closeModal();
			}
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key && modal.classList.contains( 'is-open' ) ) {
				closeModal();
			}
		} );
	}
})();
