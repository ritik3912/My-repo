<?php
/**
 * Editorial photo journal, grouped by day, rendered as a masonry grid of
 * placeholder tiles. Swap a tile's markup for a real <img> (or
 * wp_get_attachment_image()) as photos become available — the group
 * structure stays the same either way.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$groups  = tn_parse_pipe_lines( tn_meta( $post_id, 'tn_photo_groups' ) );
$ratios  = array( '4-3', '3-4', '1-1', '16-9' );
?>
<?php if ( $groups ) : ?>
	<?php foreach ( $groups as $group ) : ?>
		<?php
		$label = $group[0] ?? '';
		$count = isset( $group[1] ) ? max( 1, min( 12, (int) $group[1] ) ) : 4;
		?>
		<div class="photo-journal-group">
			<h4><?php echo esc_html( $label ); ?></h4>
			<div class="masonry">
				<?php for ( $i = 1; $i <= $count; $i++ ) : ?>
					<?php
					echo tn_image(
						array(
							'label' => sprintf( /* translators: 1: gallery group label, 2: photo number */ __( '%1$s — photo %2$d', 'trail-notes' ), $label, $i ),
							'ratio' => $ratios[ $i % count( $ratios ) ],
							'tone'  => 0 === $i % 3 ? 'earth' : '',
						)
					);
					?>
				<?php endfor; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add photo journal groups (e.g. Day 1, Summit Day) for this trek in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>
