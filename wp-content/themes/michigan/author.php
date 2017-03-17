<?php
get_header();
global $curauth;
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<section>
	<hr class="vertical-space1">
	<div class="container">
		<div class="about-author-sec">
			<div class="col-md-3 col-sm-3">
				<?php
				$user_id = get_queried_object_id();
				$facebook = esc_url(get_the_author_meta( "facebook",$user_id));
				$twitter = esc_url(get_the_author_meta( "twitter",$user_id));
				$google_plus = esc_url(get_the_author_meta( "googleplus",$user_id));
				$linkedin = esc_url(get_the_author_meta( "linkedin",$user_id));
				$youtube = esc_url(get_the_author_meta( "youtube",$user_id));
				$title = get_the_author_meta( "title",$user_id);
				$instructor_email = get_the_author_meta( 'display_email' , $user_id);
				$url = esc_url(get_the_author_meta( "url",$user_id));
				echo get_avatar( get_the_author_meta( 'user_email',$user_id ), 250 );
				echo '<div class="social-instructor">';
				echo ($url)?'<a href="'.$url.'" class="instructor-social" target="_blank"><i class="fa-globe"></i></a>':'';
				echo ($instructor_email)?'<a href="mailto:'.$instructor_email.'" class="instructor-social"><i class="fa-envelope"></i></a>':'';
				echo ($facebook)?'<a href="'.$facebook.'" class="instructor-social" target="_blank"><i class="fa-facebook"></i></a>':'';
				echo ($twitter)?'<a href="'.$twitter.'" class="instructor-social" target="_blank"><i class="fa-twitter"></i></a>':'';
				echo ($linkedin)?'<a href="'.$linkedin.'" class="instructor-social" target="_blank"><i class="fa-linkedin"></i></a>':'';
				echo ($google_plus)?'<a href="'.$google_plus.'" class="instructor-social" target="_blank"><i class="fa-google-plus"></i></a>':'';
				echo ($youtube)?'<a href="'.$youtube.'" class="instructor-social" target="_blank"><i class="fa-youtube"></i></a>':'';
				echo '</div>';
				?>
			</div>
			<div class="col-md-9 col-sm-9">
				<h3><?php echo esc_html($curauth->display_name); ?></h3>
				<?php if ($curauth->ID == get_current_user_id()){
				if (is_plugin_active('buddypress/bp-loader.php')) { //Buddypress
					echo '<a href="'. bp_loggedin_user_domain().'profile/account-setting/">'.esc_html__( 'Edit Profile', 'michigan' ).'</a>';
				}elseif(is_plugin_active('lifterlms/lifterlms.php')) { //LifterLMS
					echo '<a href="'.get_permalink( llms_get_page_id('myaccount')).get_option( 'lifterlms_myaccount_edit_account_endpoint', 'edit-account' ).'">'.esc_html__( 'Edit Profile', 'michigan' ).'</a>';
				}
				} ?>
				<h6 class="colorf"><?php echo $title; ?></h6>
				<?php
				michigan_webnus_instructor_update($user_id);
				if (get_the_author_meta( 'instructor_is',$user_id)){
					echo '<div class="instructor-detail">
					<span><i class="colorf sl-book-open"></i> ' . esc_html__('Total Courses:','michigan') . ' ' . get_the_author_meta( 'instructor_courses',$user_id).'</span> <span><i class="colorf sl-people"></i> ' . esc_html__('Total Students:','michigan') . ' ' . get_the_author_meta( 'instructor_students',$user_id).'</span> <span><i class="colorf sl-star"></i> ' . esc_html__('Average Rates:','michigan') . ' ' . get_the_author_meta( 'instructor_rate',$user_id) . '</span></div>';
				}
				?>
				<p><?php echo esc_html($curauth->description); ?></p>
			</div>
			<div class="clear"></div>
		</div>
		<?php /* Taught Courses */
		$args = array(
			'post_type' => 'course' ,
			'author' => get_queried_object_id(), // this will be the author ID on the author page
			'showposts' => 10
		);
		$custom_posts = new WP_Query( $args );
		if ( $custom_posts->have_posts() ){ ?>
		<div class="clearfix author-courses">
		<?php
			echo '<h4 class="course-title">'.esc_html__('Taught Courses','michigan').'</h4>';
			echo '<div class="author-carousel">';
			while ( $custom_posts->have_posts() ) : $custom_posts->the_post();
				$post_id = get_the_ID();
				$students = $wpdb->get_results($wpdb->prepare('SELECT user_id, meta_value, post_id FROM '.$wpdb->prefix . 'lifterlms_user_postmeta WHERE meta_key = "_status" AND meta_value = "Enrolled" AND post_id = %d AND EXISTS(SELECT 1 FROM ' . $wpdb->prefix . 'users WHERE ID = user_id) group by user_id',$post_id));
				$course_students = rwmb_meta( 'michigan_course_students_meta' ) ? rwmb_meta( 'michigan_course_students_meta' ):count($students);
				$image_m = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'michigan_webnus_blog2_img','echo'=>false, ) );
				$no_img_m = get_template_directory_uri().'/images/course_no_image.png';
				$course_duration = get_post_meta( $post_id, '_llms_length', true );
				echo '<article class="modern-grid llms-course-list"><div class="llms-course-link"><div class="modern-feature">';?>
				<?php echo ($image_m)? $image_m :'<img src="' . $no_img_m . '" alt="Placeholder" class="w-no-img" />';
				echo ($course_duration)?'<span class="modern-duration">'.$course_duration.'<i class="fa-clock-o"></i></span>':'';
				echo '</div>'; //close modern feature
				echo '<div class="modern-content">';
				echo '<h3 class="llms-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
				if(function_exists('the_ratings')) {
					echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Votes','michigan').')</strong></div>', get_the_ID());
				}
				echo '<div class="llms-price-wrapper"><h4 class="llms-price"><span>';
				course_price();
				echo'</span></h4></div>';
				echo '</div>'; //close modern content
				echo '<div class="clearfix modern-meta">';
				echo '<div class="col-md-8 col-sm-8 col-xs-8">';
				echo '<div class="modern-instructor">'.get_avatar( get_the_author_meta( 'user_email',$user_id ), 20 ) . get_the_author().'</div>';
				echo '</div>';
				echo '<div class="col-md-4 col-sm-4 col-xs-4">';
				echo ($course_students)?'<span class="modern-students" title="'.esc_attr('Enrolled Students','michigan').'"><i class="sl-people"></i>'.$course_students.'</span>':'<span class="modern-viewers" title="'.esc_attr('Viewers','michigan').'"><i class="fa-eye"></i>'.michigan_webnus_getViews(get_the_ID()).'</span>';
				echo '</div>';
				echo'</div>'; //close modern meta
				echo '</div></article>';
			endwhile;
		echo '</div>';
		echo '</div>'; //close author courses
		}else{
			// nothing found
		}
		wp_reset_postdata();

		/* Inrolled Courses */
		$courses = $wpdb->get_results($wpdb->prepare(
			'SELECT
				user_id,
				meta_value,
				post_id
			FROM '.$wpdb->prefix . 'lifterlms_user_postmeta
			WHERE meta_key = "_status"
			AND meta_value = "Enrolled"
			AND user_id = %d
			AND EXISTS(SELECT 1 FROM ' . $wpdb->prefix . 'users WHERE ID = user_id)
			group by post_id'
		,$user_id));
		if ($courses){
			echo '<div class="clearfix author-courses">';
			echo '<hr class="vertical-space2"><h4 class="course-title">'.esc_html__('Courses Enrolled','michigan').'</h4>';
			echo '<div class="author-carousel">';
			foreach($courses as $course){
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
				,$course->post_id));
				$course_students = rwmb_meta( 'michigan_course_students_meta' ) ? rwmb_meta( 'michigan_course_students_meta' ):count($students);
				$course_duration = get_post_meta( $course->post_id, '_llms_length', true );
				$no_img_m = get_template_directory_uri().'/images/course_no_image.png';
				$image_m = get_the_post_thumbnail ($course->post_id, 'michigan_webnus_blog2_img');
				echo '<article class="modern-grid llms-course-list"><div class="llms-course-link">';
				echo '<div class="modern-feature"><a class="" href="'.get_the_permalink($course->post_id).'">';
				echo ($image_m)? $image_m :'<img src="' . $no_img_m . '" alt="Placeholder" class="w-no-img" />';
				echo ($course_duration)?'<span class="modern-duration">'.$course_duration.'<i class="fa-clock-o"></i></span>':'';
				echo '</a></div>'; //close modern feature
				echo '<div class="modern-content">';
				echo '<h3 class="llms-title"><a href="'.get_the_permalink($course->post_id).'">'.get_the_title($course->post_id).'</a></h3>';
				if(function_exists('the_ratings')) {
					echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Votes','michigan').')</strong></div>', $course->post_id);
				}
				echo '<div class="llms-price-wrapper"><h4 class="llms-price"><span>';
				course_price();
				echo'</span></h4></div>';
				echo '</div>'; //close modern content
				echo '<div class="clearfix modern-meta">';
				echo '<div class="col-md-8 col-sm-8 col-xs-8">';
				$my_post = get_post($course->post_id);
				$author_id = $my_post->post_author;
				$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 );
				$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'. get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 ).get_the_author_meta( 'display_name',$author_id ).'</a>';
				echo  '<div class="modern-instructor">'.$instructor_title.'</div>';
				echo '</div>';
				echo '<div class="col-md-4 col-sm-4 col-xs-4">';
				echo ($course_students)?'<span class="modern-students" title="'.esc_attr('Enrolled Students','michigan').'"><i class="sl-people"></i>'.$course_students.'</span>':'<span class="modern-viewers" title="'.esc_attr('Viewers','michigan').'"><i class="fa-eye"></i>'.michigan_webnus_getViews($course->post_id).'</span>';
				echo '</div>';
				echo'</div>'; //close modern meta
				echo '</div></article>';
			}
			echo '</div>';
		}
		?>
	</div><!-- end container -->
</section>

<?php get_footer();?>