<?php
/**
 * Day-by-day itinerary timeline.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$days    = tn_parse_pipe_lines( tn_meta( $post_id, 'tn_itinerary' ) );
?>
<?php if ( $days ) : ?>
	<div class="itinerary">
		<?php foreach ( $days as $i => $day ) : ?>
			<div class="itinerary-day">
				<div class="itinerary-day-number">
					<span class="label"><?php esc_html_e( 'Day', 'trail-notes' ); ?></span>
					<span class="number"><?php echo esc_html( $i + 1 ); ?></span>
				</div>
				<div>
					<h4><?php echo esc_html( $day[0] ?? '' ); ?></h4>
					<div class="itinerary-stats">
						<?php if ( ! empty( $day[1] ) ) : ?><span><strong><?php esc_html_e( 'Distance:', 'trail-notes' ); ?></strong> <?php echo esc_html( $day[1] ); ?></span><?php endif; ?>
						<?php if ( ! empty( $day[2] ) ) : ?><span><strong><?php esc_html_e( 'Walking time:', 'trail-notes' ); ?></strong> <?php echo esc_html( $day[2] ); ?></span><?php endif; ?>
						<?php if ( ! empty( $day[3] ) ) : ?><span><strong><?php esc_html_e( 'Elevation gain:', 'trail-notes' ); ?></strong> <?php echo esc_html( $day[3] ); ?></span><?php endif; ?>
						<?php if ( ! empty( $day[4] ) ) : ?><span><strong><?php esc_html_e( 'Difficulty:', 'trail-notes' ); ?></strong> <?php echo esc_html( $day[4] ); ?></span><?php endif; ?>
					</div>
					<?php if ( ! empty( $day[5] ) ) : ?>
						<p class="body-text mt-0"><?php echo esc_html( $day[5] ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $day[6] ) ) : ?>
						<p class="itinerary-notes"><?php echo esc_html( $day[6] ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add the day-by-day itinerary for this trek in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>
