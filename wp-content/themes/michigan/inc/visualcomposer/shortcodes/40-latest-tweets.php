<?php
vc_map( array(
	'name' =>'Twitter Feed',
	'base' => 'twitterfeed',
	"description" => "Twitter feed",
	"icon" => "webnus-twitterfeed",
	'params'=>array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Twitter User Name', 'michigan' ),
			'param_name' => 'username',
			'value'=>'',
			'description' => esc_html__( 'Twitter twitter id', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Feed Count', 'michigan' ),
			'param_name' => 'count',
			'value'=>'',
			'description' => esc_html__( 'Twitter count', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Access Token', 'michigan' ),
			'param_name' => 'access_token',
			'value'=>'',
			'description' => esc_html__( 'Twitter access token', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Access Token Secret', 'michigan' ),
			'param_name' => 'access_token_secret',
			'value'=>'',
			'description' => esc_html__( 'Twitter access token secret', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Consumer Key', 'michigan' ),
			'param_name' => 'consumer_key',
			'value'=>'',
			'description' => esc_html__( 'Twitter consumer key', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Consumer Secret', 'michigan' ),
			'param_name' => 'consumer_secret',
			'value'=>'',
			'description' => esc_html__( 'Twitter consumer secret', 'michigan')
			),
		),
	'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	
	) );
	?>