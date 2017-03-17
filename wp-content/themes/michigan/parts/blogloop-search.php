<?php $michigan_webnus_options = michigan_webnus_options(); ?>
<article id="post-<?php the_ID(); ?>" class="blog-post">

	<div class="col-md-11 alpha omega">
	  <h3 class="post-title-ps1"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
	  <div class="postmetadata">
		<h6 class="blog-date"> <?php the_time(get_option('date_format')) ?> | </h6>
		<?php if($michigan_webnus_options['michigan_webnus_blog_meta_author_enable']) { ?>
		<h6 class="blog-author"><strong><?php esc_html_e('posted by','michigan'); ?></strong> <?php the_author_posts_link(); ?> </h6>
		<?php } ?>
		<?php if($michigan_webnus_options['michigan_webnus_blog_meta_category_enable']) { ?>
		<h6 class="blog-cat"><strong><?php esc_html_e('in','michigan'); ?></strong> <?php the_category(', ') ?> </h6>
		<?php } ?>
		<?php if($michigan_webnus_options['michigan_webnus_blog_meta_comments_enable']) { ?>
		<h6 class="blog-comments"><strong> - </strong> <?php comments_number(  ); ?> </h6>
		<?php } ?>
	  </div>
	 <p>
	  <?php
		echo michigan_webnus_excerpt(($michigan_webnus_options['michigan_webnus_blog_excerpt_list'])?$michigan_webnus_options['michigan_webnus_blog_excerpt_list']:35);
	  ?>
	  </p>
	  </div>
	<hr class="vertical-space1">
</article>