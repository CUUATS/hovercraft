<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Hovercraft
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container">

			<?php get_sidebar( 'bottom' ); ?>

			<div class="site-info">

				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav id="bottom-social" class="social-links">
						<?php get_template_part( 'template-parts/navigation-social' ); ?>
					</nav><!-- #social-links -->
				<?php endif; ?>

				<div class="credits">
					<span class="credits-top"><?php echo __( 'Powered by ', 'hovercraft' ) ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'hovercraft' ) ); ?>" rel="generator">WordPress</a></span>
					<span class="sep"> | </span>
					<span class="credits-bottom"><?php printf( __( 'The %1$s theme by %2$s', 'hovercraft' ), '<a href="http://cuuats.org/" rel="theme">Hovercraft</a>', '<a href="http://cuuats.org/" rel="designer">CUUATS</a>' ); ?></span>
				</div><!-- .credits -->
			</div><!-- .site-info -->

		</div><!-- .container -->

		<a href="#content" class="back-to-top"><span class="genericon genericon-top"></span></a>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
