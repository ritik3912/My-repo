<?php
/**
 * Template Name: Contact Page
 *
 * Banner, contact details (address, phone, email, hours), a message form
 * that emails the team, and a map. Text comes from Appearance → Customize →
 * Azure Isle — Contact Page; address, phone and email from Site Settings.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$azure_addr  = azure_mod( 'address' );
$azure_phone = azure_mod( 'phone' );
$azure_email = azure_mod( 'email' );
$azure_hours = azure_mod( 'contact_hours' );
$azure_map   = azure_mod( 'map_query' ) ? azure_mod( 'map_query' ) : $azure_addr;

while ( have_posts() ) :
	the_post();

	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'image'   => azure_page_hero_image( 'contact_hero_image' ),
			'label'   => __( 'Customize → Contact Page → Page Header: background image', 'azure-isle' ),
			'eyebrow' => azure_mod( 'contact_hero_eyebrow' ),
			'title'   => get_the_title(),
			'text'    => azure_mod( 'contact_hero_text' ),
		)
	);
	?>

	<!-- Contact details -->
	<section class="az-section az-contact-info">
		<div class="az-container">
			<div class="az-head reveal">
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'contact_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'contact_title' ) ); ?></h2>
				<?php if ( azure_mod( 'contact_text' ) ) : ?>
					<p><?php echo esc_html( azure_mod( 'contact_text' ) ); ?></p>
				<?php endif; ?>
			</div>
			<ul class="az-contact-cards">
				<?php if ( $azure_addr ) : ?>
					<li class="reveal">
						<span class="az-service-icon"><?php echo azure_icon( 'pin' ); ?></span>
						<h3><?php esc_html_e( 'Address', 'azure-isle' ); ?></h3>
						<p><?php echo nl2br( esc_html( $azure_addr ) ); ?></p>
					</li>
				<?php endif; ?>
				<?php if ( $azure_phone ) : ?>
					<li class="reveal" style="--delay: 100ms">
						<span class="az-service-icon"><?php echo azure_icon( 'phone' ); ?></span>
						<h3><?php esc_html_e( 'Phone', 'azure-isle' ); ?></h3>
						<p><a href="<?php echo esc_attr( azure_tel( $azure_phone ) ); ?>"><?php echo esc_html( $azure_phone ); ?></a></p>
					</li>
				<?php endif; ?>
				<?php if ( $azure_email ) : ?>
					<li class="reveal" style="--delay: 200ms">
						<span class="az-service-icon"><?php echo azure_icon( 'mail' ); ?></span>
						<h3><?php esc_html_e( 'Email', 'azure-isle' ); ?></h3>
						<p><a href="mailto:<?php echo esc_attr( antispambot( $azure_email ) ); ?>"><?php echo esc_html( antispambot( $azure_email ) ); ?></a></p>
					</li>
				<?php endif; ?>
				<?php if ( $azure_hours ) : ?>
					<li class="reveal" style="--delay: 300ms">
						<span class="az-service-icon"><?php echo azure_icon( 'clock' ); ?></span>
						<h3><?php esc_html_e( 'Opening Hours', 'azure-isle' ); ?></h3>
						<p><?php echo nl2br( esc_html( $azure_hours ) ); ?></p>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</section>

	<!-- Form -->
	<section class="az-section az-contact-form-section" id="contact-form">
		<div class="az-container az-contact-grid">
			<div class="az-contact-media reveal">
				<?php echo azure_image( (int) azure_mod( 'form_image' ), __( 'Customize → Contact Page → Contact Form: image', 'azure-isle' ), 'ratio-3-4', 'azure-card' ); ?>
			</div>
			<div class="az-contact-form-wrap reveal">
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'form_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'form_title' ) ); ?></h2>
				<?php
				azure_form_notice(
					'az_contact',
					array(
						'sent'    => azure_mod( 'form_success' ),
						'invalid' => __( 'Please fill in your name, a valid email and a message.', 'azure-isle' ),
						'error'   => __( 'Sorry, the message could not be sent. Please email or call us instead.', 'azure-isle' ),
					)
				);
				?>
				<form class="az-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="azure_contact">
					<?php wp_nonce_field( 'azure_contact', 'azure_contact_nonce' ); ?>
					<input type="text" name="az_website" class="az-hp" tabindex="-1" autocomplete="off" aria-hidden="true">
					<div class="az-form-row">
						<label>
							<span><?php esc_html_e( 'Name', 'azure-isle' ); ?> *</span>
							<input type="text" name="az_name" autocomplete="name" required>
						</label>
						<label>
							<span><?php esc_html_e( 'Email', 'azure-isle' ); ?> *</span>
							<input type="email" name="az_email" autocomplete="email" required>
						</label>
					</div>
					<div class="az-form-row">
						<label>
							<span><?php esc_html_e( 'Phone', 'azure-isle' ); ?></span>
							<input type="tel" name="az_phone" autocomplete="tel">
						</label>
						<label>
							<span><?php esc_html_e( 'Subject', 'azure-isle' ); ?></span>
							<input type="text" name="az_subject">
						</label>
					</div>
					<label>
						<span><?php esc_html_e( 'Message', 'azure-isle' ); ?> *</span>
						<textarea name="az_message" rows="6" required></textarea>
					</label>
					<button type="submit" class="az-btn az-btn-gold"><?php esc_html_e( 'Send Message', 'azure-isle' ); ?></button>
				</form>
			</div>
		</div>
	</section>

	<?php if ( '' !== trim( get_the_content() ) ) : ?>
		<section class="az-section az-section-tight">
			<div class="az-entry"><?php the_content(); ?></div>
		</section>
	<?php endif; ?>

	<?php if ( 'yes' === azure_mod( 'map_show' ) && $azure_map ) : ?>
		<section class="az-map">
			<iframe title="<?php esc_attr_e( 'Map', 'azure-isle' ); ?>" src="<?php echo esc_url( 'https://maps.google.com/maps?q=' . rawurlencode( $azure_map ) . '&z=13&output=embed' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</section>
	<?php endif; ?>
	<?php
endwhile;

get_footer();
