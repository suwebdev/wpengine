<?php
vc_map( array(
	'name'			=> esc_html__( 'Webnus Enrolment', 'michigan' ),
	'base'			=> 'enrolment',
	'description'	=> esc_html__( 'enrolment', 'michigan' ),
	'icon'			=> 'webnus-enrolment',
	'category'		=> esc_html__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(
		array(
			'heading'		=> esc_html__( 'Process Item', 'michigan' ),
			'description'	=> esc_html__( 'If you want this element cover whole page width, please add it inside of a full row. For this purpose, click on edit button of the row and set Select Row Type on Full Width Row.', 'michigan' ),
			'type'			=> 'param_group',
			'param_name'	=> 'process_item',
			'params'		=> array(

				array(
					'heading'		=> esc_html__( 'Process Title', 'michigan' ),
					'type'			=> 'textfield',
					'param_name'	=> 'process_title',
					'value'			=> '',
					'admin_label'	=> true,
				),

				array(
					'heading'		=> esc_html__( 'Process Content', 'michigan' ),
					'type'			=> 'textarea',
					'param_name'	=> 'process_content',
					'value'			=> '',
				),

				array(
					'heading'		=> esc_html__( 'Line number ( or text )', 'michigan' ),
					'type'			=> 'textfield',
					'param_name'	=> 'line_flag',
					'value'			=> '',
				),

			),
		),
) ) );