<?php
$michigan_webnus_options = michigan_webnus_options();
?>
<div class="header-bottom">
	<div class="container">
		<div class="col-md-3 col-sm-4">
			<?php if ( has_nav_menu( 'header-bottom-menu' ) ) {
			wp_nav_menu( array( 'theme_location' => 'header-bottom-menu', 'container' => 'false', 'menu_id' => 'header-b', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new michigan_webnus_description_walker()) );
			}
			?>
		</div>
		<div class="col-md-9 col-sm-8">
			<form id="topbar-search" role="search" action="<?php echo esc_url(home_url( '/' )); ?>" method="get" >
				<div class="col-md-9 col-sm-6 col-xs-12">
					<input name="s" type="text" class="search-text-box" placeholder="<?php esc_html_e('Search For The Courses, Software or Skills You Want to Learn...','michigan');?>" >
				</div>
				<?php if( isset($michigan_webnus_options['michigan_webnus_header_bottom_search'] ) && $michigan_webnus_options['michigan_webnus_header_bottom_search'] == '1'){ ?>
				<input type="hidden" name="post_type" value="course" />
				<?php } ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<input type="submit" id="searchsubmit" value="<?php esc_html_e('Search','michigan');?>" class="btn" />
				</div>
			</form>
		</div>
	</div>
</div>
