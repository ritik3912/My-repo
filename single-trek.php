<?php
/**
 * Single Trek template — the full trek detail page.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$post_id       = get_the_ID();
	$region        = tn_first_term( $post_id, 'trek_region' );
	$difficulty    = tn_first_term( $post_id, 'trek_difficulty' );
	$duration_txt  = tn_meta( $post_id, 'tn_duration_text' );
	$highest_point = tn_meta( $post_id, 'tn_highest_point' );
	$best_season   = tn_meta( $post_id, 'tn_best_season' );
	$has_real_exp  = tn_meta( $post_id, 'tn_has_real_experience' );
	$thumb_id      = get_post_thumbnail_id( $post_id );
	?>

	<article <?php post_class( 'trek-single' ); ?>>

		<section class="trek-hero">
			<?php
			echo tn_image(
				array(
					'attachment_id' => $thumb_id,
					'label'         => get_the_title() . ' — ' . __( 'add a large hero photo', 'trail-notes' ),
					'ratio'         => '16-9',
				)
			);
			?>
			<div class="hero-scrim"></div>
			<div class="container trek-hero-content">
				<span class="eyebrow"><?php echo tn_value_or_placeholder( $region ? $region->name : '', __( 'Add region', 'trail-notes' ) ); ?></span>
				<h1><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<div class="trek-hero-meta">
					<?php if ( $difficulty ) : ?>
						<span class="badge badge-outline"><?php echo esc_html( $difficulty->name ); ?></span>
					<?php endif; ?>
					<?php if ( $duration_txt ) : ?>
						<span class="badge badge-outline"><?php echo esc_html( $duration_txt ); ?></span>
					<?php endif; ?>
					<?php if ( $highest_point ) : ?>
						<span class="badge badge-outline"><?php echo esc_html( $highest_point ); ?></span>
					<?php endif; ?>
					<?php if ( $best_season ) : ?>
						<span class="badge badge-outline"><?php echo esc_html( $best_season ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<?php
		tn_breadcrumbs(
			array(
				array( 'label' => __( 'Home', 'trail-notes' ), 'url' => home_url( '/' ) ),
				array( 'label' => __( 'My Treks', 'trail-notes' ), 'url' => home_url( '/treks/' ) ),
				array( 'label' => get_the_title() ),
			)
		);
		?>

		<section class="section-tight">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Quick Info', 'trail-notes' ); ?></span>
				</div>
				<?php get_template_part( 'template-parts/quick-info', null, array( 'post_id' => $post_id ) ); ?>
			</div>
		</section>

		<section class="section section-alt">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'First Person', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'My Experience', 'trail-notes' ); ?></h2>
				</div>
				<div class="entry-content reveal">
					<?php if ( $has_real_exp && get_the_content() ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<p><?php echo tn_placeholder_text( __( "Add your first-person account of this trek here (Edit Trek → main content area). Write it the way you'd tell a friend — what surprised you, what was hard, what made it worth it.", 'trail-notes' ) ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Getting There', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'How to Reach', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/route-timeline', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<section class="section section-alt">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Plan Your Days', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'Day-by-Day Itinerary', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/itinerary', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Budget', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'What I Spent', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/cost-breakdown', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<section class="section section-alt">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Gear', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'What I Carried', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/packing-list', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Weather', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'Best Time to Go', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/seasons', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<section class="section section-alt">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Learn From My Mistakes', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'Things I Wish I Knew Before Going', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/wish-i-knew', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php esc_html_e( 'Suitability', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'Is This Trek For You?', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/suitability', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<section class="section section-alt">
			<div class="container">
				<div class="section-head reveal">
					<span class="eyebrow"><?php echo tn_icon( 'camera', 'visually-hidden' ); ?><?php esc_html_e( 'Photo Journal', 'trail-notes' ); ?></span>
					<h2><?php esc_html_e( 'Along the Trail', 'trail-notes' ); ?></h2>
				</div>
				<div class="reveal"><?php get_template_part( 'template-parts/photo-gallery', null, array( 'post_id' => $post_id ) ); ?></div>
			</div>
		</section>

		<?php
		$related = get_posts(
			array(
				'post_type'      => 'trek',
				'posts_per_page' => 3,
				'post__not_in'   => array( $post_id ),
				'orderby'        => 'rand',
			)
		);
		if ( $related ) :
			?>
			<section class="section related-treks">
				<div class="container">
					<div class="section-head reveal">
						<span class="eyebrow"><?php esc_html_e( 'Keep Exploring', 'trail-notes' ); ?></span>
						<h2><?php esc_html_e( 'More Trails to Walk', 'trail-notes' ); ?></h2>
					</div>
					<div class="grid grid-3">
						<?php
						foreach ( $related as $rel ) {
							get_template_part( 'template-parts/trek-card', null, array( 'post_id' => $rel->ID ) );
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
		<?php endif; ?>

	</article>

	<?php
endwhile;

get_footer();
