<?php
/**
 * "Things I Wish I Knew Before Going" cards.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$items   = tn_parse_pipe_lines( tn_meta( $post_id, 'tn_wish_i_knew' ) );
?>
<?php if ( $items ) : ?>
	<div class="grid grid-3">
		<?php foreach ( $items as $item ) : ?>
			<div class="wish-card">
				<h4><?php echo esc_html( $item[0] ?? '' ); ?></h4>
				<?php if ( ! empty( $item[1] ) ) : ?>
					<p><?php echo esc_html( $item[1] ); ?></p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add the things you wish you knew before this trek (network, cash, water, permits, etc.) in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>
