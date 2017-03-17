<?php
    $michigan_webnus_options = michigan_webnus_options();
	$live_search = ($michigan_webnus_options['michigan_webnus_enable_livesearch'] == 1)?'live-search':'';
?>

<form role="search" action="<?php echo esc_url(home_url( '/' )); ?>" method="get" >
 <div>
   <input name="s" type="text" placeholder="<?php esc_html_e('Enter Keywords...','michigan'); ?>" class="search-side <?php echo esc_attr($live_search) ?>" >
   <input type="submit" id="searchsubmit" value="Search" class="btn" />
</div>
</form>