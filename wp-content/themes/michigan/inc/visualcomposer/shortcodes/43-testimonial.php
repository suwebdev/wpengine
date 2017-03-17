<?php

vc_map( array(
        'name' =>'Webnus Testimonial',
        'base' => 'testimonial',
		"description" => "Testimonial",
        "icon" => "webnus-testimonial",
        'params'=>array(
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Name', 'michigan' ),
							'param_name' => 'name',
							'value'=>'Name',
							'description' => esc_html__( 'Enter the Testimonial Name', 'michigan')
					),
					array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Image', 'michigan' ),
							'param_name' => 'img',
							'value'=>'http://',
							'description' => esc_html__( 'Testimonial Image', 'michigan')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Subtitle', 'michigan' ),
							'param_name' => 'subtitle',
							'value'=>'',
							'description' => esc_html__( 'Testimonial Subtitle', 'michigan')
					),
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'michigan' ),
							'param_name' => 'testimonial_content',
							'value' => 'Testimonial content text goes here',
							'description' => esc_html__( 'Enter the Testimonial content text', 'michigan')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        
    ) );


?>