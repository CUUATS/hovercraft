<?php
/**
 * The navigation menu.
 *
 * Displays both the mobile and desktop navigation menu.
 *
 * @package Hovercraft
 */

wp_nav_menu( 
	array( 
		'theme_location'	=> 'primary',
		'menu_id' 			=> 'primary-menu',
		'container_class'	=> 'menu-container',
		'depth'				=> 3,
		'fallback_cb' 		=> false,
	) 
);
