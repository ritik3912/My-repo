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
	$l     = ' fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"';
	$icons = array(
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"' . $l . '/>',
		'prev'     => '<path d="M15 5l-7 7 7 7"' . $l . '/>',
		'next'     => '<path d="M9 5l7 7-7 7"' . $l . '/>',
		'play'     => '<path d="M9 6.5v11l9-5.5-9-5.5Z" fill="currentColor"/>',
		'image'    => '<rect x="3" y="5" width="18" height="14" rx="1"' . $l . '/><path d="m3 16 5-5 4 4 3-3 6 6"' . $l . '/>',
		'resort'   => '<path d="M3 9h18M5 9 12 4l7 5M6 9v10M10 9v10M14 9v10M18 9v10M3 20h18"' . $l . '/>',
		'size'     => '<path d="M4 9V4h5M20 9V4h-5M4 15v5h5M20 15v5h-5"' . $l . '/>',
		'guests'   => '<circle cx="9" cy="8" r="3"' . $l . '/><path d="M3.5 19c.6-3 2.8-5 5.5-5s4.9 2 5.5 5M16 5.5a3 3 0 0 1 0 5.5M18 14c1.4.6 2.3 2.2 2.6 4.5"' . $l . '/>',
		'bed'      => '<path d="M3 18V7M3 14h18v4M21 14v-2.5A2.5 2.5 0 0 0 18.5 9H11v5M6.5 11.5a1.5 1.5 0 1 0 0-.01"' . $l . '/>',
		'car'      => '<path d="M5 16V11l2-5h10l2 5v5M3.5 11h17M5 16h14v2.5M5 16v2.5M8 13.5h.01M16 13.5h.01"' . $l . '/>',
		'key'      => '<circle cx="8" cy="15" r="4"' . $l . '/><path d="M11 12l8-8M16 7l2 2M14 9l2 2"' . $l . '/>',
		'wifi'     => '<path d="M2.5 9a14 14 0 0 1 19 0M5.5 12.5a9.5 9.5 0 0 1 13 0M8.5 16a5 5 0 0 1 7 0M12 19.5h.01"' . $l . '/>',
		'laundry'  => '<rect x="4" y="3" width="16" height="18" rx="1.5"' . $l . '/><circle cx="12" cy="13" r="4.5"' . $l . '/><path d="M7 6.5h.01M10 6.5h4"' . $l . '/>',
		'cup'      => '<path d="M4 9h13v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V9ZM17 10h1.5a2.5 2.5 0 0 1 0 5H17M8 3v3M12 3v3"' . $l . '/>',
		'pool'     => '<path d="M8 15V5a2 2 0 0 1 4 0M16 15V5a2 2 0 0 0-4 0M8 8h8M8 12h8M2 18c2 0 2-1.5 4-1.5s2 1.5 4 1.5 2-1.5 4-1.5 2 1.5 4 1.5 2-1.5 4-1.5"' . $l . '/>',
		'waves'    => '<path d="M2 9c2.5 0 2.5-2 5-2s2.5 2 5 2 2.5-2 5-2 2.5 2 5 2M2 15c2.5 0 2.5-2 5-2s2.5 2 5 2 2.5-2 5-2 2.5 2 5 2"' . $l . '/>',
		'sun'      => '<circle cx="12" cy="14" r="4"' . $l . '/><path d="M12 5v2M5.6 7.6 7 9M18.4 7.6 17 9M3 14h2M19 14h2M2 19h20"' . $l . '/>',
		'leaf'     => '<path d="M5 19c0-8 5-14 15-14 0 10-6 15-14 15M5 19l8-8"' . $l . '/>',
		'glass'    => '<path d="M7 3h10l-1 7a4 4 0 0 1-8 0L7 3ZM12 14v7M8 21h8"' . $l . '/>',
		'spa'      => '<path d="M12 20c-4 0-8-3-8-8 3 0 6 1.5 8 4 2-2.5 5-4 8-4 0 5-4 8-8 8ZM12 16c-1.5-2-2-4.5 0-9 2 4.5 1.5 7 0 9Z"' . $l . '/>',
		'heart'    => '<path d="M12 20s-7.5-4.5-7.5-10A4.3 4.3 0 0 1 12 7.2 4.3 4.3 0 0 1 19.5 10c0 5.5-7.5 10-7.5 10Z"' . $l . '/>',
		'pin'      => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21Z"' . $l . '/><circle cx="12" cy="9.5" r="2.5"' . $l . '/>',
		'phone'    => '<path d="M5 4h4l1.5 4.5-2.3 1.4a11 11 0 0 0 5.9 5.9l1.4-2.3L20 15v4a1.5 1.5 0 0 1-1.6 1.5A16.5 16.5 0 0 1 3.5 5.6 1.5 1.5 0 0 1 5 4Z"' . $l . '/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="1.5"' . $l . '/><path d="m3.5 6 8.5 7 8.5-7"' . $l . '/>',
		'clock'    => '<circle cx="12" cy="12" r="8.5"' . $l . '/><path d="M12 7.5V12l3 2"' . $l . '/>',
		'facebook' => '<path d="M13.5 21v-7.5H16l.4-3h-2.9V8.7c0-.9.3-1.5 1.5-1.5h1.5V4.5a20 20 0 0 0-2.2-.1c-2.2 0-3.7 1.3-3.7 3.8v2.3H8v3h2.6V21h2.9Z" fill="currentColor"/>',
		'x'        => '<path d="M17.5 3.5h3l-6.6 7.5 7.8 9.5h-6.1l-4.8-6.2-5.5 6.2h-3l7-8L2.7 3.5H9l4.3 5.7 4.2-5.7Zm-1 15.3h1.7L7.6 5.1H5.8l10.7 13.7Z" fill="currentColor"/>',
		'instagram'=> '<rect x="3.5" y="3.5" width="17" height="17" rx="4.5"' . $l . '/><circle cx="12" cy="12" r="4"' . $l . '/><path d="M17.2 6.8h.01"' . $l . '/>',
		'youtube'  => '<path d="M21.6 7.2a2.5 2.5 0 0 0-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.4a2.5 2.5 0 0 0-1.8 1.8C2 8.8 2 12 2 12s0 3.2.4 4.8a2.5 2.5 0 0 0 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4a2.5 2.5 0 0 0 1.8-1.8c.4-1.6.4-4.8.4-4.8s0-3.2-.4-4.8ZM10 15V9l5.2 3L10 15Z" fill="currentColor"/>',
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
		'car'     => __( 'Car', 'azure-isle' ),
		'key'     => __( 'Key', 'azure-isle' ),
		'wifi'    => __( 'Wifi', 'azure-isle' ),
		'laundry' => __( 'Laundry', 'azure-isle' ),
		'cup'     => __( 'Cup', 'azure-isle' ),
		'pool'    => __( 'Pool', 'azure-isle' ),
		'waves'   => __( 'Waves', 'azure-isle' ),
		'sun'     => __( 'Sunset', 'azure-isle' ),
		'leaf'    => __( 'Leaf', 'azure-isle' ),
		'glass'   => __( 'Glass', 'azure-isle' ),
		'spa'     => __( 'Lotus', 'azure-isle' ),
		'heart'   => __( 'Heart', 'azure-isle' ),
		'bed'     => __( 'Bed', 'azure-isle' ),
		'resort'  => __( 'Resort', 'azure-isle' ),
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
 * URL of the first published page using a page template.
 *
 * @param string $template Template file, e.g. template-about.php.
 * @return string Empty when no page uses it.
 */
function azure_page_url( $template ) {
	static $cache = array();
	if ( ! isset( $cache[ $template ] ) ) {
		$pages              = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery
				'meta_value'     => $template, // phpcs:ignore WordPress.DB.SlowDBQuery
				'fields'         => 'ids',
			)
		);
		$cache[ $template ] = $pages ? get_permalink( $pages[0] ) : '';
	}
	return $cache[ $template ];
}

