<?php
$categories = array();
$categories = get_categories();
$category_slug_array = array('');
foreach($categories as $category)
{
	$category_slug_array[] = $category->slug;
}
vc_map( array(
        'name' =>'Latest News',
        'base' => 'latestnews',
        "icon" => "webnus-latestnews",
		"description" => "Latest News",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Type", 'michigan' ),
				"param_name" => "type",
				"value" => array(
					"Cover"=>"1",
					"List"=>"2",
					"Carusel"=>"3",
				),
				"description" => esc_html__( "Select style type", 'michigan')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Category', 'michigan' ),
				'param_name' => 'category',
				'value'=>$category_slug_array,
				'description' => esc_html__( 'Select specific category, leave blank to show all categories.', 'michigan')
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Author name', 'michigan' ),
				'param_name' => 'author',
				'value'=>'',
				'description' => esc_html__( 'Type Author name. When you type nothing it puts latest post as default to show.', 'michigan'),
			), 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Post Count', 'michigan' ),
				'param_name' => 'scount',
				'value' => '',
				'description' => esc_html__( 'Number of post(s) to show', 'michigan')
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Count in row', 'michigan' ),
				'param_name' => 'rcount',
				'value' => '',
				'description' => esc_html__( 'Number of post(s) in a row', 'michigan'),
				"dependency" => array('element'=>'type','value'=>array('1')),
			),
			array(
				'heading' => esc_html__('Page Navigation', 'michigan') ,
				'description' => wp_kses( __('Enable page navigation.<br/><br/>', 'michigan'), array( 'br' => array() ) ),
				'param_name' => 'page',
				'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
				'type' => 'checkbox',
				'std' => '',
			) ,
		),    
	) );
?>