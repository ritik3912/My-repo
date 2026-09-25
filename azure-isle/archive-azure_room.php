<?php
/**
 * Rooms archive (/rooms/).
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part(
	'template-parts/page-header',
	null,
	array(
		'eyebrow' => azure_mod( 'rooms_eyebrow' ),
		'title'   => esc_html( azure_mod( 'rooms_title' ) ),
		'text'    => esc_html( azure_mod( 'rooms_text' ) ),
	)
);
?>

<section class="az-section az-section-tight">
	<div class="az-container">
		<?php if ( have_posts() ) : ?>
			<div class="az-room-grid">
				<?php
				$azure_i = 0;
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/room-card', null, array( 'delay' => ( $azure_i++ % 3 ) * 120 ) );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p class="az-center"><?php esc_html_e( 'No rooms published yet.', 'azure-isle' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
