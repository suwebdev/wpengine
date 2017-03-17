<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset');?>">
<?php
$michigan_webnus_options = michigan_webnus_options();
// Responsive Meta
if($michigan_webnus_options['michigan_webnus_enable_responsive']){
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
} else {
	echo '<meta name="viewport" content="width=1200,user-scalable=yes">';
}
// Site Icon
if(!function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	$michigan_webnus_options['michigan_webnus_apple_iphone_icon']['url'] = isset( $michigan_webnus_options['michigan_webnus_apple_iphone_icon']['url'] ) ? $michigan_webnus_options['michigan_webnus_apple_iphone_icon']['url'] : '';
	$michigan_webnus_options['michigan_webnus_apple_ipad_icon']['url'] = isset( $michigan_webnus_options['michigan_webnus_apple_ipad_icon']['url'] ) ? $michigan_webnus_options['michigan_webnus_apple_ipad_icon']['url'] : '';
	$michigan_webnus_options['michigan_webnus_fav_icon']['url'] = isset( $michigan_webnus_options['michigan_webnus_fav_icon']['url'] ) ? $michigan_webnus_options['michigan_webnus_fav_icon']['url'] : '';
	echo($michigan_webnus_options['michigan_webnus_apple_iphone_icon']['url'])?'<link rel="apple-touch-icon-precomposed" href="'.esc_url($michigan_webnus_options['michigan_webnus_apple_iphone_icon']['url']).'">':'';
	echo($michigan_webnus_options['michigan_webnus_apple_ipad_icon']['url'])?'<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.esc_url($michigan_webnus_options['michigan_webnus_apple_ipad_icon']['url']).'">':'';
	echo($michigan_webnus_options['michigan_webnus_fav_icon']['url'])?'<link rel="shortcut icon" href="'.esc_url($michigan_webnus_options['michigan_webnus_fav_icon']['url']).'">':'<link rel="shortcut icon" href="'.esc_url(get_template_directory_uri()).'/images/favicon.ico">';
}

wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrap" class="<?php
$michigan_webnus_options['michigan_webnus_get_layout'] = isset( $michigan_webnus_options['michigan_webnus_get_layout'] ) ? : '' ;
echo(($michigan_webnus_options['michigan_webnus_header_menu_type'] != 6) && ($michigan_webnus_options['michigan_webnus_header_menu_type'] != 7))? $michigan_webnus_options['michigan_webnus_get_layout']:'';

// Colorskin class in wrap
$michigan_webnus_options['michigan_webnus_color_skin'] = isset( $michigan_webnus_options['michigan_webnus_color_skin'] ) ? $michigan_webnus_options['michigan_webnus_color_skin'] : '' ;
$colorskin = ( $michigan_webnus_options['michigan_webnus_color_skin'] != 'e3e3e3' )?' colorskin-custom ':'';
echo $colorskin;
// Template class in wrap
echo($michigan_webnus_options['michigan_webnus_template_select'])? ' '.$michigan_webnus_options['michigan_webnus_template_select'].'-t ':'';

// Menu type class in wrap
$menu_type = $michigan_webnus_options['michigan_webnus_header_menu_type'];
echo($menu_type == 0)? ' no-menu-header':'';
echo($menu_type == 6)? ' vertical-header-enabled':'';
echo($menu_type == 7)? ' vertical-toggle-header-enabled':'';

// Dark-submenu class in wrap
echo($michigan_webnus_options['michigan_webnus_dark_submenu'] == '1')? ' dark-submenu ':'';

// Boxed Layout
$background_layout	= isset( $michigan_webnus_options['michigan_webnus_background_layout'] ) ? $$michigan_webnus_options['michigan_webnus_background_layout'] : '';
$boxed_layout = ( ( $background_layout == 'boxed-wrap' ) && ( $header_menu_type != 6 ) && ( $header_menu_type != 7 ) ) ? $background_layout . ' ' : '';
echo $boxed_layout;
?>">

<?php if( $michigan_webnus_options['michigan_webnus_toggle_toparea_enable'] ){ ?>
<section class="toggle-top-area" >
<div class="w_toparea container">
	<div class="col-md-3"><?php if(is_active_sidebar('top-area-1')) dynamic_sidebar('top-area-1'); ?></div>
	<div class="col-md-3"><?php if(is_active_sidebar('top-area-2')) dynamic_sidebar('top-area-2'); ?></div>
	<div class="col-md-3"><?php if(is_active_sidebar('top-area-3')) dynamic_sidebar('top-area-3'); ?></div>
	<div class="col-md-3"><?php if(is_active_sidebar('top-area-4')) dynamic_sidebar('top-area-4'); ?></div>
</div>
<a class="w_toggle" href="#"></a>
</section>
<?php }	?>


