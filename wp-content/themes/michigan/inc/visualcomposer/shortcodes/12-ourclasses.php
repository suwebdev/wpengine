<?php
vc_map(array(
	'name'			=> esc_html__( 'Our class', 'michigan' ),
	'base'			=> 'ourclass',
	'description'	=> esc_html__( 'Webnus our class', 'michigan' ),
	'icon'			=> 'webnus-classes',
	'category' 		=> esc_html__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(

		array(
			'type'			=> 'dropdown',
			'heading'		=> esc_html__( 'Class Title', 'michigan' ),
			'description'	=> esc_html__( 'Please enter your class title', 'michigan'),
			'param_name'	=> 'type',
			'value'			=> array(
				'type1'	=> '1',
				'type2'	=> '2',
			),
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__( 'Class Title', 'michigan' ),
			'description'	=> esc_html__( 'Please enter your class title', 'michigan'),
			'param_name'	=> 'title',
			'value'			=> '',
		),

		array(
			'type'			=> 'attach_image',
			'heading'		=> esc_html__( 'Image', 'michigan' ),
			'description'	=> esc_html__( 'please select image', 'michigan'),
			'param_name'	=> 'image',
			'value'			=> '',
		),

		array(
			"type"			=>'colorpicker',
			"heading"		=>esc_html__('Background Color', 'michigan'),
			"param_name"	=> "bgcolor",
			"value"			=>"",
			"description" 	=> esc_html__( "Select background color", 'michigan'),
			'dependency'	=> array( 'element' => 'type', 'value' => '1' ),
		),

		array(
			"type"			=>'colorpicker',
			"heading"		=>esc_html__('Border Color', 'michigan'),
			"param_name"	=> "border_img_color",
			"value"			=>"",
			"description" 	=> esc_html__( "Select border color", 'michigan'),
			'dependency'	=> array( 'element' => 'type', 'value' => '2' ),
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__( 'Age', 'michigan' ),
			'description'	=> esc_html__( 'Please enter age class', 'michigan'),
			'param_name'	=> 'age',
			'value'			=> '',
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__( 'class size', 'michigan' ),
			'description'	=> esc_html__( 'Please enter class size', 'michigan'),
			'param_name'	=> 'class_size',
			'value'			=> '',
		),

		array(
			'type'			=> 'textarea',
			'heading'		=> esc_html__( 'content', 'michigan' ),
			'description'	=> esc_html__( 'Please enter content', 'michigan'),
			'param_name'	=> 'class_content',
			'value'			=> '',
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__( 'link name', 'michigan' ),
			'description'	=> esc_html__( 'Please enter link name', 'michigan'),
			'param_name'	=> 'link_title',
			'value'			=> '',
		),

		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__( 'link url', 'michigan' ),
			'description'	=> esc_html__( 'Please enter link url', 'michigan'),
			'param_name'	=> 'link_url',
			'value'			=> '',
		),

		array(
			'type'			=> 'colorpicker',
			'heading'		=> esc_html__( 'button Color', 'michigan' ),
			'description'	=> esc_html__( 'Please enter link url', 'michigan'),
			'param_name'	=> 'btn_color',
			'value'			=> '',
			'dependency'	=> array( 'element' => 'type', 'value' => '2' ),
		),
	)
));