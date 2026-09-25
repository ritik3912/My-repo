/**
 * Azure Isle: header state, overlay menu, scroll reveal, review slider,
 * and keeping check-out after check-in.
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

		if ( slides.length > 1 && ! window.matchMedia( '(prefeaz-reduced-motion: reduce)' ).matches ) {
			start();
		}
	}

	/* ---------- Booking bar: check-out must follow check-in ---------- */
	var checkin = document.querySelector( '.az-booking [name="checkin"]' );
	var checkout = document.querySelector( '.az-booking [name="checkout"]' );
	if ( checkin && checkout ) {
		checkin.addEventListener( 'change', function () {
			if ( ! checkin.value ) {
				return;
			}
			var next = new Date( checkin.value + 'T00:00:00Z' );
			next.setUTCDate( next.getUTCDate() + 1 );
			var min = next.toISOString().slice( 0, 10 );
			checkout.min = min;
			if ( ! checkout.value || checkout.value < min ) {
				checkout.value = min;
			}
		} );
	}
})();
