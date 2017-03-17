<section class="footer-social-bar"><div class="container"><div class="row"><ul class="footer-social-items">
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
		echo($social[$x] && $social_url[$x])?'<li><a target="_blank" href="'. $social_url[$x] .'" class="'.$social[$x].'"><i class="fa-'.$social[$x].'"></i><div><strong>'.$social[$x].'</strong><span>'.esc_html__('Join us on ','michigan').$social[$x].'</span></div></a></li>':'';
	} ?>
</ul></div></div></section>