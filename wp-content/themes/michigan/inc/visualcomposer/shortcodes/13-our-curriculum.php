<?php

vc_map( array(
    'name' =>'Our Curriculum',
    'base' => 'ourcurriculum',
	'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"description" => "Curriculum",
    "icon" => "webnus-ourcurriculum",
    'params'=>array(
		
    	array(
			"type" => "dropdown",
			"heading" => esc_html__( "Type", 'michigan' ),
			"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan'),
			"param_name" => "type",
			"value" => array(
							"Type 1" => "1",
							"Type 2" => "2",
							"Type 3" => "3",
							"Type 4" => "4",
							"Type 5" => "5",
							"Type 6" => "6",
							"Type 7" => "7",
							"Type 8" => "8",
						),
		),

		array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Step title', 'michigan' ),
				'description' => esc_html__( 'please enter your step title', 'michigan'),
				'param_name' => 'step_title',
				'value'=>'',
		),

		array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Number title', 'michigan' ),
				'description' => esc_html__( 'please enter your number title', 'michigan'),
				'param_name' => 'step_number',
				'value'=>'A',
		),

		array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Course Name', 'michigan' ),
				'description' => esc_html__( 'please enter course name', 'michigan'),
				'param_name' => 'course_name',
				'value'=>'',
		),

		array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description', 'michigan' ),
				'description' => esc_html__( 'please enter description', 'michigan'),
				'param_name' => 'course_description',
				'value'=>'',
		),
	)));
