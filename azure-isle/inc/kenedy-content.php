<?php
/**
 * Kenedy Retreat photos: bundled in assets/images/kenedy/ and imported once
 * into the Media Library, then assigned to the Customizer image slots and to
 * the apartments' Featured Images. Slots that already have an image are left
 * alone, and every image can still be changed in the Customizer.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer image setting => bundled file.
 */
function azure_kenedy_images() {
	return array(
		'hero_image'          => 'img-1.jpg',
		'carousel_1'          => 'Amenities.jpg',
		'carousel_2'          => 'IMG_1198.jpeg',
		'carousel_3'          => 'img-8.jpg',
		'carousel_4'          => 'img-2.jpg',
		'carousel_5'          => 'img-18.jpg',
		'carousel_6'          => 'img-13.jpg',
		'video_image'         => 'h-img01.jpg',
		'loc_image'           => 'img-7.jpg',
		'loc_1_image'         => 'img-9.jpg',
		'loc_2_image'         => 'img-3.jpg',
		'loc_3_image'         => 'img-11.jpg',
		'serv_image_1'        => 'IMG_5520.jpeg',
		'serv_image_2'        => 'IMG_5722-2.jpeg',
		'cta_image'           => 'IMG_5651.jpeg',
		'about_hero_image'    => 'img-5.jpg',
		'about_intro_image_1' => 'IMG_5530.jpeg',
		'about_intro_image_2' => 'img-15.jpg',
		'about_stats_image'   => 'IMG_5658.jpeg',
		'about_story_image'   => 'IMG_1198.jpeg',
		'contact_hero_image'  => 'img-6.jpg',
		'gallery_hero_image'  => 'IMG_5612.jpeg',
		'form_image'          => 'img-1.jpg',
	);
}

/**
 * Attachment ID for a bundled photo, importing it the first time.
 *
 * @param string $file File name in assets/images/kenedy/.
 * @return int 0 on failure.
 */
