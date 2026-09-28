<?php
/**
 * Template Name: Gallery Page
 *
 * Banner, heading and the photos from the page editor (a Gallery block or a
 * [gallery] shortcode) shown as a grid that opens in a full-screen viewer.
 * Banner and heading text come from Appearance → Customize → Azure Isle —
 * Gallery Page.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'image'   => azure_page_hero_image( 'gallery_hero_image' ),
			'label'   => __( 'Customize → Gallery Page → Page Header: background image', 'azure-isle' ),
			'eyebrow' => azure_mod( 'gallery_hero_eyebrow' ),
			'title'   => get_the_title(),
			'text'    => azure_mod( 'gallery_hero_text' ),
		)
	);
	?>

	<section class="az-section az-gallery-section">
		<div class="az-container">
			<div class="az-head reveal">
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'gallery_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'gallery_title' ) ); ?></h2>
				<?php if ( azure_mod( 'gallery_text' ) ) : ?>
					<p><?php echo esc_html( azure_mod( 'gallery_text' ) ); ?></p>
				<?php endif; ?>
			</div>
			<div class="az-gallery" data-az-gallery>
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
