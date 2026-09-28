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
		'_azure_price'  => __( 'Price (optional, e.g. $95)', 'azure-isle' ),
		'_azure_size'   => __( 'Size (e.g. 400 sq ft)', 'azure-isle' ),
		'_azure_guests' => __( 'Occupancy (e.g. Single or Double Occupancy)', 'azure-isle' ),
		'_azure_bed'    => __( 'Beds (e.g. Queen Bed)', 'azure-isle' ),
		'_azure_view'   => __( 'Card tag (e.g. Fully Furnished)', 'azure-isle' ),
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
 * On activation: flush rewrites, create the Kenedy Retreat apartments and
 * the Amenities and Contact Us pages once.
 */
function azure_activate() {
	azure_register_rooms();
	azure_seed_rooms();
	azure_seed_pages();

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'azure_activate' );

/**
 * Kenedy Retreat apartments: title, size, occupancy, beds, tag, excerpt,
 * description paragraphs and the bundled photo used as Featured Image.
 */
function azure_room_samples() {
	return array(
		array( __( 'One-Bedroom Suite', 'azure-isle' ), __( 'Almost 400 sq ft', 'azure-isle' ), __( 'Single or Double Occupancy', 'azure-isle' ), __( 'Queen Bed', 'azure-isle' ), __( 'Fully Furnished', 'azure-isle' ), __( 'Our one bedroom suites are almost 400 square feet and have firm queen beds, ceiling fan, DirectTV with expanded sports package and movie channels.', 'azure-isle' ), array( __( 'A one-bedroom suite with as close to home comfort as you can get. We provide full-size kitchen appliances, full-size fridge with icemaker, pantry, closet, dining room table and two chairs.', 'azure-isle' ), __( 'The 1-bedroom suites have a closet and pantry and queen bed with a 40” flat screen TV.', 'azure-isle' ) ), 'IMG_5522.jpeg' ),
		array( __( 'Efficiency Suite', 'azure-isle' ), __( 'Almost 400 sq ft', 'azure-isle' ), '', '', __( 'Fully Furnished', 'azure-isle' ), __( 'Our efficiency suites are almost 400 square feet of living space with full-size washer and dryer in each unit, a full-size oven, dishwasher and a refrigerator with icemaker.', 'azure-isle' ), array( __( 'There is a fully stocked kitchen including utensils, kitchenware, coffee maker, iron and ironing board, toaster and more. A complete list of provided items is available upon request.', 'azure-isle' ) ), 'img-15.jpg' ),
		array( __( 'Two-Bedroom, Two-Bath Apartment', 'azure-isle' ), __( '800 sq ft', 'azure-isle' ), '', __( '2 Bedrooms, 2 Baths', 'azure-isle' ), __( 'Fully Furnished', 'azure-isle' ), __( 'The 2-2 unit comes with couch and a sitting chair and ottoman and only the 2-bedroom, 2-bath units come with a living room TV with a DVR.', 'azure-isle' ), array( __( '2BR-2BA apartment kitchen including the full-size stacked washer/dryer, full-size fridge with automatic icemaker, dining table and pantry.', 'azure-isle' ), __( 'Each bedrooms of the 2-2 apartments have flat screen TV’s.', 'azure-isle' ) ), 'IMG_5742.jpeg' ),
	);
}

/**
 * Create the apartments once. Sites that already got the original sample
 * rooms have those moved to the trash.
 */
function azure_seed_rooms() {
	if ( get_option( 'azure_kenedy_rooms_seeded' ) ) {
		return;
	}
	if ( get_option( 'azure_rooms_seeded' ) ) {
		$old = get_posts(
			array(
				'post_type'      => 'azure_room',
				'post_status'    => 'any',
				'posts_per_page' => -1,
			)
		);
		$old_titles = array( 'Grand Oceanview Residence', 'Premier Oceanview Villa', 'Deluxe Hilltop Residence', 'Lagoon Garden Room' );
		foreach ( $old as $room ) {
			if ( in_array( $room->post_title, $old_titles, true ) ) {
				wp_trash_post( $room->ID );
			}
		}
	}
	foreach ( azure_room_samples() as $order => $room ) {
		$content = '';
		foreach ( $room[6] as $para ) {
			$content .= '<!-- wp:paragraph --><p>' . esc_html( $para ) . '</p><!-- /wp:paragraph -->';
		}
		$id = wp_insert_post(
			array(
				'post_type'    => 'azure_room',
				'post_status'  => 'publish',
				'post_title'   => $room[0],
				'post_excerpt' => $room[5],
				'post_content' => $content,
				'menu_order'   => $order,
			)
		);
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_azure_size', $room[1] );
			update_post_meta( $id, '_azure_guests', $room[2] );
			update_post_meta( $id, '_azure_bed', $room[3] );
			update_post_meta( $id, '_azure_view', $room[4] );
			update_post_meta( $id, '_azure_kenedy_image', $room[7] );
		}
	}
	update_option( 'azure_rooms_seeded', 1 );
	update_option( 'azure_kenedy_rooms_seeded', 1 );
}

/**
 * Create the About and Contact pages (with their templates) once, unless
 * a page already uses the template.
 */
function azure_seed_pages() {
	if ( get_option( 'azure_pages_seeded' ) ) {
		return;
	}
	$pages = array(
		'template-about.php'   => array( __( 'Amenities', 'azure-isle' ), 'amenities' ),
		'template-contact.php' => array( __( 'Contact Us', 'azure-isle' ), 'contact-us' ),
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
