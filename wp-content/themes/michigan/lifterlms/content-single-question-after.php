<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $post, $quiz, $question;
if (!$quiz) {$quiz = new LLMS_Quiz( $post->ID );}
$question = new LLMS_Question( $args['question_id'] );
if (!$question) {$question = new LLMS_Question( $post->ID );}
$quiz_obj = $quiz;
$options = $question->get_options();
$question_key = isset( $quiz ) ? $quiz->get_question_key : 0;
$quiz_session = $quiz = LLMS()->session->get( 'llms_quiz' );
$answer = '';
if ( ! empty( $quiz_session->questions ) ) {
	foreach ( $quiz_session->questions as $q ) {
		if ( $q['id'] == $question->id ) {
			$answer = $q['answer'];
		}
	}
}
//do_action( 'lifterlms_single_question_after_summary', $args );
?>

<div class="clear"></div>
<div class="llms-question-wrapper asdasd">
	<?php
	if ($quiz_obj->get_show_random_answers()) {llms_shuffle_assoc( $options );}
	foreach ($options as $key => $value) :
		if (isset( $value )) :
			$option = $value['option_text'];
			if ( (int) $answer === (int) $key ) {
				$checked = 'checked';
			} else {
				$checked = '';
			}
	?>
	<div class="llms-option_<?php echo $question_key; ?>">
		<label class="llms-question-label">
			<input type="radio" name="llms_option_selected" value="<?php echo $key; ?>" <?php echo $checked; ?>/>
			<input type="hidden" name="question_type" value="single_choice" />
			<input type="hidden" name="question_id" value="<?php echo $question->id ?>" />
			<?php echo wp_kses_post( $option ); ?>
		</label>
	</div>
	<?php
		endif;
	endforeach;
	?>
</div>

<?php
foreach ( $quiz->questions as $key => $value ) :
	if ( $value['id'] == $question->id ) :
		$previous_question_key = ( $key - 1 );
		if ( $previous_question_key >= 0 ) :
		?>
		<input id="llms_prev_question" type="submit" class="button" name="llms_prev_question" value="<?php esc_html_e( 'Previous Question', 'michigan' ); ?>" />
		<input type="hidden" name="action" value="llms_prev_question" />
		<?php wp_nonce_field( 'llms_prev_question' ); ?>
		<?php
		endif;
	endif;
endforeach;
?>



<?php
foreach ( $quiz->questions as $key => $value ) :
	if ( $value['id'] == $question->id ) :
		$next_question_key = ( $key + 1 );
		if ( $next_question_key > ( count( $quiz->questions ) - 1 ) ) :
			$btn_text = esc_html__( 'Complete Quiz','michigan' );
		else :
			$btn_text = esc_html__( 'Next Question','michigan' );
		endif;
	endif;
endforeach;
?>
<input id="llms_answer_question" type="submit" class="button" name="llms_answer_question" value="<?php printf( esc_html__( '%s', 'michigan' ), $btn_text ); ?>" />
<input type="hidden" name="action" value="llms_answer_question" />
<?php wp_nonce_field( 'llms_answer_question' ); ?>
</form>