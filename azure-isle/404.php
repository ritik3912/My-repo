<?php
/**
 * Not found.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part(
	'template-parts/page-header',
	null,
	array(
		'eyebrow' => '404',
		'title'   => esc_html__( 'Page Not Found', 'azure-isle' ),
		'text'    => esc_html__( 'The page you were looking for could not be found. Try a search, or head back to the home page.', 'azure-isle' ),
	)
);
?>
<section class="az-section az-section-tight">
	<div class="az-container az-narrow az-center">
		<?php get_search_form(); ?>
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="az-btn az-btn-dark"><?php esc_html_e( 'Back to Home', 'azure-isle' ); ?></a></p>
	</div>
</section>
<?php
get_footer();
