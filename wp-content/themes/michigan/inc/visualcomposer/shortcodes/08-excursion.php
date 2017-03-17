<?php
vc_map( array(
	'name'			=> esc_html__( 'Webnus Excursions', 'michigan' ),
	'base'			=> 'excursion',
	'icon'			=> 'webnus-excursion',
	'description'	=> esc_html__( 'Show latest or popular Excursions', 'michigan' ),
	'category'		=> esc_html__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(

		array(
			'heading'		=> esc_html__( 'Post count', 'michigan' ),
			'description'	=> esc_html__( 'Number of excursion(s) to show. Note: When you type nothing it puts for default 8 excursions to show.', 'michigan'),
			'type'			=> 'textfield',
			'param_name'	=> 'count',
			'value'			=> '',
		),

		array(
			'heading'		=> esc_html__('Page Navigation', 'michigan') ,
			'description'	=> wp_kses( __('Enable page navigation.<br><br>', 'michigan'), array( 'br' => array() ) ),
			'type'			=> 'checkbox',
			'param_name'	=> 'navigation',
			'value'			=> array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
			'std'			=> '',
		),

	),
) );