<?php
add_action( 'wp_ajax_activate_theme', 'webnus_check_theme' );
function webnus_check_theme() {
	// Check
	check_ajax_referer( 'ajax_theme_activate_nounce', 'security', false );

    // Save final options
    $webnus_theme = wp_get_theme();
    $theme_name_update = $webnus_theme->get( 'Name' );
    update_option( $theme_name_update.'theme_activate', $_REQUEST );
}

// Add menu
function webnus_admin_page() {
	$webnus_theme 	= wp_get_theme();
	$theme_name 	= $webnus_theme->get( 'Name' );
	$theme_version 	= $webnus_theme->get( 'Version' );
	$page_title 	= $theme_name.' page';
	if ( !class_exists( 'Webnus_Envato' ) ) {
		require_once ( get_template_directory() . '/inc/auto-update/envato.php' );
	}
	$new_ins = new Webnus_Envato;
	$version = isset( $new_ins->get_MEC_info('info')->item->wordpress_theme_metadata->version) ? $new_ins->get_MEC_info('info')->item->wordpress_theme_metadata->version : '';
	if ( version_compare( $theme_version , $version , '<') ){
		$new_version = ' <span class="update-plugins"><span class="update-count">'.__( 'New Version', 'michigan' ).'</span></span>';
	}else{
		$new_version = '';
	}

	$menu_title = $theme_name.$new_version;
	$capability = 'edit_theme_options';
	$menu_slug  = $theme_name.'-page';
	$function	= 'webnus_welcome';
	add_theme_page($page_title, $menu_title, $capability, $menu_slug, $function);
}
add_action('admin_menu', 'webnus_admin_page');

// Redirect to welcome page
global $pagenow;
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
	$webnus_theme = wp_get_theme();
	$theme_name = $webnus_theme->get( 'Name' );
	wp_redirect(admin_url("themes.php?page=$theme_name-page"));
}

