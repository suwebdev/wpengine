<?php

vc_map( array(
        'name' =>'Webnus Countdown',
        'base' => 'countdown',
        "icon" => "webnus-countdown",
		"description" => "Countdown",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Style', 'michigan' ),
							'param_name' => 'style',
							'value' => array(
								"Modern"=>"modern",
								"Simple"=>"simple",
								"Minimal"=>"minimal",
								"Flip"=>"flip",
							),
							'description' => esc_html__( 'Select Countdown Type', 'michigan')
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Date Type', 'michigan' ),
							'param_name' => 'type',
							'value' => array(
								"Custom"=>"custom",
								"By Last Event"=>"events",
							),
							'description' => esc_html__( 'Select Date Type', 'michigan')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Date and Time', 'michigan' ),
							'param_name' => 'datetime',
							'value' => '',
							'description' => esc_html__( 'Enter date and time (11October 2016 9:00)', 'michigan'),
							"dependency" => array('element'=>'type','value'=>array('custom')),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Finished text', 'michigan' ),
							'param_name' => 'done',
							'value' => '',
							'description' => esc_html__( 'Finished text', 'michigan')
						),
						array(
							"type"=>'colorpicker',
							"heading"=>esc_html__('Content color (leave bank for default color)', 'michigan'),
							"param_name"=> "content_color",
							"value"=>"",
							"description" => esc_html__( "Select content color", 'michigan'),
							"dependency" => array('element'=>'style','value'=>array('minimal')),
						),
						
        ),
        
    ) );

?>