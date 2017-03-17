<?php
// Add Localization
load_theme_textdomain('michigan', get_template_directory().'/languages');

// Includes
include_once get_template_directory(). '/inc/init.php';
include_once get_template_directory(). '/inc/visualcomposer/init.php';
include_once get_template_directory(). '/css/dyncss.php';

add_action( 'after_setup_theme', 'michigan_webnus_content_width', 0 );
add_action( 'after_setup_theme', 'michigan_webnus_theme_setup' );
add_action( 'after_setup_theme', 'lifterlms_llms_theme_support' );


if (!defined( 'BP_AVATAR_FULL_WIDTH' )) { define( 'BP_AVATAR_FULL_WIDTH', 400 ); }
if (!defined( 'BP_AVATAR_FULL_HEIGHT' )) { define( 'BP_AVATAR_FULL_HEIGHT', 400 ); }

function michigan_webnus_theme_setup() {
	add_theme_support('title-tag');
	add_theme_support('woocommerce');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-formats', array( 'aside','gallery', 'link', 'quote','image','video','audio' ));
	add_theme_support('post-thumbnails');

	add_image_size("michigan_webnus_tabs_img",	164,124, true);
	add_image_size("michigan_webnus_blog3_img",	420,280, true);
	add_image_size("michigan_webnus_blog2_img",	420,330, true);
	add_image_size("michigan_webnus_square_img",460,460, true);
	add_image_size("michigan_webnus_latest_img",720,388, true);
	add_image_size("michigan_webnus_courses_img",518,294, true);
	add_image_size("michigan_webnus_cover_img",690,460, true);

	add_action('init', 'michigan_webnus_register_menus');
	add_action('init','michigan_webnus_author_permalinks');
	add_action('init', 'michigan_add_featured_question');
	add_action('widgets_init', 'michigan_webnus_sidebar_init' );
	add_action('wp_enqueue_scripts', 'michigan_webnus_script_loader');
	add_action('wp_enqueue_scripts', 'michigan_webnus_api', 10);
	add_action('admin_menu', 'michigan_webnus_remove_meta_boxes' );
	add_action('admin_enqueue_scripts', 'michigan_webnus_admin_enqueue', 100 );
	add_action('wp_head', 'michigan_webnus_wphead_action');
	add_action('wp_head', 'michigan_webnus_open_graph_tags');
	add_action('login_head', 'michigan_webnus_custom_login_logo' );
	add_action('woocommerce_init', 'michigan_webnus_woocommerce_direct_checkout');
	add_action('template_redirect', 'michigan_webnus_maintenance_mode' );
	add_action('bp_setup_nav', 'michigan_webnus_bp_nav', 1000 );

	add_action('registered_post_type', 'michigan_webnus_time_table_rename', 10, 2 );
	add_action('pre_get_posts', 'michigan_webnus_course_search_filter' );

	add_action( 'admin_init', 'add_theme_caps');
	add_action('wp_insert_post', 'michigan_set_default_meta_data');

	remove_action( 'lifterlms_before_student_dashboard_content', 'lifterlms_template_student_dashboard_title', 20 );
	remove_action( 'lifterlms_sidebar', 'lifterlms_get_sidebar' );

	add_filter('body_class', 'michigan_webnus_body_classes', 10, 3);
	add_filter('wp_nav_menu_args', 'michigan_webnus_walker');
	add_filter('excerpt_length', 'michigan_webnus_excerpt_length', 999);
	add_filter('excerpt_more', 'michigan_webnus_excerpt_more');
	add_filter('the_content_more_link', 'michigan_webnus_excerpt_more');
	add_filter('user_contactmethods','michigan_webnus_extra_fields',10,1);
	add_filter('upload_mimes', 'michigan_webnus_custom_font_mimes');
	add_filter('lifterlms_admin_courses_access', 'michigan_webnus_llms_access', 10, 1 );
	add_filter('edit_profile_url', 'michigan_webnus_edit_profile', 10, 3 );
	add_filter('widget_text', 'do_shortcode');
	add_filter( 'llms_get_theme_default_sidebar', 'course_llms_sidebar_function' );
	add_filter( 'llms_get_theme_default_sidebar', 'lesson_llms_sidebar_function' );


	update_option('image_default_link_type', 'file');
}

// Globals should always be within a function
function michigan_webnus_options() {
	global $michigan_webnus_options;
	return $michigan_webnus_options;
}

/***************************************/
/*	 	 Add Featured Image to Question
/***************************************/

function michigan_add_featured_question() {
  add_post_type_support( 'llms_question', array( 'thumbnail' ) );
  add_post_type_support( 'llms_quiz', array( 'thumbnail' ) );
}

/***************************************/
/*	 	 Webnus Instructor Update
/***************************************/

function michigan_webnus_instructor_update($user_id) {
	global $wpdb;
	global $post;
	$instructor_rate_score = $instructor_rate = $course_count = $student_count = 0;
	$instructor_rate_users = 1;
	$args = array('post_type' => 'course' , 'author' => $user_id,'posts_per_page' => -1);
	$custom_posts = new WP_Query( $args );
	while ( $custom_posts->have_posts() ) : $custom_posts->the_post();
		// Course Students
		$students = $wpdb->get_results($wpdb->prepare(
			'SELECT user_id, meta_value, post_id
			FROM '.$wpdb->prefix . 'lifterlms_user_postmeta
			WHERE meta_key = "_status" AND meta_value = "Enrolled" AND post_id = %d AND EXISTS(SELECT 1 FROM ' . $wpdb->prefix . 'users WHERE ID = user_id)
			group by user_id'
		,get_the_ID()));
		// Course Rating
		if(function_exists('the_ratings')) {
			$instructor_rate_score = $instructor_rate_score + get_post_meta(get_the_ID(), 'ratings_score' , true);
			$instructor_rate_users = $instructor_rate_users + get_post_meta(get_the_ID(), 'ratings_users' , true);
		}
		// Course Count
		$course_count++;
		$student_count = $student_count + count($students);
	endwhile;
	$instructor_rate = ($instructor_rate_users)?($instructor_rate_score/$instructor_rate_users):'';
	$instructor_rate = number_format($instructor_rate, 1);
	delete_user_meta( $user_id, 'instructor_is');
	delete_user_meta( $user_id, 'instructor_courses');
	delete_user_meta( $user_id, 'instructor_students');
	delete_user_meta( $user_id, 'instructor_rate');
	if($course_count){
		add_user_meta( $user_id, 'instructor_is', true);
		add_user_meta( $user_id, 'instructor_courses', $course_count);
		add_user_meta( $user_id, 'instructor_students', $student_count);
		add_user_meta( $user_id, 'instructor_rate', $instructor_rate);
	}
	wp_reset_postdata();
}


/***************************************/
/*	 	Webnus Course Price
/***************************************/

