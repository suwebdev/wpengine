<?php vc_map( array(
	'name' =>'Date Box',
	'base' => 'datebox',
	'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
	"description" => "Date and Title with text description",
	"icon" => "webnus-datebox",
	'params'=>array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'michigan' ),
			'param_name' => 'title',
			'value'=>'',
			'description' => esc_html__( 'Enter the Title', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Description', 'michigan' ),
			'param_name' => 'des',
			'value'=>'',
			'description' => esc_html__( 'Enter the Description', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Day', 'michigan' ),
			'param_name' => 'day',
			'value'=>'',
			'description' => esc_html__( 'Enter the Day', 'michigan')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Month', 'michigan' ),
			'param_name' => 'month',
			'value'=>'',
			'description' => esc_html__( 'Enter the Month', 'michigan')
		),
		
	),
)); ?>