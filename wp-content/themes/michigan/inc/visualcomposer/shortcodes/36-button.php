<?php
vc_map( array(
	"name" =>"Webnus Button",
	"base" => "button",
	"description" => "Button shortcode",
	"category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"icon" => "webnus-button",
	"params" => array(
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Shape", 'michigan' ),
			"param_name" => "shape",
			"value" => array(
				"Default"=>"",
				"Square"=>"square",
				"Rounded"=>"rounded",
				),
			"description" => esc_html__( "Button Type", 'michigan')
			),
			
			array(
			"type" => "textarea",
			"heading" => esc_html__( "Content", 'michigan' ),
			"param_name" => "btn_content",
			"value"=>'',
			"description" => esc_html__( "Button Text Content", 'michigan')
			),
			
			array(
			"type" => "textfield",
			"heading" => esc_html__( "URL", 'michigan' ),
			"param_name" => "url",
			"value"=>'#',
			"description" => esc_html__( "Button URL Link", 'michigan')
			),
									
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Target", 'michigan' ),
			"param_name" => "target",
			"description" => esc_html__( "Button URL Target", 'michigan'),
			"value" => array(
				"Self"=>"_self",
				"Blank"=>"_blank",
				"Parent"=>"_parent",
				"Top"=>"_top",
				),
			),
			
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Color", 'michigan' ),
			"param_name" => "color",
			"description" => esc_html__( "Button Color", 'michigan'),
			"value" => array(
				"Default"=>"theme-skin",
				"Gold"=>"gold",
				"Green"=>"green",
				"Red"=>"red",
				"Blue"=>"blue",
				"Gray"=>"gray",
				"Dark gray"=>"dark-gray",
				"Cherry"=>"cherry",
				"Orchid"=>"orchid",
				"Pink"=>"pink",
				"Orange"=>"orange",
				"Teal"=>"teal",
				"SkyBlue"=>"skyblue",
				"Jade"=>"jade",
				"White"=>"white",
				"Black"=>"black",
				),
			),
									
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Size", 'michigan' ),
			"param_name" => "size",
			"description" => esc_html__( "Button Size", 'michigan'),
			"value" => array(
				"Small"=>"small",
				"Medium"=>"medium",
				"Large"=>"large",	
				),
			),

			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Bordered?", 'michigan' ),
			"param_name" => "border",
			"value"=>array('Normal'=>'false','Bordered'=>'true'),
			"description" => esc_html__( "Is button bordered?", 'michigan')
			),
			
			array(
			"type" => "iconfonts",
			"heading" => esc_html__( "Icon", 'michigan' ),
			"param_name" => "icon",
			"value"=>'',
			"description" => esc_html__( "Select Button Icon", 'michigan')
			),	
	),
));
?>