if(!function_exists('course_price')) {
	function course_price(){
		$post_id = get_the_ID();
		$course_price_meta = rwmb_meta('michigan_course_price_meta');
		$argumants = array(
			'meta_key' => '_llms_product_id',
			'meta_value' => $post_id,
			'post_type' => 'llms_access_plan',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);
		$posts = get_posts($argumants);
		$course_is_free = '';
		$minimum_price = '';
		if( class_exists('LifterLMS') && ! llms_is_user_enrolled( get_current_user_id(), $post_id ) && class_exists('LLMS_Integration_WooCommerce') ){
			$p = new LLMS_Product( get_the_ID() );
			$id = $p->get( 'wc_product_id' );
			if ( $id ) {
				$_product = wc_get_product( $id );
				$minimum_price = esc_html__( 'Course Price:' , 'michigan' ) . ' ' . get_lifterlms_currency_symbol() . $_product->get_price();
			}
		}elseif ( class_exists('LifterLMS') && ! llms_is_user_enrolled( get_current_user_id(), $post_id ) && !class_exists('LLMS_Integration_WooCommerce') ){
			if ( array_values( $posts ) ){
				for ( $i=0; $i < count($posts); $i++) {
					if ( get_post_meta($posts[$i]->ID, '_llms_is_free', true ) == 'yes' ){
							$minimum_price = esc_html__( 'This Course is FREE' , 'michigan' );
							$course_is_free = true;
					}
				}
			}

			if ( array_values( $posts ) && $course_is_free != true ){
				for ( $i=0; $i < count($posts); $i++) {
					// Regula Price
					if( get_post_meta( $posts[$i]->ID, '_llms_price', true ) ){
						$meta[] = get_post_meta( $posts[$i]->ID, '_llms_price', true );
					}
					// Sale Price
					if( get_post_meta( $posts[$i]->ID, '_llms_sale_price', true ) ){
						$now 	= current_time( 'timestamp' );
						$start 	= get_post_meta( $posts[$i]->ID, '_llms_sale_start', true );
						$end 	= get_post_meta( $posts[$i]->ID, '_llms_sale_end', true );
						$start 	= ( $start ) ? strtotime( $start . ' 00:00:00' ) : $start;
						$end 	= ( $end ) ? strtotime( $end . ' 23:23:59' ) : $end;
						if ( $start && $end && $now > $start && $now < $end ){
							$meta[] = get_post_meta( $posts[$i]->ID, '_llms_sale_price', true );
						}elseif( ( $start && $now > $start ) && ! $end  ){
							$meta[] = get_post_meta( $posts[$i]->ID, '_llms_sale_price', true );
						}elseif( ( $end && $now < $end ) && ! $start ){
							$meta[] = get_post_meta( $posts[$i]->ID, '_llms_sale_price', true );
						}elseif( ! $start && ! $end ){
							$meta[] = get_post_meta( $posts[$i]->ID, '_llms_sale_price', true );
						}
					}
					// Trial Price
					if( get_post_meta( $posts[$i]->ID, '_llms_trial_price', true ) ){
						$meta[] = get_post_meta( $posts[$i]->ID, '_llms_trial_price', true );
					}
				}
				$minimum_price = esc_html__( 'Start from' , 'michigan' ) . ' ' . get_lifterlms_currency_symbol() . min(array_values( $meta ));
			}

			if ( ! array_values( $posts ) ){
				$minimum_price = "No access plans exist.";
			}
		}elseif( class_exists('LifterLMS') && llms_is_user_enrolled( get_current_user_id(), $post_id ) ){
			$minimum_price = esc_html__( "Aready Enrolled the course" , "michigan");
		}else{
			$minimum_pric = $course_price_meta;
		}

		echo $minimum_price;
	}
}


/***************************************/
/*	 	 Change Author Permalinks
/***************************************/

function michigan_webnus_author_permalinks() {
    global $wp_rewrite;
    $michigan_webnus_options = michigan_webnus_options();
	$author_permalink = isset( $michigan_webnus_options['michigan_webnus_author_permalink'] ) ? $michigan_webnus_options['michigan_webnus_author_permalink'] : '' ;
	$author_permalink = ($author_permalink)?$author_permalink:'profile';
    $wp_rewrite->author_base = $author_permalink;
    $wp_rewrite->flush_rules();
}


/***************************************/
/*	 	 LifterLMS Access
/***************************************/

function michigan_webnus_llms_access( $capability ){
  $capability = 'edit_posts';
  return $capability;
}


/***************************************/
/*	 	   Body Classes
/***************************************/

function michigan_webnus_body_classes( $classes) {
	$michigan_webnus_options = michigan_webnus_options();
	if($michigan_webnus_options['michigan_webnus_enable_smoothscroll']) { // smooth scroll
        $classes[] = 'smooth-scroll';
    }
	if($michigan_webnus_options['michigan_webnus_header_topbar_enable']) { // topbar enable
        $classes[] = 'has-topbar-w';
    }
	if($michigan_webnus_options['michigan_webnus_topbar_fixed']) { // topbar fixed
        $classes[] = 'topbar-fixed';
    }
    if ( $michigan_webnus_options['michigan_webnus_header_menu_type'] == 12 ) {
    	$classes[] = 'has-header-type12';
    }

	// Post Show
	if (is_single()){
		$post_meta = rwmb_meta( 'michigan_blogpost_meta' );
		if(!empty($post_meta)){
			if($post_meta=="postshow1" && $thumbnail_id = get_post_thumbnail_id()){
				$classes[] = esc_attr( " postshow1-hd transparent-header-w t-dark-w" );
			} elseif ( $post_meta=="postshow2" && $thumbnail_id = get_post_thumbnail_id() ) {
				$classes[] = esc_attr( " postshow2-hd" );
			}
		}
	}

	if(is_page()){ // Transparent Header
		$transparent_header = rwmb_meta( 'michigan_transparent_header_meta' );
		if($transparent_header=='light'){
			$classes[] = 'transparent-header-w';
		}elseif($transparent_header=='dark'){
			$classes[] = 'transparent-header-w t-dark-w';
		}
	}
    return $classes;
}

/********************************/
/*   	Template Functions
/********************************/
function michigan_webnus_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="comment-info">
		<?php echo get_avatar( $comment, 90 ); ?>
		<cite>
		<?php comment_author_link() ?>:
		<span class="comment-data"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F j, Y'); ?> at <?php comment_time('g:i a'); ?></a><?php edit_comment_link('Edit',' | ',''); ?></span>
		</cite>
	</div>
	<div class="comment-text">
		<?php if ($comment->comment_approved == '0') : ?>
		<p><em><?php esc_html_e('Your comment is awaiting moderation.','michigan'); ?></em></p>
		<?php endif; ?>
		<?php comment_text() ?>
		<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
	</div>
	<?php
}

