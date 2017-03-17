<?php
/******************/
/**  Single Question
/******************/
get_header();
michigan_webnus_setViews(get_the_ID());
$content = get_the_content();
?>
<section class="container page-content" >
<hr class="vertical-space2">
<?php if( have_posts() ): while( have_posts() ): the_post(); 
?>
<div class="col-md-12 blgt1-top-sec"> 
	<h1 class="post-title-ps1"><?php the_title() ?></h1>
	<h6><?php the_time(get_option('date_format')) ?></h6>
</div>
<section class="col-md-12 lesson-content">
<article class="blog-single-post">
<div class="post-trait-w"> 
	<?php
		get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full', 'link_to_post' => false, ) ); 		
	?>
</div>
<div <?php post_class('post'); ?>>
<?php if($post->post_content){
echo '<p class="w-lesson-content">';
echo apply_filters( 'lifterlms_full_description', wptexturize( $post->post_content ) ); 
echo '</p>';
}	
endwhile;
endif;
?>

</div>
</article>
</section>
<!-- end-main-conten -->
<div class="white-space"></div>
</section>
<?php 
get_footer();
?>