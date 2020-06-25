<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if(function_exists('vc_set_as_theme')) {
	vc_set_as_theme(true);
}

/**
 * Change path for overridden templates
 */
if(function_exists('vc_set_shortcodes_templates_dir')) {
	$dir = get_stylesheet_directory() . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists('rh_configure_visual_composer') ) {
	/**
	 * Configuration for Visual Composer
	 * Hooks on vc_after_init action
	 */
	function rh_configure_visual_composer() {

		/**
		 * Removing shortcodes
		 */
		vc_remove_element("vc_wp_search");
		vc_remove_element("vc_gutenberg");
		vc_remove_element("vc_wp_meta");
		vc_remove_element("vc_wp_recentcomments");
		vc_remove_element("vc_wp_calendar");
		vc_remove_element("vc_wp_pages");
		vc_remove_element("vc_wp_tagcloud");
		vc_remove_element("vc_wp_custommenu");
		vc_remove_element("vc_wp_text");
		vc_remove_element("vc_wp_posts");
		vc_remove_element("vc_wp_links");
		vc_remove_element("vc_wp_categories");
		vc_remove_element("vc_wp_archives");
		vc_remove_element("vc_wp_rss");
		vc_remove_element("vc_teaser_grid");
		vc_remove_element("vc_message");
		vc_remove_element("vc_tour");
		vc_remove_element("vc_progress_bar");
		vc_remove_element("vc_pie");
		vc_remove_element("vc_posts_slider");
		vc_remove_element("vc_toggle");
		vc_remove_element("vc_images_carousel");
		vc_remove_element("vc_posts_grid");
		vc_remove_element("vc_carousel");
		vc_remove_element("vc_gmaps");
		vc_remove_element("vc_round_chart");
		vc_remove_element("vc_line_chart");
		vc_remove_element("vc_tta_accordion");
		vc_remove_element("vc_tta_tour");
		vc_remove_element("vc_tta_tabs");
		vc_remove_element("vc_separator");

		/**
		 * Remove unused parameters
		 */
		if (function_exists('vc_remove_param')) {
			vc_remove_param('vc_row', 'full_width');
			vc_remove_param('vc_row', 'full_height');
			vc_remove_param('vc_row', 'content_placement');
			vc_remove_param('vc_row', 'video_bg');
			vc_remove_param('vc_row', 'video_bg_url');
			vc_remove_param('vc_row', 'video_bg_parallax');
			vc_remove_param('vc_row', 'parallax');
			vc_remove_param('vc_row', 'parallax_image');
			vc_remove_param('vc_row', 'parallax_speed_video');
			vc_remove_param('vc_row', 'parallax_speed_bg');
			vc_remove_param('vc_row', 'gap');
			vc_remove_param('vc_row', 'columns_placement');
			vc_remove_param('vc_row', 'equal_height');

			vc_remove_param('vc_row_inner', 'content_placement');
			vc_remove_param('vc_row_inner', 'equal_height');
			vc_remove_param('vc_row_inner', 'gap');

            vc_remove_param('vc_row_inner', 'disable_element');
            vc_remove_param('vc_row', 'disable_element');
		}

	}

	add_action('vc_after_init', 'rh_configure_visual_composer');

}


if ( ! function_exists('rh_configure_visual_composer_grid_elemets') ) {

	/**
	 * Configuration for Visual Composer for Grid Elements
	 * Hooks on vc_after_init action
	 */

	function rh_configure_visual_composer_grid_elemets() {

		/**
		 * Remove Grid Elements if grid elements disabled
		 */
		vc_remove_element('vc_basic_grid');
		vc_remove_element('vc_media_grid');
		vc_remove_element('vc_masonry_grid');
		vc_remove_element('vc_masonry_media_grid');
		vc_remove_element('vc_button2');
		vc_remove_element("vc_custom_heading");


		/**
		 * Remove unused parameters from grid elements
		 */
		if (function_exists('vc_remove_param')) {
			vc_remove_param('vc_basic_grid', 'button_style');
			vc_remove_param('vc_basic_grid', 'button_color');
			vc_remove_param('vc_basic_grid', 'button_size');
			vc_remove_param('vc_basic_grid', 'filter_color');
			vc_remove_param('vc_basic_grid', 'filter_style');
			vc_remove_param('vc_media_grid', 'button_style');
			vc_remove_param('vc_media_grid', 'button_color');
			vc_remove_param('vc_media_grid', 'button_size');
			vc_remove_param('vc_media_grid', 'filter_color');
			vc_remove_param('vc_media_grid', 'filter_style');
			vc_remove_param('vc_masonry_grid', 'button_style');
			vc_remove_param('vc_masonry_grid', 'button_color');
			vc_remove_param('vc_masonry_grid', 'button_size');
			vc_remove_param('vc_masonry_grid', 'filter_color');
			vc_remove_param('vc_masonry_grid', 'filter_style');
			vc_remove_param('vc_masonry_media_grid', 'button_style');
			vc_remove_param('vc_masonry_media_grid', 'button_color');
			vc_remove_param('vc_masonry_media_grid', 'button_size');
			vc_remove_param('vc_masonry_media_grid', 'filter_color');
			vc_remove_param('vc_masonry_media_grid', 'filter_style');
			vc_remove_param('vc_basic_grid', 'paging_color');
			vc_remove_param('vc_basic_grid', 'arrows_color');
			vc_remove_param('vc_media_grid', 'paging_color');
			vc_remove_param('vc_media_grid', 'arrows_color');
			vc_remove_param('vc_masonry_grid', 'paging_color');
			vc_remove_param('vc_masonry_grid', 'arrows_color');
			vc_remove_param('vc_masonry_media_grid', 'paging_color');
			vc_remove_param('vc_masonry_media_grid', 'arrows_color');
		}
	}
	add_action('vc_after_init', 'rh_configure_visual_composer_grid_elemets');
}