function michigan_webnus_topbar($pos){
	$michigan_webnus_options = michigan_webnus_options();
	$class=($pos=='left')?'lftflot':'rgtflot';
	echo '<div class="top-links '.$class.'">';
	if($michigan_webnus_options['michigan_webnus_topbar_search']==$pos){
		echo '<form id="topbar-search" role="search" action="'.esc_url(home_url( '/' )).'" method="get" ><input name="s" type="text" class="search-text-box" ><i class="search-icon fa-search"></i></form>';
	}
	if ($michigan_webnus_options['michigan_webnus_topbar_social']==$pos){
		echo '<div class="socialfollow">';
		get_template_part('parts/social' );
		echo '</div>';
	}
	if ($michigan_webnus_options['michigan_webnus_topbar_login']==$pos){
		if(is_user_logged_in()) { //show user menu
			global $user_identity;
			global $user_ID;
			$user_info = get_userdata($user_ID);
			echo '<div class="hcolorf wuser-menu">'.esc_html__('welcome ','michigan') . esc_html($user_identity).'<span class="wuser-avatar">'.get_avatar( $user_ID, $size = '36').'</span><div class="wuser-smenu">';
			if(current_user_can('manage_options')){ //admin
				echo '<a href="'.admin_url().'">'.esc_html__( 'WP Admin', 'michigan' ).'</a>';
			}elseif(current_user_can('edit_posts')){ //instructor
				echo '<a href="'.admin_url().'edit.php?post_type=course">'.esc_html__( 'Manage Courses', 'michigan' ).'</a>';
			}
			echo '<a href="'.get_author_posts_url($user_ID).'">'.esc_html__( 'My Profile', 'michigan' ).'</a>';
			if (is_plugin_active('lifterlms/lifterlms.php')) { //LifterLMS
				echo '<a href="'.get_permalink( llms_get_page_id('myaccount')).'">'.esc_html__( 'My Dashboard', 'michigan' ).'</a>';

			}elseif (is_plugin_active('buddypress/bp-loader.php')){ //Buddypress
				echo '<a href="'. bp_loggedin_user_domain().'">'.esc_html__( 'My Dashboard', 'michigan' ).'</a>';
			}

			if (is_plugin_active('buddypress/bp-loader.php')) { //Buddypress
				echo '<a href="'. bp_loggedin_user_domain().'profile/account-setting/">'.esc_html__( 'Edit Profile', 'michigan' ).'</a>';
			}elseif(is_plugin_active('lifterlms/lifterlms.php')) { //LifterLMS
				echo '<a href="'.get_permalink( llms_get_page_id('myaccount')).get_option( 'lifterlms_myaccount_edit_account_endpoint', 'edit-account' ).'">'.esc_html__( 'Edit Profile', 'michigan' ).'</a>';
			}

			if (is_plugin_active('lifterlms/lifterlms.php')) { //LifterLMS
				echo '<a href="'.llms_person_redeem_voucher_url().'">'.esc_html__( 'Redeem a Voucher', 'michigan' ).'</a>';
			}

			echo	'<a href="'.wp_logout_url(get_permalink()).'">'.esc_html__( 'Sign out', 'michigan' ).'</a></div></div>';
		}else{ //show login modal

		/* login button */
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$login_class =(is_plugin_active('userpro/index.php'))? 'popup-login':'inlinelb';
		$login_text = $michigan_webnus_options['michigan_webnus_topbar_login_text'];
		echo '<a href="#w-login" class="'.$login_class.' topbar-login" target="_self">'.esc_html($login_text).'</a>';

		/* modal form colorskin */
		$michigan_webnus_options['michigan_webnus_color_skin'] = isset($michigan_webnus_options['michigan_webnus_color_skin']) ? $michigan_webnus_options['michigan_webnus_color_skin'] : '' ;
		$colorskin= ( $michigan_webnus_options['michigan_webnus_color_skin'] != 'e3e3e3' ) ? ' colorskin-custom ':'';

		/* modal form */
		$form_class=($michigan_webnus_options['michigan_webnus_template_select'])? ' '.$michigan_webnus_options['michigan_webnus_template_select'].'-t ':'';
		echo '<div style="display:none"><div id="w-login" class="w-login w-modal'.$colorskin.$form_class.'">';
		echo '<h3 class="modal-title">'.esc_html__('LOGIN','michigan').'</h3>';
		if ( function_exists( 'michigan_webnus_login' ) ) :
			michigan_webnus_login();
		endif;
		echo '</div></div>';
		}
	}

	if($michigan_webnus_options['michigan_webnus_topbar_contact']==$pos){
		$contact_text = $michigan_webnus_options['michigan_webnus_topbar_contact_text'];
		echo'<a class="inlinelb topbar-contact" href="#w-contact" target="_self">'.esc_html($contact_text).'</a>';
	}

	if ($michigan_webnus_options['michigan_webnus_topbar_info']==$pos){
		echo ($michigan_webnus_options['michigan_webnus_topbar_email'])?'<h6><i class="fa-envelope-o"></i>'. esc_html($michigan_webnus_options['michigan_webnus_topbar_email']) .'</h6>':'';
		echo ($michigan_webnus_options['michigan_webnus_topbar_phone'])?'<h6><i class="fa-phone"></i>'. esc_html($michigan_webnus_options['michigan_webnus_topbar_phone']).'</h6>':'';
	}

	if ($michigan_webnus_options['michigan_webnus_topbar_menu']==$pos && has_nav_menu('header-top-menu')){
		if($michigan_webnus_options['michigan_webnus_header_menu_type']==0){
			$menuParameters = array('theme_location' => 'header-top-menu','container' => 'false','menu_id' => 'nav','depth' => '5','items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new michigan_webnus_description_walker(),);
		}else{
			$menuParameters = array('theme_location' => 'header-top-menu','container' => 'false', 'depth' => '1', 'echo'  => false,  'walker' => new michigan_webnus_description_walker(),);
		}
		echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
	}

	if ($michigan_webnus_options['michigan_webnus_topbar_custom']==$pos){
		echo esc_html($michigan_webnus_options['michigan_webnus_topbar_text']);
	}

	if ($michigan_webnus_options['michigan_webnus_topbar_language']==$pos){
		do_action('icl_language_selector');
	}
	echo'</div>';
}


/***************************************/
/*	   Remove Meta Boxes
/***************************************/
function michigan_webnus_remove_meta_boxes() {
      remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
}


/***************************************/
/*	   Add Webnus Walker to Custom Menu
/***************************************/

function michigan_webnus_walker( $args ) {
    return array_merge( $args, array(
		'walker' => new michigan_webnus_description_walker(),
    ) );
}


/***************************************/
/*	    Maintenance Mode
/***************************************/

function michigan_webnus_maintenance_mode() {
	$michigan_webnus_options = michigan_webnus_options();
	$is_maintenance = $michigan_webnus_options['michigan_webnus_maintenance_mode'];
	$maintenance_page = $michigan_webnus_options['michigan_webnus_maintenance_page'];
    if (!is_page( $maintenance_page ) && $is_maintenance && $maintenance_page && !current_user_can('edit_posts') && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ))){
        wp_redirect( home_url( 'index.php?page_id='.$maintenance_page) );
        exit();
    }
}

/***************************************/
/*	    Excerpt Length
/***************************************/

