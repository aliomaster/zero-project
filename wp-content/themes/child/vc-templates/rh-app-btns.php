<?php

// WPM HEADING
if ( function_exists('vc_map') ) {
	vc_map( array(
		"name" => __( "RH App Buttons", "wordpress" ),
		"base" => "rh_app_btns",
		"class" => "",
		"category" => __( 'RH addons', "wordpress" ),
		"params" => array(
		    array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Extra class", "wordpress" ),
				'value' => '',
				"param_name" => "class"
			)
        ),
		)
	);
}