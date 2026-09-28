<?php
/**
 * Simple title band for inner pages.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="az-page-head">
	<div class="az-container az-narrow">
		<?php if ( ! empty( $args['eyebrow'] ) ) : ?>
			<span class="az-eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></span>
		<?php endif; ?>
		<h1><?php echo wp_kses_post( $args['title'] ); ?></h1>
		<?php if ( ! empty( $args['text'] ) ) : ?>
			<p><?php echo wp_kses_post( $args['text'] ); ?></p>
		<?php endif; ?>
	</div>
</header>
