<?php
/**
 * Exports page-careers.php as careers.html: plain HTML (styles, markup, script) with the
 * Contact Form 7 shortcode left in place, ready to paste into a WordPress Custom HTML block.
 * Usage: php build-html.php
 */
function esc_url( $u ) { return htmlspecialchars( $u, ENT_QUOTES ); }
function get_header() {}
function get_footer() {}
function do_shortcode( $s ) { return $s; }
ob_start();
include __DIR__ . '/page-careers.php';
$html = trim( ob_get_clean() );
$html = "<!-- Moving of America careers page. Paste into a WordPress Custom HTML block. -->\n" . $html . "\n";
file_put_contents( __DIR__ . '/careers.html', $html );
echo "Wrote careers.html\n";
