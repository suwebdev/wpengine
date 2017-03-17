<?php include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class michigan_webnus_youtube_widget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Youtube Box','name'=> 'Webnus - Youtube');
		parent::__construct('michigan_webnus_youtube_widget', '', $params);
	}
	public function form($instance){
		extract($instance);	?>
		<p><label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title:','michigan') ?></label><input	type="text"	class="widefat"	id="<?php echo $this->get_field_id('title') ?>"	name="<?php echo $this->get_field_name('title') ?>"		value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('id') ?>"><?php esc_html_e('Channel Name or ID:','michigan') ?></label><input	type="text"	class="widefat"	id="<?php echo $this->get_field_id('id') ?>"	name="<?php echo $this->get_field_name('id') ?>" value="<?php if( isset($id) )  echo esc_attr($id); ?>"	/>		</p>			
	<?php 	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		echo $before_widget;
		if(!empty($title)) echo $before_title.$title.$after_title; 
		$data_channel = (substr($id,0,2) == "UC") ? 'data-channelid' : 'data-channel';
		?>	
			<script src="https://apis.google.com/js/platform.js" async defer></script>
			<div class="g-ytsubscribe" <?php echo $data_channel ?>="<?php echo esc_attr($id); ?>" data-layout="default" data-count="default"></div>
			<?php
			echo $after_widget;
	}
}
add_action('widgets_init', 'register_michigan_webnus_youtube'); 
function register_michigan_webnus_youtube(){
	register_widget('michigan_webnus_youtube_widget');
}