<?php
vc_map( array(
        'name' =>'Webnus FAQ',
        'base' => 'faq',
        "icon" => "webnus-faq",
		"description" => "Show Latest Or Popular FAQ",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'michigan' ),
							"param_name" => "type",
							"value" => array(
								"Minimal"=>"minimal",
								"Toggle"=>"toggle",
							),
							"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan')
						),
					
						array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Post Count', 'michigan' ),
						'param_name' => 'count',
						'value' => '',
						'description' => esc_html__( 'Number of event(s) to show. Note: When you type nothing it puts for default 6 events to show.', 'michigan')
						),
						
						array(
							'heading' => esc_html__('Page Navigation', 'michigan') ,
							'description' => wp_kses( __('Enable page navigation.<br/><br/>', 'michigan'), array( 'br' => array() ) ),
							'param_name' => 'page',
							'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
							'type' => 'checkbox',
							'std' => '',
						) ,
			
						array(
							"type" => "iconfonts",
							"heading" => esc_html__( "Icon", 'michigan' ),
							"param_name" => "icon",
							'value'=>'',
							"description" => esc_html__( "Show an icon on the left side of the course title.", 'michigan'),
							"dependency" => array('element'=>'type','value'=>array('minimal')),
						),					
					
						
					),      
		) );
?>