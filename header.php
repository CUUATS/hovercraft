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
	<header id="masthead" class="site-header" role="banner">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hovercraft' ); ?></a>
		<div class="site-branding">
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php if ( get_theme_mod( 'hovercraft_logo' ) ) : ?><img class="site-logo" src="<?php echo esc_url( get_theme_mod( 'hovercraft_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php else : ?><span class="site-logo-text"><?php bloginfo( 'name' ); ?></span><?php endif; ?></a></p>
		</div><!-- .site-branding -->
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'hovercraft' ); ?></span>
			<span class="lines" aria-hidden="true"></span>
		</button>
		<div id="masthead-menu">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav id="primary-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Primary Menu', 'hovercraft' ); ?>">
					<h2 class="menu-title"><?php _e( 'Menu', 'hovercraft' ); ?></h2>
					<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>
				</nav><!-- #primary-navigation -->
			<?php endif; ?>
			<?php get_search_form(); ?>
		</div>
	</header><!-- #masthead -->
	<?php if ( hovercraft_post_has_featured_image() && is_singular() ) : ?><div id="banner-image"></div><?php endif; ?>
	<div id="content" class="site-content">
