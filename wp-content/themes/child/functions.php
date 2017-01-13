<?php
// Styles & Scripts
require_once( get_stylesheet_directory() . '/inc/assets.php' );

// Widgets
require_once( get_stylesheet_directory() . '/inc/widgets.php' );

// Register post type
require_once( get_stylesheet_directory() . '/inc/register-post-type.php' );

// Duplicater
require_once( get_stylesheet_directory() . '/inc/duplicate-posts.php' );

// Debug
if ( ! function_exists( 'pr' ) ) {
	function pr( $val ) {
		echo '<pre style="font-size: 16px; color: black;">';
		print_r( $val );
		echo '</pre>';
	}
}
