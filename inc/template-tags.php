<?php
/**
 * Small helper functions used across templates: parsing the pipe-delimited
 * meta fields into arrays, rendering placeholder imagery, badges, icons.
 *
 * @package Trail_Notes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get post meta with a sensible default and no unnecessary escaping —
 * templates escape at output time.
 */
function tn_meta( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, $key, true );
	return ( '' === $value || false === $value ) ? $default : $value;
}

/**
 * Split a textarea into trimmed, non-empty lines.
 */
function tn_parse_lines( $text ) {
	if ( empty( $text ) ) {
		return array();
	}
	$lines = preg_split( '/\r\n|\r|\n/', $text );
	$lines = array_map( 'trim', $lines );
	return array_values( array_filter( $lines, fn( $line ) => '' !== $line ) );
}

/**
 * Split a textarea into lines, then split each line by "|" into columns.
 * Used for route steps, itinerary days, cost items, seasons, wish-i-knew.
 */
function tn_parse_pipe_lines( $text ) {
	$lines  = tn_parse_lines( $text );
	$parsed = array();
	foreach ( $lines as $line ) {
		$parsed[] = array_map( 'trim', explode( '|', $line ) );
	}
	return $parsed;
}

/**
 * Packing list: lines formatted as "Category: item one, item two".
 */
function tn_parse_categorized_list( $text ) {
	$lines  = tn_parse_lines( $text );
	$groups = array();
	foreach ( $lines as $line ) {
		if ( false === strpos( $line, ':' ) ) {
			continue;
		}
		list( $category, $items ) = array_map( 'trim', explode( ':', $line, 2 ) );
		$items                    = array_map( 'trim', explode( ',', $items ) );
		$groups[]                 = array(
			'category' => $category,
			'items'    => array_values( array_filter( $items ) ),
		);
	}
	return $groups;
}

/**
 * A single small inline SVG sprite so we never depend on an icon font or
 * external request.
 */
function tn_icon( $name, $class = '' ) {
	$icons = array(
		'check'    => '<path d="M20 6 9 17l-5-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
		'mountain' => '<path d="M3 20 9 8l4 6 2-3 6 9H3Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>',
		'alert'    => '<path d="M12 3 1 21h22L12 3Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M12 10v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="12" cy="17" r="0.9" fill="currentColor"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
		'camera'   => '<path d="M4 8h3l2-2h6l2 2h3v11H4Z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12" cy="13.5" r="3.2" fill="none" stroke="currentColor" stroke-width="1.5"/>',
	);
	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}
	return sprintf( '<svg class="%s" viewBox="0 0 24 24" aria-hidden="true" focusable="false">%s</svg>', esc_attr( $class ), $icons[ $name ] );
}

/**
 * Render an image: the post's real featured/attached image when present,
 * otherwise a clearly-labelled placeholder tile so the site never shows a
 * broken image and it stays obvious what needs replacing.
 *
 * @param array $args {
 *     @type int    $attachment_id  Attachment to render, 0 for placeholder.
 *     @type string $label          Placeholder label / alt text hint.
 *     @type string $ratio          One of the .ratio-* classes minus the prefix, e.g. '16-9'.
 *     @type string $tone           '' or 'earth'.
 *     @type string $class          Extra classes.
 *     @type string $size           Registered image size for real images.
 * }
 */
function tn_image( $args = array() ) {
	$defaults = array(
		'attachment_id' => 0,
		'label'         => __( 'Add a photo here', 'trail-notes' ),
		'ratio'         => '16-9',
		'tone'          => '',
		'class'         => '',
		'size'          => 'tn-card',
	);
	$args     = wp_parse_args( $args, $defaults );

	$classes = array( 'placeholder-img', 'ratio-' . $args['ratio'] );
	if ( $args['tone'] ) {
		$classes[] = 'tone-' . $args['tone'];
	}
	if ( $args['attachment_id'] ) {
		$classes[] = 'has-photo';
	}
	if ( $args['class'] ) {
		$classes[] = $args['class'];
	}

	ob_start();
	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php if ( $args['attachment_id'] ) : ?>
			<?php echo wp_get_attachment_image( $args['attachment_id'], $args['size'], false, array( 'alt' => esc_attr( $args['label'] ), 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<span class="placeholder-label">
				<?php echo tn_icon( 'mountain' ); ?>
				<?php echo esc_html( $args['label'] ); ?>
			</span>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Map a difficulty term slug to a badge modifier class.
 */
function tn_difficulty_badge_class( $slug ) {
	$map = array(
		'easy'        => 'badge-difficulty-easy',
		'moderate'    => 'badge-difficulty-moderate',
		'challenging' => 'badge-difficulty-challenging',
	);
	return isset( $map[ $slug ] ) ? $map[ $slug ] : 'badge-difficulty-moderate';
}

/**
 * First term name for a taxonomy on a post, with a fallback.
 */
function tn_first_term( $post_id, $taxonomy, $default = '' ) {
	$terms = get_the_terms( $post_id, $taxonomy );
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return $default;
	}
	return $terms[0];
}

/**
 * Print a "[Add ...]" placeholder span for missing editorial data instead
 * of ever inventing a fact.
 */
function tn_placeholder_text( $label ) {
	return '<span class="tn-missing">[' . esc_html( $label ) . ']</span>';
}

/**
 * Value or a bracketed placeholder — never fabricate trek facts.
 */
function tn_value_or_placeholder( $value, $label ) {
	return $value ? esc_html( $value ) : tn_placeholder_text( $label );
}

/**
 * Fallback navigation shown until a menu is assigned to "Primary Navigation"
 * in Appearance → Menus, so the site is never left without navigation.
 */
function tn_default_primary_menu() {
	$items = array(
		'/'             => __( 'Home', 'trail-notes' ),
		'/treks/'       => __( 'My Treks', 'trail-notes' ),
		'/travel-tips/' => __( 'Travel Tips', 'trail-notes' ),
		'/about/'       => __( 'About Me', 'trail-notes' ),
	);
	echo '<ul class="nav-links">';
	foreach ( $items as $path => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( $path ) ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Breadcrumb trail: Home / My Treks / Trek Name.
 */
function tn_breadcrumbs( $trail ) {
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'trail-notes' ) . '"><div class="container"><ol>';
	$count = count( $trail );
	foreach ( $trail as $i => $item ) {
		echo '<li>';
		if ( ! empty( $item['url'] ) && $i !== $count - 1 ) {
			printf( '<a href="%s">%s</a>', esc_url( $item['url'] ), esc_html( $item['label'] ) );
		} else {
			printf( '<span aria-current="page">%s</span>', esc_html( $item['label'] ) );
		}
		echo '</li>';
	}
	echo '</ol></div></nav>';
}