function michigan_webnus_excerpt_length($length) {
    return 300;
}

function michigan_webnus_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

function michigan_webnus_excerpt_more($more) {
	$michigan_webnus_options = michigan_webnus_options();
	global $post;
	return '... <br><br><a class="readmore" href="' . get_permalink($post->ID) . '">' . esc_html($michigan_webnus_options['michigan_webnus_blog_readmore_text']) . '</a>';
}

/***************************************/
/*	    Add contact links
/***************************************/
function michigan_webnus_extra_fields( $contactmethods ) {
	// Add Display Email
	$contactmethods['display_email'] = 'Display Email';
    // Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    // Add Facebook
    $contactmethods['facebook'] = 'Facebook';
    // Add Google+
    $contactmethods['googleplus'] = 'Google+';
    // Add linkedin
    $contactmethods['linkedin'] = 'LinkedIn';
	// Add Youtube
    $contactmethods['youtube'] = 'Youtube';
	// Add Title
	$contactmethods['title'] = 'Title';
	// Add Bio for instructor in courses page and etc.
	$contactmethods['biography'] = 'Summary Biography';
    unset($contactmethods['yim']);
    unset($contactmethods['aim']);
    return $contactmethods;
}

/******************************************/
/*	  Add LMS profile link to buddypress
/******************************************/
function michigan_webnus_bp_nav() {
	global $bp;
	bp_core_new_subnav_item( array(
		'parent_url'   => trailingslashit( bp_displayed_user_domain() . $bp->profile->slug ),
		'parent_slug'  => $bp->profile->slug,
		'name' => __( 'Edit Profile', 'michigan' ),
		'slug' => 'account-setting',
		'position' => 10,
		'user_has_access'   => bp_is_my_profile(),
		'screen_function' => 'michigan_webnus_account_setting',
		'show_for_displayed_user' => true,
		'default_subnav_slug' => 'w-account-setting',
		'item_css_id' => 'w-account-setting'
	) );
	//$bp->bp_options_nav['profile']['lms-profile']['position'] = 10;
	//$bp->bp_options_nav['profile']['change-avatar']['position'] = 20;
	//$bp->bp_options_nav['profile']['change-cover-image']['position'] = 30;
	bp_core_remove_subnav_item( $bp->profile->slug, 'edit' );
}
function michigan_webnus_account_lifter() {
	echo '<div id="groups-dir-list" class="groups dir-list">';
	locate_template( array( 'lifterlms/myaccount/form-edit-account.php' ), true );
	echo '</div>';
}
function michigan_webnus_account_setting () {
	add_action( 'bp_template_content', 'michigan_webnus_account_lifter' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}
function michigan_webnus_edit_profile( $url, $user_id, $scheme ){
	if (is_plugin_active('buddypress/bp-loader.php')){
	$url = bp_loggedin_user_domain().'profile/account-setting/';
	}
	return $url;
}


/****************************/
/*	Create Instructors Page
/****************************/
if( null == get_page_by_title('Instructors') ) {
	$inst_post_id = wp_insert_post(
		array(
			'comment_status'	=>	'closed',
			'post_author'		=>	1,
			'post_name'		    =>	'instructors',
			'post_title'		=>	'Instructors',
			'post_content'      => '[instructors count="8" page="enable"]',
			'post_status'		=>	'publish',
			'post_type'		    =>	'page'
		)
	);
}else{
 // Arbitrarily use -2 to indicate that the page with the title already exists
    $inst_post_id = -2;
}



/****************************/
/*	   Navigation Menu
/****************************/

/** Register Menus */
function michigan_webnus_register_menus() {
	register_nav_menus(
		array(
			'header-menu' => esc_html__('Header Menu', 'michigan'),
			'duplex-menu-left' => esc_html__('Duplex Menu - Left', 'michigan'),
			'duplex-menu-right' => esc_html__('Duplex Menu - Right', 'michigan'),
			'footer-menu' => esc_html__('Footer Menu', 'michigan'),
			'header-top-menu' => esc_html__('Topbar Menu', 'michigan'),
			'onepage-header-menu' => esc_html__('Onepage Header Menu', 'michigan'),
			'header-bottom-menu' => esc_html__('Header Bottom Menu', 'michigan'),
		)
	);
}

/** Walker Nav Menu */
class michigan_webnus_description_walker extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth=0, $args=array(),$current_object_id=0){
		$this->curItem = $item;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$is_mega_menu = '';
		if('page'  == $item->object){
			$post_obj = get_post( $item->object_id, 'OBJECT' );
			$is_mega = get_post_meta($item->object_id,'michigan_mega_menu_meta',true);
			if(!empty($is_mega))
				$is_mega_menu .= ' mega ';
		}
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		$item_output = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		if('page'  == $item->object){
			$post_obj = get_post( $item->object_id, 'OBJECT' );
			$is_mega = get_post_meta($item->object_id,'michigan_mega_menu_meta',true);
			if(!empty($is_mega))
				$item_output .= do_shortcode($post_obj->post_content);
			else {
				$item_output .= $args->before;
				/** colorize categories in menu */
				$color ='';
				if ($item->object == 'category'){
					$cat_data = get_option("category_$item->object_id");
					$color = (!empty($cat_data['catBG']))?'style="color:'. $cat_data['catBG'] .'"':'';
				}
				$item_output .= '<a '. $color . $attributes. ' data-description="' .$item->description .'">';
				if(!empty($item->icon))
				$item_output .= '<i class="'.$item->icon.'"></i>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;
			}
		}
		else{
			$item_output .= $args->before;
			$item_output .= '<a '. $attributes. ' data-description="' .$item->description .'">';
			if(!empty($item->icon))
				$item_output .= '<i class="'.$item->icon.'"></i>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
		}
		/** mega posts start */
		if ( $depth == 0 && $item->object == 'category' && $item->classes['0'] == "mega" ) {
			$item_output .= '<ul class="sub-posts">';
				global $post;
				$menuposts = get_posts( array( 'posts_per_page' => 4, 'category' => $item->object_id ) );
				foreach( $menuposts as $post ):
					$post_title = get_the_title();
					$post_link = get_permalink();
					$post_time = the_time(get_option('date_format')) ;
					$post_comments = get_comments_number();
					$post_views = michigan_webnus_getViews(get_the_ID());
					$post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), "michigan_webnus_latest_img" );
					if ( $post_image != ''){
						$menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" />';
					} else {
						$menu_post_image = esc_html__( 'No image','michigan');
					}
					$item_output .= '
							<li>
								<figure>
									<a href="'  .esc_url($post_link) . '">' . $menu_post_image . '</a>
								</figure>
								<h5><a href="' . esc_url($post_link) . '">' . $post_title . '</a></h5>
							</li>';
				endforeach;
				wp_reset_postdata();
			$item_output .= '</ul>';
		}
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}



