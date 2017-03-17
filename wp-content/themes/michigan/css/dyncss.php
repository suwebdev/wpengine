<?php
ob_start();
$thm_options = get_option('michigan_webnus_options');


/*
 * Body style
*/
if (!empty($thm_options['michigan_webnus_background_pattern']) && ($thm_options['michigan_webnus_background_pattern'] != 'none')) {
    echo "body{background-image:url('{$thm_options['michigan_webnus_background_pattern']}') !important; background-repeat:repeat;} ";
}
$thm_options['michigan_webnus_wide_screen'] = isset( $thm_options['michigan_webnus_wide_screen'] ) ? $thm_options['michigan_webnus_wide_screen'] : '' ;
if ($thm_options['michigan_webnus_wide_screen'] == '1'){
    echo"
    @media only screen and (min-width: 1361px) {
    .container {width: 96%;}
    }
  ";
}

/*
 * Header Style
*/
if(!empty($thm_options['michigan_webnus_container_width']))
{
    $w_value = trim ($thm_options['michigan_webnus_container_width']);
    if($w_value){
        if(substr($w_value,-2,2)!="px"){$w_value.='px';};
        echo esc_attr( "#wrap .container {max-width:{$w_value};}\n\n" );
    }
}

if(!empty($thm_options['michigan_webnus_header_padding_top']))
{
    $w_value = trim ($thm_options['michigan_webnus_header_padding_top']);
    if($w_value){
        if(substr($w_value,-2,2)!="px"){$w_value.='px';};
        echo esc_attr( "#header {padding-top:{$w_value};}\n\n" );
    }
}

if(!empty($thm_options['michigan_webnus_header_padding_bottom']))
{
    $w_value = trim ($thm_options['michigan_webnus_header_padding_bottom']);
    if($w_value){
        if(substr($w_value,-2,2)!="px"){$w_value.='px';};
        echo esc_attr( "#header {padding-bottom:{$w_value};}\n\n" );
    }
}

/*
 * Custom Fonts For P,H Tags
*/
$w_custom_font1_src = $w_custom_font2_src = $w_custom_font3_src ='';

//custom-font-1 font-face

  if( isset($thm_options['michigan_webnus_custom_font1_eot']) && $thm_options['michigan_webnus_custom_font1_eot']['url'] )
    $w_custom_font1_src[] = "url('{$thm_options['michigan_webnus_custom_font1_eot']['url']}?#iefix') format('embedded-opentype')";
  if( isset($thm_options['michigan_webnus_custom_font1_woff']) && $thm_options['michigan_webnus_custom_font1_woff']['url'] )
    $w_custom_font1_src[] = "url('{$thm_options['michigan_webnus_custom_font1_woff']['url']}') format('woff')";
  if( isset($thm_options['michigan_webnus_custom_font1_ttf']) && $thm_options['michigan_webnus_custom_font1_woff']['url'] )
    $w_custom_font1_src[] = "url('{$thm_options['michigan_webnus_custom_font1_ttf']['url']}') format('truetype')";

if($w_custom_font1_src !='')
{
  $w_custom_font1_src= implode(",\n",$w_custom_font1_src);
  echo "@font-face {
  font-family: 'custom-font-1';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font1_src};\n}\n";
}

//custom-font-2 font-face

  if( isset($thm_options['michigan_webnus_custom_font2_eot']) && $thm_options['michigan_webnus_custom_font2_eot']['url'] )
    $w_custom_font2_src[] = "url('{$thm_options['michigan_webnus_custom_font2_eot']['url']}?#iefix') format('embedded-opentype')";
  if( isset($thm_options['michigan_webnus_custom_font2_woff']) && $thm_options['michigan_webnus_custom_font2_woff']['url'] )
    $w_custom_font2_src[] = "url('{$thm_options['michigan_webnus_custom_font2_woff']['url']}') format('woff')";
  if( isset($thm_options['michigan_webnus_custom_font2_ttf']) && $thm_options['michigan_webnus_custom_font2_ttf']['url'] )
    $w_custom_font2_src[] = "url('{$thm_options['michigan_webnus_custom_font2_ttf']['url']}') format('truetype')";

if($w_custom_font2_src !='')
{
  $w_custom_font2_src= implode(",\n",$w_custom_font2_src);
  echo "@font-face {
  font-family: 'custom-font-2';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font2_src};\n}\n";
}

//custom-font-3 font-face

  if( isset($thm_options['michigan_webnus_custom_font3_eot']) && $thm_options['michigan_webnus_custom_font2_eot']['url'] )
    $w_custom_font3_src[] = "url('{$thm_options['michigan_webnus_custom_font3_eot']['url']}?#iefix') format('embedded-opentype')";
  if( isset($thm_options['michigan_webnus_custom_font3_woff']) && $thm_options['michigan_webnus_custom_font3_woff']['url'] )
    $w_custom_font3_src[] = "url('{$thm_options['michigan_webnus_custom_font3_woff']['url']}') format('woff')";
  if( isset($thm_options['michigan_webnus_custom_font3_ttf']) && $thm_options['michigan_webnus_custom_font3_ttf']['url'] )
    $w_custom_font3_src[] = "url('{$thm_options['michigan_webnus_custom_font3_ttf']['url']}') format('truetype')";

if($w_custom_font3_src !='')
{
  $w_custom_font3_src= implode(",\n",$w_custom_font3_src);
  echo "@font-face {
  font-family: 'custom-font-3';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font3_src};\n}\n";
}

