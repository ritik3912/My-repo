<?php
/**
 * Comments list and form.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) || post_password_required() ) {
	return;
}
?>
<div class="az-entry az-comments" id="comments">
	<?php if ( have_comments() ) : ?>
		<h2>
			<?php
			/* translators: %s: comment count. */
			printf( esc_html( _n( '%s Comment', '%s Comments', get_comments_number(), 'azure-isle' ) ), esc_html( number_format_i18n( get_comments_number() ) ) );
			?>
		</h2>
		<ol class="az-comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php comment_form(); ?>
</div>
