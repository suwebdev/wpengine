<?php
/**
 * Adds Michigan_Course_Categories widget.
 */
class Michigan_Course_Categories extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'michigan_course_categories', // Base ID
			esc_attr__( 'Webnus Course Categories', 'michigan' ), // Name
			array( 'description' => esc_attr__( 'A Course Categories Widget', 'michigan' ), ) // Args
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

		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> 0,
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
		$post_counts	= $instance[ 'post_counts' ] ? true : false;
		$category_icon	= isset($instance[ 'category_icon' ]) ? true : false;
		
		$w_courses_id = get_option( 'lifterlms_shop_page_id', '' ) ? get_option( 'lifterlms_shop_page_id', '' ) : '' ;
		$w_courses_slug = ($w_courses_id) ? get_post( $w_courses_id ) : '';
		$w_courses_name = ($w_courses_slug) ? $w_courses_slug->post_name : '' ;
		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
			$all_categoy = $category_icon ? '<i class="fa-book"></i>': '';
			$post_type = get_post_type_object(get_post_type());
			echo '<ul class="course-categories list">';
					echo'
						<li class="course-category">
							<a class="hcolorf" href="' . esc_url( get_site_url() ) . '/'.$w_courses_name.'/" title="' . esc_attr( 'View all Categories', 'michigan' ). '">'.$all_categoy . esc_html__('All Courses','michigan'). '</a>
						</li>';

				foreach ( $categories as $category ) :
					$count = $post_counts ? ' (' . $category->count . ')' : '';

					// fetch child categories
					$child_categories = get_categories( array( 'taxonomy' => 'course_cat', 'child_of' => $category->cat_ID ) );
					$childs = $parent_class = '';
					if ( $child_categories ) :
						$parent_class = ' course-category-parent';
						$childs .= '<ul class="course-categories list course-categories-childs">';
							foreach ( $child_categories as $child_category ) :
								if ( function_exists( 'tax_icons_output_term_icon' ) ) :
									$cat_icon = $category_icon ? tax_icons_output_term_icon( $child_category->term_id ) : '';
								else :
									$cat_icon = '';
								endif;
								$count = $post_counts ? ' (' . $child_category->count . ')' : '';
								$childs .= '
									<li class="course-category course-category-child">
										<a class="hcolorf" href="' . esc_url( get_category_link( $child_category ) ) . '" title="' . esc_attr( sprintf( __( 'View all courses under %s', 'michigan' ), $child_category->name ) ) . '">'. $cat_icon . esc_html( $child_category->name ) .'<span>'.$count.'</span>' . '</a>
									</li>';
							endforeach;
						$childs .= '</ul>';
					endif;

					if ( function_exists( 'tax_icons_output_term_icon' ) ) :
						$cat_icon = $category_icon ? tax_icons_output_term_icon( $category->term_id ) : '';
					else :
						$cat_icon = '';
					endif;

					echo '
						<li class="course-category' . $parent_class . '">
							<a class="hcolorf" href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( __( 'View all courses under %s', 'michigan' ), $category->name ) ) . '">'. $cat_icon . esc_html( $category->name ) .'<span>'.$count.'</span>' . '</a>
							' . $childs . '
						</li>';
				endforeach;

			echo '</ul>';
		endif;

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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_attr( 'Course Categories' );
		$post_counts = ! empty( $instance['post_counts'] ) ? $instance['post_counts'] : false;
		$category_icon = ! empty( $instance['category_icon'] ) ? $instance['category_icon'] : false;?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'michigan' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id( 'post_counts' ); ?>" name="<?php echo $this->get_field_name( 'post_counts' ); ?>" type="checkbox" <?php checked( $post_counts, 'on' ); ?>> 
			<label for="<?php echo $this->get_field_id( 'post_counts' ); ?>"><?php esc_html_e( 'Show post counts', 'michigan' ); ?></label> 
		</p>
		
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id( 'category_icon' ); ?>" name="<?php echo $this->get_field_name( 'category_icon' ); ?>" type="checkbox" <?php checked( $category_icon, 'on' ); ?>> 
			<label for="<?php echo $this->get_field_id( 'category_icon' ); ?>"><?php esc_html_e( 'Show Category Icon', 'michigan' ); ?></label> 
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
		$instance['post_counts'] = ( ! empty( $new_instance['post_counts'] ) ) ? $new_instance['post_counts'] : '';
		$instance['category_icon'] = ( ! empty( $new_instance['category_icon'] ) ) ? $new_instance['category_icon'] : '';

		return $instance;
	}

} // class Michigan_Course_Categories

add_action('widgets_init','register_michigan_course_categories'); 
function register_michigan_course_categories() {
	register_widget('Michigan_Course_Categories');
}