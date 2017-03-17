<?php
/******************/
/**  Single Quiz
/******************/
get_header();
$michigan_webnus_options = michigan_webnus_options();
michigan_webnus_setViews(get_the_ID());
$lesson_features = $michigan_webnus_options['michigan_webnus_lesson_features'];
global $quiz;
if ( ! $quiz ) {$quiz = new LLMS_Quiz( $post->ID );}
$user_id = get_current_user_id();
$quiz_session = LLMS()->session->get( 'llms_quiz' );
$quiz_lesson = $quiz->get_assoc_lesson( $user_id );
if ( ! $quiz_lesson ) {
	$lesson_link = get_permalink( $quiz_lesson );
} else {
	$lesson_link = get_permalink( $quiz_lesson );
}
$content = get_the_content();
?>
<section class="container page-content" >
<hr class="vertical-space2">
<?php if( have_posts() ): while( have_posts() ): the_post();
?>
<?php
	if($michigan_webnus_options['michigan_webnus_enable_breadcrumbs'] ) {
		//Breadcrumb
		$lesson = new LLMS_Lesson( $quiz_lesson );
		$course_permalink = get_permalink( $lesson->parent_course );
		$course_title = get_the_title( $lesson->parent_course );
		$homeLink = esc_url(home_url('/'));
		$lesson_title = get_the_title ($quiz_lesson);
		$cat = (get_the_term_list($lesson->parent_course, 'course_cat','',', ' ))? '<i class="fa-angle-right"></i> '.get_the_term_list($lesson->parent_course, 'course_cat','',', ' ) : '';
		echo '<div class="breadcrumbs-w"><div class="container"><div id="crumbs"><a href="'.$homeLink.'">'.esc_html__('Home','michigan').'</a> <i class="fa-angle-right"></i> <a href="' . $homeLink . 'courses/">' .esc_html__('Courses','michigan'). '</a> '. $cat .' <i class="fa-angle-right"></i> <a href="'.$course_permalink.'" >'.$course_title.'</a> <i class="fa-angle-right"></i> <a href="'.$lesson_link.'" >'.$lesson_title.'</a> <i class="fa-angle-right"></i> <span class="current">'.get_the_title().'</span></div></div></div>';
	}
?>

<div class="col-md-12 blgt1-top-sec">


	<h1 class="post-title-ps1"><?php the_title() ?></h1>
<?php if (isset($lesson_features['date']) && $lesson_features['date']){ ?>
	<h6><?php the_time(get_option('date_format')) ?></h6>
<?php } ?>
</div>

<section class="col-md-9 lesson-content cntt-w">
<div class="row">
	<div class="col-md-6">
		<div class="post-thumbnail quiz-thumbnail">
			<?php if(isset($lesson_features['image']) && $lesson_features['image'] && has_post_thumbnail()){
				get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'michigan_webnus_blog2_img' ) );
			}else{
				$no_image_src = ($michigan_webnus_options['michigan_webnus_course_no_image_src'])?$michigan_webnus_options['michigan_webnus_course_no_image_src']: get_template_directory_uri().'/images/course_no_image.png';
				echo '<img alt="'.get_the_title().'" width="420" height="330" src="'.$no_image_src.'">';
			} ?>
		</div>
	</div>
	<div class="col-md-6">
		<?php
		$time_limit = $quiz->get_time_limit();
		$attempts_left = $quiz->get_remaining_attempts_by_user( $user_id );

		// Attempts Left
		if ($attempts_left){ ?>
		<div class="llms-template-wrapper">
			<h4 class="llms-content-block">
				<?php printf( __( '<i class="fa-asterisk"></i> Attempts Remaining: <span class="llms-content llms-attempts">%s</span>', 'michigan' ), $attempts_left ); ?>
			</h4>
		</div>
		<?php } //Time Limit
		if ( $time_limit ) { ?>
		<div class="clear"></div>
		<div class="llms-template-wrapper">
			<h4 class="llms-content-block">
				<?php printf( __( '<i class="fa-clock-o"></i> Time Limit: <span class="llms-content">%s</span>', 'michigan' ), LLMS_Date::convert_to_hours_minutes_string( $time_limit ) ); ?>
			</h4>
		</div>
		<?php } //Timer
		if ($time_limit){ ?>
			<div id="llms-quiz-timer">
				<input type="hidden" id="set-time" value="<?php echo $time_limit; ?>"/>
				<div id="countdown">
					<div id='tiles' class="color-full"></div>
					<div class="countdown-label"><p>Time Remaining</p></div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<article class="lesson-single-post">
<div <?php post_class('post'); ?>>
<?php if($post->post_content){ ?>
	<div class="quiz-description">
		<?php
		echo '<h4>'.esc_html__('Description','michigan').'</h4>';
		echo '<p class="w-lesson-content">';
		echo apply_filters( 'lifterlms_full_description', wptexturize( $post->post_content ) );
		echo '</p>';
		?>
	</div>
<?php }
echo apply_filters('the_content',$content);
endwhile;
endif;
?>

</div>
</article>
<?php
if(isset($lesson_features['comment']) && $lesson_features['comment']){
	comments_template();
}
?>
</section>
<!-- end-main-conten -->

<div class="col-md-3 sidebar">
	<aside class="course-bar">
	<?php //back to course
	if(isset($lesson_features['instructor']) && $lesson_features['instructor']){
		get_template_part('parts/instructor-box' );
	}
	if(is_active_sidebar('llms_lesson_widgets_side')) dynamic_sidebar( 'Lesson Sidebar' );
	get_template_part('parts/more-courses' );
	?>
	</aside>
</div>

<div class="white-space"></div>
</section>
<?php
get_footer();
?>