/*******************************/
/*		Register Sidebars
/******************************/
function michigan_webnus_sidebar_init() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'michigan' ),
		'id'            => 'left-sidebar',
		'description'   => esc_html__( 'Appears in left side in the blog page.', 'michigan' ),
		'before_title'  => '<h4 class="subtitle">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'michigan' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Appears in right side in the blog page.', 'michigan' ),
		'before_title'  => '<h4 class="subtitle">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 1', 'michigan' ),
		'id'            => 'top-area-1',
		'description'   => esc_html__( 'Appears in top area section 1', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 2', 'michigan' ),
		'id'            => 'top-area-2',
		'description'   => esc_html__( 'Appears in top area section 2', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 3', 'michigan' ),
		'id'            => 'top-area-3',
		'description'   => esc_html__( 'Appears in top area section 3', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 4', 'michigan' ),
		'id'            => 'top-area-4',
		'description'   => esc_html__( 'Appears in top area section 4', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 1', 'michigan' ),
		'id'            => 'footer-section-1',
		'description'   => esc_html__( 'Appears in footer section 1', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 2', 'michigan' ),
		'id'            => 'footer-section-2',
		'description'   => esc_html__( 'Appears in footer section 2', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 3', 'michigan' ),
		'id'            => 'footer-section-3',
		'description'   => esc_html__( 'Appears in footer section 3', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 4', 'michigan' ),
		'id'            => 'footer-section-4',
		'description'   => esc_html__( 'Appears in footer section 4', 'michigan' ),
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'WooCommerce Page Sidebar', 'michigan' ),
		'id' => 'shop-widget-area',
		'description' => esc_html__( 'Product page widget area', 'michigan' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3><div class="sidebar-line"><span></span></div>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Header Sidebar', 'michigan' ),
		'id' => 'header-advert',
		'description' => esc_html__( 'Header Sidebar', 'michigan' ),
		'before_title' => '<h5 class="subtitle">',
		'after_title' => '</h5>',
	) );

	if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
		register_sidebar( array(
			'name' => esc_html__( 'Buddypress Sidebar', 'michigan' ),
			'id' => 'buddypress-sidebar',
			'description' => esc_html__( 'Buddypress Sidebar', 'michigan' ),
			'before_title' => '<h4 class="subtitle">',
			'after_title' => '</h4>',
		) );
	}

	if ( is_plugin_active( 'bbpress/bbpress.php' ) ) {
		register_sidebar( array(
			'name' => esc_html__( 'bbPress Sidebar', 'michigan' ),
			'id' => 'bbpress-sidebar',
			'description' => esc_html__( 'bbPress Sidebar', 'michigan' ),
			'before_title' => '<h4 class="subtitle">',
			'after_title' => '</h4>',
		) );
	}

	register_sidebar( array(
		'name' => esc_html__( 'Contact Sidebar', 'michigan' ),
		'id' => 'contact-sidebar',
		'description' => esc_html__( 'Contact Sidebar', 'michigan' ),
		'before_title' => '<h5 class="subtitle">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Custom Sidebar', 'michigan' ),
		'id' => 'custom-sidebar',
		'description' => esc_html__( 'Custom Sidebar', 'michigan' ),
		'before_title' => '<h5 class="subtitle">',
		'after_title' => '</h5>',
	) );

		register_sidebar(array(
		'name' => __( 'Course Sidebar', 'michigan' ),
		'id' => 'llms_course_widgets_side',
		'description' => __( 'Widgets in this area will be shown on posts with the post type of course.', 'michigan' ),
		'before_title' => '<h1>',
		'after_title' => '</h1>',
		));

		register_sidebar(array(
		'name' => __( 'Lesson Sidebar', 'michigan' ),
		'id' => 'llms_lesson_widgets_side',
		'description' => __( 'Widgets in this area will be shown on posts with the post type of course.', 'michigan' ),
		'before_title' => '<h1>',
		'after_title' => '</h1>',
		));

	if ( is_plugin_active( 'lifterlms/lifterlms.php' ) ) {
		register_sidebar( array(
			'name' => esc_html__( 'Membership Sidebar', 'michigan' ),
			'id' => 'membership-sidebar',
			'description' => esc_html__( 'Membership Sidebar', 'michigan' ),
			'before_title' => '<h4 class="subtitle">',
			'after_title' => '</h4>',
		) );
	}


}

//LifterLMS widgets
function course_llms_sidebar_function( $id ) {
	$course_sidebar_id = 'llms_course_widgets_side'; // replace this with your theme's sidebar ID
	return $course_sidebar_id;
}

function lesson_llms_sidebar_function( $id ) {
	$lesson_sidebar_id = 'llms_lesson_widgets_side'; // replace this with your theme's sidebar ID
	return $lesson_sidebar_id;
}

function lifterlms_llms_theme_support(){
	add_theme_support( 'lifterlms-sidebars' );
}


/****************************************/
/*		Woocommerce Direct Checkout
/****************************************/

function michigan_webnus_woocommerce_direct_checkout(){
    if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
          update_option('woocommerce_cart_redirect_after_add', 'no');
          update_option('woocommerce_enable_ajax_add_to_cart', 'no');
          add_filter('woocommerce_add_to_cart_redirect', 'michigan_webnus_add_to_cart_redirect');
    }else
      return;
}
function michigan_webnus_add_to_cart_redirect() {
    return get_permalink(get_option('woocommerce_checkout_page_id'));
}


/****************************/
/*    Enqueue Scripts
/***************************/


// Webnus Google Fonts
function michigan_webnus_google_fonts_url() {
	$michigan_webnus_options = michigan_webnus_options();
    $fonts_url     = '';
    $font_families  = array();
    $subsets    = 'latin,latin-ext';

    // Default typography
	if ( 'off' !== _x( 'on', 'Lora font: on or off', 'michigan' ) ) {
		$font_families[] = 'Lora:400,400italic,700';
	}
	if ( 'off' !== _x( 'on', 'Hind font: on or off', 'michigan' ) ) {
		$font_families[] = 'Hind:300,400,700';
	}
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'michigan' ) ) {
		$font_families[] = 'Montserrat:400,700';
	}
	if ( 'off' !== _x( 'on', 'PT Serif font: on or off', 'michigan' ) ) {
		$font_families[] = 'PT Serif:400,400italic,700,700italic';
	}

	if ($michigan_webnus_options['michigan_webnus_template_select'] == 'kids'){
		if ( 'off' !== _x( 'on', 'Asap font: on or off', 'michigan' ) ) {
			$font_families[] = 'Asap:400,700,400italic,700italic';
		}
		if ( 'off' !== _x( 'on', 'Life Savers font: on or off', 'michigan' ) ) {
			$font_families[] = 'Life Savers:400,700';
		}
		if ( 'off' !== _x( 'on', 'Gloria Hallelujah font: on or off', 'michigan' ) ) {
		$font_families[] = 'Gloria Hallelujah';
		}
	}

    if ( $font_families ) {
    $fonts_url = add_query_arg( array(
      'family' => urlencode( implode( '|', $font_families ) ),
      'subset' => urlencode( $subsets ),
    ), 'https://fonts.googleapis.com/css' );
  }

    return esc_url( $fonts_url );
}

