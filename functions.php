<?php
/**
 * Trail Notes theme bootstrap.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TN_VERSION', '1.0.0' );
define( 'TN_DIR', get_template_directory() );
define( 'TN_URI', get_template_directory_uri() );

/**
 * Theme setup: supports, menus, image sizes.
 */
function tn_setup() {
	load_theme_textdomain( 'trail-notes', TN_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	set_post_thumbnail_size( 1600, 900, true );
	add_image_size( 'tn-card', 800, 600, true );
	add_image_size( 'tn-square', 800, 800, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'trail-notes' ),
			'footer-explore' => __( 'Footer — Explore', 'trail-notes' ),
			'footer-treks' => __( 'Footer — Popular Treks', 'trail-notes' ),
		)
	);
}
add_action( 'after_setup_theme', 'tn_setup' );

/**
 * Enqueue styles and scripts.
 */
function tn_assets() {
	wp_enqueue_style( 'tn-google-fonts', 'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'trail-notes-style', get_stylesheet_uri(), array(), TN_VERSION );
	wp_enqueue_script( 'trail-notes-main', TN_URI . '/assets/js/main.js', array(), TN_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tn_assets' );

/**
 * Media uploader + repeater-table admin assets, loaded only on the Trek
 * add/edit screen — this is what lets "Photo Journal" and "Trek Videos"
 * open the real Media Library instead of typing a placeholder count, and
 * turns the pipe-delimited fields into editable tables.
 */
function tn_admin_assets( $hook ) {
	$screen = get_current_screen();
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) || ! $screen || 'trek' !== $screen->post_type ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_style( 'trail-notes-admin-trek', TN_URI . '/assets/css/admin-trek.css', array(), TN_VERSION );
	wp_enqueue_script( 'trail-notes-admin-repeater', TN_URI . '/assets/js/admin-repeater.js', array(), TN_VERSION, true );
	wp_enqueue_script( 'trail-notes-admin-media', TN_URI . '/assets/js/admin-media.js', array( 'jquery' ), TN_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'tn_admin_assets' );

/**
 * Widget areas (kept minimal — footer is hand-built from theme mods/menus).
 */
function tn_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'trail-notes' ),
			'id'            => 'blog-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'tn_widgets_init' );

/** Theme includes. */
require TN_DIR . '/inc/template-tags.php';
require TN_DIR . '/inc/custom-post-types.php';
require TN_DIR . '/inc/meta-boxes.php';
require TN_DIR . '/inc/seo.php';
require TN_DIR . '/inc/plan-a-trek-form.php';
require TN_DIR . '/inc/customizer.php';
require TN_DIR . '/inc/seed-content.php';

/**
 * Fallback content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1280;
}

/**
 * Excerpt length + "read more" string tuned for trek cards.
 */
function tn_excerpt_length( $length ) {
	return 26;
}
add_filter( 'excerpt_length', 'tn_excerpt_length' );

function tn_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'tn_excerpt_more' );

/**
 * Register the "Plan a Trek" and other simple page templates in a way that
 * works even before the admin creates matching Pages — see README.md.
 */
function tn_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'is-home';
	}
	return $classes;
}
add_filter( 'body_class', 'tn_body_classes' );
