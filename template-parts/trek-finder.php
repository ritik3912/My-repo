<?php
/**
 * "Not Sure Where to Go Next?" interactive trek finder. Filter chips are
 * built from the live taxonomy terms, so a newly added region or
 * difficulty term shows up automatically — no template changes needed.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$filter_groups = array(
	'difficulty' => array(
		'label'    => __( 'Difficulty', 'trail-notes' ),
		'taxonomy' => 'trek_difficulty',
	),
	'duration'   => array(
		'label'    => __( 'Duration', 'trail-notes' ),
		'taxonomy' => 'trek_duration',
	),
	'region'     => array(
		'label'    => __( 'Region', 'trail-notes' ),
		'taxonomy' => 'trek_region',
	),
	'experience' => array(
		'label'    => __( 'Experience', 'trail-notes' ),
		'taxonomy' => 'trek_experience_level',
	),
);

$treks = get_posts(
	array(
		'post_type'      => 'trek',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
	)
);
?>
<div class="finder" data-trek-finder>
	<div class="finder-filters">
		<?php foreach ( $filter_groups as $group_key => $group ) : ?>
			<?php $terms = get_terms( array( 'taxonomy' => $group['taxonomy'], 'hide_empty' => false ) ); ?>
			<?php if ( ! is_wp_error( $terms ) && $terms ) : ?>
				<div class="finder-group">
					<h5><?php echo esc_html( $group['label'] ); ?></h5>
					<div class="chip-group">
						<?php foreach ( $terms as $term ) : ?>
							<button
								type="button"
								class="chip"
								data-filter-group="<?php echo esc_attr( $group_key ); ?>"
								data-filter-value="<?php echo esc_attr( $term->slug ); ?>"
								aria-pressed="false"
							><?php echo esc_html( $term->name ); ?></button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<?php if ( $treks ) : ?>
		<div class="finder-results">
			<?php
			foreach ( $treks as $trek ) {
				get_template_part( 'template-parts/trek-card', null, array( 'post_id' => $trek->ID ) );
			}
			wp_reset_postdata();
			?>
		</div>
		<p class="finder-empty">
			<?php esc_html_e( 'No treks match that combination yet — try clearing a filter.', 'trail-notes' ); ?>
		</p>
		<div class="text-center finder-reset">
			<button type="button" class="btn-text" data-finder-reset><?php esc_html_e( 'Clear filters', 'trail-notes' ); ?></button>
		</div>
	<?php else : ?>
		<p class="body-text"><?php echo tn_placeholder_text( __( 'Publish your first Trek to see it appear here.', 'trail-notes' ) ); ?></p>
	<?php endif; ?>
</div>
