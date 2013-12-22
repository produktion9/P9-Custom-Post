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

// Create admin custom post type
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
// Creating the widget 
class p9_custom_post_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'p9_custom_post_widget', 

// Widget name will appear in UI
__('P9 Custom Posts', 'p9_custom_post_widget_domain'), 

// Widget description
array( 'description' => __( 'Produktion9 Custom Post Type', 'p9_custom_post_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo __( 'Hello, World!', 'p9_custom_post_widget_domain' );
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'p9_custom_post_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class p9_custom_post_widget ends here

// Register and load the widget
function p9_custom_post_load_widget() {
	register_widget( 'p9_custom_post_widget' );
}
add_action( 'widgets_init', 'p9_custom_post_load_widget' );
?>
