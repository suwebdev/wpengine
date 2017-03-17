<?php
$michigan_webnus_options = michigan_webnus_options();
$w_fbl_type = $michigan_webnus_options['michigan_webnus_footer_bottom_left'];
$w_fbr_type = $michigan_webnus_options['michigan_webnus_footer_bottom_right'];
$w_logo_width = 65;
if($michigan_webnus_options['michigan_webnus_footer_logo_width']){
$w_logo_width = preg_replace('#[^0-9]#','',strip_tags($michigan_webnus_options['michigan_webnus_footer_logo_width']));
}
$michigan_webnus_options['michigan_webnus_footer_logo']['url'] = isset($michigan_webnus_options['michigan_webnus_footer_logo']['url']) ? $michigan_webnus_options['michigan_webnus_footer_logo']['url'] : '';
$w_fb_logo = '<img src="'.esc_url($michigan_webnus_options['michigan_webnus_footer_logo']['url']).'" width="'.$w_logo_width.'" alt="">';
if (has_nav_menu('footer-menu')){
	$menuParameters = array('theme_location'=>'footer-menu','container' => false,'echo' => false,'items_wrap' => '%3$s','depth' => 0,);
	$w_fb_menu = strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
}
$w_fb_text = $michigan_webnus_options['michigan_webnus_footer_copyright'] ;

?>
<section class="footbot">
<div class="container">
	<div class="col-md-6">
	<div class="footer-navi f-left">
	<?php switch ($w_fbl_type){
		case 1: echo $w_fb_logo;
		break;
		case 2:	echo $w_fb_menu;
		break;
		case 3:	echo $w_fb_text;
		break;
		case 4:
			echo '<div class="socialfollow">';
			get_template_part('parts/social');
			echo '</div>';
		break;
	} ?>
	</div>
	</div>
	<div class="col-md-6">
	<div class="footer-navi floatright">
	<?php switch ($w_fbr_type){
		case 1: echo $w_fb_logo;
		break;
		case 2:	echo $w_fb_menu;
		break;
		case 3:	echo $w_fb_text;
		break;
		case 4:
			echo '<div class="socialfollow">';
			get_template_part('parts/social');
			echo '</div>';
		break;
	} ?>
	</div>
	</div>
</div>
</section>