<?php
/**
 * Homepage: Hero → Intro → My Treks → Trek Finder → Travel Tips →
 * About teaser → Instagram → Final CTA.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$tn_home_treks = get_posts(
	array(
		'post_type'      => 'trek',
		'posts_per_page' => 4,
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
	)
);

$tn_travel_tips = array(
	array(
		'title'   => __( 'How to Reach From Delhi', 'trail-notes' ),
		'summary' => __( 'Bus, train and road options for getting from Delhi to the base villages of most Uttarakhand and Himachal treks.', 'trail-notes' ),
		'anchor'  => 'how-to-reach',
	),
	array(
		'title'   => __( 'What to Pack', 'trail-notes' ),
		'summary' => __( 'A practical, no-nonsense packing list built from what I\'ve actually carried on the trail — and what I regretted carrying.', 'trail-notes' ),
		'anchor'  => 'what-to-pack',
	),
	array(
		'title'   => __( 'How Much a Trek Costs', 'trail-notes' ),
		'summary' => __( 'A realistic breakdown of transport, stay, food and guide fees so you can budget before you book anything.', 'trail-notes' ),
		'anchor'  => 'trek-cost',
	),
	array(
		'title'   => __( 'How to Prepare Physically', 'trail-notes' ),
		'summary' => __( 'Simple, practical fitness prep for beginners — no gym membership or mountaineering background required.', 'trail-notes' ),
		'anchor'  => 'physical-prep',
	),
	array(
		'title'   => __( 'Beginner Trekking Tips', 'trail-notes' ),
		'summary' => __( 'The small, practical things that make a first trek smoother — from pacing yourself to choosing the right shoes.', 'trail-notes' ),
		'anchor'  => 'beginner-tips',
	),
	array(
		'title'   => __( 'Things I Wish I Knew', 'trail-notes' ),
		'summary' => __( 'Network, cash, water, toilets and other practical realities of trekking in the Himalayas that no one mentions upfront.', 'trail-notes' ),
		'anchor'  => 'wish-i-knew',
	),
);
?>

<!-- HERO -->
<section class="hero">
	<?php echo tn_image( array( 'label' => __( 'Add a cinematic, full-width Himalayan mountain photo here', 'trail-notes' ), 'ratio' => '16-9' ) ); ?>
	<div class="hero-scrim"></div>
	<div class="container hero-content">
		<span class="eyebrow"><?php bloginfo( 'name' ); ?></span>
		<h1><?php esc_html_e( 'Go Beyond the Destination.', 'trail-notes' ); ?></h1>
		<p class="lede"><?php esc_html_e( 'Real trek experiences. Practical travel guides. Honest lessons from the trail.', 'trail-notes' ); ?></p>
		<p class="lede"><?php esc_html_e( 'I explore the mountains, experience the trails, make mistakes, learn along the way — and share everything that can help you plan your own journey better.', 'trail-notes' ); ?></p>
		<div class="hero-actions">
			<a href="<?php echo esc_url( home_url( '/treks/' ) ); ?>" class="btn btn-light"><?php esc_html_e( 'Explore My Treks', 'trail-notes' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/plan-a-trek/' ) ); ?>" class="btn btn-outline on-dark"><?php esc_html_e( 'Start Planning', 'trail-notes' ); ?></a>
		</div>
	</div>
	<div class="scroll-indicator" aria-hidden="true">
		<span><?php esc_html_e( 'Scroll', 'trail-notes' ); ?></span>
		<span class="dot"></span>
	</div>
</section>

<!-- INTRO -->
<section class="section">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'Why This Blog Exists', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( 'I Go. I Experience. I Share.', 'trail-notes' ); ?></h2>
		</div>
		<div class="flow reveal">
			<p class="body-text"><?php esc_html_e( 'The mountains always look perfect in pictures. But before you actually go, there are a hundred questions.', 'trail-notes' ); ?></p>
			<p class="body-text"><?php esc_html_e( 'How difficult is the trek? How do you reach the starting point? What does it actually cost? What should you pack? Is it really worth the journey?', 'trail-notes' ); ?></p>
			<p class="body-text"><?php esc_html_e( 'This blog is where I share the answers based on my own experiences.', 'trail-notes' ); ?></p>
			<p class="body-text"><?php esc_html_e( 'No complicated trekking jargon. No perfect-looking travel stories. Just practical information, personal experiences, useful tips, and things I wish I knew before going.', 'trail-notes' ); ?></p>
		</div>
		<div class="stat-row reveal">
			<div>
				<span class="stat-number"><?php echo esc_html( wp_count_posts( 'trek' )->publish ); ?></span>
				<span class="stat-label"><?php esc_html_e( 'Treks Documented', 'trail-notes' ); ?></span>
			</div>
			<div>
				<span class="stat-number"><?php esc_html_e( '100%', 'trail-notes' ); ?></span>
				<span class="stat-label"><?php esc_html_e( 'Real Experiences', 'trail-notes' ); ?></span>
			</div>
			<div>
				<span class="stat-number">0</span>
				<span class="stat-label"><?php esc_html_e( 'Corporate Travel Talk', 'trail-notes' ); ?></span>
			</div>
			<div>
				<span class="stat-number">&infin;</span>
				<span class="stat-label"><?php esc_html_e( 'Practical Guides', 'trail-notes' ); ?></span>
			</div>
		</div>
	</div>
</section>

<!-- MY TREKS -->
<section class="section section-alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'My Treks', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( "Trails I've Walked", 'trail-notes' ); ?></h2>
			<p class="lede"><?php esc_html_e( "These aren't places I've simply researched — they're journeys I've experienced myself.", 'trail-notes' ); ?></p>
		</div>
		<?php if ( $tn_home_treks ) : ?>
			<div class="grid grid-2">
				<?php
				foreach ( $tn_home_treks as $tn_trek ) {
					get_template_part( 'template-parts/trek-card', null, array( 'post_id' => $tn_trek->ID ) );
				}
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p class="body-text"><?php echo tn_placeholder_text( __( 'Publish your first Trek (Treks → Add New) to see it appear here.', 'trail-notes' ) ); ?></p>
		<?php endif; ?>
	</div>
</section>

<!-- TREK FINDER -->
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow"><?php esc_html_e( 'Trek Finder', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( 'Not Sure Where to Go Next?', 'trail-notes' ); ?></h2>
			<p class="lede"><?php esc_html_e( 'Filter by difficulty, duration, region or experience level to find a trek that fits you.', 'trail-notes' ); ?></p>
		</div>
		<?php get_template_part( 'template-parts/trek-finder' ); ?>
	</div>
</section>

<!-- TRAVEL TIPS -->
<section class="section section-alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'Travel Tips', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( 'Before You Hit the Trail', 'trail-notes' ); ?></h2>
		</div>
		<div class="grid grid-3">
			<?php foreach ( $tn_travel_tips as $i => $tip ) : ?>
				<?php
				get_template_part(
					'template-parts/travel-tip-card',
					null,
					array(
						'number'  => $i + 1,
						'title'   => $tip['title'],
						'summary' => $tip['summary'],
						'url'     => home_url( '/travel-tips/#' . $tip['anchor'] ),
					)
				);
				?>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ABOUT TEASER -->
<section class="section">
	<div class="container about-hero reveal">
		<?php echo tn_image( array( 'label' => __( "Add a personal photo of Ritik on the trail", 'trail-notes' ), 'ratio' => '4-3' ) ); ?>
		<div>
			<span class="eyebrow"><?php esc_html_e( 'About Me', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( "Hey, I'm Ritik.", 'trail-notes' ); ?></h2>
			<p class="body-text"><?php esc_html_e( "I like mountains, long road journeys, new trails and the feeling of reaching a place that you can't simply drive to. I'm not a professional trekker or a mountaineering expert — just someone who started exploring the mountains out of curiosity, and slowly got hooked.", 'trail-notes' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn-text" style="margin-top:1.5rem;display:inline-flex;"><?php esc_html_e( 'Read My Story', 'trail-notes' ); ?> <?php echo tn_icon( 'arrow' ); ?></a>
		</div>
	</div>
</section>

<!-- INSTAGRAM / SOCIAL -->
<?php $tn_instagram = tn_social_url( 'tn_instagram_url' ); ?>
<section class="section section-alt">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow"><?php esc_html_e( 'Social', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( 'More From the Trail', 'trail-notes' ); ?></h2>
			<p class="lede"><?php esc_html_e( "Photos, short videos, trail updates and moments that don't always make it onto the blog.", 'trail-notes' ); ?></p>
		</div>
		<div class="social-grid reveal">
			<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
				<?php echo tn_image( array( 'label' => sprintf( /* translators: %d: image number */ __( 'Instagram photo %d', 'trail-notes' ), $i ), 'ratio' => '1-1', 'tone' => 0 === $i % 2 ? 'earth' : '' ) ); ?>
			<?php endfor; ?>
		</div>
		<div class="text-center" style="margin-top:2rem;">
			<?php if ( $tn_instagram ) : ?>
				<a href="<?php echo esc_url( $tn_instagram ); ?>" class="btn-text" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Follow the Journey on Instagram', 'trail-notes' ); ?> <?php echo tn_icon( 'arrow' ); ?></a>
			<?php else : ?>
				<p class="body-text"><?php echo tn_placeholder_text( __( 'Add your Instagram URL in Appearance → Customize → Trail Notes — Social & Contact', 'trail-notes' ) ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- FINAL CTA -->
<section class="section">
	<div class="container">
		<?php
		get_template_part(
			'template-parts/cta-banner',
			null,
			array(
				'heading'      => __( 'Your Next Trail Is Waiting.', 'trail-notes' ),
				'copy'         => __( "You don't need to be an expert trekker to start exploring. Sometimes, you just need a destination, a backpack and a plan.", 'trail-notes' ),
				'button_label' => __( 'Explore the Treks', 'trail-notes' ),
				'button_url'   => home_url( '/treks/' ),
			)
		);
		?>
	</div>
</section>

<?php get_footer(); ?>
