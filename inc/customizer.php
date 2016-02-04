<?php
/**
 * Hovercraft Theme Customizer
 *
 * @package Hovercraft
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hovercraft_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Remove existing not used sections. */
	//$wp_customize->remove_section('colors');

	/* Font color. */
	$wp_customize->add_setting('hovercraft_text_color', array(
		'default'			=> '#ffffff',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_color', array(
		'label'				=> __('Text Color', 'hovercraft'),
		'section'			=> 'colors',
		'priority'			=> 20,
		'settings'			=> 'hovercraft_text_color',
	)));

	/* Link color. */
	$wp_customize->add_setting('hovercraft_link_color', array(
		'default'			=> '#ff8b27',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label'				=> __('Link Color', 'hovercraft'),
		'section'			=> 'colors',
		'priority'			=> 30,
		'settings'			=> 'hovercraft_link_color',
	)));

	/* Content background color. */
	$wp_customize->add_setting('hovercraft_content_background_color', array(
		'default'			=> '#000000',
		'sanitize_callback'	=> 'hovercraft_hex2rgba',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'content_background_color', array(
		'label'				=> __('Content Background Color', 'hovercraft'),
		'section'			=> 'colors',
		'priority'			=> 40,
		'settings'			=> 'hovercraft_content_background_color',
	)));

	/* Theme options panel */
	$wp_customize->add_panel( 'hovercraft_theme_options', array(
		'priority'       => 900,
		'title'          => __( 'Theme Options', 'hovercraft' ),
		'description'    => 'This theme supports a number of options which you can set using this panel.',
	) );
	/*Theme logo options*/
	$wp_customize -> add_section('aperture_logo_section', array(
	'title'       => __( 'Logo', 'aperture' ),
	'panel'  => 'aperture_theme_options',
    	'priority'    => 30,
    	'description' => 'Upload a logo for the header. Max height: 56px',
	) );
	
	$wp_customize->add_setting( 'aperture_logo' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
    	'label'    => __( 'Logo', 'aperture' ),
    	'section'  => 'aperture_logo_section',
    	'settings' => 'aperture_logo',
	) ) );
	

	/* Theme options slider section */
	$wp_customize->add_section( 'hovercraft_slider_options', array(
		'title'    => __( 'Slider Options', 'hovercraft' ),
		'priority' => 10,
		'panel'  => 'hovercraft_theme_options',
		'description'    => 'To customize the appearance of the fullscreen slider choose any of the options below.',
	) );

	/* Theme options sidebar section */
	$wp_customize->add_section( 'hovercraft_sidebar_options', array(
		'title'    => __( 'Sidebar Options', 'hovercraft' ),
		'priority' => 20,
		'panel'  => 'hovercraft_theme_options',
		'description'    => 'Select whether the sidebar should be displayed at the right or left side of the content.',
	) );

	/* Theme options footer section */
	$wp_customize->add_section( 'hovercraft_footer_options', array(
		'title'    => __( 'Footer Options', 'hovercraft' ),
		'priority' => 30,
		'panel'  => 'hovercraft_theme_options',
		'description'    => 'Add some custom text to the bottom right of the footer area.',
	) );

	/* Slider animation. */
	$wp_customize->add_setting( 'hovercraft_slider_animation', array(
		'default'           => 'slide',
		'sanitize_callback' => 'hovercraft_sanitize_slider_animation',
	) );
	$wp_customize->add_control( 'hovercraft_slider_animation', array(
		'label'             => __( 'Animation: ', 'hovercraft' ),
		'section'           => 'hovercraft_slider_options',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'slide'			=> __( 'Slide', 'hovercraft' ),
			'fade'			=> __( 'Fade', 'hovercraft' ),
		),
	) );

	/* Slider direction. */
	$wp_customize->add_setting( 'hovercraft_slider_direction', array(
		'default'           => 'horizontal',
		'sanitize_callback' => 'hovercraft_sanitize_slider_direction',
	) );
	$wp_customize->add_control( 'hovercraft_slider_direction', array(
		'label'             => __( '(Slide) Direction: ', 'hovercraft' ),
		'section'           => 'hovercraft_slider_options',
		'priority'          => 2,
		'type'              => 'radio',
		'choices'           => array(
			'horizontal'	=> __( 'Horizontal', 'hovercraft' ),
			'vertical'		=> __( 'Vertical', 'hovercraft' ),
		),
	) );

	/* Slider slideshow. */
	$wp_customize->add_setting( 'hovercraft_slider_slideshow', array(
		'default'           => 'horizontal',
		'sanitize_callback' => 'hovercraft_sanitize_slider_slideshow',
	) );
	$wp_customize->add_control( 'hovercraft_slider_slideshow', array(
		'label'             => __( 'Slideshow: ', 'hovercraft' ),
		'section'           => 'hovercraft_slider_options',
		'priority'          => 3,
		'type'              => 'radio',
		'choices'           => array(
			'true'			=> __( 'True', 'hovercraft' ),
			'false'			=> __( 'False', 'hovercraft' ),
		),
	) );

	/* Slider slideshow speed. */
	$wp_customize->add_setting( 'hovercraft_slider_speed', array(
		'default'           => 'horizontal',
		'sanitize_callback' => 'hovercraft_sanitize_slider_speed',
	) );
	$wp_customize->add_control( 'hovercraft_slider_speed', array(
		'label'             => __( 'Speed: ', 'hovercraft' ),
		'section'           => 'hovercraft_slider_options',
		'priority'          => 4,
		'type'              => 'radio',
		'choices'           => array(
			'20000'			=> __( 'Slowest', 'hovercraft' ),
			'14000'			=> __( 'Slower', 'hovercraft' ),
			'10000'			=> __( 'Slow', 'hovercraft' ),
			'7000'			=> __( 'Default', 'hovercraft' ),
			'5000'			=> __( 'Fast', 'hovercraft' ),
			'3500'			=> __( 'Faster', 'hovercraft' ),
			'2500'			=> __( 'Fastest', 'hovercraft' ),
		),
	) );

	/* Left sidebar or right sidebar */
	$wp_customize->add_setting( 'hovercraft_sidebar', array(
		'default'           => 'right-sidebar',
		'sanitize_callback' => 'hovercraft_sanitize_sidebar',
	) );
	$wp_customize->add_control( 'hovercraft_sidebar', array(
		'label'             => __( 'Sidebar: ', 'hovercraft' ),
		'section'           => 'hovercraft_sidebar_options',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'right-sidebar'	=> __( 'Right sidebar', 'hovercraft' ),
			'left-sidebar'	=> __( 'Left sidebar', 'hovercraft' ),
		),
	) );

	/* Footer custom text */
	$wp_customize->add_setting( 'hovercraft_footer_text', array(
		'default'			=> 'Some custom text here!',
		'sanitize_callback' => 'hovercraft_sanitize_footer_text',
	) );

	$wp_customize->add_control( 'hovercraft_footer_text', array(
		'label'   			=> 'Custom Footer Text: ',
		'section' 			=> 'hovercraft_footer_options',
		'type'    			=> 'text',
	) );
}
add_action( 'customize_register', 'hovercraft_customize_register' );

