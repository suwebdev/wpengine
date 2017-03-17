<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>

<?php
	$michigan_webnus_options = michigan_webnus_options();
	$post_format = get_post_format(get_the_ID());
	if( !$post_format ) $post_format = 'standard';
	$content = get_the_content();
	if( !$post_format ) $post_format = 'standard';
	if(  $michigan_webnus_options['michigan_webnus_blog_featuredimage_enable'] ) {

		$meta_video = rwmb_meta( 'michigan_featured_video_meta' );

		// video post type
		if( 'video'  == $post_format || 'audio'  == $post_format) {
			$pattern = '\\[' .'(\\[?)' ."(video|audio)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);

			if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))) {
				$video = $matches[0];
				echo do_shortcode($video);
				$content = preg_replace('/'.$pattern.'/s', '', $content);

			} else if( (!empty( $meta_video )) ) {
				echo do_shortcode($meta_video);
			}
		// gallery post type
		} else if( 'gallery'  == $post_format) {
			$pattern = '\\[' .'(\\[?)' ."(gallery)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);

			if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))) {
				$ids = (shortcode_parse_atts($matches[3]));
				if(is_array($ids) && isset($ids['ids'])) $ids = $ids['ids'];
				echo do_shortcode('[vc_gallery onclick="link_no" img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'"  custom_links_target="_self"]');
				$content = preg_replace('/'.$pattern.'/s', '', $content);
			}
		} else {
			get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full' ) );
		}
	} ?>

<br> <?php

	if(  $michigan_webnus_options['michigan_webnus_blog_posttitle_enable'] ) {
		if( ('aside' != $post_format ) && ('quote' != $post_format)  ) {
			if( 'link' == $post_format ) {
				preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
				$content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
				$link ='';
				if(isset($matches) && is_array($matches)) $link = $matches[0]; ?>
			<h3 class="post-title-ps1"><a href="<?php echo esc_url($link); ?>"><?php the_title() ?></a></h3> <?php
			} else { ?>
				<h3 class="post-title-ps1"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3> <?php
			}
		}
	} ?>

	<div class="postmetadata">
		<?php if($michigan_webnus_options['michigan_webnus_blog_meta_date_enable']) { ?>
		<h6 class="blog-date"><a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')) ?></a></h6>
		<?php } if( 1 == $michigan_webnus_options['michigan_webnus_blog_meta_author_enable'] ) { ?>
		<h6 class="blog-author"><strong><?php esc_html_e('posted by','michigan'); ?></strong> <?php the_author_posts_link(); ?> </h6>
		<?php } ?>
		<?php if( 1 == $michigan_webnus_options['michigan_webnus_blog_meta_category_enable'] ) { ?>
		<h6 class="blog-cat"><strong><?php esc_html_e('in','michigan'); ?></strong> <?php the_category(', ') ?> </h6>
		<?php } ?>
		<?php if( 1 == $michigan_webnus_options['michigan_webnus_blog_meta_comments_enable'] ) { ?>
		<h6 class="blog-comments"><strong> - </strong> <?php comments_number(  ); ?> </h6>
		<?php } ?>
	</div>

	<p> <?php
		if( 0 == $michigan_webnus_options['michigan_webnus_blog_excerptfull_enable']  ) {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			the_excerpt();
			if( 'quote' == $post_format  ) echo '</blockquote>';
		}
		else {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo apply_filters('the_content',$content);
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} ?>
	</p>

	<hr class="vertical-space1">
</article>