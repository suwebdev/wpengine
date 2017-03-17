<?php

vc_map( array(
        "name" =>"Process Item",
        "base" => "process",
        "description" => "Process item",
		"icon" => "webnus-process",
        "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "params" => array(
           
           
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Process  Title', 'michigan'),
				"param_name"=> "proc_title",
				"value"=>"",
				"description" => esc_html__( "Process Item 1 Title ", 'michigan')
				
			),
			 
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Process  Text', 'michigan'),
				"param_name"=> "proc_text",
				"value"=>"",
				"description" => esc_html__( "Process Item 1 Text ", 'michigan')
				
			),
			 array(
				"type"=>'iconfonts',
				"heading"=>esc_html__('Process  Icon', 'michigan'),
				"param_name"=> "proc_icon",
				"value"=>"",
				"description" => esc_html__( "Process Item 1 Icon ", 'michigan')
				
			),
			
        ),
		
        
    ) );


?>