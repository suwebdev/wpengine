<?php

// convert nhp media value to array
add_action( 'after_setup_theme', 'michigan_convert_nhp_to_redux', 0 );
function michigan_convert_nhp_to_redux() {
	if ( get_option( 'michigan_convert_nhp_to_redux' ) == 'done' ) :
		return;
	endif;

	$thm_options		= get_option( 'michigan_webnus_options' );
	$meida_options_list	= array(
		'michigan_webnus_logo',
		'michigan_webnus_transparent_logo',
		'michigan_webnus_trendy_logo',
		'michigan_webnus_header_background',
		'michigan_webnus_sticky_logo',
		'michigan_webnus_fav_icon',
		'michigan_webnus_apple_iphone_icon',
		'michigan_webnus_apple_ipad_icon',
		'michigan_webnus_admin_login_logo',
		'michigan_webnus_footer_twitter_background_image',
		'michigan_webnus_footer_background_image',
		'michigan_webnus_footer_logo',
		'michigan_webnus_no_image_src',
		'michigan_webnus_custom_font1_woff',
		'michigan_webnus_custom_font1_ttf',
		'michigan_webnus_custom_font1_eot',
		'michigan_webnus_custom_font2_woff',
		'michigan_webnus_custom_font2_ttf',
		'michigan_webnus_custom_font2_eot',
		'michigan_webnus_custom_font3_woff',
		'michigan_webnus_custom_font3_ttf',
		'michigan_webnus_custom_font3_eot',
	);

	foreach ( $meida_options_list as $media_option ) :
		if ( isset( $thm_options[$media_option] ) && !empty( $thm_options[$media_option] ) && !is_array( $thm_options[$media_option] ) ) :
			$thm_options[$media_option] = array( 'url' => $thm_options[$media_option] );
			update_option( 'michigan_webnus_options', $thm_options );
		endif;
	endforeach;

	add_option( 'michigan_convert_nhp_to_redux', 'done' );
}


// prevent blog and latest from blog fatal error
add_action( 'wp_head', 'michigan_redirect_frontend_user_to_admin_panel' );

function michigan_redirect_frontend_user_to_admin_panel() {
	michigan_course_price_meta_data();
	if ( get_option( 'michigan_major_update_alert' ) == 'done' ) :
		return;
	endif;

	if ( is_super_admin() && !is_admin() ) :

		if ( get_option( 'michigan_redirect_frontend_user_to_admin_panel' ) == 'done' ) :
			return;
		endif;

		add_option( 'michigan_redirect_frontend_user_to_admin_panel', 'done' );

		$theme_name = wp_get_theme()->get( 'Name' );
		wp_redirect( admin_url('themes.php?page=' . $theme_name . '-page#w-update-notices' ) );

	endif;

}
// delete_option( 'michigan_redirect_frontend_user_to_admin_panel' );



// Special message for admin alert
add_action( 'admin_print_scripts', 'michigan_major_update_alert', 999 );

function michigan_major_update_alert() {

	if ( get_option( 'michigan_major_update_alert' ) == 'done' ) :
		return;
	endif;

	if ( is_super_admin() && is_admin() ) :

		global $pagenow;
		if ( $pagenow == 'themes.php' && isset( $_GET['activated'] ) ) :
			return;
		endif;

		$theme_name = wp_get_theme()->get( 'Name' );
		$update_url = admin_url("themes.php?page=$theme_name-page#w-update-notices");
		echo '
		<script>
			jQuery(document).ready(function() {
				swal({
					type: "success",
					title: "Special message for admin",
					text: "Michigan version 2.0 is a major update. If you have updated your theme from earlier version then click on “I updated the theme“ button  otherwise ” I am installing for first time“ click on. Please do not update LifterLMS to version 3.0 or above.",
					confirmButtonText: "I am installing for first time",
					cancelButtonText: "I updated the theme",
					closeOnConfirm: true,
					showCancelButton: true,
				}, function(isConfirm) {
					if ( isConfirm != true ) {
						// similar behavior as clicking on a link
						window.location.href = "' . $update_url . '";
					}
				});
			});
		</script>';

		add_option( 'michigan_major_update_alert', 'done' );

	endif; // end is_super_admin() && is_admin()

}
// delete_option( 'michigan_major_update_alert' );