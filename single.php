<?php
/**
 * Single blog post template (standard WordPress posts, distinct from the
 * Trek post type which uses single-trek.php).
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class(); ?>>
		<section class="section-tight section-alt">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php echo esc_html( get_the_date() ); ?></span>
					<h1><?php the_title(); ?></h1>
				</div>
			</div>
		</section>
		<section class="section">
			<div class="container">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="reveal" style="margin-bottom:2.5rem;">
						<?php echo tn_image( array( 'attachment_id' => get_post_thumbnail_id(), 'label' => get_the_title(), 'ratio' => '16-9' ) ); ?>
					</div>
				<?php endif; ?>
				<div class="entry-content reveal">
					<?php the_content(); ?>
				</div>
			</div>
		</section>
	</article>
	<?php
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
endwhile;

get_footer();
