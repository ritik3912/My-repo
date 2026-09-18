<?php
/**
 * A single "Before You Hit the Trail" tip card.
 *
 * @param array $args { int $number, string $title, string $summary, string $url }
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$number  = $args['number'] ?? '';
$title   = $args['title'] ?? '';
$summary = $args['summary'] ?? '';
$url     = $args['url'] ?? '#';
?>
<a href="<?php echo esc_url( $url ); ?>" class="tip-card reveal">
	<span class="tip-number"><?php echo esc_html( sprintf( '%02d', (int) $number ) ); ?></span>
	<h4><?php echo esc_html( $title ); ?></h4>
	<p><?php echo esc_html( $summary ); ?></p>
	<span class="btn-text"><?php esc_html_e( 'Read more', 'trail-notes' ); ?> <?php echo tn_icon( 'arrow' ); ?></span>
</a>
