<?php
$michigan_webnus_options = michigan_webnus_options();
echo '<section class="footer-subscribe-bar"><div class="container"><div class="row">';
$type = $michigan_webnus_options['michigan_webnus_footer_subscribe_type'];
$feedburner_id = esc_html($michigan_webnus_options['michigan_webnus_footer_feedburner_id']);
$mailchimp_url = esc_url($michigan_webnus_options['michigan_webnus_footer_mailchimp_url']);
$subscribe_text = esc_html($michigan_webnus_options['michigan_webnus_footer_subscribe_text']);
if($type =='FeedBurner'){
	$email_name='email';
	echo '<form class="footer-subscribe-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onSubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='.$feedburner_id.'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true"><input type="hidden" value="'.$feedburner_id.'" name="uri"/><input type="hidden" name="loc" value="en_US"/>';
}else{
	$email_name='MERGE0';
	echo '<form class="footer-subscribe-form" action="'.$mailchimp_url.'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">';
}
echo '<div class="footer-subscribe-text col-md-6 col-sm-12"><h6>'.esc_html__('SUBSCRIBE ','michigan').'<span>'.esc_html__('NEWSLETTER','michigan').'</span></h6><p>'.$subscribe_text.'</p></div><div class="col-md-4 col-sm-8 col-xs-12"><input placeholder="'.esc_html__('your email here..','michigan').'" class="footer-subscribe-email" type="text" name="'.$email_name.'"/></div><div class="col-md-2 col-sm-4 col-xs-12"><button class="button theme-skin footer-subscribe-submit" type="submit">'.esc_html__('SUBSCRIBE ','michigan').'</button></div></form></div></div></section>';
?>