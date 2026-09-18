<?php
/**
 * All custom fields for the Trek post type.
 *
 * There is no page-builder / ACF dependency here on purpose — every field
 * is a plain text/textarea input saved as post meta, with a documented
 * "one row per line, columns separated by |" convention for the
 * repeating sections (route steps, itinerary days, cost lines, seasons,
 * wish-i-knew items). This keeps the theme self-contained and means a
 * new trek is just: add a Trek, fill the fields, publish — no code
 * changes, no template edits. See README.md for the full field guide.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tn_add_meta_boxes() {
	add_meta_box( 'tn_quick_info', __( 'Quick Info', 'trail-notes' ), 'tn_render_quick_info_box', 'trek', 'normal', 'high' );
	add_meta_box( 'tn_route', __( 'How to Reach (Route)', 'trail-notes' ), 'tn_render_route_box', 'trek', 'normal' );
	add_meta_box( 'tn_itinerary', __( 'Day-by-Day Itinerary', 'trail-notes' ), 'tn_render_itinerary_box', 'trek', 'normal' );
	add_meta_box( 'tn_cost', __( 'Cost Breakdown — What I Spent', 'trail-notes' ), 'tn_render_cost_box', 'trek', 'normal' );
	add_meta_box( 'tn_packing', __( 'Packing List', 'trail-notes' ), 'tn_render_packing_box', 'trek', 'normal' );
	add_meta_box( 'tn_seasons', __( 'Weather / Best Time', 'trail-notes' ), 'tn_render_seasons_box', 'trek', 'normal' );
	add_meta_box( 'tn_wish', __( 'Things I Wish I Knew', 'trail-notes' ), 'tn_render_wish_box', 'trek', 'normal' );
	add_meta_box( 'tn_suitability', __( 'Is This Trek For You?', 'trail-notes' ), 'tn_render_suitability_box', 'trek', 'normal' );
	add_meta_box( 'tn_photos', __( 'Photo Journal', 'trail-notes' ), 'tn_render_photos_box', 'trek', 'normal' );
	add_meta_box( 'tn_videos', __( 'Trek Videos', 'trail-notes' ), 'tn_render_video_box', 'trek', 'normal' );
	add_meta_box( 'tn_seo', __( 'SEO', 'trail-notes' ), 'tn_render_seo_box', 'trek', 'side' );
}
add_action( 'add_meta_boxes', 'tn_add_meta_boxes' );

/**
 * Shared field helpers so every box looks the same.
 */
function tn_field_text( $key, $post_id, $label, $placeholder = '' ) {
	$value = esc_attr( tn_meta( $post_id, $key ) );
	printf(
		'<p><label for="%1$s"><strong>%2$s</strong></label><br><input type="text" id="%1$s" name="%1$s" value="%3$s" placeholder="%4$s" style="width:100%%;margin-top:4px;"></p>',
		esc_attr( $key ),
		esc_html( $label ),
		$value,
		esc_attr( $placeholder )
	);
}

function tn_field_textarea( $key, $post_id, $label, $help = '', $rows = 4 ) {
	$value = esc_textarea( tn_meta( $post_id, $key ) );
	printf(
		'<p><label for="%1$s"><strong>%2$s</strong></label>%3$s<br><textarea id="%1$s" name="%1$s" rows="%4$d" style="width:100%%;margin-top:4px;font-family:monospace;">%5$s</textarea></p>',
		esc_attr( $key ),
		esc_html( $label ),
		$help ? '<br><span style="color:#666;font-size:12px;">' . $help . '</span>' : '',
		(int) $rows,
		$value
	);
}

function tn_meta_nonce_field() {
	wp_nonce_field( 'tn_save_trek_meta', 'tn_trek_meta_nonce' );
}

/**
 * A repeating-row TABLE for the fields that used to be "one line per row,
 * columns separated by |" plain text (route steps, itinerary, cost items,
 * seasons, wish-i-knew, packing). JS (assets/js/admin-repeater.js) turns
 * this into add/remove-row table editing and keeps the underlying
 * textarea — still the field that actually gets saved — in sync on every
 * keystroke, so tn_save_trek_meta() and the tn_parse_*() template helpers
 * need no changes. An "Edit as plain text" toggle is kept as a fallback
 * for bulk edits or if JS is unavailable.
 *
 * @param string $format 'pipe' (default), 'lines' (single column, one
 *                        item per line), or 'packing' ("Category: a, b").
 */
