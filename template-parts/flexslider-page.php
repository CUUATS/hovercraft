<?php
/**
 * Template Name: Flexslider Page
 *
 * @package Hovercraft
 */



get_header(); ?>

<?php   $slide_posts = wptuts_slider_template();
//var_dump($slide_posts);
 //intialize slider

 ?>

 <div class="flexslider">
  <ul class="slides">
    <?php foreach ( $slide_posts as $post ) :?>
      <?php
      //get the metadata from your posts
       $img = $post["feat_image_url"];
       $post_link = $post["post_url"];
       $image_link = $post["feat_image_link"];
       $title = $post["title"];
       $post_id = $post["id"];
       ?>

            <li>
              <?php //the_title( '<div class="slider-header"><h2 class="slider-title"><a href="' . esc_url( get_permalink($post_id) ) . '" rel="bookmark">', '</a></h2></div>' ); ?>
              <div class="slider-excerpt"><?php echo the_excerpt(); ?></div>
               <img src="<?php echo $img?>" alt="post-number-<?php $post_id?>">

            </li>


        <?php endforeach; ?>


  </ul><!--end slides list -->
</div><!-- end flexslider div -->



<?php get_footer(); ?>
