<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Hovercraft
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hovercraft_body_classes( $classes ) {
	// Adds a class when the slider page template is active.
	if ( is_page_template( 'template-parts/page-slider.php' ) ) {
		$classes[] = 'fullscreen-slider';
	}

	// Adds a class depending on whether sidebar is active and the selection in the customizer.
	$sidebar = get_theme_mod( 'hovercraft_sidebar', 'right-sidebar' );

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	elseif ( is_active_sidebar( 'sidebar-1' ) && $sidebar == 'right-sidebar' ) {
		$classes[] = 'right-sidebar';
	}

	elseif ( is_active_sidebar( 'sidebar-1' ) && $sidebar == 'left-sidebar' ) {
		$classes[] = 'left-sidebar';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'hovercraft_body_classes' );

/**
 * Remove custom-background class from the array of body classes.
 */
function hovercraft_remove_body_class($classes) {
	// Remove the custom background when the page slider is displayed.
	if ( is_page_template( 'template-parts/page-slider.php' ) && hovercraft_has_featured_posts( 2 ) ) :
		foreach( $classes as $key => $value ) {
			if ($value == 'custom-background' ) unset( $classes[$key] );
		}
	endif;
	return $classes;
}
add_filter('body_class', 'hovercraft_remove_body_class', 20, 2);

/**
 * Remove the tagline from the home page title.
 */
function hovercraft_remove_tagline( $title ) {
  if ( isset($title['tagline']) ) {
		unset( $title['tagline'] );
	}
  return $title;
}
add_filter( 'document_title_parts', 'hovercraft_remove_tagline' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function hovercraft_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'hovercraft' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'hovercraft_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function hovercraft_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'hovercraft_render_title' );
endif;
