<?php

vc_map( array(
        'name' =>'Webnus Callout',
        'base' => 'callout',
		"description" => "Call to action + button",
        "icon" => "webnus-callout",
        'params'=>array(
					
					
					
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'michigan' ),
							'param_name' => 'title',
							'value'=>'',
							'description' => esc_html__( 'Enter the Callout title', 'michigan')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Button Text', 'michigan' ),
							'param_name' => 'button_text',
							'value'=>'',
							'description' => esc_html__( 'Callout Button text', 'michigan')
					),
					array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Button Link', 'michigan' ),
							'param_name' => 'button_link',
							'value'=>'',
							'description' => esc_html__( 'Button Link URL', 'michigan')
					),
					array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Content Text', 'michigan' ),
							'param_name' => 'text',
							'value' => '',
							'description' => esc_html__( 'Enter the Callout content text', 'michigan')
					),
		),
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        
    ) );


?>