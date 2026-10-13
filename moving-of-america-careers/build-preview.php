<?php
/**
 * Renders page-careers.php to preview.html without WordPress, so the design can be checked in a browser.
 * The Contact Form 7 shortcode is replaced by sample fields; on the live site your real "Career" form renders there.
 * Usage: php build-preview.php
 */
function has_post_thumbnail() { return false; }
function get_the_post_thumbnail_url() { return ''; }
function esc_url( $u ) { return htmlspecialchars( $u, ENT_QUOTES ); }
function get_header() {
	echo "<!doctype html>\n<html lang=\"en\">\n<head>\n<meta charset=\"utf-8\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n<title>Careers | Moving of America (preview)</title>\n<style>body{margin:0}.preview-bar{padding:18px 24px;background:#fff;border-bottom:1px solid #e4e7ee;font:600 14px/1.4 Arial,sans-serif;color:#5a6273;text-align:center}</style>\n</head>\n<body>\n<div class=\"preview-bar\">Your site header appears here</div>\n";
}
function get_footer() {
	echo "<div class=\"preview-bar\" style=\"border-top:1px solid #e4e7ee;border-bottom:0\">Your site footer appears here</div>\n</body>\n</html>\n";
}
function do_shortcode( $s ) {
	return '<div class="wpcf7"><form onsubmit="event.preventDefault()">'
		. '<p><label>Full name<input type="text" required></label></p>'
		. '<p><label>Email<input type="email" required></label></p>'
		. '<p><label>Phone<input type="tel"></label></p>'
		. '<p><label>Position<select><option>Driver</option><option>Mover</option><option>Foreman</option><option>Field Inspector</option></select></label></p>'
		. '<p><label>Tell us about your experience<textarea></textarea></label></p>'
		. '<p><input type="submit" value="Submit application" class="wpcf7-submit"></p>'
		. '</form></div><!-- Preview only. Live site renders: ' . htmlspecialchars( $s ) . ' -->';
}
ob_start();
include __DIR__ . '/page-careers.php';
file_put_contents( __DIR__ . '/preview.html', ob_get_clean() );
echo "Wrote preview.html\n";
