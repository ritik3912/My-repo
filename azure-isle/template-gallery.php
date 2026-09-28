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
			<?php
			// Photos from the first Gallery block or [gallery] shortcode in the
			// page, shown as an even grid; other content follows unchanged.
			$azure_gallery = get_post_gallery( get_the_ID(), false );
			$azure_ids     = ! empty( $azure_gallery['ids'] ) ? wp_parse_id_list( $azure_gallery['ids'] ) : array();
			?>
			<?php if ( $azure_ids ) : ?>
				<ul class="az-gallery-grid" data-az-gallery>
					<?php foreach ( $azure_ids as $azure_i => $azure_id ) : ?>
						<?php
						if ( ! wp_attachment_is_image( $azure_id ) ) {
							continue;
						}
						$azure_caption = wp_get_attachment_caption( $azure_id );
						?>
						<li class="reveal" style="--delay: <?php echo esc_attr( ( $azure_i % 4 ) * 80 ); ?>ms">
							<a class="az-shot" href="<?php echo esc_url( wp_get_attachment_image_url( $azure_id, 'full' ) ); ?>" data-caption="<?php echo esc_attr( $azure_caption ); ?>">
								<?php echo wp_get_attachment_image( $azure_id, 'medium_large', false, array( 'loading' => 'lazy', 'alt' => $azure_caption ) ); ?>
								<span class="az-shot-zoom" aria-hidden="true">+</span>
								<?php if ( $azure_caption ) : ?>
									<span class="az-shot-caption"><?php echo esc_html( $azure_caption ); ?></span>
								<?php endif; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<div class="az-entry"><?php the_content(); ?></div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endwhile;

get_footer();
