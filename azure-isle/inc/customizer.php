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
			'logo_subtitle' => array( __( 'Text under the site name', 'azure-isle' ), 'text', __( 'Kenedy, Texas', 'azure-isle' ) ),
			'header_phone'  => array( __( 'Phone shown in the header', 'azure-isle' ), 'text', '' ),
			'header_button' => array( __( 'Header button label (empty hides it)', 'azure-isle' ), 'text', __( 'Contact Us', 'azure-isle' ) ),
			'booking_url'   => array( __( 'Header button URL (empty links to the Contact page)', 'azure-isle' ), 'url', '' ),
		),
	);

	$s['cta'] = array(
		'panel'       => 'site',
		'title'       => __( 'Call to Action', 'azure-isle' ),
		'description' => __( 'Shown above the footer on every page. The first button links like the header button; the second to the apartments.', 'azure-isle' ),
		'fields'      => array(
			'cta_show'     => array( __( 'Show call to action band', 'azure-isle' ), 'select', 'yes', $yes ),
			'cta_image'    => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
			'cta_eyebrow'  => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Kenedy Retreat', 'azure-isle' ) ),
			'cta_title'    => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'All Utilities Are Included', 'azure-isle' ) ),
			'cta_text'     => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'Fully furnished apartments with full-size appliances, all housewares and linens, expanded cable and internet, housekeeping, and more.', 'azure-isle' ) ),
			'cta_button'   => array( __( 'First button label (empty hides it)', 'azure-isle' ), 'text', __( 'Contact Us', 'azure-isle' ) ),
			'cta_button_2' => array( __( 'Second button label (empty hides it)', 'azure-isle' ), 'text', __( 'View Apartments', 'azure-isle' ) ),
		),
	);

	$s['footer'] = array(
		'panel'  => 'site',
		'title'  => __( 'Footer & Contact Details', 'azure-isle' ),
		'fields' => array(
			'address'       => array( __( 'Address', 'azure-isle' ), 'textarea', __( "1401 Escondido St. (Business 181)\nat Graham Rd., Kenedy, Texas", 'azure-isle' ) ),
			'phone'         => array( __( 'Phone', 'azure-isle' ), 'text', '' ),
			'email'         => array( __( 'Email', 'azure-isle' ), 'email', '' ),
			'facebook_url'  => array( __( 'Facebook URL', 'azure-isle' ), 'url', '' ),
			'x_url'         => array( __( 'X / Twitter URL', 'azure-isle' ), 'url', '' ),
			'instagram_url' => array( __( 'Instagram URL', 'azure-isle' ), 'url', '' ),
			'youtube_url'   => array( __( 'YouTube URL', 'azure-isle' ), 'url', '' ),
			'copyright'     => array( __( 'Copyright text (after © year)', 'azure-isle' ), 'text', __( 'Kenedy Retreat. All Rights Reserved.', 'azure-isle' ) ),
		),
	);

	/* ---------- Front page ---------- */

	$s['hero'] = array(
		'panel'  => 'front',
		'title'  => __( 'Hero', 'azure-isle' ),
		'fields' => array(
			'hero_image' => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
			'hero_title' => array( __( 'Title', 'azure-isle' ), 'text', __( 'Kenedy Retreat', 'azure-isle' ) ),
			'hero_text'  => array( __( 'Subtitle', 'azure-isle' ), 'textarea', __( 'The newest and nicest accommodations in Kenedy, Texas', 'azure-isle' ) ),
		),
	);

	$s['welcome'] = array(
		'panel'  => 'front',
		'title'  => __( 'Welcome', 'azure-isle' ),
		'fields' => array(
			'welcome_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Welcome to Kenedy Retreat', 'azure-isle' ) ),
			'welcome_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Fully Furnished Apartments in Kenedy, TX', 'azure-isle' ) ),
			'welcome_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'The newest and nicest accommodations in Kenedy, Texas is at Kenedy Retreat at 1401 Escondido St. (Business 181) at Graham Rd. We are just one block off the main Highway 181.', 'azure-isle' ) ),
		),
	);

	$car = array(
		'carousel_script' => array( __( 'Handwritten line under the images', 'azure-isle' ), 'textarea', __( 'Kenedy Retreat has great indoor and outdoor common area amenities', 'azure-isle' ) ),
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
			'rooms_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Our Rooms', 'azure-isle' ) ),
			'rooms_title'   => array( __( 'Title', 'azure-isle' ), 'text', __( 'Apartments', 'azure-isle' ) ),
			'rooms_text'    => array( __( 'Text (Rooms archive page)', 'azure-isle' ), 'textarea', __( 'Some of our 90 bedrooms have single queen beds and others have two full-size XL beds with luxury linens and flat screen TV’s with an “extended” Direct TV package that includes extensive sports channel programming and all windows are covered with quality blackout draperies.', 'azure-isle' ) ),
			'rooms_button'  => array( __( 'Button label', 'azure-isle' ), 'text', __( 'View All Apartments', 'azure-isle' ) ),
			'rooms_count'   => array( __( 'Number of rooms in the slider', 'azure-isle' ), 'select', '6', array( '3' => '3', '6' => '6', '9' => '9' ) ),
		),
	);

	$loc_defaults = array(
		1 => array( __( 'Recreation Room', 'azure-isle' ), __( 'Our indoor/outdoor recreation building has a fridge with ice as well as a stand-alone icemaker. There is also a pool table and a long shuffle board table.', 'azure-isle' ) ),
		2 => array( __( 'Flagstone Patio & Fire Pit', 'azure-isle' ), __( 'Just outside the covered patio is a large flagstone patio complete with fire pit and ample seating.', 'azure-isle' ) ),
		3 => array( __( 'Outdoor Games', 'azure-isle' ), __( 'Outdoor amenities include horse shoes, basketball, bocce ball and fire pit.', 'azure-isle' ) ),
	);
	$loc = array(
		'loc_image'   => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
		'loc_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Amenities', 'azure-isle' ) ),
		'loc_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Kenedy Retreat has great indoor and outdoor common area amenities', 'azure-isle' ) ),
		'loc_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'Our recreation room has numerous flat screen TV’s with Direct TV including the NFL Sunday Ticket. There is counter space with refrigerator for BYOB as well as an ice machine. There is also a long, custom-made shuffle board table and a pool table.', 'azure-isle' ) ),
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
		1 => '',
		2 => '',
		3 => '',
	);
	$rev = array(
		'reviews_image'   => array( __( 'Background image', 'azure-isle' ), 'image', 0 ),
		'reviews_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Voice From Our Guests', 'azure-isle' ) ),
	);
	foreach ( $rev_defaults as $n => $quote ) {
		/* translators: %d: review number. */
		$rev[ "review_{$n}_quote" ] = array( sprintf( __( 'Review %d quote (empty hides it)', 'azure-isle' ), $n ), 'textarea', $quote );
		/* translators: %d: review number. */
		$rev[ "review_{$n}_name" ] = array( sprintf( __( 'Review %d guest name', 'azure-isle' ), $n ), 'text', '' );
		/* translators: %d: review number. */
		$rev[ "review_{$n}_from" ] = array( sprintf( __( 'Review %d source (e.g. Tripadvisor)', 'azure-isle' ), $n ), 'text', '' );
	}
	$s['reviews'] = array(
		'panel'       => 'front',
		'title'       => __( 'Guest Reviews', 'azure-isle' ),
		'description' => __( 'Also shown on the About page. Add real guest reviews here; the section stays hidden until at least one quote is filled in.', 'azure-isle' ),
		'fields'      => $rev,
	);

	$serv_defaults = array(
		1 => array( 'wifi', __( 'Utilities & Internet', 'azure-isle' ), __( 'All apartments have paid utilities including high speed wireless internet.', 'azure-isle' ) ),
		2 => array( 'key', __( 'Housekeeping', 'azure-isle' ), __( 'We provide weekly housekeeping including linens.', 'azure-isle' ) ),
		3 => array( 'tv', __( 'DirectTV', 'azure-isle' ), __( 'The DirectTV basic package includes extended sports programming as well as premium movie channels.', 'azure-isle' ) ),
		4 => array( 'laundry', __( 'Washer & Dryer', 'azure-isle' ), __( 'Full-size washer and dryer in every unit.', 'azure-isle' ) ),
		5 => array( 'cup', __( 'Full-Size Kitchens', 'azure-isle' ), __( 'Full-size kitchen appliances, full-size fridge with icemaker, pantry, closet, dining room table and two chairs.', 'azure-isle' ) ),
		6 => array( 'sun', __( 'BBQ Pits & Smoker', 'azure-isle' ), __( 'We install numerous BBQ pits so guests don’t have to go far to enjoy a nice outdoor cookout.', 'azure-isle' ) ),
	);
	$serv = array(
		'serv_image_1' => array( __( 'Tall image (left)', 'azure-isle' ), 'image', 0 ),
		'serv_image_2' => array( __( 'Wide image (right, below the list)', 'azure-isle' ), 'image', 0 ),
		'serv_script'  => array( __( 'Handwritten line under the tall image', 'azure-isle' ), 'textarea', __( 'As close to home comfort as you can get', 'azure-isle' ) ),
		'serv_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'All Utilities Are Included', 'azure-isle' ) ),
		'serv_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Full-Size Appliances, Housewares and Linens, Expanded Cable and Internet, Housekeeping, and More', 'azure-isle' ) ),
	);
	foreach ( $serv_defaults as $n => $d ) {
		/* translators: %d: service number. */
		$serv[ "serv_{$n}_icon" ] = array( sprintf( __( 'Service %d icon', 'azure-isle' ), $n ), 'select', $d[0], azure_icon_choices() );
		/* translators: %d: service number. */
		$serv[ "serv_{$n}_title" ] = array( sprintf( __( 'Service %d title (empty hides it)', 'azure-isle' ), $n ), 'text', $d[1] );
		/* translators: %d: service number. */
		$serv[ "serv_{$n}_text" ] = array( sprintf( __( 'Service %d text', 'azure-isle' ), $n ), 'textarea', $d[2] );
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
			'about_hero_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Discover Kenedy Retreat', 'azure-isle' ) ),
			'about_hero_text'    => array( __( 'Subtitle (the title is the page title)', 'azure-isle' ), 'textarea', __( 'We are just one block off the main Highway 181.', 'azure-isle' ) ),
		),
	);

	$s['about_intro'] = array(
		'panel'  => 'about',
		'title'  => __( 'Introduction', 'azure-isle' ),
		'fields' => array(
			'about_intro_image_1' => array( __( 'Large image', 'azure-isle' ), 'image', 0 ),
			'about_intro_image_2' => array( __( 'Small overlapping image', 'azure-isle' ), 'image', 0 ),
			'about_intro_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Kenedy Retreat', 'azure-isle' ) ),
			'about_intro_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'There are 90 bedrooms available at Kenedy Retreat', 'azure-isle' ) ),
			'about_intro_lede'    => array( __( 'Lead paragraph', 'azure-isle' ), 'textarea', __( 'Kenedy Retreat’s fully furnished apartments offer several spacious floor plans to choose from making for the ideal, comfortable stay while in Kenedy, TX. This one of a kind complex is packed with amenities including an indoor-outdoor recreation areas. All utilities are included in addition to full-size appliances, all housewares and linens, expanded cable and internet, housekeeping, and more. The one-bedroom apartments offer the flexibility for the traveling workers to be set up as single or double occupancy.', 'azure-isle' ) ),
			'about_intro_text'    => array( __( 'Paragraph', 'azure-isle' ), 'textarea', __( 'We have 400 square foot suites and 800 square foot two-bedroom, two bathroom units. Each of our 400 and 800 square foot options have full-size kitchens as well as a full-size washer and dryer in every unit.', 'azure-isle' ) ),
			'about_signature'     => array( __( 'Signature (handwritten)', 'azure-isle' ), 'text', '' ),
			'about_signature_by'  => array( __( 'Signature role', 'azure-isle' ), 'text', '' ),
		),
	);

	$stat_defaults = array(
		1 => array( '90', __( 'Bedrooms', 'azure-isle' ) ),
		2 => array( '400', __( 'Square Foot Suites', 'azure-isle' ) ),
		3 => array( '800', __( 'Square Foot Suites', 'azure-isle' ) ),
		4 => array( '1', __( 'Block off Highway 181', 'azure-isle' ) ),
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
		1 => array( 'laundry', __( 'Full-Size Appliances', 'azure-isle' ), __( 'Full-size washer and dryer in each unit, a full-size oven, dishwasher and a refrigerator with icemaker.', 'azure-isle' ) ),
		2 => array( 'cup', __( 'Fully Stocked Kitchen', 'azure-isle' ), __( 'There is a fully stocked kitchen including utensils, kitchenware, coffee maker, iron and ironing board, toaster and more. A complete list of provided items is available upon request.', 'azure-isle' ) ),
		3 => array( 'bed', __( 'Luxury Linens', 'azure-isle' ), __( 'Queen or full-size XL beds with luxury linens, flat screen TV’s and quality blackout draperies on all windows.', 'azure-isle' ) ),
	);
	$vals = array(
		'about_values_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Interior', 'azure-isle' ) ),
		'about_values_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Our efficiency suites are almost 400 square feet of living space', 'azure-isle' ) ),
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
			'about_story_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Amenities', 'azure-isle' ) ),
			'about_story_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Just outside the roll up garage doors…', 'azure-isle' ) ),
			'about_story_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'You will find a large covered patio with a ceiling fan, seating and a flat screen TV. Beyond the covered patio there are two horse shoe pits, a large fire pit with seating, a huge smoker and our popular bocce ball court.', 'azure-isle' ) ),
			'about_story_button'  => array( __( 'Button label', 'azure-isle' ), 'text', __( 'View Apartments', 'azure-isle' ) ),
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

	/* ---------- Gallery page ---------- */

	$s['gallery_page'] = array(
		'panel'       => 'gallery',
		'title'       => __( 'Gallery Page', 'azure-isle' ),
		'description' => __( 'Used by pages with the "Gallery Page" template. The photos are the Gallery block (or [gallery] shortcode) in the page editor; captions come from each image.', 'azure-isle' ),
		'fields'      => array(
			'gallery_hero_image'   => array( __( 'Banner image (empty uses the page’s Featured Image)', 'azure-isle' ), 'image', 0 ),
			'gallery_hero_eyebrow' => array( __( 'Banner small heading', 'azure-isle' ), 'text', __( 'Kenedy Retreat', 'azure-isle' ) ),
			'gallery_hero_text'    => array( __( 'Banner subtitle (the title is the page title)', 'azure-isle' ), 'textarea', __( 'The newest and nicest accommodations in Kenedy, Texas', 'azure-isle' ) ),
			'gallery_eyebrow'      => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Gallery', 'azure-isle' ) ),
			'gallery_title'        => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'Explore Our Gallery', 'azure-isle' ) ),
			'gallery_text'         => array( __( 'Text', 'azure-isle' ), 'textarea', '' ),
		),
	);

	/* ---------- Contact page ---------- */

	$s['contact_hero'] = array(
		'panel'       => 'contact',
		'title'       => __( 'Page Header', 'azure-isle' ),
		'description' => __( 'Used by pages with the "Contact Page" template. Address, phone and email come from Site Settings → Footer & Contact Details.', 'azure-isle' ),
		'fields'      => array(
			'contact_hero_image'   => array( __( 'Background image (empty uses the page’s Featured Image)', 'azure-isle' ), 'image', 0 ),
			'contact_hero_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Contact Us', 'azure-isle' ) ),
			'contact_hero_text'    => array( __( 'Subtitle (the title is the page title)', 'azure-isle' ), 'textarea', __( 'The newest and nicest accommodations in Kenedy, Texas is at Kenedy Retreat at 1401 Escondido St. (Business 181) at Graham Rd.', 'azure-isle' ) ),
		),
	);

	$s['contact_info'] = array(
		'panel'  => 'contact',
		'title'  => __( 'Contact Details', 'azure-isle' ),
		'fields' => array(
			'contact_eyebrow' => array( __( 'Small heading', 'azure-isle' ), 'text', __( 'Kenedy Retreat', 'azure-isle' ) ),
			'contact_title'   => array( __( 'Title', 'azure-isle' ), 'textarea', __( 'We Are Just One Block off the Main Highway 181', 'azure-isle' ) ),
			'contact_text'    => array( __( 'Text', 'azure-isle' ), 'textarea', __( 'Questions about our apartments or availability? Send us a message and we will get back to you.', 'azure-isle' ) ),
			'contact_hours'   => array( __( 'Opening hours', 'azure-isle' ), 'textarea', '' ),
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
			'map_query' => array( __( 'Map location (empty uses the address)', 'azure-isle' ), 'text', '1401 Escondido St, Kenedy, TX' ),
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
		'gallery' => __( 'Azure Isle — Gallery Page', 'azure-isle' ),
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
