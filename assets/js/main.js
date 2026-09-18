/**
 * Trail Notes — small, dependency-free behaviors:
 * sticky header shadow, mobile menu, scroll-reveal, Trek Finder filters.
 */
(function () {
	'use strict';

	/* ---------- Sticky header shadow ---------- */
	var header = document.getElementById( 'site-header' );
	if ( header ) {
		var onScroll = function () {
			if ( window.scrollY > 8 ) {
				header.classList.add( 'is-scrolled' );
			} else {
				header.classList.remove( 'is-scrolled' );
			}
		};
		onScroll();
		window.addEventListener( 'scroll', onScroll, { passive: true } );
	}

	/* ---------- Mobile menu ---------- */
	var navToggle = document.getElementById( 'nav-toggle' );
	var mobileNav = document.getElementById( 'mobile-nav' );
	var navClose = document.getElementById( 'mobile-nav-close' );

	function openMobileNav() {
		mobileNav.classList.add( 'is-open' );
		navToggle.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
	}

	function closeMobileNav() {
		mobileNav.classList.remove( 'is-open' );
		navToggle.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';
	}

	if ( navToggle && mobileNav ) {
		navToggle.addEventListener( 'click', function () {
			var isOpen = mobileNav.classList.contains( 'is-open' );
			isOpen ? closeMobileNav() : openMobileNav();
		} );
	}
	if ( navClose ) {
		navClose.addEventListener( 'click', closeMobileNav );
	}
	if ( mobileNav ) {
		mobileNav.querySelectorAll( 'a' ).forEach( function ( link ) {
			link.addEventListener( 'click', closeMobileNav );
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key ) {
				closeMobileNav();
			}
		} );
	}

	/* ---------- Scroll reveal ---------- */
	var revealEls = document.querySelectorAll( '.reveal' );
	if ( revealEls.length ) {
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
	}

	/* ---------- Photo journal lightbox ---------- */
	var lightboxTriggers = document.querySelectorAll( '[data-lightbox]' );
	if ( lightboxTriggers.length ) {
		var overlay = document.createElement( 'div' );
		overlay.className = 'tn-lightbox';
		overlay.innerHTML = '<button type="button" class="tn-lightbox-close" aria-label="Close">&times;</button><img alt="">';
		document.body.appendChild( overlay );

		var overlayImg = overlay.querySelector( 'img' );
		var closeBtn = overlay.querySelector( '.tn-lightbox-close' );

		function openLightbox( trigger ) {
			overlayImg.src = trigger.getAttribute( 'href' );
			overlayImg.alt = trigger.getAttribute( 'aria-label' ) || '';
			overlay.classList.add( 'is-open' );
		}

		function closeLightbox() {
			overlay.classList.remove( 'is-open' );
			overlayImg.src = '';
		}

		lightboxTriggers.forEach( function ( trigger ) {
			trigger.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				openLightbox( trigger );
			} );
		} );

		closeBtn.addEventListener( 'click', closeLightbox );
		overlay.addEventListener( 'click', function ( e ) {
			if ( e.target === overlay ) {
				closeLightbox();
			}
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key ) {
				closeLightbox();
			}
		} );
	}

	/* ---------- Trek Finder ---------- */
	var finder = document.querySelector( '[data-trek-finder]' );
	if ( finder ) {
		var chips = finder.querySelectorAll( '.chip[data-filter-group]' );
		var cards = finder.querySelectorAll( '[data-trek-card]' );
		var emptyState = finder.querySelector( '.finder-empty' );
		var resetBtn = finder.querySelector( '[data-finder-reset]' );

		var active = {
			difficulty: null,
			duration: null,
			region: null,
			experience: null,
		};

		function applyFilters() {
			var visibleCount = 0;
			cards.forEach( function ( card ) {
				var matches = Object.keys( active ).every( function ( group ) {
					if ( ! active[ group ] ) {
						return true;
					}
					var values = ( card.getAttribute( 'data-' + group ) || '' ).split( ',' );
					return values.indexOf( active[ group ] ) !== -1;
				} );
				card.style.display = matches ? '' : 'none';
				if ( matches ) {
					visibleCount++;
				}
			} );

			if ( emptyState ) {
				emptyState.classList.toggle( 'is-visible', 0 === visibleCount );
			}
		}

		chips.forEach( function ( chip ) {
			chip.addEventListener( 'click', function () {
				var group = chip.getAttribute( 'data-filter-group' );
				var value = chip.getAttribute( 'data-filter-value' );
				var alreadyActive = active[ group ] === value;

				finder.querySelectorAll( '.chip[data-filter-group="' + group + '"]' ).forEach( function ( sibling ) {
					sibling.setAttribute( 'aria-pressed', 'false' );
				} );

				if ( alreadyActive ) {
					active[ group ] = null;
				} else {
					active[ group ] = value;
					chip.setAttribute( 'aria-pressed', 'true' );
				}

				applyFilters();
			} );
		} );

		if ( resetBtn ) {
			resetBtn.addEventListener( 'click', function () {
				Object.keys( active ).forEach( function ( group ) {
					active[ group ] = null;
				} );
				finder.querySelectorAll( '.chip' ).forEach( function ( chip ) {
					chip.setAttribute( 'aria-pressed', 'false' );
				} );
				applyFilters();
			} );
		}
	}
} )();
