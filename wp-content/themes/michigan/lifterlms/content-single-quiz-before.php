<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
use LLMS\Users\User;
global $quiz,$question;
llms_print_notices();
if (!($quiz instanceof LLMS_Quiz)) {$quiz = new LLMS_Quiz( $post->ID ); }
if (!$quiz){$quiz = new LLMS_Quiz( $post->ID );}
$user_id = get_current_user_id();
$quiz_session = LLMS()->session->get( 'llms_quiz' );
$quiz_data = get_user_meta( $user_id, 'llms_quiz_data', true );
$user = new User();
$last_attempt = $quiz->get_users_last_attempt( $user );
$passing_percent = $quiz->get_passing_percent();
//do_action( 'lifterlms_single_quiz_before_summary' );

?>
<form method="POST" action="" name="llms_answer_question" enctype="multipart/form-data">

<!-- Show Result -->
<?php
if ( $quiz->get_total_attempts_by_user( $user_id ) ) {
	$grade = $quiz->get_user_grade( $user_id );
	$quiz->is_passing_score( $user_id, $grade );
	$start_date = $quiz->get_start_date( $user_id );
	$is_passing_score = $quiz->is_passing_score( $user_id, $grade );
	$best_grade = $quiz->get_best_grade( $user_id );
	$time = $quiz->get_total_time( $user_id );
	$start_date = date( 'M d, Y', strtotime( $quiz->get_start_date( $user_id ) ) );
	$best = $quiz->get_best_quiz_attempt( $user_id );
	$best_time = $quiz->get_total_time( $user_id, $best );
?>
<div class="clear"></div>
<div class="llms-template-wrapper">
	<div class="llms-quiz-results">
	<h3> Quiz Results </h3>
		<?php
		//determine if grade, best grade or none should be shown.
		if (isset( $grade ) && isset( $best_grade )) {
			$graph_grade = empty( $grade ) ? $best_grade : $grade;
		?>
			<input type="hidden" id="llms-grade-value" name="llms_grade" value="<?php echo $graph_grade; ?>" />
			<div class="container">
				<div class="col-md-4">
					<div class="llms-progress-circle">
					  <svg>
					  <g>
						 <circle cx="-40" cy="40" r="68" class="llms-background-circle" transform="translate(50,50) rotate(-90)"  />
					  </g>
						<g>
						  <circle cx="-40" cy="40" r="68" class="llms-animated-circle" transform="translate(50,50) rotate(-90)"  />
						</g>
						<g>
						 <circle cx="40" cy="40" r="63" transform="translate(50,50)"  />
						</g>
					  </svg>

					  <div class="llms-progress-circle-count"><?php printf( esc_html__( '%s%%','michigan' ), $graph_grade ); ?></div>
					</div>
				</div>
		<?php } ?>
				<div class="col-md-4">
					<div class="llms-quiz-result-details">
						<?php //if ($grade) : ?>
						<ul>
							<li>
								<h4><?php printf( esc_html__( 'Your Score: %d%%', 'michigan' ), $grade ); ?></h4>
								<h5 class="llms-content-block">
									<?php
									if ( $is_passing_score ) {
										apply_filters( 'lifterlms_quiz_passed','Passed' );
									} else {
										apply_filters( 'lifterlms_quiz_failed','Failed' );
									}
									?>
								</h5>
								<h6><?php printf( esc_html__( '%d / %d correct answers', 'michigan' ), $quiz->get_correct_answers_count( $user_id ), $quiz->get_question_count() ); ?></h6>
								<h6><?php  esc_html_e( 'Date: ', 'michigan' );
								echo '<span class="llms_content_block">'.$start_date.'</span>';?></h6>
								<h6><?php printf( esc_html__( 'Total time: %s', 'michigan' ), $time ); ?></h6>

								<?php if ($quiz->show_quiz_results()) { ?>
									<a class="view-summary"><?php esc_html_e( 'View Summary', 'michigan' ); ?></a>
								<?php } ?>

							</li>
							</li>
						</ul>
						<?php //endif; ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="llms-quiz-result-details">
						<?php //if ($best_grade ) ) : ?>
						<ul>
							<li>
								<h4><?php printf( esc_html__( 'Best Score: %d%%', 'michigan' ), $best_grade ); ?></h4>
								<h5>
									<?php
									if ( $is_passing_score ) {
										apply_filters( 'lifterlms_quiz_passed','Passed' );
									} else {
										apply_filters( 'lifterlms_quiz_failed','Failed' );
									}
									?>
								</h5>
								<h6><?php printf( esc_html__( '%d / %d correct answers', 'michigan' ), $quiz->get_correct_answers_count( $user_id, $best ), $quiz->get_question_count() ); ?></h6>
								<h6><?php  esc_html_e( 'Date: ', 'michigan' );
								echo '<span class="llms_content_block">'.$start_date.'</span>';?></h6>
								<h6><?php printf( esc_html__( 'Total time: %s', 'michigan' ), $best_time ); ?></h6>
							</li>
						</ul>
						<?php //endif; ?>
					</div>
				</div>
			</div>
	</div>
</div>
<?php } ?>