function tn_field_table( $key, $post_id, $label, $help, $columns, $format = 'pipe' ) {
	$value = tn_meta( $post_id, $key );
	printf(
		'<div class="tn-field-label"><label for="%1$s"><strong>%2$s</strong></label>%3$s</div>',
		esc_attr( $key ),
		esc_html( $label ),
		$help ? '<br><span style="color:#666;font-size:12px;">' . $help . '</span>' : ''
	);
	?>
	<div class="tn-repeater"
		data-repeater-field="<?php echo esc_attr( $key ); ?>"
		data-repeater-format="<?php echo esc_attr( $format ); ?>"
		data-columns="<?php echo esc_attr( wp_json_encode( array_values( $columns ) ) ); ?>"
		data-label-raw="<?php esc_attr_e( 'Edit as plain text', 'trail-notes' ); ?>"
		data-label-table="<?php esc_attr_e( 'Edit as table', 'trail-notes' ); ?>"
	>
		<table class="tn-repeater-table">
			<thead><tr></tr></thead>
			<tbody></tbody>
		</table>
		<p>
			<button type="button" class="button tn-repeater-add"><?php esc_html_e( '+ Add row', 'trail-notes' ); ?></button>
			<button type="button" class="button-link tn-repeater-toggle-raw" style="margin-left:10px;"><?php esc_html_e( 'Edit as plain text', 'trail-notes' ); ?></button>
		</p>
		<textarea id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" class="tn-repeater-raw" rows="4" style="width:100%;display:none;font-family:monospace;"><?php echo esc_textarea( $value ); ?></textarea>
	</div>
	<?php
}

function tn_render_quick_info_box( $post ) {
	tn_meta_nonce_field();
	echo '<p style="color:#666;">' . esc_html__( 'Region, Difficulty, Duration and Experience Level are set in the boxes on the right (they power the Trek Finder filters). Everything below fills the Quick Info grid on the trek page.', 'trail-notes' ) . '</p>';
	tn_field_text( 'tn_duration_text', $post->ID, __( 'Duration (display text)', 'trail-notes' ), 'e.g. 2 Days / 1 Night' );
	tn_field_text( 'tn_highest_point', $post->ID, __( 'Highest Point', 'trail-notes' ), 'e.g. [Add actual altitude]' );
	tn_field_text( 'tn_best_season', $post->ID, __( 'Best Season', 'trail-notes' ), 'e.g. March – June, Sept – Nov' );
	tn_field_text( 'tn_approx_budget', $post->ID, __( 'Approx Budget', 'trail-notes' ), 'e.g. ₹4,000 – ₹6,000 per person' );
	tn_field_text( 'tn_starting_point', $post->ID, __( 'Starting Point', 'trail-notes' ), 'e.g. Sari village' );
	tn_field_text( 'tn_suitable_for', $post->ID, __( 'Suitable For', 'trail-notes' ), 'e.g. Beginners with basic fitness' );

	$has_real = tn_meta( $post->ID, 'tn_has_real_experience' );
	printf(
		'<p style="margin-top:12px;"><label><input type="checkbox" name="tn_has_real_experience" value="1" %s> <strong>%s</strong></label><br><span style="color:#666;font-size:12px;">%s</span></p>',
		checked( $has_real, '1', false ),
		esc_html__( 'This trek has a real, personally-written experience', 'trail-notes' ),
		esc_html__( 'Leave unchecked to show an editable placeholder instead of the main content in the "My Experience" section.', 'trail-notes' )
	);
}

function tn_render_route_box( $post ) {
	tn_field_table(
		'tn_route_steps',
		$post->ID,
		__( 'Route steps', 'trail-notes' ),
		__( 'One row per leg of the journey — Delhi → transit city → base village → trek start.', 'trail-notes' ),
		array( __( 'Place', 'trail-notes' ), __( 'What happens here', 'trail-notes' ) )
	);
	tn_field_table(
		'tn_route_notes',
		$post->ID,
		__( 'Important transport tips', 'trail-notes' ),
		'',
		array( __( 'Tip', 'trail-notes' ) ),
		'lines'
	);
}

function tn_render_itinerary_box( $post ) {
	tn_field_table(
		'tn_itinerary',
		$post->ID,
		__( 'Day-by-day itinerary', 'trail-notes' ),
		__( 'One row per day of the trek.', 'trail-notes' ),
		array(
			__( 'Title', 'trail-notes' ),
			__( 'Distance', 'trail-notes' ),
			__( 'Walking Duration', 'trail-notes' ),
			__( 'Elevation Gain', 'trail-notes' ),
			__( 'Difficulty', 'trail-notes' ),
			__( 'Highlights', 'trail-notes' ),
			__( 'Personal Notes', 'trail-notes' ),
		)
	);
}

