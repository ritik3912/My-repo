<?php
/**
 * Customizer: every front-page section is editable under
 * Appearance → Customize → Azure Isle — Front Page.
 *
 * Settings are declared once in azure_settings(); the Customizer controls
 * and the defaults used by azure_mod() both come from that list.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All theme settings, grouped by Customizer section.
 * Field: id => array( label, type, default [, choices] ).
 * Types: text, textarea, url, email, image, select.
 */
function azure_settings() {
	$s = array();

	$s['general'] = array(
		'title'  => __( 'General & Booking', 'azure-isle' ),
		'fields' => array(
			'logo_subtitle' => array( __( 'Text under the site name', 'azure-isle' ), 'text', __( 'Island Resort & Spa', 'azure-isle' ) ),
			'header_button' => array( __( 'Header button label', 'azure-isle' ), 'text', __( 'Book Your Stay', 'azure-isle' ) ),
			'booking_url'   => array( __( 'Booking page URL (leave empty to scroll to the booking bar)', 'azure-isle' ), 'url', '' ),
			'booking_form'  => array( __( 'Booking bar form action URL (your booking engine; leave empty to jump to Contact)', 'azure-isle' ), 'url', '' ),
		),
	);

	$s['hero'] = array(
		'title'  => __( 'Hero', 'azure-isle' ),
		'fields' => array(
			'hero_image'    => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
			'hero_eyebrow'  => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Welcome to Paradise', 'azure-isle' ) ),
			'hero_title'    => array( __( 'Title', 'azure-isle' ), 'text', __( 'Where the Ocean Sets the Pace', 'azure-isle' ) ),
			'hero_text'     => array( __( 'Subtitle', 'azure-isle' ), 'textarea', __( 'A private island retreat of white sand, clear water and quiet luxury.', 'azure-isle' ) ),
			'hero_show_bar' => array( __( 'Show booking bar', 'azure-isle' ), 'select', 'yes', array( 'yes' => __( 'Yes', 'azure-isle' ), 'no' => __( 'No', 'azure-isle' ) ) ),
		),
	);

	$s['intro'] = array(
		'title'  => __( 'About / Intro', 'azure-isle' ),
		'fields' => array(
			'intro_image'   => array( __( 'Main image', 'azure-isle' ), 'image', 0 ),
			'intro_image_2' => array( __( 'Small overlapping image', 'azure-isle' ), 'image', 0 ),
			'intro_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'The Resort', 'azure-isle' ) ),
			'intro_title'   => array( __( 'Title', 'azure-isle' ), 'text', __( 'A Barefoot Escape Surrounded by Turquoise Water', 'azure-isle' ) ),
			'intro_lede'    => array( __( 'Lead paragraph', 'azure-isle' ), 'textarea', __( 'Tucked into a crescent of coral sand, our resort is made for slowing down. Rooms and villas sit between the palms and the lagoon, each designed to let the breeze and the view do most of the work.', 'azure-isle' ) ),
			'intro_text'    => array( __( 'Paragraph', 'azure-isle' ), 'textarea', __( 'Spend the day on the reef, in the spa or doing nothing at all. We will take care of the rest.', 'azure-isle' ) ),
			'stat_1_num'    => array( __( 'Stat 1 number', 'azure-isle' ), 'text', '32' ),
			'stat_1_label'  => array( __( 'Stat 1 label', 'azure-isle' ), 'text', __( 'Rooms & Villas', 'azure-isle' ) ),
			'stat_2_num'    => array( __( 'Stat 2 number', 'azure-isle' ), 'text', '3' ),
			'stat_2_label'  => array( __( 'Stat 2 label', 'azure-isle' ), 'text', __( 'Restaurants', 'azure-isle' ) ),
			'stat_3_num'    => array( __( 'Stat 3 number', 'azure-isle' ), 'text', '1.2 km' ),
			'stat_3_label'  => array( __( 'Stat 3 label', 'azure-isle' ), 'text', __( 'Private Beach', 'azure-isle' ) ),
		),
	);

	$s['rooms'] = array(
		'title'       => __( 'Rooms Section', 'azure-isle' ),
		'description' => __( 'The room cards come from Rooms in the admin menu (ordered by the Order field).', 'azure-isle' ),
		'fields'      => array(
			'rooms_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Accommodation', 'azure-isle' ) ),
			'rooms_title'   => array( __( 'Title', 'azure-isle' ), 'text', __( 'Rooms & Villas', 'azure-isle' ) ),
			'rooms_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'Natural materials, soft light and a view of the water from every one.', 'azure-isle' ) ),
			'rooms_count'   => array( __( 'Number of rooms to show', 'azure-isle' ), 'select', '3', array( '3' => '3', '6' => '6', '9' => '9' ) ),
		),
	);

	$s['band'] = array(
		'title'  => __( 'Quote Band', 'azure-isle' ),
		'fields' => array(
			'band_image'   => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
			'band_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Island Living', 'azure-isle' ) ),
			'band_quote'   => array( __( 'Quote', 'azure-isle' ), 'textarea', __( 'Long days in the sun, warm nights under the stars, and nowhere you need to be.', 'azure-isle' ) ),
			'band_button'  => array( __( 'Button label', 'azure-isle' ), 'text', __( 'Plan Your Escape', 'azure-isle' ) ),
		),
	);

	$exp_defaults = array(
		1 => array( 'waves', __( 'Reef Snorkeling', 'azure-isle' ), __( 'Guided morning swims over the house reef, gear included.', 'azure-isle' ) ),
		2 => array( 'sun', __( 'Sunset Sailing', 'azure-isle' ), __( 'A slow catamaran loop around the island as the sky turns gold.', 'azure-isle' ) ),
		3 => array( 'leaf', __( 'Garden Spa', 'azure-isle' ), __( 'Open-air treatment pavilions using local oils and botanicals.', 'azure-isle' ) ),
		4 => array( 'glass', __( 'Beach Dining', 'azure-isle' ), __( 'Private tables set on the sand, lit by lanterns after dark.', 'azure-isle' ) ),
	);
	$exp_fields   = array(
		'exp_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Experiences', 'azure-isle' ) ),
		'exp_title'   => array( __( 'Title', 'azure-isle' ), 'text', __( 'Moments Worth Remembering', 'azure-isle' ) ),
	);
	foreach ( $exp_defaults as $n => $d ) {
		/* translators: %d: item number. */
		$exp_fields[ "exp_{$n}_icon" ] = array( sprintf( __( 'Item %d icon', 'azure-isle' ), $n ), 'select', $d[0], azure_icon_choices() );
		/* translators: %d: item number. */
		$exp_fields[ "exp_{$n}_title" ] = array( sprintf( __( 'Item %d title', 'azure-isle' ), $n ), 'text', $d[1] );
		/* translators: %d: item number. */
		$exp_fields[ "exp_{$n}_text" ] = array( sprintf( __( 'Item %d text', 'azure-isle' ), $n ), 'textarea', $d[2] );
	}
	$s['experiences'] = array(
		'title'  => __( 'Experiences', 'azure-isle' ),
		'fields' => $exp_fields,
	);

	$feat_defaults = array(
		1 => array( __( 'Dining', 'azure-isle' ), __( 'Fresh From the Water, Straight to the Table', 'azure-isle' ), __( 'Our kitchen works with island fishermen and small farms, so the menu follows what the day brings in. Breakfast by the pool, long lunches in the shade, and grilled seafood by candlelight.', 'azure-isle' ), __( 'View Menus', 'azure-isle' ) ),
		2 => array( __( 'Wellness', 'azure-isle' ), __( 'Slow Mornings and Unhurried Afternoons', 'azure-isle' ), __( 'Start with sunrise yoga on the deck, then let the rest of the day unfold at its own pace — a massage between the palms, a swim in the infinity pool, or a nap in a hammock.', 'azure-isle' ), __( 'Explore the Spa', 'azure-isle' ) ),
	);
	$feat_fields   = array();
	foreach ( $feat_defaults as $n => $d ) {
		/* translators: %d: block number. */
		$feat_fields[ "feat_{$n}_image" ] = array( sprintf( __( 'Block %d image', 'azure-isle' ), $n ), 'image', 0 );
		/* translators: %d: block number. */
		$feat_fields[ "feat_{$n}_eyebrow" ] = array( sprintf( __( 'Block %d small heading', 'azure-isle' ), $n ), 'text', $d[0] );
		/* translators: %d: block number. */
		$feat_fields[ "feat_{$n}_title" ] = array( sprintf( __( 'Block %d title', 'azure-isle' ), $n ), 'text', $d[1] );
		/* translators: %d: block number. */
		$feat_fields[ "feat_{$n}_text" ] = array( sprintf( __( 'Block %d text', 'azure-isle' ), $n ), 'textarea', $d[2] );
		/* translators: %d: block number. */
		$feat_fields[ "feat_{$n}_button" ] = array( sprintf( __( 'Block %d button label', 'azure-isle' ), $n ), 'text', $d[3] );
		/* translators: %d: block number. */
		$feat_fields[ "feat_{$n}_url" ] = array( sprintf( __( 'Block %d button URL', 'azure-isle' ), $n ), 'url', '' );
	}
	$s['features'] = array(
		'title'  => __( 'Dining & Spa', 'azure-isle' ),
		'fields' => $feat_fields,
	);

	$rev_defaults = array(
		1 => __( 'We came for five nights and extended to eight. The staff remembered every small preference, and waking up to the lagoon never got old.', 'azure-isle' ),
		2 => __( 'The overwater villa felt completely private. Snorkeling right off our own steps was the highlight of the whole trip.', 'azure-isle' ),
		3 => __( 'Quiet, beautiful and genuinely relaxing. The beach dinner on our anniversary is something we will talk about for years.', 'azure-isle' ),
	);
	$rev_fields   = array(
		'reviews_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Guest Stories', 'azure-isle' ) ),
	);
	foreach ( $rev_defaults as $n => $quote ) {
		/* translators: %d: review number. */
		$rev_fields[ "review_{$n}_quote" ] = array( sprintf( __( 'Review %d quote (empty hides it)', 'azure-isle' ), $n ), 'textarea', $quote );
		/* translators: %d: review number. */
		$rev_fields[ "review_{$n}_name" ] = array( sprintf( __( 'Review %d guest name', 'azure-isle' ), $n ), 'text', __( 'Guest name', 'azure-isle' ) );
		/* translators: %d: review number. */
		$rev_fields[ "review_{$n}_from" ] = array( sprintf( __( 'Review %d guest location', 'azure-isle' ), $n ), 'text', __( 'City, Country', 'azure-isle' ) );
	}
	$s['reviews'] = array(
		'title'       => __( 'Guest Reviews', 'azure-isle' ),
		'description' => __( 'The defaults are sample text. Replace them with real reviews.', 'azure-isle' ),
		'fields'      => $rev_fields,
	);

	$gal_fields = array();
	for ( $n = 1; $n <= 5; $n++ ) {
		/* translators: %d: image number. */
		$gal_fields[ "gallery_{$n}" ] = array( sprintf( __( 'Gallery image %d', 'azure-isle' ), $n ), 'image', 0 );
	}
	$s['gallery'] = array(
		'title'  => __( 'Gallery', 'azure-isle' ),
		'fields' => $gal_fields,
	);

	$s['offer'] = array(
		'title'  => __( 'Special Offer', 'azure-isle' ),
		'fields' => array(
			'offer_show'    => array( __( 'Show this section', 'azure-isle' ), 'select', 'yes', array( 'yes' => __( 'Yes', 'azure-isle' ), 'no' => __( 'No', 'azure-isle' ) ) ),
			'offer_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Special Offer', 'azure-isle' ) ),
			'offer_title'   => array( __( 'Title', 'azure-isle' ), 'text', __( 'Stay Four Nights, Pay for Three', 'azure-isle' ) ),
			'offer_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'Book directly with us for the best rate, daily breakfast and a complimentary sunset cruise.', 'azure-isle' ) ),
			'offer_button'  => array( __( 'Button label', 'azure-isle' ), 'text', __( 'Reserve Now', 'azure-isle' ) ),
		),
	);

	$s['footer'] = array(
		'title'  => __( 'Footer & Contact', 'azure-isle' ),
		'fields' => array(
			'footer_about'  => array( __( 'Short description', 'azure-isle' ), 'textarea', __( 'A quiet island hideaway for couples, families and anyone who needs the sea for a while.', 'azure-isle' ) ),
			'address'       => array( __( 'Address', 'azure-isle' ), 'textarea', '' ),
			'phone'         => array( __( 'Phone', 'azure-isle' ), 'text', '' ),
			'email'         => array( __( 'Email', 'azure-isle' ), 'email', '' ),
			'instagram_url' => array( __( 'Instagram URL', 'azure-isle' ), 'url', '' ),
			'facebook_url'  => array( __( 'Facebook URL', 'azure-isle' ), 'url', '' ),
			'copyright'     => array( __( 'Copyright text (after © year)', 'azure-isle' ), 'text', '' ),
		),
	);

	return $s;
}

