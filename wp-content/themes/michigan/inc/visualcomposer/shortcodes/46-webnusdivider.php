<?php

vc_map( array(
    "name" =>"Webnus Divider",
    "base" => "webnus-divider",
	"description" => "separator with title and icon",
	"icon" => "webnus-divider",
    "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
    "params" => array(
		   array(
				"type" => "dropdown",
				"heading" => esc_html__( "Type", 'michigan' ),
				"param_name" => "type",
				"value" => array(
					"Type 1"=>"1", // Center + Icon
					"Type 2"=>"2", // Center + Icon
					"Type 3"=>"3", // Left
					"Type 4"=>"4", // Left
					"Type 5"=>"5", // Center + Icon
					"Type 6"=>"6", // Left + Icon + Desc
					"Type 7"=>"7", // Left
					"Type 8"=>"8", // Center + Icon + Desc
					"Type 9"=>"9", // Center
					"Type 10"=>"10", // Left + Center + Right
					"Type 11"=>"11", // Left 
			),
			"description" => esc_html__( "Title Type", 'michigan')
			),			
		
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Text align', 'michigan' ),
				'description' => esc_html__( 'Select text align', 'michigan'),
				'param_name' => 'text_align',
				'value'=> array(
					''			=>	'',
					'left'		=>	'align-left',
					'center'	=>	'align-center',
					'right'		=>	'align-right',
					),
				"dependency" => array('element'=>'type','value'=>array('10')),
			),	

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Part 1', 'michigan' ),
				'param_name' => 'lspan',
				'value'=>'',
				'description' => esc_html__( 'Enter the first span text ', 'michigan')
			),

			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Color', 'michigan'),
				"param_name"=> "sec_color",
				"value"=>"",
				"description" => esc_html__( "Select color title", 'michigan'),
				"dependency" => array('element'=>'type','value'=>array('10',)),
			),	
			
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Part 2', 'michigan' ),
				'param_name' => 'rspan',
				'value'=>'',
				'description' => esc_html__( 'Enter the second span text', 'michigan')
			),	

			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Color', 'michigan'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select color title", 'michigan'),
				"dependency" => array('element'=>'type','value'=>array('10',)),
			),	

            array(
				"type"=>'textarea',
				"heading"=>esc_html__('Description', 'michigan'),
				"param_name"=> "description",
				"value"=>"",
				"description" => esc_html__( "Enter the description text", 'michigan'),
				"dependency" => array('element'=>'type','value'=>array('6','8','11',)),
			),			

			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Background color title', 'michigan'),
				"description" => esc_html__( "Select background color title ", 'michigan'),
				"param_name"=> "background_color_title",
				"value"=>"",
				"dependency" => array('element'=>'type','value'=>array('10',)),
			),

            array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Color', 'michigan'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select color for icon and second span", 'michigan'),
			),
			
            array(
                "type" => "iconfonts",
                "heading" => esc_html__( "Icon", 'michigan' ),
                "param_name" => "icon",
                'value'=>'',
                "description" => esc_html__( "Select Icon", 'michigan'),
				"dependency" => array('element'=>'type','value'=>array('1','2','5','6','8')),
            ),
           
        ),
		
        
    ) );


?>