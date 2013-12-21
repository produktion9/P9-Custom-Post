<?php
/*
Plugin Name: P9-Custom-Post
Plugin URI: https://github.com/produktion9/P9-Custom-Post
Description: Produktion9 Custom Post Type
Version: 1.0
Author: Martin Hansson
Author URI: http://produktion9.se
License: GPL
*/
add_action( 'init', 'register_cpt_p9_custom_post' );

function register_cpt_p9_custom_post() {

  $labels = array( 
    'name' => _x( 'P9 Custom Posts', 'p9-custom-post' ),
    'singular_name' => _x( 'P9 Custom Post', 'p9-custom-post' ),
    'add_new' => _x( 'Lägg till', 'p9-custom-post' ),
    'add_new_item' => _x( 'Lägg till P9 Custom Post', 'p9-custom-post' ),
    'edit_item' => _x( 'Redigera P9 Custom Post', 'p9-custom-post' ),
    'new_item' => _x( 'Ny P9 Custom Post', 'p9-custom-post' ),
    'view_item' => _x( 'Visa P9 Custom Post', 'p9-custom-post' ),
    'search_items' => _x( 'Sök P9 Custom Posts', 'p9-custom-post' ),
    'not_found' => _x( 'Inga P9 custom posts hittade', 'p9-custom-post' ),
    'not_found_in_trash' => _x( 'Inga P9 custom posts hittade i papperskorgen', 'p9-custom-post' ),
    'parent_item_colon' => _x( 'Förälder P9 Custom Post:', 'p9-custom-post' ),
    'menu_name' => _x( 'P9 Custom Posts', 'p9-custom-post' ),
  );

  $args = array( 
    'labels' => $labels,
    'hierarchical' => true,
    'description' => 'Produktion9 Custom Post Type',
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'p9-custom-post', $args );
}
?>