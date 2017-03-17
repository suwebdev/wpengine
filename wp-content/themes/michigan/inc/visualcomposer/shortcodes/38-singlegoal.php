<?php
vc_map( array(
        'name' =>'Single Goal',
        'base' => 'agoal',
        "icon" => "webnus-agoal",
		"description" => "Show a goal",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Goal ID', 'michigan' ),
				'param_name' => 'post',
				'value'=>'',
				'description' => esc_html__( 'Pick up the ID & fallow this instruction: admin panel > goals > ID column. Note: When you type nothing it puts latest goal as default to show.', 'michigan'),
			), 
		),    
) );
?>