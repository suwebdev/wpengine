<?php get_header();
$michigan_webnus_options = michigan_webnus_options(); ?>
<section class="container page-content" >
<hr class="vertical-space">
<?php if($michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar'] == 'left' ){ ?>
	<aside class="col-md-3 sidebar leftside">
		<?php if(is_active_sidebar('Left Sidebar')) dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php } ?>
<section class="col-md-8 omega">
  <article class="blog-single-post">
	<?php
	$post_format = get_post_format(get_the_ID());
	$content = get_the_content();
	if( have_posts() ): while( have_posts() ): the_post(); ?>
	<div <?php post_class('post'); ?>>
	  <h1 class="post-title-ps1"><?php the_title() ?></h1>
		<?php if( wp_attachment_is_image(get_the_ID() )){
			$att_image = wp_get_attachment_image_src( $post->id, "full");
			if(is_array($att_image))
				echo '<img src="'. $att_image[0] .'" />';
		} ?>
	</div>
	<?php endwhile;
	 endif; ?>
  </article>
  <?php comments_template(); ?>
</section>
<?php if($michigan_webnus_options['michigan_webnus_blog_singlepost_sidebar'] == 'right' ){ ?>
	<aside class="col-md-3 sidebar">
		<?php if(is_active_sidebar('Right Sidebar')) dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
<?php } ?>
<div class="vertical-space3"></div>
</section>
<?php get_footer(); ?>