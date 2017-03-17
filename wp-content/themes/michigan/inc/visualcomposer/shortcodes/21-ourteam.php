<?php

vc_map( array(
        'name' =>'Our Team',
        'base' => 'ourteam',
		"description" => "Team member",
        "icon" => "webnus-ourteam",
        'params'=>array(
			
        	array(
					"type" => "dropdown",
					"heading" => esc_html__( "Type", 'michigan' ),
					"param_name" => "type",
					"value" => array(
						"Type 1" => "1",
						"Type 2" => "2",
						"Type 3" => "3",						
						"Type 4" => "4",						
						"Type 5" => "5",						
						"Type 6" => "6",
					),
				"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan')
			),

			array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Team Image', 'michigan' ),
					'param_name' => 'img',
					'value'=>'',
					'description' => esc_html__( 'Team member image', 'michigan')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Team Memeber Name', 'michigan' ),
					'param_name' => 'name',
					'value'=>'',
					'description' => esc_html__( 'Team member name', 'michigan')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link URL', 'michigan' ),
					'param_name' => 'link',
					'value'=>'',
					'description' => esc_html__( 'Team member link url', 'michigan')
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Team Memeber Title', 'michigan' ),
					'param_name' => 'title',
					'value'=>'',
					'description' => esc_html__( 'Team member title', 'michigan')
			),
			array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Team Memeber Description Text', 'michigan' ),
					'param_name' => 'text',
					'value'=>'',
					'description' => esc_html__( 'Team member description text', 'michigan')
			),
			
			array(
					'type'=>'colorpicker',
					'heading'=>esc_html__('Select Background (leave bank for default color)', 'michigan'),
					'param_name'=> 'background_color',
					'value'=>'',
					'description' => esc_html__( "Select Background color", 'michigan'),
					'dependency' => array('element'=>'type','value'=>array('4')),
			
			),
			array(
				'heading' => esc_html__('Attachments', 'michigan') ,
				'description' => wp_kses( __('By enabling this option, You can set two Options.<br/>', 'michigan'), array( 'br' => array() ) ),
				'param_name' => 'attachment',
				'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
				'type' => 'checkbox',
				'std' => '',
				'dependency'	=> array( 'element' => 'type', 'value' => '5' ),
			) ,
			
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Audio', 'michigan' ),
				'param_name' => 'audio',
				'value'=>'',
				'description' => esc_html__( 'Audio file URL', 'michigan'),
				"dependency" => array('element'=>'attachment','value'=>array('enable')),
			),
			
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Download', 'michigan' ),
				'param_name' => 'download',
				'value'=>'',
				'description' => esc_html__( 'Download file URL', 'michigan'),
				"dependency" => array('element'=>'attachment','value'=>array('enable')),
			),
			
			array(
				'heading' => esc_html__('Social Icons', 'michigan') ,
				'description' => wp_kses( __('By enabling this option, Member social networks links will appear.<br/><br/>', 'michigan'), array( 'br' => array() ) ),
				'param_name' => 'social',
				'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
				'type' => 'checkbox',
				'std' => '',
			) ,
			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'First Social Name', 'michigan' ),
					'param_name' => 'first_social',
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
					'description' => esc_html__( 'Select Social Name', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'First Social URL', 'michigan' ),
					'param_name' => 'first_url',
					'value'=>'',
					'description' => esc_html__( 'First social URL', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Second Social Name', 'michigan' ),
					'param_name' => 'second_social',
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

					'description' => esc_html__( 'Select Social Name', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Second Social URL', 'michigan' ),
					'param_name' => 'second_url',
					'value'=>'',
					'description' => esc_html__( 'Second social URL', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),


			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Third Social Name', 'michigan' ),
					'param_name' => 'third_social',
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
					'description' => esc_html__( 'Select Social Name', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Third Social URL', 'michigan' ),
					'param_name' => 'third_url',
					'value'=>'',
					'description' => esc_html__( 'Third social URL', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Fourth Social Name', 'michigan' ),
					'param_name' => 'fourth_social',
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
					'description' => esc_html__( 'Select Social Name', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),

			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Fourth Social URL', 'michigan' ),
					'param_name' => 'fourth_url',
					'value'=>'',
					'description' => esc_html__( 'Fourth social URL', 'michigan'),
					"dependency" => array('element'=>'social','value'=>array('enable')),
			),


		),
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        
    ) );


?>