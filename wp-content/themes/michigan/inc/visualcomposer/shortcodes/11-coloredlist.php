<?php
vc_map( array(
        'name' =>'Colored List',
        'base' => 'coloredlist',
		'description' => 'Introduce Ministries',
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ), 
        'icon' => 'webnus-coloredlist',
        'params'=>array(

			array(
				"type"=>'textfield',
				"heading"=>esc_html__('Number', 'michigan'),
				"description" => esc_html__( "Please enter list number ", 'michigan'),
				"param_name"=> "numlist",
				"value"=>"",
			),

			array(
				"type"=>'colorpicker',
				"heading"=>esc_html__('Background color', 'michigan'),
				"description" => esc_html__( "Select Background number color", 'michigan'),
				"param_name"=> "bgcolor",
				"value"=>"",
			),

			array(
				"type"=>'textfield',
				"heading"=>esc_html__('Content', 'michigan'),
				"description" => esc_html__( "Please enter content ", 'michigan'),
				"param_name"=> "textlist",
				"value"=>"",
			),
		),
    ) );
?>