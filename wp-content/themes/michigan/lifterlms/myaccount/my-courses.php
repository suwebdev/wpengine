<?php
/**
 * My Courses List
 * Used in My Account and My Courses shortcodes
 *
 * @version  3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $wp_query;

//Instructor Dashboard
global $wpdb;
$user_id = get_current_user_id();
$args = array(
	'post_type' => 'course' ,
	'author' => $user_id,
	'posts_per_page' => -1
);
$custom_posts = new WP_Query( $args );
$instructor_rate_score = $instructor_rate_users = $instructor_rate = $course_count = $student_count = $total_all_orders = $total_orders = 0;
while ( $custom_posts->have_posts() ) : $custom_posts->the_post();
	$post_id = get_the_ID();
	$students = $wpdb->get_results($wpdb->prepare(
		'SELECT
		user_id,
		meta_value,
		post_id
		FROM '.$wpdb->prefix . 'lifterlms_user_postmeta
		WHERE meta_key = "_status"
		AND meta_value = "Enrolled"
		AND post_id = %d
		AND EXISTS(SELECT 1 FROM ' . $wpdb->prefix . 'users WHERE ID = user_id)
		group by user_id'
	,$post_id));
	$orders = $wpdb->get_results($wpdb->prepare(
		'SELECT
		order_post_id
		FROM '.$wpdb->prefix . 'lifterlms_order
		WHERE product_id = %d
		AND order_completed = "yes"
		group by order_post_id'
	,$post_id));
	foreach ($orders as $order) {
		$total_orders += get_post_meta( $order->order_post_id, '_llms_order_total', true );
	}
	if(function_exists('the_ratings')) {
		$instructor_rate_score = $instructor_rate_score + get_post_meta($post_id, 'ratings_score' , true);
		$instructor_rate_users = $instructor_rate_users + get_post_meta($post_id, 'ratings_users' , true);
	}
	$course_count++;
	$student_count = $student_count + count($students);
	$total_all_orders = $total_all_orders + $total_orders;
endwhile;
$instructor_rate = ($instructor_rate_users)?($instructor_rate_score/$instructor_rate_users):0;
wp_reset_postdata();
delete_user_meta( $user_id, 'instructor_is');
delete_user_meta( $user_id, 'instructor_courses');
delete_user_meta( $user_id, 'instructor_students');
delete_user_meta( $user_id, 'instructor_rate');
add_user_meta( $user_id, 'instructor_is', true);
add_user_meta( $user_id, 'instructor_courses', $course_count);
add_user_meta( $user_id, 'instructor_students', $student_count);
add_user_meta( $user_id, 'instructor_rate', $instructor_rate);


if (current_user_can('edit_posts')){ ?>
	<div class="instructor-dashboard">
		<div class="row">
			<div class="col-md-3">
				<div class="hcolorb colorr inst-cell">
					<div class="inst-cell-icon">
						<i class="colorf fa-money"></i>
					</div>
					<div class="inst-cell-desc">
						<h4 class="inst-cell-title"><?php esc_html_e( 'Total Revenue', 'michigan' );?></h4>
						<span><?php echo get_lifterlms_currency_symbol().$total_all_orders; ?></span>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="hcolorb colorr inst-cell">
					<div class="inst-cell-icon">
						<i class="colorf sl-book-open"></i>
					</div>
					<div class="inst-cell-desc">
						<h4 class="inst-cell-title"><?php esc_html_e( 'Total Courses', 'michigan' );?></h4>
						<span><?php echo get_the_author_meta( 'instructor_courses',$user_id); ?></span>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="hcolorb colorr inst-cell">
					<div class="inst-cell-icon">
						<i class="colorf sl-people"></i>
					</div>
					<div class="inst-cell-desc">
						<h4 class="inst-cell-title"><?php esc_html_e( 'Total Students', 'michigan' );?></h4>
						<span><?php echo get_the_author_meta( 'instructor_students',$user_id); ?></span>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="hcolorb colorr inst-cell">
					<div class="inst-cell-icon">
						<i class="colorf sl-star"></i>
					</div>
					<div class="inst-cell-desc">
						<h4 class="inst-cell-title"><?php esc_html_e( 'Average Rates', 'michigan' );?></h4>
						<span><?php echo get_the_author_meta( 'instructor_rate',$user_id); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }

/* Taught Courses */
	$args = array(
		'post_type' => 'course' ,
		'author' => $user_id,
		'showposts' => 10
	);
	$custom_posts = new WP_Query( $args );
	if ( $custom_posts->have_posts() ){ ?>
	<div class="clearfix author-courses w-llms-my-courses">
	<?php
		echo '<h3><i class="fa-chevron-right"></i> ' . apply_filters( 'lifterlms_my_courses_title', esc_html__( 'Taught Courses', 'michigan' ) ) . '</h3>';
		echo '<div class="author-carousel">';
		while ( $custom_posts->have_posts() ) : $custom_posts->the_post();
			$post_id = get_the_ID();
			$students = $wpdb->get_results($wpdb->prepare(
				'SELECT
					user_id,
					meta_value,
					post_id
				FROM '.$wpdb->prefix . 'lifterlms_user_postmeta
				WHERE meta_key = "_status"
				AND meta_value = "Enrolled"
				AND post_id = %d
				AND EXISTS(SELECT 1 FROM ' . $wpdb->prefix . 'users WHERE ID = user_id)
				group by user_id'
			,$post_id));
			$course_students = rwmb_meta( 'michigan_course_students_meta' ) ? rwmb_meta( 'michigan_course_students_meta' ):count($students);
			$image_m = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'michigan_webnus_blog2_img','echo'=>false, ) );
			$no_img_m = get_template_directory_uri().'/images/course_no_image.png';
			$llms_product = new LLMS_Product( $post_id );
			$course_duration = get_post_meta( $post_id, '_llms_length', true );
			echo '<article class="modern-grid llms-course-list"><div class="llms-course-link">';
			echo '<div class="modern-feature"><a class="" href="'.get_the_permalink().'">';
			echo ($image_m)? $image_m :'<img src="' . $no_img_m . '" alt="Placeholder" class="w-no-img" />';
			echo ($course_duration)?'<span class="modern-duration">'.$course_duration.'<i class="fa-clock-o"></i></span>':'';
			echo '</a></div>';
			echo '<div class="modern-content">';
			echo '<h3 class="llms-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
			if(function_exists('the_ratings')) {
				echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Votes','michigan').')</strong></div>', get_the_ID());
			}
				echo '<div class="llms-price-wrapper"><h4 class="llms-price"><span>';
				course_price();
				echo '</span></h4></div>';
			echo '</div>';
			echo '<div class="clearfix modern-meta">';
			echo '<div class="col-md-8 col-sm-8 col-xs-8">';
			if ( ! isset( $lesson )) {$lesson = new LLMS_Lesson( $post_id );}
			$course_id = $lesson->parent_course;
			$my_post = get_post( $course_id );
			$author_id = $my_post->post_author;
			$total_orders ='0';
				$orders = $wpdb->get_results($wpdb->prepare(
				'SELECT
				order_post_id
				FROM '.$wpdb->prefix . 'lifterlms_order
				WHERE product_id = %d
				AND order_completed = "yes"
				group by order_post_id'
			,$post_id));
			foreach ($orders as $order) {
				$total_orders += get_post_meta( $order->order_post_id, '_llms_order_total', true );
			}
			echo '<div title="'.esc_attr('Total Sold','michigan').'" class="modern-viewers"><i class="fa-money"></i> '. get_lifterlms_currency_symbol().$total_orders .'</div>';
			echo '</div>';
			echo '<div class="col-md-4 col-sm-4 col-xs-4">';
			echo ($course_students)?'<span class="modern-students" title="'.esc_attr('Enrolled Students','michigan').'"><i class="sl-people"></i>'.$course_students.'</span>':'<span class="modern-viewers" title="'.esc_attr('Viewers','michigan').'"><i class="fa-eye"></i>'.michigan_webnus_getViews(get_the_ID()).'</span>';
			echo '</div>';
			echo'</div>';
			echo '</div></article>';
		endwhile;
	echo '</div>';
	echo '</div>';
	}else{
		// nothing found
	}
	wp_reset_postdata();
