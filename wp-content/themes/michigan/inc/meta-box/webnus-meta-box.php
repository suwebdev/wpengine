<?php
add_filter( 'rwmb_meta_boxes', 'michigan_meta_boxes' );
function michigan_meta_boxes( $meta_boxes ) {

	// Post
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Post Options', 'michigan' ),
		'post_types'	=> 'post',
		'fields'		=> array(
			array(
				'id'	=> 'michigan_featured_video_meta',
				'name'	=> esc_attr__( 'Video or Audio iFrame', 'michigan' ),
				'desc'	=> esc_attr__( 'Enter the Embed Code', 'michigan' ),
				'type'	=> 'textarea',
			),
			array(
				'id'	=> 'michigan_blogpost_meta',
				'name'	=> esc_attr__( 'Post Style', 'michigan' ),
				'type'	=> 'select',
				'options'     => array(
					'postshow1' => esc_attr__( 'Post Show1 Style', 'michigan' ),
					'postshow2' => esc_attr__( 'Post Show2 Style', 'michigan' ),
				),
				'placeholder' => esc_attr__( 'Select an Item', 'michigan' ),
			),
		),
	);

	// Page
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Page Options', 'michigan' ),
		'post_types'	=> 'page',
		'fields'		=> array(
			array(
				'id'	=> 'michigan_page_title_bar_meta',
				'name'	=> esc_attr__( 'Show Page Title', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 1,
			),
			array(
				'id'	=> 'michigan_page_title_text_color_meta',
				'name'	=> esc_attr__( 'Page Title Text Color', 'michigan' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'michigan_page_title_bg_color_meta',
				'name'	=> esc_attr__( 'Page Title Background Color', 'michigan' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'michigan_page_title_font_size_meta',
				'name'	=> esc_attr__( 'Page Title Font Size', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Size in px', 'michigan' ),
				'type'	=> 'text',
				'size'	=> '13',
			),
			array(
				'id'	=> 'michigan_custom_page_title_meta',
				'name'	=> esc_attr__( 'Custom Page Title', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Please enter custom page title', 'michigan' ),
				'type'	=> 'text',
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'michigan_transparent_header_meta',
				'name'	=> esc_attr__( 'Transparent Header', 'michigan' ),
				'type'	=> 'select',
				'options'	=> array(
					'light'	=> esc_attr__( 'Light Style', 'michigan' ),
					'dark'	=> esc_attr__( 'Dark Style', 'michigan' ),
				),
				'placeholder'	=> esc_attr__( 'Select an Item', 'michigan' ),
			),
			array(
				'id'	=> 'michigan_hide_header_meta',
				'name'	=> esc_attr__( 'Hide Header at Start', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'michigan_sidebar_position_meta',
				'name'	=> esc_attr__( 'Sidebar Position', 'michigan' ),
				'type'	=> 'select',
				'options'	=> array(
					'right'	=> esc_attr__( 'Right', 'michigan' ),
					'left'	=> esc_attr__( 'Left', 'michigan' ),
					'both'	=> esc_attr__( 'Both', 'michigan' ),
				),
				'placeholder'	=> esc_attr__( 'Select an Item', 'michigan' ),
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'michigan_topbar_show',
				'name'	=> esc_attr__( 'Show Topbar', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 1,
			),
			array(
				'id'	=> 'michigan_header_show',
				'name'	=> esc_attr__( 'Show Header', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 1,
			),
			array(
				'id'	=> 'michigan_footer_show',
				'name'	=> esc_attr__( 'Show Footer', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 1,
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'michigan_wrap_color_meta',
				'name'	=> esc_attr__( 'Content Background Color', 'michigan' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'michigan_body_bg_color_meta',
				'name'	=> esc_attr__( 'Body Background Color', 'michigan' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'michigan_body_bg_img_meta',
				'name'	=> esc_attr__( 'Body Background Image', 'michigan' ),
				'type'	=> 'image_advanced',
			),
			array(
				'id'	=> 'michigan_body_bg_image_100_meta',
				'name'	=> esc_attr__( '100% Background Image', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'michigan_body_bg_image_repeat_meta',
				'name'	=> esc_attr__( 'Background Repeat', 'michigan' ),
				'type'	=> 'select',
				'options'	=> array(
					'0'	=> esc_attr__( 'No repeat', 'michigan' ),
					'1'	=> esc_attr__( 'Vertically and horizontally', 'michigan' ),
					'2'	=> esc_attr__( 'Only horizontally', 'michigan' ),
					'3'	=> esc_attr__( 'Only vertically', 'michigan' ),
				),
				'placeholder'	=> esc_attr__( 'Select an Item', 'michigan' ),

			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'michigan_onepage_menu_meta',
				'name'	=> esc_attr__( 'OnePage Menu', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'michigan_mega_menu_meta',
				'name'	=> esc_attr__( 'Mega Menu Content', 'michigan' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
		),
	);

	// Goal
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Goal Options', 'michigan' ),
		'post_types'	=> 'goal',
		'fields'		=> array(
			array(
				'id'	=> 'michigan_goal_end_meta',
				'name'	=> esc_attr__( 'Goal End Date', 'michigan' ),
				'desc'	=> esc_attr__( 'Insert date of Goal end.', 'michigan' ),
				'type'	=> 'date',
				'js_options' => array(
					'changeMonth'		=> true,
					'changeYear'		=> true,
					'showButtonPanel'	=> true,
				),
			),
			array(
				'id'	=> 'michigan_goal_amount_meta',
				'name'	=> esc_attr__( 'Goal Amount', 'michigan' ),
				'desc'	=> esc_attr__( 'Insert total number of amount required for goal.', 'michigan' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'michigan_goal_amount_received_meta',
				'name'	=> esc_attr__( 'Goal Amount Received', 'michigan' ),
				'desc'	=> esc_attr__( 'This is the total amount reveived for this goal.', 'michigan' ),
				'type'	=> 'text',
			),
		),
	);

	// Course
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Course Features', 'michigan' ),
		'post_types'	=> 'course',
		'fields'		=> array(
			array(
				'id'	=> 'michigan_course_assessments_meta',
				'name'	=> esc_attr__( 'Course Assessments', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Empty to hide.', 'michigan' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'michigan_course_certificate_meta',
				'name'	=> esc_attr__( 'Course Certificate', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Empty to hide.', 'michigan' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'michigan_course_code_meta',
				'name'	=> esc_attr__( 'Course Code', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Empty to hide.', 'michigan' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'michigan_course_language_meta',
				'name'	=> esc_attr__( 'Course Language', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Empty to hide.', 'michigan' ),
				'type'	=> 'text',
			),

			array(
				'id'	=> 'michigan_course_prequisite_meta',
				'name'	=> esc_attr__( 'Course Prequisite', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Empty to hide.', 'michigan' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'michigan_course_price_meta',
				'name'	=> esc_attr__( 'Course Price', 'michigan' ),
				'placeholder'	=> esc_attr__( 'If you don\'t want to use LifterLMS.', 'michigan' ),
				'type'	=> 'text',
			),
			
			array(
				'id'	=> 'michigan_course_duration_meta',
				'name'	=> esc_attr__( 'Course Duration', 'michigan' ),
				'placeholder'	=> esc_attr__( 'If you don\'t want to use LifterLMS.', 'michigan' ),
				'type'	=> 'text',
			),
			
			array(
				'id'	=> 'michigan_course_lessons_meta',
				'name'	=> esc_attr__( 'Number of Course Lessons', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Empty to hide.', 'michigan' ),
				'type'	=> 'number',
				'step'	=> 1,
			),
			array(
				'id'	=> 'michigan_course_students_meta',
				'name'	=> esc_attr__( 'Number of Students', 'michigan' ),
				'placeholder'	=> esc_attr__( 'Empty to auto count.', 'michigan' ),
				'type'	=> 'number',
				'step'	=> 1,
			),
			
		),
	);

	// Excursion
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Excursion Options', 'michigan' ),
		'post_types'	=> 'excursion',
		'context'		=> 'side',
		'priority'		=> 'default',
		'fields'		=> array(
			array(
				'id'	=> 'michigan_excursion_location_meta',
				'name'	=> esc_attr__( 'Location Meta Data', 'michigan' ),
				'type'	=> 'text',
			),
		),
	);


	return $meta_boxes;
}