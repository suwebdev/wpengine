<?php
/******************/
/**  Single Goal
/******************/
get_header();
$michigan_webnus_options = michigan_webnus_options();
$goal_features = $michigan_webnus_options['michigan_webnus_goal_features'];
?>
<section class="container page-content" >
<hr class="vertical-space2">
<?php
$progressbar = $goal_days = $goal_donate = '';
$percentage = 0;
$received = rwmb_meta( 'michigan_goal_amount_received_meta' ) ? rwmb_meta( 'michigan_goal_amount_received_meta' ) : 0;
$amount = rwmb_meta( 'michigan_goal_amount_meta' );
$end = rwmb_meta( 'michigan_goal_end_meta' );
$currency = $michigan_webnus_options['michigan_webnus_currency'];
if($amount) {
	$percentage = ($received/$amount)*100;
	$percentage = round($percentage);
	$out=$percentage.'% DONATED OF '.$currency.$amount;
	$progressbar = do_shortcode('[vc_progress_bar values="'.$percentage.'|'.$out.'" bgcolor="custom" options="striped,animated" custombgcolor="#d0ae5e"]');
}
$now = date('Y-m-d 23:59:59');
$now = strtotime($now);
$end_date = $end.' 23:59:59';
$your_date = strtotime($end_date);
$datediff = $your_date - $now;
$days_left = floor($datediff/(60*60*24));
$date_msg = '';
if($days_left==0) {$date_msg = '1';}
elseif($days_left<0) {$date_msg = 'No';}
else {$date_msg = $days_left+'1'.'';}
$goal_days = ($percentage<100)?'<span>'.$date_msg.'</span> '.esc_html__('Days left to achieve target','michigan'):esc_html__('Thank You','michigan');
if($michigan_webnus_options['michigan_webnus_singlegoal_sidebar'] == '1'){ ?>
	<aside class="col-md-3 sidebar leftside">
		<?php if(is_active_sidebar('Left Sidebar')) dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php } ?>
<section class="<?php echo ($michigan_webnus_options['michigan_webnus_singlegoal_sidebar']=='0')?'col-md-12':'col-md-9 cntt-w'?>">
<?php if( have_posts() ): while( have_posts() ): the_post();  ?>
<article class="blog-single-post">
<?php
michigan_webnus_setViews(get_the_ID());
$content = get_the_content(); ?>
<div class="post-trait-w"> <?php
if(!isset($background)) { ?>
<h2 class="goal-title"><?php the_title() ?></h2> <?php }
?>
</div>
<div <?php post_class('post'); ?>>
<div class="row">
	<div class="col-md-8">
	<div class="postmetadata">
		<ul class="goal-metadata">
		<?php if(isset($goal_features['date']) && $goal_features['date']) { ?>
		<li class="goal-date"> <i class="fa-calendar-o"></i><span><?php the_time(get_option('date_format')) ?></span> </li>
		<?php }
		if(isset($goal_features['category']) && $goal_features['category']) {
		?>
		<li class="goal-cats"> <i class="fa-folder"></i><span><?php the_terms(get_the_id(), 'goal_category', '',' | ','' ); ?></span> </li>
		<?php }
		if(isset($goal_features['views']) && $goal_features['views']) { ?>
		<li  class="goal-views"> <i class="fa-eye"></i><span><?php echo michigan_webnus_getViews(get_the_ID()); ?></span><?php esc_html_e(' Views','michigan');?></li>
		<?php } ?>
		</ul>
	</div>
		<?php
		if( isset($goal_features['category']) && $goal_features['category'] && !isset($background) ){
		get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full', 'link_to_post' => false, ) );
		}
		echo apply_filters('the_content',$content);
		?>
	</div>
	<div class="col-md-4">
	<div class="goal-box">
	<?php
		echo $progressbar.'<p class="goal-days">'.$goal_days.'</p>';
		if($days_left>=0 && $percentage<100 && $michigan_webnus_options['michigan_webnus_donate_form']){
			echo michigan_webnus_modal_donate();
		}else{
			echo '<p class="goal-completed">'.esc_html__('Has been completed','michigan').'</p>';
		}
		if(isset($goal_features['sharing']) && $goal_features['sharing']) {
		?>
			<div class="goal-sharing">
				<i class="goal-sharing-icon fa-share-alt"></i>
				<div class="goal-social">
				<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><?php esc_html_e('FACEBOOK','michigan');?></a>
				<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><?php esc_html_e('GOOGLE+','michigan');?></a>
				<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><?php esc_html_e('TWITTER','michigan');?></a>
				</div>
			</div>
		<?php } ?>
	</div>
	</div>
</div>
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

</div>
</article>
<?php
endwhile;
endif;
if(isset($goal_features['comment']) && $goal_features['comment']) {
 comments_template();
}
 ?>
</section>
<!-- end-main-conten -->

<?php
if($michigan_webnus_options['michigan_webnus_singlegoal_sidebar'] == '2' ){ ?>
	<aside class="col-md-3 sidebar">
		<?php if(is_active_sidebar('Right Sidebar')) dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
<?php } ?>

<div class="white-space"></div>
</section>
<?php
get_footer();
?>