?>

<div class="llms-sd-section llms-my-courses w-llms-my-courses">
	<div class="container wn-course-progress">
		<div class="col-md-6">
			<h3><i class="fa-chevron-right"></i> <?php echo apply_filters( 'lifterlms_my_courses_title', __( 'Courses In-Progress', 'lifterlms' ) ); ?></h3>
		</div>
		<div class="col-md-6">
			<div class="llms-sd-pagination llms-my-courses-pagination">
				<?php if ( isset( $wp_query->query_vars['my-courses'] ) &&  $courses['results'] ) : ?>
					<?php if ( $courses['skip'] > 0 ) : ?>
						<a class="llms-button-text" href="<?php echo esc_url( add_query_arg( array(
							'limit' => $courses['limit'],
							'skip' => $courses['skip'] - $courses['limit'],
						), llms_person_my_courses_url() ) ); ?>"><?php _e( 'Back', 'lifterlms' ); ?></a>
					<?php endif; ?>

					<?php if ( $courses['more'] ) : ?>
						<a class="llms-button-text" href="<?php echo esc_url( add_query_arg( array(
							'limit' => $courses['limit'],
							'skip' => $courses['skip'] + $courses['limit'],
						), llms_person_my_courses_url() ) ); ?>"><?php _e( 'Next', 'lifterlms' ); ?></a>
					<?php endif; ?>
				<?php else : ?>

					<?php if ( count( $courses['results'] ) ) : ?>
						<a class="llms-button-text" href="<?php echo esc_url( llms_person_my_courses_url() ); ?>"><?php _e( 'View All My Courses', 'lifterlms' ); ?></a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ( ! $courses['results'] ) : ?>
		<p><?php _e( 'You are not enrolled in any courses.', 'lifterlms' ); ?></p>
	<?php else : ?>
		<div class="author-carousel">
			<?php foreach ( $courses['results'] as $c ) : $c = new LLMS_Course( $c );?>
				<article class="modern-grid llms-course-list">
					<div class="llms-course-link">
						<div class="modern-feature">
							<a href="<?php echo $c->get_permalink(); ?>">
								<?php global $post;
									if ( has_post_thumbnail( $c->get_id() ) ) {
										echo llms_featured_img( $c->get_id(), 'michigan_webnus_blog2_img' );
									} elseif ( llms_placeholder_img_src() ) {
										echo llms_placeholder_img();
									}?>
								<span class="modern-duration">
									<?php echo apply_filters( 'lifterlms_my_courses_enrollment_status_html',
									'<span class="llms-sts-enrollment">
										<span class="llms-sts-label">' . __( 'Status:','lifterlms' ) . '</span>
										<span class="llms-sts-current">' . $student->get_enrollment_status( $c->get_id() ) . '</span>
									</span>'
									); ?>
									<i class="fa-info"></i>
								</span>
							</a>
						</div>
						<div class="modern-content">
							<h3 class="llms-title">
								<a href="<?php echo $c->get_permalink(); ?>"><?php echo $c->get_title(); ?></a>
							</h3>
							<?php if ( 'yes' === get_option( 'lifterlms_course_display_author' ) ) : ?>
								<span class="author"><?php printf( __( 'Author: %s', 'lifterlms' ), '<span>' . $c->get_author_name() . '</span>' ); ?></span>
							<?php endif; ?>
							<?php
							if(function_exists('the_ratings')) {
							 echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Votes','michigan').')</strong></div>', $c->get_id() ); }
							echo apply_filters('lifterlms_my_courses_start_date_html',
									'<div class="llms-start-date"><i class="fa-calendar"></i> ' . __( 'Course Started','lifterlms' ) . ' - ' . $student->get_enrollment_date( $c->get_id(), 'enrolled' ) . '</div>'
								); ?>
							<div class="llms-progress">
								<?php $progress = $c->get_percent_complete( $student->get_id() ); ?>
								<div class="progress__indicator"><?php echo $progress; ?>%</div>
								<div class="llms-progress-bar">
									<div class="progress-bar-complete" style="width:<?php echo $progress ?>%"></div>
								</div>
							</div>
							<div class="course-link">
								<a href="<?php echo $c->get_permalink(); ?>" class="button llms-button-primary llms-button colorb"><?php echo apply_filters( 'lifterlms_my_courses_course_button_text', __( 'View Course', 'lifterlms' ) ); ?></a>
							</div>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	<?php endif; ?>
</div>