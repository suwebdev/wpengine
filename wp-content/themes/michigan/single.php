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
	<?php if( $michigan_webnus_options['michigan_webnus_blog_sinlge_nextprev_enable']){ ?>
	<div class="col-md-6 col-sm-6 w-prev-article">
		<?php previous_post_link('%link', '<span class="colorf">'.esc_html__('Previous Article','michigan').'</span><strong>%title</strong>'); ?>
	</div>
	<div class="col-md-6 col-sm-6 w-next-article">
		<?php next_post_link('%link', '<span  class="colorf">'.esc_html__('Next Article','michigan').'</span><strong>%title</strong>'); ?>
	</div>
	<?php } ?>
<hr class="vertical-space2">
<?php if( 'left' == $michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar'] ){ ?>
	<aside class="col-md-3 sidebar leftside">
		<?php if(is_active_sidebar('Left Sidebar')) dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php } ?>
<section class="<?php echo ( 'none' == $michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar']  )?'col-md-12':'col-md-9 cntt-w'?>">
<?php if( have_posts() ): while( have_posts() ): the_post();  ?>
<article class="blog-single-post">
	<?php
	michigan_webnus_setViews(get_the_ID());
	$post_format = get_post_format(get_the_ID());
	$content = get_the_content(); ?>
	<div class="post-trait-w"> <?php
	if(!isset($background)) { ?>
		<div class="blgt1-top-sec">
			<?php
			if(function_exists('wp_review_show_total')){wp_review_show_total(true, 'review-total-only small-thumb');}
				if(  $michigan_webnus_options['michigan_webnus_blog_posttitle_enable'] ) {
					if( ('aside' != $post_format ) && ('quote' != $post_format)  ) {
						if( 'link' == $post_format ) {
							preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
							$content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
							$link ='';
							if(isset($matches) && is_array($matches)) $link = $matches[0]; ?>
							<h1 class="post-title-ps1"><?php the_title() ?></h1> <?php
						} else { ?>
							<h1 class="post-title-ps1"><?php the_title() ?></h1> <?php
			}}}?>
		</div>
 <?php }
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
</div>
<div <?php post_class('post'); ?>>
<div class="au-avatar-box">
<?php if($michigan_webnus_options['michigan_webnus_blog_meta_gravatar_enable']){ ?>
<div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div>
<?php } ?>
<?php if($michigan_webnus_options['michigan_webnus_blog_meta_author_enable']){ ?>
<h6 class="blog-author"><strong><?php esc_html_e('by','michigan'); ?></strong> <?php the_author_posts_link(); ?> </h6>
<?php } ?>
</div>

<div class="postmetadata">
	<?php if($michigan_webnus_options['michigan_webnus_blog_meta_date_enable']){ ?>
	<h6 class="blog-date"> <?php the_time(get_option('date_format')) ?></h6>
	<?php } ?>
	<?php if($michigan_webnus_options['michigan_webnus_blog_meta_category_enable']){ ?>
		<h6 class="blog-cat"><strong><?php esc_html_e('in','michigan'); ?></strong> <?php the_category(', ') ?> </h6>
	<?php } ?>
	<?php if($michigan_webnus_options['michigan_webnus_blog_meta_comments_enable']){ ?>
		<h6 class="blog-comments"> <?php comments_number(  ); ?> </h6>
	<?php } ?>
	<?php if($michigan_webnus_options['michigan_webnus_blog_meta_views_enable']){ ?>
		<h6 class="blog-views"> <i class="fa-eye"></i><span class="colorb"><?php echo michigan_webnus_getViews(get_the_ID()); ?></span> </h6>
	<?php } ?>
</div>

<?php
if( 'quote' == $post_format  ) echo '<blockquote>';
echo apply_filters('the_content',$content);
if( 'quote' == $post_format  ) echo '</blockquote>';
?>

