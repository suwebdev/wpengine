<?php
$categories = array();
$categories = get_categories();
$category_slug_array = array('');
foreach($categories as $category){
	$category_slug_array[] = $category->slug;
}
vc_map( array(
        'name' =>'Category Box',
        'base' => 'categorybox',
		'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
		"description" => "Show Categorybox, By category filter",
        "icon" => "webnus-categorybox",
        'params'=>array(
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
				'heading' => esc_html__('Show title?', 'michigan') ,
				'param_name' => 'show_title',
				'value' => array( esc_html__( 'Show title above the box', 'michigan' ) => 'enable'),
				'type' => 'checkbox',
				'std' => 'enable',
			) ,	
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'michigan' ),
					'param_name' => 'title',
					'value'=> '',
					'description' => esc_html__( 'Insert title', 'michigan'),
					"dependency" => array('element'=>'show_title','value'=>array('enable')),
			),
			array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Posts count', 'michigan' ),
					'param_name' => 'post_count',
					'value'=>'5',
					'description' => esc_html__( 'How many posts to dispaly?', 'michigan')
			),
			array(
				'heading' => esc_html__('Show date?', 'michigan') ,
				'param_name' => 'show_date',
				'type' => 'checkbox',
				'std' => 'enable',
			) ,	
			array(
				'heading' => esc_html__('Show author?', 'michigan') ,
				'param_name' => 'show_author',
				'type' => 'checkbox',
				'std' => 'enable',
			) ,						
		),        
    ) );
?>