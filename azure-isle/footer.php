<?php
/**
 * Footer: newsletter band, contact columns, social icons, bottom bar.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$azure_email = azure_mod( 'email' );
$azure_phone = azure_mod( 'phone' );
$azure_addr  = azure_mod( 'address' );
?>
</main>

<?php
if ( 'yes' === azure_mod( 'news_show' ) ) {
	get_template_part( 'template-parts/newsletter' );
}
?>

<footer class="az-footer" id="contact">
	<div class="az-container">
		<div class="az-footer-top">
			<div class="az-footer-col">
				<h4><?php esc_html_e( 'Address', 'azure-isle' ); ?></h4>
				<p><?php echo $azure_addr ? nl2br( esc_html( $azure_addr ) ) : '&mdash;'; ?></p>
			</div>
			<div class="az-footer-col">
				<h4><?php esc_html_e( 'Phone', 'azure-isle' ); ?></h4>
				<p>
					<?php if ( $azure_phone ) : ?>
						<a href="<?php echo esc_attr( azure_tel( $azure_phone ) ); ?>"><?php echo esc_html( $azure_phone ); ?></a>
					<?php else : ?>
						&mdash;
					<?php endif; ?>
				</p>
			</div>
			<div class="az-footer-col">
				<h4><?php esc_html_e( 'Email', 'azure-isle' ); ?></h4>
				<p>
					<?php if ( $azure_email ) : ?>
						<a href="mailto:<?php echo esc_attr( antispambot( $azure_email ) ); ?>"><?php echo esc_html( antispambot( $azure_email ) ); ?></a>
					<?php else : ?>
						&mdash;
					<?php endif; ?>
				</p>
			</div>
			<div class="az-footer-col az-footer-social">
				<?php azure_social_links(); ?>
			</div>
		</div>
	</div>

	<div class="az-footer-bottom">
		<div class="az-container">
			<span>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( azure_mod( 'copyright' ) ? azure_mod( 'copyright' ) : get_bloginfo( 'name' ) . '. ' . __( 'All rights reserved.', 'azure-isle' ) ); ?></span>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'az-footer-menu',
						'depth'          => 1,
					)
				);
			} else {
				echo '<a href="#main">' . esc_html__( 'Back to top', 'azure-isle' ) . ' &uarr;</a>';
			}
			?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
