<?php
/**
 * "What I Spent" cost breakdown table.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$items   = tn_parse_pipe_lines( tn_meta( $post_id, 'tn_cost_items' ) );
$total   = tn_meta( $post_id, 'tn_cost_total' );
$note    = tn_meta( $post_id, 'tn_cost_note' );
?>
<?php if ( $items ) : ?>
	<table class="cost-table">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Category', 'trail-notes' ); ?></th>
				<th><?php esc_html_e( 'Amount', 'trail-notes' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $items as $item ) : ?>
				<tr>
					<td><?php echo esc_html( $item[0] ?? '' ); ?></td>
					<td class="amount"><?php echo esc_html( $item[1] ?? '' ); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td><?php esc_html_e( 'Estimated Total (per person)', 'trail-notes' ); ?></td>
				<td class="amount"><?php echo tn_value_or_placeholder( $total, __( 'Add estimated total', 'trail-notes' ) ); ?></td>
			</tr>
		</tfoot>
	</table>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add a cost breakdown for this trek in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>

<p class="cost-note">
	<?php
	echo esc_html(
		$note ? $note : __( 'This is my personal, approximate expenditure for this trip — actual costs vary by group size, season and how you travel. Use it as a rough reference, not a quote.', 'trail-notes' )
	);
	?>
</p>
