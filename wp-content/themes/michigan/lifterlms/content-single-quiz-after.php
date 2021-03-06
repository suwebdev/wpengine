<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $quiz;
$user_id = get_current_user_id();
$quiz_session = LLMS()->session->get( 'llms_quiz' );
$lessonid = $quiz->get_assoc_lesson( $user_id );
$lesson = new LLMS_Lesson( $lessonid );
if ( $quiz ) {
	$attempts = $quiz->get_remaining_attempts_by_user( $user_id );
	$grade = $quiz->get_user_grade( $user_id );
}
//do_action( 'lifterlms_single_quiz_after_summary' );
?>

</form>

<div class="clear"></div>
<div class="llms-button-wrapper" id="quiz-start-button">
<?php
if ( empty( $quiz ) || 'unlimited' === $attempts || $attempts > 0 || '' == $quiz->get_end_date( $user_id ) ) {
?>
	<form method="POST" action="" name="llms_start_quiz" enctype="multipart/form-data">
	 	<?php do_action( 'lifterlms_before_start_quiz' ); ?>
		<input id="llms-user" name="llms-user_id" type="hidden" value="<?php echo $user_id; ?>"/>
	 	<input id="llms-quiz" name="llms-quiz_id" type="hidden" value="<?php echo $quiz->id; ?>"/>
	 	<input id="llms_start_quiz" type="button" class="button" name="llms_start_quiz" value="<?php esc_html_e( 'Start Quiz', 'michigan' ); ?>" />
	 	<input type="hidden" name="action" value="llms_start_quiz" />

	 	<?php
	 	if ($lesson->get_next_lesson() && $quiz->is_passing_score( $user_id, $grade )) {
			$t = $lesson->get_next_lesson();
	 		?>
	 		<a href="<?php echo get_permalink( $lesson->get_next_lesson() );?>" class="button llms-next-lesson" style="text-decoration:none; display:inline;"><?php esc_html_e( 'Next Lesson','michigan' ); ?></a>
	 		<?php
	 	}
	 	?>

	 	<?php wp_nonce_field( 'llms_start_quiz' ); ?>
		<?php do_action( 'lifterlms_after_start_quiz' ); ?>
	</form>
<?php
} else {
	esc_html_e( '<p>You are not able take this quiz</p>', 'michigan' );
}
?>
</div>

<div id="llms-quiz-question-wrapper"></div>