<?php
/**
 * 404 template.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="section text-center">
	<div class="container reveal">
		<span class="eyebrow"><?php esc_html_e( 'Lost the Trail?', 'trail-notes' ); ?></span>
		<h1><?php esc_html_e( "Page Not Found", 'trail-notes' ); ?></h1>
		<p class="lede" style="margin-inline:auto;"><?php esc_html_e( "This path doesn't exist — but there are plenty that do.", 'trail-notes' ); ?></p>
		<div class="hero-actions" style="justify-content:center;margin-top:2rem;">
			<a href="<?php echo esc_url( home_url( '/treks/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Explore the Treks', 'trail-notes' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'Back Home', 'trail-notes' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
