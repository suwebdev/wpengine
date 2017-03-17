<?php include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
	class WebnusSocialWidget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Display your social icons','name'=> 'Webnus-Social Icons');
		parent::__construct('WebnusSocialWidget', '', $params);
	}
	public function form($instance){
		extract($instance);	?>
		<p><label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title:','michigan') ?></label><input type="text" class="widefat"	id="<?php echo $this->get_field_id('title') ?>"	name="<?php echo $this->get_field_name('title') ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
	<?php
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		echo $before_widget;
		if(!empty($title))
			echo $before_title.$title.$after_title; ?>
			<div class="socialfollow">
			<?php
			$michigan_webnus_options = michigan_webnus_options();
			$social = array();
			$social[1] = strtolower(trim($michigan_webnus_options['michigan_webnus_social_first']));
			$social[2] = strtolower(trim($michigan_webnus_options['michigan_webnus_social_second']));
			$social[3] = strtolower(trim($michigan_webnus_options['michigan_webnus_social_third']));
			$social[4] = strtolower(trim($michigan_webnus_options['michigan_webnus_social_fourth']));
			$social[5] = strtolower(trim($michigan_webnus_options['michigan_webnus_social_fifth']));
			$social[6] = strtolower(trim($michigan_webnus_options['michigan_webnus_social_sixth']));
			$social[7] = strtolower(trim($michigan_webnus_options['michigan_webnus_social_seventh']));
			$social_url = array();
			$social_url[1] = trim($michigan_webnus_options['michigan_webnus_social_first_url']);
			$social_url[2] = trim($michigan_webnus_options['michigan_webnus_social_second_url']);
			$social_url[3] = trim($michigan_webnus_options['michigan_webnus_social_third_url']);
			$social_url[4] = trim($michigan_webnus_options['michigan_webnus_social_fourth_url']);
			$social_url[5] = trim($michigan_webnus_options['michigan_webnus_social_fifth_url']);
			$social_url[6] = trim($michigan_webnus_options['michigan_webnus_social_sixth_url']);
			$social_url[7] = trim($michigan_webnus_options['michigan_webnus_social_seventh_url']);
			for ($x = 1; $x <= 7; $x++) {
				echo($social[$x] && $social_url[$x])?'<a target="_blank" href="'. $social_url[$x] .'" class="'.$social[$x].'"><i class="fa-'.$social[$x].'"></i></a>':'';
			}
			?>
			</div>
		  <?php echo $after_widget;
	}
}
add_action('widgets_init','register_michigan_webnus_social_widget');
function register_michigan_webnus_social_widget(){
	register_widget('WebnusSocialWidget');
}