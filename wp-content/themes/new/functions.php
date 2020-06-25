<?php
// Styles & Scripts
require_once( get_stylesheet_directory() . '/inc/assets.php' );

// Widgets
require_once( get_stylesheet_directory() . '/inc/widgets.php' );

// Register post type
require_once( get_stylesheet_directory() . '/inc/register-post-type.php' );

// Duplicater
require_once( get_stylesheet_directory() . '/inc/duplicate-posts.php' );

// WPBakery
if (rh_visual_composer_installed()) {
    require_once( get_stylesheet_directory() . '/inc/visual-composer-config.php' );
    require_once( get_stylesheet_directory() . '/inc/shortcodes.php' );
}

// WPBakery customization
function rh_visual_composer_installed() {
    //is Visual Composer installed?
    if(class_exists('WPBakeryVisualComposerAbstract')) {
        return true;
    }

    return false;
}

// Debug
if ( ! function_exists( 'pr' ) ) {
	function pr( $val ) {
		echo '<pre style="font-size: 16px; color: black;">';
		print_r( $val );
		echo '</pre>';
	}
}

// add images thumbnails
add_theme_support( 'post-thumbnails' );

// custom image size
// add_image_size( 'sizeLogo', 220, 155, true );

// register menu
function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Primary Menu' );
}
add_action( 'after_setup_theme', 'theme_register_nav_menu' );

// Options page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-settings',
		'icon_url'		=> 'dashicons-images-alt2',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'menu_slug' 	=> 'theme-header-settings',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'menu_slug' 	=> 'theme-footer-settings',
		'parent_slug'	=> 'theme-general-settings',
	));

}

// VC helpers

/**
 * Function that generates html attribute
 *
 * @param $value string | array value of html attribute
 * @param $attr string name of html attribute to generate
 * @param $glue string glue with which to implode $attr. Used only when $attr is array
 *
 * @return string generated html attribute
 */
function rh_get_inline_attr($value, $attr, $glue = '') {
	if(!empty($value)) {

		if(is_array($value) && count($value)) {
			$properties = implode($glue, array_filter($value));
		} elseif($value !== '') {
			$properties = $value;
		}

		return $attr.'="'.esc_attr($properties).'"';
	}

	return '';
}

/**
 * Function that returns generated class attribute
 *
 * @param $value string value of class attribute
 *
 * @return string generated class attribute
 *
 * @see xpo_edge_get_inline_attr()
 */
function rh_get_class_attribute($value) {
	return rh_get_inline_attr($value, 'class', ' ');
}

function rh_get_module_part( $module ) {
	return $module;
}