// body-font select
if(isset($thm_options['body-typography']['font-family']) && $thm_options['body-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['body-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['body-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['body-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['body-typography']['font-family'];
    }
    echo "body { font-family: {$font_family} !important;}\n";
}


// p-font select
if(isset($thm_options['p-typography']['font-family']) && $thm_options['p-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['p-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['p-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['p-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['p-typography']['font-family'];
    }
    echo "#wrap p { font-family: {$font_family} !important;}\n";
}


// heading-font select
if(isset($thm_options['all-h-typography']['font-family']) && $thm_options['all-h-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['all-h-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['all-h-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['all-h-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['all-h-typography']['font-family'];
    }
    echo "#wrap h1, #wrap h2, #wrap h3, #wrap h4, #wrap h5, #wrap h6 { font-family: {$font_family} !important;}\n";
}


if(isset($thm_options['h1-typography']['font-family']) && $thm_options['h1-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['h1-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['h1-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['h1-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['h1-typography']['font-family'];
    }
    echo "#wrap h1 { font-family: {$font_family} !important;}\n";
}


if(isset($thm_options['h2-typography']['font-family']) && $thm_options['h2-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['h2-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['h2-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['h2-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['h2-typography']['font-family'];
    }
    echo "#wrap h2 { font-family: {$font_family} !important;}\n";
}


if(isset($thm_options['h3-typography']['font-family']) && $thm_options['h3-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['h3-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['h3-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['h3-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['h3-typography']['font-family'];
    }
    echo "#wrap h3 { font-family: {$font_family} !important;}\n";
}


if(isset($thm_options['h4-typography']['font-family']) && $thm_options['h4-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['h4-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['h4-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['h4-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['h4-typography']['font-family'];
    }
    echo "#wrap h4 { font-family: {$font_family} !important;}\n";
}


if(isset($thm_options['h5-typography']['font-family']) && $thm_options['h5-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['h5-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['h5-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['h5-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['h5-typography']['font-family'];
    }
    echo "#wrap h5 { font-family: {$font_family} !important;}\n";
}


if(isset($thm_options['h6-typography']['font-family']) && $thm_options['h6-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['h6-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['h6-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['h6-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['h6-typography']['font-family'];
    }
    echo "#wrap h6 { font-family: {$font_family} !important;}\n";
}



// menu-font select
if(isset($thm_options['menu-typography']['font-family']) && $thm_options['menu-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['menu-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['menu-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['menu-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['menu-typography']['font-family'];
    }
    echo "#wrap ul#nav * { font-family: {$font_family} !important;}\n";
}

// sub-menu-font select
if(isset($thm_options['sub-menu-typography']['font-family']) && $thm_options['sub-menu-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['sub-menu-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['sub-menu-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['sub-menu-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['sub-menu-typography']['font-family'];
    }
    echo "#nav ul li a { font-family: {$font_family} !important;}\n";
}


// blog-title-font select
if(isset($thm_options['post-title-typography']['font-family']) && $thm_options['post-title-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['post-title-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['post-title-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['post-title-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['post-title-typography']['font-family'];
    }
    echo ".blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1 { font-family: {$font_family} !important;}\n";
}


// single-blog-title-font select
if(isset($thm_options['single-post-title-typography']['font-family']) && $thm_options['single-post-title-typography']['font-family']!=''){
    $font_family= '';
    if ($thm_options['single-post-title-typography']['font-family'] == 'typekit-font-1'){
        $font_family = $thm_options['michigan_webnus_typekit_font1'];
    }elseif ($thm_options['single-post-title-typography']['font-family'] == 'typekit-font-2'){
        $font_family = $thm_options['michigan_webnus_typekit_font2'];
    }elseif ($thm_options['single-post-title-typography']['font-family'] == 'typekit-font-3'){
        $font_family = $thm_options['michigan_webnus_typekit_font3'];
    }else{
        $font_family = $thm_options['single-post-title-typography']['font-family'];
    }
    echo ".blog-single-post h1 { font-family: {$font_family} !important;}\n";
}

/* footer background image */
$footer_background_image = $thm_options['michigan_webnus_footer_background_image']['url'];

if(!empty($footer_background_image))
	echo "#wrap #footer { background-image: url('$footer_background_image'); background-size: cover;}\n";

/* == Menu Colors ------------------ */

if(isset($thm_options['michigan_webnus_menu_link_color']))
    echo "#wrap #header #nav > li > a { color:{$thm_options['michigan_webnus_menu_link_color']['regular']};}\n\n";

if(isset($thm_options['michigan_webnus_menu_link_color']))
    echo "#wrap #header #nav > li > a:hover,.transparent-header-w.t-dark-w #header.horizontal-w.duplex-hd #wrap #header #nav > li:hover > a,
        .transparent-header-w #header.horizontal-w #wrap #header #nav > li:hover > a {color:{$thm_options['michigan_webnus_menu_link_color']['hover']};}\n\n";
if(isset($thm_options['michigan_webnus_menu_link_color']))
    echo "#wrap #header #nav > li.current > a, #wrapv #header #nav li.current ul li a:hover, #wrap #header #nav > li.active > a {color:{$thm_options['michigan_webnus_menu_link_color']['active']};}\n\n";


/* scroll to top */

if(isset($thm_options['michigan_webnus_scroll_to_top_hover_background_color']) && $thm_options['michigan_webnus_scroll_to_top_hover_background_color']!='')
{
    echo esc_attr( "#wrap #scroll-top a {background-color:{$thm_options['michigan_webnus_scroll_to_top_hover_background_color']['regular']};}\n" );
    echo esc_attr( "#wrap #scroll-top a:hover {background-color:{$thm_options['michigan_webnus_scroll_to_top_hover_background_color']['hover']};}\n" );
}


/* twitter background image */
$twitter_background_image = $thm_options['michigan_webnus_footer_twitter_background_image']['url'];

if(!empty($twitter_background_image))
	echo "#wrap .wrap-tweets-carousel { background-image: url('$twitter_background_image'); background-size: cover;}\n";

if ( $thm_options['michigan_webnus_color_skin'] != 'e3e3e3' || $thm_options['michigan_webnus_custom_color_skin'] ) {

  $color_custom    = ( $thm_options['michigan_webnus_custom_color_skin'] ) ? $thm_options['michigan_webnus_custom_color_skin'] : '' ;
  $color_predefined = ( $thm_options['michigan_webnus_color_skin'] != 'e3e3e3' ) ? $thm_options['michigan_webnus_color_skin'] : '' ;
  $color = ( $thm_options['michigan_webnus_custom_color_skin'] ) ? $color_custom : '#'.$color_predefined ;


	$webnus_colorskin_rgba = str_replace("#", "", $color);
	if(strlen($webnus_colorskin_rgba) == 3) {
		$r = hexdec(substr($webnus_colorskin_rgba,0,1).substr($webnus_colorskin_rgba,0,1));
		$g = hexdec(substr($webnus_colorskin_rgba,1,1).substr($webnus_colorskin_rgba,1,1));
		$b = hexdec(substr($webnus_colorskin_rgba,2,1).substr($webnus_colorskin_rgba,2,1));
	} else {
		$r = hexdec(substr($webnus_colorskin_rgba,0,2));
		$g = hexdec(substr($webnus_colorskin_rgba,2,2));
		$b = hexdec(substr($webnus_colorskin_rgba,4,2));
	}
 ?>
	/* == TextColors
	---------------- */
	#wrap.colorskin-custom .course-content .products li a.add_to_cart_button,.colorskin-custom .llms-notice a,.colorskin-custom .llms-checkout-section a,#wrap.colorskin-custom .wn-course-progress a:hover,.colorskin-custom .llms-access-plan-footer .llms-button-action.button,.colorskin-custom .llms-access-plan-restrictions ul li a,.colorskin-custom .w-single-event-phone:before,.colorskin-custom .courses-grid article .mc-content h5 a:hover,.colorskin-custom .courses-grid article .mc-price,.colorskin-custom .testimonials-slider-w.ts-penta .testimonial-content h4 q:before,.colorskin-custom .icon-box10:hover h4,.colorskin-custom .icon-box9 h4,.colorskin-custom .icon-box8 i,.colorskin-custom ul.check2 li:before,.colorskin-custom  li.check2:before,.colorskin-custom .cer-online2 .student-name,#wrap.colorskin-custom ul.check li:before, #wrap.colorskin-custom li.check:before,.transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w #nav>li:hover>a,.transparent-header-w.t-dark-w .colorskin-custom #header.horizontal-w #nav>li.current>a,.colorskin-custom .widget.buddypress div.item-options a ,.colorskin-custom #buddypress a,.colorskin-custom #buddypress a:visited,.colorskin-custom span.bbp-breadcrumb-sep , .colorskin-custom .bbp-body a,.colorskin-custom .bbp-body a:visited , .colorskin-custom .bbp-single-topic-meta a , .colorskin-custom .blog-post a:hover,.colorskin-custom .blog-author span,.colorskin-custom .blog-line p a:hover , .colorskin-custom h6.blog-date a:hover,.colorskin-custom h6.blog-cat a:hover,.colorskin-custom h6.blog-author a:hover , .colorskin-custom .blog-line:hover h4 a , .colorskin-custom a.readmore , .colorskin-custom #commentform input[type="submit"] , .colorskin-custom .blgtyp1 .au-avatar-box h6:after , .colorskin-custom .w-next-article:hover a:before,.colorskin-custom .w-prev-article:hover a:before,.colorskin-custom .w-next-article a:after,.colorskin-custom .w-prev-article a:after , .colorskin-custom .w-next-article:hover a, .w-prev-article:hover a , .colorskin-custom .single-event .event-tag, .colorskin-custom .date-box:hover h3 , .colorskin-custom .faq-toggle .acc-trigger a:before , .colorskin-custom .button.bordered-bot.theme-skin , .colorskin-custom .button.bordered-bot.gold , .colorskin-custom .w-table a:hover , .colorskin-custom .courses-grid article .mc-content h6 a:hover , .colorskin-custom .modern-cat:hover a, .modern-cat:hover i , .colorskin-custom .modern-grid .llms-title a:hover , .colorskin-custom .modern-grid .llms-price-wrapper .llms-price , .colorskin-custom .course-list-content h5 a:hover , .colorskin-custom .w-course-list .course-list-price , .colorskin-custom .w-course-list .course-list-meta i , #wrap.colorskin-custom .um-icon-android-checkbox-outline , #wrap.colorskin-custom .wpb_accordion .wpb_accordion_wrapper .ui-state-active a, #wrap.colorskin-custom .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover , .colorskin-custom .testimonials-slider-w.ts-hexa .testimonial-content h4 q:before ,.colorskin-custom .testimonials-slider-w.ts-hexa .testimonial-content h4 q:after, #wrap.colorskin-custom .testimonials-slider-w.ts-hexa .w-crsl .owl-buttons div:after , #wrap.colorskin-custom .crsl .owl-buttons .owl-prev , #wrap.colorskin-custom .crsl .owl-buttons .owl-next , .colorskin-custom .contact-info i , .colorskin-custom ul.check li:before, li.check:before , .colorskin-custom .acc-trigger a:hover,.colorskin-custom .acc-trigger.active a,.colorskin-custom .acc-trigger.active a:hover , .colorskin-custom .w-pricing-table1 .plan-title , .colorskin-custom .w-pricing-table2 .plan-price , .colorskin-custom .w-pricing-table2 .price-footer a.readmore , .colorskin-custom .events-clean .event-article:hover .event-title , .colorskin-custom .events-minimal .event-date , .colorskin-custom .events-minimal a.magicmore:hover , .colorskin-custom .a-course h4 a:hover , .colorskin-custom .teaser-box2 .teaser-subtitle , .colorskin-custom .teaser-box7:hover h4 , .colorskin-custom .latestnews2 .ln-item .ln-content .ln-button:hover , .colorskin-custom .latestposts-one .latest-title a:hover , .colorskin-custom .latestposts-two .blog-line p.blog-cat a , .colorskin-custom .latestposts-two .blog-line:hover h4 a , .colorskin-custom .latestposts-three h3.latest-b2-title a:hover , .colorskin-custom .latestposts-three h6.latest-b2-cat a, .latestposts-three .latest-b2-metad2 span a:hover, .colorskin-custom .latestposts-six .latest-title a:hover , .colorskin-custom .latestposts-six .latest-author a:hover , .colorskin-custom .latestposts-seven .wrap-date-icons h3.latest-date , .colorskin-custom .latestposts-seven .latest-content .latest-title a:hover , .colorskin-custom .latestposts-seven .latest-content .latest-author a , .colorskin-custom .latestposts-seven .latest-content .latest-cat a:hover , .colorskin-custom .tribe-events-list-separator-month span , .colorskin-custom .tribe-events-list .type-tribe_events h2 a:hover , .single-tribe_events .colorskin-custom .w-event-meta dd a:hover , #wrap.colorskin-custom #tribe-events .tribe-events-button , .single-tribe_events .colorskin-custom .w-single-event-organizer i,.single-tribe_events .colorskin-custom .w-tribe-events-meta-date i, .colorskin-custom .w-single-event-date:before,.colorskin-custom .w-single-event-time:before,.colorskin-custom .w-single-event-location:before,.colorskin-custom .w-single-event-category:before,.colorskin-custom .w-tribe-event-cost:before,.colorskin-custom .w-tribe-event-website:before, .colorskin-custom .tribe-events-list-separator-month span , .colorskin-custom #tribe-events-content-wrapper .tribe-events-sub-nav a , .colorskin-custom .events-grid .event-article .event-title:hover , .colorskin-custom .events-grid2 .event-article .event-title:hover , .colorskin-custom .goals .goal-content .goal-title:hover , .colorskin-custom .goals .goal-content .donate-button , .colorskin-custom .goals .goal-progress .vc_pie_chart_value, .colorskin-custom .blox .widget_search input[type="submit"]#searchsubmit.btn, .max-hero .widget_search input[type="submit"]#searchsubmit.btn  , .colorskin-custom .course-main .w-category a ,.colorskin-custom .course-main .course-postmeta span, #wrap.colorskin-custom .course-content .llms-button , .colorskin-custom .course-content .container .llms-message a , .colorskin-custom .button#llms_review_submit_button , .colorskin-custom .llms-lesson-preview.is-complete .llms-lesson-link,.colorskin-custom .llms-lesson-preview .llms-lesson-link.free , .colorskin-custom .w-course-price , .colorskin-custom .llms-lesson-preview .llms-lesson-link:hover .lesson-tip:hover i:before, .colorskin-custom .llms-parent-course-link a , .colorskin-custom .blgt1-top-sec a:hover , .colorskin-custom .llms-lesson-preview.prev-lesson.previous:hover h5,.colorskin-custom .llms-lesson-preview.prev-lesson.previous span,.colorskin-custom .llms-lesson-preview.next-lesson.next:hover h5,.colorskin-custom .llms-lesson-preview.next-lesson.next span , .colorskin-custom .llms-lesson-preview.prev-lesson.previous:hover a:before,.colorskin-custom .llms-lesson-preview.prev-lesson.previous a:after,.colorskin-custom .llms-lesson-preview.next-lesson.next:hover a:before,.colorskin-custom .llms-lesson-preview.next-lesson.next a:after , .colorskin-custom .llms-lesson-preview .llms-widget-syllabus .done.llms-free-lesson-svg,.colorskin-custom .llms-widget-syllabus .lesson-complete-placeholder.done,.colorskin-custom .llms-widget-syllabus .llms-lesson-complete.done,.colorskin-custom .llms-widget-syllabus .llms-lesson-preview .done.llms-free-lesson-svg , .colorskin-custom .llms-quiz-result-details ul li a , .colorskin-custom .llms-template-wrapper h4 span , .colorskin-custom .questions-total , .colorskin-custom .llms-checkout-wrapper .llms-checkout .llms-title-wrapper h4 a, #wrap.colorskin-custom .author-carousel .owl-buttons div:hover,.colorskin-custom .author-carousel .owl-buttons div:active, .colorskin-custom .filter-category-dropdown.nice-select:after , #wrap.colorskin-custom .filter-category .course-category.active ul li.active a,#wrap.colorskin-custom .filter-category .course-category.active ul li.active > a i,#wrap.colorskin-custom .filter-category .course-category.active ul li.active a span , .colorskin-custom a.btn.btn-default.btn-sm.active,.colorskin-custom a.btn.btn-default.btn-sm.active:hover , .colorskin-custom .footer-contact-info  i , #wrap.colorskin-custom .enrolment-wrap .enrolment-item:nth-of-type(odd) h4:after, #wrap.colorskin-custom .enrolment-wrap .enrolment-item:nth-of-type(even) h4:after, .colorskin-custom .enrolment-wrap .enrolment-item:hover span , #wrap.colorskin-custom .answer-questions.about-us input[type="submit"]:hover , #wrap.colorskin-custom .wpcf7 .instructor p:hover:before , .colorskin-custom .contac-info a , .colorskin-custom .switch-field input:checked+label , .colorskin-custom .course-sorting-wrap .nice-select:after , .colorskin-custom .blox.dark .icon-box2 i , .colorskin-custom .blox.dark .icon-box2:hover h4 , .colorskin-custom .icon-box4 i , .colorskin-custom .icon-box4:hover i , .colorskin-custom .icon-box7 , .colorskin-custom .icon-box7 i , .colorskin-custom .icon-box7 a.magicmore:hover , .colorskin-custom .icon-box8 a.magicmore , .colorskin-custom .icon-box9:hover a.magicmore , .colorskin-custom .icon-box11 i , .colorskin-custom .icon-box11 .magicmore , .colorskin-custom .icon-box12 i , .colorskin-custom .blox.dark .icon-box13:hover i , .colorskin-custom .icon-box14 i , .colorskin-custom .icon-box14 p strong , .colorskin-custom .icon-box15 i , .colorskin-custom .icon-box16 i,.colorskin-custom .icon-box16 img , .colorskin-custom .icon-box20 i , .colorskin-custom.dark-submenu #nav ul li a:hover , .colorskin-custom.dark-submenu #nav ul li.current a , #wrap.colorskin-custom.dark-submenu #nav ul li ul li.current a , #wrap.colorskin-custom.dark-submenu #nav ul li ul li:hover a , .colorskin-custom #header-b .course-category-box2:hover a span , .transparent-header-w .colorskin-custom  #header.horizontal-w #nav > li:hover > a, .transparent-header-w .colorskin-custom #header.horizontal-w #nav > li.current > a , .colorskin-custom .footer-in h5.subtitle,.colorskin-custom .toggle-top-area h5.subtitle , .colorskin-custom .breadcrumbs-w i , .colorskin-custom.online-t .top-bar .inlinelb.topbar-contact:hover , .colorskin-custom.online-t #footer .widget ul li:before , .colorskin-custom.online-t #footer .widget ul li a:hover , .colorskin-custom.online-t #footer .widget-subscribe-form input[type="text"] , .colorskin-custom.online-t #footer .widget-subscribe-form button , .colorskin-custom.online-t #footer .widget-subscribe-form button:before , .colorskin-custom.online-t #tribe-events-content-wrapper .tribe-events-calendar div[id*=tribe-events-daynum-] , .colorskin-custom .widget ul li.cat-item:hover a , .colorskin-custom .widget ul li.cat-item a:before , .colorskin-custom .widget ul .recentcomments:hover:before , .colorskin-custom .widget-tabs .tabs li.active a , #wrap.colorskin-custom .review-result-wrapper .review-result i , .colorskin-custom .course-search-form .nice-select:after , .colorskin-custom .widget .course-categories li a i , .colorskin-custom .widget .course-categories li a:hover,.colorskin-custom .widget .course-categories li a:hover span , #wrap.colorskin-custom .w-crsl .owl-buttons div:hover,.colorskin-custom .our-clients-wrap.w-crsl .owl-buttons div:active, #wrap.colorskin-custom .widget .owl-buttons div:after , .colorskin-custom .llms-widget-syllabus .lesson-title.active a , .colorskin-custom .llms-widget-syllabus .lesson-title.done:before , .colorskin-custom .widget.buddypress div.item-options a , .woocommerce .colorskin-custom div.product .woocommerce-tabs ul.tabs li.active , .woocommerce .colorskin-custom ul.products li.product .price , .woocommerce .colorskin-custom div.product form.cart button.single_add_to_cart_button:hover , .woocommerce .colorskin-custom .star-rating span:before , .woocommerce .colorskin-custom .myaccount_user a,.woocommerce .colorskin-custom .col-1.address .title a , .colorskin-custom .pin-box h4 a:hover,.colorskin-custom .tline-box h4 a:hover , .colorskin-custom .pin-ecxt h6.blog-cat a:hover , .colorskin-custom .pin-ecxt2 p a:hover , .colorskin-custom .blog-single-post .postmetadata h6.blog-cat a:hover , .colorskin-custom h6.blog-cat a , .colorskin-custom .blgtyp3.blog-post h6 a, .blgtyp1.blog-post h6 a, .blgtyp2.blog-post h6 a, .blog-single-post .postmetadata h6 a, .blog-single-post h6.blog-author a , .colorskin-custom .blgtyp3.blog-post h6 a:hover,.colorskin-custom .blgtyp1.blog-post h6 a:hover,.colorskin-custom .blgtyp2.blog-post h6 a:hover,.colorskin-custom .blog-single-post .postmetadata h6 a:hover,.colorskin-custom .blog-single-post h6.blog-author a:hover , .colorskin-custom .blog-post p.blog-cat a,.colorskin-custom .blog-line p.blog-cat a , .colorskin-custom .about-author-sec h3 a:hover , .colorskin-custom .blog-line:hover .img-hover:before , .colorskin-custom .rec-post h5 a:hover , .colorskin-custom .rec-post p a:hover , .colorskin-custom a.magicmore , .colorskin-custom .rec-post h5 a:hover , .colorskin-custom .blgtyp3.blog-post h6 a,.colorskin-custom .blgtyp1.blog-post h6 a,.colorskin-custom .blgtyp2.blog-post h6 a,.colorskin-custom .blog-single-post .postmetadata h6 a,.colorskin-custom .blog-single-post h6.blog-author a ,.colorskin-custom .blgtyp1.blog-post h6.blog-comments a , .colorskin-custom .blgtyp3.blog-post h6 a:hover,.colorskin-custom .blgtyp1.blog-post h6 a:hover,.colorskin-custom .blgtyp2.blog-post h6 a:hover,.colorskin-custom .blog-single-post .postmetadata h6 a:hover,.colorskin-custom .blog-single-post h6.blog-author a:hover ,.colorskin-custom .blgtyp1.blog-post h6.blog-comments a:hover ,   #wrap.colorskin-custom .colorf, #wrap.colorskin-custom .hcolorf:hover ,	 .colorskin-custom .faq-minimal a:hover h4 , .colorskin-custom .faq-minimal .faq-icon , .colorskin-custom .circle-box p strong, #wrap.colorskin-custom .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon:before , .colorskin-custom .our-team h5 , .colorskin-custom .testimonials-slider-w .testimonial-brand h5 , #wrap.colorskin-custom .vc_carousel.vc_carousel_horizontal.hero-carousel h2.post-title a:hover , #wrap.colorskin-custom .wpb_gallery_slides .flex-caption h2.post-title a:hover , .colorskin-custom .events-clean2 .event-article:hover .event-title , .colorskin-custom #tribe-events-content .tribe-events-tooltip h4,.colorskin-custom  #tribe_events_filters_wrapper .tribe_events_slider_val, .single-tribe_events .colorskin-custom a.tribe-events-gcal, .single-tribe_events .colorskin-custom a.tribe-events-ical , #wrap.colorskin-custom .hebe .tp-tab-title , .colorskin-custom .latestposts-one .latest-author a:hover , .latestposts-two .blog-post p.blog-author a:hover , .colorskin-custom .latestposts-two .blog-line:hover .img-hover:before , .colorskin-custom .latestposts-four h3.latest-b2-title a:hover , .colorskin-custom .latestposts-five h6.latest-b2-cat a , .colorskin-custom .latestposts-six .latest-content p.latest-date , .colorskin-custom .a-post-box .latest-title a:hover , .colorskin-custom .tribe-events-list .tribe-events-read-more , .colorskin-custom .tribe-events-list .type-tribe_events h2 a:hover , .colorskin-custom .goal-box .goal-sharing .goal-sharing-icon , .colorskin-custom .goal-box .goal-sharing .goal-social a:hover , .colorskin-custom .button.llms-next-lesson , .colorskin-custom .w-llms-my-certificates h3 i,.colorskin-custom .w-llms-my-achievements h3 i,.colorskin-custom .w-llms-my-courses h3 i,.colorskin-custom .w-llms-my-memberships h3 i , .colorskin-custom .w-contact-sidebar .icon-box i , .colorskin-custom .icon-box1 a.magicmore , .colorskin-custom #nav a:hover,.colorskin-custom #nav li:hover > a , .colorskin-custom #nav > li.current > a,.colorskin-custom #nav > li > a.active , .colorskin-custom #header.sticky #nav-wrap #nav #nav > li:hover > a , .colorskin-custom.dark-submenu #nav li.mega ul.sub-posts li a:hover , .colorskin-custom .nav-wrap2 #nav > li:hover > a, .top-links #nav > li:hover > a , .colorskin-custom .nav-wrap2.darknavi #nav > li > a:hover,.colorskin-custom .nav-wrap2.darknavi #nav > li:hover > a , .colorskin-custom .nav-wrap2 #nav > li.current > a , .colorskin-custom #header.sticky .nav-wrap2.darknavi #nav > li > a:hover , .w-header-type-12 .colorskin-custom #nav > li:hover > a , .colorskin-custom #header.horizontal-w.w-header-type-10 #nav > li:hover > a,.transparent-header-w .colorskin-custom #header.horizontal-w.w-header-type-10 #nav > li.current > a,.colorskin-custom #header.horizontal-w.w-header-type-10 #nav > li.current > a , .colorskin-custom .header-bottom #header-b li:hover a i , .colorskin-custom #header-b li.mega ul[class^="sub-"] ul li:hover a, .colorskin-custom #nav > li:hover > a,.colorskin-custom  #nav li.current > a,.colorskin-custom #nav li.active > a, .colorskin-custom #header.res-menu #menu-icon:hover i,.colorskin-custom #header.res-menu #menu-icon.active i , .transparent-header-w .colorskin-custom #header.horizontal-w.duplex-hd #nav > li:hover > a, .transparent-header-w .colorskin-custom #header.horizontal-w.duplex-hd #nav > li.current > a , .colorskin-custom .top-links a:hover , .colorskin-custom .top-bar h6 i , .colorskin-custom .online-learning-contact .row:hover .icon , .colorskin-custom .online-t-contact .row:hover .icon , .colorskin-custom.online-t #tribe-events-content .tribe-events-tooltip h4,.colorskin-custom.online-t #tribe_events_filters_wrapper .tribe_events_slider_val, .single-tribe_events .colorskin-custom.online-t a.tribe-events-gcal, .single-tribe_events .colorskin-custom.online-t  a.tribe-events-ical , .colorskin-custom .toggle-top-area .widget ul li a:hover ,.colorskin-custom #footer .widget ul li a:hover , .woocommerce .colorskin-custom nav.woocommerce-pagination ul li a , .woocommerce .colorskin-custom ul.products li.product:hover a.add_to_cart_button:hover , .woocommerce .colorskin-custom ul.cart_list li a:hover,.woocommerce .colorskin-custom ul.product_list_widget li a:hover
	{ color: <?php echo esc_attr($color); ?>}

	/* == Backgrounds
	----------------- */
	#wrap.colorskin-custom .course-content .products:hover li .product-inner h3,.colorskin-custom .llms-checkout-wrapper .llms-form-heading,.colorskin-custom .llms-button-action,#wrap.colorskin-custom .wn-course-progress a,#wrap.colorskin-custom .llms-access-plan:hover .llms-access-plan-title,.colorskin-custom .llms-access-plan:hover .llms-access-plan-footer .llms-button-action.button,.colorskin-custom .wn-button.llms-button-primary,.woocommerce .colorskin-custom .button,.colorskin-custom .flip-clock-wrapper ul li a div div.inn,.colorskin-custom #header .woo-cart-header .header-cart span,.colorskin-custom .llms-purchase-link-wrapper .llms-button,.colorskin-custom #header.res-menu #menu-icon span.mn-ext1,.colorskin-custom #header.res-menu #menu-icon span.mn-ext2,.colorskin-custom .w-pricing-table3.featured .ptcontent > span,.colorskin-custom .icon-box10:hover i,.colorskin-custom .icon-box9:hover i,.colorskin-custom .subscribe-flat .subscribe-box-input .subscribe-box-submit,.colorskin-custom .max-hero h5:before,.colorskin-custom .teaser-box4 .teaser-title,.colorskin-custom .teaser-box4 .teaser-subtitle ,.colorskin-custom .wpcf7 .wpcf7-form input[type="submit"],.colorskin-custom .wpcf7 .wpcf7-form input[type="reset"],.colorskin-custom .wpcf7 .wpcf7-form input[type="button"],#wrap.colorskin-custom.school-t .top-bar,.colorskin-custom #buddypress .comment-reply-link,.colorskin-custom #buddypress .generic-button a,.colorskin-custom #buddypress a.button,.colorskin-custom #buddypress button,.colorskin-custom #buddypress input[type=button],.colorskin-custom #buddypress input[type=reset],.colorskin-custom #buddypress input[type=submit],.colorskin-custom #buddypress ul.button-nav li a,.colorskin-custom a.bp-title-button,.colorskin-custom a.readmore:after , .colorskin-custom h4.comments-title:after , #wrap.colorskin-custom #commentform input[type="submit"]:hover , .colorskin-custom .commentbox h3:after , .colorskin-custom .post-format-icon , .colorskin-custom .date-box .ln-date .ln-month , .colorskin-custom .button.theme-skin , .colorskin-custom .button.bordered-bot.theme-skin:hover , .colorskin-custom .button.bordered-bot.gold:hover , .colorskin-custom .esg-filter-wrapper span:hover , .colorskin-custom .esg-navigationbutton.esg-filterbutton.esg-pagination-button.selected , .colorskin-custom .esg-navigationbutton.esg-filterbutton.esg-pagination-button:hover, .colorskin-custom .w-table th , .colorskin-custom .wsingleblog-post .postmetadata .blog-cat a:hover , #wrap.colorskin-custom .um-button , .colorskin-custom .sub-title:after , .colorskin-custom #social-media.active.other-social , #wrap.colorskin-custom .ts-tri.testimonials-slider-w .w-crsl .owl-buttons div:hover:after , #wrap.colorskin-custom .testimonials-slider-w.ts-deca .owl-theme .owl-controls .owl-page.active span , #wrap.colorskin-custom #w-h-carusel.w-crsl .owl-buttons div:hover:after , .colorskin-custom .w-callout , .colorskin-custom .callout a.callurl , .colorskin-custom .w-pricing-table1 .price-footer a:hover , .colorskin-custom .w-pricing-table2 .price-footer a.readmore:after , .colorskin-custom .w-pricing-table2:hover.w-pricing-table2 .price-header h5 , .colorskin-custom .w-pricing-table2.featured .price-header h5 , .colorskin-custom .subscribe-bar1 .subscribe-box-input .subscribe-box-submit , .colorskin-custom #tribe-events-content-wrapper .tribe-events-calendar td:hover , .colorskin-custom .countdown-w.ctd-simple .block-w , .colorskin-custom .countdown-w.ctd-modern .block-w .icon-w , .colorskin-custom .tribe-events-list .booking-button , .colorskin-custom .tribe-events-list .event-sharing > li:hover , .colorskin-custom .tribe-events-list .event-sharing .event-share:hover .event-sharing-icon , .colorskin-custom .tribe-events-list .event-sharing .event-social li a , .colorskin-custom #tribe-events-pg-template .tribe-events-button , .single-tribe_events .colorskin-custom .booking-button , #wrap.colorskin-custom #tribe-events .tribe-events-button:hover , .colorskin-custom .tribe-events-list .event-sharing .event-share:hover .event-sharing-icon,.colorskin-custom .tribe-events-list .event-sharing .event-social li a,.colorskin-custom .tribe-events-list .event-sharing > li:hover , .colorskin-custom .events-grid2 .event-grid-head , #wrap.colorskin-custom .course-content .llms-button:hover , .colorskin-custom .course-content .course-titles:after , .colorskin-custom .course-content #old_reviews h3:after , .colorskin-custom .button#llms_review_submit_button:hover , .colorskin-custom .instructor-box h5 , #wrap.colorskin-custom .llms-lesson-complete-placeholder.free i , #wrap.colorskin-custom .llms-lesson-button-wrapper .button ,#wrap.colorskin-custom .llms-lesson-button-wrapper .llms-button-action, .colorskin-custom .llms-parent-course-link a:hover , .colorskin-custom .llms-quiz-results h3:after ,.colorskin-custom .quiz-description h4:after, .colorskin-custom #llms_start_quiz, .colorskin-custom #llms_answer_question,.colorskin-custom #llms_prev_question , #wrap.colorskin-custom .llms-clear-box.llms-center-content .llms-button , .single-llms_membership  #wrap.colorskin-custom .llms-purchase-link-wrapper a.llms-button , .colorskin-custom .author-courses .course-title:after,.colorskin-custom .author .post-title:after ,	 .colorskin-custom .filter-category h3:after , .colorskin-custom .filter-category .course-category.active , .colorskin-custom .llms-pagination ul li .page-numbers:hover , .colorskin-custom .enrolment-wrap .enrolment-item h4 , .colorskin-custom .enrolment-wrap .enrolment-item span , #wrap.colorskin-custom .enrolment-wrap .enrolment-item:hover p , .colorskin-custom .events-grid3 .event-grid3-header , .colorskin-custom .events-grid3 .event-grid-head , .colorskin-custom .events-grid3 .event-grid3-footer .event-sharing > li:hover , .colorskin-custom .events-grid3 .event-grid3-footer .event-sharing .event-social li a , #wrap.colorskin-custom .events-grid3 .event-grid3-footer .booking-button:hover , .colorskin-custom .events-grid3 .event-grid3-footer .booking-button:hover , .colorskin-custom .advancedlist > span , .colorskin-custom .our-curriculum .our-curriculum-content-wrap , .colorskin-custom .our-curriculum .our-curriculum-header , .colorskin-custom .icon-box6 i , .colorskin-custom .icon-box11 i:after , .colorskin-custom .icon-box14:hover i , .colorskin-custom .icon-box15:hover i , .colorskin-custom .icon-box21 .iconbox-rightsection .magicmore , .colorskin-custom .header-bottom #searchsubmit , .colorskin-custom #pre-footer .footer-social-items a:hover i, .colorskin-custom #pre-footer .footer-subscribe-submit, .w-modal .colorskin-custom .wpcf7 .wpcf7-form input[type="submit"],.w-modal .colorskin-custom .wpcf7 .wpcf7-form input[type="reset"],.w-modal .colorskin-custom .wpcf7 .wpcf7-form input[type="button"],#w-login #wp-submit, .colorskin-custom .wpcf7 .wpcf7-form .online-learning-contact input[type="submit"] , .colorskin-custom.online-t .footer-in h5.subtitle:after , .colorskin-custom.online-t #tribe-events-content-wrapper .tribe-events-calendar td:hover , .colorskin-custom.online-t .tribe-events-thismonth.tribe-events-future.tribe-events-has-events.mobile-trigger.tribe-events-right:hover,#wrap.colorskin-custom.online-t .tribe-events-thismonth.tribe-events-future.tribe-events-has-events.mobile-trigger.tribe-events-right:hover div[id*=tribe-events-daynum-],.colorskin-custom.online-t .tribe-events-thismonth.tribe-events-present.tribe-events-has-events.mobile-trigger:hover, .colorskin-custom.online-t .tribe-events-thismonth.tribe-events-present.tribe-events-has-events.mobile-trigger:hover div[id*=tribe-events-daynum-] , .colorskin-custom.school-t #footer .widget_nav_menu ul li:hover , .colorskin-custom .sidebar .widget h1:after,.colorskin-custom .sidebar .widget h4:after , .colorskin-custom #footer .tagcloud a:hover,.colorskin-custom .toggle-top-area .tagcloud a:hover , .colorskin-custom .widget-subscribe-form button , #wrap.colorskin-custom #footer .widget .owl-buttons div:after , .colorskin-custom .llms-widget-syllabus .lesson-title.active:before , .colorskin-custom .widget.widget_display_search #bbp_search_submit , .woocommerce .colorskin-custom a.button.alt,.woocommerce .colorskin-custom button.button.alt,.woocommerce .colorskin-custom input.button.alt,.woocommerce .colorskin-custom #respond input#submit.alt , .woocommerce .colorskin-custom .widget_price_filter .ui-slider .ui-slider-handle , .colorskin-custom .a-course .media-links , .colorskin-custom #tribe-events-content-wrapper .tribe-events-sub-nav a:hover , #wrap.colorskin-custom #tribe-events-content-wrapper #tribe-bar-form .tribe-events-button , .colorskin-custom .events-grid .event-detail , .colorskin-custom .goals .goal-content .donate-button:hover , .colorskin-custom .goals.goals-list .goal-content .goal-sharing  a , .colorskin-custom .goal-box .donate-button , .colorskin-custom .blox .widget_search input[type="submit"]#searchsubmit.btn,.colorskin-custom  .max-hero .widget_search input[type="submit"]#searchsubmit.btn  , .colorskin-custom #menu-icon:hover,.colorskin-custom  #menu-icon.active , .colorskin-custom .top-bar .topbar-login , .colorskin-custom #scroll-top a:hover , .colorskin-custom.online-t .top-bar .inlinelb.topbar-contact , .colorskin-custom .modal-title , .colorskin-custom.online-t #tribe-events-content-wrapper .tribe-events-calendar td:hover div[id*=tribe-events-daynum-] , .colorskin-custom.school-t .wuser-menu .wuser-smenu , .single .colorskin-custom .woo-template span.onsale, .woocommerce .colorskin-custom ul.products li.product .onsale , .woocommerce .colorskin-custom .button , .colorskin-custom .widget_shopping_cart_content p.buttons a.button , #wrap.colorskin-custom .blog-social a:hover , .colorskin-custom .commentlist li .comment-text .reply a:hover , #wrap.colorskin-custom .colorb, #wrap.colorskin-custom .hcolorb:hover , .colorskin-custom .latestposts-one .latest-b-cat:hover , .colorskin-custom .latestposts-seven .latest-img:hover img , #wrap.colorskin-custom .colorb, #wrap.colorskin-custom .hcolorb:hover , .colorskin-custom .latestposts-one .latest-b-cat:hover , .colorskin-custom .latestposts-seven .latest-img:hover img , .colorskin-custom .woocommerce-message a.button, .colorskin-custom .pin-ecxt2 .col1-3 span,.colorskin-custom .comments-number-x span , .colorskin-custom #tline-content:before , .colorskin-custom .tline-row-l:after,.colorskin-custom .tline-row-r:before , .colorskin-custom .tline-topdate , .colorskin-custom .port-tline-dt h3 , .colorskin-custom .postmetadata h6.blog-views span , #wrap.colorskin-custom .w-contact-p input[type="submit"]:hover , .colorskin-custom p.welcomebox:after , #wrap.colorskin-custom .ts-hepta.testimonials-slider-w .owl-theme .owl-controls .owl-page.active span , #wrap.colorskin-custom .vc_carousel.vc_carousel_horizontal.hero-carousel .hero-carousel-wrap .hero-metadata .category a , .colorskin-custom .our-process-item i:after , .colorskin-custom .events-clean2 .event-article:hover .event-date, #wrap.colorskin-custom .ls-slider1-a , .colorskin-custom .latestposts-four .latest-b2 h6.latest-b2-cat , .colorskin-custom .a-post-box .latest-cat , .colorskin-custom .llms-lesson-preview .llms-lesson-complete, .colorskin-custom .llms-button-wrapper .button.llms-next-lesson:hover , .colorskin-custom .llms-question-label input[type="radio"]:checked:before,.colorskin-custom .llms-question-label input[type="radio"]:hover:before , .colorskin-custom #header.res-menu #menu-icon span.mn-ext3 ,  .colorskin-custom .footer-in .tribe-events-widget-link a:hover,.colorskin-custom .footer-in .contact-inf button:hover , #wrap.colorskin-custom .socialfollow a:hover , #wrap.colorskin-custom .wp-pagenavi a:hover , .colorskin-custom .side-list li:hover img , .colorskin-custom .subscribe-bar1 .subscribe-box-input .subscribe-box-submit
	{ background-color: <?php echo esc_attr($color); ?>}

	/* == BorderColors
	------------------ */
	#wrap.colorskin-custom .course-content .products li a.add_to_cart_button,#wrap.colorskin-custom .course-content .products:hover,.colorskin-custom .llms-notice,.colorskin-custom .llms-checkout-section,#wrap.colorskin-custom .wn-course-progress a,#wrap.colorskin-custom .wn-course-progress a:hover,.colorskin-custom .llms-access-plan:hover .llms-access-plan-content,.colorskin-custom .llms-access-plan:hover .llms-access-plan-footer,.colorskin-custom .llms-access-plan-footer .llms-button-action.button,.colorskin-custom .widget-title:after,.colorskin-custom .widget-title:after,.colorskin-custom #header.w-header-type-10,.colorskin-custom .icon-box13, .transparent-header-w .colorskin-custom #header.w-header-type-10,#wrap.colorskin-custom #tribe-events .tribe-events-button,.colorskin-custom .tline-row-l,.colorskin-custom .tline-row-r, .colorskin-custom .big-title1:after, .colorskin-custom .max-title5:after,.colorskin-custom .max-title2:after,.colorskin-custom .max-title4:after, .colorskin-custom .subtitle-four:after, .colorskin-custom .max-counter.w-counter:before, .colorskin-custom .max-counter.w-counter:after, .colorskin-custom h6.h-sub-content, .colorskin-custom .teaser-box7 h4:before, .colorskin-custom .tribe-events-list-separator-month span, .colorskin-custom .tribe-events-list .tribe-events-event-meta, .colorskin-custom #header.box-menu .nav-wrap2 #nav > li.current, .colorskin-custom #header.box-menu .nav-wrap2 #nav > li > ul, .colorskin-custom .our-clients-wrap.w-crsl ul.our-clients img:hover, .colorskin-custom  .woocommerce-info,.colorskin-custom #buddypress .comment-reply-link,.colorskin-custom #buddypress .generic-button a,.colorskin-custom #buddypress a.button,.colorskin-custom #buddypress button,.colorskin-custom #buddypress input[type=button],.colorskin-custom #buddypress input[type=reset],.colorskin-custom #buddypress input[type=submit],.colorskin-custom #buddypress ul.button-nav li a,.colorskin-custom a.bp-title-button,.colorskin-custom a.readmore:hover , #wrap.colorskin-custom .ts-hepta.testimonials-slider-w .owl-theme .owl-controls .owl-page.active span , .colorskin-custom .our-process-item:hover i , .colorskin-custom .w-pricing-table2:hover.w-pricing-table2 .ptcontent , .colorskin-custom .w-pricing-table2.featured .ptcontent , .colorskin-custom .llms-checkout-wrapper .llms-checkout , #wrap.colorskin-custom .author-carousel .owl-buttons div:hover, .author-carousel .owl-buttons div:active, .colorskin-custom .enrolment-wrap .enrolment-item p , #wrap.colorskin-custom .enrolment-wrap .enrolment-item:hover p , #wrap.colorskin-custom.kids-t .crsl .owl-buttons div:hover, #wrap.colorskin-custom.kids-t .our-clients-wrap.crsl .owl-buttons div:active, #wrap.colorskin-custom .wpcf7 .instructor p input:hover, #wrap.colorskin-custom .wpcf7 .instructor p textarea:hover , .colorskin-custom .icon-box20 span:before, .icon-box20 span:after , .colorskin-custom #pre-footer .footer-social-items a:hover i, #wrap.colorskin-custom .wp-pagenavi a:hover , .colorskin-custom.school-t #footer .socialfollow a:hover , #wrap.colorskin-custom .w-crsl .owl-buttons div:hover,.colorskin-custom .our-clients-wrap.w-crsl .owl-buttons div:active, #wrap.colorskin-custom #footer .widget .owl-buttons div:after , .colorskin-custom .commentlist li .comment-text .reply a:hover , #wrap.colorskin-custom .colorr, #wrap.colorskin-custom .hcolorr:hover , .colorskin-custom .blox.dark .vc_separator .vc_sep_holder .vc_sep_line , #wrap.colorskin-custom #w-h-carusel.w-crsl .owl-buttons div:hover:after , .colorskin-custom .events-clean2 .event-article:hover .event-date, .single-tribe_events .colorskin-custom  .tribe-event-tags a:hover , .colorskin-custom #header.box-menu .nav-wrap2 #nav > li:hover , .colorskin-custom a.readmore , .colorskin-custom .button.bordered-bot.theme-skin , #wrap.colorskin-custom .um-form .um-button.um-alt , .colorskin-custom .our-team3:hover figure img , .colorskin-custom .testimonials-slider-w.ts-tetra .testimonial-brand img , .colorskin-custom .countdown-w.ctd-modern .block-w , .colorskin-custom #tribe-events-content-wrapper .tribe-events-sub-nav a , #wrap.colorskin-custom .course-content .llms-button , .colorskin-custom .button#llms_review_submit_button , .colorskin-custom .button.llms-next-lesson , .colorskin-custom .llms-question-label input[type="radio"] , .colorskin-custom .icon-box14 i , .colorskin-custom .side-list img , .colorskin-custom .widget-subscribe-form button , .colorskin-custom .llms-widget-syllabus .lesson-title.active:before
	{ border-color: <?php echo esc_attr($color); ?>}

	/* == RevSlider Specifics
	------------------------ */
	.colorskin-custom .tp-caption.Fashion-BigDisplay { color:<?php echo esc_attr($color); ?> !important;}
	.colorskin-custom .Button-Style { background-color:<?php echo esc_attr($color); ?> !important;}


	/* == Essential Grid
	------------------------ */
	.colorskin-custom .eg-item-skin-2-element-11 { background-color: ;}


	/* == Woocommerce Specifics
	--------------------------- */
	.colorskin-custom .woocommerce div.product .woocommerce-tabs ul.tabs li.active { border-top-color:<?php echo esc_attr($color); ?> !important;}


	/* == Special
	--------------------------- */
    .llms-form-field.type-radio input[type=radio]:checked+label:before { background-image: -webkit-radial-gradient(center,ellipse,<?php echo esc_attr($color); ?> 0,<?php echo esc_attr($color); ?> 40%,#fafafa 45%); background-image: radial-gradient(ellipse at center,<?php echo esc_attr($color); ?> 0,<?php echo esc_attr($color); ?> 40%,#fafafa 45%);}
	.colorskin-custom #header.box-menu .nav-wrap2 #nav > li.current { border-bottom-color:<?php echo esc_attr($color); ?>; }
	.colorskin-custom h4.h-subtitle {border-bottom-color:<?php echo esc_attr($color); ?>; }
	.colorskin-custom .vc_progress_bar .vc_single_bar .vc_bar.animated {background-color: <?php echo esc_attr($color); ?> !important;}
	#wrap.colorskin-custom .course-category-box-o .course-category-box:hover .ccb-hover-content.colorb { background-color: rgba(<?php echo $r.','.$g.','.$b ?>,0.76); }

	/*	#need to important
	--------------------------- */
	.single-tribe_events .colorskin-custom .w-single-event-organizer i, .single-tribe_events .colorskin-custom .w-tribe-events-meta-date i { color: <?php echo esc_attr($color); ?> !important; }
	#wrap.online-t.colorskin-custom .tribe-events-thismonth.tribe-events-future.tribe-events-has-events.mobile-trigger.tribe-events-right:hover div[id*=tribe-events-daynum-], .colorskin-custom .woocommerce-message a.button, .colorskin-custom .top-bar .inlinelb.topbar-contact, .online-t.colorskin-custom .tribe-events-thismonth.tribe-events-future.tribe-events-has-events.mobile-trigger.tribe-events-right:hover, .online-t.colorskin-custom .tribe-events-thismonth.tribe-events-present.tribe-events-has-events.mobile-trigger:hover, .online-t.colorskin-custom .tribe-events-thismonth.tribe-events-present.tribe-events-has-events.mobile-trigger:hover div[id*=tribe-events-daynum-]{ background-color: <?php echo esc_attr($color); ?> !important; }


	/*	#border-left
	--------------------------- */
	.colorskin-custom .filter-category .course-category.active:after,.colorskin-custom .llms-lesson-preview.is-complete .llms-lesson-link, .colorskin-custom .llms-lesson-preview .llms-lesson-link.free, .colorskin-custom.online-t .tribe-events-thismonth.tribe-events-present.tribe-events-has-events.mobile-trigger:before { border-left-color: <?php echo esc_attr($color); ?> ;}


	/*	#border-top
	--------------------------- */
	.colorskin-custom .woocommerce-message,.woocommerce .colorskin-custom div.product .woocommerce-tabs ul.tabs li.active { border-top-color: <?php echo esc_attr($color); ?> ;}


	/*	#subscribe footer widget
	--------------------------- */
	.colorskin-custom.online-t #footer .widget-subscribe-form input[type="text"]::-webkit-input-placeholder { color: <?php echo esc_attr($color); ?>;}
	.colorskin-custom.online-t #footer .widget-subscribe-form input[type="text"]:-moz-placeholder { color: <?php echo esc_attr($color); ?>;}
	.colorskin-custom.online-t #footer .widget-subscribe-form input[type="text"]::-moz-placeholder { color: <?php echo esc_attr($color); ?>;}
	.colorskin-custom.online-t #footer .widget-subscribe-form input[type="text"]:-ms-input-placeholder { color: <?php echo esc_attr($color); ?>;}

	/*	#Contact Modal
	--------------------------- */
	.w-modal .colorskin-custom .wpcf7 .wpcf7-form input[type="submit"], .w-modal.colorskin-custom .wpcf7 .wpcf7-form input[type="reset"], .w-modal .colorskin-custom .wpcf7 .wpcf7-form input[type="button"], #w-login .colorskin-custom #wp-submit { background-color: <?php echo esc_attr($color); ?> ;}

	/*	#custom
	=======================*/
	#wrap #commentform input[type="submit"]:hover ,#wrap .w-llms-my-courses .course-link a, #wrap .top-bar .inlinelb.topbar-contact:hover, #wrap #tribe-events .tribe-events-button:hover, #wrap .llms-purchase-link-wrapper .llms-purchase-button.llms-button:hover, #wrap .w-course-list .llms-button { color: #fff ; }
	#wrap .w-course-list .llms-button:hover { background: #424242 !important;}
	#wrap.college-t .top-bar .inlinelb.topbar-contact { background-color: #4a4a4a; }
	#wrap .widget h1:after,#wrap .widget h4:after { border-right-color: #fff;border-left-color: #fff; }
	#wrap .button.theme-skin:hover { background: #333; border-color: #333; }
	.button.bordered-bot.theme-skin {background-color:transparent;}
	.button.bordered-bot.theme-skin:hover ,.goals .goal-content .donate-button:hover{color:#fff;}

<?php }


/*
 * Custom CSS
*/
echo strip_tags($thm_options['michigan_webnus_custom_css']);

$out = $GLOBALS['michigan_webnus_dyncss'] = '';
$out = ob_get_contents();
$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
$GLOBALS['michigan_webnus_dyncss'] = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $out);
ob_end_clean();

?>