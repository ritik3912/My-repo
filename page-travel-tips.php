<?php
/**
 * Template Name: Travel Tips
 *
 * Also auto-applies to a Page with the slug "travel-tips".
 *
 * General, practical trekking guidance — not trek-specific facts. Where a
 * real number (cost, time, permit fee) would normally go, this stays a
 * placeholder rather than inventing one; the trek-specific pages carry
 * the real figures per trek.
 *
 * Each section pairs the text with an animated icon "orb" instead of
 * leaving a bare column of whitespace next to a short paragraph.
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
			<span class="eyebrow"><?php esc_html_e( 'Travel Tips', 'trail-notes' ); ?></span>
			<h1><?php esc_html_e( 'Before You Hit the Trail', 'trail-notes' ); ?></h1>
			<p class="lede"><?php esc_html_e( 'General, practical guidance that applies across most Himalayan weekend treks — the things worth knowing before you book anything.', 'trail-notes' ); ?></p>
		</div>
	</div>
</section>

<section id="how-to-reach" class="section">
	<div class="container">
		<div class="tip-section-grid reveal">
			<div>
				<h2><?php esc_html_e( 'How to Reach the Himalayas From Delhi', 'trail-notes' ); ?></h2>
				<div class="flow body-text">
					<p><?php esc_html_e( 'Most Uttarakhand and Himachal trek base villages are reachable from Delhi by an overnight bus or train to a transit town, followed by a shared cab or local bus for the final stretch. Overnight travel is popular because it saves a full day and gets you to the base village by morning, ready to start.', 'trail-notes' ); ?></p>
					<p><?php echo tn_placeholder_text( __( 'Add specific routes, operators and approximate travel times once confirmed for each trek — see the "How to Reach" section on the individual trek page.', 'trail-notes' ) ); ?></p>
				</div>
			</div>
			<div class="tip-orb" aria-hidden="true">
				<?php echo tn_icon( 'route' ); ?>
				<span class="tip-orb-index">01</span>
			</div>
		</div>
	</div>
</section>

<section id="what-to-pack" class="section section-alt">
	<div class="container">
		<div class="tip-section-grid reverse reveal">
			<div>
				<h2><?php esc_html_e( 'What to Pack for a Himalayan Trek', 'trail-notes' ); ?></h2>
				<div class="flow body-text">
					<p><?php esc_html_e( 'A good rule for a first trek: pack for layers, not for a single "trekking outfit". Days can be warm in the sun and cold the moment you stop moving or the sun dips. Broken-in trekking shoes matter more than almost anything else in your bag.', 'trail-notes' ); ?></p>
					<p><?php esc_html_e( 'Every trek page on this site has a full, trek-specific packing list under "What I Carried" — this section is the general version.', 'trail-notes' ); ?></p>
				</div>
			</div>
			<div class="tip-orb" aria-hidden="true">
				<?php echo tn_icon( 'backpack' ); ?>
				<span class="tip-orb-index">02</span>
			</div>
		</div>
	</div>
</section>

<section id="trek-cost" class="section">
	<div class="container">
		<div class="tip-section-grid reveal">
			<div>
				<h2><?php esc_html_e( 'How Much a Weekend Trek Actually Costs', 'trail-notes' ); ?></h2>
				<div class="flow body-text">
					<p><?php esc_html_e( 'A realistic trek budget usually has five parts: travel to and from Delhi, local transport near the base village, stay, food, and any guide or permit fees. Costs shift a lot with group size, season and how comfortable you want your stay to be.', 'trail-notes' ); ?></p>
					<p><?php echo tn_placeholder_text( __( 'See "What I Spent" on each trek page for my actual, approximate numbers for that specific trip.', 'trail-notes' ) ); ?></p>
				</div>
			</div>
			<div class="tip-orb" aria-hidden="true">
				<?php echo tn_icon( 'wallet' ); ?>
				<span class="tip-orb-index">03</span>
			</div>
		</div>
	</div>
</section>

<section id="physical-prep" class="section section-alt">
	<div class="container">
		<div class="tip-section-grid reverse reveal">
			<div>
				<h2><?php esc_html_e( 'How to Prepare Physically Before a Trek', 'trail-notes' ); ?></h2>
				<div class="flow body-text">
					<p><?php esc_html_e( "You don't need a gym membership to prepare for a weekend Himalayan trek — you need to be comfortable walking continuously for a few hours. Regular walking, stair climbing and a few weeks of consistency help far more than a single intense workout right before you leave.", 'trail-notes' ); ?></p>
					<p><?php esc_html_e( 'This is general fitness guidance, not medical advice — check with a doctor if you have any condition that altitude or exertion could affect.', 'trail-notes' ); ?></p>
				</div>
			</div>
			<div class="tip-orb" aria-hidden="true">
				<?php echo tn_icon( 'heart' ); ?>
				<span class="tip-orb-index">04</span>
			</div>
		</div>
	</div>
</section>

<section id="beginner-tips" class="section">
	<div class="container">
		<div class="tip-section-grid reveal">
			<div>
				<h2><?php esc_html_e( 'Beginner Trekking Tips I Wish Someone Told Me', 'trail-notes' ); ?></h2>
				<div class="flow body-text">
					<p><?php esc_html_e( "Start slow and let your body settle into a rhythm rather than sprinting the first hour. Drink more water than feels necessary. Break in your shoes before the trek, not during it. And it's completely fine to be the slowest one in the group — the trail isn't a race.", 'trail-notes' ); ?></p>
				</div>
			</div>
			<div class="tip-orb" aria-hidden="true">
				<?php echo tn_icon( 'compass' ); ?>
				<span class="tip-orb-index">05</span>
			</div>
		</div>
	</div>
</section>

<section id="wish-i-knew" class="section section-alt">
	<div class="container">
		<div class="tip-section-grid reverse reveal">
			<div>
				<h2><?php esc_html_e( 'Things I Wish I Knew Before Going', 'trail-notes' ); ?></h2>
				<div class="flow body-text">
					<p><?php esc_html_e( 'Network disappears earlier than you expect, ATMs get unreliable past the last big town, and toilets on the trail are basic. None of this should stop you — it just helps to know before you go.', 'trail-notes' ); ?></p>
					<p><?php esc_html_e( 'Each trek page has its own "Things I Wish I Knew" section with specifics for that trail.', 'trail-notes' ); ?></p>
				</div>
			</div>
			<div class="tip-orb" aria-hidden="true">
				<?php echo tn_icon( 'shield' ); ?>
				<span class="tip-orb-index">06</span>
			</div>
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
				'heading'      => __( 'Ready to Pick a Trail?', 'trail-notes' ),
				'copy'         => __( 'Every trek page has its own route, cost, itinerary and packing list built the same way.', 'trail-notes' ),
				'button_label' => __( 'Browse All Treks', 'trail-notes' ),
				'button_url'   => home_url( '/treks/' ),
			)
		);
		?>
	</div>
</section>

<?php get_footer(); ?>
