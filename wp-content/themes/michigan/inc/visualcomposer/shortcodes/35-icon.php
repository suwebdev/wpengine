<?php
vc_map( array(
        "name" =>"Webnus Icon",
        "base" => "icon",
		"description" => "Vector font icon",
		"icon" => "webnus-icon",
        "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "params" => array( 
            array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Size', 'michigan'),
				"param_name"=> "size",
				"value"=>"",
				"description" => esc_html__( "Icon size in px format, Example: 16px", 'michigan')
			),
			
			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Icon color', 'michigan'),
				"param_name"=> "color",
				"value"=>"",
				"description" => esc_html__( "Select icon color", 'michigan')
			),
				array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Icon background', 'michigan'),
				"param_name"=> "bgcolor",
				"value"=>"",
				"description" => esc_html__( "Select icon background color", 'michigan')
			),
			
			array(
				'heading' => esc_html__('Align Center', 'michigan') ,
				'description' => wp_kses( __('Icon Align Center<br/><br/>', 'michigan'), array( 'br' => array() ) ),
				'param_name' => 'icon_center',
				'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
				'type' => 'checkbox',
				'std' => '',
			) ,

			array(
				'heading' => esc_html__('Icon Link', 'michigan') ,
				'description' => wp_kses( __('Enable Icon Link.<br/><br/>', 'michigan'), array( 'br' => array() ) ),
				'param_name' => 'icon_link',
				'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
				'type' => 'checkbox',
				'std' => '',
			) ,

			
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Link URL', 'michigan'),
				"param_name"=> "link",
				"value"=>"",
				"description" => esc_html__( "Icon link URL http:// ", 'michigan'),
				"dependency" => array('element'=>'icon_link','value'=>array('enable')),
			),
			
			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Link Class', 'michigan'),
				"param_name"=> "link_class",
				"value"=>"",
				"description" => esc_html__( "Icon link Class ", 'michigan'),
				"dependency" => array('element'=>'icon_link','value'=>array('enable')),
			),

			 array(
				"type"=>'textfield',
				"heading"=>esc_html__('Icon Class', 'michigan'),
				"param_name"=> "icon_class",
				"value"=>"",
				"description" => esc_html__( "Icon Class ", 'michigan')
			),
			
           array(
                "type" => "iconfonts",
                "heading" => esc_html__( "Icon", 'michigan' ),
                "param_name" => "name",
                'value'=>'',
                "description" => esc_html__( "Select Icon", 'michigan')
            ),
        ),        
    ) );
?>