/**
 * Fallback for the header and overlay menus before one is assigned.
 *
 * @param array $args wp_nav_menu() arguments.
 */
function azure_menu_fallback( $args = array() ) {
	$links = array(
		home_url( '/' )                                => __( 'Home', 'azure-isle' ),
		get_post_type_archive_link( 'azure_room' )     => __( 'Rooms', 'azure-isle' ),
		azure_page_url( 'template-about.php' )         => __( 'About', 'azure-isle' ),
		azure_page_url( 'template-contact.php' )       => __( 'Contact', 'azure-isle' ),
	);
	$class = ! empty( $args['menu_class'] ) ? $args['menu_class'] : 'menu';
	echo '<ul class="' . esc_attr( $class ) . '">';
	foreach ( $links as $url => $label ) {
		if ( $url ) {
			echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
		}
	}
	echo '</ul>';
}

/**
 * Where the header "Book" button points: the Customizer URL, else the
 * Contact page, else the footer contact details.
 */
function azure_booking_url() {
	$url = azure_mod( 'booking_url' );
	if ( ! $url ) {
		$url = azure_page_url( 'template-contact.php' );
	}
	return $url ? $url : home_url( '/#contact' );
}

/**
 * Social profile links with icons.
 */
function azure_social_links() {
	$networks = array(
		'facebook'  => __( 'Facebook', 'azure-isle' ),
		'x'         => __( 'X', 'azure-isle' ),
		'instagram' => __( 'Instagram', 'azure-isle' ),
		'youtube'   => __( 'YouTube', 'azure-isle' ),
	);
	$out = '';
	foreach ( $networks as $key => $label ) {
		$url = azure_mod( $key . '_url' );
		if ( $url ) {
			$out .= '<li><a href="' . esc_url( $url ) . '" target="_blank" rel="noopener">' . azure_icon( $key ) . '<span class="screen-reader-text">' . esc_html( $label ) . '</span></a></li>';
		}
	}
	if ( $out ) {
		echo '<ul class="az-social">' . $out . '</ul>'; // phpcs:ignore WordPress.Security.EscapeOutput -- built from escaped parts.
	}
}

/**
 * Plain telephone link target.
 *
 * @param string $phone Display number.
 * @return string
 */
function azure_tel( $phone ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * Background image for a page header band: the Customizer image, else the
 * current page's Featured Image.
 *
 * @param string $mod Customizer setting id.
 * @return int Attachment ID.
 */
function azure_page_hero_image( $mod ) {
	$id = (int) azure_mod( $mod );
	return $id ? $id : (int) get_post_thumbnail_id();
}
