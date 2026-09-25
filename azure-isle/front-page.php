<?php
/**
 * Front page: hero, welcome, image carousel, video band, accommodations
 * slider, experiences, guest reviews and services. The newsletter band and
 * footer follow from footer.php. Text and images come from Appearance →
 * Customize → Azure Isle — Front Page; rooms from Rooms.
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

$azure_rooms = new WP_Query(
	array(
		'post_type'           => 'azure_room',
		'posts_per_page'      => (int) azure_mod( 'rooms_count' ),
		'orderby'             => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

$azure_video = azure_mod( 'video_url' ) ? wp_oembed_get( azure_mod( 'video_url' ), array( 'width' => 1280 ) ) : '';
?>

<!-- Hero -->
<section class="az-hero az-hero-home">
	<div class="az-hero-media">
		<?php echo azure_image( (int) azure_mod( 'hero_image' ), __( 'Customize → Front Page → Hero: add a wide resort photo', 'azure-isle' ), 'az-cover', 'full' ); ?>
	</div>
	<div class="az-hero-scrim"></div>
	<div class="az-hero-content">
		<h1><?php echo esc_html( azure_mod( 'hero_title' ) ); ?></h1>
		<?php if ( azure_mod( 'hero_text' ) ) : ?>
			<p><?php echo esc_html( azure_mod( 'hero_text' ) ); ?></p>
		<?php endif; ?>
	</div>
</section>

<!-- Welcome -->
<section class="az-section az-welcome" id="about">
	<div class="az-container az-narrow reveal">
		<span class="az-welcome-icon"><?php echo azure_icon( 'resort' ); ?></span>
		<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'welcome_eyebrow' ) ); ?></span>
		<h2 class="az-title"><?php echo esc_html( azure_mod( 'welcome_title' ) ); ?></h2>
		<?php if ( azure_mod( 'welcome_text' ) ) : ?>
			<p><?php echo esc_html( azure_mod( 'welcome_text' ) ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_template_part( 'template-parts/carousel' ); ?>

<?php if ( 'yes' === azure_mod( 'video_show' ) ) : ?>
<!-- Video band -->
<section class="az-video">
	<div class="az-bg">
		<?php echo azure_image( (int) azure_mod( 'video_image' ), __( 'Customize → Front Page → Video Band: background image', 'azure-isle' ), 'az-cover tone-deep', 'full' ); ?>
	</div>
	<?php if ( $azure_video ) : ?>
		<button type="button" class="az-play" data-az-video>
			<?php echo azure_icon( 'play' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Play video', 'azure-isle' ); ?></span>
		</button>
		<template id="az-video-embed"><?php echo $azure_video; // phpcs:ignore WordPress.Security.EscapeOutput -- oEmbed HTML from a trusted provider. ?></template>
	<?php endif; ?>
</section>
<?php endif; ?>

<!-- Accommodations -->
<section class="az-section az-rooms" id="rooms">
	<div class="az-container">
		<div class="az-head-split reveal">
			<div>
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'rooms_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'rooms_title' ) ); ?></h2>
			</div>
			<?php if ( azure_mod( 'rooms_button' ) ) : ?>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'azure_room' ) ); ?>" class="az-btn az-btn-gold"><?php echo esc_html( azure_mod( 'rooms_button' ) ); ?></a>
			<?php endif; ?>
		</div>
		<?php if ( $azure_rooms->have_posts() ) : ?>
			<div class="az-room-slider" data-az-carousel data-az-dots>
				<div class="az-track" data-az-track>
					<?php
					$azure_i = 0;
					while ( $azure_rooms->have_posts() ) :
						$azure_rooms->the_post();
						get_template_part( 'template-parts/room-card', null, array( 'delay' => ( $azure_i++ % 3 ) * 120 ) );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div class="az-dots az-dots-dark" data-az-dot-wrap></div>
			</div>
		<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
			<p class="az-center"><?php esc_html_e( 'No rooms yet. Add them under Rooms → Add New.', 'azure-isle' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<!-- Experiences -->
<section class="az-locations" id="experiences">
	<div class="az-locations-top">
		<div class="az-bg">
			<?php echo azure_image( (int) azure_mod( 'loc_image' ), __( 'Customize → Front Page → Experiences: background image', 'azure-isle' ), 'az-cover tone-deep', 'full' ); ?>
		</div>
		<div class="az-container az-narrow reveal">
			<span class="az-welcome-icon"><?php echo azure_icon( 'waves' ); ?></span>
			<span class="az-eyebrow az-eyebrow-light"><?php echo esc_html( azure_mod( 'loc_eyebrow' ) ); ?></span>
			<h2 class="az-title"><?php echo esc_html( azure_mod( 'loc_title' ) ); ?></h2>
			<?php if ( azure_mod( 'loc_text' ) ) : ?>
				<p><?php echo esc_html( azure_mod( 'loc_text' ) ); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="az-container">
		<div class="az-loc-grid">
			<?php for ( $n = 1; $n <= 3; $n++ ) : ?>
				<?php
				if ( ! azure_mod( "loc_{$n}_title" ) ) {
					continue;
				}
				$azure_url = azure_mod( "loc_{$n}_url" ) ? azure_mod( "loc_{$n}_url" ) : azure_page_url( 'template-about.php' );
				?>
				<article class="az-loc reveal" style="--delay: <?php echo esc_attr( ( $n - 1 ) * 120 ); ?>ms">
					<div class="az-loc-media">
						<?php
						/* translators: %d: card number. */
						echo azure_image( (int) azure_mod( "loc_{$n}_image" ), sprintf( __( 'Experiences: card %d image', 'azure-isle' ), $n ), 'ratio-3-4' . ( 2 === $n ? ' tone-sand' : '' ), 'azure-card' );
						?>
					</div>
					<h3><?php echo esc_html( azure_mod( "loc_{$n}_title" ) ); ?></h3>
					<p><?php echo esc_html( azure_mod( "loc_{$n}_text" ) ); ?></p>
					<?php if ( $azure_url ) : ?>
						<a href="<?php echo esc_url( $azure_url ); ?>" class="az-link"><?php esc_html_e( 'Discover More', 'azure-isle' ); ?> <?php echo azure_icon( 'arrow' ); ?></a>
					<?php endif; ?>
				</article>
			<?php endfor; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/reviews' );
get_template_part( 'template-parts/services' );

get_footer();
