<?php
/**
 * "How to Reach" route timeline: Delhi → transit city → base village →
 * trek start → destination, plus transport tips.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$steps   = tn_parse_pipe_lines( tn_meta( $post_id, 'tn_route_steps' ) );
$notes   = tn_parse_lines( tn_meta( $post_id, 'tn_route_notes' ) );
?>
<?php if ( $steps ) : ?>
	<ol class="route-timeline">
		<?php foreach ( $steps as $step ) : ?>
			<li class="route-step">
				<h4><?php echo esc_html( $step[0] ?? '' ); ?></h4>
				<?php if ( ! empty( $step[1] ) ) : ?>
					<p><?php echo esc_html( $step[1] ); ?></p>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add the route steps for this trek (Delhi → transit city → base village → trek start → destination) in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>

<?php if ( $notes ) : ?>
	<div class="route-notes">
		<h4><?php esc_html_e( 'Important Transport Tips', 'trail-notes' ); ?></h4>
		<ul>
			<?php foreach ( $notes as $note ) : ?>
				<li><?php echo esc_html( $note ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
