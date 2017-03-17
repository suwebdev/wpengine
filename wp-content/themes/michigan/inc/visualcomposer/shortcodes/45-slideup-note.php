<?php vc_map( array(
	"name" =>"SlideUp Note",
	"base" => "slideup",
	"description" => "SlideUp Note",
	"icon" => "webnus-slideup",
	"category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"params" => array(
		array(
			"type"=>'textfield',
			"heading"=>esc_html__('Title', 'michigan'),
			"param_name"=> "title",
			"value"=>"",
			"description" => esc_html__( "Note Title", 'michigan')
		),
		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Title color (leave bank for default color)', 'michigan'),
			"param_name"=> "title_color",
			"value"=>"",
			"description" => esc_html__( "Select title background color", 'michigan')
		),
		array(
			"type"=>'textarea',
			"heading"=>esc_html__('Content', 'michigan'),
			"param_name"=> "slideup_content",
			"value"=>"",
			"description" => esc_html__( "Note Content", 'michigan')	
		),    
	),
)); ?>