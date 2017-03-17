<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

//do_action( 'lifterlms_single_lesson_after_summary' );
echo '<div class="lesson-button-navigation">';
llms_get_template( 'course/complete-lesson-link.php' );
llms_get_template( 'course/lesson-navigation.php' );
echo '</div>';