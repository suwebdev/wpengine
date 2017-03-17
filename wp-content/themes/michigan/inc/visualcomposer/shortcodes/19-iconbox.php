<?php vc_map( array(
	"name" =>"Icon Box",
	"base" => "iconbox",
	"description" => "Icon + text article",
	"icon" => "webnus-iconbox",
	"category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Type", 'michigan' ),
			"param_name" => "type",
			"value" => array(
				"Type 0"	=>'0',
				"Type 1"	=>'1',
				"Type 2"	=>'2',
				"Type 3"	=>'3',
				"Type 4"	=>'4',
				"Type 5"	=>'5',
				"Type 6"	=>'6',
				"Type 7"	=>'7',
				"Type 8"	=>'8',
				"Type 9"	=>'9',
				"Type 10"	=>'10',
				"Type 11"	=>'11',
				"Type 12"	=>'12',
				"Type 13"	=>'13',
				"Type 14"	=>'14',
				"Type 15"	=>'15',
				"Type 16"	=>'16',
				"Type 17"	=>'17',
				"Type 18"	=>'18',
				"Type 19"	=>'19',
				"Type 20"	=>'20',
				"Type 21"	=>'21',

			),
			"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan')
		),	

		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Related types 18", 'michigan' ),
			"description" => esc_html__( "You can select related types to type 18 .", 'michigan'),
			"param_name" => "background_color_t18",
			"value" => array(
				'' 										=> '',
				esc_html__( "Orange", 'michigan' ) 		=> 'orange',
				esc_html__( "Green", 'michigan' ) 		=> 'green',
				esc_html__( "Light Blue", 'michigan' ) 	=> 'lightblue',
				esc_html__( "Blue", 'michigan' ) 		=> 'blue',
			),
			"dependency" => array( 'element' => 'type', 'value' => '18' ),
		),

		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Align", 'michigan' ),
			"description" => esc_html__( "Please choose align, Left or Right", 'michigan'),
			"param_name" => "align",
			"value" => array(
				esc_html__( "right", 'michigan' ) 	=> 'right',
				esc_html__( "Left", 'michigan' ) 		=> 'left',
			),
			"dependency" => array( 'element' => 'type', 'value' => '18' ),
		),
		
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Border", 'michigan' ),
			"description" => esc_html__( "Please choose desired border", 'michigan'),
			"param_name" => "border",
			"value" => array(
				esc_html__( "Border top?", 'michigan' ) 		=> 'bordertop',
				esc_html__( "Border bottom?", 'michigan' ) 	=> 'borderbottom',
				esc_html__( "Border left?", 'michigan' ) 		=> 'borderleft',
				esc_html__( "Border right?", 'michigan' ) 	=> 'borderright',
			),
			"dependency" => array( 'element' => 'type', 'value' => '16' ),
		),
		
		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Select Color for Border (leave bank for default color)', 'michigan'),
			"param_name"=> "border_color",
			"value"=>"",
			"description" => esc_html__( "Select Border Color", 'michigan'),
			"dependency" => array('element'=>'type','value'=>array('20')),
			
		),

		 array(
			"type"=>'textfield',
			"heading"=>esc_html__('Sub Title', 'michigan'),
			"param_name"=> "icon_subtitle",
			"value"=>"",
			"description" => esc_html__( "IconBox Sub Title", 'michigan'),
			'dependency'	=> array( 'element' => 'type', 'value'=>array( '21', ) ),

		),
		array(
			"type"=>'textfield',
			"heading"=>esc_html__('Title', 'michigan'),
			"param_name"=> "icon_title",
			"value"=>"",
			"description" => esc_html__( "IconBox Title", 'michigan')
		),
		
		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Title color (leave bank for default color)', 'michigan'),
			"param_name"=> "title_color",
			"value"=>"",
			"description" => esc_html__( "Select title color", 'michigan')
		),
		
		array(
			"type"=>'textarea',
			"heading"=>esc_html__('Content', 'michigan'),
			"param_name"=> "iconbox_content",
			"value"=>"",
			"description" => esc_html__( "IconBox Content Goes Here", 'michigan')	
		),

		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Content color (leave bank for default color)', 'michigan'),
			"param_name"=> "content_color",
			"value"=>"",
			"description" => esc_html__( "Select content color", 'michigan')
		),
		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('background color (leave bank for default color)', 'michigan'),
			"description" => esc_html__( "Select background color", 'michigan'),
			"param_name"=> "bgcolor",
			"value"=>"",
			'dependency'	=> array( 'element' => 'type', 'value'=>array('19', '20') ),
		),
		
		
		 array(
			"type"=>'textfield',
			"heading"=>esc_html__('Link Text', 'michigan'),
			"param_name"=> "icon_link_text",
			"value"=>"",
			"description" => esc_html__( "IconBox Link Text", 'michigan'),
		),


		 array(
			"type"=>'textfield',
			"heading"=>esc_html__('Link URL', 'michigan'),
			"param_name"=> "icon_link_url",
			"value"=>"",
			"description" => esc_html__( "IconBox Link URL (http://example.com)", 'michigan'),
		),

		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Link color (leave bank for default color)', 'michigan'),
			"param_name"=> "link_color",
			"value"=>"",
			"description" => esc_html__( "Select link color", 'michigan'),
		),
		array(
			"type"=>'dropdown',
			"heading"=>esc_html__('Link Target', 'michigan'),
			"param_name"=> "link_target",
			"value" => array(
				"Self"=>'self',
				"Blank"=>'blank',
			),
			"description" => esc_html__( "IconBox Link URL (http://example.com)", 'michigan'),	
		),
		array(
			"type"=>'textfield',
			"heading"=>esc_html__('Icon Size (leave blank for default size)', 'michigan'),
			"param_name"=> "icon_size",
			"value"=>"",
			"description" => esc_html__( "Icon size in px format, Example: 16px", 'michigan')
			
		),
		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Icon color (leave bank for default color)', 'michigan'),
			"description" => esc_html__( "Select icon color", 'michigan'),
			"param_name"=> "icon_color",
			"value"=>"",
			
		),
		
		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Select Background For Icon (leave bank for default color)', 'michigan'),
			"param_name"=> "background_color",
			"value"=>"",
			"description" => esc_html__( "Select Background Icon color", 'michigan'),
			"dependency" => array('element'=>'type','value'=>array('17','19','20')),
			
		),

		array(
			"type" => "attach_image",
			"heading" => esc_html__( "Image", 'michigan' ),
			"param_name" => "icon_image",
			'value'=>'',
			"description" => wp_kses( __( "Select Image instead of Icons.<br>Note: If you have another Icon that not is here. You can put PNG image of that instead of these Icons.", 'michigan'), array( 'br' => array() ) )
		),
		
		array(
			"type" => "iconfonts",
			"heading" => esc_html__( "Icon", 'michigan' ),
			"param_name" => "icon_name",
			'value'=>'',
			"description" => esc_html__( "Select Icon", 'michigan')
		),
	   
	),
	
	
) );


?>