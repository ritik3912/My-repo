<?php
/**
 * Trek archive — "My Treks": every trek, filterable by the Trek Finder.
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
			<span class="eyebrow"><?php esc_html_e( 'My Treks', 'trail-notes' ); ?></span>
			<h1><?php esc_html_e( "Trails I've Walked", 'trail-notes' ); ?></h1>
			<p class="lede"><?php esc_html_e( "These aren't places I've simply researched — they're journeys I've experienced myself. Filter by difficulty, duration, region or experience to find your next one.", 'trail-notes' ); ?></p>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php get_template_part( 'template-parts/trek-finder' ); ?>
	</div>
</section>

<section class="section section-alt">
	<div class="container">
		<?php
		get_template_part(
			'template-parts/cta-banner',
			null,
			array(
				'heading'      => __( "Can't Decide? Tell Me What You're Looking For.", 'trail-notes' ),
				'copy'         => __( "Not sure which trek fits your fitness level or timeline? Reach out and I'll point you in the right direction.", 'trail-notes' ),
				'button_label' => __( 'Plan a Trek', 'trail-notes' ),
				'button_url'   => home_url( '/plan-a-trek/' ),
			)
		);
		?>
	</div>
</section>

<?php get_footer(); ?>
