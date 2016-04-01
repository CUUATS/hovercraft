<?php
/**
 * Hovercraft functions and definitions
 *
 * @package Hovercraft
 */

if ( ! function_exists( 'hovercraft_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hovercraft_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Hovercraft, use a find and replace
	 * to change 'hovercraft' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hovercraft', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/* Remove the spacing for the admin bar. It is placed using flexbox. */
	add_action('get_header', 'hovercraft_remove_admin_login_header');
	function hovercraft_remove_admin_login_header() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}

	/* Remove the URL field from the comments form. */
	function hovercraft_disable_comment_url($fields) {
	  unset( $fields['url'] );
	  return $fields;
	}
	add_filter( 'comment_form_default_fields','hovercraft_disable_comment_url' );

	/* Address accessibility issues with TablePress DataTables */
	function hovercraft_all_datatables_commands( $commands ) {
		return $commands . "\n" . file_get_contents(get_template_directory() . '/js/datatables-hovercraft.js') . "\n";

	}
	add_filter( 'tablepress_all_datatables_commands', 'hovercraft_all_datatables_commands', 1000 );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 640, 9999, false );
	add_image_size( 'hovercraft-banner-large', 1600, 9999, false );
	add_image_size( 'hovercraft-banner-medium', 1024, 9999, false );
	add_image_size( 'hovercraft-banner-small', 800, 9999, false );

	/**
	 * Add inline styles for banner images.
	 *
	 * @see wp_add_inline_style()
	 */
	function hovercraft_banner_image() {
		$css = '';
		if ( hovercraft_post_has_featured_image() && is_singular() ) {
			$attachment_id = get_post_thumbnail_id( get_the_ID() );
			$large_url = wp_get_attachment_image_url( $attachment_id, 'hovercraft-banner-large' );
			$medium_url = wp_get_attachment_image_url( $attachment_id, 'hovercraft-banner-medium' );
			$small_url = wp_get_attachment_image_url( $attachment_id, 'hovercraft-banner-small' );
			$header_rgba = hovercraft_hex2rgba( get_theme_mod( 'hovercraft_header_background_color', '#eeeeee' ), 0.9 );
			ob_start();
			require get_template_directory() . '/inc/theme-banner.php.css';
			$css = ob_get_clean();
		}
		wp_add_inline_style('hovercraft-style', preg_replace('/\s+/', ' ', $css));
	}
	add_action('wp_enqueue_scripts', 'hovercraft_banner_image');

	/**
	 * Convert hex color to RGBA.
	 *
	 * @param string $color.
	 * @param float $alpha.
	 * @return string.
	 */
	function hovercraft_hex2rgba( $color, $alpha ) {
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			$hex = str_replace("#", "", $color);
			if (strlen( $hex ) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}

			$color = "rgba({$r}, {$g}, {$b}, {$alpha})";

			return $color;
		}

		else {
			return '';
		}
	}

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'hovercraft' ),
		'social' => esc_html__( 'Social Menu', 'hovercraft' ),
		'slider' => esc_html__( 'Slider', 'hovercraft' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif; // hovercraft_setup
add_action( 'after_setup_theme', 'hovercraft_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hovercraft_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hovercraft_content_width', 640 );
}
add_action( 'after_setup_theme', 'hovercraft_content_width', 0 );

/**
 * Adjust content_width value for full width page template.
 *
 * @since Hovercraft 1.1.1
 */
function hovercraft_full_width_page_content_width() {
	if ( is_page_template( 'template-parts/page-full-width.php' ) ) {
		$GLOBALS['content_width'] = apply_filters( 'hovercraft_full_width_page_content_width', 1010 );
	}
}
add_action( 'template_redirect', 'hovercraft_full_width_page_content_width' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function hovercraft_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hovercraft' ),
		'id'            => 'sidebar-1',
		'description'   => 'This is the sidebar next to the content area.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'hovercraft' ),
		'id'            => 'sidebar-2',
		'description'   => 'This is the sidebar in the footer area.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hovercraft_widgets_init' );

if ( ! function_exists( 'hovercraft_fonts_url' ) ) :
/**
 * Register Google fonts for Hovercraft.
 *
 * @since Hovercraft 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function hovercraft_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	$fonts[] = 'Open Sans:300,400,600';

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

function hovercraft_get_featured_posts( $menu_name='slider' ) {
  $locations = get_nav_menu_locations();
  $results = array();

  if ( isset( $locations[ $menu_name ] ) ) {
  	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    $menu_items = wp_get_nav_menu_items( $menu );
    foreach( $menu_items as $slide ) {
      array_push($results, get_post($slide->object_id));
    }
  }

  return $results;
}

function hovercraft_has_featured_posts( $minimum = 1, $menu_name='slider' ) {
  $locations = get_nav_menu_locations();
  if ( isset( $locations[ $menu_name ] ) ) {
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    return count( wp_get_nav_menu_items( $menu ) ) >= $minimum;
  }
  return false;
}

/**
 * Enqueue scripts and styles.
 */
function hovercraft_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'hovercraft-fonts', hovercraft_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	// Load the theme main stylesheet.
	wp_enqueue_style( 'hovercraft-style', get_stylesheet_uri() );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '3.3.1', false );
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv-printshiv.js', array(), '3.7.3', false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Load the theme custom script file.
	wp_enqueue_script( 'hovercraft-script', get_template_directory_uri() . '/js/hovercraft.js', array( 'jquery' ), '20150720', true );

	wp_enqueue_script( 'hovercraft-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hovercraft-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Only load the Flexslider script file on slider pages and when there are more than two featured posts.
	if ( is_page_template( 'template-parts/page-slider.php' ) && hovercraft_has_featured_posts( 2 ) ) {
		wp_enqueue_script( 'hovercraft-slider-script', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'hovercraft_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
