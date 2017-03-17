<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<div class="archive-course-wrap clearfix">
	<section id="headline"><div class="container"><h2>
	<?php
	if ( is_search() ) {
		echo sprintf( esc_html__( 'Search Results: &ldquo;%s&rdquo;', 'michigan' ), get_search_query() );
	if ( get_query_var( 'paged' ) ) {
		echo sprintf( esc_html__( '&nbsp;&ndash; Page %s', 'michigan' ), get_query_var( 'paged' ) ); }
	} elseif ( is_tax() ) {
		echo single_term_title( '', false );
	}else{
		echo esc_html__('All Courses','michigan');
	}
	?>
	</h2></div></section>
	<main class="container content llms-content w-course-archive">
		<hr class="vertical-space">
		<aside class="col-md-3">
			<div class="filter-category">
				<h3> <?php esc_html_e('COURSE CATEGORIES','michigan'); ?> </h3>
				<?php the_widget ('Michigan_Course_Categories', 'post_counts=true&category_icon=true'); ?>
			</div>
			<hr class="vertical-space">
		</aside>
		<div id="page-<?php the_ID();?>" <?php post_class('col-md-9'); ?>>
			<div class="btn-group row">
				<div class="col-sm-12 courses-search">
					<?php the_widget('Michigan_Search_Course','category_field=true&instructor_field=true'); ?>
				</div>
			</div>
			<hr class="vertical-space">
			<div class="row">
				<div class="col-sm-12 courses-sorting">
					<!-- <span>Sort by</span> -->
					<form method="get" class="course-sorting-form w-nice-select" action="<?php echo esc_url( home_url( '/' ) ); ?>">

						<div class="course-sorting-wrap clearfix">
							<span><?php esc_html_e('Sort by:', 'michigan') ?></span>
							<select class="orderby-field w-nice-select" name="orderby">
								<option class="cs-orderby-option" value="w-order-course=dateNewest"><?php esc_html_e('Release Date (newest first)', 'michigan') ?></option>
								<option class="cs-orderby-option" value="w-order-course=dateOldest"><?php esc_html_e('Release Date (oldest first)', 'michigan') ?></option>
								<option class="cs-orderby-option" value="w-order-course=trending"><?php esc_html_e('Most Visiting', 'michigan'); ?></option>
								<option class="cs-orderby-option" value="w-order-course=topRated"><?php esc_html_e('Top Rated', 'michigan'); ?></option>
								<option class="cs-orderby-option" value="w-order-course=titleAZ"><?php esc_html_e('Course Title (a-z)', 'michigan'); ?></option>
								<option class="cs-orderby-option" value="w-order-course=titleZA"><?php esc_html_e('Course Title (z-a)', 'michigan'); ?></option>
							</select>
							<div class="switch-field">
								<!-- all -->
								<input type="radio" id="all_courses" value="" name="courses_price_filter" checked>
								<label for="all_courses"><?php esc_html_e('All', 'michigan'); ?></label>
								<!-- paid -->
								<input type="radio" id="paid_courses" value="w-price-course=paidCourses" name="courses_price_filter">
								<label for="paid_courses"><?php esc_html_e('Paid', 'michigan'); ?></label>
								<!-- free -->
								<input type="radio" id="free_courses" value="w-price-course=freeCourses" name="courses_price_filter">
								<label for="free_courses"><?php esc_html_e('Free', 'michigan'); ?></label>
							</div>
							<div class="grid-list-btn alignright">
								<a href="#" id="list" class="btn btn-default btn-sm">
								<i class="fa-th-list"></i>
								</a>
								<a href="#" id="grid" class="btn btn-default btn-sm active">
								<i class="fa-th-large"></i>
								</a>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-12">
					<div class="filter-category-dropdown nice-select">
						<span class="current"> <?php esc_html_e('COURSE CATEGORIES','michigan'); ?> </span>
						<?php the_widget ('Michigan_Course_Categories', 'post_counts=true&category_icon=true'); ?>
					</div>
				</div>
			</div>
			<hr class="vertical-space">
		<?php
		do_action( 'lifterlms_archive_description' );
		if ( have_posts() ){
			echo '<div class="course-loader"></div>';
			echo '<div class="w-courses course-grid-t modern-grid" data-empty-filter-result="' . get_stylesheet_directory_uri() . '/images/filter-courses-empty.png' . '"><div class="courses">';
			$rcount=1;
			$row=3;
			while ( have_posts() ) :the_post();
			michigan_course_price_meta_data();
			global $post, $course, $lifterlms_loop;
			if ( ! $course ) {$course = new LLMS_Course( $post->ID );}
			global $wpdb;
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
			,$post->ID));
			$course_students = rwmb_meta( 'michigan_course_students_meta' ) ? rwmb_meta( 'michigan_course_students_meta' ):count($students);
			if ( empty( $lifterlms_loop['loop'] ) ) {$lifterlms_loop['loop'] = 0; }
			if ( empty( $lifterlms_loop['columns'] ) ) { $lifterlms_loop['columns'] = apply_filters( 'loop_shop_columns', 4 ); }
			$lifterlms_loop['loop']++;
			$classes = array();
			if ( $course->get_percent_complete() == 100) { $classes[] = 'llms-course-complete'; }
			if ( 0 == ( $lifterlms_loop['loop'] - 1 ) % $lifterlms_loop['columns'] || 1 == $lifterlms_loop['columns'] ) { $classes[] = 'first'; }
			if ( 0 == $lifterlms_loop['loop'] % $lifterlms_loop['columns'] ) { $classes[] = 'last'; }
			echo ($rcount == 1)?'<div class="row">':''; ?>
			<div class="col-md-4 col-sm-6 course-list-col">
				<article class="w-course-list">
					<div class="clearfix">
					<div class="col-md-4 course-list-border-right">
						<?php
							if (get_the_terms($post->ID, 'course_cat' )) {
								echo '<div class="modern-cat">';
								$categories = get_the_terms($post->ID, 'course_cat' );
								$typeName = array();
								foreach ( $categories as $category ) :
									if(function_exists('tax_icons_output_term_icon')){
										$cat_icon =  tax_icons_output_term_icon( $category->term_id );
									}else{
										$cat_icon = '';
									}

									$typeName[] = '<a class="hcolorf" href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all courses under %s', 'michigan' ), $category->name ) ) . '">'. $cat_icon . esc_html( $category->name ). '</a>';

								endforeach;
								echo implode(', ', $typeName);
								echo '</div>';
							}

						global $post; ?>
						<figure><a class="" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail( $post->ID ) ) {
							$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'michigan_webnus_blog2_img' );
							echo apply_filters( 'lifterlms_featured_img', '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />' );
						} elseif ( llms_placeholder_img_src() ) {
							$no_img = get_template_directory_uri().'/images/course_no_image.png';?>
							<?php echo apply_filters( 'lifterlms_placeholder_img', '<img src="' . $no_img . '" alt="Placeholder" class="llms-course-image llms-placeholder wp-post-image" />' );
						} ?>
						</a></figure>
						<?php
						$course_duration = get_post_meta( $post->ID, '_llms_length', true );
						echo($course_duration)?'<span class="modern-duration">'.$course_duration.'<i class="fa-clock-o"></i></span>':'';
						?>
					</div>
					<div class="col-md-8 none-grid">
						<div class="course-list-content">
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<?php
							global $post;
							$llms_product = new LLMS_Product( $post->ID );
							?>
								<div class="llms-price-wrapper">
									<div class="course-list-price"><?php course_price(); ?></div>
								</div>
							<?php
							echo '<p>'.michigan_webnus_excerpt(36).'</p>';
							?>
						</div>
					</div>
					</div>
					<div class="clearfix">
						<div class="col-md-4 course-list-border-right">
							<div class="course-list-review">
								<div class="modern-content">
									<h3 class="llms-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php
									if(function_exists('the_ratings')) {
										echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Votes','michigan').')</strong></div>', get_the_ID());
									}
									global $post;
									$llms_product = new LLMS_Product( $post->ID );
									?>
										<div class="llms-price-wrapper">
											<h4 class="llms-price"><span><?php course_price(); ?></span></h4>
										</div>
									<?php
									?>
									<div class="clearfix modern-meta">
										<?php
										$my_post = get_post( $post->ID );
										$author_id = $my_post->post_author;
										$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 );
										$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'.$instructor_avatar .get_the_author_meta( 'display_name',$author_id ).'</a>';
										echo  '<div class="col-md-8 col-sm-8 col-xs-8"><div class="modern-instructor">'.$instructor_title.'</div></div>';
										echo '<div class="col-md-4 col-sm-4 col-xs-4">';
										echo ($course_students)?'<span class="modern-students" title="'.esc_attr__('Enrolled Students','michigan').'"><i class="sl-people"></i>'.$course_students.'</span>':'<span class="modern-viewers" title="'.esc_attr('Viewers','michigan').'"><i class="fa-eye"></i>'.michigan_webnus_getViews(get_the_ID()).'</span>';
										echo '</div>';
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8 nopad-all none-grid">
							<div class="course-list-meta">
								<div class="clearfix">
									<?php
									global $course;
									$my_post = get_post( $post->ID );
									$author_id = $my_post->post_author;
									echo ($length_html = get_post_meta( $my_post, '_llms_length', true ))?'<div class="col-md-2 col-sm-2 col-xs-6 nopad-all"><span class="course-list-duration"><i class="sl-clock"></i>'.$length_html.'</span></div>':'';

									$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name',$author_id ).'</a>';
									echo '<div class="col-md-4 col-sm-4 col-xs-6 nopad-all"><span class="course-list-instructor"><i class="sl-user"></i>'.$instructor_title.'</span></div>';
									echo ($course_students)?'<div class="col-md-3 col-sm-3 col-xs-6 nopad-all"><span class="course-list-students"><i class="sl-people"></i>'.$course_students .' '. esc_html__('Studesnts','michigan').'</span></div>':'';
									echo '<div class="col-md-3 col-sm-3 col-xs-6 nopad-all"><span class="modern-viewers"><i class="sl-eyeglass"></i>'.michigan_webnus_getViews(get_the_ID()) .' '. esc_html__('Viewers','michigan').'</span></div>';
									?>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
			<?php if($rcount == $row){
			echo '</div>';
			$rcount = 0;
			}
			$rcount++;
			endwhile;
			echo '</div></div>';
		}
		 ?>
		</div>
		</div>
	</main>
</div>
<?php do_action( 'lifterlms_sidebar' ); ?>
<?php get_footer(); ?>