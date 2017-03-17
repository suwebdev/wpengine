<?php get_header(); ?>

<!-- Start Page Content -->
<section id="main-content" class="container">
	<div class="row-wrapper-x">
		<?php
			if( have_posts() ): while( have_posts() ): the_post();
				the_content();
			endwhile; endif;
		?>
	</div>
</section>

<?php get_footer(); ?>