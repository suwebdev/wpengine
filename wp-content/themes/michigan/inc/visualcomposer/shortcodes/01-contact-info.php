<?php
vc_map( array(
	"name" =>"Webnus Contact Info",
	"base" => "contact_info",
	"description" => "Webnus Contac Info",
	"icon" => "webnus-contact-info",
	"category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"params" => array( 
		array(
			"type"=>'textfield',
			"heading"=>esc_html__(' Heading Text ', 'michigan'),
			"param_name"=> "heading_text",
			"value"=>"",
			"description" => esc_html__( "Please enter heading text", 'michigan')
		),
		array(
			"type"=>'textfield',
			"heading"=>esc_html__(' Phone Number ', 'michigan'),
			"param_name"=> "phone_number",
			"value"=>"",
			"description" => esc_html__( "Please phone number", 'michigan')
		),
		array(
			"type"=>'textfield',
			"heading"=>esc_html__(' Email Address ', 'michigan'),
			"param_name"=> "email",
			"value"=>"",
			"description" => esc_html__( "Please email address ", 'michigan')
		),
		array(
			"type"=>'textfield',
			"heading"=>esc_html__(' Email URL ', 'michigan'),
			"param_name"=> "email_url",
			"value"=>"",
			"description" => esc_html__( "Please email url ", 'michigan')
		),
			
	),
    ) );
?>