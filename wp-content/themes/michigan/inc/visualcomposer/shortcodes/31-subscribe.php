<?php
vc_map( array(
        'name' =>'Webnus Subscribe',
        'base' => 'subscribe',
        "icon" => "webnus-subscribe",
		"description" => "Subscribe box",
        'category' => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'michigan' ),
							"param_name" => "type",
							"value" => array(
								"Boxed"=>"boxed",
								"Bar"=>"bar1",
								"Flat"=>"flat",
							),
							"description" => esc_html__( "Select style type", 'michigan')
						),
						array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Title', 'michigan' ),
								'param_name' => 'box_title',
								'value'=>'',
								'description' => esc_html__( 'Subscribe title', 'michigan'),
						),							
					
					    array(
							"type"=>'textarea',
							"param_name"=> "box_text",
							"heading"=>esc_html__('Subscribe Text', 'michigan'),
							"value"=>"",
							"description" => esc_html__( "Subscribe content", 'michigan')	
						),
						
						array(
							"type" => "dropdown",
							'heading' => esc_html__( 'Email Service', 'michigan' ),
							'param_name' => 'service',
							"value" => array(
								"FeedBurner"=>"FeedBurner",
								"MailChimp"=>"MailChimp",
							),
							'description' => esc_html__( 'FeedBurner or MailChimp', 'michigan')
						), 
						
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'FeedBurner ID', 'michigan' ),
							'param_name' => 'feedburner_id',
							'value'=>'',
							'description' => esc_html__( 'Feedburner ID', 'michigan'),
							"dependency" => array('element'=>'service','value'=>array('FeedBurner')),
						),	
					
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'MailChimp URL', 'michigan' ),
							'param_name' => 'mailchimp_url',
							'value'=>'',
							'description' => esc_html__( 'Mailchimp form action URL', 'michigan'),
							"dependency" => array('element'=>'service','value'=>array('MailChimp')),
						),	

						
						
					),    
		) );
?>