function michigan_webnus_script_loader(){
	$michigan_webnus_options = michigan_webnus_options();
	$w_theme = wp_get_theme();
	$w_version = $w_theme->get('Version');

// main style
	$michigan_webnus_options['michigan_webnus_css_minifier'] = isset($michigan_webnus_options['michigan_webnus_css_minifier']) ? $michigan_webnus_options['michigan_webnus_css_minifier'] : '' ;
	$main_style_uri = ($michigan_webnus_options['michigan_webnus_css_minifier'])?get_template_directory_uri().'/css/master-min.php':get_template_directory_uri().'/css/master.css';
	wp_register_style( 'main-style', $main_style_uri,false,$w_version);
	wp_enqueue_style('main-style');

// dyncss
	wp_enqueue_style('webnus-dynamic-styles',get_template_directory_uri() . '/css/dyncss.css');
	wp_add_inline_style( 'webnus-dynamic-styles', $GLOBALS['michigan_webnus_dyncss']);

// google font
	wp_enqueue_style( 'webnus-google-fonts', michigan_webnus_google_fonts_url(), array(), null );

// Comment Reply JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

// Webnus JS
	wp_enqueue_script('doubletab', get_template_directory_uri() . '>/js/jquery.plugins.js', array( 'jquery' ), null, true);
	wp_enqueue_script('mediaelement', get_template_directory_uri() . '/js/mediaelement-and-player.min.js', array( 'jquery' ), null, true);
	if(!is_single())
		wp_enqueue_script('msaonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', array( 'jquery' ), null, true);
	wp_enqueue_script('custom_script', get_template_directory_uri() . '/js/webnus-custom.js', array( 'jquery' ), null, true);
// Woocommerce js error hack
	if (class_exists('Woocommerce')){
		global $post, $woocommerce;
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		if(file_exists($woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery.cookie'.$suffix.'.js')){
			rename($woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery.cookie'.$suffix.'.js', $woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery_cookie'.$suffix.'.js');
		}
		wp_deregister_script( 'jquery-cookie' );
		wp_register_script( 'jquery-cookie', $woocommerce->plugin_url() . '/assets/js/jquery-cookie/jquery_cookie'.$suffix.'.js', array( 'jquery' ), '1.3.1', true );
	}

// Sticky Menu
	$is_sticky = $michigan_webnus_options['michigan_webnus_header_sticky'];
	$scrolls_value = $michigan_webnus_options['michigan_webnus_header_sticky_scrolls'];
	$scrolls_value = !empty($scrolls_value)? $scrolls_value : 150;
	if( $is_sticky == '1' ){
       wp_localize_script('custom_script', 'scrolls_value', $scrolls_value);
	}
}

function michigan_webnus_api() {
	$michigan_webnus_options = michigan_webnus_options();
	$michigan_webnus_options['michigan_google_map_api'] =  isset( $michigan_webnus_options['michigan_google_map_api'] ) ? $michigan_webnus_options['michigan_google_map_api'] : '';
	$michigan_webnus_options['michigan_google_map_api_sign_in'] = isset( $michigan_webnus_options['michigan_google_map_api_sign_in'] ) ? $michigan_webnus_options['michigan_google_map_api_sign_in'] : '';
	// Google Map api
	$api_code 		= ( $michigan_webnus_options['michigan_google_map_api'] ) ? 'key=' . $michigan_webnus_options['michigan_google_map_api'] : '';
	$sign_in 		= ( $michigan_webnus_options['michigan_google_map_api_sign_in'] ) ? 'signed_in=true' : '';
	$init_query 	= ( $api_code || $sign_in ) ? '?' : '';
	$merge_query 	= $api_code ? '&' : '';
	wp_register_script( 'googlemap-api', 'https://maps.googleapis.com/maps/api/js' . $init_query . $api_code . $merge_query . $sign_in, array(), false, false );
	// youtube
	wp_register_script( 'youtube-api', get_template_directory_uri() . '/js/youtube-api.js', array(), false, false);

}

/****************************/
/*	Admin Enqueue Scripts
/****************************/

function michigan_webnus_admin_enqueue() {

	wp_enqueue_style( 'sweetalert', get_template_directory_uri() . '/css/sweetalert.min.css', array(), 'all' );

// Webnus Admin JS
	wp_enqueue_script( 'sweetalert', get_template_directory_uri() . '/js/sweetalert.min.js', array(), null, true );


	wp_enqueue_style( 'webnus-admin-style', get_template_directory_uri() .'/inc/webnus-admin-welcome/assets/css/webnus-admin.css', array(), 'all' );


// IconFonts Style
	wp_enqueue_style('iconfonts-style', get_template_directory_uri() . '/css/iconfonts.css', null, null);

// Visual Composer Features
	wp_enqueue_script( 'michigan-custom-scripts', get_template_directory_uri() . '/js/webnus-custom-admin.js', array( 'jquery' ), null, true );
}


/************************************************************/
/*	Add Page Background & Typekit & Header Area to Header
/************************************************************/

function michigan_webnus_page_background_override(){
	$wrap_color	= rwmb_meta( 'michigan_wrap_color_meta' );
	$bgcolor	= rwmb_meta( 'michigan_body_bg_color_meta' );
	$bgimages	= rwmb_meta( 'michigan_body_bg_img_meta' );
	$bgimage	= '';
	if ( $bgimages ) :
		foreach ( $bgimages as $bgimage ) :
			$bgimage = $bgimage['full_url'];
		endforeach;
	endif;
	$bgpercent	= rwmb_meta( 'michigan_body_bg_image_100_meta' );
	$bgrepeat	= rwmb_meta( 'michigan_body_bg_image_repeat_meta' );
		$out = "";
		$out .= '<style type="text/css" media="screen">body{ ';
		if(!empty($bgcolor)) {
			$out .= "background-image:url('');background-color:{$bgcolor};";
		}
		if(!empty($bgimage)) {
			if($bgrepeat == 1)
				$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat;";
			else if($bgrepeat==2)
				$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat-x;";
			else if($bgrepeat==3)
				$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat-y;";
			else if($bgrepeat==0) {
				if($bgpercent)
					$out .=  " background-image:url('{$bgimage}'); background-repeat:no-repeat; background-size:100% auto; ";
				else
					$out .=  " background-image:url('{$bgimage}'); background-repeat:no-repeat; ";
			}
		}
	if($bgpercent && !empty($bgimage)){
		$out .= 'background-size:cover; background-attachment:fixed; background-position:center;';
	}
	if($wrap_color){
		$out .= '} #wrap{background:'.$wrap_color.';';
		if ( $bgimage ) {
			$out .= 'background: none;';
		}
	}
	if ( !$wrap_color && $bgimage ) {
		$out .= '} #wrap{background: none;';
	}
	$out .= ' }</style>';
	echo $out;
}

function michigan_webnus_wphead_action(){
	$michigan_webnus_options = michigan_webnus_options();
	$michigan_webnus_options['michigan_webnus_background_image_style'] =  isset( $michigan_webnus_options['michigan_webnus_background_image_style'] ) ? $michigan_webnus_options['michigan_webnus_background_image_style'] : '';

	// Header Area
	echo $michigan_webnus_options['michigan_webnus_background_image_style'];
	echo $michigan_webnus_options['michigan_webnus_space_before_head'];

	// Page Background
	global $post;
	if(!is_404() && isset($post))
		michigan_webnus_page_background_override(); // referred to up

	// Typekit
	$w_adobe_typekit = ltrim ($michigan_webnus_options['michigan_webnus_typekit_id']);
    if(isset($w_adobe_typekit ) && !empty($w_adobe_typekit ))
        echo '<script src="//use.typekit.net/'.$w_adobe_typekit.'.js"></script><script>try{Typekit.load();}catch(e){}</script>';

}


/*******************************/
/*		Custom Admin Logo
/******************************/

function michigan_webnus_custom_login_logo() {
	$michigan_webnus_options = michigan_webnus_options();
	$michigan_webnus_options['michigan_webnus_admin_login_logo']['url'] = isset( $michigan_webnus_options['michigan_webnus_admin_login_logo']['url'] ) ? $michigan_webnus_options['michigan_webnus_admin_login_logo']['url'] : '' ;
    $logo = $michigan_webnus_options['michigan_webnus_admin_login_logo']['url'];
    if(isset($logo) && !empty($logo))
		echo '<style type="text/css">h1 a { background-image:url('.$logo.') !important; }</style>';
}


/*************************/
/*		Open Graph
**************************/

function michigan_webnus_my_excerpt($text, $excerpt){
    if ($excerpt) return $excerpt;
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }
    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}


