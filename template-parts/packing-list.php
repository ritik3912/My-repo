<?php
/**
 * "What I Carried" packing checklist + "What I Would Change Next Time".
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$groups  = tn_parse_categorized_list( tn_meta( $post_id, 'tn_packing' ) );
$changes = tn_parse_lines( tn_meta( $post_id, 'tn_change_next_time' ) );
?>
<?php if ( $groups ) : ?>
	<div class="grid grid-3">
		<?php foreach ( $groups as $group ) : ?>
			<div class="packing-card">
				<h4><?php echo esc_html( $group['category'] ); ?></h4>
				<ul>
					<?php foreach ( $group['items'] as $item ) : ?>
						<li><?php echo tn_icon( 'check' ); ?><span><?php echo esc_html( $item ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add packing categories and items for this trek in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>

<?php if ( $changes ) : ?>
	<div class="change-next-time">
		<h4><?php esc_html_e( 'What I Would Change Next Time', 'trail-notes' ); ?></h4>
		<ul>
			<?php foreach ( $changes as $change ) : ?>
				<li><?php echo esc_html( $change ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
