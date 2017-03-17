<?php

vc_map( array(
        'name' =>'Double Promo',
        'base' => 'doublepromo',
		"description" => "2 text box + image",
        "icon" => "webnus-doublepromo",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'michigan' ),
							'param_name' => 'title',
							'value'=>'',
							'description' => esc_html__( 'Enter the Title', 'michigan')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Link Text', 'michigan' ),
							'param_name' => 'link_text',
							'value'=>'',
							'description' => esc_html__( 'Enter the link text', 'michigan')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Link URL', 'michigan' ),
							'param_name' => 'link_link',
							'value'=>'',
							'description' => esc_html__( 'Enter the link url Example: http://domain.com', 'michigan')
					),
					array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Image', 'michigan' ),
							'param_name' => 'img',
							'value'=>'',
							'description' => esc_html__( 'Enter the image url', 'michigan')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Image alt', 'michigan' ),
							'param_name' => 'img_alt',
							'value'=>'Alt text',
							'description' => esc_html__( 'Enter the image alt Text', 'michigan')
					),
					array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Is Last Column?', 'michigan' ),
							'param_name' => 'last',
							'value'=>array('Yes'=>'true', 'No'=> 'false'),
							'description' => esc_html__( 'Is this second promobox?', 'michigan')
					),
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content', 'michigan' ),
							'param_name' => 'text',
							'value' => '',
							'description' => esc_html__( 'Enter the Doublepromo content text', 'michigan')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        
    ) );


?>