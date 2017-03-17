<?php

vc_map( array(
        "name" =>"Webnus Alert",
        "base" => "alert",
		"description" => "Alert box",
        "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "icon" => "webnus-alert",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'michigan' ),
							"param_name" => "type",
							"value" => array(
								"Info"=>"info",
								"Success"=>"success",
								"Warning"=>"warning",
								"Danger"=>"danger",
								
						),
						"description" => esc_html__( "Alert Type", 'michigan')
						),
						array(
							"type" => "checkbox",
							"heading" => esc_html__( "Has Close?", 'michigan' ),
							"param_name" => "close",
							"value" => array('Yes please'=>'true'),
							"description" => esc_html__( "Has Close Button?", 'michigan')
						),
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Alert Content", 'michigan' ),
							"param_name" => "content",
							"value"=>"Content goes here",
							"description" => esc_html__( "Contet Goes Here", 'michigan')
						),
						
           
        ),
		
        
    ) );


?>