<?php
/**
 * Contact form and newsletter sign-up handlers (admin-post.php).
 * Both email the site team; nothing is stored in the database.
 *
 * @package Azure_Isle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Who receives form emails.
 */
function azure_form_recipient() {
	$to = azure_mod( 'form_to' );
	return is_email( $to ) ? $to : get_option( 'admin_email' );
}

/**
 * Send the visitor back to the page they came from with a status flag.
 *
 * @param string $key    Query arg name.
 * @param string $status Status value.
 * @param string $anchor Fragment to jump to.
 */
function azure_form_redirect( $key, $status, $anchor ) {
	$back = wp_get_referer();
	if ( ! $back ) {
		$back = home_url( '/' );
	}
	$back = remove_query_arg( array( 'az_contact', 'az_news' ), $back );
	wp_safe_redirect( add_query_arg( $key, $status, $back ) . '#' . $anchor );
	exit;
}

/**
 * Handle the Contact page form.
 */
function azure_handle_contact() {
	if ( ! isset( $_POST['azure_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['azure_contact_nonce'] ) ), 'azure_contact' ) ) {
		azure_form_redirect( 'az_contact', 'error', 'contact-form' );
	}

	// Honeypot: real visitors never see or fill this field.
	if ( ! empty( $_POST['az_website'] ) ) {
		azure_form_redirect( 'az_contact', 'sent', 'contact-form' );
	}

	$name    = isset( $_POST['az_name'] ) ? sanitize_text_field( wp_unslash( $_POST['az_name'] ) ) : '';
	$email   = isset( $_POST['az_email'] ) ? sanitize_email( wp_unslash( $_POST['az_email'] ) ) : '';
	$phone   = isset( $_POST['az_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['az_phone'] ) ) : '';
	$subject = isset( $_POST['az_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['az_subject'] ) ) : '';
	$message = isset( $_POST['az_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['az_message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		azure_form_redirect( 'az_contact', 'invalid', 'contact-form' );
	}

	$body  = sprintf( "%s: %s\n", __( 'Name', 'azure-isle' ), $name );
	$body .= sprintf( "%s: %s\n", __( 'Email', 'azure-isle' ), $email );
	if ( $phone ) {
		$body .= sprintf( "%s: %s\n", __( 'Phone', 'azure-isle' ), $phone );
	}
	$body .= "\n" . $message . "\n";

	/* translators: 1: site name, 2: subject line. */
	$title = sprintf( __( '[%1$s] Contact: %2$s', 'azure-isle' ), get_bloginfo( 'name' ), $subject ? $subject : $name );
	$sent  = wp_mail( azure_form_recipient(), $title, $body, array( 'Reply-To: ' . $name . ' <' . $email . '>' ) );

	azure_form_redirect( 'az_contact', $sent ? 'sent' : 'error', 'contact-form' );
}
add_action( 'admin_post_nopriv_azure_contact', 'azure_handle_contact' );
add_action( 'admin_post_azure_contact', 'azure_handle_contact' );

/**
 * Handle the newsletter sign-up when no external form action is set.
 */
function azure_handle_newsletter() {
	if ( ! isset( $_POST['azure_news_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['azure_news_nonce'] ) ), 'azure_news' ) ) {
		azure_form_redirect( 'az_news', 'error', 'newsletter' );
	}
	if ( ! empty( $_POST['az_website'] ) ) {
		azure_form_redirect( 'az_news', 'ok', 'newsletter' );
	}

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	if ( ! is_email( $email ) || empty( $_POST['az_consent'] ) ) {
		azure_form_redirect( 'az_news', 'invalid', 'newsletter' );
	}

	/* translators: %s: site name. */
	$title = sprintf( __( '[%s] New newsletter sign-up', 'azure-isle' ), get_bloginfo( 'name' ) );
	$sent  = wp_mail( azure_form_recipient(), $title, $email );

	azure_form_redirect( 'az_news', $sent ? 'ok' : 'error', 'newsletter' );
}
add_action( 'admin_post_nopriv_azure_newsletter', 'azure_handle_newsletter' );
add_action( 'admin_post_azure_newsletter', 'azure_handle_newsletter' );

/**
 * Status notice after a form redirect.
 *
 * @param string $key      Query arg name.
 * @param array  $messages Status => message.
 */
function azure_form_notice( $key, $messages ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.
	$status = isset( $_GET[ $key ] ) ? sanitize_key( wp_unslash( $_GET[ $key ] ) ) : '';
	if ( isset( $messages[ $status ] ) ) {
		$class = in_array( $status, array( 'sent', 'ok' ), true ) ? 'is-success' : 'is-error';
		echo '<p class="az-notice ' . esc_attr( $class ) . '" role="status">' . esc_html( $messages[ $status ] ) . '</p>';
	}
}
