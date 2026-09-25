<?php
/**
 * Template Name: Island Resort
 *
 * A standalone, full-width luxury resort landing page: transparent header
 * over a full-screen hero, availability bar, rooms, experiences, dining,
 * testimonials, gallery and a dark footer. It ships its own header/footer
 * markup so the look is independent of the trekking pages.
 *
 * Every section's copy lives in the arrays below — edit them to make the
 * page yours. Images are labelled placeholder tiles until a Featured Image
 * (hero) is set or you swap the tn_image() calls for real attachments.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$rs_rooms = array(
	array(
		'name'   => __( 'Lagoon Garden Room', 'trail-notes' ),
		'price'  => '$240',
		'size'   => __( '42 m²', 'trail-notes' ),
		'guests' => __( '2 Guests', 'trail-notes' ),
		'bed'    => __( 'King Bed', 'trail-notes' ),
		'image'  => __( 'Room with a garden terrace', 'trail-notes' ),
	),
	array(
		'name'   => __( 'Ocean View Suite', 'trail-notes' ),
		'price'  => '$380',
		'size'   => __( '65 m²', 'trail-notes' ),
		'guests' => __( '3 Guests', 'trail-notes' ),
		'bed'    => __( 'King Bed', 'trail-notes' ),
		'image'  => __( 'Suite with a sea-facing balcony', 'trail-notes' ),
	),
	array(
		'name'   => __( 'Overwater Pool Villa', 'trail-notes' ),
		'price'  => '$620',
		'size'   => __( '110 m²', 'trail-notes' ),
		'guests' => __( '4 Guests', 'trail-notes' ),
		'bed'    => __( '2 Beds', 'trail-notes' ),
		'image'  => __( 'Villa with a private plunge pool', 'trail-notes' ),
	),
);

$rs_experiences = array(
	array(
		'icon'  => 'waves',
		'title' => __( 'Reef Snorkeling', 'trail-notes' ),
		'copy'  => __( 'Guided morning swims over the house reef, gear included.', 'trail-notes' ),
	),
	array(
		'icon'  => 'sun',
		'title' => __( 'Sunset Sailing', 'trail-notes' ),
		'copy'  => __( 'A slow catamaran loop around the island as the sky turns gold.', 'trail-notes' ),
	),
	array(
		'icon'  => 'leaf',
		'title' => __( 'Garden Spa', 'trail-notes' ),
		'copy'  => __( 'Open-air treatment pavilions using local oils and botanicals.', 'trail-notes' ),
	),
	array(
		'icon'  => 'glass',
		'title' => __( 'Beach Dining', 'trail-notes' ),
		'copy'  => __( 'Private tables set on the sand, lit by lanterns after dark.', 'trail-notes' ),
	),
);

$rs_features = array(
	array(
		'eyebrow' => __( 'Dining', 'trail-notes' ),
		'title'   => __( 'Fresh From the Water, Straight to the Table', 'trail-notes' ),
		'copy'    => __( 'Our kitchen works with island fishermen and small farms, so the menu follows what the day brings in. Breakfast by the pool, long lunches in the shade, and grilled seafood by candlelight.', 'trail-notes' ),
		'cta'     => __( 'View Menus', 'trail-notes' ),
		'image'   => __( 'Restaurant terrace at dusk', 'trail-notes' ),
	),
	array(
		'eyebrow' => __( 'Wellness', 'trail-notes' ),
		'title'   => __( 'Slow Mornings and Unhurried Afternoons', 'trail-notes' ),
		'copy'    => __( 'Start with sunrise yoga on the deck, then let the rest of the day unfold at its own pace — a massage between the palms, a swim in the infinity pool, or a nap in a hammock.', 'trail-notes' ),
		'cta'     => __( 'Explore the Spa', 'trail-notes' ),
		'image'   => __( 'Spa pavilion among palm trees', 'trail-notes' ),
	),
);

$rs_reviews = array(
	array(
		'quote' => __( 'We came for five nights and extended to eight. The staff remembered every small preference, and waking up to the lagoon never got old.', 'trail-notes' ),
		'name'  => __( 'Guest review', 'trail-notes' ),
		'from'  => __( 'Add guest name & city', 'trail-notes' ),
	),
	array(
		'quote' => __( 'The overwater villa felt completely private. Snorkeling right off our own steps was the highlight of the whole trip.', 'trail-notes' ),
		'name'  => __( 'Guest review', 'trail-notes' ),
		'from'  => __( 'Add guest name & city', 'trail-notes' ),
	),
	array(
		'quote' => __( 'Quiet, beautiful and genuinely relaxing. The beach dinner on our anniversary is something we will talk about for years.', 'trail-notes' ),
		'name'  => __( 'Guest review', 'trail-notes' ),
		'from'  => __( 'Add guest name & city', 'trail-notes' ),
	),
);

$rs_gallery = array(
	__( 'Aerial view of the island', 'trail-notes' ),
	__( 'Infinity pool', 'trail-notes' ),
	__( 'Villa interior', 'trail-notes' ),
	__( 'Beach at sunrise', 'trail-notes' ),
	__( 'Cocktails at the bar', 'trail-notes' ),
);

$rs_hero_id = has_post_thumbnail() ? get_post_thumbnail_id() : 0;
$rs_brand   = get_bloginfo( 'name' );
$rs_today   = gmdate( 'Y-m-d' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'rs-page' ); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'trail-notes' ); ?></a>

<header class="rs-header" id="rs-header">
	<div class="rs-header-inner">
		<button type="button" class="rs-menu-toggle" id="rs-menu-toggle" aria-expanded="false" aria-controls="rs-menu">
			<span></span><span></span>
			<span class="rs-menu-label"><?php esc_html_e( 'Menu', 'trail-notes' ); ?></span>
		</button>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="rs-logo" rel="home">
			<span class="rs-logo-mark"><?php echo esc_html( $rs_brand ); ?></span>
			<span class="rs-logo-sub"><?php esc_html_e( 'Island Resort & Spa', 'trail-notes' ); ?></span>
		</a>

		<a href="#rs-booking" class="rs-btn rs-btn-light rs-header-cta"><?php esc_html_e( 'Book Your Stay', 'trail-notes' ); ?></a>
	</div>
</header>

<div class="rs-menu" id="rs-menu" aria-hidden="true">
	<button type="button" class="rs-menu-close" id="rs-menu-close">
		&times;<span class="visually-hidden"><?php esc_html_e( 'Close menu', 'trail-notes' ); ?></span>
	</button>
	<nav aria-label="<?php esc_attr_e( 'Resort', 'trail-notes' ); ?>">
		<ul>
			<li><a href="#rs-about"><?php esc_html_e( 'The Resort', 'trail-notes' ); ?></a></li>
			<li><a href="#rs-rooms"><?php esc_html_e( 'Rooms & Villas', 'trail-notes' ); ?></a></li>
			<li><a href="#rs-experiences"><?php esc_html_e( 'Experiences', 'trail-notes' ); ?></a></li>
			<li><a href="#rs-dining"><?php esc_html_e( 'Dining & Spa', 'trail-notes' ); ?></a></li>
			<li><a href="#rs-gallery"><?php esc_html_e( 'Gallery', 'trail-notes' ); ?></a></li>
			<li><a href="#rs-contact"><?php esc_html_e( 'Contact', 'trail-notes' ); ?></a></li>
		</ul>
	</nav>
</div>

<main id="main">

	<!-- Hero -->
	<section class="rs-hero">
		<div class="rs-hero-media">
			<?php echo tn_image( array( 'attachment_id' => $rs_hero_id, 'label' => __( 'Set a Featured Image: wide shot of the island', 'trail-notes' ), 'class' => 'rs-ph', 'size' => 'full' ) ); ?>
		</div>
		<div class="rs-hero-scrim"></div>
		<div class="rs-hero-content">
			<span class="rs-eyebrow rs-eyebrow-light"><?php esc_html_e( 'Welcome to Paradise', 'trail-notes' ); ?></span>
			<h1><?php esc_html_e( 'Where the Ocean Sets the Pace', 'trail-notes' ); ?></h1>
			<p><?php esc_html_e( 'A private island retreat of white sand, clear water and quiet luxury.', 'trail-notes' ); ?></p>
		</div>

		<form class="rs-booking" id="rs-booking" action="#rs-contact" method="get">
			<label class="rs-field">
				<span><?php esc_html_e( 'Check In', 'trail-notes' ); ?></span>
				<input type="date" name="checkin" min="<?php echo esc_attr( $rs_today ); ?>" required>
			</label>
			<label class="rs-field">
				<span><?php esc_html_e( 'Check Out', 'trail-notes' ); ?></span>
				<input type="date" name="checkout" min="<?php echo esc_attr( $rs_today ); ?>" required>
			</label>
			<label class="rs-field">
				<span><?php esc_html_e( 'Adults', 'trail-notes' ); ?></span>
				<select name="adults">
					<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, 2 ); ?>><?php echo esc_html( $i ); ?></option>
					<?php endfor; ?>
				</select>
			</label>
			<label class="rs-field">
				<span><?php esc_html_e( 'Children', 'trail-notes' ); ?></span>
				<select name="children">
					<?php for ( $i = 0; $i <= 4; $i++ ) : ?>
						<option value="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></option>
					<?php endfor; ?>
				</select>
			</label>
			<button type="submit" class="rs-btn rs-btn-dark"><?php esc_html_e( 'Check Availability', 'trail-notes' ); ?></button>
		</form>
	</section>

	<!-- Intro -->
	<section class="rs-section rs-intro" id="rs-about">
		<div class="rs-container rs-intro-grid">
			<div class="rs-intro-media reveal">
				<?php echo tn_image( array( 'label' => __( 'Palm-lined beach path', 'trail-notes' ), 'ratio' => '3-4', 'class' => 'rs-ph rs-intro-main' ) ); ?>
				<?php echo tn_image( array( 'label' => __( 'Detail: shells & linen', 'trail-notes' ), 'ratio' => '1-1', 'class' => 'rs-ph rs-ph-sand rs-intro-inset' ) ); ?>
			</div>
			<div class="rs-intro-text reveal">
				<span class="rs-eyebrow"><?php esc_html_e( 'The Resort', 'trail-notes' ); ?></span>
				<h2><?php esc_html_e( 'A Barefoot Escape Surrounded by Turquoise Water', 'trail-notes' ); ?></h2>
				<p class="rs-lede"><?php esc_html_e( 'Tucked into a crescent of coral sand, our resort is made for slowing down. Thirty-two rooms and villas sit between the palms and the lagoon, each designed to let the breeze and the view do most of the work.', 'trail-notes' ); ?></p>
				<p><?php esc_html_e( 'Spend the day on the reef, in the spa or doing nothing at all. We will take care of the rest.', 'trail-notes' ); ?></p>
				<ul class="rs-stats">
					<li><strong>32</strong><span><?php esc_html_e( 'Rooms & Villas', 'trail-notes' ); ?></span></li>
					<li><strong>3</strong><span><?php esc_html_e( 'Restaurants', 'trail-notes' ); ?></span></li>
					<li><strong>1.2<small>km</small></strong><span><?php esc_html_e( 'Private Beach', 'trail-notes' ); ?></span></li>
				</ul>
				<a href="#rs-rooms" class="rs-link"><?php esc_html_e( 'Discover More', 'trail-notes' ); ?> <?php echo tn_icon( 'arrow' ); ?></a>
			</div>
		</div>
	</section>

	<!-- Rooms -->
	<section class="rs-section rs-rooms" id="rs-rooms">
		<div class="rs-container">
			<div class="rs-head reveal">
				<span class="rs-eyebrow"><?php esc_html_e( 'Accommodation', 'trail-notes' ); ?></span>
				<h2><?php esc_html_e( 'Rooms & Villas', 'trail-notes' ); ?></h2>
				<p><?php esc_html_e( 'Natural materials, soft light and a view of the water from every one.', 'trail-notes' ); ?></p>
			</div>
			<div class="rs-room-grid">
				<?php foreach ( $rs_rooms as $index => $room ) : ?>
					<article class="rs-room reveal" style="--delay: <?php echo esc_attr( $index * 120 ); ?>ms">
						<a href="#rs-booking" class="rs-room-media">
							<?php echo tn_image( array( 'label' => $room['image'], 'ratio' => '3-4', 'class' => 'rs-ph' ) ); ?>
							<span class="rs-room-price">
								<?php
								/* translators: %s: nightly price. */
								printf( esc_html__( 'From %s / night', 'trail-notes' ), esc_html( $room['price'] ) );
								?>
							</span>
						</a>
						<div class="rs-room-body">
							<h3><a href="#rs-booking"><?php echo esc_html( $room['name'] ); ?></a></h3>
							<ul class="rs-room-meta">
								<li><?php echo esc_html( $room['size'] ); ?></li>
								<li><?php echo esc_html( $room['guests'] ); ?></li>
								<li><?php echo esc_html( $room['bed'] ); ?></li>
							</ul>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Parallax quote band -->
	<section class="rs-band">
		<div class="rs-band-media">
			<?php echo tn_image( array( 'label' => __( 'Wide ocean horizon', 'trail-notes' ), 'class' => 'rs-ph rs-ph-deep' ) ); ?>
		</div>
		<div class="rs-band-content reveal">
			<span class="rs-eyebrow rs-eyebrow-light"><?php esc_html_e( 'Island Living', 'trail-notes' ); ?></span>
			<p class="rs-band-quote"><?php esc_html_e( 'Long days in the sun, warm nights under the stars, and nowhere you need to be.', 'trail-notes' ); ?></p>
			<a href="#rs-booking" class="rs-btn rs-btn-light"><?php esc_html_e( 'Plan Your Escape', 'trail-notes' ); ?></a>
		</div>
	</section>

	<!-- Experiences -->
	<section class="rs-section rs-experiences" id="rs-experiences">
		<div class="rs-container">
			<div class="rs-head reveal">
				<span class="rs-eyebrow"><?php esc_html_e( 'Experiences', 'trail-notes' ); ?></span>
				<h2><?php esc_html_e( 'Moments Worth Remembering', 'trail-notes' ); ?></h2>
			</div>
			<div class="rs-exp-grid">
				<?php foreach ( $rs_experiences as $index => $exp ) : ?>
					<div class="rs-exp reveal" style="--delay: <?php echo esc_attr( $index * 100 ); ?>ms">
						<span class="rs-exp-icon"><?php echo rs_icon( $exp['icon'] ); ?></span>
						<h3><?php echo esc_html( $exp['title'] ); ?></h3>
						<p><?php echo esc_html( $exp['copy'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Dining & Spa -->
	<section class="rs-section rs-features" id="rs-dining">
		<div class="rs-container">
			<?php foreach ( $rs_features as $index => $feature ) : ?>
				<div class="rs-feature <?php echo 1 === $index % 2 ? 'is-reversed' : ''; ?>">
					<div class="rs-feature-media reveal">
						<?php echo tn_image( array( 'label' => $feature['image'], 'ratio' => '4-3', 'class' => 'rs-ph' . ( $index % 2 ? ' rs-ph-sand' : '' ) ) ); ?>
					</div>
					<div class="rs-feature-text reveal">
						<span class="rs-eyebrow"><?php echo esc_html( $feature['eyebrow'] ); ?></span>
						<h2><?php echo esc_html( $feature['title'] ); ?></h2>
						<p><?php echo esc_html( $feature['copy'] ); ?></p>
						<a href="#rs-contact" class="rs-btn rs-btn-outline"><?php echo esc_html( $feature['cta'] ); ?></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- Testimonials -->
	<section class="rs-section rs-reviews">
		<div class="rs-container rs-narrow">
			<span class="rs-eyebrow"><?php esc_html_e( 'Guest Stories', 'trail-notes' ); ?></span>
			<div class="rs-stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'trail-notes' ); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
			<div class="rs-slider" data-rs-slider>
				<?php foreach ( $rs_reviews as $index => $review ) : ?>
					<figure class="rs-slide <?php echo 0 === $index ? 'is-active' : ''; ?>" aria-hidden="<?php echo 0 === $index ? 'false' : 'true'; ?>">
						<blockquote><?php echo esc_html( $review['quote'] ); ?></blockquote>
						<figcaption>
							<strong><?php echo esc_html( $review['name'] ); ?></strong>
							<span><?php echo esc_html( $review['from'] ); ?></span>
						</figcaption>
					</figure>
				<?php endforeach; ?>
				<div class="rs-dots" role="tablist">
					<?php foreach ( $rs_reviews as $index => $review ) : ?>
						<button type="button" class="rs-dot <?php echo 0 === $index ? 'is-active' : ''; ?>" data-rs-dot="<?php echo esc_attr( $index ); ?>">
							<span class="visually-hidden">
								<?php
								/* translators: %d: review number. */
								printf( esc_html__( 'Show review %d', 'trail-notes' ), (int) $index + 1 );
								?>
							</span>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Gallery -->
	<section class="rs-gallery" id="rs-gallery">
		<?php foreach ( $rs_gallery as $index => $label ) : ?>
			<div class="rs-gallery-item rs-gallery-<?php echo esc_attr( $index + 1 ); ?>">
				<?php echo tn_image( array( 'label' => $label, 'class' => 'rs-ph' . ( $index % 2 ? ' rs-ph-sand' : '' ) ) ); ?>
			</div>
		<?php endforeach; ?>
	</section>

	<!-- Offer CTA -->
	<section class="rs-section rs-offer">
		<div class="rs-container rs-narrow reveal">
			<span class="rs-eyebrow"><?php esc_html_e( 'Special Offer', 'trail-notes' ); ?></span>
			<h2><?php esc_html_e( 'Stay Four Nights, Pay for Three', 'trail-notes' ); ?></h2>
			<p><?php esc_html_e( 'Book directly with us for the best rate, daily breakfast and a complimentary sunset cruise.', 'trail-notes' ); ?></p>
			<a href="#rs-booking" class="rs-btn rs-btn-dark"><?php esc_html_e( 'Reserve Now', 'trail-notes' ); ?></a>
		</div>
	</section>

</main>

<footer class="rs-footer" id="rs-contact">
	<div class="rs-container">
		<div class="rs-footer-top">
			<div class="rs-footer-brand">
				<span class="rs-logo-mark"><?php echo esc_html( $rs_brand ); ?></span>
				<span class="rs-logo-sub"><?php esc_html_e( 'Island Resort & Spa', 'trail-notes' ); ?></span>
				<p><?php esc_html_e( 'A quiet island hideaway for couples, families and anyone who needs the sea for a while.', 'trail-notes' ); ?></p>
			</div>
			<div>
				<h4><?php esc_html_e( 'Contact', 'trail-notes' ); ?></h4>
				<ul>
					<li><?php esc_html_e( '[Add resort address]', 'trail-notes' ); ?></li>
					<li><?php esc_html_e( '[Add phone number]', 'trail-notes' ); ?></li>
					<li>
						<?php
						$rs_email = get_theme_mod( 'tn_contact_email' );
						echo $rs_email ? '<a href="mailto:' . esc_attr( antispambot( $rs_email ) ) . '">' . esc_html( antispambot( $rs_email ) ) . '</a>' : esc_html__( '[Add email in Customizer]', 'trail-notes' );
						?>
					</li>
				</ul>
			</div>
			<div>
				<h4><?php esc_html_e( 'Explore', 'trail-notes' ); ?></h4>
				<ul>
					<li><a href="#rs-rooms"><?php esc_html_e( 'Rooms & Villas', 'trail-notes' ); ?></a></li>
					<li><a href="#rs-experiences"><?php esc_html_e( 'Experiences', 'trail-notes' ); ?></a></li>
					<li><a href="#rs-dining"><?php esc_html_e( 'Dining & Spa', 'trail-notes' ); ?></a></li>
					<li><a href="#rs-gallery"><?php esc_html_e( 'Gallery', 'trail-notes' ); ?></a></li>
				</ul>
			</div>
			<div>
				<h4><?php esc_html_e( 'Newsletter', 'trail-notes' ); ?></h4>
				<p><?php esc_html_e( 'Seasonal offers and island news, a few times a year.', 'trail-notes' ); ?></p>
				<form class="rs-newsletter" action="#" method="post" onsubmit="return false;">
					<label class="visually-hidden" for="rs-news-email"><?php esc_html_e( 'Email address', 'trail-notes' ); ?></label>
					<input type="email" id="rs-news-email" placeholder="<?php esc_attr_e( 'Your email', 'trail-notes' ); ?>">
					<button type="submit" aria-label="<?php esc_attr_e( 'Subscribe', 'trail-notes' ); ?>"><?php echo tn_icon( 'arrow' ); ?></button>
				</form>
			</div>
		</div>
		<div class="rs-footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $rs_brand ); ?>. <?php esc_html_e( 'All rights reserved.', 'trail-notes' ); ?></span>
			<a href="#main"><?php esc_html_e( 'Back to top', 'trail-notes' ); ?> &uarr;</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
