<?php
vc_map( array(
	'name'			=> esc_attr__( 'Advanced Search', 'michigan' ),
	'base'			=> 'taxonomy-search',
	'icon'			=> 'webnus-taxonomy-search',
	'description'	=> esc_attr__( 'Advanced Search', 'michigan' ),
	'category'		=> esc_attr__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(

		array(
			'heading'		=> esc_attr__( 'Type', 'michigan' ),
			'description'	=> esc_attr__( 'You can choose among these pre-designed types', 'michigan' ),
			'type'			=> 'dropdown',
			'param_name'	=> 'type',
			'value'			=> array(
				esc_attr__( 'Courses Search', 'michigan' )	 => 'course',
				esc_attr__( 'Events Serach', 'michigan' )	 => 'tribe_events',
				esc_attr__( 'Excursion Search', 'michigan' ) => 'excursion',
			),
		),

		array(
			'heading'		=> esc_attr__( 'Category Field', 'michigan' ),
			'description'	=> esc_attr__( 'Show category field ?', 'michigan' ),
			'type'			=> 'checkbox',
			'param_name'	=> 'category_field',
			'value'			=> array(
				esc_attr__( 'Yes', 'michigan' ) => true
			),
			'std'			=> true,
		),

		array(
			'heading'		=> esc_attr__( 'Instructor Field', 'michigan' ),
			'description'	=> esc_attr__( 'Show instructor field ?', 'michigan' ),
			'type'			=> 'checkbox',
			'param_name'	=> 'instructor_field',
			'value'			=> array(
				esc_attr__( 'Yes', 'michigan' ) => true
			),
			'std'			=> true,
			'dependency'	=> array( 'element' => 'type', 'value' => 'course' ),
		),

		array(
			'heading'		=> esc_attr__( 'Date Field', 'michigan' ),
			'description'	=> esc_attr__( 'Show date field ?', 'michigan' ),
			'type'			=> 'checkbox',
			'param_name'	=> 'date_field',
			'value'			=> array(
				esc_attr__( 'Yes', 'michigan' ) => true
			),
			'std'			=> true,
			'dependency'	=> array( 'element' => 'type', 'value' => array( 'tribe_events', 'excursion' ) ),
		),

	),
) ); // end vc_map