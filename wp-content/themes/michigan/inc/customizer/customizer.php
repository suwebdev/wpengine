<?php

function michigan_webnus_customize_register( $wp_customize ) {

	class Michigan_Webnus_Customize_Description_Control extends WP_Customize_Control {
		public $type = 'description';

		public function render_content() { ?>
			<span class="description customize-control-description"><?php echo $this->label; ?></span>
			<?php
		}
	}

// Logo Settings
	$wp_customize->add_section( 'logo_settings', array(
		'title'		=> esc_html__( 'Logo', 'michigan' ),
		'priority'	=> 21,
		'description'=> esc_html__('To access more options please go to Appearance > Theme Options > Header Options', 'michigan' ),
	) );

	// Logo
	$wp_customize->add_setting( 'logo_image', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_logo', array(
		'label'		=> esc_html__( 'Upload Logo Image', 'michigan' ),
		'settings'	=> 'logo_image',
		'section'	=> 'logo_settings',
	) ) );

	// Transparent Logo
	$wp_customize->add_setting( 'transparent_logo_image', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_transparent_logo', array(
		'label'		=> esc_html__( 'Upload Transparent Logo Image', 'michigan' ),
		'settings'	=> 'transparent_logo_image',
		'section'	=> 'logo_settings',
	) ) );

	// Sticky Logo
	$wp_customize->add_setting( 'sticky_logo_image', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_sticky_logo', array(
		'label'		=> esc_html__( 'Upload Sticky Logo Image', 'michigan' ),
		'settings'	=> 'sticky_logo_image',
		'section'	=> 'logo_settings',
	) ) );

	// Logo width
	$wp_customize->add_setting( 'logo_width', array(
		'default'	=> '',
		'sanitize_callback' => 'michigan_webnus_sanitize_number',
	) );

	$wp_customize->add_control( 'logo_width', array(
		'label'		=> esc_html__( 'Logo width', 'michigan' ),
		'type'		=> 'number',
		'section'	=> 'logo_settings',
	) );

	// Transparent header logo width
	$wp_customize->add_setting( 'transparent_logo_width', array(
		'default'	=> '',
		'sanitize_callback' => 'michigan_webnus_sanitize_number',
	) );

	$wp_customize->add_control( 'transparent_logo_width', array(
		'label'		=> esc_html__( 'Transparent header logo width', 'michigan' ),
		'type'		=> 'number',
		'section'	=> 'logo_settings',
	) );

	// Sticky header logo width
	$wp_customize->add_setting( 'sticky_logo_width', array(
		'default'	=> '60',
		'sanitize_callback' => 'michigan_webnus_sanitize_number',
	) );

	$wp_customize->add_control( 'sticky_logo_width', array(
		'label'		=> esc_html__( 'Sticky header logo width', 'michigan' ),
		'type'		=> 'number',
		'section'	=> 'logo_settings',
	) );

	$wp_customize->add_setting( 'logo_description', array(
		'sanitize_callback' => 'michigan_webnus_sanitize',
	) );
	$wp_customize->add_control( new Michigan_Webnus_Customize_Description_Control( $wp_customize, 'logo_description', array(
		'label'		=> wp_kses( __( '<span style="color: red; font-weight: bold;">Note: </span>if elements which are available both in customizar and theme options get a change in customizer they\'ll be deactivated in theme options and priority is with customizer.', 'michigan' ), array( 'span' => array( 'style' => array() ) ) ),
		'settings'	=> 'logo_description',
		'section'	=> 'logo_settings',
	) ) );