// Content
function webnus_welcome(){
	$webnus_theme = wp_get_theme();
	$theme_name = $webnus_theme->get( 'Name' );
	$theme_version = $webnus_theme->get( 'Version' );
	if ( !class_exists( 'Webnus_Envato' ) ) {
		require_once ( get_template_directory() . '/inc/auto-update/envato.php' );
	}
	$new_ins = new Webnus_Envato;
	$version = isset( $new_ins->get_MEC_info('info')->item->wordpress_theme_metadata->version) ? $new_ins->get_MEC_info('info')->item->wordpress_theme_metadata->version : '';
	$mem_limit = ini_get('memory_limit');
	$mem_limit_byte = wp_convert_hr_to_bytes($mem_limit);
	$upload_max_filesize = ini_get('upload_max_filesize');
	$upload_max_filesize_byte = wp_convert_hr_to_bytes($upload_max_filesize);
	$post_max_size = ini_get('post_max_size');
	$post_max_size_byte = wp_convert_hr_to_bytes($post_max_size);
	$mem_limit_byte_boolean = ($mem_limit_byte < 268435456);
	$upload_max_filesize_byte_boolean = ($upload_max_filesize_byte < 67108864);
	$post_max_size_byte_boolean = ($post_max_size_byte < 67108864);
	$execution_time = ini_get('max_execution_time');
	$execution_time_boolean = ($execution_time < 300);
	$input_vars = ini_get('max_input_vars');
	$input_vars_boolean = ($input_vars < 2000);
	$input_time = ini_get('max_input_time');
	$input_time_boolean = ($input_time < 1000);
	$change_log = get_template_directory().'/Change_log.txt';
	$theme_name_lowercase = strtolower($theme_name).'_webnus_theme_options';
	$theme_option_address = admin_url("themes.php?page=$theme_name_lowercase");
	$verifystatus = get_option( $theme_name.'theme_activate' );
	$verify_inc = new Webnus_Envato;
	$verify = $verify_inc->get_MEC_info('info');

	$keyses = array(
    'a' => array(
        'href' => array(),
        'title' => array(),
		'target' => array(),
    ),
    'br' => array(),
    'em' => array(),
    'strong' => array(),
	'code' => array(
		'class' => array(),
	),
	'p' => array(
		'class' => array(),
	),
	);
	ob_start();
	?>
	<div id="webnus-dashboard" class="wrap about-wrap">
		<div class="welcome-head w-clearfix">
			<div class="w-row">
				<div class="w-col-sm-10">
					<h1> <?php echo esc_html__('Welcome to','michigan') .' '.$theme_name.'!'; ?> </h1>
					<div class="w-welcome">
						<p><?php echo  $theme_name.' '.esc_html__('is now installed and ready to use! Get ready to build something beautiful.','michigan') ?></p>
					</div>
				</div>
				<div class="w-col-sm-2">
					<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" />
					<span class="w-theme-version"><?php echo esc_html__('Version','michigan'); ?> <?php echo $theme_version; ?></span>
				</div>
			</div>
		</div>
		<div class="welcome-content w-clearfix">

		<div class="w-row">
				<div class="w-col-sm-12">
					<?php
					if( isset( $verify->code ) && !isset( $verify->error ) ) {
						$verify_class = ' verified';
					}else{
						$verify_class = ' unverify';
					}
					?>
					<div class="w-box activation <?php echo $verify_class; ?>">
						<form id="activate_theme_form">
							<span id="ajax_theme_activate_nounce" class="hidden">
								<?php wp_create_nonce( 'ajax_theme_activate_nounce' ); ?>
							</span>
							<div class="w-box-head">
								<?php
								echo '<span>';
									if( isset( $verify->code ) && !isset( $verify->error ) ) {
										echo '<i class="ti-check"></i>';
									}else{
										echo '<i class="ti-close"></i>';
									}
								echo "</span>";
								esc_html_e('Theme Activation','michigan');

								if ( version_compare( $theme_version , $version , '<') ){
									if( isset( $verify->code ) && !isset( $verify->error ) ) {
										echo '<div class="link-update-theme w-button"> <a href="'. admin_url("update-core.php") .'">' . esc_html__('Click to Update Theme','michigan') . ' </a> </div>';
									}
								}
								?>
							</div>
							<div class="w-box-content">
								<?php  esc_html_e('Please Active Theme to have Auto Update.' , 'michigan'); ?>
								<div class="w-system-info">
									<label class="webnus_activation_label" for="security_token">
										<?php  esc_html_e('Seciurty Token','michigan'); ?>
									</label>
									<?php
										$security_token_value = isset($verifystatus['security_token']) ? $verifystatus['security_token'] : '';
									?>
									<input type="text" class="webnus_activation_text" id="security_token" name="security_token" value="<?php echo $security_token_value;  ?>" placeholder="Enter Your Token"/>
									<?php if( !isset( $verify->error ) && $verify !== false ): ?>
										<span class="wn-active-suc wn-notice-active">
											<?php _e('Verified', 'michigan'); ?>
										</span>
									<?php elseif( isset( $verify->error_description ) ): ?>
										<span class="wn-active-error wn-notice-active">
											<?php _e( $verify->error_description, 'michigan' ); ?>
										</span>
									<?php else: ?>
										<span class="wn-active-error wn-notice-active">
											<?php _e( 'UnVerified', 'michigan' ); ?>
										</span>
									<?php endif; ?>
										<span class="wn-help">
											<a href="https://www.youtube.com/watch?v=J_Gwn19Ppuc" title="<?php esc_html_e('How to create Seciurty Token','michigan'); ?>" target="_blank"><i class="ti-help"></i></a>
										</span>
								</div>
								<div class="w-system-info">
									<label class="webnus_activation_label" for="purchase_code">
										<?php esc_html_e('Purchase Code','michigan'); ?>
									</label>
									<?php
										$purchase_code_value = isset($verifystatus['purchase_code']) ? $verifystatus['purchase_code'] : '' ;
									?>
									<input type="text" class="webnus_activation_text" id="purchase_code" name="purchase_code" value="<?php echo $purchase_code_value; ?>" placeholder="Enter Your Purchase Code" />
									<?php if( isset( $verify->code ) ): ?>
										<span class="wn-active-suc wn-notice-active">
											<?php _e('Verified', 'michigan'); ?>
										</span>
									<?php else: ?>
										<span class="wn-active-error wn-notice-active">
											<?php _e('UnVerified', 'michigan'); ?>
										</span>
									<?php endif; ?>
								</div>
								<?php if( isset( $verify->code ) && !isset( $verify->error ) ): ?>
									<div class="w-button">
										<button class="w-button activate_button green" type="submit" id="activate_theme" >
											<?php echo esc_html__('Activated','michigan'); ?>
										</button>
									</div>
								<?php else: ?>
									<div class="w-button">
										<button class="w-button activate_button" type="submit" id="activate_theme" >
											<?php echo esc_html__('Activate','michigan'); ?>
										</button>
									</div>
								<?php endif; ?>
							</div>
						</form>
					</div>
					<div class="activate_theme"></div>
				</div>
			</div>

			<div class="w-row">
				<div class="w-col-sm-12">
					<h3> <?php echo esc_html__('To use the theme in best way, we suggest importing the demo first. please read below steps To install Theme and  import Dummy data:','michigan'); ?> </h3>
				</div>
			</div>

			<div class="w-row">
				<div class="w-col-sm-6">
					<div class="w-box plugin">
						<div class="w-box-head">
							<span> 1 </span> <?php echo esc_html__('Install Plugins','michigan'); ?>
						</div>
						<div class="w-box-content">
							<?php echo esc_html__('These are plugins we include or offer for design integration with Michigan. Webnus Core, LifterLMS, WP PageNavi, Visual Composer and Contact Form 7 are required plugins to use michigan. To install All plugins, click on "Install Plugins" button.' , 'michigan'); ?>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Visual Composer','michigan'); ?> </span>
								<?php
								if(!is_plugin_active('js_composer/js_composer.php')){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Not Active','michigan').' </span>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Active','michigan').' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Webnus Core','michigan'); ?> </span>
								<?php
								if(!is_plugin_active('webnus-core/webnus-core.php')){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Not Active','michigan').' </span>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Active','michigan').' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('LifterLMS','michigan'); ?> </span>
								<?php
								if(!is_plugin_active('lifterlms/lifterlms.php')){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Not Active','michigan').' </span>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Active','michigan').' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('WP PageNavi','michigan'); ?> </span>
								<?php
								if(!is_plugin_active('wp-pagenavi/wp-pagenavi.php')){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Not Active','michigan').' </span>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Active','michigan').' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Contact Form 7','michigan'); ?> </span>
								<?php
								if(!is_plugin_active('contact-form-7/wp-contact-form-7.php')){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Not Active','michigan').' </span>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Active','michigan').' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Revolution Slider','michigan'); ?> </span>
								<?php
								if(!is_plugin_active('revslider/revslider.php')){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Not Active','michigan').' </span>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Active','michigan').' </span>';
								}
								?>
							</div>
							<div class="w-button">
								<a href="<?php echo admin_url("themes.php?page=tgmpa-install-plugins") ?>" target="_blank"><?php echo esc_html__('Install Plugins','michigan'); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="w-col-sm-6">
					<div class="w-box">
						<div class="w-box-head">
							<span> 2 </span> <?php echo esc_html__('Import Dummy','michigan'); ?>
						</div>
						<div class="w-box-content">
							<?php echo esc_html__('When you install a demo it provides pages, images, theme options, posts, slider, widgets and etc. IMPORTANT: before installing a demo you need to install and activate included plugins. Please check below status to see if your server meets all essential requirements for a successful import.','michigan') ?>
							<div class="w-system-info">
								<span> <?php echo esc_html__('WP Memory Limit','michigan'); ?> </span>
								<?php
								$wp_memory_limit = WP_MEMORY_LIMIT;
								$wp_memory_limit_value = preg_replace("/[^0-9]/", '', $wp_memory_limit);
								if( $wp_memory_limit_value < 256 ){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$wp_memory_limit.' </span>
									<span class="w-min"> '.esc_html__('(min:256M)','michigan').'</span>
									<label class="hero button" for="wp-memory-limit">'.esc_html('How to fix it','michigan').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="wp-memory-limit" />
										<article class="content">
											<header class="header">
												<label class="button" for="wp-memory-limit"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red"> We recommend setting memory to at least 256MB. Please define memory limit in wp-config.php file. you can read below link for more information:</p><a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank"> Increasing Wp Memory Limit </a>', 'michigan'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="wp-memory-limit"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$wp_memory_limit.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Upload Max. Filesize','michigan'); ?> </span>
								<?php
								if($upload_max_filesize_byte_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$upload_max_filesize.' </span>
									<span class="w-min"> '.esc_html__('(min:64M)','michigan').'</span>
									<label class="hero button" for="php-upload-size">'.esc_html('How to fix it','michigan').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-upload-size" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-upload-size"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">It may not work with some shared hosts in which case you would have to ask your hosting service provider for support. </p>
												<strong>1-  Theme Functions File</strong><br>
												There are cases where we have seen that just by adding the following code in the theme function’s file, you can increase the upload size:<br>
												<code class="red">@ini_set( \'upload_max_size\' , \'64M\' );</code><br><br>
												<strong>2- Create or Edit an existing PHP.INI file</strong><br>
												In most cases if you are on a shared host, you will not see a php.ini file in your directory. If you do not see one, then create a file called php.ini and upload it in the root folder. In that file add the following code:<br>
												<code class="red"> upload_max_filesize = 64M </code><br><br>
												<strong>3- htaccess Method</strong><br>
												Some people have tried using the htaccess method where by modifying the .htaccess file in the root directory, you can increase the maximum upload size in WordPress. Open or create the .htaccess file in the root folder and add the following code:<br>
												<code class="red">php_value upload_max_filesize 64M</code><br><br>
												<a href="https://premium.wpmudev.org/blog/increase-memory-limit/?ench=b&utm_expid=3606929-78.ZpdulKKETQ6NTaUGxBaTgQ.1&utm_referrer=https%3A%2F%2Fpremium.wpmudev.org%2Fblog%2F%3Fench%3Db%26s%3Dmemory_limit" target="_blank">Increasing Upload Max. Filesize</a><br>', 'michigan'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="php-upload-size"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$upload_max_filesize.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Max. Post Size','michigan'); ?> </span>
								<?php
								if($post_max_size_byte_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$post_max_size.' </span>
									<span class="w-min"> '.esc_html__('(min:64M)','michigan').'</span>
									<label class="hero button" for="php-post-upload-size">'.esc_html('How to fix it','michigan').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-post-upload-size" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-post-upload-size"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">It may not work with some shared hosts in which case you would have to ask your hosting service provider for support. </p>
												<strong>1-  Theme Functions File</strong><br>
												There are cases where we have seen that just by adding the following code in the theme function’s file, you can increase the post upload size:<br>
												<code class="red">@ini_set( \'post_max_size\' , \'64M\' );</code><br><br>
												<strong>2- Create or Edit an existing PHP.INI file</strong><br>
												In most cases if you are on a shared host, you will not see a php.ini file in your directory. If you do not see one, then create a file called php.ini and upload it in the root folder. In that file add the following code:<br>
												<code class="red"> post_max_size = 64M </code><br><br>
												<strong>3- htaccess Method</strong><br>
												Some people have tried using the htaccess method where by modifying the .htaccess file in the root directory, you can increase the maximum post upload size in WordPress. Open or create the .htaccess file in the root folder and add the following code:<br>
												<code class="red">php_value post_max_size 64M</code><br><br>
												<a href="https://premium.wpmudev.org/blog/increase-memory-limit/?ench=b&utm_expid=3606929-78.ZpdulKKETQ6NTaUGxBaTgQ.1&utm_referrer=https%3A%2F%2Fpremium.wpmudev.org%2Fblog%2F%3Fench%3Db%26s%3Dmemory_limit" target="_blank">Increasing Max. Post Size</a><br>
												', 'michigan'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="php-post-upload-size"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$post_max_size.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('Max. Execution Time','michigan'); ?> </span>
								<?php
								if($execution_time_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i>
									<span class="w-current"> '.esc_html__('Currently:','michigan').' '.$execution_time.' </span>
									<span class="w-min"> '.esc_html__('(min:300)','michigan').'</span>
									<label class="hero button" for="execution-time">'.esc_html('How to fix it','michigan').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="execution-time" />
										<article class="content">
											<header class="header">
												<label class="button" for="execution-time"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">We recommend setting max execution time to at least 300. you can read below link for more information:</p> <a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank"> Increasing Max. Execution Time </a>', 'michigan'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="execution-time"></label>
									</aside>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$execution_time.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('PHP Max. Input Vars','michigan'); ?> </span>
								<?php
								if($input_vars_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i>
									<span class="w-current"> '.esc_html__('Currently:','michigan').' '.$input_vars.' </span>
									<span class="w-min"> '.esc_html__('(min:2000)','michigan').'</span>
									<label class="hero button" for="input-variables">'.esc_html('How to fix it','michigan').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="input-variables" />
										<article class="content">
											<header class="header">
												<label class="button" for="input-variables"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">We recommend setting max execution time to at least 300. you can read below link for more information:</p> <a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank"> Increasing PHP Max. Input Vars </a>', 'michigan'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="input-variables"></label>
									</aside>';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$input_vars.' </span>';
								}
								?>
							</div>
							<div class="w-system-info">
								<span> <?php echo esc_html__('PHP Max. Input Time','michigan'); ?> </span>
								<?php
								if($input_time_boolean){
									echo '<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$input_time.' </span>
									<span class="w-min"> '.esc_html__('(min:1000)','michigan').'</span>
									<label class="hero button" for="php-input-time">'.esc_html('How to fix it','michigan').'</label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-input-time" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-input-time"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												'.wp_kses( __('<p class="red">It may not work with some shared hosts in which case you would have to ask your hosting service provider for support. </p>
												<strong>1-  Theme Functions File</strong><br>
												There are cases where we have seen that just by adding the following code in the theme function’s file, you can increase the Max. Input Time:<br>
												<code class="red">@ini_set( \'max_input_time\' , \'1000\' );</code><br><br>
												<strong>2- Create or Edit an existing PHP.INI file</strong><br>
												In most cases if you are on a shared host, you will not see a php.ini file in your directory. If you do not see one, then create a file called php.ini and upload it in the root folder. In that file add the following code:<br>
												<code class="red"> max_input_time = 1000 </code><br><br>
												<strong>3- htaccess Method</strong><br>
												Some people have tried using the htaccess method where by modifying the .htaccess file in the root directory, you can increase the Max. Input Time in WordPress. Open or create the .htaccess file in the root folder and add the following code:<br>
												<code class="red">php_value max_input_time 1000</code><br>', 'michigan'), $keyses ).'
											</main>
										</article>
										<label class="backdrop" for="php-input-time"></label>
									</aside>
									';
								}else{
									echo '<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> '.esc_html__('Currently:','michigan').' '.$input_time.' </span>';
								}
								?>
							</div>
							<div class="w-button">
								<a href="<?php echo $theme_option_address; ?>" target="_blank"><?php echo esc_html__('Import Dummy','michigan'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="welcome-content w-clearfix extra">
			<div class="w-row">
				<div class="w-col-sm-6">
					<div class="w-box doc">
						<div class="w-box-head">
							<?php echo esc_html__('Documentation','michigan'); ?>
						</div>
						<div class="w-box-content">
							<p>
							<?php echo esc_html__('Our documentation is simple and functional wit full details and cover all essential aspects from beginning to the most advanced parts.' , 'michigan'); ?>
							</p>
							<div class="w-button">
								<a href="http://webnus.biz/documentation/michigan/" target="_blank"><?php echo esc_html__('DOCUMENTATION','michigan'); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="w-col-sm-6">
					<div class="w-box support">
						<div class="w-box-head">
							<?php echo esc_html__('Support Forum','michigan'); ?>
						</div>
						<div class="w-box-content">
							<p>
							<?php echo esc_html__('Webnus is elite and trusted author with high percentage of satisfied user. If you have any issues please don’t hesitate to contact us, we will reply as soon as possible.' , 'michigan'); ?>
							</p>
							<div class="w-button">
								<a href="https://webnus.ticksy.com/" target="_blank"><?php echo esc_html__('OPEN A TICKET','michigan'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="w-update-notices" class="w-row">
				<div class="w-col-sm-12">
					<br><br><br>
					<h3><?php echo esc_html__( 'Updates Notices:', 'michigan' ); ?></h3>
					<div class="w-box change-log">
						<div class="w-box-head">
							<?php echo esc_html__( 'Updating michigan from earlier versions to version 2', 'michigan' ); ?>
						</div>
						<div class="w-box-content">
							<p><?php esc_html_e( 'In this version we have structural changes and you need to follow below steps to update the theme completely:', 'michigan' ); ?></p>
							<ol>
								<li><?php esc_html_e( 'Delete old plugins: Go to plugins and delete Webnus Importer and Webnus Core', 'michigan' ); ?></li>
								<li><?php esc_html_e( 'Re-install Webnus Core plugin: go to Appearance > Install plugins and install it.', 'michigan' ); ?></li>
								<li><?php esc_html_e( 'Set again website color in "Theme Options > Styling Options > Color"', 'michigan' ); ?></li>
								<li><?php esc_html_e( 'Typography and Colors Options: in this version the structure of these options have changed and you need to set your configuration again. To do that go to appearance > theme options > typography and styling options.', 'michigan' ); ?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="w-row">
				<div class="w-col-sm-12">
					<div class="w-box change-log">
						<div class="w-box-head">
							<?php echo esc_html__('Changelog (Updates)','michigan'); ?>
						</div>
						<div class="w-box-content">
							<?php include_once get_template_directory() . '/Change_log.php'; ?>
							<pre><?php echo '' . $change_log; ?></pre>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$out = ob_get_contents();
ob_end_clean();
echo $out;
}

add_action( 'in_admin_footer', 'ajax_activate_js' );
function ajax_activate_js() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#activate_theme_form").on('submit', function(event)
			{
			    event.preventDefault();

			    // Add loading Class to the button
			    jQuery("#activate_theme").addClass('loading').text("<?php esc_attr_e('Saving...', 'easyweb'); ?>");
			    jQuery(".activate_theme").addClass('activate_loading');

			    var fields = jQuery("#activate_theme_form").serialize();
			    jQuery.ajax(
			    {
			        type: "POST",
			        url: ajaxurl,
			        data: "action=activate_theme&"+fields,
			        success: function(data)
			        {
			            // Remove the loading Class to the button
			            setTimeout(function(){
			                jQuery("#activate_theme").removeClass('loading').text("<?php esc_attr_e('Activate', 'easyweb'); ?>");
			                jQuery(".activate_theme").removeClass('activate_loading');
			            }, 1000);
			            location.reload( true );
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {
			            // Remove the loading Class to the button
			            setTimeout(function(){
			                jQuery("#activate_theme").removeClass('loading').text("<?php esc_attr_e('Activate', 'easyweb'); ?>");
			                jQuery(".activate_theme").removeClass('activate_loading');
			            }, 1000);
			        }
			    });
			});
		});
	</script>
<?php
}