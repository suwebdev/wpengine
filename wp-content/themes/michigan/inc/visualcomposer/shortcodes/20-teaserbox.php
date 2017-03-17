<?php vc_map( array(
	'name' =>'Teaser Box',
	'base' => 'teaserbox',
	'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"description" => "Image and icon with text article",
	"icon" => "webnus-teaserbox",
	'params'=>array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Type", 'michigan' ),
			"param_name" => "type",
			"value" => array(
				"Type 1"=>"1",
				"Type 2"=>"2",
				"Type 3"=>"3",
				"Type 4"=>"4",
				"Type 5"=>"5",
				"Type 6"=>"6",
				"Type 7"=>"7",
			),
			"description" => esc_html__( "TeaserBox Type", 'michigan')
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'michigan' ),
			'param_name' => 'img',
			'value'=>'',
			'description' => esc_html__( 'TeaserBox Image', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'michigan' ),
			'param_name' => 'title',
			'value'=>'',
			'description' => esc_html__( 'Enter the Title', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Subtitle', 'michigan' ),
			'param_name' => 'subtitle',
			'value'=>'',
			'description' => esc_html__( 'Enter the Subtitle', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Link URL', 'michigan' ),
			'param_name' => 'link_url',
			'value'=>'#',
			'description' => esc_html__( 'Enter the link url. Example: http://yourdomain.com', 'michigan')
		),

		
		array(
			'param_name' => 'target',
			'value' => array( esc_html__( 'Open link in a new window/tab.', 'michigan' ) => 'blank'),
			'type' => 'checkbox',
			'std' => '',
		) ,
										
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image alt', 'michigan' ),
			'param_name' => 'img_alt',
			'value'=>'',
			'description' => esc_html__( 'Enter the image alt Text', 'michigan')
		),		
	),
)); ?>