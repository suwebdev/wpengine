<?php
vc_map( array(
        "name" =>"Webnus Certificate",
        "base" => "certificate",
        "description" => "Webnus Certificate",
		"icon" => "webnus-certificate",
        "category" => esc_html__( 'Webnus Shortcodes', 'michigan' ),
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'michigan' ),
							"param_name" => "type",
							"value" => array(
								"Online 1"=>"online1",
								"Online 2"=>"online2",
								"Kindergarten"=>"kids",
							),
							"description" => esc_html__( "You can choose among these pre-designed types.", 'michigan')
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Kindergarten Name', 'michigan' ),
						"param_name" => 'kindergarten_name',
						"value" => '',
						"description" => esc_html__( 'Enter Kindergarten Name.', 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('kids'))
						),
					
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Certificate Title', 'michigan' ),
						"param_name" => 'cer_title',
						"value" => '',
						"description" => esc_html__( 'Enter Certificate Title', 'michigan')
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Presented Sentence Part 1', 'michigan' ),
						"param_name" => 'desc_1',
						"value" => '',
						"description" => esc_html__( 'Enter Presented Sentence Part 1', 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('online1'))
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Student Name', 'michigan' ),
						"param_name" => 'student_name',
						"value" => '',
						"description" => esc_html__( 'Enter Student Name. If you leave this field blank, it will print {first_name} {last_name} value which usable in lifterlms certificate.', 'michigan'),
						"std" => ''
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Presented Sentence Part 2', 'michigan' ),
						"param_name" => 'desc_2',
						"value" => '',
						"description" => esc_html__( 'Enter Presented Sentence Part 2', 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('online1'))
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Academic Director Name', 'michigan' ),
						"param_name" => 'ac_director',
						"value" => '',
						"description" => esc_html__( 'Enter Academic Director Name.', 'michigan')
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Academic Director Title', 'michigan' ),
						"param_name" => 'ac_director_title',
						"value" => '',
						"description" => esc_html__( 'Enter Academic Director Title.', 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('online2'))
						),
						
						array(
						"type" => "attach_image",
						"heading" => esc_html__( "Academic Director Sign", 'michigan' ),
						"param_name" => "ac_director_sign",
						"value" =>'',
						"description" => esc_html__( "Upload Academic Director Sign.", 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('kids','online1'))
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Course Director Name', 'michigan' ),
						"param_name" => 'c_director',
						"value" => '',
						"description" => esc_html__( 'Enter Course Director Name.', 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('kids','online2'))
						),
						
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Course Director Title', 'michigan' ),
						"param_name" => 'c_director_title',
						"value" => '',
						"description" => esc_html__( 'Enter Course Director Title.', 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('online2'))
						),
						
						array(
						"type" => "attach_image",
						"heading" => esc_html__( "Course Director Sign", 'michigan' ),
						"param_name" => "c_director_sign",
						"value" =>'',
						"description" => esc_html__( "Upload Course Director Sign.", 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('kids'))
						),
						
						
						array(
						"type" => 'textarea',
						"heading" => esc_html__( 'Certificate Description', 'michigan' ),
						"param_name" => 'cer_desc',
						"value" => '',
						"description" => esc_html__( 'Enter Description for your certificate.', 'michigan')
						),
			
						array(
						"type" => 'textfield',
						"heading" => esc_html__( 'Current Date', 'michigan' ),
						"param_name" => 'current_date',
						"value" => '',
						"description" => esc_html__( 'Enter Current Date.If you leave this field blank, it will print {current_date} value which usable in lifterlms certificate.', 'michigan'),
						"dependency" => array('element'=>'type','value'=>array('online2','online1'))
						),

						array(
						"type" => "attach_image",
						"heading" => esc_html__( "Upload background", 'michigan' ),
						"param_name" => "upload_bg",
						"value" =>'',
						"description" => esc_html__( "Upload Background", 'michigan')
						),						
					),      
		) );