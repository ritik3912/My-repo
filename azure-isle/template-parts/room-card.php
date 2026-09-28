<?php
/**
 * Room card, used on the front page slider and the Rooms archive.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_price = get_post_meta( get_the_ID(), '_azure_price', true );
$azure_view  = get_post_meta( get_the_ID(), '_azure_view', true );
$azure_delay = isset( $args['delay'] ) ? (int) $args['delay'] : 0;
$azure_icons = array(
	'_azure_size'   => 'size',
	'_azure_guests' => 'guests',
	'_azure_bed'    => 'bed',
);
?>
<article <?php post_class( 'az-room reveal' ); ?> style="--delay: <?php echo esc_attr( $azure_delay ); ?>ms">
	<a href="<?php the_permalink(); ?>" class="az-room-media" tabindex="-1" aria-hidden="true">
		<?php echo azure_image( get_post_thumbnail_id(), __( 'Set this room\'s Featured Image', 'azure-isle' ), 'ratio-4-3', 'azure-wide' ); ?>
		<?php if ( $azure_view || $azure_price ) : ?>
			<span class="az-room-tag">
				<?php
				if ( $azure_price ) {
					/* translators: %s: nightly price. */
					printf( esc_html__( 'From %s', 'azure-isle' ), esc_html( $azure_price ) );
				} else {
					echo esc_html( $azure_view );
				}
				?>
			</span>
		<?php endif; ?>
	</a>
	<div class="az-room-body">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php $azure_meta = azure_room_meta( get_the_ID() ); ?>
		<?php if ( $azure_meta ) : ?>
			<ul class="az-room-meta">
				<?php foreach ( $azure_meta as $key => $value ) : ?>
					<li><?php echo azure_icon( $azure_icons[ $key ] ); ?><?php echo esc_html( $value ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<?php if ( has_excerpt() ) : ?>
			<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>" class="az-link"><?php esc_html_e( 'Discover More', 'azure-isle' ); ?> <?php echo azure_icon( 'arrow' ); ?></a>
	</div>
</article>
