<?php
/**
 * Generic page template — used for any Page that isn't About, Travel
 * Tips or Plan a Trek (which have their own templates).
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="section-tight section-alt">
		<div class="container">
			<div class="section-head reveal">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<div class="entry-content reveal">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
