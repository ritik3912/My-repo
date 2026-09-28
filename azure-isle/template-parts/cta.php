<?php
/**
 * Call-to-action band above the footer: heading, text, two buttons and the
 * address over a background photo.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_addr = azure_mod( 'address' );
?>
<section class="az-cta" id="availability">
	<div class="az-bg">
		<?php echo azure_image( (int) azure_mod( 'cta_image' ), __( 'Customize → Site Settings → Call to Action: background image', 'azure-isle' ), 'az-cover tone-deep', 'full' ); ?>
	</div>
	<div class="az-container az-narrow az-cta-inner reveal">
		<span class="az-welcome-icon"><?php echo azure_icon( 'key' ); ?></span>
		<?php if ( azure_mod( 'cta_eyebrow' ) ) : ?>
			<span class="az-eyebrow az-eyebrow-light"><?php echo esc_html( azure_mod( 'cta_eyebrow' ) ); ?></span>
		<?php endif; ?>
		<h2 class="az-title"><?php echo esc_html( azure_mod( 'cta_title' ) ); ?></h2>
		<?php if ( azure_mod( 'cta_text' ) ) : ?>
			<p><?php echo esc_html( azure_mod( 'cta_text' ) ); ?></p>
		<?php endif; ?>
		<?php if ( azure_mod( 'cta_button' ) || azure_mod( 'cta_button_2' ) ) : ?>
			<div class="az-cta-actions">
				<?php if ( azure_mod( 'cta_button' ) ) : ?>
					<a href="<?php echo esc_url( azure_booking_url() ); ?>" class="az-btn az-btn-gold"><?php echo esc_html( azure_mod( 'cta_button' ) ); ?></a>
				<?php endif; ?>
				<?php if ( azure_mod( 'cta_button_2' ) ) : ?>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'azure_room' ) ); ?>" class="az-btn az-btn-line"><?php echo esc_html( azure_mod( 'cta_button_2' ) ); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( $azure_addr ) : ?>
			<p class="az-cta-address"><?php echo azure_icon( 'pin' ); ?><span><?php echo esc_html( preg_replace( '/\s*\n\s*/', ' ', $azure_addr ) ); ?></span></p>
		<?php endif; ?>
	</div>
</section>
