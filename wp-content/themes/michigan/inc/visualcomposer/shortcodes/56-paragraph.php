<?php

vc_map( array(
        'name' =>'Webnus Paragraph',
        'base' => 'p',
		"description" => "P tag",
        "icon" => "webnus-paragraph",
        'params'=>array(


					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Paragraph', 'michigan' ),
							'param_name' => 'content',
							'value' => 'Paragraph content goes here',
							'description' => esc_html__( 'Paragraph', 'michigan')
					),

		),
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        
    ) );


?>