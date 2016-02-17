<?php
function my_custom_posttypes() {

    $labels = array(
        'name'               => 'Slides',
        'singular_name'      => 'Slide',
        'menu_name'          => 'Slides',
        'name_admin_bar'     => 'Slides',
        'add_new'            => 'Add New Slide',
        'add_new_item'       => 'Add New Slide',
        'new_item'           => 'New Slide',
        'edit_item'          => 'Edit Slide',
        'view_item'          => 'View Slide',
        'all_items'          => 'All Slide',
        'search_items'       => 'Search Slide',
        'not_found'          => 'No slides found.',
        'not_found_in_trash' => 'No slides found in Trash.',
    );
    $supports = array('title','editor','thumbnail');

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-id-alt',
        'query_var'          => true,
        'rewrite'           => array( 'slug' => 'slides', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'          => $supports,
        'menu_position'      => 5,

    );
    register_post_type( 'Slides', $args );
}
add_action( 'init', 'my_custom_posttypes' );

// Flush rewrite rules to add "review" as a permalink slug
function my_rewrite_flush() {
    my_custom_posttypes();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );


?>
