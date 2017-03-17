<?php
$categories = array();
$categories = get_categories();
$category_slug_array = array('');
foreach($categories as $category)
{
	$category_slug_array[] = $category->slug;
}

vc_map( array(
        'name' =>'Webnus Courses',
        'base' => 'webnus_courses',
        "icon" => "webnus-courses",
		"description" => "Show Latest Or Popular Courses",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'michigan' ),
							"param_name" => "type",
							"value" => array(
								"List"		=>"list",
								"Grid"		=>"grid",
								"Modern"	=>"modern",
								"Table"		=>"table",
								"Carousel"	=>"carousel",
								
							),
							"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan')
						),
						
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Order by", 'michigan' ),
							"param_name" => "sort",
							"value" => array(
								"Most Recent"=>"",
								"Most Popular"=>"view",
							),
							"description" => esc_html__( "Recent Or Popular", 'michigan')
						),
					
						array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Post Count', 'michigan' ),
						'param_name' => 'count',
						'value' => '',
						'description' => esc_html__( 'Number of course(s) to show.', 'michigan')
						),

						array(
						'type' => 'textfield',
						'description' => esc_html__( 'Number of course(s) to show.', 'michigan'),
						'heading' => esc_html__( 'Carousel Item', 'michigan' ),
						'param_name' => 'item_carousel',
						'value' => '3',
						"dependency" => array( 'element'=>'type', 'value' => array( 'carousel', ) ),
						),
						
						array(
							'heading' => esc_html__('Page Navigation', 'michigan') ,
							'description' => wp_kses( __('Enable page navigation.<br/><br/>', 'michigan'), array( 'br' => array() ) ),
							'param_name' => 'page',
							'value' => array( esc_html__( 'Enable', 'michigan' ) => 'enable'),
							'type' => 'checkbox',
							'std' => '',
							"dependency" => array('element'=>'type','value'=>array('list','grid','modern','table',)),
						) ,
			
						array(
							"type" => "iconfonts",
							"heading" => esc_html__( "Icon", 'michigan' ),
							"param_name" => "icon",
							'value'=>'',
							"description" => esc_html__( "Show an icon on the left side of the course title.", 'michigan'),
							"dependency" => array('element'=>'type','value'=>array('minimal')),
						),			
					
						
					),      
		) );
?>