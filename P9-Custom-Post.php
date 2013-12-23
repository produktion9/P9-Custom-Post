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

// Create the content block admin custom post type
add_action( 'init', 'register_cpt_p9_custom_post' );

function register_cpt_p9_custom_post() {

  $labels = array( 
    'name' => _x( 'P9 Custom Posts', 'p9-custom-post' ),
    'singular_name' => _x( 'P9 Custom Post', 'p9-custom-post' ),
    'add_new' => _x( 'Add New', 'p9-custom-post' ),
    'add_new_item' => _x( 'Add New P9 Custom Post', 'p9-custom-post' ),
    'edit_item' => _x( 'Edit P9 Custom Post', 'p9-custom-post' ),
    'new_item' => _x( 'New P9 Custom Post', 'p9-custom-post' ),
    'view_item' => _x( 'View P9 Custom Post', 'p9-custom-post' ),
    'search_items' => _x( 'Search P9 Custom Posts', 'p9-custom-post' ),
    'not_found' => _x( 'No P9 custom posts found', 'p9-custom-post' ),
    'not_found_in_trash' => _x( 'No P9 custom posts found in Trash', 'p9-custom-post' ),
    'parent_item_colon' => _x( 'Parent P9 Custom Post:', 'p9-custom-post' ),
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
} // End the content block admin custom post type

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

	// Widget front-end
	public function widget( $args, $instance ) {
		extract($args);
    $title = empty($instance['title']) ? __('P9 Custom Posts', 'p9_custom_post_widget') : apply_filters('widget_title', $instance['title']);
    //Number of posts to display
    if ( !$number = (int) $instance['number'] )
      $number = 5;
    else if ( $number < 1 )
      $number = 1;
    //Widget settings
    $queryArgs = array(
      'showposts'         		=> $number,
      'post_type'      				=> 'p9-custom-post',
      'post_status'       		=> 'publish',
      'order'             		=> 'DESC'
    );
    //Check if there are posts to display and display them in ul
    $r = new WP_Query($queryArgs);
      if ($r->have_posts()) :
	    	echo $before_widget;
	      echo $before_title . $title . $after_title;
	      ?>
		      <ul>
			      <?php  while ($r->have_posts()) : $r->the_post(); ?>
				      <li>
				      	<?php if ( get_the_post_thumbnail() ) the_post_thumbnail(); else "" ?>
				      	<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(array('before'=>'Permalink to: ')); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></h3>
				      	<p>
				      	<?php if ( get_the_excerpt() ) the_excerpt(); else ""; ?>
				      	</p>
				      </li>
			      <?php endwhile; ?>
		      </ul>
	      <?php
	      echo $after_widget;
      endif; // End have posts
    wp_reset_query();  // Restore global post data stomped by the_post().
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$title = esc_attr($instance['title']);
    if ( !$number = (int) $instance['number'] )
      $number = 5;
  		?>
	      <p><label for="<?php echo $this->get_field_id('title'); ?>">
	      <?php _e('Title:'); ?>
	      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

	      <p><label for="<?php echo $this->get_field_id('number'); ?>">
	      <?php _e('Number of posts to show:'); ?>
	      <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label>
			<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];

    return $instance;
	}
}// Class p9_custom_post_widget ends here

// Register and load the widget
function p9_custom_post_load_widget() {
	register_widget( 'p9_custom_post_widget' );
}
add_action( 'widgets_init', 'p9_custom_post_load_widget' );

//Set excerpt length
add_filter('excerpt_length', 'my_excerpt_length');
	function my_excerpt_length($length) {
		return 20; 
}
?>
