<?php include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class michigan_webnus_facebook_widget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Your recently posts from facebook will be displayed','name'=> 'Webnus - Facebook');
		parent::__construct('michigan_webnus_facebook_widget', '', $params);
	}
	public function form($instance){
		extract($instance);
		?>
		<p><label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title:','michigan') ?></label><input	type="text"	class="widefat"	id="<?php echo $this->get_field_id('title') ?>"	name="<?php echo $this->get_field_name('title') ?>"	value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('url') ?>"><?php esc_html_e('Page Address:','michigan') ?></label><input type="text"	class="widefat"	id="<?php echo $this->get_field_id('url') ?>"	name="<?php echo $this->get_field_name('url') ?>"	value="<?php if( isset($url) )  echo esc_attr($url); ?>" /><small><?php esc_html_e( 'Your Page address', 'michigan' ); ?></small></p>			
		<?php 
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		echo $before_widget;
		if(!empty($title)) echo $before_title.$title.$after_title; ?>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=283742071785556&version=v2.0";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like-box" data-href="<?php echo esc_url($url) ?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
			<?php 
			echo $after_widget;
	} 
}
add_action('widgets_init', 'register_michigan_webnus_facebook'); 
function register_michigan_webnus_facebook(){
	register_widget('michigan_webnus_facebook_widget');
}