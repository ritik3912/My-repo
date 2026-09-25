<?php
/**
 * Room card, used on the front page and the Rooms archive.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_price = get_post_meta( get_the_ID(), '_azure_price', true );
$azure_delay = isset( $args['delay'] ) ? (int) $args['delay'] : 0;
?>
<article <?php post_class( 'az-room reveal' ); ?> style="--delay: <?php echo esc_attr( $azure_delay ); ?>ms">
	<a href="<?php the_permalink(); ?>" class="az-room-media">
		<?php echo azure_image( get_post_thumbnail_id(), __( 'Set this room\'s Featured Image', 'azure-isle' ), 'ratio-3-4', 'azure-card' ); ?>
		<?php if ( $azure_price ) : ?>
			<span class="az-room-price">
				<?php
				/* translators: %s: nightly price. */
				printf( esc_html__( 'From %s / night', 'azure-isle' ), esc_html( $azure_price ) );
				?>
			</span>
		<?php endif; ?>
	</a>
	<div class="az-room-body">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php $azure_meta = azure_room_meta( get_the_ID() ); ?>
		<?php if ( $azure_meta ) : ?>
			<ul class="az-room-meta">
				<?php foreach ( $azure_meta as $value ) : ?>
					<li><?php echo esc_html( $value ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</article>
