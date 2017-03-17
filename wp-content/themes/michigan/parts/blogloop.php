<?php
	$michigan_webnus_options = michigan_webnus_options();
	$post_thumb = (!has_post_thumbnail())? 'post-no-image':'';
	$classes = array(
		'blog-post',
		'blgtyp1',
		$post_thumb,
	);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

<div class="blog-inner">
	<?php
	$post_format = get_post_format(get_the_ID());
	$content = get_the_content();
	?>

		<div class="blgt1-top-sec">

<span class="post-format-icon colorb <?php echo get_post_format(); ?>"></span>
		<?php
		if(function_exists('wp_review_show_total')){wp_review_show_total(true, 'review-total-only small-thumb');}
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
		}}}?>
			<div class="au-avatar-box">
<?php if($michigan_webnus_options['michigan_webnus_blog_meta_gravatar_enable']){ ?>
<div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div>
<?php } ?>
<h6 class="blog-author"><strong><?php esc_html_e('posted by','michigan'); ?></strong> <?php the_author_posts_link(); ?></h6>
<h6 class="blog-date"><a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')) ?></a></h6>
<h6 class="blog-cat"><?php the_category(', ') ?></h6>
<h6 class="blog-comments"><a class="hcolorf" href="<?php the_permalink(); ?>#comments"> <?php comments_number(  ); ?></a></h6>
</div>
		</div>
	<?php
	if( !$post_format ) $post_format = 'standard';

	if( $michigan_webnus_options['michigan_webnus_blog_featuredimage_enable'] ) {
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
			if(has_post_thumbnail()){
				get_the_image(array('meta_key' => array( 'Full', 'Full' ), 'size' => 'Full'));
			}else{
				if($michigan_webnus_options['michigan_webnus_no_image']['url']){
					$no_image_src = ($michigan_webnus_options['michigan_webnus_no_image_src']['url'])?$michigan_webnus_options['michigan_webnus_no_image_src']['url']: get_template_directory_uri().'/images/no_image.jpg';
					echo '<img alt="'.get_the_title().'" width="756" height="443" src="'.$no_image_src.'">';
				}
			}
		}
	} ?>
<div class="blgt1-inner">



 <?php
	  if( 0 == $michigan_webnus_options['michigan_webnus_blog_excerptfull_enable']  ) {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo '<p>';
			echo michigan_webnus_excerpt(($michigan_webnus_options['michigan_webnus_blog_excerpt_large'])?$michigan_webnus_options['michigan_webnus_blog_excerpt_large']:93);
			echo '... <br><br><a class="readmore colorf colorr hcolorr" href="' . get_permalink($post->ID) . '">' . esc_html($michigan_webnus_options['michigan_webnus_blog_readmore_text']) . '</a>';
			echo '</p>';
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} else {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo apply_filters('the_content',$content);
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} ?>

	</div>
	<div class="postmetadata">

	<?php if( 1 == $michigan_webnus_options['michigan_webnus_blog_social_share'] ) { ?>
		<div class="blog-social">
			<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a>
			<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="fa-google"></i></a>
			<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a>
			<a class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source=<?php bloginfo( 'name' ); ?>"><i class="fa-linkedin"></i></a>
			<a class="email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><i class="fa-envelope"></i></a>
		</div>
		<?php } ?>
		</div>

	<hr class="vertical-space1">
	</div>
</article>