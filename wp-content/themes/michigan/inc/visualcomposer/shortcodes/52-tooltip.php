<?php

vc_map( array(
        "name" =>"Webnus Tooltip",
        "base" => "tooltip",
		"description" => "Tooltip",
        "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "icon" => "webnus-tooltip",
        "params" => array(
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Tooltip Text", 'michigan' ),
							"param_name" => "tooltiptext",
							"value" => '',
							"description" => esc_html__( "Tooltip text goes here", 'michigan')
						),
						
						array(
							'type' => "textarea",
							"heading" => esc_html__( 'Tooltip Content', 'michigan' ),
							"param_name" => 'tooltip_content',
							"value"=>'',
							"description" => esc_html__( "Contet Goes Here", 'michigan')
						),
						
           
        ),
		
        
    ) );


?>