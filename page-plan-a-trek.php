<?php
/**
 * Template Name: Plan a Trek
 *
 * Also auto-applies to a Page with the slug "plan-a-trek". Submits to
 * admin-post.php?action=tn_plan_a_trek, handled in
 * inc/plan-a-trek-form.php, and emails the site admin — no forms plugin
 * required.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$tn_status    = isset( $_GET['trek_plan'] ) ? sanitize_key( wp_unslash( $_GET['trek_plan'] ) ) : '';
$tn_all_treks = get_posts( array( 'post_type' => 'trek', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ) );
?>

<section class="section-tight section-alt">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow"><?php esc_html_e( 'Plan a Trek', 'trail-notes' ); ?></span>
			<h1><?php esc_html_e( 'Start Planning Your Trek', 'trail-notes' ); ?></h1>
			<p class="lede"><?php esc_html_e( "Tell me which trail you're thinking about and when — I'll get back with practical, honest advice based on what I actually experienced.", 'trail-notes' ); ?></p>
		</div>
	</div>
</section>

<section class="section">
	<div class="container" style="max-width:720px;">
		<div class="form-card reveal">
			<?php if ( 'success' === $tn_status ) : ?>
				<div class="form-success">
					<strong><?php esc_html_e( 'Thanks — that\'s sent.', 'trail-notes' ); ?></strong>
					<p class="mt-0"><?php esc_html_e( "I'll get back to you as soon as I can.", 'trail-notes' ); ?></p>
				</div>
			<?php elseif ( 'error' === $tn_status ) : ?>
				<div class="form-error">
					<?php esc_html_e( 'Something was missing — please check your name and email and try again.', 'trail-notes' ); ?>
				</div>
			<?php endif; ?>

			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="tn_plan_a_trek">
				<?php wp_nonce_field( 'tn_plan_a_trek', 'tn_plan_nonce' ); ?>
				<p style="position:absolute;left:-9999px;" aria-hidden="true">
					<label for="tn_website"><?php esc_html_e( 'Leave this field empty', 'trail-notes' ); ?></label>
					<input type="text" id="tn_website" name="tn_website" tabindex="-1" autocomplete="off">
				</p>

				<div class="form-grid">
					<div class="form-row">
						<label for="tn_name"><?php esc_html_e( 'Your Name', 'trail-notes' ); ?></label>
						<input type="text" id="tn_name" name="tn_name" required>
					</div>
					<div class="form-row">
						<label for="tn_email"><?php esc_html_e( 'Email', 'trail-notes' ); ?></label>
						<input type="email" id="tn_email" name="tn_email" required>
					</div>
				</div>

				<div class="form-grid">
					<div class="form-row">
						<label for="tn_interested_trek"><?php esc_html_e( 'Trek You\'re Interested In', 'trail-notes' ); ?></label>
						<select id="tn_interested_trek" name="tn_interested_trek">
							<option value=""><?php esc_html_e( 'Not sure yet', 'trail-notes' ); ?></option>
							<?php foreach ( $tn_all_treks as $tn_trek ) : ?>
								<option value="<?php echo esc_attr( get_the_title( $tn_trek ) ); ?>"><?php echo esc_html( get_the_title( $tn_trek ) ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-row">
						<label for="tn_dates"><?php esc_html_e( 'Preferred Dates', 'trail-notes' ); ?></label>
						<input type="text" id="tn_dates" name="tn_dates" placeholder="e.g. Early October">
					</div>
				</div>

				<div class="form-row">
					<label for="tn_message"><?php esc_html_e( 'Message', 'trail-notes' ); ?></label>
					<textarea id="tn_message" name="tn_message" rows="5" placeholder="<?php esc_attr_e( 'Group size, fitness level, anything you want me to know…', 'trail-notes' ); ?>"></textarea>
				</div>

				<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Send Message', 'trail-notes' ); ?></button>
				<p class="form-note"><?php esc_html_e( "This goes straight to my inbox — I read every message myself.", 'trail-notes' ); ?></p>
			</form>
		</div>
	</div>
</section>

<?php get_footer(); ?>
