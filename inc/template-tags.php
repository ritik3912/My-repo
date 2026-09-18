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
 * Read a JSON-encoded post meta value (photo galleries, videos) back into
 * an array, tolerating missing/corrupt data instead of fataling.
 */
function tn_get_json_meta( $post_id, $key, $default = array() ) {
	$raw = tn_meta( $post_id, $key );
	if ( '' === $raw ) {
		return $default;
	}
	$decoded = json_decode( $raw, true );
	return is_array( $decoded ) ? $decoded : $default;
}

/**
 * Turn a video entry (from the Trek Videos meta box) into embeddable HTML:
 * a responsive YouTube/Vimeo/oEmbed iframe for "embed" entries, or a plain
 * <video> tag for a file uploaded to the Media Library.
 */
function tn_video_embed_html( $entry ) {
	if ( empty( $entry['value'] ) ) {
		return '';
	}
	$label = isset( $entry['label'] ) ? $entry['label'] : '';

	if ( 'upload' === ( $entry['type'] ?? '' ) ) {
		$url = wp_get_attachment_url( (int) $entry['value'] );
		if ( ! $url ) {
			return '';
		}
		return sprintf(
			'<video controls preload="metadata" src="%s">%s</video>',
			esc_url( $url ),
			esc_html__( 'Your browser does not support embedded video.', 'trail-notes' )
		);
	}

	$url = esc_url_raw( $entry['value'] );
	if ( ! $url ) {
		return '';
	}

	if ( preg_match( '~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/))([A-Za-z0-9_-]{6,})~', $url, $m ) ) {
		return sprintf(
			'<iframe src="https://www.youtube-nocookie.com/embed/%1$s" title="%2$s" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
			esc_attr( $m[1] ),
			esc_attr( $label )
		);
	}

	if ( preg_match( '~vimeo\.com/(?:video/)?(\d+)~', $url, $m ) ) {
		return sprintf(
			'<iframe src="https://player.vimeo.com/video/%1$s" title="%2$s" loading="lazy" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>',
			esc_attr( $m[1] ),
			esc_attr( $label )
		);
	}

	$embed = wp_oembed_get( $url );
	return $embed ? $embed : '';
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
		'route'    => '<path d="M12 21s7-7.5 7-12a7 7 0 1 0-14 0c0 4.5 7 12 7 12Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="9" r="2.3" fill="none" stroke="currentColor" stroke-width="1.6"/>',
		'backpack' => '<path d="M8 8V6a4 4 0 0 1 8 0v2" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><rect x="5" y="8" width="14" height="13" rx="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M9 13h6M10 8v3h4V8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
		'wallet'   => '<rect x="3" y="6" width="18" height="13" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3 10h18" stroke="currentColor" stroke-width="1.6"/><circle cx="16" cy="14" r="1.3" fill="currentColor"/>',
		'heart'    => '<path d="M12 20s-7-4.35-9.5-8.8C.8 8 2 4.5 5.5 4a5 5 0 0 1 6.5 2 5 5 0 0 1 6.5-2c3.5.5 4.7 4 3 7.2C19 15.65 12 20 12 20Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>',
		'compass'  => '<circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="m14.8 9.2-2 5.6-5.6 2 2-5.6 5.6-2Z" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>',
		'shield'   => '<path d="M12 3 4 6v6c0 5 3.5 7.7 8 9 4.5-1.3 8-4 8-9V6l-8-3Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m9 12 2 2 4-4" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
		'play'     => '<circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M10 8.5v7l6-3.5-6-3.5Z" fill="currentColor"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="m4 7 8 6 8-6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>',
		'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3 9h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>',
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
