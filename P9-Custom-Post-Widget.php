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

// Widget
class P9_custom_post_widget extends WP_Widget {

	public function __construct() {
		// widget actual processes
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget
	}

 	public function form( $instance ) {
		// outputs the options form on admin
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}
?>
