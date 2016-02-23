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
       $img = $post["feat_image_url"]
       ?>

            <li>
              <img src="<?php echo $img?>" alt="post-number-".<?php $post["id"]?>>
            </li>

        <?php endforeach; ?>


  </ul><!--end slides list -->
</div><!-- end flexslider div -->



<?php get_footer(); ?>
