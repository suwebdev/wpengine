<?php vc_map( array(
        'name' =>'Webnus Blog',
        'base' => 'blog',
		"description" => "Blog Loop",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "icon" => "webnus-blog",
		'params'=>array(
			array(
						"type" => "dropdown",
						"heading" => esc_html__( "Type", 'michigan' ),
						"param_name" => "type",
						"value" => array(
							"Large Posts"=>"1",
							"List Posts"=>"2",							
							"Grid Posts"=>"3",							
							"First Large then List"=>"4",							
							"First Large then Grid"=>"5",							
							"Masonry"=>"6",		
							"Timeline"=>"7",	
						),						
						"description" => esc_html__( "Type", 'michigan')
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
				'param_name' => 'count',
				'value' => '',
				'description' => esc_html__( 'Number of post(s) to show', 'michigan')
			),
					
		)
        
    ) );


?>