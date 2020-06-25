<?php
// Styles & Scripts for frontend
function rh_init_assets() {

	// Register assets
	wp_enqueue_style( 'reset-styles', get_template_directory_uri() . '/css/reset.css');
	wp_enqueue_style( 'fa', get_template_directory_uri() . '/fonts/fontawesome-pro-5.8.2-web/css/all.css' );
	wp_enqueue_style( 'vc-styles', get_template_directory_uri() . '/css/vc-responsive.css');
	wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/css/responsive.css');

	wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery' );

	$ajax = array(
		'url' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script( 'jquery', 'rh_ajax', $ajax );

}
add_action( 'wp_enqueue_scripts', 'rh_init_assets', 20 );

// Styles & Scripts for admin
function rh_add_scripts_admin() {
	// Register assets
    wp_enqueue_style( 'fa', get_template_directory_uri() . '/fonts/fontawesome-pro-5.8.2-web/css/all.css' );
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/admin.css' );
}

add_action( 'admin_init', 'rh_add_scripts_admin' );
