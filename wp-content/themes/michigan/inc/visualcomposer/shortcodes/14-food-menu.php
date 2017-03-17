<?php
vc_map( array(
	'name'			=> esc_html__( 'Food Menu', 'michigan' ),
	'base'			=> 'food_menu',
	'description'	=> esc_html__( 'Food Menu', 'michigan' ),
	'icon'			=> 'webnus-food-menu',
	'category'		=> esc_html__( 'Webnus Shortcodes', 'michigan' ),
	'params'		=> array(

		array(
			'heading'		=> esc_html__( 'Title', 'michigan' ),
			'description' 	=> esc_html__( 'Food Menu Title', 'michigan'),
			'type'			=> 'textfield',
			'param_name'	=> 'title',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Show / Hide Arrows', 'michigan' ),
			'description' => esc_html__( 'Do you want hide arrows?', 'michigan'),
			'param_name' => 'arrow_none',
			'value'=> array(
				'Show'	=>	'arrow-show',
				'Hide'	=>	'arrow-hide',
				),
		),	

		array(
			'heading'		=> esc_html__( 'Food Menu Items', 'michigan' ),
			'description'	=> esc_html__( 'Enter Food Menu Items.', 'michigan' ),
			'type'			=> 'param_group',
			'param_name'	=> 'food_menu_item',
			'params' => array(
				array(
					'heading'		=> esc_html__( 'Food Name', 'michigan' ),
					'type'			=> 'textarea',
					'param_name'	=> 'food_name',
					'value'			=> '',
				),
				array(
					'type'			=> 'iconpicker',
					'heading'		=> esc_html__( 'Icon', 'michigan' ),
					'param_name'	=> 'icon_fontawesome',
					'value'			=> 'fa fa-adjust', // default value to backend editor admin_label
					'settings'		=> array(
						// default true, display an 'EMPTY' icon?
						'emptyIcon'		=> false,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						'iconsPerPage'	=> 4000,
					),
					'description'	=> esc_html__( 'Select icon from library.', 'michigan' ),
				),
				array(
					'type'			=> 'attach_image',
					'heading'		=> esc_html__( 'Image', 'michigan' ),
					'param_name'	=> 'icon_image',
					'value'			=> '',
					'description'	=> wp_kses( __( 'Select Image instead of Icons.<br>Note: If you have another Icon that not is here. You can put PNG image of that instead of these Icons.', 'michigan'), array( 'br' => array() ) ),
				),
			),
		),

) ) );