<?php
vc_map( array(
	"name" => "Testimonial Slider",
	"base" => "testimonial_slider",
	"category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"icon" => "webnus-testimonialslider",
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Type", 'michigan' ),
			"description" => esc_html__( "Select Image", 'michigan'),
			"param_name" => "type",
			"value" => array(
				"One"	=>"mono",
				"Two"	=>"di",
				"Three"	=>"tri",
				"Four"	=>"tetra",       
				"Five"	=>"penta",
				"Six"	=>"hexa",
				"Seven"	=>"hepta",
				'eight'	=>"octa",			
				'Nine'	=>"nona",			
				'Ten'	=>"deca"			

				),
			),
		array(
			'heading'		=> esc_html__( 'testimonials Item', 'michigan' ),
			'description'	=> esc_html__( 'Please Add Item', 'michigan' ),
			'type'			=> 'param_group',
			'param_name'	=> 'process_item',
			'params'		=> array(

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Name', 'michigan' ),
					'description' => esc_html__( 'Enter the Testimonial Name', 'michigan'),
					'param_name' => 'process_name',
					'value'=>'Name',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Thumbnail Image', 'michigan' ),
					'description' => esc_html__( 'Testimonial Image', 'michigan'),
					'param_name' => 'process_img',
					'value'=>'',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Subtitle', 'michigan' ),
					'description' => esc_html__( 'Testimonial Subtitle', 'michigan'),
					'param_name' => 'process_subtitle',
					'value'=>'',
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Content', 'michigan' ),
					'description' => esc_html__( 'Enter the Testimonial content text', 'michigan'),
					'param_name' => 'process_testimonial_content',
					'value' => '',
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'First Social Name', 'michigan' ),
					'description' => esc_html__( 'Select Social Name', 'michigan'),
					'param_name' => 'process_first_social',
					'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
					),
					'std' => 'twitter',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'First Social URL', 'michigan' ),
					'description' => esc_html__( 'First social URL', 'michigan'),
					'param_name' => 'process_first_url',
					'value'=>'',
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Second Social Name', 'michigan' ),
					'description' => esc_html__( 'Select Social Name', 'michigan'),
					'param_name' => 'process_second_social',
					'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
					),
					'std' => 'facebook',

				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Second Social URL', 'michigan' ),
					'description' => esc_html__( 'Second social URL', 'michigan'),
					'param_name' => 'process_second_url',
					'value'=>'',
				),


				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Third Social Name', 'michigan' ),
					'description' => esc_html__( 'Select Social Name', 'michigan'),
					'param_name' => 'process_third_social',
					'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
					),
					'std' => 'google-plus',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Third Social URL', 'michigan' ),
					'description' => esc_html__( 'Third social URL', 'michigan'),
					'param_name' => 'process_third_url',
					'value'=>'',
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Fourth Social Name', 'michigan' ),
					'description' => esc_html__( 'Select Social Name', 'michigan'),
					'param_name' => 'process_fourth_social',
					'value' => array(
						"Twitter"=>'twitter',
						"Facebook"=>'facebook',
						"Google Plus"=>'google-plus',
						"Vimeo"=>'vimeo',
						"Dribbble"=>'dribbble',
						"Youtube"=>'youtube',
						"Youtube"=>'youtube',
						"Pinterest"=>'pinterest',
						"LinkedIn"=>'linkedin',
						"Instagram"=>'instagram',
					),
					'std' => 'linkedin',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Fourth Social URL', 'michigan' ),
					'description' => esc_html__( 'Fourth social URL', 'michigan'),
					'param_name' => 'process_fourth_url',
					'value'=>'',
				),
			)
		)
	)
));