function michigan_webnus_open_graph_tags() {
	if (is_single()) {
		global $post;
		if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$thumbnail_object = get_post($thumbnail_id);
			$image = $thumbnail_object->guid;
		} else {
			$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		$description = michigan_webnus_my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags($description);
		$description = str_replace("\"", "'", $description);
		?>
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?php echo esc_url($image); ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:description" content="<?php echo esc_attr($description); ?>" />
		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
		<?php
	}
}


/**************************/
/*		Post View
/**************************/

function michigan_webnus_setViews($postID) {
    $count_key = 'michigan_webnus_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count;
}
function michigan_webnus_getViews($postID) {
    $count_key = 'michigan_webnus_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
	}
    return $count;
}


/********************************/
/*   	Custom Functions
/********************************/

// Modal Booking
function michigan_webnus_modal_booking($id,$form_id,$title) {
	$michigan_webnus_options = michigan_webnus_options();
	$michigan_webnus_options['michigan_webnus_color_skin'] = isset($michigan_webnus_options['michigan_webnus_color_skin']) ? $michigan_webnus_options['michigan_webnus_color_skin'] : '' ;
	$colorskin_custom= ( $michigan_webnus_options['michigan_webnus_color_skin'] != 'e3e3e3' ) ? 'custom':'';
	$colorskin=( $colorskin_custom ) ? ' colorskin-' . $colorskin_custom . ' ' : '';
	$form_class=($michigan_webnus_options['michigan_webnus_template_select'])? ' '.$michigan_webnus_options['michigan_webnus_template_select'].'-t ':'';
	echo '<a class="booking-button inlinelb colorb" href="#w-book-'.$id.'" target="_self"><span class="media_label">'.__('REGISTER','michigan').'</span></a><div style="display:none"><div class="w-modal modal-book '.$colorskin.$form_class.'" id="w-book-'.$id.'"><h3 class="modal-title">'.__('Book for ','michigan').$title.'</h3>'.do_shortcode('[contact-form-7 id="'.$form_id.'" title="Booking"]').'</div></div>';
}

// Modal Donate
function michigan_webnus_modal_donate() {
	$michigan_webnus_options = michigan_webnus_options();
	GLOBAL $post;
	$michigan_webnus_options['michigan_webnus_color_skin'] = isset($michigan_webnus_options['michigan_webnus_color_skin']) ? $michigan_webnus_options['michigan_webnus_color_skin'] : '' ;
	$colorskin_custom= ( $michigan_webnus_options['michigan_webnus_color_skin'] != 'e3e3e3' ) ? 'custom':'';
	$colorskin=( $colorskin_custom ) ? ' colorskin-' . $colorskin_custom . ' ' : '';
	$class=($michigan_webnus_options['michigan_webnus_template_select'])? ' '.$michigan_webnus_options['michigan_webnus_template_select'].'-t ':'';
	return '<a class="donate-button inlinelb" href="#w-donate-'.get_the_ID().'" target="_self"><span class="media_label">'.esc_html__('DONATE NOW','michigan').'</span></a><div style="display:none"><div class="w-modal modal-donate '.$colorskin.$class.'" id="w-donate-'.get_the_ID().'"><h3 class="modal-title">'.esc_html__('Donate for ','michigan').get_the_title().'</h3>'.do_shortcode('[contact-form-7 id="'.$michigan_webnus_options['michigan_webnus_donate_form'].'" title="Donate"]').'</div></div>';
}

// MIMETYPE fonts
function michigan_webnus_custom_font_mimes ( $existing_mimes=array() ) {
	$existing_mimes['woff'] = 'application/x-font-woff';
	$existing_mimes['ttf'] = 'application/x-font-ttf';
	$existing_mimes['eot'] = 'application/vnd.ms-fontobject"';
	return $existing_mimes;
}

if(function_exists('the_ratings')) {
// WP Post Ratings Override plugin images, from plugin source
	add_action('wp_print_scripts', 'michigan_webnus_deregister_script', 100 );
	function michigan_webnus_deregister_script() {
		$postratings_max = intval(get_option('postratings_max'));
		$postratings_ajax_style = get_option('postratings_ajax_style');
		$postratings_custom = intval(get_option('postratings_customrating'));
		if($postratings_custom) {
			for($i = 1; $i <= $postratings_max; $i++) {
				$postratings_javascript .= 'var ratings_'.$i.'_mouseover_image=new Image();ratings_'.$i.'_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_'.$i.'_over."+ratingsL10n.image_ext;';
			}
		} else {
			$postratings_javascript = 'var ratings_mouseover_image=new Image();ratings_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_over."+ratingsL10n.image_ext;';
		}
		wp_dequeue_script( 'wp-postratings' );
		wp_enqueue_script('wp-postratings', plugins_url('wp-postratings/postratings-js.js'), array('jquery'), null, true);
		wp_localize_script('wp-postratings', 'ratingsL10n', array(
			'plugin_url' => get_template_directory_uri(),
			'ajax_url' => admin_url('admin-ajax.php'),
			'text_wait' => __('Please rate only 1 post at a time.', 'michigan'),
			'image' => get_option('postratings_image'),
			'image_ext' => 'gif',
			'max' => $postratings_max,
			'show_loading' => intval($postratings_ajax_style['loading']),
			'show_fading' => intval($postratings_ajax_style['fading']),
			'custom' => $postratings_custom,
			'l10n_print_after' => $postratings_javascript
		));
	}


// Fixing WP-Ratings plugin initial output, to match Design
	add_filter('expand_ratings_template', 'michigan_webnus_ratings_fix', 999, 1 );
	function michigan_webnus_ratings_fix($html) {
		$search = plugins_url( '/wp-postratings/images/stars/' );
		$replace = get_template_directory_uri() . '/images/stars/';
		$html = str_replace($search, $replace, $html);
		return $html;
	}
}

