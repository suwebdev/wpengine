<?php class WebnusLoginWidget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Webnus Login Widget','name'=> 'Webnus-Login');
		parent::__construct('WebnusLoginWidget', '', $params);
	}
	public function form($instance){
		extract($instance);?>
		<p><label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title:','michigan') ?></label><input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<?php 
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		echo $before_widget;
		if(!empty($title))
			echo $before_title.$title.$after_title;
		?>
			<div class="webnus-login">
				<?php
					if ( function_exists( 'michigan_webnus_login' ) ) :
						michigan_webnus_login();
					endif;
				?>
			<div class="clear"></div>
			</div>	 
		  <?php echo $after_widget;
	} 
}
add_action('widgets_init','register_michigan_webnus_login_widget'); 
function register_michigan_webnus_login_widget(){
	register_widget('WebnusLoginWidget');
}