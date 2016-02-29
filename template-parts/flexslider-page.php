<?php
/**
 * Template Name: Flexslider Page
 *
 * @package Hovercraft
 */

get_header(); ?>

<?php
//create slider
$slide_posts = wptuts_slider_template();

//Start the slider
 ?>
 <div class="flexslider">
  <ul class="slides">
    <?php foreach ( $slide_posts as $post ) :?>
      <?php
      //get the metadata from your posts
       $img = $post["feat_image_url"];
       $post_link = $post["post_url"];
       $title = $post["title"];
       ?>
       <li class="featured" >
           <div class="slider-container">
             <img src="<?php echo $img?>" alt="<?php $title?>">
             <div class ="featured-info">
               <a class="slider-link" href="<?php echo $post_link ?>" rel="bookmark"> <h2 class="slider-title"><?php echo $title; ?> </h2></a>
               <p class="slider-excerpt"><?php echo $post["excerpt"]; ?> </p>
             </div>

             </div>

         </li>


        <?php endforeach; ?>


  </ul><!--end slides list -->
</div><!-- end flexslider div -->



<?php get_footer(); ?>
