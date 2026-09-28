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
		'hero_image'          => 'h-img01.jpg',
		'carousel_1'          => 'Amenities.jpg',
		'carousel_2'          => 'IMG_1198.jpeg',
		'carousel_3'          => 'img-8.jpg',
		'carousel_4'          => 'img-2.jpg',
		'carousel_5'          => 'img-18.jpg',
		'carousel_6'          => 'img-13.jpg',
		'video_image'         => 'img-1.jpg',
		'loc_image'           => 'img-7.jpg',
		'loc_1_image'         => 'img-9.jpg',
		'loc_2_image'         => 'img-3.jpg',
		'loc_3_image'         => 'img-11.jpg',
		'serv_image_1'        => 'IMG_5520.jpeg',
		'serv_image_2'        => 'IMG_5722-2.jpeg',
		'news_image'          => 'IMG_5651.jpeg',
		'about_hero_image'    => 'img-5.jpg',
		'about_intro_image_1' => 'IMG_5530.jpeg',
		'about_intro_image_2' => 'img-15.jpg',
		'about_stats_image'   => 'IMG_5658.jpeg',
		'about_story_image'   => 'IMG_1198.jpeg',
		'contact_hero_image'  => 'img-6.jpg',
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
 * Import the photos and assign them, once.
 */
function azure_kenedy_import() {
	if ( get_option( 'azure_kenedy_imported' ) || ! current_user_can( 'upload_files' ) ) {
		return;
	}
	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 300 ); // phpcs:ignore Squiz.PHP.DiscouragedFunctions -- one-time import.
	}

	foreach ( azure_kenedy_images() as $mod => $file ) {
		if ( ! get_theme_mod( 'azure_' . $mod ) ) {
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

	update_option( 'azure_kenedy_imported', 1 );
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