function azure_kenedy_attachment( $file ) {
	$media = get_option( 'azure_kenedy_media', array() );
	if ( ! empty( $media[ $file ] ) && wp_attachment_is_image( $media[ $file ] ) ) {
		return (int) $media[ $file ];
	}

	$source = AZURE_DIR . '/assets/images/kenedy/' . $file;
	if ( ! file_exists( $source ) ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$tmp = wp_tempnam( $file );
	if ( ! $tmp || ! copy( $source, $tmp ) ) {
		return 0;
	}
	$id = media_handle_sideload(
		array(
			'name'     => $file,
			'tmp_name' => $tmp,
		),
		0,
		__( 'Kenedy Retreat', 'azure-isle' )
	);
	if ( is_wp_error( $id ) ) {
		wp_delete_file( $tmp );
		return 0;
	}

	$media[ $file ] = (int) $id;
	update_option( 'azure_kenedy_media', $media, false );
	return (int) $id;
}

/**
 * Gallery photos in the order of the Kenedy Retreat gallery, with captions.
 */
function azure_kenedy_gallery() {
	return array(
		'img-11.jpg'      => __( 'Fabulous outdoor amenities include bocce ball and horse shoe pits.', 'azure-isle' ),
		'IMG_5513.jpeg'   => __( 'Other side of the bathroom of an efficiency size apartment', 'azure-isle' ),
		'IMG_5517.jpeg'   => __( 'Bathroom with full size laundry appliances', 'azure-isle' ),
		'img-6.jpg'       => __( 'Outdoor amenities include horse shoes, basketball, bocce ball and fire pit.', 'azure-isle' ),
		'img-1.jpg'       => __( 'Kenedy Retreat is at 1401 Escondido (also known as Business 181)', 'azure-isle' ),
		'img-3.jpg'       => __( 'Just outside the covered patio is a large flagstone patio complete with fire pit and ample seating.', 'azure-isle' ),
		'IMG_5651.jpeg'   => __( 'We install numerous BBQ pits so guests don’t have to go far to enjoy a nice outdoor cookout.', 'azure-isle' ),
		'img-4.jpg'       => __( 'There are two horse shoe pits for guests to enjoy.', 'azure-isle' ),
		'IMG_5640.jpeg'   => __( 'In addition to all the grills between buildings, there is also a very large smoker down by the fire pit/flagstone patio.', 'azure-isle' ),
		'IMG_5648.jpeg'   => __( 'Kenedy Retreat has an approximately one-half court basketball court.', 'azure-isle' ),
		'IMG_5658.jpeg'   => __( 'Sitting between each of the 2-story buildings are “picnic pads” with conveniently located BBQ pits.', 'azure-isle' ),
		'IMG_5612.jpeg'   => __( 'Our indoor/outdoor recreation building has a fridge with ice as well as a stand-alone icemaker. There is also a pool table and a long shuffle board table.', 'azure-isle' ),
		'IMG_5520.jpeg'   => __( 'A one-bedroom suite with as close to home comfort as you can get. We provide full-size kitchen appliances, full-size fridge with icemaker, pantry, closet, dining room table and two chairs.', 'azure-isle' ),
		'IMG_5530.jpeg'   => __( '1-Bedroom Suites have queen bed with a 40” flat screen TV', 'azure-isle' ),
		'IMG_5526.jpeg'   => __( 'The 1-bedroom suites have a closet and pantry and queen bed with a 40” flat screen TV.', 'azure-isle' ),
		'IMG_5522.jpeg'   => __( 'Our one bedroom suites are almost 400 square feet and have firm queen beds, ceiling fan, DirectTV with expanded sports package and movie channels.', 'azure-isle' ),
		'IMG_5715.jpeg'   => __( 'The 2-2 unit comes with couch and a sitting chair and ottoman and only the 2-bedroom, 2-bath units come with a living room TV with a DVR.', 'azure-isle' ),
		'IMG_1198.jpeg'   => __( 'Just outside the roll up garage doors are more TV’s and plenty of seating.', 'azure-isle' ),
		'IMG_5701.jpeg'   => __( 'Each bedroom of the 2-2 apartments has a flat screen TV', 'azure-isle' ),
		'IMG_5719.jpeg'   => __( 'The 2BR-2BA unit showing the full-size range', 'azure-isle' ),
		'IMG_5731.jpeg'   => __( 'One of the BR’s of the 2BR-2BA unit', 'azure-isle' ),
		'IMG_5742.jpeg'   => __( '2BR-2BA apartment living room', 'azure-isle' ),
		'IMG_5722-2.jpeg' => __( '2BR-2BA apartment kitchen including the full-size stacked washer/dryer, full-size fridge with automatic icemaker, dining table and pantry.', 'azure-isle' ),
	);
}

/**
 * Create the Gallery page once (unless a page already uses the template),
 * with the photos in a [gallery] shortcode the owner can edit.
 */
function azure_kenedy_gallery_page() {
	if ( get_option( 'azure_gallery_seeded' ) ) {
		return;
	}
	if ( ! azure_page_url( 'template-gallery.php' ) ) {
		$ids = array();
		foreach ( azure_kenedy_gallery() as $file => $caption ) {
			$id = azure_kenedy_attachment( $file );
			if ( ! $id ) {
				continue;
			}
			if ( '' === get_post_field( 'post_excerpt', $id ) ) {
				wp_update_post(
					array(
						'ID'           => $id,
						'post_excerpt' => $caption,
					)
				);
			}
			$ids[] = $id;
		}
		if ( $ids ) {
			$existing = get_page_by_path( 'gallery' );
			$content  = '<!-- wp:shortcode -->[gallery ids="' . implode( ',', $ids ) . '" link="file" size="large" columns="3"]<!-- /wp:shortcode -->';
			if ( $existing ) {
				update_post_meta( $existing->ID, '_wp_page_template', 'template-gallery.php' );
				if ( '' === trim( $existing->post_content ) ) {
					wp_update_post(
						array(
							'ID'           => $existing->ID,
							'post_content' => $content,
						)
					);
				}
			} else {
				wp_insert_post(
					array(
						'post_type'    => 'page',
						'post_status'  => 'publish',
						'post_title'   => __( 'Gallery', 'azure-isle' ),
						'post_name'    => 'gallery',
						'post_content' => $content,
						'meta_input'   => array( '_wp_page_template' => 'template-gallery.php' ),
					)
				);
			}
		}
	}
	update_option( 'azure_gallery_seeded', 1 );
}

/**
 * Import the photos and assign them, once.
 */
function azure_kenedy_import() {
	if ( (int) get_option( 'azure_kenedy_imported' ) >= 5 || ! current_user_can( 'upload_files' ) ) {
		return;
	}
	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 300 ); // phpcs:ignore Squiz.PHP.DiscouragedFunctions -- one-time import.
	}

	// Slots still holding a photo an earlier version of the theme assigned
	// are updated too; photos chosen in the Customizer are kept.
	$media    = get_option( 'azure_kenedy_media', array() );
	$previous = array(
		'hero_image'  => 'h-img01.jpg',
		'video_image' => 'img-1.jpg',
	);
	foreach ( azure_kenedy_images() as $mod => $file ) {
		$current = (int) get_theme_mod( 'azure_' . $mod );
		if ( $current && isset( $previous[ $mod ], $media[ $previous[ $mod ] ] ) && (int) $media[ $previous[ $mod ] ] === $current ) {
			$current = 0;
		}
		if ( ! $current ) {
			$id = azure_kenedy_attachment( $file );
			if ( $id ) {
				set_theme_mod( 'azure_' . $mod, $id );
			}
		}
	}

	$rooms = get_posts(
		array(
			'post_type'      => 'azure_room',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'meta_key'       => '_azure_kenedy_image', // phpcs:ignore WordPress.DB.SlowDBQuery
			'fields'         => 'ids',
		)
	);
	foreach ( $rooms as $room_id ) {
		if ( ! has_post_thumbnail( $room_id ) ) {
			$id = azure_kenedy_attachment( get_post_meta( $room_id, '_azure_kenedy_image', true ) );
			if ( $id ) {
				set_post_thumbnail( $room_id, $id );
			}
		}
	}

	azure_kenedy_gallery_page();

	update_option( 'azure_kenedy_imported', 5 );
}
add_action( 'after_switch_theme', 'azure_kenedy_import', 20 );
add_action( 'admin_init', 'azure_kenedy_import' );

/**
 * Seed the apartments and pages on sites where the theme was already active
 * before this content was added (after_switch_theme does not run again).
 */
function azure_kenedy_seed_existing() {
	if ( get_option( 'azure_kenedy_rooms_seeded' ) || ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	azure_seed_rooms();
	azure_seed_pages();
	flush_rewrite_rules();
}
add_action( 'admin_init', 'azure_kenedy_seed_existing', 5 );
