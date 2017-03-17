<?php get_header(); ?>
<section id="headline" >
    <div class="container">
      <h2><?php the_title(); ?></h2>
    </div>
</section>
<section id="main-content" class="container">
	<section class="col-md-9 cntt-w">
		<article>
			<?php 
			if( have_posts() ): while( have_posts() ): the_post();
				the_content();
			endwhile;endif;
			?>
		</article>
	</section>
	<aside class="col-md-3 sidebar">
		<?php if(is_active_sidebar('buddypress-sidebar')) dynamic_sidebar('buddypress-sidebar'); ?>
	</aside>
</section>
<?php get_footer(); ?>