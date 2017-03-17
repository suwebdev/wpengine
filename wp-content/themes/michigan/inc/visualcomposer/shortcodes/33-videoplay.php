<?php

vc_map( array(
        "name" =>"Video Play Button",
        "base" => "videoplay",
		"description" => "Video Play Button",
		"icon" => "webnus-videoplay",
        "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "params" => array(
		
  			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Video URL', 'michigan' ),
							'param_name' => 'link',
							'value' => '#',
							'description' => esc_html__( 'YouTube/Vimeo URL', 'michigan')
					),
					
             array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Size', 'michigan'),
				"param_name"=> "size",
				"value"=>"",
				"description" => esc_html__( "Icon size in px format, Example: 80px", 'michigan')
				
			),
			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Icon color', 'michigan'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select icon color", 'michigan')
				
			),
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Extra Class', 'michigan'),
				"param_name"=> "link_class",
				"value"=>"",
				"description" => esc_html__( "Extra Class ", 'michigan')
				
			),
           
        ),
		
        
    ) );


?>