<?php
$topbar_show = $header_show = true;
if(isset($post)){
	$topbar_show = rwmb_meta( 'michigan_topbar_show' );
	$header_show = rwmb_meta( 'michigan_header_show' );
}
$is_buddy = is_plugin_active('buddypress/bp-loader.php')?  !bp_is_blog_page() : '' ;
if ( $topbar_show || is_archive() || is_single() || is_home() || $is_buddy || is_search()) :
// Top Bar
 if($michigan_webnus_options['michigan_webnus_header_topbar_enable'])
	get_template_part('parts/topbar');
endif;

if ( $header_show || is_archive() || is_single() || is_home() || $is_buddy ) :

if($menu_type == 6 ){
	echo'<div id="vertical-header-wrapper">';
}

if($menu_type == 7){
	echo'<div id="vertical-header-wrapper">
	<div id="toggle-icon"><span class="mn-ext1"></span><span class="mn-ext2"></span><span class="mn-ext3"></span></div>
	<ul class="vertical-socials">';
	get_template_part('parts/social' );
	echo '</ul>';

}

if($menu_type == 6 OR $menu_type == 7 ){ // Vertical
	// Header Background
	$header_background = ($michigan_webnus_options['michigan_webnus_header_background']['url'])? 'style="background-size:cover; background-image: url(\''.$michigan_webnus_options['michigan_webnus_header_background'].'\')"':''; ?>
<header id="header" <?php echo $header_background; ?> class="res-menu vertical-w">
<div class="container vheader-container">
<?php }else{
	// Hide Header at start	(Horizontal Header)
	$hideheader = '';
	if( is_page()){
		$hideheader = rwmb_meta( 'michigan_hide_header_meta' );
	} ?>

<?php
if ( $menu_type == 12 ) {
	$fci_address = $michigan_webnus_options['michigan_webnus_header_address'];
	$fci_email = $michigan_webnus_options['michigan_webnus_header_email'];
	$fci_phone = $michigan_webnus_options['michigan_webnus_header_phone'];
	$components_header12= '
		<div class="container">
			<div class="components phones-components clearfix">
				<h6 class="col-sm-4"><i class="sl-location-pin colorf"></i><span>' . $fci_address . '</span>
				<h6 class="col-sm-4"><i class="sl-envelope-open colorf"></i><span>' . $fci_email . '</span>
				<h6 class="col-sm-4"><i class="sl-phone colorf"></i><span>' . $fci_phone . '</span>
			</div>
		</div>';
	} else {
		$components_header12= '';
	}
	echo $components_header12;
?>

<header id="header" class="res-menu horizontal-w <?php
// Header Class
	$michigan_webnus_options['michigan_webnus_header_color_type'] = isset( $michigan_webnus_options['michigan_webnus_header_color_type'] ) ? $michigan_webnus_options['michigan_webnus_header_color_type'] : '' ;
	echo ( $menu_type==9 ) 	? 'box-menu': '';
	echo ( $menu_type==8 ) 	? 'duplex-hd': '';
	echo ( $menu_type==10 ) ? ' w-header-type-10 ': '';
	echo ( $menu_type==11 ) ? ' colorful-header ': '';
	echo ( $menu_type==12 ) ? ' w-header-type-12' : '';
	echo ( $hideheader ) 	? ' hi-header ' : '';
	echo ' '.$michigan_webnus_options['michigan_webnus_header_color_type']
?>">
<div class="container">
<?php }



if($menu_type == 8){ ?>
<nav class="nav-wrap1 col-md-4 duplex-menu dm-left"><div class="container">
<?php if ( has_nav_menu('duplex-menu-left')){ wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new michigan_webnus_description_walker() ) );} ?>
</div></nav>
<?php }




// Logo Wrap & Alignment

