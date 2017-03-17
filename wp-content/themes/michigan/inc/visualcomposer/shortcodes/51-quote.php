<?php

vc_map( array(
        'name' =>'Webnus Quote',
        'base' => 'quote',
		"description" => "Quote",
        "icon" => "webnus-quote",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Name', 'michigan' ),
							'param_name' => 'name',
							'value'=>'',
							'description' => esc_html__( 'Enter the Name', 'michigan')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Name Subtitle', 'michigan' ),
							'param_name' => 'name_sub',
							'value'=>'',
							'description' => esc_html__( 'Enter the Name Subtitle', 'michigan')
					),
					
					
					
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'michigan' ),
							'param_name' => 'text',
							'value' => '',
							'description' => esc_html__( 'Enter the Quote of the Week content text', 'michigan')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        
    ) );


?>