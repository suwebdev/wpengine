 <?php
/******************/
/**  Single Post
/******************/
get_header();
$michigan_webnus_options = michigan_webnus_options();

//PostShow1
$post_meta = rwmb_meta( 'michigan_blogpost_meta' );
if(!empty($post_meta)){
	if($post_meta=="postshow1" && $thumbnail_id = get_post_thumbnail_id()){
		$background = wp_get_attachment_image_src( $thumbnail_id, 'full' ); ?>
		<div class="postshow1" style="background-image: url(<?php echo esc_url($background[0]); ?> );">
			<div class="postshow-overlay"></div>
			<div class="container"><h1 class="post-title-ps1"><?php the_title() ?></h1></div>
		</div>
<?php }
}
?>


<section class="container page-content" >
<hr class="vertical-space2">
<?php if( 'left' == $michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar'] ){ ?>
	<aside class="col-md-3 sidebar leftside">
		<?php if(is_active_sidebar('Left Sidebar')) dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php } ?>
	<div class="<?php echo ( 'none' == $michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar']  )?'col-md-12':'col-md-9 cntt-w'?>">
		<div class="wsingleblog">
		<div class="container">
			<section class="col-md-12">
				<?php if( have_posts() ): while( have_posts() ): the_post();  ?>
					<article class="wsingleblog-post">
					<?php
					michigan_webnus_setViews(get_the_ID());
					$post_format = get_post_format(get_the_ID());
					$content = get_the_content(); ?>
						<div class="post-trait-w">
					<?php
					if(  $michigan_webnus_options['michigan_webnus_blog_sinlge_featuredimage_enable'] && !isset($background) ){
					$meta_video = rwmb_meta( 'michigan_featured_video_meta' );
					if( 'video'  == $post_format || 'audio'  == $post_format){
					$pattern = '\\[' . '(\\[?)' . "(video|audio)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
					preg_match('/'.$pattern.'/s', $post->post_content, $matches);
					if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))){
					$video = $matches[0];
					echo do_shortcode($video);
					$content = preg_replace('/'.$pattern.'/s', '', $content);
					}else
					if( (!empty( $meta_video )) ){
					echo do_shortcode($meta_video);}
					}else
					if( 'gallery'  == $post_format)	{
					$pattern = '\\[' . '(\\[?)' . "(gallery)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
					preg_match('/'.$pattern.'/s', $post->post_content, $matches);
					if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))){
					$atts = shortcode_parse_atts($matches[3]);
					$ids = $gallery_type = '';
					if(isset($atts['ids'])){
					$ids = $atts['ids'];}
					if(isset($atts['michigan_webnus_gallery_type'])){
					$gallery_type = $atts['michigan_webnus_gallery_type'];}
					echo do_shortcode('[vc_gallery img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'" onclick="link_image" custom_links_target="_self"]');
					$content = preg_replace('/'.$pattern.'/s', '', $content);}
					}else
					if( (!empty( $meta_video )) ){
					echo do_shortcode($meta_video);
					}else
					get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full', 'link_to_post' => false, ) ); }
					?>
					<?php
					if(!isset($background)) { ?>
							<h1 class="post-title-ps1"><?php the_title() ?></h1>
					<?php } ?>
						</div>
						<div <?php post_class('post'); ?>>
							<div class="postmetadata">
								<?php if($michigan_webnus_options['michigan_webnus_blog_meta_category_enable']){ ?>
									<h6 class="blog-cat"><?php the_tags( '', ' ', '' ); ?></h6>
								<?php } ?>
									<h6 class="blog-date"> <?php the_time(get_option('date_format')) ?></h6>
							</div>
							<?php
							if( 'quote' == $post_format  ) echo '<blockquote>';
							echo apply_filters('the_content',$content);
							if( 'quote' == $post_format  ) echo '</blockquote>';
							?>
							<br class="clear">
						</div>
					</article>
				<?php endwhile; endif;?>
			</section>
		</div>
		<?php comments_template(); ?>

	</div>

</div>
	<?php if($michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar'] == 'right' ){ ?>
	<aside class="col-md-3 sidebar ">
		<?php if(is_active_sidebar('Right Sidebar')) dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
	<?php } ?>
</section>
<?php
get_footer();
?>