<?php
vc_map( array(
        'name' =>'Webnus Events',
        'base' => 'events',
        "icon" => "webnus-events",
		"description" => "Show Upcoming Events",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'michigan' ),
							"param_name" => "type",
							"value" => array(
								"List"=>"list",
								"Cover"=>"cover",
								"Grid"=>"grid",
								"Grid 2"=>"grid2",
								"Grid 3"=>"grid3",
								"Grid 4"=>"grid4",
								"Clean"=>"clean",
								"Clean 2"=>"clean2",
								"Minimal"=>"minimal",
								"Carusel"=>"carusel",
							),
							"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan')
						),
						array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Post Count', 'michigan' ),
						'param_name' => 'count',
						'value' => '',
						'std' => '6',
						'description' => esc_html__( 'Number of event(s) to show. Note: When you type nothing it puts for default 6 events to show.', 'michigan')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'michigan' ),
							'param_name' => 'category',
							'value' => '',
							'description' => wp_kses( __('Type category ID or leave blank to show all categories.<br>Note: Pick up the ID & fallow this instruction: admin panel > events > ID column.','michigan'), array( 'br' => array() ) )
						),		
						array(
							'heading' => esc_html__('Just Upcoming?', 'michigan') ,
							'description' => esc_html__('Check this for show only upcoming event(s). To show all events, uncheck this.', 'michigan'),
							'param_name' => 'upcoming',
							'value' => array( esc_html__( 'Just Show Upcoming Events', 'michigan' ) => 'enable'),
							'type' => 'checkbox',
							'std' => 'enable',
						) ,
					
						
					),      
		) );
?>