<article  class="pin-box entry -item">

<?php
	$michigan_webnus_options = michigan_webnus_options();
	$post_format = get_post_format(get_the_ID());
	$content = get_the_content();
?>

<div class="img-item">
 <?php
	if(  $michigan_webnus_options['michigan_webnus_blog_featuredimage_enable'] ){
		$meta_video = rwmb_meta( 'michigan_featured_video_meta' );
		if( 'video'  == $post_format || 'audio'  == $post_format)
		{
			$pattern = '\\[' . '(\\[?)' . "(video|audio)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2])))
			{
				$video = $matches[0];
				echo do_shortcode($video);
				$content = preg_replace('/'.$pattern.'/s', '', $content);
			}else
			if( (!empty( $meta_video )) )
			{
				echo do_shortcode($meta_video);
			}
		}else
		if( 'gallery'  == $post_format)
		{
			$pattern = '\\[' . '(\\[?)' . "(gallery)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2])))
			{
				$ids = (shortcode_parse_atts($matches[3]));
				if(is_array($ids) && isset($ids['ids']))
					$ids = $ids['ids'];
				echo do_shortcode('[vc_gallery onclick="link_no" img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'"  custom_links_target="_self"]');
				$content = preg_replace('/'.$pattern.'/s', '', $content);
			}
		}else
			get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full' ) );
	}
?>
</div>
<div class="pin-ecxt">
	<h6 class="blog-cat"><?php the_category(', ') ?> </h6>
	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
<?php
// Post Content
		if($post_format == 'quote' ) echo '<blockquote>';
			echo '<p>'.michigan_webnus_excerpt(31).'</p>';
		if($post_format == 'quote') echo '</blockquote>';
		if($post_format == ('quote') || $post_format == 'aside' )
			echo '<a class="readmore colorf colorr hcolorr" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__('View Post', 'michigan') . '</a>';
	?>
</div>
				<div class="pin-ecxt2">
					<div class="col1-3"><i class="fa-comment-o"></i><span><?php echo get_comments_number() ?></span></div>
					<div class="col1-3"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?><p><?php the_author_posts_link(); ?></p></div>
					<div class="col1-3"><h6 class="blog-date"><?php echo get_the_date(get_option( 'date_format' ));?></h6></div>
				</div> <!-- end pin-ecxt2 -->

</article>