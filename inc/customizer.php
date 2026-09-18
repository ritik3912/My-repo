<?php
/**
 * A handful of Customizer settings for the bits of content that change
 * without touching code: social links and the footer tagline.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tn_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'tn_social',
		array(
			'title'    => __( 'Trail Notes — Social & Contact', 'trail-notes' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'tn_instagram_url' => __( 'Instagram URL', 'trail-notes' ),
		'tn_youtube_url'   => __( 'YouTube URL', 'trail-notes' ),
		'tn_contact_email' => __( 'Contact Email', 'trail-notes' ),
	);

	foreach ( $fields as $id => $label ) {
		$sanitize = 'tn_contact_email' === $id ? 'sanitize_email' : 'esc_url_raw';
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => '',
				'sanitize_callback' => $sanitize,
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label,
				'section' => 'tn_social',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'tn_customize_register' );

function tn_social_url( $key ) {
	return get_theme_mod( $key, '' );
}