function tn_render_cost_box( $post ) {
	tn_field_table(
		'tn_cost_items',
		$post->ID,
		__( 'Cost items', 'trail-notes' ),
		'',
		array( __( 'Category', 'trail-notes' ), __( 'Amount', 'trail-notes' ) )
	);
	tn_field_text( 'tn_cost_total', $post->ID, __( 'Estimated Total (per person)', 'trail-notes' ), 'e.g. ₹5,500 approx.' );
	tn_field_textarea( 'tn_cost_note', $post->ID, __( 'Note about this budget', 'trail-notes' ), 'This is shown as a disclaimer under the table.', 2 );
}

function tn_render_packing_box( $post ) {
	tn_field_table(
		'tn_packing',
		$post->ID,
		__( 'Packing categories', 'trail-notes' ),
		__( 'Items within a category are comma-separated, e.g. Trekking shoes, extra socks, camp slippers.', 'trail-notes' ),
		array( __( 'Category', 'trail-notes' ), __( 'Items (comma-separated)', 'trail-notes' ) ),
		'packing'
	);
	tn_field_table(
		'tn_change_next_time',
		$post->ID,
		__( '"What I Would Change Next Time"', 'trail-notes' ),
		'',
		array( __( 'Item', 'trail-notes' ) ),
		'lines'
	);
}

function tn_render_seasons_box( $post ) {
	tn_field_table(
		'tn_seasons',
		$post->ID,
		__( 'Seasonal guide', 'trail-notes' ),
		__( 'Fill up to 5 rows (Spring, Summer, Monsoon, Autumn, Winter).', 'trail-notes' ),
		array(
			__( 'Season', 'trail-notes' ),
			__( 'Typical Conditions', 'trail-notes' ),
			__( 'Trail Condition', 'trail-notes' ),
			__( 'Visibility', 'trail-notes' ),
			__( 'Snow Possibility', 'trail-notes' ),
			__( 'What to Carry', 'trail-notes' ),
		)
	);
}

function tn_render_wish_box( $post ) {
	tn_field_table(
		'tn_wish_i_knew',
		$post->ID,
		__( 'Things I wish I knew', 'trail-notes' ),
		'',
		array( __( 'Title', 'trail-notes' ), __( 'Description', 'trail-notes' ) )
	);
}

function tn_render_suitability_box( $post ) {
	$levels  = array( 'Beginner Friendly', 'Requires Basic Fitness', 'Moderate', 'Experienced Trekkers' );
	$current = tn_meta( $post->ID, 'tn_suitability_level', 'Moderate' );
	echo '<p><label for="tn_suitability_level"><strong>' . esc_html__( 'Level', 'trail-notes' ) . '</strong></label><br><select id="tn_suitability_level" name="tn_suitability_level" style="width:100%;margin-top:4px;">';
	foreach ( $levels as $level ) {
		printf( '<option value="%1$s" %2$s>%1$s</option>', esc_attr( $level ), selected( $current, $level, false ) );
	}
	echo '</select></p>';
	tn_field_textarea( 'tn_suitability_description', $post->ID, __( 'Practical description (no medical advice)', 'trail-notes' ), 'e.g. You should be comfortable walking continuously for 4–5 hours with a daypack.', 3 );
}

/**
 * Real Media Library uploads, grouped (Day 1, Summit Day, ...), instead of
 * the old placeholder-count textarea. assets/js/admin-media.js drives the
 * "Add photo group" / "Add Photos" buttons and keeps the hidden textarea
 * in sync as JSON: [{ "label": "Day 1", "ids": [12, 13] }, ...].
 */
function tn_render_photos_box( $post ) {
	$value = tn_meta( $post->ID, 'tn_photo_gallery', '[]' );
	echo '<p style="color:#666;">' . esc_html__( 'Group your real photos the way you\'d tell the story — e.g. "Day 1", "Summit Day" — then add photos to each group from the Media Library.', 'trail-notes' ) . '</p>';
	?>
	<div class="tn-photo-gallery-field">
		<div class="tn-photo-groups"></div>
		<p><button type="button" class="button tn-add-group"><?php esc_html_e( '+ Add photo group', 'trail-notes' ); ?></button></p>
		<textarea id="tn_photo_gallery" name="tn_photo_gallery" class="tn-media-json" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
	</div>
	<?php
}

/**
 * Real video uploads or YouTube/Vimeo links, same JSON-in-a-hidden-field
 * pattern as the photo gallery above.
 */