/**
 * Sanitize and convert hex to rgba..
 *
 * @param string $color.
 * @return string.
 */
function hovercraft_hex2rgba( $color ) {
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

		$color = "rgba({$r}, {$g}, {$b}, 0.75)";

		return $color;
	}

	else {
		return '';
	}
}

/**
 * Sanitize slider animation.
 *
 * @param string $input.
 * @return string (slide|fade).
 */
function hovercraft_sanitize_slider_animation( $input ) {
	if ( ! in_array( $input, array( 'slide', 'fade' ) ) ) {
		$input = 'slide';
	}
	return $input;
}

/**
 * Sanitize slider direction.
 *
 * @param string $input.
 * @return string (horizontal|vertical).
 */
function hovercraft_sanitize_slider_direction( $input ) {
	if ( ! in_array( $input, array( 'horizontal', 'vertical' ) ) ) {
		$input = 'horizontal';
	}
	return $input;
}

/**
 * Sanitize slider slideshow.
 *
 * @param string $input.
 * @return string (true|false).
 */
function hovercraft_sanitize_slider_slideshow( $input ) {
	if ( ! in_array( $input, array( 'true', 'false' ) ) ) {
		$input = 'true';
	}
	return $input;
}

/**
 * Sanitize slider slideshow speed.
 *
 * @param string $input.
 * @return string (2500|3500|5000|7000|10000|14000|20000).
 */