if($menu_type==0){
	echo '<div class="col-md-12 logo-wrap center">';
}
if($menu_type == 1 OR $menu_type == 6 OR $menu_type == 7 OR $menu_type == 10 OR $menu_type == 11 OR $menu_type == 12 ){
	$background_logo = ($menu_type == 12) ? 'colorb' : '';
	echo '<div class="col-md-3 col-sm-3 logo-wrap '.$background_logo.'">';
}
if($menu_type==8){
	echo '<div class="col-md-4 logo-wrap center">';
}
$logo_alignment = $michigan_webnus_options['michigan_webnus_header_logo_alignment'];
if($menu_type == 2 OR $menu_type == 3 OR $menu_type == 4 OR $menu_type == 5 OR $menu_type == 9){
	echo($logo_alignment==1)?'<div class="col-md-3 logo-wrap">':'';
	echo($logo_alignment==2)?'<div class="col-md-3 cntmenu-leftside"></div><div class="col-md-6 logo-wrap center">':'';
	echo($logo_alignment==3)?'<div class="col-md-3 logo-wrap right">':'';
}

?>

<div class="logo">
<?php

// Header Logo
$logo = $logo_width = $trendy = '';
$logo = isset( $michigan_webnus_options['michigan_webnus_logo']['url'] ) ? $michigan_webnus_options['michigan_webnus_logo']['url'] : '';
$trendy = isset( $michigan_webnus_options['michigan_webnus_trendy_logo']['url'] ) ? $michigan_webnus_options['michigan_webnus_trendy_logo']['url'] : $logo;
$logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'logo_width' ) ? get_theme_mod( 'logo_width' ) : $michigan_webnus_options['michigan_webnus_logo_width'] ) );
$w_logo_width = ($logo_width)?'width="'.$logo_width.'"':'';
$logo = ($menu_type == 12) ? $trendy : $logo;
echo($logo)?'<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" alt="logo" '.$w_logo_width.' class="img-logo-w1"></a>':'';



// Transparent Logo
$transparent_logo = $logo;
$transparent_logo_width = $logo_width;
$transparent_logo =  isset( $michigan_webnus_options['michigan_webnus_transparent_logo']['url'] ) ? $michigan_webnus_options['michigan_webnus_transparent_logo']['url'] : '';
$michigan_webnus_options['michigan_webnus_transparent_logo_width'] = isset( $michigan_webnus_options['michigan_webnus_transparent_logo_width'] ) ? $michigan_webnus_options['michigan_webnus_transparent_logo_width'] : '';
$transparent_logo_width = preg_replace('#[^0-9]#','',strip_tags( $michigan_webnus_options['michigan_webnus_transparent_logo_width'] ));
$w_transparent_logo_width = ($transparent_logo_width)?'width="'.$transparent_logo_width.'"':'';
$transparent_logo = ($menu_type == 12)? $trendy: $transparent_logo;
echo($transparent_logo)?'<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($transparent_logo).'" alt="logo" '.$w_transparent_logo_width.' class="img-logo-w2"></a>':'';

// Sticky Logo
$sticky_logo = $logo;
$sticky_logo_width = $logo_width;
$sticky_logo = isset ($michigan_webnus_options['michigan_webnus_sticky_logo']['url']) ? $michigan_webnus_options['michigan_webnus_sticky_logo']['url'] : '';
$sticky_logo_width = preg_replace('#[^0-9]#','',strip_tags( get_theme_mod( 'sticky_logo_width' ) ? get_theme_mod( 'sticky_logo_width' ) : $michigan_webnus_options['michigan_webnus_sticky_logo_width'] ) );
echo($sticky_logo)?'<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($sticky_logo).'" alt="logo" width="'.$sticky_logo_width.'" class="img-logo-w3"></a></span>':'';



// Site Title
if (empty($logo)){
	$slogan = $michigan_webnus_options['michigan_webnus_slogan'];
	$w_slogan =($slogan)? esc_html($slogan):bloginfo('description');
?>
<h1 id="site-title"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a><span class="site-slog"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php echo $w_slogan; ?></a></span></h1>
<?php } ?>

</div></div>