// Colorskin
	$wp_customize->add_section( 'colorskin', array(
		'title'		=> esc_html__( 'Colorskin', 'michigan' ),
		'priority'	=> 22,
		'description'=> esc_html__('To access more options please go to Appearance > Theme Options > Styling Options', 'michigan' ),
	) );

	$wp_customize->add_setting( 'colorskin_description_refresh', array(
		'sanitize_callback' => 'michigan_webnus_sanitize',
	) );
	$wp_customize->add_control( new Michigan_Webnus_Customize_Description_Control( $wp_customize, 'colorskin_description_refresh', array(
		'label'		=> wp_kses( __( '<span style="color: red; font-weight: bold;">to make this feature work, you need to click on save button after setting your desired color and refresh the page</span>', 'michigan' ), array( 'span' => array( 'style' => array() ) ) ),
		'settings'	=> 'colorskin_description_refresh',
		'section'	=> 'colorskin',
	) ) );

	// Custom Colorskin
	$wp_customize->add_setting( 'enable_custom_colorskin', array(
		'sanitize_callback' => 'michigan_webnus_sanitize_checkbox',
		'priority'	=> 1,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_custom_colorskin', array(
		'label'		=> esc_html__( 'Enable Custom Color Skin?', 'michigan' ),
		'type'      => 'checkbox',
		'settings'	=> 'enable_custom_colorskin',
		'section'	=> 'colorskin',
	) ) );
	
	// Custom Colorskin
	$wp_customize->add_setting( 'custom_colorskin', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'	=> 2,
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'custom_colorskin', array(
		'label'		=> esc_html__( 'Custom Colorskin', 'michigan' ),
		'settings'	=> 'custom_colorskin',
		'section'	=> 'colorskin',
	) ) );

	// Predefined Colorskin
	$wp_customize->add_setting( 'predefined_colorskin', array(
		'default' => false,
		'sanitize_callback' => 'michigan_webnus_sanitize',
		'priority'	=> 3,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'predefined_colorskin', array(
		'label'		=> esc_html__( 'Predefined Colorskin', 'michigan' ),
		'type'           => 'radio',
		'choices'        => array(
			''			    => esc_html__( 'None', 'michigan' ),
			'#d0ae5e'		=> esc_html__( 'Gold', 'michigan' ),
			'#0093d0'		=> esc_html__( 'Blue', 'michigan' ),
			'#e53f51'		=> esc_html__( 'Red', 'michigan' ),
			'#f1c40f'		=> esc_html__( 'Yellow', 'michigan' ),
			'#e64883'		=> esc_html__( 'Pink', 'michigan' ),
			'#45ab48'		=> esc_html__( 'Green', 'michigan' ),
			'#9661ab'		=> esc_html__( 'Orchid', 'michigan' ),
			'#4ccfad'		=> esc_html__( 'Jade', 'michigan' ),
			'#0ab1f0'		=> esc_html__( 'SkyBlue', 'michigan' ),
			'#ff9934'		=> esc_html__( 'Orange', 'michigan' ),
			'#c3512f'		=> esc_html__( 'Teal', 'michigan' ),
			'#55606e'		=> esc_html__( 'DarkBlue', 'michigan' ),
			'#fe8178'		=> esc_html__( 'CoralPink', 'michigan' ),
			'#7c6853'		=> esc_html__( 'Brown', 'michigan' ),
			'#bed431'		=> esc_html__( 'GreenYellow ', 'michigan' ),
			'#2d5c88'		=> esc_html__( 'SplashBlue ', 'michigan' ),
			'#77da55'		=> esc_html__( 'Gray ', 'michigan' ),
			'#2997ab'		=> esc_html__( 'Cyan ', 'michigan' ),
			'#734854'		=> esc_html__( 'Vine ', 'michigan' ),
			'#a81010'		=> esc_html__( 'SplashRed ', 'michigan' ),
		),
		'settings'	=> 'predefined_colorskin',
		'section'	=> 'colorskin',
	) ) );

	$wp_customize->add_setting( 'colorskin_description', array(
		'sanitize_callback' => 'michigan_webnus_sanitize',
	) );
	$wp_customize->add_control( new Michigan_Webnus_Customize_Description_Control( $wp_customize, 'colorskin_description', array(
		'label'		=> wp_kses( __( '<span style="color: red; font-weight: bold;">Note: </span>if elements which are available both in customizar and theme options get a change in customizer they\'ll be deactivated in theme options and priority is with customizer.', 'michigan' ), array( 'span' => array( 'style' => array() ) ) ),
		'settings'	=> 'colorskin_description',
		'section'	=> 'colorskin',
	) ) );

}
add_action( 'customize_register', 'michigan_webnus_customize_register' );

// Sanitize number options
if ( ! function_exists( 'michigan_webnus_sanitize_number' ) ) :
function michigan_webnus_sanitize_number( $value ) {
	return ( is_numeric( $value ) ) ? $value : intval( $value );
}
endif;

// Sanitize checkbox options
if ( ! function_exists( 'michigan_webnus_sanitize_checkbox' ) ) :
function michigan_webnus_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && ( true == $checked || 'on' == $checked ) ) ? true : false );
}
endif;

// Sanitize description options
if ( ! function_exists( 'michigan_webnus_sanitize' ) ) :
function michigan_webnus_sanitize( $value ) {
	return ( ( isset( $value ) ) ? $value : '' );
}
endif;