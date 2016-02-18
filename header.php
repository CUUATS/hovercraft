<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Hovercraft
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hovercraft' ); ?></a>

	<div id="hidden-header" class="hidden">
		<nav id="mobile-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Mobile Navigation', 'hovercraft' ); ?>">
			<div class="menu-title"><h1><?php _e( 'Menu', 'hovercraft' ); ?></h1></div>
			<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>
			<div id="mobile-search" class="search-container">
				<?php get_search_form(); ?>
			</div><!-- #mobile-search -->
		</nav><!-- #site-navigation -->

		<div id="desktop-search" class="search-container">
			<?php get_search_form(); ?>
		</div><!-- #desktop-search -->
	</div><!-- #hidden-header -->

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php if ( get_theme_mod( 'hovercraft_logo' ) ) : ?><img class='site-logo' src='<?php echo esc_url( get_theme_mod( 'hovercraft_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'><?php else : ?><span class="site-logo-text"><?php bloginfo( 'name' ); ?></span><?php endif; ?></a></h1>
			<p class="site-description offscreen"><?php bloginfo( 'description' ); ?></p>
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="primary-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Primary Menu', 'hovercraft' ); ?>">
				<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>
			</nav><!-- #primary-navigation -->
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'hovercraft' ); ?></span>
				<span class="lines" aria-hidden="true"></span>
			</button>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
