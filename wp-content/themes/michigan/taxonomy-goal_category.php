<?php
get_header();
$michigan_webnus_options = michigan_webnus_options();
$goal_features = $michigan_webnus_options['michigan_webnus_goal_features'];
?>
<section id="headline"><div class="container"><h2><?php printf(  '%s', single_term_title( '', false ) ); ?></h2></div></section>
<section class="container page-content" ><hr class="vertical-space2">
<?php
echo '<section class="col-md-12 omega goals goals-list">';
if(have_posts()):
	while( have_posts() ): the_post();
		$progressbar = $goal_days = $goal_donate = '';
		$percentage = 0;
		$received = rwmb_meta( 'michigan_goal_amount_received_meta' ) ? rwmb_meta( 'michigan_goal_amount_received_meta' ) : 0;
		$amount = rwmb_meta( 'michigan_goal_amount_meta' );
		$end = rwmb_meta( 'michigan_goal_end_meta' );
		$currency = esc_html($michigan_webnus_options['michigan_webnus_currency']);
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
		$permalink = get_the_permalink();
		$content ='<p>'.michigan_webnus_excerpt(36).'</p>';
		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'michigan_webnus_blog2_img','echo'=>false, ) );
		$title = '<h4><a class="goal-title" href="'.$permalink.'">'.get_the_title().'</a></h4>';

?>
	<article id="post-<?php the_ID(); ?>">
	<div class="row">
		<div class="col-md-4">
			<?php echo ($image)?'<figure class="goal-img">'.$image.'</figure>':''; ?>
		</div>
		<div class="col-md-8">
			<?php
			echo '<div class="goal-content">'.$title;
			?>
			<div class="postmetadata">
				<ul class="goal-metadata">
				<?php if(isset($goal_features['date'])) { ?>
				<li class="goal-date"> <i class="fa-calendar-o"></i><span><?php the_time(get_option('date_format')) ?></span> </li>
				<?php } ?>
				<?php if(isset($goal_features['category'])) { ?>
				<li class="goal-cats"> <i class="fa-folder"></i><span><?php the_terms(get_the_id(), 'goal_category', '',' | ','' ); ?></span> </li>
				<?php } ?>
				<?php if(isset($goal_features['views'])) { ?>
				<li  class="goal-views"> <i class="fa-eye"></i><span><?php echo michigan_webnus_getViews(get_the_ID()); ?></span><?php esc_html_e(' Views','michigan');?></li>
				<?php } ?>
				</ul>
			</div>
			<?php echo $content.'<div class="goal-meta">'.$progressbar;
			if($days_left>=0 && $percentage<100 && $michigan_webnus_options['michigan_webnus_donate_form']){
				echo michigan_webnus_modal_donate();
			}else{
				echo '<p class="goal-completed">'.esc_html__('Has been completed','michigan').'</p>';
			}
			if($michigan_webnus_options['michigan_webnus_goal_social_share']) { ?>
			<div class="goal-sharing">
				<div class="goal-social">
				<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><i class="goal-sharing-icon fa-facebook"></i></a>
				<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="goal-sharing-icon fa-google-plus"></i></a>
				<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="goal-sharing-icon fa-twitter"></i></a>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
	</article>
<?php
	endwhile;
endif;

if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
	echo '<div class="wp-pagenavi">';
	next_posts_link(esc_html__('&larr; Previous page', 'michigan'));
	previous_posts_link(esc_html__('Next page &rarr;', 'michigan'));
	echo '<hr class="vertical-space">';
} ?>
</section>

</section>
<?php get_footer(); ?>