function tn_render_video_box( $post ) {
	$value = tn_meta( $post->ID, 'tn_videos', '[]' );
	echo '<p style="color:#666;">' . esc_html__( 'Paste a YouTube or Vimeo link, or upload a video file straight from the Media Library.', 'trail-notes' ) . '</p>';
	?>
	<div class="tn-video-field">
		<div class="tn-video-list"></div>
		<p><button type="button" class="button tn-add-video"><?php esc_html_e( '+ Add video', 'trail-notes' ); ?></button></p>
		<textarea id="tn_videos" name="tn_videos" class="tn-media-json" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
	</div>
	<?php
}

function tn_render_seo_box( $post ) {
	tn_field_text( 'tn_seo_title', $post->ID, __( 'SEO Title', 'trail-notes' ), 'Defaults to the trek name + site name' );
	tn_field_textarea( 'tn_seo_description', $post->ID, __( 'Meta Description', 'trail-notes' ), 'Defaults to the excerpt.', 3 );
}

/**
 * Save handler — one nonce covers every box above.
 */
function tn_save_trek_meta( $post_id ) {
	if ( ! isset( $_POST['tn_trek_meta_nonce'] ) || ! wp_verify_nonce( $_POST['tn_trek_meta_nonce'], 'tn_save_trek_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_fields = array(
		'tn_duration_text',
		'tn_highest_point',
		'tn_best_season',
		'tn_approx_budget',
		'tn_starting_point',
		'tn_suitable_for',
		'tn_cost_total',
		'tn_suitability_level',
		'tn_seo_title',
	);
	foreach ( $text_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}

	$textarea_fields = array(
		'tn_route_steps',
		'tn_route_notes',
		'tn_itinerary',
		'tn_cost_items',
		'tn_cost_note',
		'tn_packing',
		'tn_change_next_time',
		'tn_seasons',
		'tn_wish_i_knew',
		'tn_suitability_description',
		'tn_seo_description',
	);
	foreach ( $textarea_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, sanitize_textarea_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}

	if ( isset( $_POST['tn_photo_gallery'] ) ) {
		update_post_meta( $post_id, 'tn_photo_gallery', wp_json_encode( tn_sanitize_photo_gallery( $_POST['tn_photo_gallery'] ) ) );
	}
	if ( isset( $_POST['tn_videos'] ) ) {
		update_post_meta( $post_id, 'tn_videos', wp_json_encode( tn_sanitize_videos( $_POST['tn_videos'] ) ) );
	}

	update_post_meta( $post_id, 'tn_has_real_experience', isset( $_POST['tn_has_real_experience'] ) ? '1' : '' );
}
add_action( 'save_post_trek', 'tn_save_trek_meta' );

/**
 * Validate the Photo Journal JSON: drop empty groups and any attachment ID
 * that isn't actually a Media Library attachment.
 */
function tn_sanitize_photo_gallery( $raw ) {
	$decoded = json_decode( wp_unslash( $raw ), true );
	if ( ! is_array( $decoded ) ) {
		return array();
	}

	$clean = array();
	foreach ( $decoded as $group ) {
		if ( ! is_array( $group ) ) {
			continue;
		}
		$label = isset( $group['label'] ) ? sanitize_text_field( $group['label'] ) : '';
		$ids   = array();
		if ( ! empty( $group['ids'] ) && is_array( $group['ids'] ) ) {
			foreach ( $group['ids'] as $id ) {
				$id = (int) $id;
				if ( $id > 0 && 'attachment' === get_post_type( $id ) ) {
					$ids[] = $id;
				}
			}
		}
		if ( $label || $ids ) {
			$clean[] = array(
				'label' => $label,
				'ids'   => $ids,
			);
		}
	}
	return $clean;
}

/**
 * Validate the Trek Videos JSON: an "upload" entry must point at a real
 * attachment, an "embed" entry must be a well-formed URL.
 */
function tn_sanitize_videos( $raw ) {
	$decoded = json_decode( wp_unslash( $raw ), true );
	if ( ! is_array( $decoded ) ) {
		return array();
	}

	$clean = array();
	foreach ( $decoded as $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}
		$label = isset( $item['label'] ) ? sanitize_text_field( $item['label'] ) : '';
		$type  = ( isset( $item['type'] ) && 'upload' === $item['type'] ) ? 'upload' : 'embed';
		$value = '';

		if ( 'upload' === $type ) {
			$id = isset( $item['value'] ) ? (int) $item['value'] : 0;
			if ( $id > 0 && 'attachment' === get_post_type( $id ) ) {
				$value = $id;
			}
		} else {
			$value = isset( $item['value'] ) ? esc_url_raw( $item['value'] ) : '';
		}

		if ( $value ) {
			$clean[] = array(
				'label' => $label,
				'type'  => $type,
				'value' => $value,
			);
		}
	}
	return $clean;
}
