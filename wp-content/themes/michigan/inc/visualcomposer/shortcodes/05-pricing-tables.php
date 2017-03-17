<?php
vc_map( array(
	'base'			=> 'pricing-tables',
	'name'			=> 'Pricing Tables',
	'description'	=> 'Pricing Tables',
	'icon'			=> 'webnus-pricingtable',
	'category'		=> esc_html__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(

		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Type", 'michigan' ),
			"param_name" => "type",
			"value" => array(
				"Type 1"=>"1",
				"Type 2"=>"2",
				"Type 3"=>"3",
			),
			"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan')
		),

		array(
			'heading'		=> esc_html__( 'Title', 'michigan' ),
			'description' 	=> esc_html__( 'Pricing Table Title', 'michigan'),
			'type'			=> 'textfield',
			'param_name'	=> 'title',
		),

		array(
			'heading'		=> esc_html__( 'Header Description', 'michigan' ),
			'description' 	=> esc_html__( 'Pricing Table Description', 'michigan'),
			'type'			=> 'textfield',
			'param_name'	=> 'description',
			'dependency'	=> array( 'element' => 'type', 'value' => '4' ),
		),

		array(
			'heading'		=> esc_html__( 'Price', 'michigan' ),
			'description'	=> esc_html__( 'Pricing Table Price', 'michigan'),
			'type'			=> 'textfield',
			'param_name'	=> 'price',
			'value'			=> '10',
		),

		array(
			'heading'		=> esc_html__( 'currency', 'michigan' ),
			'description'	=> esc_html__( 'Please enter currency', 'michigan'),
			'type'			=> 'textfield',
			'param_name'	=> 'currency',
			'value'			=> '$',
		),


		array(
			'heading'		=> esc_html__( 'Period', 'michigan' ),
			'description'	=> esc_html__( 'Pricing Table Period', 'michigan'),
			'type'			=> 'textfield',
			'param_name'	=> 'period',
			'value'			=> esc_html__( 'Month', 'michigan'),
		),

		array(
			'heading'		=> esc_html__( 'Features', 'michigan' ),
			'description'	=> esc_html__( 'Enter features for pricing table - value, title and color.', 'michigan' ),
			'type'			=> 'param_group',
			'param_name'	=> 'features',
			'params' => array(
				array(
					'heading'		=> esc_html__( 'Feature Item Text', 'michigan' ),
					'type'			=> 'textfield',
					'param_name'	=> 'feature_item',
					'admin_label'	=> true,
				),
			),
		),

		array(
			'heading'		=> esc_html__( 'Popular Pricing Table Text', 'michigan' ),
			'type'			=> 'textfield',
			'param_name'	=> 'pt_popular',
			'value'			=> '',
			'dependency'	=> array( 'element' => 'type', 'value' => array('2','3',) ),
		),		

		array(
			'heading'		=> esc_html__( 'Link Text', 'michigan' ),
			'type'			=> 'textfield',
			'param_name'	=> 'link_text',
			'value'			=> '',
		),

		array(
			'heading'		=> esc_html__( 'Link URL', 'michigan' ),
			'description'	=> esc_html__( 'Link URL (http://example.com)', 'michigan' ),	
			'type'			=> 'textfield',
			'param_name'	=> 'link_url',
			'value'			=> '',
		),

		array(
			'type'			=> 'checkbox',
			'heading'		=> esc_html__( 'Featured Plan ?', 'michigan' ),
			'param_name'	=> 'featured',
			'value'			=> array( esc_html__( 'Yes', 'michigan' ) => ' w-featured' ),
			'description'	=> esc_html__( 'Pricing Tables Featured Plan', 'michigan'),
			"dependency" => array( 'element' => 'type', 'value' => array ('2','3') ),
		),

	)

) );