/**
 * Read a theme setting, falling back to its declared default.
 *
 * @param string $id Setting id without prefix.
 * @return mixed
 */
function azure_mod( $id ) {
	static $defaults = null;
	if ( null === $defaults ) {
		$defaults = array();
		foreach ( azure_settings() as $section ) {
			foreach ( $section['fields'] as $key => $field ) {
				$defaults[ $key ] = $field[2];
			}
		}
	}
	return get_theme_mod( 'azure_' . $id, isset( $defaults[ $id ] ) ? $defaults[ $id ] : '' );
}

/**
 * Register panel, sections, settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function azure_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'azure_front',
		array(
			'title'    => __( 'Azure Isle — Front Page', 'azure-isle' ),
			'priority' => 25,
		)
	);

	$sanitizers = array(
		'text'     => 'sanitize_text_field',
		'textarea' => 'sanitize_textarea_field',
		'url'      => 'esc_url_raw',
		'email'    => 'sanitize_email',
		'image'    => 'absint',
		'select'   => 'sanitize_key',
	);

	foreach ( azure_settings() as $section_id => $section ) {
		$wp_customize->add_section(
			'azure_' . $section_id,
			array(
				'title'       => $section['title'],
				'description' => isset( $section['description'] ) ? $section['description'] : '',
				'panel'       => 'azure_front',
			)
		);

		foreach ( $section['fields'] as $key => $field ) {
			list( $label, $type, $default ) = $field;
			$setting_id                     = 'azure_' . $key;

			$wp_customize->add_setting(
				$setting_id,
				array(
					'default'           => $default,
					'sanitize_callback' => $sanitizers[ $type ],
				)
			);

			if ( 'image' === $type ) {
				$wp_customize->add_control(
					new WP_Customize_Media_Control(
						$wp_customize,
						$setting_id,
						array(
							'label'     => $label,
							'section'   => 'azure_' . $section_id,
							'mime_type' => 'image',
						)
					)
				);
				continue;
			}

			$args = array(
				'label'   => $label,
				'section' => 'azure_' . $section_id,
				'type'    => $type,
			);
			if ( 'select' === $type ) {
				$args['choices'] = $field[3];
			}
			$wp_customize->add_control( $setting_id, $args );
		}
	}
}
add_action( 'customize_register', 'azure_customize_register' );
