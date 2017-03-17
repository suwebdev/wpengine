<?php
vc_map( array(
        'name' =>'Single Event',
        'base' => 'anevent',
        "icon" => "webnus-anevent",
		"description" => "Show an event",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
			array(
				"type" => "dropdown",
				'heading' => esc_html__( 'Type', 'michigan' ),
				'param_name' => 'type',
				"value" => array(
					"Latest Event"		 =>"latest",
					"Custom Event"		 =>"custom",
					"Custom Event Type2" =>"custom-t2",
				),
				'description' => esc_html__( 'You can choose among these types.', 'michigan')
			), 
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'michigan' ),
					'param_name' => 'event_tag',
					'value'=>'',
					'description' => esc_html__( 'Choose a title for your event post.', 'michigan'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Event ID', 'michigan' ),
				'param_name' => 'post',
				'value'=>'',
				'description' => esc_html__( 'Pick up the ID & fallow this instruction: admin panel > courses > ID column. Note: When you type nothing it puts latest course as default to show.', 'michigan'),
				"dependency" => array('element'=>'type','value'=>array('custom','custom-t2')),
			), 
			),    
		) );
?>