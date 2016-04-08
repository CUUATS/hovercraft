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

	/* Colors */
	$wp_customize->add_panel('hovercraft_colors', array(
		'title' => __('Colors', 'hovercraft'),
		'description' => 'Customize text, link, and background colors.',
		'priority' => 100,
	));

	$color_sections = array(
		array('header_colors', 'Header Colors', array(
			array('header_background_color', 'Header Background', '#eeeeee'),
			array('header_text_color', 'Header Text', '#000000'),
			array('header_link_color', 'Header Link', '#00554e')
		)),
		array('content_colors', 'Content Colors', array(
			array('content_background_color', 'Content Background', '#ffffff'),
			array('content_text_color', 'Content Text', '#000000'),
			array('content_link_color', 'Content Link', '#00554e')
		)),
		array('sidebar_colors', 'Sidebar Colors', array(
			array('sidebar_background_color', 'Sidebar Background', '#ffffff'),
			array('sidebar_text_color', 'Sidebar Text', '#000000'),
			array('sidebar_link_color', 'Sidebar Link', '#00554e')
		)),
		array('footer_colors', 'Footer Colors', array(
			array('footer_background_color', 'Footer Background', '#444444'),
			array('footer_text_color', 'Footer Text', '#ffffff'),
			array('footer_link_color', 'Footer Link', '#a1fff6')
		))
	);

	foreach($color_sections as $color_section) {
		$section_id = 'hovercraft_' . $color_section[0];
		$section_name = $color_section[1];
		$section_settings = $color_section[2];

		$wp_customize->add_section($section_id, array(
			'title' => __($section_name, 'hovercraft' ),
			'panel'  => 'hovercraft_colors',
		));

		foreach($section_settings as $color_setting) {
			$widget_id = $color_setting[0];
			$setting_id = 'hovercraft_' . $color_setting[0];
			$setting_name = $color_setting[1];
			$setting_default = $color_setting[2];

			$wp_customize->add_setting($setting_id, array(
				'default' => $setting_default,
				'sanitize_callback'	=> 'sanitize_hex_color',
			));

			$wp_customize->add_control(new WP_Customize_Color_Control(
				$wp_customize, $widget_id, array(
					'label' => __($setting_name, 'hovercraft'),
					'section' => $section_id,
					'settings' => $setting_id,
			)));
		}
	}

	/* Theme logo */
	$wp_customize->add_setting( 'hovercraft_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hovercraft_logo', array(
    	'label'    => __( 'Logo', 'hovercraft' ),
    	'section'  => 'title_tagline',
    	'settings' => 'hovercraft_logo',
			'description' => 'Upload a logo for the header with a maximum height of 75px.',
	) ) );

	/* Theme options slider section */
	$wp_customize->add_section( 'hovercraft_slider_options', array(
		'title' => __( 'Slider', 'hovercraft' ),
		'priority' => 900,
		'description' => 'To customize the appearance of the fullscreen slider choose any of the options below.',
	) );

	/* Theme options sidebar section */
	$wp_customize->add_section('hovercraft_sidebar_options', array(
		'title'    => __( 'Sidebar', 'hovercraft' ),
		'priority' => 150,
		'description' => 'Select whether the sidebar should be displayed at the right or left side of the content.',
	) );

	/* Slider animation. */
	$wp_customize->add_setting( 'hovercraft_slider_animation', array(
		'default'           => 'fade',
		'sanitize_callback' => 'hovercraft_sanitize_slider_animation',
	) );
	$wp_customize->add_control( 'hovercraft_slider_animation', array(
		'label'             => __( 'Animation Type', 'hovercraft' ),
		'section'           => 'hovercraft_slider_options',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'fade'			=> __( 'Fade', 'hovercraft' ),
			'slide'			=> __( 'Slide', 'hovercraft' ),
		),
	) );

	/* Slider slideshow. */
	$wp_customize->add_setting( 'hovercraft_slider_slideshow', array(
		'default'           => 'true',
		'sanitize_callback' => 'hovercraft_sanitize_slider_slideshow',
	) );
	$wp_customize->add_control( 'hovercraft_slider_slideshow', array(
		'label'             => __( 'Advance Automatically', 'hovercraft' ),
		'section'           => 'hovercraft_slider_options',
		'priority'          => 2,
		'type'              => 'radio',
		'choices'           => array(
			'true'			=> __( 'True', 'hovercraft' ),
			'false'			=> __( 'False', 'hovercraft' ),
		),
	) );

	/* Slider slideshow speed. */
	$wp_customize->add_setting( 'hovercraft_slider_delay', array(
		'default'           => 10,
		'sanitize_callback' => 'hovercraft_sanitize_slider_delay',
	) );
	$wp_customize->add_control( 'hovercraft_slider_delay', array(
		'label'             => __( 'Delay', 'hovercraft' ),
		'description'             => __( 'Enter the number of seconds per slide.', 'hovercraft' ),
		'section'           => 'hovercraft_slider_options',
		'priority'          => 3,
		'type'              => 'number',
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

	/* Remove the tagline control. */
	$wp_customize->remove_control( 'blogdescription' );

}
add_action( 'customize_register', 'hovercraft_customize_register' );

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
function hovercraft_sanitize_slider_delay( $input ) {
	$input = (int) $input;
	if ( $input > 0 ) {
		return $input;
	}
	return 10;
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
 * Add inline styles for the custom colors.
 *
 * @see wp_add_inline_style()
 */
function hovercraft_custom_colors() {
	$qs_data = array(
		'hb' => get_theme_mod('hovercraft_header_background_color', '#eeeeee'),
		'ht' => get_theme_mod('hovercraft_header_text_color', '#000000'),
		'hl' => get_theme_mod('hovercraft_header_link_color', '#00554e'),
		'cb' => get_theme_mod('hovercraft_content_background_color', '#ffffff'),
		'ct' => get_theme_mod('hovercraft_content_text_color', '#000000'),
		'cl' => get_theme_mod('hovercraft_content_link_color', '#00554e'),
		'sb' => get_theme_mod('hovercraft_sidebar_background_color', '#ffffff'),
		'st' => get_theme_mod('hovercraft_sidebar_text_color', '#000000'),
		'sl' => get_theme_mod('hovercraft_sidebar_link_color', '#00554e'),
		'fb' => get_theme_mod('hovercraft_footer_background_color', '#444444'),
		'ft' => get_theme_mod('hovercraft_footer_text_color', '#ffffff'),
		'fl' => get_theme_mod('hovercraft_footer_link_color', '#a1fff6'),
		'cachekey' => '1',
	);
	$css_url = get_template_directory_uri() . '/inc/theme-colors.php?' . http_build_query($qs_data);
	wp_enqueue_style( 'hovercraft_theme_colors', $css_url, array(), null, 'all' );
}
add_action('wp_enqueue_scripts', 'hovercraft_custom_colors');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hovercraft_customize_preview_js() {
	wp_enqueue_script( 'hovercraft_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'hovercraft_customize_preview_js' );
