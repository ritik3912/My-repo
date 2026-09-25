<?php
/**
 * Island Resort page template support: assets and icons.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the resort fonts, stylesheet and script only on the resort template.
 */
function rs_assets() {
	if ( ! is_page_template( 'page-resort.php' ) ) {
		return;
	}
	wp_enqueue_style( 'rs-google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Jost:wght@300;400;500&display=swap', array(), null );
	wp_enqueue_style( 'rs-resort', TN_URI . '/assets/css/resort.css', array( 'trail-notes-style' ), TN_VERSION );
	wp_enqueue_script( 'rs-resort', TN_URI . '/assets/js/resort.js', array(), TN_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'rs_assets', 20 );

/**
 * Line icons used by the resort Experiences grid.
 *
 * @param string $name Icon key.
 * @return string Inline SVG, or '' for an unknown key.
 */
function rs_icon( $name ) {
	$icons = array(
		'waves' => '<path d="M2 9c2.5 0 2.5-2 5-2s2.5 2 5 2 2.5-2 5-2 2.5 2 5 2M2 15c2.5 0 2.5-2 5-2s2.5 2 5 2 2.5-2 5-2 2.5 2 5 2" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>',
		'sun'   => '<circle cx="12" cy="14" r="4" fill="none" stroke="currentColor" stroke-width="1.3"/><path d="M12 5v2M5.6 7.6 7 9M18.4 7.6 17 9M3 14h2M19 14h2M2 19h20" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>',
		'leaf'  => '<path d="M5 19c0-8 5-14 15-14 0 10-6 15-14 15" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><path d="M5 19 13 11" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>',
		'glass' => '<path d="M7 3h10l-1 7a4 4 0 0 1-8 0L7 3ZM12 14v7M8 21h8" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>',
	);
	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}
	return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $icons[ $name ] . '</svg>';
}
