<?php
/**
 * Small rendering helpers.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A real image when an attachment is set, otherwise a labelled placeholder
 * tile so the layout never shows a broken image.
 *
 * @param int    $attachment_id Attachment ID, 0 for a placeholder.
 * @param string $label         Placeholder label and alt text fallback.
 * @param string $class         Extra classes (ratio-*, tone-*).
 * @param string $size          Image size.
 * @return string
 */
function azure_image( $attachment_id, $label, $class = '', $size = 'azure-wide' ) {
	$classes = trim( 'az-img ' . $class );
	if ( $attachment_id && wp_attachment_is_image( $attachment_id ) ) {
		$img = wp_get_attachment_image( $attachment_id, $size, false, array( 'loading' => 'lazy' ) );
		return '<div class="' . esc_attr( $classes . ' has-photo' ) . '">' . $img . '</div>';
	}
	return '<div class="' . esc_attr( $classes ) . '"><span class="az-img-label">' . azure_icon( 'image' ) . esc_html( $label ) . '</span></div>';
}

/**
 * Inline line icons.
 *
 * @param string $name Icon key.
 * @return string
 */
function azure_icon( $name ) {
	$icons = array(
		'arrow' => '<path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
		'image' => '<rect x="3" y="5" width="18" height="14" rx="1" fill="none" stroke="currentColor" stroke-width="1.4"/><path d="m3 16 5-5 4 4 3-3 6 6" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>',
		'waves' => '<path d="M2 9c2.5 0 2.5-2 5-2s2.5 2 5 2 2.5-2 5-2 2.5 2 5 2M2 15c2.5 0 2.5-2 5-2s2.5 2 5 2 2.5-2 5-2 2.5 2 5 2" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>',
		'sun'   => '<circle cx="12" cy="14" r="4" fill="none" stroke="currentColor" stroke-width="1.3"/><path d="M12 5v2M5.6 7.6 7 9M18.4 7.6 17 9M3 14h2M19 14h2M2 19h20" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>',
		'leaf'  => '<path d="M5 19c0-8 5-14 15-14 0 10-6 15-14 15" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><path d="M5 19 13 11" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>',
		'glass' => '<path d="M7 3h10l-1 7a4 4 0 0 1-8 0L7 3ZM12 14v7M8 21h8" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>',
		'boat'  => '<path d="M3 16h18l-2.5 4h-13L3 16ZM12 3v13M12 4l6 9h-6" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>',
		'spa'   => '<path d="M12 20c-4 0-8-3-8-8 3 0 6 1.5 8 4 2-2.5 5-4 8-4 0 5-4 8-8 8ZM12 16c-1.5-2-2-4.5 0-9 2 4.5 1.5 7 0 9Z" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>',
	);
	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}
	return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $icons[ $name ] . '</svg>';
}

/**
 * Icon choices offered in the Customizer.
 */
function azure_icon_choices() {
	return array(
		'waves' => __( 'Waves', 'azure-isle' ),
		'sun'   => __( 'Sunset', 'azure-isle' ),
		'leaf'  => __( 'Leaf', 'azure-isle' ),
		'glass' => __( 'Glass', 'azure-isle' ),
		'boat'  => __( 'Sailboat', 'azure-isle' ),
		'spa'   => __( 'Lotus', 'azure-isle' ),
	);
}

/**
 * Site logo: the Custom Logo when set, otherwise the site name + subtitle.
 *
 * @param string $class Wrapper class.
 */
function azure_logo( $class = 'az-logo' ) {
	echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="' . esc_attr( $class ) . '" rel="home">';
	if ( has_custom_logo() ) {
		echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'az-logo-img' ) );
	} else {
		echo '<span class="az-logo-mark">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
		$sub = azure_mod( 'logo_subtitle' );
		if ( $sub ) {
			echo '<span class="az-logo-sub">' . esc_html( $sub ) . '</span>';
		}
	}
	echo '</a>';
}

/**
 * Fallback for the overlay menu before one is assigned.
 */
function azure_menu_fallback() {
	$base  = is_front_page() ? '' : home_url( '/' );
	$links = array(
		'#about'       => __( 'The Resort', 'azure-isle' ),
		'#rooms'       => __( 'Rooms & Villas', 'azure-isle' ),
		'#experiences' => __( 'Experiences', 'azure-isle' ),
		'#dining'      => __( 'Dining & Spa', 'azure-isle' ),
		'#gallery'     => __( 'Gallery', 'azure-isle' ),
		'#contact'     => __( 'Contact', 'azure-isle' ),
	);
	echo '<ul class="az-menu-list">';
	foreach ( $links as $hash => $label ) {
		echo '<li><a href="' . esc_url( $base . $hash ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Where the booking bar and "Book" buttons point.
 */
function azure_booking_url() {
	$url = azure_mod( 'booking_url' );
	return $url ? $url : home_url( '/#booking' );
}
