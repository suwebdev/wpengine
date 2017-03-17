<?php

vc_map( array(
        "name" =>"Icon Divider",
        "base" => "icon-divider",
		"description" => "Vector font icon",
        
		"icon" => "webnus-wicon",
        "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "params" => array(
           
             array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Icon color', 'michigan'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select icon color", 'michigan')
				
			),
			
             array(
                "type" => "iconfonts",
                "heading" => esc_html__( "Icon", 'michigan' ),
                "param_name" => "name",
                'value'=>'',
                "description" => esc_html__( "Select Icon", 'michigan')
            ),
           
        ),
		
        
    ) );


?>