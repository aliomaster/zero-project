<?php
/*
* Register custom post types
*/

function register_provider_post_type() {
	$labels = array(
		'name' => __( 'Providers', 'wordpress' ),
		'singular_name' => __( 'Provider', 'wordpress' ),
		'add_new' => __( 'Add New', 'wordpress' ),
		'add_new_item' => __( 'Add New Provider', 'wordpress' ),
		'edit_item' => __( 'Edit Provider', 'wordpress' ),
		'new_item' => __( 'New Provider', 'wordpress' ),
		'all_items' => __( 'All Providers', 'wordpress' ),
		'view_item' => __( 'View Provider', 'wordpress' ),
		'search_items' => __( 'Search Providers', 'wordpress' ),
		'not_found' => __( 'No providers found', 'wordpress' ),
		'not_found_in_trash' => __( 'No providers found in Trash', 'wordpress' ),
		'menu_name' => __( 'Providers', 'wordpress' )
		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies' => array('providerscategory')
		);
	register_post_type( 'providers', $args );
}
add_action('init', 'register_provider_post_type');

/* register taxonomy Category for providers */
add_action( 'init', 'alio_providers_taxonomy' );

function alio_providers_taxonomy() {
	$labels = array(
		'name'              => 'Weeks',
		'singular_name'     => 'Week',
		'search_items'      => 'Search Weeks',
		'all_items'         => 'All Weeks',
		'parent_item'       => 'Parent Week',
		'parent_item_colon' => 'Parent Week:',
		'edit_item'         => 'Edit Week',
		'update_item'       => 'Update Week',
		'add_new_item'      => 'Add New Week',
		'new_item_name'     => 'New Week Name',
		'menu_name'         => 'Week',
	); 
	register_taxonomy( 'providerscategory', 'providers', array(
		'hierarchical' => true,
		'label' => 'Category',
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => true,
		'show_admin_column' => true,
		)
	);
}