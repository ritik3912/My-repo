<?php
/**
 * Full-width mountain-background CTA banner. Reused for the homepage
 * final CTA and can be dropped into any page.
 *
 * @param array $args { string $heading, string $copy, string $button_label, string $button_url, string $image_label }
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading      = $args['heading'] ?? '';
$copy         = $args['copy'] ?? '';
$button_label = $args['button_label'] ?? '';
$button_url   = $args['button_url'] ?? '#';
$image_label  = $args['image_label'] ?? __( 'Add a wide mountain landscape photo', 'trail-notes' );
?>
<div class="cta-banner reveal">
	<?php echo tn_image( array( 'label' => $image_label, 'ratio' => '21-9' ) ); ?>
	<div class="cta-banner-scrim"></div>
	<div class="cta-banner-content">
		<h2><?php echo esc_html( $heading ); ?></h2>
		<?php if ( $copy ) : ?>
			<p class="lede"><?php echo esc_html( $copy ); ?></p>
		<?php endif; ?>
		<?php if ( $button_label ) : ?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="btn btn-light"><?php echo esc_html( $button_label ); ?> <?php echo tn_icon( 'arrow' ); ?></a>
		<?php endif; ?>
	</div>
</div>
