<?php
/**
 * "Is This Trek For You?" suitability block.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id     = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$level       = tn_meta( $post_id, 'tn_suitability_level', __( 'Moderate', 'trail-notes' ) );
$description = tn_meta( $post_id, 'tn_suitability_description' );
?>
<div class="suitability-card">
	<span class="suitability-level"><?php echo esc_html( $level ); ?></span>
	<p>
		<?php
		echo esc_html(
			$description ? $description : __( 'You should be comfortable walking continuously for several hours. Add a more specific, practical description for this trek in the trek editor — this is not medical advice.', 'trail-notes' )
		);
		?>
	</p>
</div>
