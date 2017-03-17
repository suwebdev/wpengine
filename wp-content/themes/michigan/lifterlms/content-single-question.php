<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
llms_print_notices();
$query_args = array(
	'post_type' => array( 'llms_question' ),
	'orderby' => 'ASC',
	'post__in' => array( $args['question_id'] ),
);
$loop = new WP_Query( $query_args );
if ( ! $loop->have_posts() ) {
		get_template_part( 'content', 'none' );
} else {
	while ($loop->have_posts()) : $loop->the_post();
			ob_start(); //before content
			global $question;
			global $post;
			?>
			<form method="POST" action="" name="llms_answer_question" enctype="multipart/form-data">
			<?php
			$question = new LLMS_Question( $args['question_id'] );
			if ( ! $question ) {
				$question = new LLMS_Question( $post->ID );
			}
			$quiz = LLMS()->session->get( 'llms_quiz' );
			$question_count = count( $quiz->questions );
			if ( ! empty( $quiz ) ) {
				foreach ( $quiz->questions as $key => $value ) {
					if ( $value['id'] == $question->id ) {
						$current_question = ( $key + 1 );
					}
				}
					$question_number = str_pad($current_question, 2, "0", STR_PAD_LEFT);

			}
			?>
			<div class="container w-question">
			<div class="col-md-2 col-sm-2">
				<div class="question-number"><?php echo $question_number; ?></div>
			</div>
			<div class="col-md-8 col-sm-8">
				<div class="main-question"><?php the_content(); ?></div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="questions-total"><?php esc_html_e('Question','michigan');?>
				<span class="questions-total-number"> <?php printf( esc_html__( '%d of %d', 'michigan' ), ( empty( $current_question ) ? '' : $current_question ), $question_count ); ?> </span></div>
			</div>
			</div>
			<?php
			$html .= ob_get_contents();
			ob_clean();
			ob_start(); //after content
			$quiz = new LLMS_Quiz( $args['quiz_id'] );
			$quiz_obj = $quiz;
			$question = new LLMS_Question( $args['question_id'] );
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
			?>
			<div class="clear"></div>
			<div class="llms-question-wrapper">
			<div class="row">
				<div class="col-md-8">
					<?php
					if ( $quiz_obj->get_show_random_answers()) {
						llms_shuffle_assoc( $options );
					}
					foreach ($options as $key => $value) :
						if (isset( $value )) :
							$option = $value['option_text'];
							if ( ( (int) $answer === (int) $key ) && '' !== $answer ) {
								$checked = 'checked';
							} else {
								$checked = '';
							}
					?>
					<div class="llms-option_<?php echo $question_key; ?>">
						<label class="llms-question-label">
							<input type="radio" name="llms_option_selected" id="question-answer" value="<?php echo $key; ?>" <?php echo $checked; ?>/>
							<input type="hidden" name="question_type" id="question-type" value="single_choice" />
							<input type="hidden" name="question_id" id="question-id" value="<?php echo $question->id ?>" />
							<input type="hidden" name="quiz_id" id="quiz-id" value="<?php echo $quiz->id ?>" />
							<?php echo wp_kses_post( $option ); ?>
						</label>
					</div>
					<?php
						endif;
					endforeach;
					global $post;
					$question = new LLMS_Question( $args['question_id'] );
					if ( ! $question ) {
						$question = new LLMS_Question( $post->ID );
					}
					$quiz = LLMS()->session->get( 'llms_quiz' );
					foreach ( $quiz->questions as $key => $value ) :
						if ( $value['id'] == $question->id ) :
							$previous_question_key = ( $key - 1 );
							if ( $previous_question_key >= 0 ) :
							?>
							<input id="llms_prev_question" type="submit" class="button" name="llms_prev_question" value="<?php esc_html_e( 'Previous Question', 'michigan' ); ?>" />
							<input type="hidden" name="action" value="llms_prev_question" />
							<?php wp_nonce_field( 'llms_prev_question' );
							endif;
						endif;
					endforeach;
					global $post;
					$question = new LLMS_Question( $args['question_id'] );
					if ( ! $question ) {
						$question = new LLMS_Question( $post->ID );
					}
					$options = $question->get_options();
					$quiz = LLMS()->session->get( 'llms_quiz' );
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
				</div>
				<div class="col-md-4">
					<?php
						get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full', 'link_to_post' => false, ) );
					?>
				</div>
			</div>

			</div>
			<?php
			echo '</form>';
		$html .= ob_get_contents();
		ob_clean();
		endwhile;
}
	echo $html;
	wp_reset_postdata();