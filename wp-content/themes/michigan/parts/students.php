<div class="widget"><h4><?php esc_html_e('Enrolled Students','michigan');?></h4>
<?php
global $post;
$students = $wpdb->get_results($wpdb->prepare('SELECT	user_id, meta_value, post_id FROM '.$wpdb->prefix . 'lifterlms_user_postmeta WHERE meta_key = "_status"	AND meta_value = "Enrolled"	AND post_id = %d AND EXISTS(SELECT 1 FROM ' . $wpdb->prefix . 'users WHERE ID = user_id) group by user_id',$post->ID));
if($students){
	echo '<div id="students-box" class="w-crsl">';
	foreach($students as $student){
		$student_avatar = get_avatar( get_the_author_meta( 'user_email',$student->user_id ), 90 );
		echo '<a class="w-avatar" title="'.get_user_meta( $student->user_id, 'nickname', true ).'" href="'.home_url().'/profile/'.get_the_author_meta( 'user_nicename' ,$student->user_id).'">'.$student_avatar.'</a>';	
	}
	echo '</div>';
}else{
	echo '<p class="aligncenter">'.esc_html__('No Student Enrolled.','michigan').'</p>';
}
?>
</div>