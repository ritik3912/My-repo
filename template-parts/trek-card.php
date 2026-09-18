<?php
/**
 * Trek card — used on the homepage showcase, the treks archive and the
 * Trek Finder results. Carries data-* attributes so the Trek Finder can
 * filter it client-side without a page reload.
 *
 * @param array $args { int $post_id }
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : get_the_ID();

$difficulty  = tn_first_term( $post_id, 'trek_difficulty' );
$duration    = tn_first_term( $post_id, 'trek_duration' );
$region      = tn_first_term( $post_id, 'trek_region' );
$experience  = tn_first_term( $post_id, 'trek_experience_level' );
$thumb_id    = get_post_thumbnail_id( $post_id );
$duration_txt = tn_meta( $post_id, 'tn_duration_text' );
?>
<article
	class="trek-card reveal"
	data-trek-card
	data-difficulty="<?php echo esc_attr( $difficulty ? $difficulty->slug : '' ); ?>"
	data-duration="<?php echo esc_attr( $duration ? $duration->slug : '' ); ?>"
	data-region="<?php echo esc_attr( $region ? $region->slug : '' ); ?>"
	data-experience="<?php echo esc_attr( $experience ? $experience->slug : '' ); ?>"
>
	<div class="trek-card-media">
		<div class="trek-card-badges">
			<?php if ( $difficulty ) : ?>
				<span class="badge <?php echo esc_attr( tn_difficulty_badge_class( $difficulty->slug ) ); ?>"><?php echo esc_html( $difficulty->name ); ?></span>
			<?php endif; ?>
		</div>
		<?php
		echo tn_image(
			array(
				'attachment_id' => $thumb_id,
				'label'         => get_the_title( $post_id ) . ' — ' . __( 'add a hero photo', 'trail-notes' ),
				'ratio'         => '4-3',
			)
		);
		?>
	</div>
	<div class="trek-card-body">
		<span class="trek-card-location"><?php echo tn_value_or_placeholder( $region ? $region->name : '', __( 'Add region', 'trail-notes' ) ); ?></span>
		<h3><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a></h3>
		<p class="trek-card-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 22 ) ); ?></p>
		<div class="trek-card-footer">
			<span><?php echo $duration_txt ? esc_html( $duration_txt ) : tn_placeholder_text( __( 'Add duration', 'trail-notes' ) ); ?></span>
			<span class="btn-text"><?php esc_html_e( 'Explore the Trek', 'trail-notes' ); ?> <?php echo tn_icon( 'arrow' ); ?></span>
		</div>
	</div>
</article>
