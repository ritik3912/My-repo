<?php
/**
 * "Rooms" custom post type with a details meta box, plus sample rooms
 * created once on theme activation so the front page is never empty.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Room post type.
 */
function azure_register_rooms() {
	register_post_type(
		'azure_room',
		array(
			'labels'       => array(
				'name'          => __( 'Rooms', 'azure-isle' ),
				'singular_name' => __( 'Room', 'azure-isle' ),
				'add_new_item'  => __( 'Add New Room', 'azure-isle' ),
				'edit_item'     => __( 'Edit Room', 'azure-isle' ),
				'all_items'     => __( 'All Rooms', 'azure-isle' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'rooms' ),
			'menu_icon'    => 'dashicons-building',
			'show_in_rest' => true,
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		)
	);
}
add_action( 'init', 'azure_register_rooms' );

/**
 * Room detail fields: meta key => label.
 */
function azure_room_fields() {
	return array(
		'_azure_price'  => __( 'Price per night (e.g. $240)', 'azure-isle' ),
		'_azure_size'   => __( 'Size (e.g. 42 m²)', 'azure-isle' ),
		'_azure_guests' => __( 'Guests (e.g. 2 Guests)', 'azure-isle' ),
		'_azure_bed'    => __( 'Beds (e.g. King Bed)', 'azure-isle' ),
		'_azure_view'   => __( 'View (e.g. Lagoon View)', 'azure-isle' ),
	);
}

function azure_room_meta_box() {
	add_meta_box( 'azure_room_details', __( 'Room Details', 'azure-isle' ), 'azure_room_meta_box_html', 'azure_room', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'azure_room_meta_box' );

/**
 * Render the Room Details meta box.
 *
 * @param WP_Post $post Current room.
 */
function azure_room_meta_box_html( $post ) {
	wp_nonce_field( 'azure_room_save', 'azure_room_nonce' );
	foreach ( azure_room_fields() as $key => $label ) {
		printf(
			'<p><label for="%1$s"><strong>%2$s</strong></label><br><input type="text" class="widefat" id="%1$s" name="%1$s" value="%3$s"></p>',
			esc_attr( $key ),
			esc_html( $label ),
			esc_attr( get_post_meta( $post->ID, $key, true ) )
		);
	}
}

/**
 * Save Room Details.
 *
 * @param int $post_id Room ID.
 */
function azure_room_save( $post_id ) {
	if ( ! isset( $_POST['azure_room_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['azure_room_nonce'] ) ), 'azure_room_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array_keys( azure_room_fields() ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_azure_room', 'azure_room_save' );

/**
 * Show the price in the Rooms admin list.
 */
function azure_room_columns( $columns ) {
	$columns['azure_price'] = __( 'Price / night', 'azure-isle' );
	return $columns;
}
add_filter( 'manage_azure_room_posts_columns', 'azure_room_columns' );

function azure_room_column_content( $column, $post_id ) {
	if ( 'azure_price' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_azure_price', true ) );
	}
}
add_action( 'manage_azure_room_posts_custom_column', 'azure_room_column_content', 10, 2 );

/**
 * On activation: flush rewrites, create sample rooms and the About and
 * Contact pages once.
 */
function azure_activate() {
	azure_register_rooms();

	if ( ! get_option( 'azure_rooms_seeded' ) ) {
		$samples = array(
			array( __( 'Grand Oceanview Residence', 'azure-isle' ), '$480', '120 m²', __( '4 Guests', 'azure-isle' ), __( '2 Beds', 'azure-isle' ), __( 'Ocean View', 'azure-isle' ), __( 'Stunning beachfront location with 120 square meters of interior space, on the east side of the island with a private garden, plunge pool and open-air shower.', 'azure-isle' ) ),
			array( __( 'Premier Oceanview Villa', 'azure-isle' ), '$390', '95 m²', __( '3 Guests', 'azure-isle' ), __( 'King Bed', 'azure-isle' ), __( 'Sea View', 'azure-isle' ), __( 'A light-filled villa facing the open sea, with a separate lounge, a wide deck and steps down to a quiet stretch of beach.', 'azure-isle' ) ),
			array( __( 'Deluxe Hilltop Residence', 'azure-isle' ), '$320', '80 m²', __( '2 Guests', 'azure-isle' ), __( 'King Bed', 'azure-isle' ), __( 'Hill View', 'azure-isle' ), __( 'Set among the palms on the hillside, with sweeping views over the lagoon, a private plunge pool and an outdoor rain shower.', 'azure-isle' ) ),
			array( __( 'Lagoon Garden Room', 'azure-isle' ), '$240', '42 m²', __( '2 Guests', 'azure-isle' ), __( 'Queen Bed', 'azure-isle' ), __( 'Garden View', 'azure-isle' ), __( 'A calm ground-floor room opening onto a private garden terrace, a few steps from the lagoon.', 'azure-isle' ) ),
		);
		foreach ( $samples as $order => $room ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'azure_room',
					'post_status'  => 'publish',
					'post_title'   => $room[0],
					'post_excerpt' => $room[6],
					'post_content' => '<!-- wp:paragraph --><p>' . esc_html( $room[6] ) . ' ' . esc_html__( 'Edit this text under Rooms in the admin menu.', 'azure-isle' ) . '</p><!-- /wp:paragraph -->',
					'menu_order'   => $order,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_azure_price', $room[1] );
				update_post_meta( $id, '_azure_size', $room[2] );
				update_post_meta( $id, '_azure_guests', $room[3] );
				update_post_meta( $id, '_azure_bed', $room[4] );
				update_post_meta( $id, '_azure_view', $room[5] );
			}
		}
		update_option( 'azure_rooms_seeded', 1 );
	}

	azure_seed_pages();

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'azure_activate' );

/**
 * Create the About and Contact pages (with their templates) once, unless
 * a page already uses the template.
 */
function azure_seed_pages() {
	if ( get_option( 'azure_pages_seeded' ) ) {
		return;
	}
	$pages = array(
		'template-about.php'   => array( __( 'About the Hotel', 'azure-isle' ), 'about-the-hotel' ),
		'template-contact.php' => array( __( 'Contact', 'azure-isle' ), 'contact' ),
	);
	foreach ( $pages as $template => $page ) {
		if ( azure_page_url( $template ) ) {
			continue;
		}
		$existing = get_page_by_path( $page[1] );
		if ( $existing ) {
			update_post_meta( $existing->ID, '_wp_page_template', $template );
			continue;
		}
		wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $page[0],
				'post_name'    => $page[1],
				'post_content' => '',
				'meta_input'   => array( '_wp_page_template' => $template ),
			)
		);
	}
	update_option( 'azure_pages_seeded', 1 );
}

/**
 * Detail values for a room, skipping empty ones.
 *
 * @param int   $post_id Room ID.
 * @param array $keys    Meta keys to include.
 * @return string[]
 */
function azure_room_meta( $post_id, $keys = array( '_azure_size', '_azure_guests', '_azure_bed' ) ) {
	$out = array();
	foreach ( $keys as $key ) {
		$value = get_post_meta( $post_id, $key, true );
		if ( '' !== $value ) {
			$out[ $key ] = $value;
		}
	}
	return $out;
}