<!-- Show Summary -->
<div class ="llms-template-wrapper quiz-summary">
	<div class = "accordion hidden">
		<div class="panel-group collapsed" id="accordion" role="tablist" aria-multiselectable="true">
		<?php
			foreach ( (array) $last_attempt['questions'] as $key => $question) {
			$background = $question['correct'] ? 'right' : 'wrong';
			$icon = $question['correct'] ? 'llms-icon-checkmark' :  'llms-icon-close';
			$question_object = new LLMS_Question( $question['id'] );
			$options = $question_object->get_options();
			$correct_option = $question_object->get_correct_option();
		?>
				<div class="panel panel-default">
					<div class="panel-heading <?php echo $background ?>" role="tab" id="heading_ <?php echo $key ?>"
					 data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $key?>" aria-expanded="true"
					  aria-controls="collapse_<?php echo $key?>">
						<h4 class="panel-title">
							<?php echo esc_html__( 'Question','michigan' ) . ($key + 1); ?>
							<?php echo LLMS_Svg::get_icon( $icon, 'Lesson', 'Lesson', 'tree-icon' ); ?>
						</h4>
					</div>
					
					<div id="collapse_<?php echo $key ?>" class="panel-collapse collapse <?php echo $background . '-panel' ?>" role="tabpanel" aria-labelledby="heading_<?php echo $key ?>">
						<div class="panel-body">
						<p>
							<?php
								echo do_shortcode( $question_object->post->post_content );
							?>
							</p>
							<div class="clear"></div>
							<ul>
							<?php if (array_key_exists( 'option_text', $options[ $question['answer'] ] )) {
								?>
								<li>
									<span class="llms-quiz-summary-label user-answer">
										<?php echo esc_html__( 'Your answer: ','michigan') . wp_kses_post( $options[ $question['answer'] ]['option_text'] ); ?>
									</span>
								</li>
								<?php }
								if ($quiz->show_correct_answer()) {
									echo '<li><span class="llms-quiz-summary-label correct-answer">';
										echo 'Correct answer: ' . wp_kses_post( $correct_option['option_text'] );
									echo '</span></li>';
								}
								if ($question['correct']) {
									if ($quiz->show_description_right_answer()) {
										if (array_key_exists( 'option_description', $options[ $question['answer'] ] )) {
											echo '<li><span class="llms-quiz-summary-label clarification">' .
												esc_html__( 'Clarification: ','michigan') . wpautop( $options[ $question['answer'] ]['option_description'] )
											. '</span></li>';
										}
									}
								} else {
									if ($quiz->show_description_wrong_answer()) {
										if (array_key_exists( 'option_description', $options[ $question['answer'] ] )) {
											echo '<li><span class="llms-quiz-summary-label clarification">' .
												esc_html__( 'Clarification: ','michigan') . wpautop( $options[ $question['answer'] ]['option_description'] )
											. '</span></li>';
										}
									}
								}
								?>
							</ul>
						</div>
					</div>
				</div>
	  <?php } ?>
		</div>
	</div>
</div>



<!-- Passing Percent -->
<?php if ($passing_percent){ ?>
<div class="clear"></div>
<div class="llms-template-wrapper">
	<h3 class="llms-content-block">
		<?php esc_html_e( 'A score of ', 'michigan' );
		echo '<span class="llms-content llms-pass-perc">'.$passing_percent.'</span>';
		esc_html_e( ' or more is required to pass this test.', 'michigan'); ?>
	</h3>
</div>
<?php } ?>