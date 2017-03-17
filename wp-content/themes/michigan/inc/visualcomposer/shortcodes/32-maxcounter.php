<?php

vc_map( array(
        'name' =>'Max Counter',
        'base' => 'maxcounter',
        "icon" => "webnus-maxcounter",
		"description" => "MaxCounter",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Type', 'michigan' ),
				'param_name' => 'type',
				'value' => array(
					'Type 1'=>'1',
					'Type 2'=>'2',
					'Type 3'=>'3',
					'Type 4'=>'4',
				),
				'description' => esc_html__( 'You can choose among these pre-designed types.', 'michigan')
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Count', 'michigan' ),
				'param_name' => 'count',
				'value' => '',
				'description' => esc_html__( 'Enter the number that you want to count.', 'michigan')
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Prefix', 'michigan' ),
				'description' => esc_html__( 'Show the unit content before your counter number., Example: $', 'michigan'),
				'param_name' => 'prefix',
				'value' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Suffix', 'michigan' ),
				'description' => esc_html__( 'Show the unit content after your counter number., Example: %', 'michigan'),
				'param_name' => 'suffix',
				'value' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'michigan' ),
				'param_name' => 'title',
				'value' => '',
				'description' => esc_html__( 'Enter the title', 'michigan')
			),
			array(
				"type"=>'textarea',
				"param_name"=> "description",
				"heading"=>esc_html__('Description', 'michigan'),
				"value"=>"",
				"description" => esc_html__( "Description content", 'michigan'),
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> esc_html__('Border Right', 'michigan') ,
				'description' 	=> esc_html__('Check this for show Border Right', 'michigan'),
				'param_name' 	=> 'border_right',
				'value' => array( esc_html__(
					'Border Right', 'michigan' ) => 'enable'
				),
				'dependency' => array( 'element' => 'type', 'value' => array('3') ),
			) ,		
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Color', 'michigan' ),
				'param_name' => 'color',
				'value' => '',
				'description' => esc_html__( 'Please select icon color', 'michigan'),
			),
			array(
				'type' => 'iconfonts',
				'heading' => esc_html__( 'Icon', 'michigan' ),
				'param_name' => 'icon',
				'value' => '',
				'description' => esc_html__( 'Please select counter icon', 'michigan'),
			),
						
        ),
		
        
    ) );


?>