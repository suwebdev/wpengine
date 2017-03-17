<?php
vc_map( array(
        'name' =>'Post From Blog',
        'base' => 'postblog',
        "icon" => "webnus-postfromblog",
		"description" => "Single Post",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Post ID', 'michigan' ),
							'param_name' => 'post',
							'value'=>'',
							'description' => esc_html__( 'Pick up the ID & fallow this instruction: admin panel > posts > ID column.', 'michigan')
						), 
					),    
		) );
?>