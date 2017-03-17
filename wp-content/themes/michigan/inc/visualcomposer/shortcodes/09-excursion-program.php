<?php
vc_map( array(
	'name'			=> esc_html__( 'Excursions Program', 'michigan' ),
	'base'			=> 'excursion-program',
	'icon'			=> 'webnus-excursion-program',
	'description'	=> esc_html__( 'Webnus Excursions Program', 'michigan' ),
	'category'		=> esc_html__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(

		array(
			'heading'		=> esc_html__( 'Image', 'michigan' ),
			'type'			=> 'attach_image',
			'param_name'	=> 'img',
			'value'			=> '',
		),

		array(
			'heading'		=> esc_html__( 'Title', 'michigan' ) ,
			'type'			=> 'textfield',
			'param_name'	=> 'title',
			'value'			=> '',
		),

		array(
			'heading'		=> esc_html__( 'Date', 'michigan' ) ,
			'type'			=> 'textfield',
			'param_name'	=> 'date',
			'value'			=> '',
			'std'			=> esc_html( '04/07/2015 - 10:30 A.M' ),
		),

		array(
			'heading'		=> esc_html__( 'Programs', 'michigan' ),
			'description'	=> esc_html__( 'Enter programs for Excursion Programs', 'michigan' ),
			'type'			=> 'param_group',
			'param_name'	=> 'programs',
			'params' => array(
				array(
					'heading'	 => esc_html__( 'Program Title', 'michigan' ),
					'type'		 => 'textfield',
					'param_name' => 'program_title',
					'value'		 => '',
					'admin_label'	=> true,
				),
				array(
					'heading'		=> esc_html__( 'Program Text', 'michigan' ),
					'type'			=> 'textfield',
					'param_name'	=> 'program_text',
				),
			),
		),

	),
) );