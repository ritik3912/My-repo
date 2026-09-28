<?php
/**
 * Single blog post.
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
		'template-parts/page-header',
		null,
		array(
			'eyebrow' => get_the_date(),
			'title'   => esc_html( get_the_title() ),
		)
	);
	?>
	<article <?php post_class( 'az-section az-section-tight' ); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="az-container az-entry-hero">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		<?php endif; ?>
		<div class="az-entry">
			<?php
			the_content();
			wp_link_pages();
			?>
			<footer class="az-entry-meta">
				<?php the_category( ', ' ); ?>
				<?php the_tags( '<span>', ', ', '</span>' ); ?>
			</footer>
			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span>' . esc_html__( 'Previous', 'azure-isle' ) . '</span>%title',
					'next_text' => '<span>' . esc_html__( 'Next', 'azure-isle' ) . '</span>%title',
				)
			);
			?>
		</div>
		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</article>
	<?php
endwhile;

get_footer();
