<?php

vc_map( array(
        'name' =>'Webnus Link',
        'base' => 'link',
		"description" => "Learn more link",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "icon" => "webnus-link",
		'params'=>array(
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Link URL', 'michigan' ),
							'param_name' => 'url',
							'value' => '#',
							'description' => esc_html__( 'Link URL, Example: http://domain.com', 'michigan')
					),
					
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Link Text', 'michigan' ),
							'param_name' => 'content',
							'value' => 'Link Text',
							'description' => esc_html__( 'Link Text (Content)', 'michigan')
					),
		)
        
    ) );


?>