<?php
/**
 * Azure Isle theme bootstrap.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AZURE_VERSION', '1.1.0' );
define( 'AZURE_DIR', get_template_directory() );
define( 'AZURE_URI', get_template_directory_uri() );

/**
 * Theme setup: supports, menus, image sizes.
 */
function azure_setup() {
	load_theme_textdomain( 'azure-isle', AZURE_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-logo', array( 'height' => 120, 'width' => 360, 'flex-height' => true, 'flex-width' => true ) );

	add_image_size( 'azure-card', 900, 1200, true );
	add_image_size( 'azure-wide', 1400, 1050, true );

	register_nav_menus(
		array(
			'primary' => __( 'Main Menu', 'azure-isle' ),
			'footer'  => __( 'Footer Bottom Menu', 'azure-isle' ),
		)
	);
}
add_action( 'after_setup_theme', 'azure_setup' );

/**
 * Fonts, stylesheet and script.
 */
function azure_assets() {
	wp_enqueue_style( 'azure-fonts', 'https://fonts.googleapis.com/css2?family=Marcellus&family=Jost:wght@300;400;500&family=Mrs+Saint+Delafield&display=swap', array(), null );
	wp_enqueue_style( 'azure-style', get_stylesheet_uri(), array(), AZURE_VERSION );
	wp_enqueue_script( 'azure-theme', AZURE_URI . '/assets/js/theme.js', array(), AZURE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'azure_assets' );

/**
 * Transparent header only where a full-screen hero sits under it.
 */
function azure_body_classes( $classes ) {
	if ( is_front_page() || is_singular( 'azure_room' ) || is_page_template( array( 'template-about.php', 'template-contact.php' ) ) ) {
		$classes[] = 'has-hero';
	}
	return $classes;
}
add_filter( 'body_class', 'azure_body_classes' );

function azure_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'azure_excerpt_more' );

if ( ! isset( $content_width ) ) {
	$content_width = 760;
}

require AZURE_DIR . '/inc/template-tags.php';
require AZURE_DIR . '/inc/customizer.php';
require AZURE_DIR . '/inc/rooms.php';
require AZURE_DIR . '/inc/forms.php';
