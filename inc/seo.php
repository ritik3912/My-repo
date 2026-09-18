<?php
/**
 * Lightweight built-in SEO output — meta description, canonical URL and
 * Open Graph tags — so the theme doesn't require an SEO plugin to meet
 * the brief's SEO requirements. If the site later installs Yoast/Rank
 * Math, these filters simply stop being the loudest voice in <head>.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom document title for single treks (falls back to WP default title
 * tag support everywhere else).
 */
function tn_document_title_parts( $parts ) {
	if ( is_singular( 'trek' ) ) {
		$seo_title = tn_meta( get_the_ID(), 'tn_seo_title' );
		if ( $seo_title ) {
			$parts['title'] = $seo_title;
		}
	}
	return $parts;
}
add_filter( 'document_title_parts', 'tn_document_title_parts' );

/**
 * Resolve the best available description for the current view.
 */
function tn_get_meta_description() {
	if ( is_singular( 'trek' ) ) {
		$custom = tn_meta( get_the_ID(), 'tn_seo_description' );
		if ( $custom ) {
			return $custom;
		}
		if ( has_excerpt() ) {
			return wp_strip_all_tags( get_the_excerpt() );
		}
		return wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
	}

	if ( is_front_page() ) {
		return get_bloginfo( 'description' ) ?: __( 'Real Himalayan trek experiences and practical trekking guides — route, cost, packing lists and honest lessons from the trail.', 'trail-notes' );
	}

	if ( is_page() ) {
		if ( has_excerpt() ) {
			return wp_strip_all_tags( get_the_excerpt() );
		}
		return wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
	}

	if ( is_post_type_archive( 'trek' ) ) {
		return __( "These aren't places I've simply researched — they're journeys I've experienced myself. Browse every trek I've documented, with real routes, costs and lessons.", 'trail-notes' );
	}

	return get_bloginfo( 'description' );
}

/**
 * Output meta description, canonical and Open Graph tags.
 */
function tn_output_seo_meta() {
	$description = trim( tn_get_meta_description() );
	$title       = wp_get_document_title();
	$url         = is_singular() || is_page() ? get_permalink() : ( is_home() || is_front_page() ? home_url( '/' ) : '' );

	if ( $description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_trim_words( $description, 40, '' ) ) );
	}

	if ( $url ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );
	}

	printf( '<meta property="og:type" content="%s">' . "\n", is_singular( 'trek' ) ? 'article' : 'website' );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	if ( $description ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( wp_trim_words( $description, 40, '' ) ) );
	}
	if ( $url ) {
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	}
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );

	if ( is_singular( 'trek' ) && has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		if ( $image ) {
			printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image[0] ) );
			echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		}
	}
}
add_action( 'wp_head', 'tn_output_seo_meta', 1 );
