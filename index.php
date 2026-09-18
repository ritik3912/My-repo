<?php
/**
 * Fallback template — also the blog listing if a "Posts page" is set in
 * Settings → Reading, for future journal-style posts (see README.md).
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="section-tight section-alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'Journal', 'trail-notes' ); ?></span>
			<h1><?php esc_html_e( 'Latest Posts', 'trail-notes' ); ?></h1>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="grid grid-3">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'trek-card reveal' ); ?>>
						<div class="trek-card-media">
							<a href="<?php the_permalink(); ?>">
								<?php
								echo tn_image(
									array(
										'attachment_id' => get_post_thumbnail_id(),
										'label'         => get_the_title() . ' — ' . __( 'add a featured photo', 'trail-notes' ),
										'ratio'         => '4-3',
									)
								);
								?>
							</a>
						</div>
						<div class="trek-card-body">
							<span class="trek-card-location"><?php echo esc_html( get_the_date() ); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="trek-card-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>
			<nav class="pagination">
				<?php echo paginate_links(); ?>
			</nav>
		<?php else : ?>
			<p class="body-text"><?php esc_html_e( 'Nothing published here yet.', 'trail-notes' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
