<?php
/**
 * Front page: hero + booking bar, intro, rooms, quote band, experiences,
 * dining & spa, reviews, gallery, offer. All text and images come from
 * Appearance → Customize → Azure Isle — Front Page; rooms from Rooms.
 *
 * If Settings → Reading is set to show latest posts, this template still
 * renders the resort layout as the home page.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$azure_today = wp_date( 'Y-m-d' );
$azure_form  = azure_mod( 'booking_form' ) ? azure_mod( 'booking_form' ) : '#contact';
$azure_book  = azure_booking_url();

$azure_rooms = new WP_Query(
	array(
		'post_type'           => 'azure_room',
		'posts_per_page'      => (int) azure_mod( 'rooms_count' ),
		'orderby'             => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

$azure_reviews = array();
for ( $n = 1; $n <= 3; $n++ ) {
	if ( azure_mod( "review_{$n}_quote" ) ) {
		$azure_reviews[] = array(
			'quote' => azure_mod( "review_{$n}_quote" ),
			'name'  => azure_mod( "review_{$n}_name" ),
			'from'  => azure_mod( "review_{$n}_from" ),
		);
	}
}
?>

<!-- Hero -->
<section class="az-hero">
	<div class="az-hero-media">
		<?php echo azure_image( (int) azure_mod( 'hero_image' ), __( 'Customize → Hero: add a wide island photo', 'azure-isle' ), 'az-cover', 'full' ); ?>
	</div>
	<div class="az-hero-scrim"></div>
	<div class="az-hero-content">
		<?php if ( azure_mod( 'hero_eyebrow' ) ) : ?>
			<span class="az-eyebrow az-eyebrow-light"><?php echo esc_html( azure_mod( 'hero_eyebrow' ) ); ?></span>
		<?php endif; ?>
		<h1><?php echo esc_html( azure_mod( 'hero_title' ) ); ?></h1>
		<?php if ( azure_mod( 'hero_text' ) ) : ?>
			<p><?php echo esc_html( azure_mod( 'hero_text' ) ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( 'yes' === azure_mod( 'hero_show_bar' ) ) : ?>
		<form class="az-booking" id="booking" action="<?php echo esc_url( $azure_form ); ?>" method="get">
			<label class="az-field">
				<span><?php esc_html_e( 'Check In', 'azure-isle' ); ?></span>
				<input type="date" name="checkin" min="<?php echo esc_attr( $azure_today ); ?>" required>
			</label>
			<label class="az-field">
				<span><?php esc_html_e( 'Check Out', 'azure-isle' ); ?></span>
				<input type="date" name="checkout" min="<?php echo esc_attr( $azure_today ); ?>" required>
			</label>
			<label class="az-field">
				<span><?php esc_html_e( 'Adults', 'azure-isle' ); ?></span>
				<select name="adults">
					<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, 2 ); ?>><?php echo esc_html( $i ); ?></option>
					<?php endfor; ?>
				</select>
			</label>
			<label class="az-field">
				<span><?php esc_html_e( 'Children', 'azure-isle' ); ?></span>
				<select name="children">
					<?php for ( $i = 0; $i <= 4; $i++ ) : ?>
						<option value="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></option>
					<?php endfor; ?>
				</select>
			</label>
			<button type="submit" class="az-btn az-btn-dark"><?php esc_html_e( 'Check Availability', 'azure-isle' ); ?></button>
		</form>
	<?php endif; ?>
</section>

<!-- Intro -->
<section class="az-section az-intro" id="about">
	<div class="az-container az-intro-grid">
		<div class="az-intro-media reveal">
			<?php echo azure_image( (int) azure_mod( 'intro_image' ), __( 'Customize → About: main image', 'azure-isle' ), 'ratio-3-4' ); ?>
			<?php echo azure_image( (int) azure_mod( 'intro_image_2' ), __( 'Small image', 'azure-isle' ), 'ratio-1-1 tone-sand az-intro-inset', 'medium_large' ); ?>
		</div>
		<div class="az-intro-text reveal">
			<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'intro_eyebrow' ) ); ?></span>
			<h2><?php echo esc_html( azure_mod( 'intro_title' ) ); ?></h2>
			<?php if ( azure_mod( 'intro_lede' ) ) : ?>
				<p class="az-lede"><?php echo esc_html( azure_mod( 'intro_lede' ) ); ?></p>
			<?php endif; ?>
			<?php if ( azure_mod( 'intro_text' ) ) : ?>
				<p><?php echo esc_html( azure_mod( 'intro_text' ) ); ?></p>
			<?php endif; ?>
			<ul class="az-stats">
				<?php for ( $n = 1; $n <= 3; $n++ ) : ?>
					<?php if ( azure_mod( "stat_{$n}_num" ) ) : ?>
						<li><strong><?php echo esc_html( azure_mod( "stat_{$n}_num" ) ); ?></strong><span><?php echo esc_html( azure_mod( "stat_{$n}_label" ) ); ?></span></li>
					<?php endif; ?>
				<?php endfor; ?>
			</ul>
			<a href="#rooms" class="az-link"><?php esc_html_e( 'Discover More', 'azure-isle' ); ?> <?php echo azure_icon( 'arrow' ); ?></a>
		</div>
	</div>
</section>

<!-- Rooms -->
<section class="az-section az-rooms" id="rooms">
	<div class="az-container">
		<div class="az-head reveal">
			<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'rooms_eyebrow' ) ); ?></span>
			<h2><?php echo esc_html( azure_mod( 'rooms_title' ) ); ?></h2>
			<?php if ( azure_mod( 'rooms_text' ) ) : ?>
				<p><?php echo esc_html( azure_mod( 'rooms_text' ) ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( $azure_rooms->have_posts() ) : ?>
			<div class="az-room-grid">
				<?php
				$azure_i = 0;
				while ( $azure_rooms->have_posts() ) :
					$azure_rooms->the_post();
					get_template_part( 'template-parts/room-card', null, array( 'delay' => ( $azure_i++ % 3 ) * 120 ) );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
			<p class="az-center">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'azure_room' ) ); ?>" class="az-btn az-btn-outline"><?php esc_html_e( 'View All Rooms', 'azure-isle' ); ?></a>
			</p>
		<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
			<p class="az-center"><?php esc_html_e( 'No rooms yet. Add them under Rooms → Add New.', 'azure-isle' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<!-- Quote band -->
<section class="az-band">
	<div class="az-band-media">
		<?php echo azure_image( (int) azure_mod( 'band_image' ), __( 'Customize → Quote Band: background image', 'azure-isle' ), 'az-cover tone-deep', 'full' ); ?>
	</div>
	<div class="az-band-content reveal">
		<?php if ( azure_mod( 'band_eyebrow' ) ) : ?>
			<span class="az-eyebrow az-eyebrow-light"><?php echo esc_html( azure_mod( 'band_eyebrow' ) ); ?></span>
		<?php endif; ?>
		<p class="az-band-quote"><?php echo esc_html( azure_mod( 'band_quote' ) ); ?></p>
		<?php if ( azure_mod( 'band_button' ) ) : ?>
			<a href="<?php echo esc_url( $azure_book ); ?>" class="az-btn az-btn-light"><?php echo esc_html( azure_mod( 'band_button' ) ); ?></a>
		<?php endif; ?>
	</div>
</section>

<!-- Experiences -->
<section class="az-section az-experiences" id="experiences">
	<div class="az-container">
		<div class="az-head reveal">
			<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'exp_eyebrow' ) ); ?></span>
			<h2><?php echo esc_html( azure_mod( 'exp_title' ) ); ?></h2>
		</div>
		<div class="az-exp-grid">
			<?php for ( $n = 1; $n <= 4; $n++ ) : ?>
				<?php if ( azure_mod( "exp_{$n}_title" ) ) : ?>
					<div class="az-exp reveal" style="--delay: <?php echo esc_attr( ( $n - 1 ) * 100 ); ?>ms">
						<span class="az-exp-icon"><?php echo azure_icon( azure_mod( "exp_{$n}_icon" ) ); ?></span>
						<h3><?php echo esc_html( azure_mod( "exp_{$n}_title" ) ); ?></h3>
						<p><?php echo esc_html( azure_mod( "exp_{$n}_text" ) ); ?></p>
					</div>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	</div>
</section>

<!-- Dining & Spa -->
<section class="az-section az-features" id="dining">
	<div class="az-container">
		<?php for ( $n = 1; $n <= 2; $n++ ) : ?>
			<?php if ( azure_mod( "feat_{$n}_title" ) ) : ?>
				<div class="az-feature <?php echo 2 === $n ? 'is-reversed' : ''; ?>">
					<div class="az-feature-media reveal">
						<?php echo azure_image( (int) azure_mod( "feat_{$n}_image" ), __( 'Customize → Dining & Spa: image', 'azure-isle' ), 'ratio-4-3' . ( 2 === $n ? ' tone-sand' : '' ) ); ?>
					</div>
					<div class="az-feature-text reveal">
						<span class="az-eyebrow"><?php echo esc_html( azure_mod( "feat_{$n}_eyebrow" ) ); ?></span>
						<h2><?php echo esc_html( azure_mod( "feat_{$n}_title" ) ); ?></h2>
						<p><?php echo esc_html( azure_mod( "feat_{$n}_text" ) ); ?></p>
						<?php if ( azure_mod( "feat_{$n}_button" ) ) : ?>
							<a href="<?php echo esc_url( azure_mod( "feat_{$n}_url" ) ? azure_mod( "feat_{$n}_url" ) : '#contact' ); ?>" class="az-btn az-btn-outline"><?php echo esc_html( azure_mod( "feat_{$n}_button" ) ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endfor; ?>
	</div>
</section>

<?php if ( $azure_reviews ) : ?>
<!-- Reviews -->
<section class="az-section az-reviews">
	<div class="az-container az-narrow">
		<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'reviews_eyebrow' ) ); ?></span>
		<div class="az-stars" role="img" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'azure-isle' ); ?>">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
		<div class="az-slider" data-az-slider>
			<?php foreach ( $azure_reviews as $index => $review ) : ?>
				<figure class="az-slide <?php echo 0 === $index ? 'is-active' : ''; ?>" aria-hidden="<?php echo 0 === $index ? 'false' : 'true'; ?>">
					<blockquote><?php echo esc_html( $review['quote'] ); ?></blockquote>
					<figcaption>
						<strong><?php echo esc_html( $review['name'] ); ?></strong>
						<span><?php echo esc_html( $review['from'] ); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
			<?php if ( count( $azure_reviews ) > 1 ) : ?>
				<div class="az-dots">
					<?php foreach ( $azure_reviews as $index => $review ) : ?>
						<button type="button" class="az-dot <?php echo 0 === $index ? 'is-active' : ''; ?>" data-az-dot="<?php echo esc_attr( $index ); ?>">
							<span class="screen-reader-text">
								<?php
								/* translators: %d: review number. */
								printf( esc_html__( 'Show review %d', 'azure-isle' ), (int) $index + 1 );
								?>
							</span>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Gallery -->
