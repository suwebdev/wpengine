<?php
/**
 * Adds Michigan_Instructors widget.
 */
class Michigan_Instructors extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'michigan_instructors', // Base ID
			esc_attr__( 'Webnus Instructor', 'michigan' ), // Name
			array( 'description' => esc_attr__( 'Display instructors', 'michigan' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		GLOBAL $post;
		$wp_instructors= new WP_User_Query( array( 'role__in' => array('Administrator','Editor','Author','Contributer') ) );
		$instructors = $wp_instructors->get_results();
		if(!empty($instructors)) {
			foreach ($instructors as $instructor){
				michigan_webnus_instructor_update($instructor->ID);
			}
		}
		$view = $instance[ 'type' ];
		$count = $instance[ 'count' ];
		if($view) {
			switch($view){
				case '1':
					$maintitle = esc_html__('Most Recent Instructors','michigan');
					$orderby = 'registered';
					$meta_key = 'instructor_is';
				break;
				case '2':
					$maintitle = esc_html__('Popular Instructors','michigan');
					$orderby = 'meta_value_num';
					$meta_key = 'instructor_students';
				break;
				case '3':
					$maintitle = esc_html__('Top Rated Instructors','michigan');
					$orderby = 'meta_value_num';
					$meta_key = 'instructor_rate';
				break;
				case '4':
					$maintitle = esc_html__('Most Active Instructors','michigan');
					$orderby = 'meta_value_num';
					$meta_key = 'instructor_courses';
				break;
			}
			echo '<h4 class="subtitle">'.$maintitle.'</h4><div id="top-instructors" class="w-crsl">';
			$arg = array (
				'number' => $count,
				'order' => 'DESC',
				'orderby' => $orderby,
				'meta_key' => $meta_key,
			);
			$wp_instructor_query = new WP_User_Query($arg);
			$authors = $wp_instructor_query->get_results();
			if(!empty($authors)) {
				foreach ($authors as $author){
					$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author->ID ), 265 );
					$instructor_title = '<a href="'.get_author_posts_url( $author->ID ).'">'.get_the_author_meta( 'display_name',$author->ID ).'</a>';
					$instructor_biography = get_the_author_meta( 'biography',$author->ID );
					$facebook = esc_url(get_the_author_meta( "facebook",$author->ID));
					$twitter = esc_url(get_the_author_meta( "twitter",$author->ID));
					$google_plus = esc_url(get_the_author_meta( "googleplus",$author->ID));
					$linkedin = esc_url(get_the_author_meta( "linkedin",$author->ID));
					$youtube = esc_url(get_the_author_meta( "youtube",$author->ID));
					$title = get_the_author_meta( "title",$author->ID);
					$instructor_email = get_the_author_meta( 'display_email' , $author->ID);
					$url = esc_url(get_the_author_meta( "url",$author->ID));

					echo '<article class="course-instructor"><a href="'.get_author_posts_url( $author->ID ).'"><figure>'.$instructor_avatar .'</figure></a>';
					echo '<div class="inst-detail">
					<span class="inst-tip colorf" title="' . esc_html__('Total Courses:','michigan') . ' ' . get_the_author_meta( 'instructor_courses',$author->ID).'"><i title="" class="sl-book-open"></i></span>
					<span class="inst-tip colorf" title="' . esc_html__('Total Students:','michigan') . ' ' . get_the_author_meta( 'instructor_students',$author->ID).'">
					<i title="" class="sl-people"></i>
					</span>
					<span class="inst-tip colorf" title=" ' . esc_html__('Average Rates:','michigan') . ' ' . get_the_author_meta( 'instructor_rate',$author->ID) . '">
					<i title="" class="sl-star"></i>
					</span>
					</div>';
					echo '<div class="inst-desc"><h3>'. $instructor_title .'</h3><h6 class="colorf">'.$title.'</h6><p>'.$instructor_biography.'</p></div>';
					echo '<div class="inst-social">';
					echo ($url)?'<a href="'.$url.'" target="_blank"><i class="fa-globe"></i></a>':'';
					echo ($instructor_email)?'<a href="mailto:'.$instructor_email.'"><i class="fa-envelope"></i></a>':'';
					echo ($facebook)?'<a href="'.$facebook.'"><i class="fa-facebook" target="_blank"></i></a>':'';
					echo ($twitter)?'<a href="'.$twitter.'"><i class="fa-twitter" target="_blank"></i></a>':'';
					echo ($linkedin)?'<a href="'.$linkedin.'"><i class="fa-linkedin" target="_blank"></i></a>':'';
					echo ($google_plus)?'<a href="'.$google_plus.'"><i class="fa-google-plus" target="_blank"></i></a>':'';
					echo ($youtube)?'<a target="_blank" href="'.$youtube.'"><i class="fa-youtube" target="_blank"></i></a>' : '';
					echo '</div>';
					echo '</article>';
				}
			} else {
				echo '<article>'.esc_html__('No instructors found','michigan').'</article>';
			}
			echo '</div>';
		} //end more courses
		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$type = ! empty( $instance['type'] ) ? $instance['type'] : '1';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : '3'; ?>
		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php esc_html_e( 'Instructors Type:', 'michigan' ); ?></label>
			<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat type" style="width: 100%;">
			<option value="<?php echo esc_attr( '1' ); ?>" <?php if ( $type == '1' ) echo 'selected="selected"'; ?>><?php esc_html_e('New Instructors', 'michigan'); ?></option>
			<option value="<?php echo esc_attr( '2' ); ?>" <?php if ( $type == '2' ) echo 'selected="selected"'; ?>><?php esc_html_e('Popular Instructors', 'michigan'); ?></option>
			<option value="<?php echo esc_attr( '3' ); ?>" <?php if ( $type == '3' ) echo 'selected="selected"'; ?>><?php esc_html_e('Top Rated Instructors', 'michigan'); ?></option>
			<option value="<?php echo esc_attr( '4' ); ?>" <?php if ( $type == '4' ) echo 'selected="selected"'; ?>><?php esc_html_e('Most Active Instructors', 'michigan'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count') ?>"><?php esc_html_e('Instructors Count: ','michigan') ?></label>
			<input type="text"	class="widefat"	id="<?php echo $this->get_field_id('count') ?>"	name="<?php echo $this->get_field_name('count') ?>"	value="<?php if( isset($count) )  echo esc_attr($count); ?>"/>
		</p>
		<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['type'] = ( ! empty( $new_instance['type'] ) ) ? $new_instance['type'] : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? $new_instance['count'] : '';

		return $instance;
	}
} // class Michigan_Instructors
// Register widget
add_action( 'widgets_init', 'michigan_instructor' );
function michigan_instructor() {
	register_widget('Michigan_Instructors');
}