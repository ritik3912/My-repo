<?php
/**
 * Site footer: brand blurb, three navigation columns, disclaimer, credits.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tn_instagram = tn_social_url( 'tn_instagram_url' );
$tn_youtube   = tn_social_url( 'tn_youtube_url' );
$tn_email     = get_theme_mod( 'tn_contact_email', '' );
?>
</main>

<footer class="site-footer">
	<div class="container">
		<div class="footer-top">
			<div class="footer-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand"><?php bloginfo( 'name' ); ?></a>
				<p><?php esc_html_e( 'Real trek experiences and practical mountain guides from the trails I\'ve explored.', 'trail-notes' ); ?></p>
				<?php if ( $tn_instagram || $tn_youtube || $tn_email ) : ?>
					<div class="footer-social">
						<?php if ( $tn_instagram ) : ?>
							<a href="<?php echo esc_url( $tn_instagram ); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><?php echo tn_icon( 'camera' ); ?></a>
						<?php endif; ?>
						<?php if ( $tn_youtube ) : ?>
							<a href="<?php echo esc_url( $tn_youtube ); ?>" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><?php echo tn_icon( 'arrow' ); ?></a>
						<?php endif; ?>
						<?php if ( $tn_email ) : ?>
							<a href="mailto:<?php echo esc_attr( $tn_email ); ?>" aria-label="Email"><?php echo tn_icon( 'mountain' ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="footer-col">
				<h5><?php esc_html_e( 'Explore', 'trail-notes' ); ?></h5>
				<?php if ( has_nav_menu( 'footer-explore' ) ) : ?>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-explore', 'container' => false, 'menu_class' => '', 'depth' => 1 ) ); ?>
				<?php else : ?>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/treks/' ) ); ?>"><?php esc_html_e( 'My Treks', 'trail-notes' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/treks/' ) ); ?>"><?php esc_html_e( 'Trek Guides', 'trail-notes' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/travel-tips/' ) ); ?>"><?php esc_html_e( 'Travel Tips', 'trail-notes' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Me', 'trail-notes' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<div class="footer-col">
				<h5><?php esc_html_e( 'Popular Treks', 'trail-notes' ); ?></h5>
				<?php if ( has_nav_menu( 'footer-treks' ) ) : ?>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-treks', 'container' => false, 'menu_class' => '', 'depth' => 1 ) ); ?>
				<?php else : ?>
					<ul>
						<?php
						$tn_footer_treks = get_posts(
							array(
								'post_type'      => 'trek',
								'posts_per_page' => 4,
								'orderby'        => 'menu_order date',
								'order'          => 'ASC',
							)
						);
						foreach ( $tn_footer_treks as $tn_trek_post ) :
							?>
							<li><a href="<?php echo esc_url( get_permalink( $tn_trek_post ) ); ?>"><?php echo esc_html( get_the_title( $tn_trek_post ) ); ?></a></li>
							<?php
						endforeach;
						wp_reset_postdata();
						?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="footer-col">
				<h5><?php esc_html_e( 'Connect', 'trail-notes' ); ?></h5>
				<ul>
					<?php if ( $tn_instagram ) : ?>
						<li><a href="<?php echo esc_url( $tn_instagram ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Instagram', 'trail-notes' ); ?></a></li>
					<?php else : ?>
						<li><?php echo tn_placeholder_text( __( 'Add Instagram URL in Customizer', 'trail-notes' ) ); ?></li>
					<?php endif; ?>
					<?php if ( $tn_youtube ) : ?>
						<li><a href="<?php echo esc_url( $tn_youtube ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'YouTube', 'trail-notes' ); ?></a></li>
					<?php else : ?>
						<li><?php echo tn_placeholder_text( __( 'Add YouTube URL in Customizer', 'trail-notes' ) ); ?></li>
					<?php endif; ?>
					<?php if ( $tn_email ) : ?>
						<li><a href="mailto:<?php echo esc_attr( $tn_email ); ?>"><?php echo esc_html( $tn_email ); ?></a></li>
					<?php else : ?>
						<li><?php echo tn_placeholder_text( __( 'Add contact email in Customizer', 'trail-notes' ) ); ?></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'trail-notes' ); ?></span>
			<span><?php esc_html_e( 'Made with curiosity, backpacks & a love for the mountains.', 'trail-notes' ); ?></span>
		</div>
		<p class="footer-disclaimer">
			<?php esc_html_e( 'Travel information can change due to weather, local conditions, permits and seasonal accessibility. Always verify important details before your journey.', 'trail-notes' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
