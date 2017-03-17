<?php
add_action( 'vc_before_init', 'michigan_time_table_map' );

function michigan_time_table_map() {

	// get time tables
	$time_tables = get_posts( 'post_type="wb-tt"&numberposts=-1' );
	$time_tables_choices = array();

	if ( $time_tables ) :
		$time_tables_choices[ esc_html__( 'Select your desired time table', 'michigan' ) ] = 0;
		foreach ( $time_tables as $time_table ) :
			$time_tables_choices[ $time_table->post_title ] = $time_table->ID;
		endforeach;
	else :
		$time_tables_choices[ esc_html__( 'No time tables found', 'michigan' ) ] = 0;
	endif;

	vc_map( array(
		'name'			=> esc_attr__( 'Webnus Timetable', 'michigan' ),
		'base'			=> 'wbtt',
		'icon'			=> 'webnus-time-table',
		'description'	=> esc_attr__( 'Time Table', 'michigan' ),
		'category'		=> esc_attr__( 'Webnus Shortcodes', 'michigan' ),
		'params'		=> array(
			array(
				'heading'		=> esc_attr__( 'Select time table', 'michigan' ),
				'description'	=> esc_attr__( 'Choose previously created time table from the drop down list.', 'michigan' ),
				'type'			=> 'dropdown',
				'param_name'	=> 'id',
				'value'			=> $time_tables_choices,
			),
		),
	) ); // end vc_map

} // end michigan_time_table_map fun