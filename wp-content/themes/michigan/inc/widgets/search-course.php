<?php
/**
 * Adds Michigan_Search_Course widget.
 */
class Michigan_Search_Course extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'michigan_search_course', // Base ID
			esc_attr__( 'Webnus Search Course', 'michigan' ), // Name
			array( 'description' => esc_attr__( 'A search course form for your site', 'michigan' ), ) // Args
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

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		// Category dropdown
		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'id',
			'order'			=> 'ASC',
			'hide_empty'	=> false,
			'hierarchical'	=> 1,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> 'course_cat',
			'pad_counts'	=> false,
		);
		$categories		= get_categories( $cat_args );
		$category_items	= $new_line = array();
		$options_cat	= '';

		foreach ( $categories as $category ) :
			$new_line['slug'] = $category->slug;
			$new_line['name'] = $category->name;
			$category_items[] = $new_line;
		endforeach;

		foreach ( $category_items as $category_item )
			$options_cat .= '<option value="' . $category_item['slug'] . '">' . $category_item['name'] . '</option>';

		// Instructor dropdown
		$options_user = '';
		$blogusers	 = get_users();
		foreach ( $blogusers as $user ) :
			if ( michigan_webnus_count_user_posts_by_type( $user->ID, 'course' ) )
				$options_user .= '<option value="' . $user->user_nicename . '">' . $user->display_name . '</option>';
		endforeach;

		$category_field = $instance[ 'category_field' ] ? '<select class="category-field" name="course_cat"><option value="">' . esc_html__( 'Course Category' , 'michigan' ) . '</option>' . $options_cat . '</select>' : '';
		$instructor_field = $instance[ 'instructor_field' ] ? '<select class="instructor-field" name="author_name"><option value="">' . esc_html__( 'Instructor', 'michigan' ) . '</option>' . $options_user . '</select>' : '';

		echo '
			<form role="search" method="get" class="course-search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<div>
					<input type="hidden" name="post_type" value="course">
					' . $category_field . $instructor_field . '
					<input type="search" class="search-field" placeholder="' . esc_attr__( 'Type Keywords', 'michigan' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr__( 'Search for:', 'michigan' ) . '">
					<input type="submit" class="submit-field colorb" value="' . esc_attr__( 'Search', 'michigan' ) . '">
				</div>
			</form>';

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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_attr( 'New title' );
		$category_field = ! empty( $instance['category_field'] ) ? $instance['category_field'] : false;
		$instructor_field = ! empty( $instance['instructor_field'] ) ? $instance['instructor_field'] : false; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'michigan' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id( 'category_field' ); ?>" name="<?php echo $this->get_field_name( 'category_field' ); ?>" type="checkbox" <?php checked( $category_field, 'on' ); ?>>
			<label for="<?php echo $this->get_field_id( 'category_field' ); ?>"><?php esc_html_e( 'Show category field', 'michigan' ); ?></label>
		</p>

		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id( 'instructor_field' ); ?>" name="<?php echo $this->get_field_name( 'instructor_field' ); ?>" type="checkbox" <?php checked( $instructor_field, 'on' ); ?>>
			<label for="<?php echo $this->get_field_id( 'instructor_field' ); ?>"><?php esc_html_e( 'Show instructor field', 'michigan' ); ?></label>
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

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['category_field'] = ( ! empty( $new_instance['category_field'] ) ) ? $new_instance['category_field'] : '';
		$instance['instructor_field'] = ( ! empty( $new_instance['instructor_field'] ) ) ? $new_instance['instructor_field'] : '';

		return $instance;
	}

} // class Michigan_Search_Course


// Register widget

add_action('widgets_init', 'michigan_webnus_search_course');
function michigan_webnus_search_course(){
	register_widget('Michigan_Search_Course');
}