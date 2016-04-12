<?php
/**
 * Template Name: Fullscreen Slider
 *
 * @package Hovercraft
 */

$featured = hovercraft_get_featured_posts();
$animation = get_theme_mod( 'hovercraft_slider_animation', 'slide' );

get_header(); ?>

	<?php if ( count( $featured ) >= 1 ) : ?>

		<div id="featured-content" class="flexslider multiple-featured-posts" role="main">
			<ul class="featured-posts slides">

				<?php
				foreach ( $featured as $post ) :
					setup_postdata( $post );

					if ( has_post_thumbnail() ) : ?>

							<li class="featured" id="slide-<?php echo $post->ID; ?>">
								<div class="featured-hentry-wrap <?php echo esc_attr( $animation ); ?>-animation">
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<?php the_title( '<div class="slider-header"><h2 class="slider-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></div>' ); ?>
										<div class="slider-excerpt"><?php the_excerpt(); ?></div>
										<div class="slider-link"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'hovercraft' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">Read more &#8594;</a></div>
									</div><!-- #post-## -->
								</div><!-- .featured-hentry-wrap -->
							</li>
				<?php
					endif;
				endforeach;
				wp_reset_postdata();
				?>
			</ul><!-- .featured-posts -->
		</div><!-- #featured-content -->
		<script type="text/javascript">
			(function($) {
				<?php if ( count( $featured ) >= 2 ) : ?>
					$('.flexslider').flexslider({
						animation: '<?php echo get_theme_mod( 'hovercraft_slider_animation', 'fade' ); ?>',
						slideshow: <?php echo get_theme_mod( 'hovercraft_slider_slideshow', 'true' ); ?>,
						slideshowSpeed: <?php echo (int)get_theme_mod( 'hovercraft_slider_delay', 10 ) * 1000; ?>,
						controlNav: false
					});
				<?php else : ?>
					$('.flexslider li').show();
				<?php endif; ?>
			})(jQuery);
		</script>
	<?php else : ?>

	<div id="no-featured-content" class="no-featured-post" role="main">
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	</div><!-- #no-featured-content -->

	<?php endif; ?>

<?php get_footer(); ?>
