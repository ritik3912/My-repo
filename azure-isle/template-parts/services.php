<?php
/**
 * Services: tall image with a handwritten line, heading, icon list and a
 * wide image (front and About pages).
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="az-section az-services" id="services">
	<div class="az-container az-services-grid">
		<div class="az-services-media reveal">
			<?php echo azure_image( (int) azure_mod( 'serv_image_1' ), __( 'Customize → Front Page → Services: tall image', 'azure-isle' ), 'ratio-3-4', 'azure-card' ); ?>
			<?php if ( azure_mod( 'serv_script' ) ) : ?>
				<p class="az-script"><?php echo esc_html( azure_mod( 'serv_script' ) ); ?></p>
			<?php endif; ?>
		</div>
		<div class="az-services-body">
			<div class="reveal">
				<span class="az-eyebrow"><?php echo esc_html( azure_mod( 'serv_eyebrow' ) ); ?></span>
				<h2 class="az-title"><?php echo esc_html( azure_mod( 'serv_title' ) ); ?></h2>
			</div>
			<ul class="az-service-list">
				<?php for ( $n = 1; $n <= 6; $n++ ) : ?>
					<?php if ( azure_mod( "serv_{$n}_title" ) ) : ?>
						<li class="reveal" style="--delay: <?php echo esc_attr( ( ( $n - 1 ) % 2 ) * 120 ); ?>ms">
							<span class="az-service-icon"><?php echo azure_icon( azure_mod( "serv_{$n}_icon" ) ); ?></span>
							<div>
								<h3><?php echo esc_html( azure_mod( "serv_{$n}_title" ) ); ?></h3>
								<p><?php echo esc_html( azure_mod( "serv_{$n}_text" ) ); ?></p>
							</div>
						</li>
					<?php endif; ?>
				<?php endfor; ?>
			</ul>
			<div class="reveal">
				<?php echo azure_image( (int) azure_mod( 'serv_image_2' ), __( 'Customize → Front Page → Services: wide image', 'azure-isle' ), 'ratio-16-10 tone-sand', 'azure-wide' ); ?>
			</div>
		</div>
	</div>
</section>
