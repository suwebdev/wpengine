<?php include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class michigan_webnus_popularpost_widget extends WP_Widget{
	function __construct(){
	$params = array('description'=> 'Display Popular Posts','name'=> 'Webnus-Popular Posts');
	parent::__construct('michigan_webnus_popularpost_widget', '', $params);
	}
	public function form($instance){
		extract($instance);	?>
		<p><label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title:','michigan') ?></label><input	type="text"	class="widefat"	id="<?php echo $this->get_field_id('title') ?>"	name="<?php echo $this->get_field_name('title') ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('numberOfPosts') ?>"><?php esc_html_e('Number of Posts:','michigan') ?></label><input type="text"	class="widefat"	id="<?php echo $this->get_field_id('numberOfPosts') ?>"	name="<?php echo $this->get_field_name('numberOfPosts') ?>"	value="<?php if( isset($numberOfPosts) )  echo esc_attr($numberOfPosts); ?>" /></p>		
		<?php 
	}
	public function widget($args, $instance){	
		extract($args);
		extract($instance);
		if(!isset($title)) $title='';
		if(!isset($numberOfPosts)) $numberOfPosts=5;
		echo $before_widget;
		if(!empty($title))
			echo $before_title.$title.$after_title; ?>
		<div class="side-list"><ul>
		<?php
		$wpbp = new WP_Query(array( 'post_type' => 'post', 'paged'=>1, 'posts_per_page'=>$numberOfPosts,'orderby'=>'comment_count'));
		$temp_out = "";
		if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
		?>
		  <li>
		  <?php get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'michigan_webnus_tabs_img' ) ); ?>
		  <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
		  <p><?php comments_number(); ?></p>
		  </li>
		<?php
		endwhile; endif;
		wp_reset_postdata();
		?>
        </ul></div>
		<?php echo $after_widget;
	} 
}
add_action('widgets_init', 'register_michigan_webnus_PopularPosts');
function register_michigan_webnus_PopularPosts(){
	register_widget('michigan_webnus_popularpost_widget');
}