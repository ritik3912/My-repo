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
	tn_field_textarea(
		'tn_route_steps',
		$post->ID,
		__( 'Route steps — one per line: Place | What happens here', 'trail-notes' ),
		'Example: <code>Delhi | Overnight Volvo bus to Rishikesh, approx 7–8 hours</code>',
		6
	);
	tn_field_textarea(
		'tn_route_notes',
		$post->ID,
		__( 'Important transport tips — one per line', 'trail-notes' ),
		'Example: <code>Shared cabs from the base village fill up early — start by 7 AM if you can.</code>',
		4
	);
}

function tn_render_itinerary_box( $post ) {
	tn_field_textarea(
		'tn_itinerary',
		$post->ID,
		__( 'One line per day: Title | Distance | Walking Duration | Elevation Gain | Difficulty | Highlights | Personal Notes', 'trail-notes' ),
		'Example: <code>Base to Camp 1 | 6 km | 4–5 hrs | +800 m | Moderate | Dense oak forest, first clear ridge view | [Add your notes for this day]</code>',
		6
	);
}

function tn_render_cost_box( $post ) {
	tn_field_textarea(
		'tn_cost_items',
		$post->ID,
		__( 'One line per category: Category | Amount', 'trail-notes' ),
		'Example: <code>Delhi → Base Village | ₹1,200</code>',
		6
	);
	tn_field_text( 'tn_cost_total', $post->ID, __( 'Estimated Total (per person)', 'trail-notes' ), 'e.g. ₹5,500 approx.' );
	tn_field_textarea( 'tn_cost_note', $post->ID, __( 'Note about this budget', 'trail-notes' ), 'This is shown as a disclaimer under the table.', 2 );
}

function tn_render_packing_box( $post ) {
	tn_field_textarea(
		'tn_packing',
		$post->ID,
		__( 'One line per category: Category: item one, item two, item three', 'trail-notes' ),
		'Example: <code>Footwear: Trekking shoes, extra socks, camp slippers</code>',
		6
	);
	tn_field_textarea(
		'tn_change_next_time',
		$post->ID,
		__( '"What I Would Change Next Time" — one item per line', 'trail-notes' ),
		'',
		4
	);
}

function tn_render_seasons_box( $post ) {
	tn_field_textarea(
		'tn_seasons',
		$post->ID,
		__( 'One line per season: Season | Typical Conditions | Trail Condition | Visibility | Snow Possibility | What to Carry', 'trail-notes' ),
		'Fill up to 5 lines (Spring, Summer, Monsoon, Autumn, Winter). Example: <code>Winter | Very cold, sub-zero at higher camps | Likely snow-covered, needs microspikes | Often clear but can change fast | High above [altitude] | Down jacket, thermals, gaiters</code>',
		7
	);
}

function tn_render_wish_box( $post ) {
	tn_field_textarea(
		'tn_wish_i_knew',
		$post->ID,
		__( 'One line per card: Title | Description', 'trail-notes' ),
		'Example: <code>Network | Mobile network disappears after the base village — inform people before you leave.</code>',
		8
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

function tn_render_photos_box( $post ) {
	tn_field_textarea(
		'tn_photo_groups',
		$post->ID,
		__( 'One line per gallery group: Label | number of placeholder photos', 'trail-notes' ),
		'Example: <code>Day 1 | 4</code> then <code>Summit Day | 6</code>. Replace individual placeholders with real photos later by editing template-parts/photo-gallery.php.',
		5
	);
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
		'tn_photo_groups',
		'tn_seo_description',
	);
	foreach ( $textarea_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, sanitize_textarea_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}

	update_post_meta( $post_id, 'tn_has_real_experience', isset( $_POST['tn_has_real_experience'] ) ? '1' : '' );
}
add_action( 'save_post_trek', 'tn_save_trek_meta' );
