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
					<nav id="bottom-social" class="social-links" aria-label="<?php _e( 'Social Media', 'hovercraft' ); ?>">
						<?php get_template_part( 'template-parts/navigation-social' ); ?>
					</nav><!-- #social-links -->
				<?php endif; ?>

				<div class="accessibility-info">
					<span class="site-info-section"><strong>Accessibility:</strong></span>
          <span class="site-info-section"><a href="http://www1.co.champaign.il.us/ada/Home.php">ADA contacts</a></span>
					<span class="sep"> | </span>
          <span class="site-info-section"><a href="http://www1.co.champaign.il.us/ada/Feedback.php">Request information and provide feedback</a></span>
				</div>

				<div class="credits">
					<span class="site-info-section"><?php echo __( 'Site by ', 'hovercraft' ) ?><a href="http://cuuats.org/">CUUATS</a></span>
					<span class="sep"> | </span>
					<span class="site-info-section"><?php echo __( 'Powered by ', 'hovercraft' ) ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'hovercraft' ) ); ?>" rel="generator">WordPress</a></span>
				</div><!-- .credits -->
			</div><!-- .site-info -->

		</div><!-- .container -->

		<a href="#content" class="back-to-top"><span class="genericon genericon-top"></span></a>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
