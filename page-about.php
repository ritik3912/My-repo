<?php
/**
 * Template Name: About Me
 *
 * Also auto-applies to a Page with the slug "about" via the WordPress
 * template hierarchy (page-about.php).
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$tn_treks_walked = array(
	__( 'Chopta – Tungnath – Chandrashila', 'trail-notes' ),
	__( 'Chakrata – Moila Top', 'trail-notes' ),
	__( 'Yulla Kanda', 'trail-notes' ),
	__( 'Raghupur Fort – Sillasar Lake', 'trail-notes' ),
);
?>

<section class="section">
	<div class="container about-hero reveal">
		<?php echo tn_image( array( 'label' => __( 'Add a personal photo of Ritik in the mountains', 'trail-notes' ), 'ratio' => '3-4' ) ); ?>
		<div>
			<span class="eyebrow"><?php esc_html_e( 'About Me', 'trail-notes' ); ?></span>
			<h1><?php esc_html_e( "Hey, I'm Ritik.", 'trail-notes' ); ?></h1>
			<div class="flow">
				<p class="body-text"><?php esc_html_e( "I like mountains, long road journeys, new trails and the feeling of reaching a place that you can't simply drive to.", 'trail-notes' ); ?></p>
				<p class="body-text"><?php esc_html_e( "I'm not a professional trekker or a mountaineering expert. I'm someone who started exploring the mountains out of curiosity — and slowly got hooked.", 'trail-notes' ); ?></p>
				<p class="body-text"><?php esc_html_e( 'Over time, I\'ve explored trails including Chopta–Tungnath–Chandrashila, Chakrata–Moila Top, Yulla Kanda and Raghupur Fort–Sillasar Lake. Each trip has been different.', 'trail-notes' ); ?></p>
				<p class="body-text"><?php esc_html_e( 'Some taught me how important preparation is. Some tested my fitness. Some were simply about enjoying the views and being away from the noise of everyday life.', 'trail-notes' ); ?></p>
				<p class="body-text"><?php esc_html_e( 'This website is my way of documenting those journeys — and hopefully helping someone else make their own mountain plans a little easier.', 'trail-notes' ); ?></p>
			</div>
			<ul class="trek-list-inline">
				<?php foreach ( $tn_treks_walked as $trek_name ) : ?>
					<li><?php echo esc_html( $trek_name ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<section class="section section-alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow"><?php esc_html_e( 'What This Site Is', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( 'I Go. I Experience. I Share.', 'trail-notes' ); ?></h2>
			<p class="lede"><?php esc_html_e( 'No complicated trekking jargon. No perfect-looking travel stories. Just practical information, personal experiences, useful tips, and things I wish I knew before going.', 'trail-notes' ); ?></p>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php
		get_template_part(
			'template-parts/cta-banner',
			null,
			array(
				'heading'      => __( 'Curious Where I\'ve Been?', 'trail-notes' ),
				'copy'         => __( 'Read the full trek guides — route, cost, packing list and the real experience behind each one.', 'trail-notes' ),
				'button_label' => __( 'Explore the Treks', 'trail-notes' ),
				'button_url'   => home_url( '/treks/' ),
			)
		);
		?>
	</div>
</section>

<?php get_footer(); ?>
