<?php

// Enqueue Flexslider Files
    function wptuts_slider_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'flex-script', get_template_directory_uri() .  '/js/jquery.flexslider-min.js', array( 'jquery' ), false, true );
    }
    add_action( 'wp_enqueue_scripts', 'wptuts_slider_scripts' );

    // Initialize Slider

?>
  <?php  function wptuts_slider_initialize() { ?>
        <script type="text/javascript" charset="utf-8">
            jQuery(window).load(function() {
                jQuery('.flexslider').flexslider({
                    animation: "fade",
                    direction: "horizontal",
                    slideshowSpeed: 1000,
                    animationSpeed: 600
                });
            });
        </script>
    <?php }
    add_action( 'wp_head', 'wptuts_slider_initialize' );
?>
<?php
function wptuts_slider_template(){
  //get all of the meta data from the list items

  $menu_name = 'slider';
  //get all of the menus
  $locations = get_nav_menu_locations();

  //Check to see if the menu in the location is empty
  if ( isset( $locations[ $menu_name ] ) ) {
    //get the actual menu object by the same name
  	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
    //get the menu items
    $menu_items = wp_get_nav_menu_items($menu);

    //create an empty array object that will eventuall hold all the information for each indiviual slide
    $slides = array();

    //loop through each item in the menu slider
    foreach($menu_items as $slide){

      //grab the information for that slide
      $post = get_post($slide->object_id);

      //get the slide id
      $id= $post->ID;

      //create an associative array that holds some metadata for this particular slide
      $slide_object = array(
        "title" =>$post->post_title,
        "excerpt" =>$post ->post_excerpt,
        "content" =>$post ->post_content,
        "id"=> $id,
        "post_url" =>get_permalink($id),
        "feat_image_url" =>wp_get_attachment_url(get_post_thumbnail_id($id))

      );
      //append slides array
      array_push($slides,$slide_object);
    }
}
return $slides;
}
?>
