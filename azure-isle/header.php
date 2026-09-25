<?php
/**
 * Header: transparent over a hero (front page, single room), solid elsewhere.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>document.documentElement.classList.remove( 'no-js' );</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'azure-isle' ); ?></a>

<header class="az-header" id="az-header">
	<div class="az-header-inner">
		<div class="az-header-left">
			<button type="button" class="az-menu-toggle" id="az-menu-toggle" aria-expanded="false" aria-controls="az-menu">
				<span></span><span></span>
				<span class="az-menu-label"><?php esc_html_e( 'Menu', 'azure-isle' ); ?></span>
			</button>
		</div>

		<?php azure_logo(); ?>

		<div class="az-header-right">
			<?php if ( azure_mod( 'header_phone' ) ) : ?>
				<a href="<?php echo esc_attr( azure_tel( azure_mod( 'header_phone' ) ) ); ?>" class="az-header-phone"><?php echo azure_icon( 'phone' ); ?><span><?php echo esc_html( azure_mod( 'header_phone' ) ); ?></span></a>
			<?php endif; ?>
			<?php if ( azure_mod( 'header_button' ) ) : ?>
				<a href="<?php echo esc_url( azure_booking_url() ); ?>" class="az-btn az-btn-line az-header-cta"><?php echo esc_html( azure_mod( 'header_button' ) ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</header>

<div class="az-menu" id="az-menu" aria-hidden="true">
	<button type="button" class="az-menu-close" id="az-menu-close">
		&times;<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'azure-isle' ); ?></span>
	</button>
	<nav aria-label="<?php esc_attr_e( 'Main', 'azure-isle' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'az-menu-list',
				'depth'          => 1,
				'fallback_cb'    => 'azure_menu_fallback',
			)
		);
		?>
	</nav>
	<?php if ( azure_mod( 'header_button' ) ) : ?>
		<a href="<?php echo esc_url( azure_booking_url() ); ?>" class="az-btn az-btn-gold"><?php echo esc_html( azure_mod( 'header_button' ) ); ?></a>
	<?php endif; ?>
</div>

<main id="main">
