<?php
/**
 * "Trek" custom post type + its filter taxonomies (region, difficulty,
 * duration bucket, experience level). Registering these as taxonomies
 * rather than plain fields means new treks slot into the Trek Finder and
 * WP admin filtering automatically, and new terms (e.g. a new region) can
 * be added later without touching template code.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tn_register_trek_cpt() {
	$labels = array(
		'name'               => __( 'Treks', 'trail-notes' ),
		'singular_name'      => __( 'Trek', 'trail-notes' ),
		'add_new_item'       => __( 'Add New Trek', 'trail-notes' ),
		'edit_item'          => __( 'Edit Trek', 'trail-notes' ),
		'new_item'           => __( 'New Trek', 'trail-notes' ),
		'view_item'          => __( 'View Trek', 'trail-notes' ),
		'search_items'       => __( 'Search Treks', 'trail-notes' ),
		'not_found'          => __( 'No treks found.', 'trail-notes' ),
		'all_items'          => __( 'All Treks', 'trail-notes' ),
		'menu_name'          => __( 'Treks', 'trail-notes' ),
	);

	register_post_type(
		'trek',
		array(
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => true,
			'menu_icon'     => 'dashicons-palmtree',
			'menu_position' => 5,
			'rewrite'       => array( 'slug' => 'treks', 'with_front' => false ),
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'show_in_rest'  => true,
		)
	);
}
add_action( 'init', 'tn_register_trek_cpt' );

function tn_register_trek_taxonomies() {
	register_taxonomy(
		'trek_region',
		'trek',
		array(
			'labels'            => array(
				'name'          => __( 'Regions', 'trail-notes' ),
				'singular_name' => __( 'Region', 'trail-notes' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'trek-region' ),
			'show_in_rest'      => true,
		)
	);

	register_taxonomy(
		'trek_difficulty',
		'trek',
		array(
			'labels'            => array(
				'name'          => __( 'Difficulty', 'trail-notes' ),
				'singular_name' => __( 'Difficulty', 'trail-notes' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'trek-difficulty' ),
			'show_in_rest'      => true,
		)
	);

	register_taxonomy(
		'trek_duration',
		'trek',
		array(
			'labels'            => array(
				'name'          => __( 'Duration', 'trail-notes' ),
				'singular_name' => __( 'Duration', 'trail-notes' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'trek-duration' ),
			'show_in_rest'      => true,
		)
	);

	register_taxonomy(
		'trek_experience_level',
		'trek',
		array(
			'labels'            => array(
				'name'          => __( 'Experience Level', 'trail-notes' ),
				'singular_name' => __( 'Experience Level', 'trail-notes' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'trek-experience' ),
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'tn_register_trek_taxonomies', 0 );

/**
 * Seed the default taxonomy terms once, on theme activation, so the site
 * is usable immediately. Safe to run repeatedly — term_exists guards it.
 */
function tn_seed_default_terms() {
	$terms = array(
		'trek_region'            => array( 'Uttarakhand', 'Himachal Pradesh' ),
		'trek_difficulty'        => array( 'Easy', 'Moderate', 'Challenging' ),
		'trek_duration'          => array( 'Weekend', '3-4 Days', '5-7 Days' ),
		'trek_experience_level'  => array( 'Beginner', 'Intermediate', 'Experienced' ),
	);

	foreach ( $terms as $taxonomy => $names ) {
		foreach ( $names as $name ) {
			if ( ! term_exists( $name, $taxonomy ) ) {
				wp_insert_term( $name, $taxonomy );
			}
		}
	}
}
add_action( 'after_switch_theme', 'tn_seed_default_terms' );

/**
 * Also seed on init the first time, in case the theme was already active
 * when these taxonomies were introduced.
 */
function tn_maybe_seed_terms_on_init() {
	if ( ! get_option( 'tn_terms_seeded' ) ) {
		tn_seed_default_terms();
		update_option( 'tn_terms_seeded', 1 );
	}
}
add_action( 'init', 'tn_maybe_seed_terms_on_init', 20 );
