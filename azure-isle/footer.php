<?php
/**
 * Footer: brand, contact, menu, social, copyright.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_email = azure_mod( 'email' );
$azure_phone = azure_mod( 'phone' );
$azure_addr  = azure_mod( 'address' );
$azure_ig    = azure_mod( 'instagram_url' );
$azure_fb    = azure_mod( 'facebook_url' );
?>
</main>

<footer class="az-footer" id="contact">
	<div class="az-container">
		<div class="az-footer-top">
			<div class="az-footer-brand">
				<?php azure_logo( 'az-logo az-logo-footer' ); ?>
				<?php if ( azure_mod( 'footer_about' ) ) : ?>
					<p><?php echo esc_html( azure_mod( 'footer_about' ) ); ?></p>
				<?php endif; ?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Contact', 'azure-isle' ); ?></h4>
				<ul>
					<?php if ( $azure_addr ) : ?>
						<li><?php echo nl2br( esc_html( $azure_addr ) ); ?></li>
					<?php endif; ?>
					<?php if ( $azure_phone ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $azure_phone ) ); ?>"><?php echo esc_html( $azure_phone ); ?></a></li>
					<?php endif; ?>
					<?php if ( $azure_email ) : ?>
						<li><a href="mailto:<?php echo esc_attr( antispambot( $azure_email ) ); ?>"><?php echo esc_html( antispambot( $azure_email ) ); ?></a></li>
					<?php endif; ?>
					<?php if ( ! $azure_addr && ! $azure_phone && ! $azure_email && current_user_can( 'edit_theme_options' ) ) : ?>
						<li><em><?php esc_html_e( 'Add your address, phone and email in Customize → Footer & Contact.', 'azure-isle' ); ?></em></li>
					<?php endif; ?>
				</ul>
			</div>

			<div>
				<h4><?php esc_html_e( 'Explore', 'azure-isle' ); ?></h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => 'azure_menu_fallback',
					)
				);
				?>
			</div>

			<div>
				<h4><?php esc_html_e( 'Follow', 'azure-isle' ); ?></h4>
				<ul>
					<?php if ( $azure_ig ) : ?>
						<li><a href="<?php echo esc_url( $azure_ig ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Instagram', 'azure-isle' ); ?></a></li>
					<?php endif; ?>
					<?php if ( $azure_fb ) : ?>
						<li><a href="<?php echo esc_url( $azure_fb ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Facebook', 'azure-isle' ); ?></a></li>
					<?php endif; ?>
					<li><a href="<?php echo esc_url( azure_booking_url() ); ?>" class="az-link"><?php esc_html_e( 'Book Your Stay', 'azure-isle' ); ?> <?php echo azure_icon( 'arrow' ); ?></a></li>
				</ul>
			</div>
		</div>

		<div class="az-footer-bottom">
			<span>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( azure_mod( 'copyright' ) ? azure_mod( 'copyright' ) : get_bloginfo( 'name' ) . '. ' . __( 'All rights reserved.', 'azure-isle' ) ); ?></span>
			<a href="#main"><?php esc_html_e( 'Back to top', 'azure-isle' ); ?> &uarr;</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
