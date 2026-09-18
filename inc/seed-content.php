<?php
/**
 * One-time content seeding: creates the 4 treks named in the brief so the
 * site is immediately populated instead of empty on first activation.
 * Only real, explicitly-given facts are set (name, region, short
 * description, and the one personally-written experience paragraph for
 * Chopta–Tungnath–Chandrashila) — every other field (difficulty, cost,
 * itinerary, etc.) is left blank so the templates show their built-in
 * "[Add ...]" placeholders rather than inventing anything.
 *
 * Safe to run more than once: it checks for an existing post by slug
 * before creating one, and is gated behind an option flag so it only
 * fires automatically the first time.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tn_seed_demo_treks() {
	$treks = array(
		array(
			'slug'    => 'chopta-tungnath-chandrashila',
			'title'   => 'Chopta – Tungnath – Chandrashila',
			'region'  => 'Uttarakhand',
			'excerpt' => "One of the most memorable Himalayan journeys I've done, taking me through forests, mountain trails and the climb towards Chandrashila.",
			'content' => "Chandrashila trek ke liye nikalte waqt mujhe sabse zyada excitement summit ko lekar thi. Lekin actual mein trail ka forest section aur Tungnath ke baad ka climb mere liye journey ke most memorable parts rahe.\n\nSummit ke paas pahunchte-pahunchte fatigue feel hone laga tha, lekin upar se views dekhne ke baad woh climb worth it laga.",
			'has_real_experience' => true,
		),
		array(
			'slug'    => 'chakrata-moila-top',
			'title'   => 'Chakrata – Moila Top',
			'region'  => 'Uttarakhand',
			'excerpt' => 'A peaceful mountain escape through the forests and trails around Chakrata, leading towards Moila Top.',
			'content' => '',
			'has_real_experience' => false,
		),
		array(
			'slug'    => 'yulla-kanda',
			'title'   => 'Yulla Kanda',
			'region'  => 'Himachal Pradesh',
			'excerpt' => 'A journey into the high mountains towards Yulla Kanda, with changing landscapes, altitude and a completely different trekking experience.',
			'content' => '',
			'has_real_experience' => false,
		),
		array(
			'slug'    => 'raghupur-fort-sillasar-lake',
			'title'   => 'Raghupur Fort – Sillasar Lake',
			'region'  => 'Himachal Pradesh',
			'excerpt' => "A combination of mountain trails, an old fort and a beautiful high-altitude lake — one journey with two very different experiences.",
			'content' => '',
			'has_real_experience' => false,
		),
	);

	foreach ( $treks as $trek ) {
		if ( get_page_by_path( $trek['slug'], OBJECT, 'trek' ) ) {
			continue;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'    => 'trek',
				'post_title'   => $trek['title'],
				'post_name'    => $trek['slug'],
				'post_excerpt' => $trek['excerpt'],
				'post_content' => $trek['content'],
				'post_status'  => 'publish',
			)
		);

		if ( is_wp_error( $post_id ) || ! $post_id ) {
			continue;
		}

		wp_set_object_terms( $post_id, $trek['region'], 'trek_region' );
		update_post_meta( $post_id, 'tn_has_real_experience', $trek['has_real_experience'] ? '1' : '' );
	}
}
add_action( 'after_switch_theme', 'tn_seed_demo_treks' );

function tn_maybe_seed_demo_treks_on_init() {
	if ( ! get_option( 'tn_demo_treks_seeded' ) ) {
		tn_seed_demo_treks();
		update_option( 'tn_demo_treks_seeded', 1 );
	}
}
add_action( 'init', 'tn_maybe_seed_demo_treks_on_init', 20 );

/**
 * Create the About Me, Travel Tips and Plan a Trek pages so their
 * matching page-{slug}.php templates have somewhere to attach — without
 * these, /about/, /travel-tips/ and /plan-a-trek/ would 404 until someone
 * manually created the Pages in wp-admin.
 */
function tn_seed_demo_pages() {
	$pages = array(
		'about'       => 'About Me',
		'travel-tips' => 'Travel Tips',
		'plan-a-trek' => 'Plan a Trek',
	);

	foreach ( $pages as $slug => $title ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_title'  => $title,
				'post_name'   => $slug,
				'post_status' => 'publish',
			)
		);
	}
}
add_action( 'after_switch_theme', 'tn_seed_demo_pages' );

function tn_maybe_seed_demo_pages_on_init() {
	if ( ! get_option( 'tn_demo_pages_seeded' ) ) {
		tn_seed_demo_pages();
		update_option( 'tn_demo_pages_seeded', 1 );
	}
}
add_action( 'init', 'tn_maybe_seed_demo_pages_on_init', 20 );