<?php  // Logo Right Side (For Header Type 2)
if($menu_type == 2 OR $menu_type == 3 OR $menu_type == 4 OR $menu_type == 5 OR $menu_type == 9){

$side_alignment ='';
if($logo_alignment==1){
	$side_alignment='col-md-9 alignright ';
}elseif($logo_alignment==2){
	$side_alignment='col-md-3 right-side ';
}elseif($logo_alignment==3){
	$side_alignment='col-md-9 left-side ';
}
echo '<div class="'.$side_alignment.'">';
$logo_rightside = $michigan_webnus_options['michigan_webnus_header_logo_rightside'];
if($logo_rightside==1){ ?>
	<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
	<input name="s" type="text" placeholder="<?php esc_html_e('Search...','michigan') ?>" class="header-saerch" >
	</form>
<?php } elseif($logo_rightside==2){?>
	<h6><i class="fa-envelope-o"></i> <?php echo esc_html($michigan_webnus_options['michigan_webnus_header_email']); ?></h6>
	<h6><i class="fa-phone"></i> <?php echo esc_html($michigan_webnus_options['michigan_webnus_header_phone']); ?></h6>
<?php }elseif($logo_rightside==3){
	if(is_active_sidebar('header-advert')) dynamic_sidebar('header-advert');
	if ( class_exists( 'WooCommerce' ) && $michigan_webnus_options['michigan_webnus_header_woocart_enable'] ) {
		the_widget( 'Woocommerce_Header_Cart' );
	}
}
echo'</div></div>';
} ?>




<?php if($menu_type == 8){ //Duplex ?>
<nav class="nav-wrap1 col-md-4 duplex-menu dm-right"><div class="container">
<?php if ( has_nav_menu('duplex-menu-right' )){ wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new michigan_webnus_description_walker() ) ); } ?>
</div></nav>
<?php } ?>


<?php // Nav Wrap Class
$nav_class ='';
$menu_alignment ='';
if($logo_alignment==2){
	$menu_alignment='center ';
}elseif($logo_alignment==3){
	$menu_alignment='left ';
}

if($menu_type == 1 OR $menu_type == 10 OR $menu_type == 11 OR $menu_type == 12 ){
	$nav_class = 'nav-wrap1 col-md-9 col-sm-9 ';
}
if($menu_type == 2){
	$nav_class = 'nav-wrap2 mn4 '.$menu_alignment;
}
if($menu_type == 3){
	$nav_class = 'nav-wrap2 mn4 darknavi '.$menu_alignment;
}
if($menu_type == 4){
	$nav_class = 'nav-wrap2 '.$menu_alignment;
}
if($menu_type == 5){
	$nav_class = 'nav-wrap2 darknavi '.$menu_alignment;
}
if($menu_type == 6 OR $menu_type == 7){
	$nav_class = 'nav-wrap3 col-md-9 col-sm-9 ';
}
if($menu_type == 8){
	$nav_class = 'full-menu-duplex ';
}
if($menu_type == 9){
	$nav_class = 'nav-wrap2 mn4 '.$menu_alignment;
}

if($menu_type == 2 OR $menu_type == 3 OR $menu_type == 4 OR $menu_type == 5 OR $menu_type == 9){
	echo'<div class="clearfix"></div>';
}


if ( $menu_type == 12 ) {
	$fci_address = $michigan_webnus_options['michigan_webnus_header_address'];
	$fci_email = $michigan_webnus_options['michigan_webnus_header_email'];
	$fci_phone = $michigan_webnus_options['michigan_webnus_header_phone'];
	$components_header12= '
		<div class="components clearfix">
			<h6><i class="sl-location-pin colorf"></i><span>' . $fci_address . '</span>
			<h6><i class="sl-envelope-open colorf"></i><span>' . $fci_email . '</span>
			<h6><i class="sl-phone colorf"></i><span>' . $fci_phone . '</span>
		</div>';
	} else {
		$components_header12= '';
	}

echo '<nav id="nav-wrap" class="'.$nav_class.'"><div class="container"> ' . $components_header12 . '';


if($menu_type == 1 OR $menu_type == 10 OR $menu_type == 11 OR $menu_type == 12){ //Classic

// Woo Sidebar
	if(is_active_sidebar('woocommerce_header')) {
		dynamic_sidebar('woocommerce_header');
	}

// Search in Header
	if($michigan_webnus_options['michigan_webnus_header_search_enable']){?>
		<div id="search-form"><a href="javascript:void(0)" class="search-form-icon"><i id="searchbox-icon" class="fa-search"></i></a><div id="search-form-box" class="search-form-box"><form action="<?php echo esc_url(home_url( '/' )); ?>" method="get"><input type="text" class="search-text-box" id="search-box" name="s"></form></div></div>
<?php }

// Button in Header
	$michigan_webnus_options['michigan_webnus_header_button_enable'] = isset($michigan_webnus_options['michigan_webnus_header_button_enable']) ? $michigan_webnus_options['michigan_webnus_header_button_enable'] : '' ;
	if($michigan_webnus_options['michigan_webnus_header_button_enable'] && $menu_type != 11 ){?>
		<a href="<?php echo $michigan_webnus_options['michigan_webnus_header_button_url'];?>" class="header-button hcolorr hcolorb"><?php echo $michigan_webnus_options['michigan_webnus_header_button_label'];?></a>
<?php }


}

