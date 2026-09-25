<?php
/**
 * Single room: full-screen image, details strip, description, other rooms.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$azure_price = get_post_meta( get_the_ID(), '_azure_price', true );
	$azure_meta  = azure_room_meta( get_the_ID(), array( '_azure_size', '_azure_guests', '_azure_bed', '_azure_view' ) );
	$azure_label = array(
		'_azure_size'   => __( 'Size', 'azure-isle' ),
		'_azure_guests' => __( 'Occupancy', 'azure-isle' ),
		'_azure_bed'    => __( 'Beds', 'azure-isle' ),
		'_azure_view'   => __( 'View', 'azure-isle' ),
	);
	?>
	<section class="az-hero az-hero-room">
		<div class="az-hero-media">
			<?php echo azure_image( get_post_thumbnail_id(), __( 'Set this room\'s Featured Image', 'azure-isle' ), 'az-cover', 'full' ); ?>
		</div>
		<div class="az-hero-scrim"></div>
		<div class="az-hero-content">
			<?php if ( $azure_price ) : ?>
				<span class="az-eyebrow az-eyebrow-light">
					<?php
					/* translators: %s: nightly price. */
					printf( esc_html__( 'From %s / night', 'azure-isle' ), esc_html( $azure_price ) );
					?>
				</span>
			<?php endif; ?>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>

	<?php if ( $azure_meta ) : ?>
		<div class="az-room-facts">
			<div class="az-container">
				<ul>
					<?php foreach ( $azure_meta as $key => $value ) : ?>
						<li><span><?php echo esc_html( $azure_label[ $key ] ); ?></span><strong><?php echo esc_html( $value ); ?></strong></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>

	<article <?php post_class( 'az-section az-section-tight' ); ?>>
		<div class="az-entry">
			<?php if ( has_excerpt() ) : ?>
				<p class="az-lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<?php the_content(); ?>
			<p><a href="<?php echo esc_url( azure_booking_url() ); ?>" class="az-btn az-btn-dark"><?php esc_html_e( 'Book This Room', 'azure-isle' ); ?></a></p>
		</div>
	</article>

	<?php
	$azure_more = new WP_Query(
		array(
			'post_type'      => 'azure_room',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		)
	);
	if ( $azure_more->have_posts() ) :
		?>
		<section class="az-section az-rooms">
			<div class="az-container">
				<div class="az-head">
					<span class="az-eyebrow"><?php esc_html_e( 'Stay With Us', 'azure-isle' ); ?></span>
					<h2><?php esc_html_e( 'Other Rooms', 'azure-isle' ); ?></h2>
				</div>
				<div class="az-room-grid">
					<?php
					while ( $azure_more->have_posts() ) :
						$azure_more->the_post();
						get_template_part( 'template-parts/room-card' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
		<?php
	endif;
endwhile;

get_footer();
