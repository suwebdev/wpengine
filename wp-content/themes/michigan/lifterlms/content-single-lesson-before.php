<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
llms_print_notices();
//do_action( 'lifterlms_single_lesson_before_summary' );

global $post , $lesson;
if ( ! isset( $lesson )) {
	$lesson = new LLMS_Lesson( $post->ID );
}
$course_not_class = get_post_custom( $post->ID );


//lesson video
if (isset($lesson->video_embed)){ ?>
<div class="llms-video-wrapper">
	<div class="center-video">
		<?php echo $lesson->get_video(); ?>
	</div>
</div>
<?php } ?>

<?php //lesson audio
if (isset($lesson->audio_embed)){ ?>
<div class="llms-audio-wrapper">
	<div class="center-audio">
		<?php echo $lesson->get_audio(); ?>
	</div>
</div>
<?php } ?>