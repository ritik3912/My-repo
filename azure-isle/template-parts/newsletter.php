<?php
/**
 * Newsletter band above the footer.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_action = azure_mod( 'news_action' );
?>
<section class="az-newsletter" id="newsletter">
	<div class="az-bg">
		<?php echo azure_image( (int) azure_mod( 'news_image' ), __( 'Customize → Site Settings → Newsletter: background image', 'azure-isle' ), 'az-cover tone-deep', 'full' ); ?>
	</div>
	<div class="az-container az-newsletter-inner">
		<div class="az-newsletter-text reveal">
			<?php if ( azure_mod( 'news_eyebrow' ) ) : ?>
				<span class="az-eyebrow az-eyebrow-light"><?php echo esc_html( azure_mod( 'news_eyebrow' ) ); ?></span>
			<?php endif; ?>
			<h2><?php echo esc_html( azure_mod( 'news_title' ) ); ?></h2>
		</div>
		<form class="az-newsletter-form reveal" method="post" action="<?php echo esc_url( $azure_action ? $azure_action : admin_url( 'admin-post.php' ) ); ?>">
			<?php
			azure_form_notice(
				'az_news',
				array(
					'ok'      => __( 'Thank you for subscribing!', 'azure-isle' ),
					'invalid' => __( 'Please enter a valid email and accept the privacy policy.', 'azure-isle' ),
					'error'   => __( 'Something went wrong. Please try again.', 'azure-isle' ),
				)
			);
			?>
			<div class="az-newsletter-row">
				<label class="screen-reader-text" for="az-news-email"><?php esc_html_e( 'Email address', 'azure-isle' ); ?></label>
				<input type="email" id="az-news-email" name="email" placeholder="<?php esc_attr_e( 'Your Email Address', 'azure-isle' ); ?>" required>
				<button type="submit" class="az-newsletter-submit"><?php esc_html_e( 'Subscribe', 'azure-isle' ); ?> <?php echo azure_icon( 'arrow' ); ?></button>
			</div>
			<?php if ( ! $azure_action ) : ?>
				<input type="hidden" name="action" value="azure_newsletter">
				<?php wp_nonce_field( 'azure_news', 'azure_news_nonce' ); ?>
				<input type="text" name="az_website" class="az-hp" tabindex="-1" autocomplete="off" aria-hidden="true">
			<?php endif; ?>
			<?php if ( azure_mod( 'news_consent' ) ) : ?>
				<label class="az-check">
					<input type="checkbox" name="az_consent" value="1" required>
					<span><?php echo esc_html( azure_mod( 'news_consent' ) ); ?></span>
				</label>
			<?php else : ?>
				<input type="hidden" name="az_consent" value="1">
			<?php endif; ?>
		</form>
	</div>
</section>
