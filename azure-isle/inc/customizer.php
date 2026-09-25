<?php
/**
 * Customizer: every front-page section is editable under
 * Appearance → Customize → Azure Isle panels (Site, Front, About, Contact).
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
 * Section: id => array( panel, title, fields [, description] ).
 * Field: id => array( label, type, default [, choices] ).
 * Types: text, textarea, url, email, image, select.
 */
function azure_settings() {
	$s   = array();
	$yes = array( 'yes' => __( 'Yes', 'azure-isle' ), 'no' => __( 'No', 'azure-isle' ) );

	/* ---------- Site-wide ---------- */

	$s['general'] = array(
		'panel'  => 'site',
		'title'  => __( 'Header', 'azure-isle' ),
		'fields' => array(
			'logo_subtitle' => array( __( 'Text under the site name', 'azure-isle' ), 'text', __( 'Island Resort', 'azure-isle' ) ),
			'header_phone'  => array( __( 'Phone shown in the header', 'azure-isle' ), 'text', '+1 (555) 010-2400' ),
			'header_button' => array( __( 'Header button label (empty hides it)', 'azure-isle' ), 'text', __( 'Book Your Stay', 'azure-isle' ) ),
			'booking_url'   => array( __( 'Header button URL (empty links to the Contact page)', 'azure-isle' ), 'url', '' ),
		),
	);

	$s['newsletter'] = array(
		'panel'       => 'site',
		'title'       => __( 'Newsletter', 'azure-isle' ),
		'description' => __( 'Shown above the footer on every page. With no form action URL, sign-ups are emailed to the Contact form recipient.', 'azure-isle' ),
		'fields'      => array(
			'news_show'    => array( __( 'Show newsletter band', 'azure-isle' ), 'select', 'yes', $yes ),
			'news_image'   => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
			'news_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Stay in Touch', 'azure-isle' ) ),
			'news_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Sign up for our newsletter to receive our news, deals and special offers.', 'azure-isle' ) ),
			'news_consent' => array( __( 'Consent checkbox text', 'azure-isle' ), 'text', __( 'I agree to the Privacy Policy', 'azure-isle' ) ),
			'news_action'  => array( __( 'Form action URL (Mailchimp etc.; field name "email")', 'azure-isle' ), 'url', '' ),
		),
	);

	$s['footer'] = array(
		'panel'  => 'site',
		'title'  => __( 'Footer & Contact Details', 'azure-isle' ),
		'fields' => array(
			'address'       => array( __( 'Address', 'azure-isle' ), 'textarea', __( '12 Lagoon Road, Coral Bay', 'azure-isle' ) ),
			'phone'         => array( __( 'Phone', 'azure-isle' ), 'text', '+1 (555) 010-2400' ),
			'email'         => array( __( 'Email', 'azure-isle' ), 'email', 'reservations@example.com' ),
			'facebook_url'  => array( __( 'Facebook URL', 'azure-isle' ), 'url', '' ),
			'x_url'         => array( __( 'X / Twitter URL', 'azure-isle' ), 'url', '' ),
			'instagram_url' => array( __( 'Instagram URL', 'azure-isle' ), 'url', '' ),
			'youtube_url'   => array( __( 'YouTube URL', 'azure-isle' ), 'url', '' ),
			'copyright'     => array( __( 'Copyright text (after © year)', 'azure-isle' ), 'text', '' ),
		),
	);

	/* ---------- Front page ---------- */

	$s['hero'] = array(
		'panel'  => 'front',
		'title'  => __( 'Hero', 'azure-isle' ),
		'fields' => array(
			'hero_image' => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
			'hero_title' => array( __( 'Title', 'azure-isle' ), 'text', __( 'Boutique Private Island Resort', 'azure-isle' ) ),
			'hero_text'  => array( __( 'Subtitle', 'azure-isle' ), 'textarea', __( 'The seaside haven of warmth, tranquility and restoration', 'azure-isle' ) ),
		),
	);

	$s['welcome'] = array(
		'panel'  => 'front',
		'title'  => __( 'Welcome', 'azure-isle' ),
		'fields' => array(
			'welcome_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Welcome to Azure Isle Resort', 'azure-isle' ) ),
			'welcome_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'In the Heart of the South Pacific, Outstanding Views', 'azure-isle' ) ),
			'welcome_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'Nestled in the heart of the Pacific Islands resort, on the edge of a tranquil and beautiful island, Azure Isle is a haven of warmth, tranquility and rejuvenation. Bathed in brilliant sunshine and clear skies, it offers stunning views of palm-lined beaches and gorgeous coral reefs.', 'azure-isle' ) ),
		),
	);

	$car = array(
		'carousel_script' => array( __( 'Handwritten line under the images', 'azure-isle' ), 'textarea', __( 'Inspired by our history, surrounded by nature and designed to offer a different experience', 'azure-isle' ) ),
	);
	for ( $n = 1; $n <= 6; $n++ ) {
		/* translators: %d: image number. */
		$car[ "carousel_{$n}" ] = array( sprintf( __( 'Image %d', 'azure-isle' ), $n ), 'image', 0 );
	}
	$s['carousel'] = array(
		'panel'       => 'front',
		'title'       => __( 'Image Carousel', 'azure-isle' ),
		'description' => __( 'Also shown on the About page.', 'azure-isle' ),
		'fields'      => $car,
	);

	$s['video'] = array(
		'panel'  => 'front',
		'title'  => __( 'Video Band', 'azure-isle' ),
		'fields' => array(
			'video_show'  => array( __( 'Show this section', 'azure-isle' ), 'select', 'yes', $yes ),
			'video_image' => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
			'video_url'   => array( __( 'Video URL (YouTube or Vimeo; empty hides the play button)', 'azure-isle' ), 'url', '' ),
		),
	);

	$s['rooms'] = array(
		'panel'       => 'front',
		'title'       => __( 'Accommodations', 'azure-isle' ),
		'description' => __( 'The room cards come from Rooms in the admin menu (ordered by the Order field).', 'azure-isle' ),
		'fields'      => array(
			'rooms_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Make Yourself at Home', 'azure-isle' ) ),
			'rooms_title'   => array( __( 'Title', 'azure-isle' ), 'text', __( 'The Accommodations', 'azure-isle' ) ),
			'rooms_text'    => array( __( 'Text (Rooms archive page)', 'azure-isle' ), 'textarea', __( 'Natural materials, soft light and a view of the water from every one.', 'azure-isle' ) ),
			'rooms_button'  => array( __( 'Button label', 'azure-isle' ), 'text', __( 'Discover All Rooms', 'azure-isle' ) ),
			'rooms_count'   => array( __( 'Number of rooms in the slider', 'azure-isle' ), 'select', '6', array( '3' => '3', '6' => '6', '9' => '9' ) ),
		),
	);

	$loc_defaults = array(
		1 => array( __( 'Spa & Wellness', 'azure-isle' ), __( 'Set in lush jungle, our modern spa embodies the calm of nature, offering exclusive rituals and wellness experiences for body and mind.', 'azure-isle' ) ),
		2 => array( __( 'Island Activities', 'azure-isle' ), __( 'A playground for the sea and underwater world: diving, snorkeling, fishing, sailing, nature trails and villages to explore.', 'azure-isle' ) ),
		3 => array( __( 'Gastronomic Dine', 'azure-isle' ), __( 'Our restaurants use fresh, organic ingredients that are locally produced and sourced. Delicious flavors and a warm atmosphere are the perfect mix.', 'azure-isle' ) ),
	);
	$loc = array(
		'loc_image'   => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
		'loc_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Unforgettable Experiences', 'azure-isle' ) ),
		'loc_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'One of the World’s Most Desirable Locations', 'azure-isle' ) ),
		'loc_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'A luxurious, private resort embodying the very best of island leisure, luxury, simplicity and relaxation.', 'azure-isle' ) ),
	);
	foreach ( $loc_defaults as $n => $d ) {
		/* translators: %d: card number. */
		$loc[ "loc_{$n}_image" ] = array( sprintf( __( 'Card %d image', 'azure-isle' ), $n ), 'image', 0 );
		/* translators: %d: card number. */
		$loc[ "loc_{$n}_title" ] = array( sprintf( __( 'Card %d title (empty hides it)', 'azure-isle' ), $n ), 'text', $d[0] );
		/* translators: %d: card number. */
		$loc[ "loc_{$n}_text" ] = array( sprintf( __( 'Card %d text', 'azure-isle' ), $n ), 'textarea', $d[1] );
		/* translators: %d: card number. */
		$loc[ "loc_{$n}_url" ] = array( sprintf( __( 'Card %d link URL (empty links to the About page)', 'azure-isle' ), $n ), 'url', '' );
	}
	$s['locations'] = array(
		'panel'  => 'front',
		'title'  => __( 'Experiences', 'azure-isle' ),
		'fields' => $loc,
	);

	$rev_defaults = array(
		1 => __( 'Everything here was great: the staff, the room layout, the property amenities with the infinity pool, and the quality of the food. But the high point is the view of the lagoon.', 'azure-isle' ),
		2 => __( 'The overwater villa felt completely private. Snorkeling right off our own steps was the highlight of the whole trip.', 'azure-isle' ),
		3 => __( 'Quiet, beautiful and genuinely relaxing. The beach dinner on our anniversary is something we will talk about for years.', 'azure-isle' ),
	);
	$rev = array(
		'reviews_image'   => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
		'reviews_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Voice From Our Guests', 'azure-isle' ) ),
	);
	foreach ( $rev_defaults as $n => $quote ) {
		/* translators: %d: review number. */
		$rev[ "review_{$n}_quote" ] = array( sprintf( __( 'Review %d quote (empty hides it)', 'azure-isle' ), $n ), 'textarea', $quote );
		/* translators: %d: review number. */
		$rev[ "review_{$n}_name" ] = array( sprintf( __( 'Review %d guest name', 'azure-isle' ), $n ), 'text', __( 'Guest Name', 'azure-isle' ) );
		/* translators: %d: review number. */
		$rev[ "review_{$n}_from" ] = array( sprintf( __( 'Review %d source (e.g. Tripadvisor)', 'azure-isle' ), $n ), 'text', __( 'Tripadvisor', 'azure-isle' ) );
	}
	$s['reviews'] = array(
		'panel'       => 'front',
		'title'       => __( 'Guest Reviews', 'azure-isle' ),
		'description' => __( 'Also shown on the About page. The defaults are sample text; replace them with real reviews.', 'azure-isle' ),
		'fields'      => $rev,
	);

	$serv_defaults = array(
		1 => array( 'car', __( 'Airport Pick-up Service', 'azure-isle' ) ),
		2 => array( 'key', __( 'Housekeeper Services', 'azure-isle' ) ),
		3 => array( 'wifi', __( 'Wifi & Internet', 'azure-isle' ) ),
		4 => array( 'laundry', __( 'Laundry Services', 'azure-isle' ) ),
		5 => array( 'cup', __( 'Breakfast in Bed', 'azure-isle' ) ),
		6 => array( 'pool', __( 'Swimming Pool', 'azure-isle' ) ),
	);
	$serv = array(
		'serv_image_1' => array( __( 'Tall image (left)', 'azure-isle' ), 'image', 0 ),
		'serv_image_2' => array( __( 'Wide image (right, below the list)', 'azure-isle' ), 'image', 0 ),
		'serv_script'  => array( __( 'Handwritten line under the tall image', 'azure-isle' ), 'textarea', __( 'Inspired by our history, surrounded by nature and designed to offer a different experience', 'azure-isle' ) ),
		'serv_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Discover the Services We Offer', 'azure-isle' ) ),
		'serv_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'All the Essentials for a Cozy and Comfortable Stay', 'azure-isle' ) ),
	);
	foreach ( $serv_defaults as $n => $d ) {
		/* translators: %d: service number. */
		$serv[ "serv_{$n}_icon" ] = array( sprintf( __( 'Service %d icon', 'azure-isle' ), $n ), 'select', $d[0], azure_icon_choices() );
		/* translators: %d: service number. */
		$serv[ "serv_{$n}_title" ] = array( sprintf( __( 'Service %d title (empty hides it)', 'azure-isle' ), $n ), 'text', $d[1] );
		/* translators: %d: service number. */
		$serv[ "serv_{$n}_text" ] = array( sprintf( __( 'Service %d text', 'azure-isle' ), $n ), 'textarea', __( 'Arranged on request by our front desk, available every day of your stay.', 'azure-isle' ) );
	}
	$s['services'] = array(
		'panel'  => 'front',
		'title'  => __( 'Services', 'azure-isle' ),
		'fields' => $serv,
	);

	/* ---------- About page ---------- */

	$s['about_hero'] = array(
		'panel'       => 'about',
		'title'       => __( 'Page Header', 'azure-isle' ),
		'description' => __( 'Used by pages with the "About Page" template.', 'azure-isle' ),
		'fields'      => array(
			'about_hero_image'   => array( __( 'Background image (empty uses the page’s Featured Image)', 'azure-isle' ), 'image', 0 ),
			'about_hero_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Discover Azure Isle', 'azure-isle' ) ),
			'about_hero_text'    => array( __( 'Subtitle (the title is the page title)', 'azure-isle' ), 'textarea', __( 'A private island retreat where every day moves to the rhythm of the tide.', 'azure-isle' ) ),
		),
	);

	$s['about_intro'] = array(
		'panel'  => 'about',
		'title'  => __( 'Introduction', 'azure-isle' ),
		'fields' => array(
			'about_intro_image_1' => array( __( 'Large image', 'azure-isle' ), 'image', 0 ),
			'about_intro_image_2' => array( __( 'Small overlapping image', 'azure-isle' ), 'image', 0 ),
			'about_intro_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Luxury Hotel & Resort', 'azure-isle' ) ),
			'about_intro_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'A Barefoot Escape Surrounded by Turquoise Water', 'azure-isle' ) ),
			'about_intro_lede'    => array( __( 'Lead paragraph', 'azure-isle' ), 'textarea', __( 'Tucked into a crescent of coral sand, our resort is made for slowing down. Rooms and villas sit between the palms and the lagoon, each designed to let the breeze and the view do most of the work.', 'azure-isle' ) ),
			'about_intro_text'    => array( __( 'Paragraph', 'azure-isle' ), 'textarea', __( 'Since we opened our doors, we have welcomed travelers who come for the sea and stay for the people. Our team is made up of islanders who know every reef, trail and sunset spot, and who are happy to share them with you.', 'azure-isle' ) ),
			'about_signature'     => array( __( 'Signature (handwritten)', 'azure-isle' ), 'text', __( 'Anna Williams', 'azure-isle' ) ),
			'about_signature_by'  => array( __( 'Signature role', 'azure-isle' ), 'text', __( 'General Manager', 'azure-isle' ) ),
		),
	);

	$stat_defaults = array(
		1 => array( '25', __( 'Years of Hospitality', 'azure-isle' ) ),
		2 => array( '48', __( 'Rooms & Villas', 'azure-isle' ) ),
		3 => array( '3', __( 'Restaurants & Bars', 'azure-isle' ) ),
		4 => array( '1.2 km', __( 'Private Beach', 'azure-isle' ) ),
	);
	$stats = array(
		'about_stats_image' => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
	);
	foreach ( $stat_defaults as $n => $d ) {
		/* translators: %d: stat number. */
		$stats[ "about_stat_{$n}_num" ] = array( sprintf( __( 'Stat %d number (empty hides it)', 'azure-isle' ), $n ), 'text', $d[0] );
		/* translators: %d: stat number. */
		$stats[ "about_stat_{$n}_label" ] = array( sprintf( __( 'Stat %d label', 'azure-isle' ), $n ), 'text', $d[1] );
	}
	$s['about_stats'] = array(
		'panel'  => 'about',
		'title'  => __( 'Facts & Figures', 'azure-isle' ),
		'fields' => $stats,
	);

	$val_defaults = array(
		1 => array( 'leaf', __( 'Rooted in Nature', 'azure-isle' ), __( 'Built with local timber and stone, powered by the sun, and designed to leave the island as we found it.', 'azure-isle' ) ),
		2 => array( 'heart', __( 'Warm Island Service', 'azure-isle' ), __( 'A small team who learn your name on the first day and your favorite drink by the second.', 'azure-isle' ) ),
		3 => array( 'waves', __( 'Life on the Water', 'azure-isle' ), __( 'Snorkeling, sailing and paddling from the beach, with gear and guides always ready.', 'azure-isle' ) ),
	);
	$vals = array(
		'about_values_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'What Makes Us Different', 'azure-isle' ) ),
		'about_values_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Simple Pleasures, Beautifully Done', 'azure-isle' ) ),
	);
	foreach ( $val_defaults as $n => $d ) {
		/* translators: %d: item number. */
		$vals[ "about_value_{$n}_icon" ] = array( sprintf( __( 'Item %d icon', 'azure-isle' ), $n ), 'select', $d[0], azure_icon_choices() );
		/* translators: %d: item number. */
		$vals[ "about_value_{$n}_title" ] = array( sprintf( __( 'Item %d title (empty hides it)', 'azure-isle' ), $n ), 'text', $d[1] );
		/* translators: %d: item number. */
		$vals[ "about_value_{$n}_text" ] = array( sprintf( __( 'Item %d text', 'azure-isle' ), $n ), 'textarea', $d[2] );
	}
	$s['about_values'] = array(
		'panel'  => 'about',
		'title'  => __( 'Values', 'azure-isle' ),
		'fields' => $vals,
	);

	$s['about_story'] = array(
		'panel'  => 'about',
		'title'  => __( 'Our Story', 'azure-isle' ),
		'fields' => array(
			'about_story_image'   => array( __( 'Image', 'azure-isle' ), 'image', 0 ),
			'about_story_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Our Story', 'azure-isle' ) ),
			'about_story_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'From a Family Beach House to an Island Hideaway', 'azure-isle' ) ),
			'about_story_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'It started with a single house on the sand and a few friends who never wanted to leave. Over the years we added rooms, then villas, then a spa in the garden, but the spirit has stayed the same: good food, easy days and the ocean at your door.', 'azure-isle' ) ),
			'about_story_button'  => array( __( 'Button label', 'azure-isle' ), 'text', __( 'Explore Our Rooms', 'azure-isle' ) ),
			'about_story_url'     => array( __( 'Button URL (empty links to Rooms)', 'azure-isle' ), 'url', '' ),
		),
	);

	$s['about_extras'] = array(
		'panel'  => 'about',
		'title'  => __( 'Shared Sections', 'azure-isle' ),
		'fields' => array(
			'about_show_carousel' => array( __( 'Show the image carousel', 'azure-isle' ), 'select', 'yes', $yes ),
			'about_show_services' => array( __( 'Show the services section', 'azure-isle' ), 'select', 'yes', $yes ),
			'about_show_reviews'  => array( __( 'Show guest reviews', 'azure-isle' ), 'select', 'yes', $yes ),
		),
	);

	/* ---------- Contact page ---------- */

	$s['contact_hero'] = array(
		'panel'       => 'contact',
		'title'       => __( 'Page Header', 'azure-isle' ),
		'description' => __( 'Used by pages with the "Contact Page" template. Address, phone and email come from Site Settings → Footer & Contact Details.', 'azure-isle' ),
		'fields'      => array(
			'contact_hero_image'   => array( __( 'Background image (empty uses the page’s Featured Image)', 'azure-isle' ), 'image', 0 ),
			'contact_hero_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Get in Touch', 'azure-isle' ) ),
			'contact_hero_text'    => array( __( 'Subtitle (the title is the page title)', 'azure-isle' ), 'textarea', __( 'Questions, special requests or plans for a celebration — we would love to hear from you.', 'azure-isle' ) ),
		),
	);

	$s['contact_info'] = array(
		'panel'  => 'contact',
		'title'  => __( 'Contact Details', 'azure-isle' ),
		'fields' => array(
			'contact_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Contact Information', 'azure-isle' ) ),
			'contact_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'We’re Here to Help Plan Your Stay', 'azure-isle' ) ),
			'contact_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'Our reservations team answers every message within one day. For anything urgent during your stay, reception is open around the clock.', 'azure-isle' ) ),
			'contact_hours'   => array( __( 'Opening hours', 'azure-isle' ), 'textarea', __( "Reception: 24 hours\nReservations: 8:00 am – 8:00 pm", 'azure-isle' ) ),
		),
	);

	$s['contact_form'] = array(
		'panel'  => 'contact',
		'title'  => __( 'Contact Form', 'azure-isle' ),
		'fields' => array(
			'form_image'   => array( __( 'Image beside the form', 'azure-isle' ), 'image', 0 ),
			'form_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Send Us a Message', 'azure-isle' ) ),
			'form_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Have a Question? Write to Us', 'azure-isle' ) ),
			'form_to'      => array( __( 'Send messages to (empty uses the site admin email)', 'azure-isle' ), 'email', '' ),
			'form_success' => array( __( 'Message shown after sending', 'azure-isle' ), 'text', __( 'Thank you — your message has been sent. We will reply shortly.', 'azure-isle' ) ),
		),
	);

	$s['contact_map'] = array(
		'panel'  => 'contact',
		'title'  => __( 'Map', 'azure-isle' ),
		'fields' => array(
			'map_show'  => array( __( 'Show map', 'azure-isle' ), 'select', 'yes', $yes ),
			'map_query' => array( __( 'Map location (empty uses the address)', 'azure-isle' ), 'text', '' ),
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
	$panels = array(
		'site'    => __( 'Azure Isle — Site Settings', 'azure-isle' ),
		'front'   => __( 'Azure Isle — Front Page', 'azure-isle' ),
		'about'   => __( 'Azure Isle — About Page', 'azure-isle' ),
		'contact' => __( 'Azure Isle — Contact Page', 'azure-isle' ),
	);
	$priority = 24;
	foreach ( $panels as $panel_id => $panel_title ) {
		$wp_customize->add_panel(
			'azure_' . $panel_id,
			array(
				'title'    => $panel_title,
				'priority' => $priority++,
			)
		);
	}

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
				'panel'       => 'azure_' . $section['panel'],
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
