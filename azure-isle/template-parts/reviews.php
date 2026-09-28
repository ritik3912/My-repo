<?php
/**
 * Guest review slider over a background image (front and About pages).
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_reviews = array();
for ( $n = 1; $n <= 3; $n++ ) {
	if ( azure_mod( "review_{$n}_quote" ) ) {
		$azure_reviews[] = array(
			'quote' => azure_mod( "review_{$n}_quote" ),
			'name'  => azure_mod( "review_{$n}_name" ),
			'from'  => azure_mod( "review_{$n}_from" ),
		);
	}
}
if ( ! $azure_reviews ) {
	return;
}
?>
<section class="az-reviews">
	<div class="az-bg">
		<?php echo azure_image( (int) azure_mod( 'reviews_image' ), __( 'Customize → Front Page → Guest Reviews: background image', 'azure-isle' ), 'az-cover tone-deep', 'full' ); ?>
	</div>
	<div class="az-container az-narrow reveal">
		<span class="az-eyebrow az-eyebrow-light"><?php echo esc_html( azure_mod( 'reviews_eyebrow' ) ); ?></span>
		<div class="az-slider" data-az-slider>
			<?php foreach ( $azure_reviews as $index => $review ) : ?>
				<figure class="az-slide <?php echo 0 === $index ? 'is-active' : ''; ?>" aria-hidden="<?php echo 0 === $index ? 'false' : 'true'; ?>">
					<blockquote>&ldquo;<?php echo esc_html( $review['quote'] ); ?>&rdquo;</blockquote>
					<figcaption>
						<strong><?php echo esc_html( $review['name'] ); ?></strong>
						<?php if ( $review['from'] ) : ?>
							<span>&mdash; <?php echo esc_html( $review['from'] ); ?></span>
						<?php endif; ?>
					</figcaption>
					<div class="az-stars" role="img" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'azure-isle' ); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
				</figure>
			<?php endforeach; ?>
			<?php if ( count( $azure_reviews ) > 1 ) : ?>
				<div class="az-dots">
					<?php foreach ( $azure_reviews as $index => $review ) : ?>
						<button type="button" class="az-dot <?php echo 0 === $index ? 'is-active' : ''; ?>" data-az-dot="<?php echo esc_attr( $index ); ?>">
							<span class="screen-reader-text">
								<?php
								/* translators: %d: review number. */
								printf( esc_html__( 'Show review %d', 'azure-isle' ), (int) $index + 1 );
								?>
							</span>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
