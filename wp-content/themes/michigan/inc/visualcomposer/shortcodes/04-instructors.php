<?php
vc_map( array(
    'name' =>'Courses Instructors',
    'base' => 'instructors',
    "icon" => "webnus-course-instructors",
	"description" => "Show Courses Instructors",
    'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
    'params' => array(				
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Instructors Type:", 'michigan' ),
			"param_name" => "view",
			"value" => array(
				"New Instructors"=>"1",
				"Popular Instructors"=>"2",
				"Top Rated Instructorsr"=>"3",
				"Most Active Instructors"=>"4",
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Instructors Count', 'michigan' ),
			'param_name' => 'count',
			'value' => '',
			'description' => esc_html__( 'Number of instructor(s) to show.', 'michigan')
		),
		array(
			'heading' => esc_html__('Page Navigation', 'michigan') ,
			'description' => wp_kses( __('Enable page navigation.<br/><br/>', 'michigan'), array( 'br' => array() ) ),
			'param_name' => 'page',
			'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
			'type' => 'checkbox',
			'std' => '',
		),
		array(
			"type"			=> "checkbox",
			"heading"		=> esc_html__( "Do you want to display this element as a carousel (slideshow)?", 'michigan' ),
			"param_name"	=> "display_as_carousel",
			"value"			=> array(
				esc_html__( "Yes", 'michigan' )	=> '1',
			),
		),
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__( 'Instructors items per view', 'michigan' ),
			'param_name'	=> 'carousel_items',
			'value'			=> '3',
			'std'			=> '3',
			'dependency'	=> array( 'element' => 'display_as_carousel', 'value' => '1' ),
		),
	),
) );