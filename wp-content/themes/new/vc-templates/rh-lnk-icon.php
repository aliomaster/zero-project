<?php

// WPM HEADING
if ( function_exists('vc_map') ) {
	vc_map( array(
		"name" => __( "RH Registration form", "wordpress" ),
		"base" => "rh_reg_form",
		"class" => "",
		"category" => __( 'RH addons', "wordpress" ),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "wordpress" ),
				'value' => '',
				"param_name" => "title"
			)
            ),
		)
	);
}