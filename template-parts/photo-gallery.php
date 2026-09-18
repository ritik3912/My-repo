<?php
/**
 * Editorial photo journal, grouped by day, rendered as an even-height grid
 * of real uploaded photos (Photo Journal meta box → Media Library). Every
 * tile shares the same aspect ratio so a row of photos lines up evenly
 * regardless of the source photos' own dimensions. Each photo opens
 * full-size in the lightbox handled by assets/js/main.js.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$groups  = tn_get_json_meta( $post_id, 'tn_photo_gallery' );
$ratio   = '4-3';
?>
<?php if ( $groups ) : ?>
	<?php foreach ( $groups as $group ) : ?>
		<?php
		$label = $group['label'] ?? '';
		$ids   = $group['ids'] ?? array();
		if ( empty( $ids ) ) {
			continue;
		}
		?>
		<div class="photo-journal-group">
			<?php if ( $label ) : ?>
				<h4><?php echo esc_html( $label ); ?></h4>
			<?php endif; ?>
			<div class="masonry">
				<?php foreach ( $ids as $attachment_id ) : ?>
					<?php
					$full_url = wp_get_attachment_image_url( $attachment_id, 'full' );
					$alt      = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
					if ( ! $alt ) {
						$alt = $label ? $label : get_the_title( $post_id );
					}
					?>
					<a
						class="placeholder-img has-photo ratio-<?php echo esc_attr( $ratio ); ?> lightbox-trigger"
						href="<?php echo esc_url( $full_url ); ?>"
						data-lightbox
						aria-label="<?php echo esc_attr( $alt ); ?>"
					>
						<?php echo wp_get_attachment_image( $attachment_id, 'tn-card', false, array( 'alt' => esc_attr( $alt ), 'loading' => 'lazy' ) ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add photo journal groups and upload real photos for this trek in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>
