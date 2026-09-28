<?php
/**
 * Image carousel with arrows and a handwritten line (front and About pages).
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_slides = array();
for ( $n = 1; $n <= 6; $n++ ) {
	$azure_slides[ $n ] = (int) azure_mod( "carousel_{$n}" );
}
// With no photos set, show four placeholders; otherwise only the filled slots.
$azure_filled = array_filter( $azure_slides );
if ( $azure_filled ) {
	$azure_slides = $azure_filled;
} else {
	$azure_slides = array_slice( $azure_slides, 0, 4, true );
}
?>
<section class="az-carousel-section">
	<div class="az-carousel" data-az-carousel>
		<button type="button" class="az-arrow az-arrow-prev" data-az-prev>
			<?php echo azure_icon( 'prev' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Previous', 'azure-isle' ); ?></span>
		</button>
		<div class="az-track" data-az-track>
			<?php foreach ( $azure_slides as $n => $azure_id ) : ?>
				<div class="az-carousel-slide">
					<?php
					/* translators: %d: image number. */
					echo azure_image( $azure_id, sprintf( __( 'Customize → Front Page → Image Carousel: image %d', 'azure-isle' ), $n ), 'az-cover' . ( 0 === $n % 2 ? ' tone-sand' : '' ), 'azure-card' );
					?>
				</div>
			<?php endforeach; ?>
		</div>
		<button type="button" class="az-arrow az-arrow-next" data-az-next>
			<?php echo azure_icon( 'next' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Next', 'azure-isle' ); ?></span>
		</button>
	</div>
	<?php if ( azure_mod( 'carousel_script' ) ) : ?>
		<div class="az-container">
			<p class="az-script reveal"><?php echo esc_html( azure_mod( 'carousel_script' ) ); ?></p>
		</div>
	<?php endif; ?>
</section>
