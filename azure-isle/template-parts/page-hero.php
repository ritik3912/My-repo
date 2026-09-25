<?php
/**
 * Image banner for the About and Contact templates.
 *
 * Args: image (attachment ID), eyebrow, title, text, label (placeholder text).
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="az-hero az-hero-page">
	<div class="az-hero-media">
		<?php echo azure_image( (int) $args['image'], $args['label'], 'az-cover', 'full' ); ?>
	</div>
	<div class="az-hero-scrim"></div>
	<div class="az-hero-content">
		<?php if ( ! empty( $args['eyebrow'] ) ) : ?>
			<span class="az-eyebrow az-eyebrow-light"><?php echo esc_html( $args['eyebrow'] ); ?></span>
		<?php endif; ?>
		<h1><?php echo esc_html( $args['title'] ); ?></h1>
		<?php if ( ! empty( $args['text'] ) ) : ?>
			<p><?php echo esc_html( $args['text'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
