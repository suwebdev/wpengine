<?php
vc_map( array(
	'name'			=> esc_html__( 'Testimonial Carousel', 'michigan' ),
	'base'			=> 'testimonial-carousel',
	'description'	=> esc_html__( 'Testimonial Carousel', 'michigan' ),
	'icon'			=> 'webnus-testimonial-carousel',
	'category'		=> esc_html__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(

		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__( 'Testimonial Items Per View', 'michigan' ),
			'param_name'	=> 'items',
			'value'			=> '3',
		),

		array(
			'heading'		=> esc_html__( 'Testimonial Items', 'michigan' ),
			'type'			=> 'param_group',
			'param_name'	=> 'testimonial_item',
			'params' => array(

				array(
					'heading'		=> esc_html__( 'Testimonial Image', 'michigan' ),
					'type'			=> 'attach_image',
					'param_name'	=> 'img',
					'value'			=> '',
				),

				array(
					'heading'		=> esc_html__( 'Testimonial Content', 'michigan' ),
					'type'			=> 'textarea',
					'param_name'	=> 'tc_content',
					'value'			=> '',
				),

				array(
					'heading'		=> esc_html__( 'Testimonial Name', 'michigan' ),
					'type'			=> 'textfield',
					'param_name'	=> 'name',
					'value'			=> '',
					'admin_label'	=> true,
				),

				array(
					'heading'		=> esc_html__( 'Testimonial Job', 'michigan' ),
					'type'			=> 'textfield',
					'param_name'	=> 'job',
					'value'			=> '',
					'admin_label'	=> true,
				),
			),
		),

	)
) );