<?php if($michigan_webnus_options['michigan_webnus_blog_social_share']) { ?>
	<div class="post-sharing"><div class="blog-social">
		<span>Share</span>
		<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a>
		<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="fa-google"></i></a>
		<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a>
		<a class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source=<?php bloginfo( 'name' ); ?>"><i class="fa-linkedin"></i></a>
		<a class="email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><i class="fa-envelope"></i></a>
	</div></div>
<?php } ?>

<br class="clear">
<?php the_tags( '<div class="post-tags"><i class="fa-tags"></i>', '', '</div>' ); ?><!-- End Tags -->
<div class="next-prev-posts">
<?php $args = array(
'before'           => '',
'after'            => '',
'link_before'      => '',
'link_after'       => '',
'next_or_number'   => 'next',
'nextpagelink'     => '&nbsp;&nbsp; '.esc_html__('Next Page','michigan'),
'previouspagelink' => esc_html__('Previous Page','michigan').'&nbsp;&nbsp;',
'pagelink'         => '%',
'echo'             => 1
);
wp_link_pages($args);
?>

</div><!-- End next-prev post -->

<?php if( $michigan_webnus_options['michigan_webnus_blog_single_authorbox_enable'] ) { ?>
	<div class="about-author-sec">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
		<h5><?php the_author_posts_link(); ?></h5>
		<p><?php echo get_the_author_meta( 'description' ); ?></p>
	</div>
<?php  }


endwhile;
endif;

?>


<?php if($michigan_webnus_options['michigan_webnus_recommended_posts']) {
	$tags = wp_get_post_tags($post->ID);
	$tag_ids = array();
	foreach($tags as $individual_tag)
	$tag_ids[] = $individual_tag->term_id;
	$cats = wp_get_post_categories($post->ID);
	$post_ids = array();
	$post_ids[] = $post->ID;
	$args = array(
		'post__not_in' => $post_ids,
		'showposts' => 3,
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'post_tag',
				'field' => 'id',
				'terms' => $tag_ids,
			),
			array(
				'taxonomy' => 'category',
				'field' => 'cat_ID',
				'terms' => $cats,
			),
		)
	);
	$my_query = new wp_query($args);
	if($my_query->have_posts()){
		echo '<div class="container rec-posts"><div class="col-md-12"><h3 class="rec-title">'. esc_html__('Recommended Posts','michigan') .'</div></h3>';
		while ($my_query->have_posts()){
			$my_query->the_post();
			$post_ids[] = $post->ID;
?>
			<div class="col-md-4 col-sm-4"><article class="rec-post">
				<figure><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'michigan_webnus_blog2_img' ) ); ?></figure>
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<p><?php the_time(get_option('date_format')) ?> </p>
			</article></div>
		<?php }
	}
	else
		echo '<div class="container rec-posts"><div class="col-md-12"><h3 class="rec-title">'. esc_html__('Recent Posts','michigan') .'</div></h3>';
wp_reset_postdata();

$rel_count = $my_query->found_posts;
if ($rel_count < 3){
$rec_count = 3 - $rel_count;
$args = array(
		'post__not_in' => $post_ids,
		'showposts' => $rec_count,
		);
$rec_query = new wp_query($args);
	if($rec_query->have_posts()){
		while ($rec_query->have_posts()){
		$rec_query->the_post();
?>
			<div class="col-md-4 col-sm-4"><article class="rec-post">
				<figure><?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'michigan_webnus_blog2_img' ) ); ?></figure>
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<p><?php the_time(get_option('date_format')) ?> </p>
			</article></div>
		<?php }
		echo '</div>';
	}
}
}
?>

</div>
</article>
<?php
comments_template(); ?>
</section>
<!-- end-main-conten -->

<?php if($michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar'] == 'right' ){ ?>
	<aside class="col-md-3 sidebar">
		<?php if(is_active_sidebar('Right Sidebar')) dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
<?php } ?>
<div class="white-space"></div>
</section>
<?php
get_footer();
?>