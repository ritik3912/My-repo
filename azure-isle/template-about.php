<?php
/**
 * Template Name: About Page
 *
 * Banner, introduction with signature, facts and figures, values, our
 * story, then the shared carousel, services and guest reviews. Text and
 * images come from Appearance → Customize → Azure Isle — About Page; the
 * page's own editor content, if any, is shown after the introduction.
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
			'image'   => azure_page_hero_image( 'about_hero_image' ),
			'label'   => __( 'Customize → About Page → Page Header: background image', 'azure-isle' ),
			'eyebrow' => azure_mod( 'about_hero_eyebrow' ),
			'title'   => get_the_title(),
			'text'    => azure_mod( 'about_hero_text' ),
		)
	);
	?>

	<!-- Introduction -->
	<section class="az-section az-intro">
		<div class="az-container az-intro-grid">
			<div class="az-intro-media reveal">
				<?php echo azure_image( (int) azure_mod( 'about_intro_image_1' ), __( 'About → Introduction: large image', 'azure-isle' ), 'ratio-3-4', 'azure-card' ); ?>
				<?php echo azure_image( (int) azure_mod( 'about_intro_image_2' ), __( 'Small image', 'azure-isle' ), 'ratio-1-1 tone-sand az-intro-inset', 'medium_large' ); ?>
			</div>
			<div class="az-intro-text reveal">
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'about_intro_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'about_intro_title' ) ); ?></h2>
				<?php if ( azure_mod( 'about_intro_lede' ) ) : ?>
					<p class="az-lede"><?php echo esc_html( azure_mod( 'about_intro_lede' ) ); ?></p>
				<?php endif; ?>
				<?php if ( azure_mod( 'about_intro_text' ) ) : ?>
					<p><?php echo esc_html( azure_mod( 'about_intro_text' ) ); ?></p>
				<?php endif; ?>
				<?php if ( azure_mod( 'about_signature' ) ) : ?>
					<div class="az-signature">
						<span class="az-script"><?php echo esc_html( azure_mod( 'about_signature' ) ); ?></span>
						<?php if ( azure_mod( 'about_signature_by' ) ) : ?>
							<small><?php echo esc_html( azure_mod( 'about_signature_by' ) ); ?></small>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( '' !== trim( get_the_content() ) ) : ?>
			<div class="az-entry az-about-content">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>
	</section>

	<!-- Facts & figures -->
	<section class="az-stats-band">
		<div class="az-bg">
			<?php echo azure_image( (int) azure_mod( 'about_stats_image' ), __( 'About → Facts & Figures: background image', 'azure-isle' ), 'az-cover tone-deep', 'full' ); ?>
		</div>
		<div class="az-container">
			<ul class="az-stats">
				<?php for ( $n = 1; $n <= 4; $n++ ) : ?>
					<?php if ( azure_mod( "about_stat_{$n}_num" ) ) : ?>
						<li class="reveal" style="--delay: <?php echo esc_attr( ( $n - 1 ) * 100 ); ?>ms">
							<strong><?php echo esc_html( azure_mod( "about_stat_{$n}_num" ) ); ?></strong>
							<span><?php echo esc_html( azure_mod( "about_stat_{$n}_label" ) ); ?></span>
						</li>
					<?php endif; ?>
				<?php endfor; ?>
			</ul>
		</div>
	</section>

	<!-- Values -->
	<section class="az-section az-values">
		<div class="az-container">
			<div class="az-head reveal">
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'about_values_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'about_values_title' ) ); ?></h2>
			</div>
			<div class="az-values-grid">
				<?php for ( $n = 1; $n <= 3; $n++ ) : ?>
					<?php if ( azure_mod( "about_value_{$n}_title" ) ) : ?>
						<div class="az-value reveal" style="--delay: <?php echo esc_attr( ( $n - 1 ) * 120 ); ?>ms">
							<span class="az-service-icon"><?php echo azure_icon( azure_mod( "about_value_{$n}_icon" ) ); ?></span>
							<h3><?php echo esc_html( azure_mod( "about_value_{$n}_title" ) ); ?></h3>
							<p><?php echo esc_html( azure_mod( "about_value_{$n}_text" ) ); ?></p>
						</div>
					<?php endif; ?>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<!-- Our story -->
	<section class="az-section az-story">
		<div class="az-container az-story-grid">
			<div class="az-story-text reveal">
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'about_story_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'about_story_title' ) ); ?></h2>
				<p><?php echo esc_html( azure_mod( 'about_story_text' ) ); ?></p>
				<?php if ( azure_mod( 'about_story_button' ) ) : ?>
					<a href="<?php echo esc_url( azure_mod( 'about_story_url' ) ? azure_mod( 'about_story_url' ) : get_post_type_archive_link( 'azure_room' ) ); ?>" class="az-btn az-btn-gold"><?php echo esc_html( azure_mod( 'about_story_button' ) ); ?></a>
				<?php endif; ?>
			</div>
			<div class="reveal">
				<?php echo azure_image( (int) azure_mod( 'about_story_image' ), __( 'About → Our Story: image', 'azure-isle' ), 'ratio-4-3', 'azure-wide' ); ?>
			</div>
		</div>
	</section>

	<?php
	if ( 'yes' === azure_mod( 'about_show_carousel' ) ) {
		get_template_part( 'template-parts/carousel' );
	}
	if ( 'yes' === azure_mod( 'about_show_reviews' ) ) {
		get_template_part( 'template-parts/reviews' );
	}
	if ( 'yes' === azure_mod( 'about_show_services' ) ) {
		get_template_part( 'template-parts/services' );
	}
endwhile;

get_footer();
