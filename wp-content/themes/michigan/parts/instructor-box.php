<?php //Course Instructor
global $post;
$author_id = get_the_author_meta('ID');
$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author_id ), 265 );
$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name',$author_id ).'</a>';
$facebook = esc_url(get_the_author_meta( "facebook",$author_id));
$twitter = esc_url(get_the_author_meta( "twitter",$author_id));
$google_plus = esc_url(get_the_author_meta( "googleplus",$author_id));
$linkedin = esc_url(get_the_author_meta( "linkedin",$author_id));
$youtube = esc_url(get_the_author_meta( "youtube",$author_id));
$instructor_email = get_the_author_meta( 'display_email' , $author_id);
$url = esc_url(get_the_author_meta( "url",$author_id));
$bio =  get_the_author_meta( "biography",$author_id);

echo '<div class="instructor-box">';
echo '<div class="w-avatar">'.$instructor_avatar.'</div>';	
echo '<h5>'.esc_html__('Instructor: ','michigan').$instructor_title.'</h5>';
echo '<div class="instructor-info-box">';
echo ($bio)? '<h6>'.esc_html__('About Me','michigan').'</h6><div class="w-about-me">'.$bio.'</div>' : '';
echo '<div class="social-instructor">';
echo ($url)?'<a href="'.$url.'" class="instructor-social" target="_blank"><i class="fa-globe"></i></a>':'';
echo ($instructor_email)?'<a href="mailto:'.$instructor_email.'" class="instructor-social"><i class="fa-envelope"></i></a>':'';
echo ($facebook)?'<a target="_blank" href="'.$facebook.'" class="instructor-social" target="_blank"><i class="fa-facebook"></i></a>' : '';
echo ($twitter)?'<a target="_blank" href="'.$twitter.'" class="instructor-social" target="_blank"><i class="fa-twitter"></i></a>' : '';
echo ($google_plus)?'<a target="_blank" href="'.$google_plus.'" class="instructor-social" target="_blank"><i class="fa-google-plus"></i></a>' : '';
echo ($linkedin)?'<a target="_blank" href="'.$linkedin.'" class="instructor-social" target="_blank"><i class="fa-linkedin"></i></a>' : '';				
echo ($youtube)?'<a target="_blank" href="'.$youtube.'" class="instructor-social" target="_blank"><i class="fa-youtube"></i></a>' : '';				
echo '</div>';
echo '</div>';
echo '</div>';