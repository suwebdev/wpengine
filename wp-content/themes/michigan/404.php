<?php
get_header();
$michigan_webnus_options = michigan_webnus_options();
$not_found_page_status = $michigan_webnus_options['michigan_webnus_404_page_switch'] ;
$not_found_page_id = isset( $michigan_webnus_options['michigan_webnus_404_page'] )? $michigan_webnus_options['michigan_webnus_404_page'] : '' ;
$not_found_page_text = isset( $michigan_webnus_options['michigan_webnus_404_text'] )? $michigan_webnus_options['michigan_webnus_404_text'] : '' ;
echo '<section class="container"><div class="row-wrapper-x"><section id="main-content" class="container">';
if( $not_found_page_status && $not_found_page_id ){
  echo apply_filters('the_content', get_post_field('post_content', $not_found_page_id));
} else { ?>
</div></section>
    <div class="blox page-title-x dark">
      <div class="container alignleft">
        <h1 class="pnf404"><?php esc_html_e('404','michigan'); ?></h1>
        <h2 class="pnf404"><?php esc_html_e('Page Not Found','michigan'); ?></h2>
        <br>
        <div>
         <?php get_search_form(); ?>
       </div>
       <?php echo $not_found_page_text ; ?>
      </div>
    </div>
<section class="container"><div class="row-wrapper-x">
 <?php }
 echo '</div></section></section>';
 get_footer(); ?>