// Page Menu
$menu_location = $onepage_menu = '';
if(is_page()){
	$onepage_menu = rwmb_meta( 'michigan_onepage_menu_meta' );
}
if($menu_type==0){
	$menu_location = '';
}
elseif($menu_type==8){
	echo '<nav id="nav-wrap" class="full-menu-duplex"><div class="container"><ul id="nav" class="main-menu">';
	if ( has_nav_menu( 'duplex-menu-left' ) ) {
		wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new michigan_webnus_description_walker() ) );}
	if ( has_nav_menu( 'duplex-menu-right' ) ) {
		wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new michigan_webnus_description_walker() ) );}
	echo '</ul></div></nav>';
}else{
	if($onepage_menu && has_nav_menu('onepage-header-menu' )) {
		$menu_location = 'onepage-header-menu';
	 }elseif( has_nav_menu( 'header-menu' ) ){
		$menu_location = 'header-menu';
	}
}
	if ( has_nav_menu( $menu_location ) ) {
		wp_nav_menu( array( 'theme_location' => $menu_location, 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new michigan_webnus_description_walker() ) );
	}
?>

</div>
</nav>

<?php if($menu_type == 2 OR $menu_type == 3 OR $menu_type == 4 OR $menu_type == 5 OR $menu_type == 9){
	echo'<div class="container">';
}



if($menu_type == 1 OR $menu_type == 10){
	echo'<div class="clearfix"></div>';
}

 if($menu_type == 6 OR $menu_type == 7){ //Vertical

// Search in Header
	if($michigan_webnus_options['michigan_webnus_header_search_enable']){?>
	<div id="search-form">
		<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
			<input type="text" class="search-text-box" id="search-box" name="s">
		</form>
	</div>
<?php }

// Social  ?>
	<div class="socials-wrapper">
		<ul class="socials"><?php get_template_part('parts/social' ); ?></ul>
	</div>



	</div>
<?php } ?>


<?php
// Header Bottom
 if($michigan_webnus_options['michigan_webnus_header_bottom'] && $menu_type == 10)
	get_template_part('parts/header-bottom');
?>
</div>
</header>
<!-- end-header -->

<?php endif;  // End Header

// Modal Contact Form
$form_id=esc_html($michigan_webnus_options['michigan_webnus_topbar_form']);
$michigan_webnus_options['michigan_webnus_color_skin'] = isset($michigan_webnus_options['michigan_webnus_color_skin']) ? $michigan_webnus_options['michigan_webnus_color_skin'] : '' ;
if (get_theme_mod( 'enable_custom_colorskin' )){
	$colorskin = 'custom';

}elseif($michigan_webnus_options['michigan_webnus_color_skin'] == 'e3e3e3'){
	$colorskin = '';
}else{
	$colorskin = 'custom';
}
$colorskin=( $colorskin ) ? ' colorskin-' . $colorskin . ' ' : '';
$form_class=($michigan_webnus_options['michigan_webnus_template_select'])? ' '.$michigan_webnus_options['michigan_webnus_template_select'].'-t ':'';
echo '<div style="display:none"><div class="w-modal modal-contact'.$colorskin.$form_class.'" id="w-contact"><h3 class="modal-title">'.esc_html__('CONTACT','michigan').'</h3><br>'.do_shortcode('[contact-form-7 id="'.$form_id.'" title="Contact"]').'</div></div>';

// woocommerce headline
if(isset($post) && get_post_type( $post->ID )=='product'){
	if(is_product() && $michigan_webnus_options['michigan_webnus_woo_product_title_enable']){
		echo '<section id="headline"><div class="container"><h2>'.esc_html($michigan_webnus_options['michigan_webnus_woo_product_title']).'</h2></div></section>';
	}elseif((!is_product()) && $michigan_webnus_options['michigan_webnus_woo_shop_title_enable']){
		echo '<section id="headline"><div class="container"><h2>'.esc_html($michigan_webnus_options['michigan_webnus_woo_shop_title']).'</h2></div></section>';
	}
	echo '<section class="container" ><hr class="vertical-space">';
} ?>