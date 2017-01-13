<?php
// Styles & Scripts for frontend
function wpm_init_assets() {

	// Register assets
	wp_register_style( 'vendor-styles', get_template_directory_uri() . '/static/css/vendors.min.css' );
	wp_register_style( 'main-styles', get_template_directory_uri() . '/static/css/main.min.css' );

	wp_enqueue_style( 'vendor-styles' );
	wp_enqueue_style( 'main-styles' );

	wp_register_script( 'vendor-scripts', get_template_directory_uri() . '/static/js/vendors.min.js' );
	wp_register_script( 'main-scripts', get_template_directory_uri() . '/static/js/main.min.js', array( 'jquery' ) );

	wp_enqueue_script( 'vendor-scripts' );
	wp_enqueue_script( 'main-scripts' );
	wp_enqueue_script( 'jquery' );

	$ajax = array(
		'url' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script( 'jquery', 'wpm_ajax', $ajax );

}
add_action( 'wp_enqueue_scripts', 'wpm_init_assets', 20 );

// Styles & Scripts for admin
function wpm_add_scripts_admin() {
	// Register assets
	wp_register_style( 'admin-styles', get_template_directory_uri() . '/static/css/admin.css' );

	wp_enqueue_style( 'admin-styles' );
}

add_action( 'admin_init', 'wpm_add_scripts_admin' );