<section class="az-gallery" id="gallery">
	<?php for ( $n = 1; $n <= 5; $n++ ) : ?>
		<div class="az-gallery-item az-gallery-<?php echo esc_attr( $n ); ?>">
			<?php
			/* translators: %d: image number. */
			echo azure_image( (int) azure_mod( "gallery_{$n}" ), sprintf( __( 'Customize → Gallery: image %d', 'azure-isle' ), $n ), 'az-cover' . ( 0 === $n % 2 ? ' tone-sand' : '' ), 1 === $n ? 'azure-wide' : 'medium_large' );
			?>
		</div>
	<?php endfor; ?>
</section>

<?php if ( 'yes' === azure_mod( 'offer_show' ) ) : ?>
<!-- Offer -->
<section class="az-section az-offer">
	<div class="az-container az-narrow reveal">
		<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'offer_eyebrow' ) ); ?></span>
		<h2><?php echo esc_html( azure_mod( 'offer_title' ) ); ?></h2>
		<p><?php echo esc_html( azure_mod( 'offer_text' ) ); ?></p>
		<?php if ( azure_mod( 'offer_button' ) ) : ?>
			<a href="<?php echo esc_url( $azure_book ); ?>" class="az-btn az-btn-dark"><?php echo esc_html( azure_mod( 'offer_button' ) ); ?></a>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>

<?php
get_footer();