if ( ! function_exists('rh_configure_visual_composer_frontend_editor') ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function rh_configure_visual_composer_frontend_editor() {

		/**
		 * Remove frontend editor
		 */
		if(function_exists('vc_disable_frontend')){
			vc_disable_frontend();
		}

	}
	add_action('vc_after_init', 'rh_configure_visual_composer_frontend_editor');
}

/*** Row ***/
if ( ! function_exists('rh_vc_row_map') ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function rh_vc_row_map() {
		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Row Type','ed-int'),
			'param_name' => 'row_type',
			'value' => array(
		esc_html__('Row','ed-int') => 'row',
		esc_html__('Parallax','ed-int') => 'parallax'
			)
		));

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Content Width','ed-int'),
			'param_name' => 'content_width',
			'value' => array(
				esc_html__('In Grid' ,'ed-int')=> 'grid',
				esc_html__('Full Width','ed-int') => 'full-width',
			)
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Anchor ID','ed-int'),
			'param_name' => 'anchor',
			'value' => '',
			'description' =>esc_html__( 'For example "home"','ed-int')
		));

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Content Aligment','ed-int'),
			'param_name' => 'content_aligment',
			'value' => array(
		esc_html__(	'Left' ,'ed-int')=> 'left',
		esc_html__('Center','ed-int') => 'center',
		esc_html__('Right' ,'ed-int')=> 'right'
			)
		));

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Video Background','ed-int'),
			'value' => array(
		esc_html__('No','ed-int') => '',
		esc_html__('Yes' ,'ed-int')=> 'show_video'
			),
			'param_name' => 'video',
			'description' => '',
			'dependency' => Array('element' => 'row_type', 'value' => array('row'))
		));

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' =>esc_html__( 'Video Overlay','ed-int'),
			'value' => array(
		esc_html__(	'No','ed-int') => '',
		esc_html__('Yes' ,'ed-int')=> 'show_video_overlay'
			),
			'param_name' => 'video_overlay',
			'description' => '',
			'dependency' => Array('element' => 'video', 'value' => array('show_video'))
		));

		vc_add_param('vc_row', array(
			'type' => 'attach_image',
			'class' => '',
			'heading' =>esc_html__( 'Video Overlay Image (pattern)','ed-int'),
			'value' => '',
			'param_name' => 'video_overlay_image',
			'description' => '',
			'dependency' => Array('element' => 'video_overlay', 'value' => array('show_video_overlay'))
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Video Background (webm) File URL','ed-int'),
			'value' => '',
			'param_name' => 'video_webm',
			'description' => '',
			'dependency' => Array('element' => 'video', 'value' => array('show_video'))
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Video Background (mp4) file URL','ed-int'),
			'value' => '',
			'param_name' => 'video_mp4',
			'description' => '',
			'dependency' => Array('element' => 'video', 'value' => array('show_video'))
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Video Background (ogv) file URL','ed-int'),
			'value' => '',
			'param_name' => 'video_ogv',
			'description' => '',
			'dependency' => Array('element' => 'video', 'value' => array('show_video'))
		));

		vc_add_param('vc_row', array(
			'type' => 'attach_image',
			'class' => '',
			'heading' => esc_html__('Video Preview Image','ed-int'),
			'value' => '',
			'param_name' => 'video_image',
			'description' => '',
			'dependency' => Array('element' => 'video', 'value' => array('show_video'))
		));

		vc_add_param("vc_row", array(
			'type' => 'dropdown',
			'class' => '',
			'heading' =>esc_html__( 'Full Screen Height','ed-int'),
			'param_name' => 'full_screen_section_height',
			'value' => array(
		esc_html__('No','ed-int') => 'no',
		esc_html__('Yes' ,'ed-int')=> 'yes'
			),
			'save_always' => true,
			'dependency' => Array('element' => 'row_type', 'value' => array('parallax'))
		));

		vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Vertically Align Content In Middle','ed-int'),
			'param_name' => 'vertically_align_content_in_middle',
			'value' => array(
		esc_html__('No','ed-int') => 'no',
		esc_html__('Yes','ed-int') => 'yes'
			),
			'dependency' => array('element' => 'full_screen_section_height', 'value' => 'yes')
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Section Height','ed-int'),
			'param_name' => 'section_height',
			'value' => '',
			'dependency' => Array('element' => 'full_screen_section_height', 'value' => array('no'))
		));

		vc_add_param('vc_row', array(
			'type' => 'attach_image',
			'class' => '',
			'heading' => esc_html__('Parallax Background image','ed-int'),
			'value' => '',
			'param_name' => 'parallax_background_image',
			'description' => esc_html__('Please note that for parallax row type, background image from Design Options will not work so you should to fill this field','ed-int'),
			'dependency' => Array('element' => 'row_type', 'value' => array('parallax'))
		));

		vc_add_param('vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' =>esc_html__( 'Parallax speed','ed-int'),
			'param_name' => 'parallax_speed',
			'value' => '',
			'dependency' => Array('element' => 'row_type', 'value' => array('parallax'))
		));

		/*** Row Inner ***/

		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Row Type','ed-int'),
			'param_name' => 'row_type',
			'value' => array(
		esc_html__('Row','ed-int') => 'row',
		esc_html__('Parallax','ed-int') => 'parallax'
			)
		));

		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Content Width','ed-int'),
			'param_name' => 'content_width',
			'value' => array(
		esc_html__('Full Width','ed-int') => 'full-width',
		esc_html__('In Grid','ed-int') => 'grid'
			)
		));

		vc_add_param("vc_row_inner", array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Full Screen Height','ed-int'),
			'param_name' => 'full_screen_section_height',
			'value' => array(
		esc_html__('No','ed-int') => 'no',
		esc_html__('Yes','ed-int') => 'yes'
			),
			'save_always' => true,
			'dependency' => Array('element' => 'row_type', 'value' => array('parallax'))
		));

		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Vertically Align Content In Middle','ed-int'),
			'param_name' => 'vertically_align_content_in_middle',
			'value' => array(
		esc_html__('No','ed-int') => 'no',
		esc_html__('Yes','ed-int') => 'yes'
			),
			'dependency' => array('element' => 'full_screen_section_height', 'value' => 'yes')
		));

		vc_add_param('vc_row_inner', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Section Height','ed-int'),
			'param_name' => 'section_height',
			'value' => '',
			'dependency' => Array('element' => 'full_screen_section_height', 'value' => array('no'))
		));

		vc_add_param('vc_row_inner', array(
			'type' => 'attach_image',
			'class' => '',
			'heading' =>esc_html__( 'Parallax Background image','ed-int'),
			'value' => '',
			'param_name' => 'parallax_background_image',
			'description' =>esc_html__( 'Please note that for parallax row type, background image from Design Options will not work so you should to fill this field','ed-int'),
			'dependency' => Array('element' => 'row_type', 'value' => array('parallax'))
		));

		vc_add_param('vc_row_inner', array(
			'type' => 'textfield',
			'class' => '',
			'heading' =>esc_html__( 'Parallax speed','ed-int'),
			'param_name' => 'parallax_speed',
			'value' => '',
			'dependency' => Array('element' => 'row_type', 'value' => array('parallax'))
		));
		vc_add_param('vc_row_inner', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' =>esc_html__( 'Content Aligment','ed-int'),
			'param_name' => 'content_aligment',
			'value' => array(
		esc_html__('Left','ed-int') => 'left',
		esc_html__('Center','ed-int') => 'center',
		esc_html__('Right','ed-int') => 'right'
			)
		));

		vc_add_param('vc_row_inner', array(
			'type'        => 'dropdown',
			'heading'     => esc_html__('Enable Row Overlap?','ed-int'),
			'param_name'  => 'enable_row_overlap',
			'admin_label' => true,
			'value'       => array(
		esc_html__(	'No' ,'ed-int') => 'no',
		esc_html__('Yes','ed-int') => 'yes'
			),
			'description' => '',
			'dependency'  => Array('element' => 'row_type', 'value' => array('row'))
		));

		vc_add_param('vc_row_inner', array(
			'type'        => 'dropdown',
			'heading'     => esc_html__('Overlap Size','ed-int'),
			'param_name'  => 'overlap_size',
			'value'       => array(
		esc_html__('Large','ed-int')  => 'large',
		esc_html__('Small','ed-int') => 'small'
			),
			'dependency'  => Array('element' => 'enable_row_overlap', 'value' => array('yes'))
		));

		vc_add_param('vc_row_inner', array(
			'type'        => 'dropdown',
			'heading'     => esc_html__('Use Row as a Box?','ed-int'),
			'param_name'  => 'use_row_box',
			'admin_label' => true,
			'value'       => array(
		esc_html__('No','ed-int')  => 'no',
		esc_html__('Yes','ed-int') => 'yes'
			),
			'save_always' => true,
			'description' => '',
			'dependency'  => Array('element' => 'enable_row_overlap', 'value' => array('yes'))
		));
	}

	add_action('vc_after_init', 'rh_vc_row_map');
}
