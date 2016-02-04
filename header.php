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
			<?php if ( has_nav_menu( 'secondary' ) ) { get_template_part( 'template-parts/navigation-secondary' ); } ?>

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
			<?php if ( get_theme_mod( 'hovercarft_logo' ) ) : ?>
				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img class='site-logo' style="margin-right:0.5em;" src='<?php echo esc_url( get_theme_mod( 'hovercraft_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="primary-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Primary Menu', 'hovercraft' ); ?>">
				<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>
			</nav><!-- #primary-navigation -->
		<?php endif; ?>

		<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) ) : ?>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'hovercraft' ); ?></span>
				<span class="lines" aria-hidden="true"></span>
			</button>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) || has_nav_menu( 'secondary' ) ) : ?>
			<div class="right-container">
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav id="top-social" class="social-links" aria-label="<?php _e( 'Social Links', 'hovercraft' ); ?>">
						<?php get_template_part( 'template-parts/navigation-social' ); ?>
						<span class="sep"> | </span>
						<button class="search-toggle">
							<span class="screen-reader-text"><?php _e('Search Toggle', 'hovercraft'); ?></span>
							<span class="genericon genericon-search" aria-hidden="true"></span>
						</button>
						<?php if ( has_nav_menu( 'social' ) && has_nav_menu( 'secondary' ) ) : ?>
							<span class="sep"> | </span>
						<?php endif; ?>
					</nav><!-- #social-links -->
				<?php endif; ?>

				<?php if ( has_nav_menu( 'secondary' ) ) : ?>
					<nav id="secondary-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Secondary Menu', 'hovercraft' ); ?>">
						<?php if ( has_nav_menu( 'secondary' ) ) { get_template_part( 'template-parts/navigation-secondary' ); } ?>
					</nav><!-- #secondary-navigation -->
				<?php endif; ?>
			</div><!--.right-container -->
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
