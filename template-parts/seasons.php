<?php
/**
 * Seasonal / best-time guide.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$seasons = tn_parse_pipe_lines( tn_meta( $post_id, 'tn_seasons' ) );
?>
<?php if ( $seasons ) : ?>
	<div class="grid grid-3">
		<?php foreach ( $seasons as $season ) : ?>
			<div class="season-card">
				<span class="season-name"><?php echo esc_html( $season[0] ?? '' ); ?></span>
				<dl>
					<?php if ( ! empty( $season[1] ) ) : ?>
						<div><dt><?php esc_html_e( 'Conditions', 'trail-notes' ); ?></dt><dd><?php echo esc_html( $season[1] ); ?></dd></div>
					<?php endif; ?>
					<?php if ( ! empty( $season[2] ) ) : ?>
						<div><dt><?php esc_html_e( 'Trail Condition', 'trail-notes' ); ?></dt><dd><?php echo esc_html( $season[2] ); ?></dd></div>
					<?php endif; ?>
					<?php if ( ! empty( $season[3] ) ) : ?>
						<div><dt><?php esc_html_e( 'Visibility', 'trail-notes' ); ?></dt><dd><?php echo esc_html( $season[3] ); ?></dd></div>
					<?php endif; ?>
					<?php if ( ! empty( $season[4] ) ) : ?>
						<div><dt><?php esc_html_e( 'Snow Possibility', 'trail-notes' ); ?></dt><dd><?php echo esc_html( $season[4] ); ?></dd></div>
					<?php endif; ?>
					<?php if ( ! empty( $season[5] ) ) : ?>
						<div><dt><?php esc_html_e( 'What to Carry', 'trail-notes' ); ?></dt><dd><?php echo esc_html( $season[5] ); ?></dd></div>
					<?php endif; ?>
				</dl>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add a seasonal guide (Spring, Summer, Monsoon, Autumn, Winter) for this trek in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>

<div class="weather-disclaimer">
	<?php echo tn_icon( 'alert' ); ?>
	<p><?php esc_html_e( 'Conditions can change quickly in the mountains. Always check current weather and local conditions before starting your trek.', 'trail-notes' ); ?></p>
</div>
