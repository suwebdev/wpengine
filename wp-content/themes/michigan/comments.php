<div class="comments-wrap" id="comments">
<div class="commentbox">
<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
<p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.','michigan'); ?></p>
<?php
return;
}
?>
<div class="post-bottom-section">
<div class="right">
<?php if ( have_comments() ) : ?>
<h4 class="comments-title">
<strong><?php esc_html_e('Comments','michigan'); ?></strong>
</h4>
<div class="navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>
<ol class="commentlist">
<?php wp_list_comments('callback=michigan_webnus_comments'); ?>
</ol>
<div class="navigation">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>
<?php endif; // have_comments() ?>
<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :	?>
<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'michigan' ); ?></p>
<?php endif; ?>
</div>
</div>
<?php comment_form(); ?>
</div>
</div>