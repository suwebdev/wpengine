<?php
/******************/
/**  Single Lesson
/******************/
get_header();
$michigan_webnus_options = michigan_webnus_options();
michigan_webnus_setViews(get_the_ID());
$lesson_features = $michigan_webnus_options['michigan_webnus_lesson_features'];
if (!$lesson) {
	$quiz_session = LLMS()->session->get( 'llms_quiz' );
	$lesson = $quiz_session->assoc_lesson;
	$lesson_link = get_permalink( $lesson );
}else{
	$lesson_link = get_permalink( $lesson );
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
		$homeLink = esc_url(home_url('/'));
		$lesson = new LLMS_Lesson( $post->ID );
		$course_permalink = get_permalink( $lesson->get_parent_course() );
		$course_title = get_the_title( $lesson->get_parent_course() );
		$cat = (get_the_term_list($lesson->get_parent_course(), 'course_cat','',', ' ))? '<i class="fa-angle-right"></i> '.get_the_term_list($lesson->get_parent_course(), 'course_cat','',', ' ) : '';
		echo '<div class="breadcrumbs-w"><div class="container"><div id="crumbs"><a href="'.$homeLink.'">'.esc_html__('Home','michigan').'</a> <i class="fa-angle-right"></i> <a href="' . $homeLink . 'courses/">' .esc_html__('Courses','michigan'). '</a> '. $cat .'  <i class="fa-angle-right"></i> <a href="'.$course_permalink.'" >'.$course_title.'</a>   <i class="fa-angle-right"></i> <span class="current">'.get_the_title().'</span></div></div></div>';
	}
?>

<div class="col-md-12 blgt1-top-sec">

	<h1 class="post-title-ps1"><?php the_title() ?></h1>
<?php if (isset($lesson_features['date']) && $lesson_features['date']){ ?>
	<h6><?php the_time(get_option('date_format')) ?></h6>
<?php } ?>
</div>

<section class="col-md-9 lesson-content cntt-w">
<article class="blog-single-post">

<?php if(isset($lesson_features['image']) && $lesson_features['image'] && has_post_thumbnail()){ ?>
	<div class="post-trait-w">
		<?php get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full', 'link_to_post' => false, ) ); 	?>
	</div>
<?php } ?>

<div <?php post_class('post'); ?>>

<?php if($post->post_content){
echo '<p class="w-lesson-content">';
add_filter( 'lifterlms_full_description', 'do_shortcode' );
echo apply_filters( 'lifterlms_full_description', wptexturize( $post->post_content ) );
echo '</p>';
}?>

<?php
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
	if(is_active_sidebar('llms_lesson_widgets_side')) dynamic_sidebar( 'llms_lesson_widgets_side' );
	?>
	</aside>
</div>

<div class="white-space"></div>
</section>
<?php
get_footer();
?>