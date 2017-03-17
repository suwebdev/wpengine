<?php
vc_map( array(
        'name' =>'Webnus Ministry',
        'base' => 'ministry',
		'description' => 'Introduce Ministries',
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ), 
        'icon' => 'webnus-ministry',
        'params'=>array(

        	array(
					"type" => "dropdown",
					"heading" => esc_html__( "Type", 'michigan' ),
					"param_name" => "type",
					"value" => array(
						"Type 1"=>"1",
						"Type 2"=>"2",						
				),
				"description" => esc_html__( "Select style type", 'michigan')
			),		
		
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Ministry Name', 'michigan' ),
					'param_name' => 'ministry_name',
					'value'=>'',
					'description' => esc_html__( 'Ministry name', 'michigan')
			),		
			array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Ministry Image', 'michigan' ),
					'param_name' => 'ministry_img',
					'value'=>'',
					'description' => esc_html__( 'Ministry image', 'michigan')
			),
			array(
					"type"=>'colorpicker',
					"heading"=>esc_html__('Main color (leave bank for default color)', 'michigan'),
					"param_name"=> "color",
					"value"=>"",
					"dependency" => array('element'=>'type','value'=>array('1')),
					"description" => esc_html__( "Select title color", 'michigan')
			),
			array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Ministry Description Text', 'michigan' ),
					'param_name' => 'text',
					'value'=>'',
					'description' => esc_html__( 'Ministry description text', 'michigan')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Ministry Director Name', 'michigan' ),
					'param_name' => 'director_name',
					'value'=>'',
					"dependency" => array('element'=>'type','value'=>array('1')),
					'description' => esc_html__( 'Ministry director name', 'michigan')
			),
			array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Ministry Director Image', 'michigan' ),
					'param_name' => 'director_img',
					'value'=>'',
					"dependency" => array('element'=>'type','value'=>array('1')),
					'description' => esc_html__( 'Ministry director image', 'michigan')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Ministry Link URL', 'michigan' ),
					'param_name' => 'link',
					'value'=>'',
					'description' => esc_html__( 'Ministry link url', 'michigan')
			),
		),
    ) );
?>