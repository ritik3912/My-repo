<?php
/**
 * The header: doctype, <head>, skip link, sticky nav, mobile menu.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'trail-notes' ); ?></a>

<header class="site-header" id="site-header">
	<div class="container nav-inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav-links',
				'fallback_cb'    => 'tn_default_primary_menu',
				'depth'          => 1,
			)
		);
		?>

		<div class="nav-actions">
			<a href="<?php echo esc_url( home_url( '/plan-a-trek/' ) ); ?>" class="btn btn-primary nav-cta">
				<?php esc_html_e( 'Plan a Trek', 'trail-notes' ); ?>
			</a>
			<button type="button" class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="mobile-nav">
				<span></span><span></span><span></span>
				<span class="visually-hidden"><?php esc_html_e( 'Open menu', 'trail-notes' ); ?></span>
			</button>
		</div>
	</div>
</header>

<div class="mobile-nav" id="mobile-nav">
	<div class="mobile-nav-head">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand"><?php bloginfo( 'name' ); ?></a>
		<button type="button" class="mobile-nav-close" id="mobile-nav-close">
			&times;
			<span class="visually-hidden"><?php esc_html_e( 'Close menu', 'trail-notes' ); ?></span>
		</button>
	</div>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'mobile-nav-links',
			'fallback_cb'    => 'tn_default_primary_menu',
			'depth'          => 1,
		)
	);
	?>
	<a href="<?php echo esc_url( home_url( '/plan-a-trek/' ) ); ?>" class="btn btn-primary">
		<?php esc_html_e( 'Plan a Trek', 'trail-notes' ); ?>
	</a>
</div>

<main id="main">
