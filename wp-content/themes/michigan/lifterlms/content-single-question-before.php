<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $post;
$question = new LLMS_Question( $args['question_id'] );
if ( ! $question ) {$question = new LLMS_Question( $post->ID );}
$quiz = LLMS()->session->get( 'llms_quiz' );
$question_count = count( $quiz->questions );
//do_action( 'lifterlms_single_question_before_summary' );
?>
<form method="POST" action="" name="llms_answer_question" enctype="multipart/form-data">
<p class="llms-question-count">
<?php
if ($quiz) {
	foreach ( $quiz->questions as $key => $value ) {
		if ( $value['id'] == $question->id ) {
			$current_question = ( $key + 1 );
		}
	}
	printf( esc_html__( 'Question %d of %d', 'michigan' ), ( empty( $current_question ) ? '' : $current_question ), $question_count );
}
?>
</p>