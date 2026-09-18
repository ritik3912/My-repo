<?php
/**
 * Trail videos: a YouTube/Vimeo embed or a self-hosted file uploaded to
 * the Media Library (Trek Videos meta box).
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();
$videos  = tn_get_json_meta( $post_id, 'tn_videos' );
?>
<?php if ( $videos ) : ?>
	<div class="grid grid-2 video-gallery">
		<?php foreach ( $videos as $video ) : ?>
			<?php
			$embed = tn_video_embed_html( $video );
			if ( ! $embed ) {
				continue;
			}
			?>
			<figure class="video-card">
				<div class="video-responsive"><?php echo $embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by tn_video_embed_html(), which escapes every attribute it prints. ?></div>
				<?php if ( ! empty( $video['label'] ) ) : ?>
					<figcaption><?php echo esc_html( $video['label'] ); ?></figcaption>
				<?php endif; ?>
			</figure>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<p class="body-text"><?php echo tn_placeholder_text( __( 'Add a YouTube/Vimeo link or upload a trail video for this trek in the trek editor.', 'trail-notes' ) ); ?></p>
<?php endif; ?>
