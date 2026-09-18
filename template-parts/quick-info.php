<?php
/**
 * Quick Info grid for a single trek.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$region     = tn_first_term( $post_id, 'trek_region' );
$difficulty = tn_first_term( $post_id, 'trek_difficulty' );

$items = array(
	__( 'Location', 'trail-notes' )       => $region ? $region->name : '',
	__( 'Duration', 'trail-notes' )       => tn_meta( $post_id, 'tn_duration_text' ),
	__( 'Difficulty', 'trail-notes' )     => $difficulty ? $difficulty->name : '',
	__( 'Highest Point', 'trail-notes' )  => tn_meta( $post_id, 'tn_highest_point' ),
	__( 'Best Season', 'trail-notes' )    => tn_meta( $post_id, 'tn_best_season' ),
	__( 'Approx Budget', 'trail-notes' )  => tn_meta( $post_id, 'tn_approx_budget' ),
	__( 'Starting Point', 'trail-notes' ) => tn_meta( $post_id, 'tn_starting_point' ),
	__( 'Suitable For', 'trail-notes' )   => tn_meta( $post_id, 'tn_suitable_for' ),
);
?>
<dl class="quick-info">
	<?php foreach ( $items as $label => $value ) : ?>
		<div class="quick-info-item">
			<dt><?php echo esc_html( $label ); ?></dt>
			<dd><?php echo tn_value_or_placeholder( $value, sprintf( /* translators: %s: field label */ __( 'Add %s', 'trail-notes' ), $label ) ); ?></dd>
		</div>
	<?php endforeach; ?>
</dl>
