<?php
/**
 * Fallback template: blog index, archives and search results.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( is_search() ) {
	/* translators: %s: search query. */
	$azure_title = sprintf( __( 'Results for “%s”', 'azure-isle' ), get_search_query() );
	$azure_eye   = __( 'Search', 'azure-isle' );
	$azure_text  = '';
} elseif ( is_archive() ) {
	$azure_title = get_the_archive_title();
	$azure_eye   = __( 'Archive', 'azure-isle' );
	$azure_text  = get_the_archive_description();
} else {
	$azure_title = is_home() && get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Journal', 'azure-isle' );
	$azure_eye   = __( 'Stories from the Island', 'azure-isle' );
	$azure_text  = '';
}

get_template_part( 'template-parts/page-header', null, array( 'eyebrow' => $azure_eye, 'title' => esc_html( $azure_title ), 'text' => $azure_text ) );
?>

<section class="az-section az-section-tight">
	<div class="az-container">
		<?php if ( have_posts() ) : ?>
			<div class="az-post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'az-post-card reveal' ); ?>>
						<a href="<?php the_permalink(); ?>" class="az-post-media">
							<?php echo azure_image( get_post_thumbnail_id(), __( 'Add a featured image', 'azure-isle' ), 'ratio-4-3', 'azure-wide' ); ?>
						</a>
						<span class="az-post-date"><?php echo esc_html( get_the_date() ); ?></span>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
						<a href="<?php the_permalink(); ?>" class="az-link"><?php esc_html_e( 'Read More', 'azure-isle' ); ?> <?php echo azure_icon( 'arrow' ); ?></a>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
		<?php else : ?>
			<div class="az-narrow az-center">
				<p><?php esc_html_e( 'Nothing found here yet.', 'azure-isle' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
