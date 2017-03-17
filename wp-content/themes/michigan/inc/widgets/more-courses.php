<?php
class Michigan_More_Course extends WP_Widget {
	function __construct() {
		parent::__construct(
			'michigan_more_course', // Base ID
			esc_attr__( 'Webnus More Course', 'michigan' ), // Name
			array( 'description' => esc_attr__( 'A more course widget for your site', 'michigan' ), ) // Args
		);
	}
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$type = $instance[ 'type' ];
		$count = isset($instance[ 'count' ])? $instance[ 'count' ] : '' ;
		$current = isset($instance[ 'current' ])? $instance[ 'current' ] : '' ;
		if($type) {
			switch($type){
				case '1':
				$orderby = 'date';
				$maintitle = esc_html__('Recent Courses','michigan');
				break;
				case '2':
				$orderby = 'meta_value_num';
				$maintitle = esc_html__('Popular Courses','michigan');
				break;
				case '3':
				$orderby = 'rate';
				$maintitle = esc_html__('Top Rated Courses','michigan');
				break;
				case '4':
				$orderby = 'rand';
				$maintitle = esc_html__('More Courses','michigan');
				break;
			}
			GLOBAL $post;
			$post_ids = array();
			$post_ids[] = ($post)?$post->ID : 0;

		echo '<h4 class="subtitle">'.$maintitle.'</h4><div id="more-courses" class="w-crsl">';
		$current_post = ($current)? 0 : $post_ids;
		$mc_args = array('post__not_in' => $current_post,'showposts' => $count,'post_type' => 'course','orderby' => $orderby,'meta_key'=> 'michigan_webnus_views',);
		$rec_query = new wp_query($mc_args);
		if($rec_query->have_posts()){
			while ($rec_query->have_posts()){
			$rec_query->the_post();
			$post_id = $post->ID;
		?>
			<article class="modern-grid llms-course-list"><div class="llms-course-link">
				<div class="modern-feature"><a class="" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail( $post_id ) ) {
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'michigan_webnus_blog2_img' );
						echo apply_filters( 'lifterlms_featured_img', '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />' );
					} elseif(function_exists('llms_placeholder_img_src')){
						if ( llms_placeholder_img_src() ) {
						$no_img = get_template_directory_uri().'/images/course_no_image.png';?>
						<?php echo apply_filters( 'lifterlms_placeholder_img', '<img src="' . $no_img . '" alt="Placeholder" class="llms-course-image llms-placeholder wp-post-image" />' );
						}
					}
					echo '</a>';
					if(class_exists('LLMS_Product')){
						global $course;
						echo ($length_html = get_post_meta( $post_id, '_llms_length', true ))?'<span class="modern-duration">'.$length_html.'<i class="fa-clock-o"></i></span>':'';
					}
				?>
				</div>
				<div class="modern-content">
					<h3 class="llms-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php
					if(function_exists('the_ratings')) {
						echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Votes','michigan').')</strong></div>', get_the_ID()); }
					if( class_exists('LLMS_Product') ){
					    echo '<div class="llms-price-wrapper"><h5 class="llms-price"><span>';
					    course_price();
					    echo '</span></h5></div>';
				    }else{
				        if( rwmb_meta('michigan_course_price_meta') ){
				            echo '<div class="llms-price-wrapper"><h5 class="llms-price"><span>';
				            course_price();
				            echo '</span></h5></div>';
				        }
				    }
					?>
					<div class="clearfix modern-meta">
						<?php
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
						,$post_id));
						$course_students = rwmb_meta( 'michigan_course_students_meta' ) ? rwmb_meta( 'michigan_course_students_meta' ):count($students);
						$my_post = get_post( $post->ID );
						$author_id = $my_post->post_author;
						$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 );
						$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'. get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 ).get_the_author_meta( 'display_name',$author_id ).'</a>';
						echo '<div class="col-md-8 col-sm-8 col-xs-8"><div class="modern-instructor">'.$instructor_title.'</div></div>';
						echo '<div class="col-md-4 col-sm-4 col-xs-4">';
						echo ($course_students)?'<span class="modern-students" title="'.esc_attr('Enrolled Students','michigan').'"><i class="sl-people"></i>'.$course_students.'</span>':'<span class="modern-viewers" title="'.esc_attr('Viewers','michigan').'"><i class="fa-eye"></i>'.michigan_webnus_getViews(get_the_ID()).'</span>';
						echo '</div>';
						?>
					</div>
				</div>
			</div></article>
		<?php
		}}
		wp_reset_postdata();
		}
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		$type = ! empty( $instance['type'] ) ? $instance['type'] : '1';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : '3';
		$current = ! empty( $instance['current'] ) ? $instance['current'] : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php esc_html_e( 'More Courses Type:', 'michigan' ); ?></label>
			<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat type" style="width: 100%;">
				<option value="<?php echo esc_attr( '1' ); ?>" <?php if ( $type == '1' ) echo 'selected="selected"'; ?>><?php esc_html_e('Recent Courses', 'michigan'); ?></option>
				<option value="<?php echo esc_attr( '2' ); ?>" <?php if ( $type == '2' ) echo 'selected="selected"'; ?>><?php esc_html_e('Popular Courses', 'michigan'); ?></option>
				<option value="<?php echo esc_attr( '3' ); ?>" <?php if ( $type == '3' ) echo 'selected="selected"'; ?>><?php esc_html_e('Top Rated Courses', 'michigan'); ?></option>
				<option value="<?php echo esc_attr( '4' ); ?>" <?php if ( $type == '4' ) echo 'selected="selected"'; ?>><?php esc_html_e('Random Courses', 'michigan'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count') ?>"><?php esc_html_e('Courses Count: ','michigan') ?></label>
			<input type="text"	class="widefat"	id="<?php echo $this->get_field_id('count') ?>"	name="<?php echo $this->get_field_name('count') ?>"	value="<?php if( isset($count) )  echo esc_attr($count); ?>"/>
		</p>
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id( 'current' ); ?>" name="<?php echo $this->get_field_name( 'current' ); ?>" type="checkbox" <?php checked( $current, 'on' ); ?>>
			<label for="<?php echo $this->get_field_id( 'current' ); ?>"><?php esc_html_e( 'Show current course', 'michigan' ); ?></label>
		</p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['type'] = ( ! empty( $new_instance['type'] ) ) ? $new_instance['type'] : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? $new_instance['count'] : '';
		$instance['current'] = ( ! empty( $new_instance['current'] ) ) ? $new_instance['current'] : '';

		return $instance;
	}

}
add_action( 'widgets_init', 'michigan_more_course' );
function michigan_more_course() {
	register_widget('Michigan_More_Course');
}