// count user in custom post type for advanced search
function michigan_webnus_count_user_posts_by_type( $userid, $post_type = 'post' ) {
	global $wpdb;
	$where = get_posts_by_author_sql( $post_type, true, $userid );
	$count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts $where" );
	return apply_filters( 'get_usernumposts', $count, $userid );
}

if(function_exists('vc_set_as_theme')){
	add_action('init','michigan_webnus_set_vc_as_theme');
	function michigan_webnus_set_vc_as_theme(){
		vc_set_as_theme($notifier = false);
	}
}

function michigan_webnus_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'michigan_webnus_content_width', 940 );
}

if(false){wp_link_pages(); posts_nav_link(); paginate_links(); the_tags();get_post_format(0);}



// Change Events post type title
function michigan_webnus_time_table_rename( $post_type, $args ) {
	if ( 'events' === $post_type ) {
		global $wp_post_types;
		$args->labels->menu_name = __( 'Timetable events', 'michigan' );
		$wp_post_types[ $post_type ] = $args;
	}
}


// Course Filter Query
function michigan_webnus_course_search_filter( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	// fixed: lifterlms default query
	if ( is_post_type_archive( 'course' ) ) :
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'DESC' );
	endif;
	if (  isset( $_GET['w-order-course'] ) || isset( $_GET['w-price-course'] ) ) {
		$course_order = isset( $_GET['w-order-course'] ) ? $_GET['w-order-course'] : '';
		$course_price = isset( $_GET['w-price-course'] ) ? $_GET['w-price-course'] : '';
		$orderby = $order = $meta_key = $order_meta_key = $price_meta_key = '';
		switch ( $course_order ) :
			case 'dateNewest':
				$orderby = 'date';
				$order = 'DESC';
			break;
			case 'dateOldest':
				$orderby = 'date';
				$order = 'ASC';
			break;
			case 'trending':
				$orderby = 'meta_value_num';
				$meta_key = 'michigan_webnus_views';
				$order = 'DESC';
			break;

			case 'topRated':
				$orderby = 'meta_value_num';
				$meta_key = 'ratings_average';
				$order = 'DESC';
			break;
			case 'titleAZ':
				$orderby = 'title';
				$order = 'ASC';
			break;
			case 'titleZA':
				$orderby = 'title';
				$order = 'DESC';
			break;
		endswitch;
		if ( $meta_key ) {
			$order_meta_key = array( 'key' => $meta_key );
		}

		if ( $course_price ) :
			if($course_order=='dateNewest' || $course_order == 'dateOldest' || $course_order == 'titleAZ' || $course_order == 'titleZA'){
				$orderby .= ' meta_value_num';
			} elseif ( $course_order == '' ) {
				$orderby = 'meta_value_num';
			}
			$order = 'DESC';
			if ( $course_order == 'dateOldest' || $course_order == 'titleAZ' ) {
				$order = 'ASC';
			}
			switch ( $course_price ) :
				case 'paidCourses':
					$meta_key = 'michigan_course_paid_meta';
				break;
				case 'freeCourses':
					$meta_key = 'michigan_course_free_meta';
				break;
			endswitch;
			$price_meta_key = array( 'key' => $meta_key );
		endif;
		// query
		$query->set( 'orderby', $orderby );
		$query->set( 'order', $order );
		if ( $meta_key ) :
			$meta_query_args = array(
				'relation'	=> 'AND',
				$order_meta_key,
				$price_meta_key
			);
			$query->set( 'meta_query', $meta_query_args );
		endif;
	}
}

// Course Filter Meta Data
function michigan_course_price_meta_data() {
	if( class_exists( 'LLMS_Product' ) ) {
		$post_id = get_the_ID();
		$argumants = array(
			'meta_key' => '_llms_product_id',
			'meta_value' => $post_id,
			'post_type' => 'llms_access_plan',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);
		$posts = get_posts($argumants);
		if( array_values( $posts ) ){
			for( $i=0; $i < count($posts); $i++) {
				if( get_post_meta($posts[$i]->ID, '_llms_is_free', true ) == 'yes' ){
					add_post_meta( get_the_ID(), 'michigan_course_free_meta', 'free', true ) or update_post_meta( get_the_ID(), 'michigan_course_free_meta', 'free' );
					delete_post_meta( get_the_ID(), 'michigan_course_paid_meta');
					break;
				}else{
					if( ! get_post_meta( get_the_ID(), 'michigan_course_free_meta', 'free', true ) ){
					add_post_meta( get_the_ID(), 'michigan_course_paid_meta', 'paid', true ) or update_post_meta( get_the_ID(), 'michigan_course_paid_meta', 'paid' );
					}
				}
			}

		}
	}
}


function michigan_set_default_meta_data($post_id){
    if ( $_GET['post_type'] = 'course' ) {
       michigan_course_price_meta_data();
    }
}

function add_theme_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );
    //Goals
	$admins->add_cap( 'publish_goals' );
    $admins->add_cap( 'edit_goals' );
    $admins->add_cap( 'edit_others_goals' );
    $admins->add_cap( 'delete_goals' );
    $admins->add_cap( 'delete_others_goals' );
    $admins->add_cap( 'read_private_goals' );
    $admins->add_cap( 'edit_goal' );
    $admins->add_cap( 'delete_goal' );
    $admins->add_cap( 'read_goal' );
	//Excursion
	$admins->add_cap( 'publish_excursions' );
    $admins->add_cap( 'edit_excursions' );
    $admins->add_cap( 'edit_others_excursions' );
    $admins->add_cap( 'delete_excursions' );
    $admins->add_cap( 'delete_others_excursions' );
    $admins->add_cap( 'read_private_excursions' );
    $admins->add_cap( 'edit_excursion' );
    $admins->add_cap( 'delete_excursion' );
    $admins->add_cap( 'read_excursion' );
	//FAQs
	$admins->add_cap( 'publish_faqs' );
    $admins->add_cap( 'edit_faqs' );
    $admins->add_cap( 'edit_others_faqs' );
    $admins->add_cap( 'delete_faqs' );
    $admins->add_cap( 'delete_others_faqs' );
    $admins->add_cap( 'read_private_faqs' );
    $admins->add_cap( 'edit_faq' );
    $admins->add_cap( 'delete_faq' );
    $admins->add_cap( 'read_faq' );
}