function hovercraft_sanitize_slider_speed( $input ) {
	if ( ! in_array( $input, array( '2500', '3500', '5000', '7000', '10000', '14000', '20000' ) ) ) {
		$input = '7000';
	}
	return $input;
}

/**
 * Sanitize sidebar selection.
 *
 * @param string $input.
 * @return string (left-sidebar|right-sidebar).
 */
function hovercraft_sanitize_sidebar( $input ) {
	if ( ! in_array( $input, array( 'left-sidebar', 'right-sidebar' ) ) ) {
		$input = 'right-sidebar';
	}
	return $input;
}

/**
 * Sanitize footer text.
 *
 * @param string $text.
 * @return string.
 */
function hovercraft_sanitize_footer_text( $text ) {
	if ( empty( $text ) ) {
		$text = 'Some custom text here!';
	}
	wp_filter_post_kses( $text );

	return $text;
}

/**
 * Add inline styles for the custom colors.
 *
 * @see wp_add_inline_style()
 */
function hovercraft_custom_colors() {
	$css 				= '';
	$text_color 		= get_theme_mod( 'hovercraft_text_color', '#ffffff' );
	$link_color 		= get_theme_mod( 'hovercraft_link_color', '#ff8b27' );
	$background_color 	= get_theme_mod( 'hovercraft_content_background_color', '#000000' );

	if ( ! empty( $text_color ) && '#ffffff' !== $text_color ) {

		$css .= '
			body, button, input, select, textarea { color: ' . $text_color . '; }
			a, a:visited, .main-navigation a { color: ' . $text_color . '; }
			h1.site-title a, h1.site-title a:hover { color: ' . $text_color . '; }
			.widget, .widget .widget-title { color: ' . $text_color . '; }
			.social-menu-container ul.menu li.menu-item a::before { color: ' . $text_color . '; }
			.search-toggle, .back-to-top span { color: ' . $text_color . '; }
			button, input[type="button"], input[type="reset"], input[type="submit"] { color: ' . $text_color . '; border-color: ' . $text_color . '; }
			#primary-navigation li.menu-item a:hover, #primary-navigation li.menu-item a:focus, #secondary-navigation li.menu-item a:hover, #secondary-navigation li.menu-item a:focus { color: ' . $text_color . '; }
		';
	}

	if ( ! empty( $link_color ) && '#ff8b27' !== $link_color ) {

		$css .= '
			#primary-navigation li.menu-item a:hover,
			#primary-navigation li.menu-item a:focus,
			#secondary-navigation li.menu-item a:hover,
			#secondary-navigation li.menu-item a:focus,
			#primary-navigation ul.sub-menu li.menu-item a:hover,
			#primary-navigation ul.sub-menu li.menu-item a:focus,
			#secondary-navigation ul.sub-menu li.menu-item a:hover,
			#secondary-navigation ul.sub-menu li.menu-item a:focus { border-bottom-color: ' . $link_color . '; }
			.widget li::before,
			a:hover, a:focus, a:active,
			.search-form .search-submit:hover,
			#desktop-search .search-form .search-submit:hover,
			.social-menu-container ul.menu li.menu-item a:hover::before { color: ' . $link_color . '; }
			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			button:active, button:focus,
			input[type="button"]:active,
			input[type="button"]:focus,
			input[type="reset"]:active,
			input[type="reset"]:focus,
			input[type="submit"]:active,
			input[type="submit"]:focus { color: ' . $link_color . '; border-color: ' . $link_color . '; }
			blockquote { border-left-color: ' . $link_color . '; }
		';
	}

	if ( ! empty( $background_color ) && 'rgba(0, 0, 0, 0.75)' !== $background_color ) {

		$css .= '
			#masthead, #colophon, #main, #secondary .widget, .back-to-top { background: ' . $background_color . '; }
		';
	}

	wp_add_inline_style( 'hovercraft-style', $css );
}
add_action( 'wp_enqueue_scripts', 'hovercraft_custom_colors' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hovercraft_customize_preview_js() {
	wp_enqueue_script( 'hovercraft_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'hovercraft_customize_preview_js' );
