<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "michigan_webnus_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
	$theme_bg_dir = get_template_directory_uri() . '/images/bgs/bg-pattern/';

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'michigan' ),
        'page_title'           => esc_html__( 'Theme Options', 'michigan' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'michigan_webnus_theme_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        'hide_expand'			=> true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

	$ext_path = get_template_directory() . '/inc/theme-options/extensions/';
	Redux::setExtensions( $opt_name, $ext_path );

	/*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

    $keyses = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array(),
			),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
	);

	$webnus_socials = array (
		'dribbble'		=> 'dribbble',
		'facebook'		=> 'facebook',
		'flickr'		=> 'flickr',
		'foursquare'	=> 'foursquare',
		'github'		=> 'github',
		'google-plus'	=> 'google-plus',
		'instagram'		=> 'instagram',
		'lastfm'		=> 'lastfm',
		'linkedin'		=> 'linkedin',
		'pinterest'		=> 'pinterest',
		'reddit'		=> 'reddit',
		'soundcloud'	=> 'soundcloud',
		'spotify'		=> 'spotify',
		'tumblr'		=> 'tumblr',
		'twitter'		=> 'twitter',
		'vimeo'			=> 'vimeo',
		'vine'			=> 'vine',
		'yelp'			=> 'yelp',
		'yahoo'			=> 'yahoo',
		'youtube'		=> 'youtube',
		'wordpress'		=> 'wordpress',
		'dropbox'		=> 'dropbox',
		'evernote'		=> 'evernote',
		'envato'		=> 'envato',
		'skype'			=> 'skype',
		'feed'			=> 'feed',
	);

	// SSL VALUE
	$backend_protocol = ( is_ssl() ) ? 'https' : 'http' ;

	$fonts = array (
		'Open Sans,arial,helvatica' => 'Open Sans',
		'BebasRegular,arial,helvatica' => 'Bebas Regular',
		'LeagueGothicRegular,arial,helvatica' => 'League Gothic Regular',
		'Arial,helvetica,sans-serif' => 'Arial',
		'helvetica,sans-serif,arial' => 'Helvatica',
		'sans-serif,arial,helvatica' => 'Sans Serif',
		'verdana,san-serif,helvatica' => 'Verdana' ,
		'custom-font-1' => 'michigan_webnus_custom_font1',
		'Custom Font 2' => 'michigan_webnus_custom_font2',
		'Custom Font 3' => 'michigan_webnus_custom_font3',
		'typekit-font-1' => 'michigan_webnus_typekit_font1',
		'typekit-font-2' => 'michigan_webnus_typekit_font2',
		'typekit-font-3' => 'michigan_webnus_typekit_font3',
	);

    // -> START Layout Fields
    Redux::setSection( $opt_name, array(
        'title'		=> esc_html__( 'Layout', 'michigan' ),
        'desc'		=> esc_html__( 'Here are general settings of the theme:', 'michigan' ),
        'id'		=> 'layout_opts',
        'icon'		=> 'ti-layout',
        'fields'	=> array(
             array(
                'title'     => esc_html__( 'Template', 'michigan' ),
                'subtitle'  => esc_html__( 'Select your desired template from the the list.', 'michigan' ),
                'id'        => 'michigan_webnus_template_select',
                'type'      => 'select',
                'options'   => array(
                    'online'    => esc_html__( 'Online Learning', 'michigan' ),
                    'kids'      => esc_html__( 'Kids', 'michigan' ),
                    'school'    => esc_html__( 'High School', 'michigan' ),
                    'college'   => esc_html__( 'College', 'michigan' ),
                ),
                'default'  => 'online',
                'default'  => 'online',
            ),
			array(
				'title'		=> esc_html__( 'Responsive', 'michigan' ),
				'subtitle'	=> esc_html__( 'Disable this option in case you don\'t need a responsive website.', 'michigan' ),
				'id'		=> 'michigan_webnus_enable_responsive',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'CSS Minifyer', 'michigan' ),
				'subtitle'	=> esc_html__( 'Enable this option to minify your styles. It\'ll decrease size of your style-sheet files to speed up your website.', 'michigan' ),
				'id'		=> 'michigan_webnus_css_minifier',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Smooth Scroll', 'michigan' ),
				'subtitle'	=> esc_html__( 'By enabling this option, your page will have smooth scrolling effect.','michigan' ),
				'id'		=> 'michigan_webnus_enable_smoothscroll',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Layout', 'michigan' ),
				'subtitle'	=> esc_html__( 'Select boxed or wide layout. in Boxed you can set background from "Styling Options > Background".','michigan' ),
				'id'		=> 'michigan_webnus_background_layout',
				'type'		=> 'button_set',
				'default'	=> 'wide',
				'options'	=> array(
					'wide'			 => esc_html__( 'Wide', 'michigan' ),
					'boxed-wrap' => esc_html__( 'Boxed', 'michigan' ),
				),
			),
			array(
				'title'		=> esc_html__( 'Container max-width', 'michigan' ),
				'subtitle'	=> esc_html__( 'You can define width of your website. ( Max width: 1170px )','michigan' ),
				'id'		=> 'michigan_webnus_container_width',
				'type'		=> 'text',
			),
            array(
                'id'        => 'michigan_webnus_scrollup',
                'title'     => esc_html__('Scroll To Top', 'michigan'),
                'subtitle'  => esc_html__('Enable or Disable Scroll To Top Arrow.', 'michigan'),
                'type'      => 'switch',
                'on'        => esc_html__( 'Enabled', 'michigan' ),
                'off'       => esc_html__( 'Disabled', 'michigan' ),
                'default'   => '1',
                'default'   => '1',
            ),
        ),
    ) );



	// -> START Header Options Fields
    Redux::setSection( $opt_name, array(
        'title'		=> esc_html__( 'Header Options', 'michigan' ),
        'desc'		=> esc_html__( 'Everything about headers, Logo, Menus and contact information are here:', 'michigan' ),
        'id'		=> 'header_opts',
        'icon'		=> 'ti-layout-tab-window',
	));

	Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Logo', 'michigan' ),
	'id'               => 'header_general_opts',
	'subsection'       => true,
	'fields'			=> array(
			array(
				'title'		=> esc_html__( 'Logo', 'michigan' ),
				'subtitle'	=> esc_html__( 'Choose an image file for your logo. For Retina displays please add Image in large size and set custom width.', 'michigan' ),
				'id'		=> 'michigan_webnus_logo',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Logo width', 'michigan' ),
				'id'		=> 'michigan_webnus_logo_width',
				'type'		=> 'text',
				'validate'	=> 'numeric',
			),
			array(
				'title'		=> esc_html__( 'Transparent logo', 'michigan' ),
				'subtitle'	=> esc_html__( 'Choose an image file for your Transparent header logo and Header Type 11', 'michigan' ),
				'id'		=> 'michigan_webnus_transparent_logo',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Transparent logo width', 'michigan' ),
				'id'		=> 'michigan_webnus_transparent_logo_width',
				'type'		=> 'text',
				'validate'	=> 'numeric',
			),
            array(
                'title'     => esc_html__( 'Trendy header logo', 'michigan' ),
                'subtitle'  => esc_html__( 'Choose an image file for your Trendy header logo and Header Type 12', 'michigan' ),
                'id'        => 'michigan_webnus_trendy_logo',
                'type'      => 'media',
                'url'       => true,
            ),
            array(
                'title'     => esc_html__( 'Trendy logo width', 'michigan' ),
                'id'        => 'michigan_webnus_trendy_logo_width',
                'type'      => 'text',
                'validate'  => 'numeric',
            ),
			array(
				'title'		=> esc_html__( 'Header padding-top', 'michigan' ),
				'id'		=> 'michigan_webnus_header_padding_top',
				'type'		=> 'text',
			),
			array(
				'title'		=> esc_html__( 'Header padding-bottom', 'michigan' ),
				'id'		=> 'michigan_webnus_header_padding_bottom',
				'type'		=> 'text',
			),
			array(
				'title'		=> esc_html__( 'Text logo', 'michigan' ),
				'id'		=> 'michigan_webnus_slogan',
				'subtitle'	=> esc_html__( 'If you do not set logo, this text appears instead of that.' ),
				'type'		=> 'text',
			),
        ),
    ) );

	Redux::setSection( $opt_name, array(
		'title'            => __( 'Header Layout', 'michigan' ),
		'id'               => 'header_layout_opts',
		'subsection'       => true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Select Header Layout', 'michigan' ),
				'id'		=> 'michigan_webnus_header_menu_type',
				'type'		=> 'image_select',
				'options'	=> array(
					'0' => array(
						'alt' => 'Header Type 0',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu0.png'
					),
					'1' => array(
						'alt' => 'Header Type 1',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu1.png'
					),
					'2' => array(
						'alt' => 'Header Type 2',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu2.png'
					),
					'3' => array(
						'alt' => 'Header Type 3',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu3.png'
					),
					'4' => array(
						'alt' => 'Header Type 4',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu4.png'
					),
					'5' => array(
						'alt' => 'Header Type 5',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu5.png'
					),
					'6' => array(
						'alt' => 'Header Type 6',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu6.png'
					),
					'7' => array(
						'alt' => 'Header Type 7',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu7.png'
					),
					'8' => array(
						'alt' => 'Header Type 8',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu8.png'
					),
					'9' => array(
						'alt' => 'Header Type 9',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu9.png'
					),
					'10' => array(
						'alt' => 'Header Type 10',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu10.png'
					),
					'11' => array(
						'alt' => 'Header Type 11',
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu11.png'
					),
                    '12' => array(
                        'alt' => 'Header Type 12',
                        'img' => ReduxFramework::$_url . '../webnus-options/assets/img/menu12.png'
                    ),
				),
				'default'		=> '10',
				'full_width'	=> true,
			),
			array(
				'id'     => 'opt-notice-warning',
				'type'   => 'info',
				'notice' => false,
				'style'  => 'warning',
				'title'  => __( 'Set Menus', 'michigan' ),
				'desc'   => __( 'After saving your setting, please go to "Appearance > Menus" and create menus then set them to Duplex Menu Left and Right.', 'michigan' ),
				'required'  => array( 'michigan_webnus_header_menu_type', '=', '8' ),
			),
			array(
				'title'		=> esc_html__( 'Submenu Style', 'michigan' ),
				'subtitle'	=> esc_html__( 'For Header Menu and Topbar Menu' ),
				'id'		=> 'michigan_webnus_dark_submenu',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options' => array(
					'0' => 'Light',
					'1' => 'Dark',
				 ),
			),
            array(
                'title'     => esc_html__( 'Header Bottom', 'michigan' ),
                'id'        => 'michigan_webnus_header_bottom',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enable', 'michigan' ),
                'off'       => esc_html__( 'Disable', 'michigan' ),
                'required'  => array( 'michigan_webnus_header_menu_type', '=', array('10') ),
            ),

            array(
                'title'     => esc_html__( 'Search just in courses?', 'michigan' ),
                'id'        => 'michigan_webnus_header_bottom_search',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enable', 'michigan' ),
                'off'       => esc_html__( 'Disable', 'michigan' ),
                'required'  => array( 'michigan_webnus_header_bottom', '=', '1' ),
            ),

			array(
				'title'		=> esc_html__( 'Header Background Image', 'michigan' ),
				'id'		=> 'michigan_webnus_header_background',
				'type'		=> 'media',
				'url'		=> true,
				'required'  => array( 'michigan_webnus_header_menu_type', '=', '6' ),
			),
			array(
				'id'		=> 'michigan_webnus_header_logo_alignment',
				'type'		=> 'button_set',
				'title'		=> __('Logo Alignment', 'michigan'),
				'subtitle'	=> __('This option changes the position of the logo on top of the header.', 'michigan'),
				'options'	=> array(
					'1'		=> 'Left',
					'2'		=> 'Center',
					'3'		=> 'Right'
				 ),
				'default'	=> '2',
				'required'  => array( 'michigan_webnus_header_menu_type', '=', array('2','3','4','5','9') ),
			),
			array(
				'id'		=> 'michigan_webnus_header_search_enable',
				'title'		=> __('Search in Header', 'michigan'),
				'subtitle'	=> __('This option shows a search icon at the end of the header menu.', 'michigan'),
				'type'		=> 'switch',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
				'default'	=> '0',
			),
			array(
				'id'		=> 'michigan_webnus_header_woocart_enable',
				'title'		=> __('Wocommerce cart in Header', 'michigan'),
				'subtitle'	=> __('This option shows a woocommerce cart icon at top of the header menu.', 'michigan'),
				'type'		=> 'switch',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
				'default'	=> '0',
				'required'  => array( 'michigan_webnus_header_menu_type', '=', array('12') ),
			),
			array(
				'id'		=> 'michigan_webnus_header_logo_rightside',
				'title'		=> __('Header Next Side Space', 'michigan'),
				'type'		=> 'button_set',
				'options'	=> array(
					'0'		=> 'None',
					'1'		=> 'Search Box',
					'2'		=> 'Contact Information',
					'3'		=> 'Header Sidebar'
				 ),
				'default'	=> '2',
				'required'  => array( 'michigan_webnus_header_menu_type', '=', array('2','3','4','5','9','12') ),
			),
			array(
				'id'		=> 'michigan_webnus_header_address',
				'title'		=> __('Header Address', 'michigan'),
				'type'		=> 'textarea',
				'default'	=> '1044 West 23th Street<br> Suite 721 New York NY 10010 ',
				'allowed_html' => array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br'	=> array(),
					'em'	=> array(),
					'strong'=> array()
				),
				'required'  => array( 'michigan_webnus_header_logo_rightside', '=', array('2') ),
			),
			array(
				'id'		=> 'michigan_webnus_header_phone',
				'title'		=> __('Header Phone Number', 'michigan'),
				'type'		=> 'textarea',
				'default'	=> '+1 (0) 101 1234 123 <br>+1 (0) 101 1234 321',
				'allowed_html' => array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array()
				),
				'required'	=> array( 'michigan_webnus_header_logo_rightside', '=', array('2') ),
			),
			array(
				'id'		=> 'michigan_webnus_header_email',
				'title'		=> __('Header Email Address', 'michigan'),
				'type'		=> 'textarea',
				'default'	=> 'info@your-domain.com<br> support@your-domain.com',
				'allowed_html' => array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array()
				),
				'required'	=> array( 'michigan_webnus_header_logo_rightside', '=', array('2') ),
			),

            array(
                'title'     => esc_html__( 'Button in Header', 'michigan' ),
                'id'        => 'michigan_webnus_header_button_enable',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enable', 'michigan' ),
                'off'       => esc_html__( 'Disable', 'michigan' ),
                'required'  => array( 'michigan_webnus_header_menu_type', '=', array('1','2','3','4','5','9','12') ),
            ),

            array(
                'title'     => esc_html__('Button in Header Label', 'michigan'),
                'id'        => 'michigan_webnus_header_button_label',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_header_button_enable', '=', '1' ),
            ),

            array(
                'title'     => esc_html__('Button in Header URL', 'michigan'),
                'id'        => 'michigan_webnus_header_button_url',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_header_button_enable', '=', '1' ),
            ),

			array(
				'title'		=> esc_html__( 'AJAX Live Search', 'michigan' ),
				'id'		=> 'michigan_webnus_enable_livesearch',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enable', 'michigan' ),
				'off'		=> esc_html__( 'Disable', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Mobile Menu', 'michigan' ),
				'subtitle'	=> 'Choose between two type of menu style for mobile and tablet sizes.',
				'id'		=> 'michigan_webnus_header_menu_icon',
				'type'		=> 'image_select',
				'options'	=> array(
					'sm-rgt-ms'      => array(
						'alt'  => 'Modern',
						'img'  => ReduxFramework::$_url . '../webnus-options/assets/img/menu-icon1.png'
					),
					''      => array(
						'alt'  => 'Classic',
						'img'  => ReduxFramework::$_url . '../webnus-options/assets/img/menu-icon2.png'
					),

				),
				'default'	=> 'sm-rgt-ms',
			),
		),
	));

	Redux::setSection( $opt_name, array(
	'title'            => __( 'Sticky Header', 'michigan' ),
	'id'               => 'header_menu_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Sticky Header', 'michigan' ),
				'subtitle'	=> esc_html__( 'Sticky header is a fixed header when scrolling the page.By enabling this option when you are scrolling, the header menu will scroll too.', 'michigan' ),
				'id'		=> 'michigan_webnus_header_sticky',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Sticky header logo', 'michigan' ),
				'subtitle'	=> esc_html__( 'Use this option to upload a logo which will be used when header is on sticky state.', 'michigan' ),
				'id'		=> 'michigan_webnus_sticky_logo',
				'type'		=> 'media',
				'url'		=> true,
				'required'	=> array( 'michigan_webnus_header_sticky', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Sticky header logo width', 'michigan' ),
				'id'		=> 'michigan_webnus_sticky_logo_width',
				'type'		=> 'text',
				'validate'	=> 'numeric',
				'required'  => array( 'michigan_webnus_header_sticky', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Scrolls value to sticky the header', 'michigan' ),
				'subtitle'	=> esc_html__( 'Fill your desired amount which by scrolling that amount, sticky menu will appear.', 'michigan' ),
				'type'		=> 'text',
				'id'		=> 'michigan_webnus_header_sticky_scrolls',
				'validate'	=> 'numeric',
				'default'	=> '380',
				'required'  => array( 'michigan_webnus_header_sticky', '=', '1' ),
			),
		),
    ) );


	Redux::setSection( $opt_name, array(
	'title'            => __( 'Topbar', 'michigan' ),
	'id'               => 'topbar_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'TopBar', 'michigan' ),
				'subtitle'	=> esc_html__( 'Top bar is the topmost location in your website that you can place special elements in.', 'michigan' ),
				'id'		=> 'michigan_webnus_header_topbar_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),

			array(
				'title'		=> esc_html__( 'Background Color', 'michigan' ),
				'subtitle'	=> esc_html__( 'This option changes the background color of Topbar.', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_background_color',
				'type'		=> 'color',
				'output'	=> array(
					'background-color' => '#wrap .top-bar',
				),
			),

			array(
				'title'		=> esc_html__( 'Fixed TopBar', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_fixed',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Search Bar', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_search',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Login Modal', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_login',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Login Modal Link Text', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_login_text',
				'type'		=> 'text',
				'default'	=> 'Login / Register',
				'required'  => array( 'michigan_webnus_topbar_login', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Contact Modal', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_contact',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

            array(
                'title'     => esc_html__( 'Contact Modal Text', 'michigan' ),
                'id'        => 'michigan_webnus_topbar_contact_text',
                'type'      => 'text',
                'default'   => 'CONTACT',
                'required'  => array( 'michigan_webnus_topbar_contact', '=', array('left','right') ),
            ),

			array(
				'title'		=> esc_html__( 'Select Contact Form', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_form',
				'type'		=> 'select',
				'data'      => 'posts',
                'args'      => array( 'post_type' => 'wpcf7_contact_form', ),
				'required'  => array( 'michigan_webnus_topbar_contact', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Contact Information', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_info',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Contact Phone Number', 'michigan' ),
				'type'		=> 'text',
				'id'		=> 'michigan_webnus_topbar_phone',
				'default'	=> '+1 234 56789',
				'required'  => array( 'michigan_webnus_topbar_info', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Contact Email Address', 'michigan' ),
				'type'		=> 'text',
				'id'		=> 'michigan_webnus_topbar_email',
				'default'	=> 'info@site.com',
				'required'  => array( 'michigan_webnus_topbar_info', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Topbar Menu', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_menu',
				'subtitle'	=> esc_html__( 'you should create Topbar Menu from apearance > menus.'),
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Language Bar', 'michigan' ),
				'subtitle'	=> esc_html__( 'Polylang / WPML'),
				'id'		=> 'michigan_webnus_topbar_language',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Custom Text', 'michigan' ),
				'id'		=> 'michigan_webnus_topbar_custom',
				'type'		=> 'button_set',
				'default'	=> '',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				 ),
			),

			array(
				'title'		=> esc_html__( 'Your Custom Text', 'michigan' ),
				'subtitle'	=> esc_html__( 'Insert any text'),
				'id'		=> 'michigan_webnus_topbar_text',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_topbar_custom', '=', array('left','right') ),
			),

			array(
				'title'		=> esc_html__( 'Social Icons', 'michigan' ),
				'subtitle'	=> esc_html__( 'Set in Social Networks Tab'),
				'id'		=> 'michigan_webnus_topbar_social',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options' => array(
					'' => 'None',
					'left' => 'Left',
					'right' => 'Right'
				),
			),
		),
    ) );

	Redux::setSection( $opt_name, array(
	'title'            => __( 'Toggle Top Area', 'michigan' ),
	'id'               => 'toggle_top_area_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Toggle Top Area', 'michigan' ),
				'subtitle'	=> esc_html__( 'It loads a small plus icon to the top right corner of your website.By clicking on it, it opens and shows your content that you set before.','michigan' ),
				'id'		=> 'michigan_webnus_toggle_toparea_enable',
				'type'		=> 'switch',
				'default'	=> 0,
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
		),
    ) );

	Redux::setSection( $opt_name, array(
	'title'				=> esc_html__( 'Favicon and Apple Icons', 'michigan' ),
	'id'				=> 'fav_icons_opts',
	'subsection'		=> true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Custom Favicon', 'michigan' ),
				'subtitle'	=> esc_html__( 'An icon that will show in your browser tab near to your websites title, icon size is : (16 X 16)px','michigan' ),
				'id'		=> 'michigan_webnus_fav_icon',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Apple iPhone Icon', 'michigan' ),
				'subtitle'	=> esc_html__( 'Icon for Apple iPhone (57px x 57px)', 'michigan' ),
				'id'		=> 'michigan_webnus_apple_iphone_icon',
				'type'		=> 'media',
				'url'		=> true,
			),
			array(
				'title'		=> esc_html__( 'Apple iPad Icon', 'michigan' ),
				'subtitle'	=> esc_html__( 'Icon for Apple iPad (72px x 72px)', 'michigan' ),
				'id'		=> 'michigan_webnus_apple_ipad_icon',
				'type'		=> 'media',
				'url'		=> true,
			),
		),
    ) );


	Redux::setSection( $opt_name, array(
	'title'            => __( 'Admin Login Logo', 'michigan' ),
	'id'               => 'admin_logo_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Admin Login Logo', 'michigan' ),
				'subtitle'	=> esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'michigan' ),
				'id'		=> 'michigan_webnus_admin_login_logo',
				'type'		=> 'media',
				'url'		=> true,
			),
		),
    ) );

	Redux::setSection( $opt_name, array(
	'title'            => __( 'News Ticker', 'michigan' ),
	'id'               => 'header_newsticker_opts',
	'subsection'       => true,
	'fields'	=> array(
			array(
				'title'		=> esc_html__( 'News Ticker', 'michigan' ),
				'id'		=> 'michigan_webnus_news_ticker',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),

			array(
				'title'		=> esc_html__( 'News Ticker Title', 'michigan' ),
				'type'		=> 'text',
				'id'		=> 'michigan_webnus_nt_title',
				'default'	=> 'Latest Posts',
				'required'  => array( 'michigan_webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Show in', 'michigan' ),
				'id'		=> 'michigan_webnus_nt_show',
				'type'		=> 'button_set',
				'required'  => array( 'michigan_webnus_news_ticker', '=', '1' ),
				'type'		=> 'button_set',
				'default'	=> '0',
				'options' => array(
					'0' => 'Home',
					'1' => 'All Pages',
				 ),
			),

			array(
				'title'		=> esc_html__( 'Category', 'michigan' ),
				'subtitle'	=> esc_html__( 'Select specific category, leave blank to show all categories.' ),
				'id'		=> 'michigan_webnus_nt_cat',
				'type'		=> 'select',
				'data'		=> 'category',
				'required'  => array( 'michigan_webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Post Count', 'michigan' ),
				'type'		=> 'text',
				'id'		=> 'michigan_webnus_nt_count',
				'validate' => 'numeric',
				'default'	=> '5',
				'required'  => array( 'michigan_webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Animation Type', 'michigan' ),
				'id'		=> 'michigan_webnus_nt_effect',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options' => array(
					'0' => 'Fade',
					'1' => 'Reveal',
				 ),
				'required'  => array( 'michigan_webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Animation Speed	', 'michigan' ),
				'type'		=> 'text',
				'id'		=> 'michigan_webnus_nt_speed',
				'validate' => 'numeric',
				'default'	=> '1',
				'required'  => array( 'michigan_webnus_news_ticker', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Pause On Items', 'michigan' ),
				'type'		=> 'text',
				'id'		=> 'michigan_webnus_nt_pause',
				'validate' => 'numeric',
				'default'	=> '2',
				'required'  => array( 'michigan_webnus_news_ticker', '=', '1' ),
			),

		),
    ) );


	// -> START Footer Options Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer Options', 'michigan' ),
		'id'		=> 'start_footer_opts',
		'icon'		=> 'ti-layout-accordion-merged',
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer Top Area', 'michigan' ),
		'id'		=> 'footer_top_area_opts',
		'subsection'=> true,
		'fields'	=> array(
            array(
                'title'     => esc_html__('Footer Contact Info', 'michigan'),
                'id'        => 'michigan_webnus_footer_contact_info',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'michigan' ),
                'off'       => esc_html__( 'Hide', 'michigan' ),
            ),
            array(
                'id'        => 'michigan_webnus_footer_contact_address',
                'title'     => __('Footer Address', 'michigan'),
                'type'      => 'textarea',
                'default'   => '<strong>1234 North Avenue Luke Lane</strong><br>South Bend, IN 360001',
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br'    => array(),
                    'em'    => array(),
                    'strong'=> array()
                ),
                'required'  => array( 'michigan_webnus_footer_contact_info', '=', '1' ),
            ),
            array(
                'id'        => 'michigan_webnus_footer_contact_phone',
                'title'     => __('Footer Phone Number', 'michigan'),
                'type'      => 'textarea',
                'default'   => '<strong>987.654.3216</strong><br>987.654.3217',
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array()
                ),
                'required'  => array( 'michigan_webnus_footer_contact_info', '=', '1' ),
            ),
            array(
                'id'        => 'michigan_webnus_footer_contact_email',
                'title'     => __('Footer Email Address', 'michigan'),
                'type'      => 'textarea',
                'default'   => '<strong>info@easyseo.com</strong><br>support@easyseo.com',
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array()
                ),
                'required'  => array( 'michigan_webnus_footer_contact_info', '=', '1' ),
            ),
			array(
				'title'		=> esc_html__('Footer Social Bar', 'michigan'),
				'subtitle'	=> esc_html__('Set in Social Networks Tab.', 'michigan'),
				'id'		=> 'michigan_webnus_footer_social_bar',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Footer Instagram Bar', 'michigan'),
				'id'		=> 'michigan_webnus_footer_instagram_bar',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Instagram Username', 'michigan'),
				'id'		=> 'michigan_webnus_footer_instagram_username',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_footer_instagram_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Instagram Access Token', 'michigan'),
				'subtitle'	=> wp_kses( __('Get the this information <a target="_blank" href="' . $backend_protocol . '://www.pinceladasdaweb.com.br/instagram/access-token/">here</a>.', 'michigan'), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'id'		=> 'michigan_webnus_footer_instagram_access',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_footer_instagram_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Footer Subscribe Bar', 'michigan'),
				'id'		=> 'michigan_webnus_footer_subscribe_bar',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Footer Subscribe Title', 'michigan'),
				'id'		=> 'michigan_webnus_footer_subscribe_text',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_footer_subscribe_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Subscribe Service', 'michigan'),
				'id'		=> 'michigan_webnus_footer_subscribe_type',
				'type'		=> 'button_set',
				'default'	=> 'FeedBurner',
				'options'	=> array(
					'FeedBurner'	=> esc_html__( 'FeedBurner', 'michigan' ),
					'MailChimp'		=> esc_html__( 'MailChimp', 'michigan' ),
				),
				'required'  => array( 'michigan_webnus_footer_subscribe_bar', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Feedburner ID', 'michigan'),
				'id'		=> 'michigan_webnus_footer_feedburner_id',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_footer_subscribe_type', '=', 'FeedBurner' ),
			),
			array(
				'title'		=> esc_html__('Mailchimp URL', 'michigan'),
				'sub_desc'	=> esc_html__('Mailchimp form action URL', 'michigan'),
				'id'		=> 'michigan_webnus_footer_mailchimp_url',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_footer_subscribe_type', '=', 'MailChimp' ),
			),
            array(
                'title'     => esc_html__( 'Footer Twitter Bar', 'michigan' ),
                'id'        => 'michigan_webnus_footer_twitter_bar',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'michigan' ),
                'off'       => esc_html__( 'Hide', 'michigan' ),
            ),
            array(
                'title'     => esc_html__('Twitter Username', 'michigan'),
                'id'        => 'michigan_webnus_footer_twitter_username',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_footer_twitter_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Twitter Access Token', 'michigan'),
                'id'        => 'michigan_webnus_footer_twitter_access_token',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_footer_twitter_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Twitter Access Token Secret', 'michigan'),
                'id'        => 'michigan_webnus_footer_twitter_access_token_secret',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_footer_twitter_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Twitter consumer key', 'michigan'),
                'id'        => 'michigan_webnus_footer_twitter_consumer_key',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_footer_twitter_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Twitter consumer secret', 'michigan'),
                'id'        => 'michigan_webnus_footer_twitter_consumer_secret',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_footer_twitter_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Twitter count', 'michigan'),
                'id'        => 'michigan_webnus_footer_twitter_count',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_footer_twitter_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Twitter Background Image', 'michigan' ),
                'subtitle'  => esc_html__( 'Please choose an image or insert an image url to use for the twitter backgroud.', 'michigan' ),
                'id'        => 'michigan_webnus_footer_twitter_background_image',
                'type'      => 'media',
                'url'       => true,
                'required'  => array( 'michigan_webnus_footer_twitter_bar', '=', '1' ),
            ),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer', 'michigan' ),
		'id'		=> 'footer_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Footer Type', 'michigan' ),
				'subtitle'	=> wp_kses( __( 'Choose among these structures (1column, 2column, 3column and 4column) for your footer section.<br>To filling these column sections you should go to appearance > widget. And put every widget that you want in these sections.','michigan'), array( 'br' => array() ) ),
				'id'		=> 'michigan_webnus_footer_type',
				'type'		=> 'image_select',
				'full_width'=> true,
				'default'	=> '1',
				'options'  => array(
					'1' => array(
						'alt' => esc_html__( 'Footer Layout 1', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer1.png'
					),
					'2' => array(
						'alt' => esc_html__( 'Footer Layout 2', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer2.png'
					),
					'3' => array(
						'alt' => esc_html__( 'Footer Layout 3', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer3.png'
					),
					'4' => array(
						'alt' => esc_html__( 'Footer Layout 4', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer4.png'
					),
					'5' => array(
						'alt' => esc_html__( 'Footer Layout 5', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer5.png'
					),
					'6' => array(
						'alt' => esc_html__( 'Footer Layout 6', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/footer6.png'
					),
				),
			),
			array(
				'title'		=> esc_html__( 'Footer background color', 'michigan' ),
				'subtitle'	=> esc_html__( 'Pick a background color', 'michigan' ),
				'id'		=> 'michigan_webnus_footer_background_color',
				'type'		=> 'color',
				'output'	=> array(
					'background-color' => '#wrap #footer',
				),
			),
			array(
				'title'		=> esc_html__( 'Footer Backgruond Color Style', 'michigan'),
				'id'		=> 'michigan_webnus_footer_color',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options'	=> array(
					'1' => esc_html__( 'Dark', 'michigan' ),
					'2' => esc_html__( 'Light', 'michigan' ),
				),
			),
            array(
                'title'     => esc_html__( 'Footer Background Image', 'michigan' ),
                'subtitle'  => esc_html__( 'Please choose an image or insert an image url to use for the footer backgroud.', 'michigan' ),
                'id'        => 'michigan_webnus_footer_background_image',
                'type'      => 'media',
                'url'       => true,
            ),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Footer Bottom Area', 'michigan' ),
		'id'		=> 'footer_bottom_area_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Footer Bottom', 'michigan' ),
				'subtitle'	=> esc_html__( 'This option shows a section below the footer that you can put copyright menu and logo in it.', 'michigan' ),
				'id'		=> 'michigan_webnus_footer_bottom_enable',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Footer bottom background color', 'michigan'),
				'subtitle'	=> esc_html__('Pick a background color', 'michigan'),
				'id'		=> 'michigan_webnus_footer_bottom_background_color',
				'type'		=> 'color',
				'required'  => array( 'michigan_webnus_footer_bottom_enable', '=', '1' ),
				'output'	=> array(
					'background-color' => '#wrap #footer .footbot',
				),
			),
			array(
				'title'		=> esc_html__('Footer Bottom Left', 'michigan'),
				'id'		=> 'michigan_webnus_footer_bottom_left',
				'type'		=> 'button_set',
				'default'	=> '3',
				'options'	=> array(
					'1' => esc_html__( 'Logo', 'michigan' ),
					'2' => esc_html__( 'Menu', 'michigan' ),
					'3' => esc_html__( 'Custom Text', 'michigan' ),
					'4' => esc_html__( 'Social Icons', 'michigan' ),
				),
				'required'  => array( 'michigan_webnus_footer_bottom_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Footer Bottom Right', 'michigan'),
				'id'		=> 'michigan_webnus_footer_bottom_right',
				'type'		=> 'button_set',
				'default'	=> '1',
				'options'	=> array(
					'1' => esc_html__( 'Logo', 'michigan' ),
					'2' => esc_html__( 'Menu', 'michigan' ),
					'3' => esc_html__( 'Custom Text', 'michigan' ),
					'4' => esc_html__( 'Social Icons', 'michigan' ),
				),
				'required'  => array( 'michigan_webnus_footer_bottom_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Footer Logo', 'michigan'),
				'subtitle'	=> esc_html__('Please choose an image file for footer logo.', 'michigan'),
				'id'		=> 'michigan_webnus_footer_logo',
				'type'		=> 'media',
				'url'		=> true,
				'required'  => array( 'michigan_webnus_footer_bottom_enable', '=', '1' ),
			),
            array(
                'title'     => esc_html__('Footer Logo width', 'michigan'),
                'id'        => 'michigan_webnus_footer_logo_width',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_footer_bottom_enable', '=', '1' ),
            ),
			array(
				'title'		=> esc_html__('Footer Custom Text', 'michigan'),
				'id'		=> 'michigan_webnus_footer_copyright',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_footer_bottom_enable', '=', '1' ),
			),
		),
	) );


    // -> START Learning Options Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Learning Options', 'michigan' ),
        'desc'      => esc_html__( 'Everything about Learning are here:', 'michigan' ),
        'id'        => 'laerning_opts',
        'icon'      => 'ti-agenda',
    ));

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Course Options', 'michigan' ),
        'id'        => 'course_opt',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'    => esc_html__( 'Course Features', 'michigan' ),
                'id'       => 'michigan_webnus_course_features',
                'type'     => 'checkbox',
                'options'  => array(
                    'date'          => esc_html__('Course Date','michigan'),
                    'capacity'      => esc_html__('Course Capacity','michigan'),
                    'code'          => esc_html__('Course Code','michigan'),
                    'views'         => esc_html__('Course View','michigan'),
                    'students'      => esc_html__('Course Students','michigan'),
                    'tags'          => esc_html__('Tags Bar','michigan'),
                    'price'         => esc_html__('Price Widget','michigan'),
                    'instructor'    => esc_html__('Instructor Widget','michigan'),
                    'duration'      => esc_html__('Course Duration','michigan'),
                    'difficulty'    => esc_html__('Course Difficulty','michigan'),
                    'category'      => esc_html__('Course Category','michigan'),
                    'rating'        => esc_html__('Course Rating','michigan'),
                    'instructors'   => esc_html__('Course Instructors','michigan'),
                    'comment'       => esc_html__('Comment Section','michigan'),
                    'enrolled'      => esc_html__('Enrolled Widget','michigan'),
                    'sharing'       => esc_html__('Sharing Widget','michigan'),
                ),
            ),
            array(
                'id'        => 'michigan_webnus_course_taking',
                'title'     => __('Taking Course', 'michigan'),
                'type'      => 'button_set',
                'options'   => array(
                    '0'     => 'None',
                    '1'     => 'LifterLMS',
                    '2'     => 'Custom',
                 ),
                'default'   => '0',
            ),
            array(
                'title'     => esc_html__('Taking Course Custom URL', 'michigan'),
                'id'        => 'michigan_webnus_course_taking_custom',
                'type'      => 'text',
                'required'  => array( 'michigan_webnus_course_taking', '=', '2' ),
            ),
            array(
                'title'     => esc_html__( 'Course Breadcrumb', 'michigan' ),
                'subtitle'  => esc_html__( 'Show Breadcrumb in Course, Lesson and Quiz.','michigan' ),
                'id'        => 'michigan_webnus_enable_breadcrumbs',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'michigan' ),
                'off'       => esc_html__( 'Hide', 'michigan' ),
            ),
            array(
                'id'        => 'michigan_webnus_course_no_image',
                'title'     => __('Default Blank Featured Image', 'michigan'),
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enable', 'michigan' ),
                'off'       => esc_html__( 'Disable', 'michigan' ),
            ),
            array(
                'title'     => esc_html__( 'Custom Default Blank Featured Image', 'michigan' ),
                'id'        => 'michigan_webnus_course_no_image_src',
                'type'      => 'media',
                'url'       => true,
                'required'  => array( 'michigan_webnus_course_no_image', '=', '1' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Lesson Options', 'michigan' ),
        'id'        => 'lesson_opt',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'    => esc_html__( 'lesson Features', 'michigan' ),
                'id'       => 'michigan_webnus_lesson_features',
                'type'     => 'checkbox',
                'options'  => array(
                    'image'         => esc_html__('Lesson Image','michigan'),
                    'comment'       => esc_html__('Lesson Comment','michigan'),
                    'date'          => esc_html__('Lesson Date','michigan'),
                    'instructor'    => esc_html__('Lesson Instructor','michigan'),
                ),
            ),
        ),
    ) );


    // -> START Extra Options Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Extra Options', 'michigan' ),
        'id'        => 'extra_opts',
        'icon'      => 'ti-clip',
    ));

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Booking Options', 'michigan' ),
        'id'        => 'booking_opt',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'    => esc_html__( 'Event Booking', 'michigan' ),
                'id'       => 'michigan_webnus_booking_enable',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enable', 'michigan' ),
                'off'       => esc_html__( 'Disable', 'michigan' ),
            ),
            array(
                'title'     => esc_html__( 'Select Booking Form', 'michigan' ),
                'id'        => 'michigan_webnus_booking_form',
                'type'      => 'select',
                'data'      => 'posts',
                'args'      => array( 'post_type' => 'wpcf7_contact_form', ),
                'required'  => array( 'michigan_webnus_booking_enable', '=', '1' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Author Permalink', 'michigan' ),
        'id'        => 'author_opt',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__('Author Base', 'michigan'),
                'id'        => 'michigan_webnus_author_permalink',
                'type'      => 'text',
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Goal Options', 'michigan' ),
        'id'        => 'goals_opt',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__('Single Goal Sidebar', 'michigan'),
                'id'        => 'michigan_webnus_singlegoal_sidebar',
                'type'      => 'button_set',
                'options'   => array(
                    '0'     => 'None',
                    '1'     => 'left',
                    '2'     => 'right',
                ),
                'default'   => '0',
            ),

            array(
                'title'     => esc_html__( 'Select Donate Form', 'michigan' ),
                'id'        => 'michigan_webnus_donate_form',
                'type'      => 'select',
                'data'      => 'posts',
                'args'      => array( 'post_type' => 'wpcf7_contact_form', ),
            ),

            array(
                'title'     => esc_html__('Currency', 'michigan'),
                'id'        => 'michigan_webnus_currency',
                'type'      => 'text',
            ),

            array(
                'title'    => esc_html__( 'Goal Features', 'michigan' ),
                'id'       => 'michigan_webnus_goal_features',
                'type'     => 'checkbox',
                'options'  => array(
                    'image'         => esc_html__('Goal Image','michigan'),
                    'category'      => esc_html__('Goal Cagetory','michigan'),
                    'sharing'       => esc_html__('Goal Sharing','michigan'),
                    'date'          => esc_html__('Goal Date','michigan'),
                    'views'         => esc_html__('Goal Views','michigan'),
                    'comment'       => esc_html__('Goal Comment','michigan'),
                ),
            ),
        ),
    ) );



	// -> START Pages Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Pages', 'michigan' ),
		'id'		=> 'pages_opts',
		'icon'		=> 'sl-docs',
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( '404 Page', 'michigan' ),
		'id'		=> '404_opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
                'id'        => 'michigan_webnus_404_page_switch',
                'title'     => __('Custom 404 page?', 'michigan'),
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enable', 'michigan' ),
                'off'       => esc_html__( 'Disable', 'michigan' ),
            ),
            array(
                'title'     => esc_html__( 'Select Custom 404 Page', 'michigan' ),
                'subtitle'      => esc_html__( 'Select 404 Page', 'michigan' ),
                'id'        => 'michigan_webnus_404_page',
                'type'      => 'select',
                'data'      => 'page',
                'required'  => array( 'michigan_webnus_404_page_switch', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Text To Display', 'michigan' ),
                'id'        => 'michigan_webnus_404_text',
                'type'      => 'ace_editor',
                'theme'     => 'chrome',
                'mode'      => 'php',
                'default'   => '<h3>We\'re sorry, but the page you were looking for doesn\'t exist.</h3>',
                'full_width'=> true,
                'required'  => array( 'michigan_webnus_404_page_switch', '=', '0' ),
            ),
		),
	) );

	// -> START Blog Options Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Blog Options', 'michigan' ),
		'id'		=> 'blog-opts',
		'icon'		=> 'ti-pencil-alt',
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Blog Page', 'michigan' ),
		'id'		=> 'blog-page-opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'BlogTemplate', 'michigan' ),
				'subtitle'	=> esc_html__( 'For styling your blog page you can choose among these template layouts.', 'michigan' ),
				'id'		=> 'michigan_webnus_blog_template',
				'type'		=> 'image_select',
				'full_width'=> true,
				'default'	=> '2',
				'options'	=> array(
					'1' => array(
						'alt' => esc_html__( 'Blog Type 1', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type1.png'
					),
					'2' => array(
						'alt' => esc_html__( 'Blog Type 2', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type2.png'
					),
					'3' => array(
						'alt' => esc_html__( 'Blog Type 3', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type3.png'
					),
					'4' => array(
						'alt' => esc_html__( 'Blog Type 4', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type4.png'
					),
					'5' => array(
						'alt' => esc_html__( 'Blog Type 5', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type5.png'
					),
					'6' => array(
						'alt' => esc_html__( 'Blog Type 6', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type6.png'
					),
					'7' => array(
						'alt' => esc_html__( 'Blog Type 7', 'michigan' ),
						'img' => ReduxFramework::$_url . '../webnus-options/assets/img/blog-type7.png'
					),
				),
			),
			array(
				'title'		=> esc_html__('Blog Sidebar Position', 'michigan'),
				'id'		=> 'michigan_webnus_blog_sidebar',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options'	=> array(
					'none'	=> esc_html__( 'None', 'michigan' ),
					'left'	=> esc_html__( 'Left', 'michigan' ),
					'right'	=> esc_html__( 'Right', 'michigan' ),
					'both'	=> esc_html__( 'Both', 'michigan' ),
				),
			),
			array(
				'title'		=> esc_html__('Excerpt Or Full Blog Content', 'michigan'),
				'subtitle'	=> esc_html__('You can show all text of your posts in blog page or a fixed amount of characters to show for each post.','michigan'),
				'id'		=> 'michigan_webnus_blog_excerptfull_enable',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options'	=> array(
					'1'	=> esc_html__( 'Full', 'michigan' ),
					'0'	=> esc_html__( 'Excerpt', 'michigan' ),
				),
			),
			array(
				'title'		=> esc_html__('Excerpt Length for Large Posts', 'michigan'),
				'subtitle'	=> esc_html__('Type the number of characters you want to show in the blog page for each post.','michigan'),
				'id'		=> 'michigan_webnus_blog_excerpt_large',
				'type'		=> 'slider',
				'default'	=> 93,
				'min'		=> 1,
				'step'		=> 1,
				'max'		=> 400,
				'display_value'	=> 'text',
				'required'  => array( 'michigan_webnus_blog_excerptfull_enable', '=', '0' ),
			),
			array(
				'title'		=> esc_html__('Excerpt Length for List Posts', 'michigan'),
				'subtitle'	=> esc_html__('Type the number of characters you want to show in the blog page for each post.','michigan'),
				'id'		=> 'michigan_webnus_blog_excerpt_list',
				'type'		=> 'slider',
				'default'	=> 17,
				'min'		=> 1,
				'step'		=> 1,
				'max'		=> 400,
				'display_value'	=> 'text',
				'required'  => array( 'michigan_webnus_blog_excerptfull_enable', '=', '0' ),
			),
			array(
				'title'		=> esc_html__('Blog Page Title', 'michigan'),
				'subtitle'	=> esc_html__('By hiding this option, blog Page title will be disappearing.','michigan'),
				'id'		=> 'michigan_webnus_blog_page_title_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Blog Page Title Text', 'michigan'),
				'id'		=> 'michigan_webnus_blog_page_title',
				'type'		=> 'text',
				'default'	=> 'Blog',
				'required'  => array( 'michigan_webnus_blog_page_title_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Read More Text', 'michigan'),
				'subtitle'	=> esc_html__('You can set another name instead of read more link.','michigan'),
				'id'		=> 'michigan_webnus_blog_readmore_text',
				'type'		=> 'text',
				'default'	=> 'Continue Reading',
			),
			array(
				'title'		=> esc_html__( 'Featured Image on Blog', 'michigan' ),
				'subtitle'	=> esc_html__( 'By disabling this option, all blog feature images will be disappearing.', 'michigan' ),
				'id'		=> 'michigan_webnus_blog_featuredimage_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Default Blank Featured Image', 'michigan'),
				'id'		=> 'michigan_webnus_no_image',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Custom Default Blank Featured Image', 'michigan'),
				'id'		=> 'michigan_webnus_no_image_src',
				'type'		=> 'media',
				'url'		=> true,
				'required'  => array( 'michigan_webnus_no_image', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Post Title on Blog', 'michigan' ),
				'subtitle'	=> esc_html__( 'By disabling this option, all post title images will be disappearing.','michigan' ),
				'id'		=> 'michigan_webnus_blog_posttitle_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Single Blog Page', 'michigan' ),
		'id'		=> 'single-blog-page-opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Single Post Sidebar Position', 'michigan'),
				'id'		=> 'michigan_webnus_blog_singlepost_sidebar',
				'type'		=> 'button_set',
				'default'	=> 'right',
				'options'	=> array(
					'none'	=> esc_html__( 'None', 'michigan' ),
					'left'	=> esc_html__( 'Left', 'michigan' ),
					'right'	=> esc_html__( 'Right', 'michigan' ),
				),
			),
            array(
                'title'     => esc_html__('Next/Previous', 'michigan'),
                'id'        => 'michigan_webnus_blog_sinlge_nextprev_enable',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'michigan' ),
                'off'       => esc_html__( 'Off', 'michigan' ),
                'default'   => '1',
            ),
			array(
				'title'		=> esc_html__('Featured Image on Single Post', 'michigan'),
				'id'		=> 'michigan_webnus_blog_sinlge_featuredimage_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1',
			),
			array(
				'title'		=> esc_html__('Social Share Links', 'michigan'),
				'subtitle'	=> esc_html__('By enabling this feature your visitors can share the post to social networks such as Facebook, Twitter and...','michigan'),
				'id'		=> 'michigan_webnus_blog_social_share',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1',
			),
			array(
				'title'		=> esc_html__('Single post Authorbox', 'michigan'),
				'subtitle'	=> esc_html__('This feature shows a picture of post author and some info about author.','michigan'),
				'id'		=> 'michigan_webnus_blog_single_authorbox_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1',
			),
			array(
				'title'		=> esc_html__('Recommended Posts', 'michigan'),
				'subtitle'	=> esc_html__('This feature recommends related post to visitors.','michigan'),
				'id'		=> 'michigan_webnus_recommended_posts',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1',
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Post Metadatas', 'michigan' ),
		'id'		=> 'post-meta-opts',
		'subsection'=> true,
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Metadata Gravatar', 'michigan'),
				'id'		=> 'michigan_webnus_blog_meta_gravatar_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1'
			),
			array(
				'title'		=> esc_html__('Metadata Author', 'michigan'),
				'id'		=> 'michigan_webnus_blog_meta_author_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1'
			),
			array(
				'title'		=> esc_html__('Metadata Date', 'michigan'),
				'id'		=> 'michigan_webnus_blog_meta_date_enable',
				'type'		=> 'switch',
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'michigan_webnus_blog_meta_category_enable',
				'type'		=> 'switch',
				'title'		=> esc_html__('Metadata Category', 'michigan'),
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'michigan_webnus_blog_meta_comments_enable',
				'type'		=> 'switch',
				'title'		=> esc_html__('Metadata Comments', 'michigan'),
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1'
			),
			array(
				'id'		=> 'michigan_webnus_blog_meta_views_enable',
				'type'		=> 'switch',
				'title'		=> esc_html__('Metadata Views', 'michigan'),
				'on'		=> esc_html__( 'On', 'michigan' ),
				'off'		=> esc_html__( 'Off', 'michigan' ),
				'default'	=> '1'
			),
		),
	) );


	// -> START Styling Options Fields
	Redux::setSection( $opt_name, array(
	'title'		=> __( 'Styling Options', 'michigan' ),
	'id'		=> 'styling_opts',
	'icon'		=> 'ti-palette',
	));

	Redux::setSection( $opt_name, array(
	'title'			=> __( 'Background', 'michigan' ),
	'id'			=> 'background_opts',
	'desc'		=> esc_html__('Background shows in Boxed layout. you can select layout in "Layout" tab.', 'michigan'),
	'subsection'	=> true,
	'fields'		=> array(
		array(
			'title'		=> esc_html__( 'Body Background', 'michigan' ),
			'id'		=> 'michigan_webnus_background',
			'type'		=> 'background',
			'output'	=> array( 'body' ),
		),

		array(
			'title'		=> esc_html__( 'Background Pattern', 'michigan' ),
			'id'		=> 'michigan_webnus_background_pattern',
			'type'		=> 'image_select',
			'options'	=> array(
				'none'	=> array('alt' => 'None','img' => $theme_bg_dir.'none.jpg',),
				$theme_bg_dir.'bdbg1.png'				=> array('alt'  => 'Default BG', 'img'  	=> $theme_bg_dir.'bdbg1.png',),
				$theme_bg_dir.'gray-jean.png'			=> array('alt'  => 'Gray Jean', 'img'  		=> $theme_bg_dir.'gray-jean.png',),
				$theme_bg_dir.'light-wool.png'			=> array('alt'  => 'Light Wool', 'img'  	=> $theme_bg_dir.'light-wool.png',),
				$theme_bg_dir.'subtle_freckles.png'		=> array('alt'	=> 'Subtle Freckles','img'	=>$theme_bg_dir.'subtle_freckles.png',),
				$theme_bg_dir.'subtle_freckles2.png'	=> array('alt'	=> 'Subtle Freckles 2','img'	=>$theme_bg_dir.'subtle_freckles2.png',),
				$theme_bg_dir.'green-fibers.png'		=> array('alt'  => 'Green Fibers', 'img'  	=> $theme_bg_dir.'green-fibers.png',),
				$theme_bg_dir.'dust.png'  				=> array('alt'  => 'Dust', 'img'  			=> $theme_bg_dir.'dust.png',),
			),
			'height'	=> '64',
		),
	),
	));

	Redux::setSection( $opt_name, array(
	'title'            => __( 'Colors', 'michigan' ),
	'id'               => 'colors_opts',
	'subsection'       => true,
	'fields'		   => array(
		array(
			'title'		=> esc_html__( 'Predefined Color Skin', 'michigan' ),
			'id'		=> 'michigan_webnus_color_skin',
			'type'		=> 'palette',
			'class'		=> 'w-p-colorskin',
			'default'	=> '0',
			'palettes'	=> array(
				'e3e3e3'	=> array( '#e3e3e3' ),
				'4ccfad'	=> array( '#4ccfad' ),
				'0093d0'	=> array( '#0093d0' ),
				'e53f51'	=> array( '#e53f51' ),
				'f1c40f'	=> array( '#f1c40f' ),
				'e64883'	=> array( '#e64883' ),
				'45ab48'	=> array( '#45ab48' ),
				'9661ab'	=> array( '#9661ab' ),
				'0aad80'	=> array( '#0aad80' ),
				'3ed1e7'	=> array( '#3ed1e7' ),
				'ff5a00'	=> array( '#ff5a00' ),
				'c3512f' 	=> array( '#c3512f' ),
				'55606e'	=> array( '#55606e' ),
				'fe8178'	=> array( '#fe8178' ),
				'7c6853'	=> array( '#7c6853' ),
				'bed431'	=> array( '#bed431' ),
				'2d5c88'	=> array( '#2d5c88' ),
				'76dd56'	=> array( '#76dd56' ),
				'2997ab'	=> array( '#2997ab' ),
				'734854'	=> array( '#734854' ),
				'a81010'	=> array( '#a81010' ),
			),

        ),

		array(
			'id'		=> 'michigan_webnus_custom_color_skin_enable',
			'type'		=> 'switch',
			'title'		=> esc_html__('Custom Color Skin', 'michigan'),
			'options'	=> array('1' => esc_html__('Enable','michigan'), '0' => esc_html__('Disable','michigan')),
			'default'	=> '0',
		),

		array(
			'id'			=> 'michigan_webnus_custom_color_skin',
			'type'			=> 'color',
			'title'			=> esc_html__('Choose Color ', 'michigan'),
			'subtitle'		=> esc_html__('Choose your desire color scheme.', 'michigan'),
			'transparent'	=> false,
			'required'		=> array( 'michigan_webnus_custom_color_skin_enable', '=', '1' ),
		),
		array(
			'id'		=> 'michigan_webnus_link_color',
			'type'		=> 'link_color',
			'title'		=> esc_html__('Links Color', 'michigan'),
			'active'	=> false,
			'visited'	=> true,
			'output'	=> array( 'body #wrap a' ),
		),
		/*array(
			'id'       => 'michigan_webnus_contactform_button',
			'type'     => 'link_color',
			'title'    => esc_html__('Contact form button', 'michigan'),
			'subtitle'	=> esc_html__( 'In Footer'),
			'active'    => false,
		),*/
		array(
			'id'       => 'michigan_webnus_menu_link_color',
			'type'     => 'link_color',
			'title'    => esc_html__('Header Menu Link', 'michigan'),
		),

		array(
			'id'			=> 'michigan_webnus_menu_selected_border_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Header Menu Selected Border', 'michigan'),
			'transparent'	=> false,
			'output'		=> array(
				'border-color' => '#wrap #nav li.current > a',
			),
		),
		array(
			'id'		=> 'michigan_webnus_scroll_to_top_hover_background_color',
			'type'		=> 'link_color',
			'title'		=> esc_html__('Scroll to top', 'michigan'),
			'active'	=> false,
			'visited'	=> false,
		),
		array(
			'id'			=> 'michigan_webnus_iconbox_base_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Iconboxes', 'michigan'),
			'subtitle'		=> esc_html__( 'Iconboxes Base Color'),
			'transparent'	=> false,
			'output'		=> array('#wrap [class*="icon-box"] i'),
		),
		array(
			'id'			=> 'michigan_webnus_learnmore_link_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Learn more link', 'michigan'),
			'subtitle'		=> esc_html__( 'In IconBox'),
			'transparent'	=> false,
			'output'		=> array('#wrap a.magicmore'),
		),

		array(
			'id'			=> 'michigan_webnus_learnmore_hover_link_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Learn more hover link color', 'michigan'),
			'subtitle'		=> esc_html__( 'In IconBox'),
			'transparent'	=> false,
			'output'		=> array('#wrap [class*="icon-box"] a.magicmore:hover'),
		),

		array(
			'id'			=> 'michigan_webnus_resoponsive_menu_icon_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Responsive Menu Icon', 'michigan'),
			'subtitle'		=> esc_html__( 'Appears in mobile & tablet view'),
			'transparent'	=> false,
			'output'		=> array(
				'background-color' => '#wrap #header.sm-rgt-mn #menu-icon span.mn-ext1, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext2, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext3',
			),
		),

	)));

	// -> START Typography Fields
	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Typography', 'michigan' ),
		'id'				=> 'typography_opts',
		'icon'				=> 'ti-smallcap',
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Body Typography', 'michigan' ),
		'id'				=> 'body_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'Body Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all body text.', 'michigan' ),
				'id'			=> 'body-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( 'body' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Paragraph Typography', 'michigan' ),
		'id'				=> 'p_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( '(P) Paragraph Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all (P) Paragraph.', 'michigan' ),
				'id'			=> 'p-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap p' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Headings Typography', 'michigan' ),
		'id'				=> 'h_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'All Headings Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Headings.', 'michigan' ),
				'id'			=> 'all-h-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h1,#wrap h2,#wrap h3,#wrap h4,#wrap h5,#wrap h6' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H1) Headings Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H1 Headings.', 'michigan' ),
				'id'			=> 'h1-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h1' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H2) Headings Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H2 Headings.', 'michigan' ),
				'id'			=> 'h2-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h2' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H3) Headings Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H3 Headings.', 'michigan' ),
				'id'			=> 'h3-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h3' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H4) Headings Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H4 Headings.', 'michigan' ),
				'id'			=> 'h4-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h4' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H5) Headings Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H5 Headings.', 'michigan' ),
				'id'			=> 'h5-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h5' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
			array(
				'title'			=> esc_html__( '(H6) Headings Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all H6 Headings.', 'michigan' ),
				'id'			=> 'h6-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '#wrap h6' ),
				'units'			=> 'px',
				'fonts' 		=> $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Menu Typography', 'michigan' ),
		'id'				=> 'menu_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'Menu Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Menus.', 'michigan' ),
				'id'			=> 'menu-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'line-height'	=> false,
				'output'		=> array( 'body #wrap #header ul#nav a' ),
				'units'			=> 'px',
				'fonts'			=> $fonts,
			),
			array(
				'title'			=> esc_html__( 'Sub Menu Typography', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Sub Menus.', 'michigan' ),
				'id'			=> 'sub-menu-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'line-height'	=> false,
				'output'		=> array( 'body #wrap #header ul#nav ul li a' ),
				'units'			=> 'px',
				'fonts'			=> $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Blog Typography', 'michigan' ),
		'id'				=> 'blog_typography_opts',
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'			=> esc_html__( 'Post Title Typography In Blog Page', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Post Title.', 'michigan' ),
				'id'			=> 'post-title-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '.blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
			array(
				'title'			=> esc_html__( 'Post Title Typography in Single Blog Page', 'michigan' ),
				'subtitle'		=> esc_html__( 'These settings control the typography for all Post Title.', 'michigan' ),
				'id'			=> 'single-post-title-typography',
				'type'			=> 'typography',
				'all_styles'	=> true,
				'letter-spacing'=> true,
				'font-style'	=> false,
				'font-weight'	=> false,
				'output'		=> array( '.blog-single-post h1' ),
				'units'			=> 'px',
				'fonts' => $fonts,
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Custom Fonts', 'michigan' ),
		'id'				=> 'custom_fonts_opts',
		'desc'				=> esc_html__( 'After uploading your fonts, you should select font family (custom-font-1/custom-font-2/custom-font-3) from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section.', 'michigan' ),
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'		=> esc_html__( 'Custom Font1', 'michigan' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Custom Font 1.', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font1',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 1 .woff', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font1_woff',
				'type'		=> 'media',
				'mode'       => false,
                'preview'  => false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font1', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 1 .ttf', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font1_ttf',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font1', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 1 .eot', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font1_eot',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font1', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Custom Font2', 'michigan' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Custom Font 2', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font2',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 2 .woff', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font2_woff',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font2', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 2 .ttf', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font2_ttf',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font2', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 2 .eot', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font2_eot',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font2', '=', '1' ),
			),

			array(
				'title'		=> esc_html__( 'Custom Font3', 'michigan' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Custom Font 3', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font3',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 3 .woff', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font3_woff',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font3', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 3 .ttf', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font3_ttf',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font3', '=', '1' ),
			),
			array(
				'title'		=> esc_html__( 'Custom font 3 .eot', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_font3_eot',
				'type'		=> 'media',
				'mode'		=> false,
                'preview'	=> false,
				'url'		=> true,
				'required'  => array( 'michigan_webnus_custom_font3', '=', '1' ),
			),
		),
	));

	Redux::setSection( $opt_name, array(
		'title'				=> esc_html__( 'Adobe Typekit', 'michigan' ),
		'id'				=> 'adobe_typekit_opts',
		'desc'				=> esc_html__( 'After completing below settings, you should select font family (typekit-font-1/typekit-font-2/typekit-font-3) from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section', 'michigan' ),
		'subsection'		=> true,
		'fields'			=> array(
			array(
				'title'		=> esc_html__( 'Adobe Typekit', 'michigan' ),
				'subtitle'	=> esc_html__( 'Please Enable this option to use Adobe Typekit.', 'michigan' ),
				'id'		=> 'michigan_webnus_adobe_typekit',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Typekit Kit ID', 'michigan'),
				'id'		=> 'michigan_webnus_typekit_id',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_adobe_typekit', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Typekit Font Family 1', 'michigan'),
				'id'		=> 'michigan_webnus_typekit_font1',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_adobe_typekit', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Typekit Font Family 2', 'michigan'),
				'id'		=> 'michigan_webnus_typekit_font2',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_adobe_typekit', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Typekit Font Family 3', 'michigan'),
				'id'		=> 'michigan_webnus_typekit_font3',
				'type'		=> 'text',
				'required'  => array( 'michigan_webnus_adobe_typekit', '=', '1' ),
			),

		),
	));


	// -> START Social Networks Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Social Networks', 'michigan' ),
		'id'		=> 'social_opts',
		'icon'		=> 'sl-share',
		'fields'	=> array(
			array(
                'id'       => 'michigan_webnus_social_first',
                'type'     => 'select',
                'title'    => esc_html__('1st Social Name', 'michigan'),
                'options'  => $webnus_socials,
            ),
			array(
				'id'		=> 'michigan_webnus_social_first_url',
				'type'		=> 'text',
				'title'		=> esc_html__('1st Social URL', 'michigan'),
				'required'  => array( 'michigan_webnus_social_first', '!=', '' ),
			),
			array(
				'id'		=> 'michigan_webnus_social_second',
				'type'		=> 'select',
				'title'		=> esc_html__('2nd Social Name', 'michigan'),
				'options'	=> $webnus_socials,
			),
			array(
				'id'		=> 'michigan_webnus_social_second_url',
				'type'		=> 'text',
				'title'		=> esc_html__('2nd Social URL', 'michigan'),
				'required'  => array( 'michigan_webnus_social_second', '!=', '' ),
			),
			array(
				'id'		=> 'michigan_webnus_social_third',
				'type'		=> 'select',
				'title'		=> esc_html__('3rd Social Name', 'michigan'),
				'options'	=> $webnus_socials,
			),
			array(
				'id'		=> 'michigan_webnus_social_third_url',
				'type'		=> 'text',
				'title'		=> esc_html__('3rd Social URL', 'michigan'),
				'required'  => array( 'michigan_webnus_social_third', '!=', '' ),
			),
			array(
				'id'		=> 'michigan_webnus_social_fourth',
				'type'		=> 'select',
				'title'		=> esc_html__('4th Social Name', 'michigan'),
				'options'	=> $webnus_socials,
			),
			array(
				'id'		=> 'michigan_webnus_social_fourth_url',
				'type'		=> 'text',
				'title'		=> esc_html__('4th Social URL', 'michigan'),
				'required'  => array( 'michigan_webnus_social_fourth', '!=', '' ),
			),
			array(
				'id'		=> 'michigan_webnus_social_fifth',
				'type'		=> 'select',
				'title'		=> esc_html__('5th Social Name', 'michigan'),
				'options'	=> $webnus_socials,
			),
			array(
				'id'		=> 'michigan_webnus_social_fifth_url',
				'type'		=> 'text',
				'title'		=> esc_html__('5th Social URL', 'michigan'),
				'required'  => array( 'michigan_webnus_social_fifth', '!=', '' ),
			),
			array(
				'id'		=> 'michigan_webnus_social_sixth',
				'type'		=> 'select',
				'title'		=> esc_html__('6th Social Name', 'michigan'),
				'options'	=> $webnus_socials,
			),
			array(
				'id'		=> 'michigan_webnus_social_sixth_url',
				'type'		=> 'text',
				'title'		=> esc_html__('6th Social URL', 'michigan'),
				'required'  => array( 'michigan_webnus_social_sixth', '!=', '' ),
			),
			array(
				'id'		=> 'michigan_webnus_social_seventh',
				'type'		=> 'select',
				'title'		=> esc_html__('7th Social Name', 'michigan'),
				'options'	=> $webnus_socials,
			),
			array(
				'id'		=> 'michigan_webnus_social_seventh_url',
				'type'		=> 'text',
				'title'		=> esc_html__('7th Social URL', 'michigan'),
				'required'  => array( 'michigan_webnus_social_seventh', '!=', '' ),
			),
		),
	) );

	// -> START Google Map Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Google Map', 'michigan' ),
		'id'		=> 'google_map_opts',
		'icon'		=> 'icon-map-pin',
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'API key', 'michigan' ),
				'subtitle'	=> wp_kses( __('You should create an API for yourself and put code here. red below link to more info:  <a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend,places_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">Here</a><br><br>', 'michigan'), $keyses ),
				'id'		=> 'michigan_google_map_api',
				'type'		=> 'text',
			),
			array(
				'title'		=> esc_html__( 'Display Sign in button', 'michigan' ),
				'subtitle'	=> wp_kses( __('You can see Sign In button <a href="https://developers.google.com/maps/documentation/javascript/examples/save-simple" target="_blank">Here</a><br/><br/>', 'michigan'), $keyses ),
				'id'		=> 'michigan_google_map_api_sign_in',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
		),
	) );

	// -> START Shop Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Shop', 'michigan' ),
		'id'		=> 'shop_opts',
		'icon'		=> 'ti-shopping-cart',
		'fields'	=> array(
			array(
				'title'		=> esc_html__('Show/Hide Sidebar', 'michigan'),
				'id'		=> 'michigan_webnus_woo_sidebar_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Shop title Show/Hide', 'michigan'),
				'id'		=> 'michigan_webnus_woo_shop_title_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Shop page title', 'michigan'),
				'id'		=> 'michigan_webnus_woo_shop_title',
				'type'		=> 'text',
				'default'	=> 'Shop',
				'required'  => array( 'michigan_webnus_woo_shop_title_enable', '=', '1' ),
			),
			array(
				'title'		=> esc_html__('Product page title Show/Hide', 'michigan'),
				'id'		=> 'michigan_webnus_woo_product_title_enable',
				'type'		=> 'switch',
				'default'	=> '1',
				'on'		=> esc_html__( 'Show', 'michigan' ),
				'off'		=> esc_html__( 'Hide', 'michigan' ),
			),
			array(
				'title'		=> esc_html__('Product page title', 'michigan'),
				'id'		=> 'michigan_webnus_woo_product_title',
				'type'		=> 'text',
				'default'	=> 'Product',
				'required'  => array( 'michigan_webnus_woo_product_title_enable', '=', '1' ),
			),
		),
	) );

	// -> START Maintenance Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Maintenance Mode', 'michigan' ),
		'id'		=> 'coming_soon_opts',
		'desc'		=> esc_html__( 'After creating your page, you can select it from dropdown list.', 'michigan' ),
		'icon'		=> 'sl-rocket',
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Maintenance Mode', 'michigan' ),
				'subtitle'		=> esc_html__( 'Status of Maintenance Mode', 'michigan' ),
				'id'		=> 'michigan_webnus_maintenance_mode',
				'type'		=> 'switch',
				'default'	=> '0',
				'on'		=> esc_html__( 'Enabled', 'michigan' ),
				'off'		=> esc_html__( 'Disabled', 'michigan' ),
			),
			array(
				'title'		=> esc_html__( 'Maintenance Page', 'michigan' ),
				'subtitle'		=> esc_html__( 'Select Maintenance Page', 'michigan' ),
				'id'		=> 'michigan_webnus_maintenance_page',
				'type'		=> 'select',
				'data'		=> 'page',
				'required'  => array( 'michigan_webnus_maintenance_mode', '=', '1' ),
			),
		),
	) );

	// -> START Custom Codes Fields
	Redux::setSection( $opt_name, array(
		'title'		=> esc_html__( 'Custom Codes', 'michigan' ),
		'id'		=> 'custom_codes',
		'icon'		=> 'fa-code',
		'fields'	=> array(
			array(
				'title'		=> esc_html__( 'Custom CSS', 'michigan' ),
				'subtitle'	=> esc_html__( 'Any custom CSS from the user should go in this field, it will override the theme CSS.', 'michigan' ),
				'id'		=> 'michigan_webnus_custom_css',
				'type'		=> 'ace_editor',
				'mode'		=> 'css',
				'theme'		=> 'chrome',
				'full_width'=> true,
			),
			array(
				'title'		=> esc_html__( 'Space Before &lt;/head&gt;', 'michigan' ),
				'subtitle'		=> esc_html__( 'Add code before the &lt;/head&gt; tag.', 'michigan' ),
				'id'		=> 'michigan_webnus_space_before_head',
				'type'		=> 'ace_editor',
				'theme'		=> 'chrome',
				'full_width'=> true,
			),
			array(
				'title'		=> esc_html__( 'Space Before &lt;/body&gt;', 'michigan' ),
				'subtitle'		=> esc_html__( 'Add code before the &lt;/body&gt; tag.', 'michigan' ),
				'id'		=> 'michigan_webnus_space_before_body',
				'type'		=> 'ace_editor',
				'theme'		=> 'chrome',
				'full_width'=> true,
			),
		),
	) );


	/*
	 * <--- END SECTIONS
	 */