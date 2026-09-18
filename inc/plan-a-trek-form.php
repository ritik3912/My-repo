<?php
/**
 * Handles the "Plan a Trek" contact form without a forms plugin: a plain
 * POST to admin-post.php, verified with a nonce and a honeypot field,
 * emailed to the site admin via wp_mail(), then a redirect back to the
 * page with a status flag the template reads.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tn_handle_plan_a_trek_submission() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/plan-a-trek/' );

	if ( ! isset( $_POST['tn_plan_nonce'] ) || ! wp_verify_nonce( $_POST['tn_plan_nonce'], 'tn_plan_a_trek' ) ) {
		wp_safe_redirect( add_query_arg( 'trek_plan', 'error', $redirect ) );
		exit;
	}

	// Honeypot: real visitors never fill this hidden field.
	if ( ! empty( $_POST['tn_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'trek_plan', 'success', $redirect ) );
		exit;
	}

	$name    = isset( $_POST['tn_name'] ) ? sanitize_text_field( wp_unslash( $_POST['tn_name'] ) ) : '';
	$email   = isset( $_POST['tn_email'] ) ? sanitize_email( wp_unslash( $_POST['tn_email'] ) ) : '';
	$trek    = isset( $_POST['tn_interested_trek'] ) ? sanitize_text_field( wp_unslash( $_POST['tn_interested_trek'] ) ) : '';
	$dates   = isset( $_POST['tn_dates'] ) ? sanitize_text_field( wp_unslash( $_POST['tn_dates'] ) ) : '';
	$message = isset( $_POST['tn_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['tn_message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'trek_plan', 'error', $redirect ) );
		exit;
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[%s] New trek planning enquiry from %s', get_bloginfo( 'name' ), $name );
	$body    = "New enquiry from the Plan a Trek form:\n\n"
		. "Name: {$name}\n"
		. "Email: {$email}\n"
		. "Trek of interest: {$trek}\n"
		. "Preferred dates: {$dates}\n\n"
		. "Message:\n{$message}\n";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'trek_plan', 'success', $redirect ) );
	exit;
}
add_action( 'admin_post_tn_plan_a_trek', 'tn_handle_plan_a_trek_submission' );
add_action( 'admin_post_nopriv_tn_plan_a_trek', 'tn_handle_plan_a_trek_submission' );
