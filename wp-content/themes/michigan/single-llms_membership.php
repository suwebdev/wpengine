<?php
/******************/
/**  Single Course
/******************/
get_header();
$michigan_webnus_options = michigan_webnus_options();

$llms_product = new LLMS_Product( $post->ID );
$course_features = $michigan_webnus_options['michigan_webnus_course_features'];
?>
<section class="container page-content">
<hr class="vertical-space2">
<?php
	if($michigan_webnus_options['michigan_webnus_enable_breadcrumbs'] ) {
		//Breadcrumb
		$homeLink = esc_url(home_url('/'));
		$post_type = get_post_type_object(get_post_type());
		$slug = $post_type->rewrite;
		echo '<div class="breadcrumbs-w"><div class="container"><div id="crumbs"><a href="'.$homeLink.'">'.esc_html__('Home','michigan').'</a> <i class="fa-angle-right"></i><a href="' . $homeLink .  $post_type->rewrite['slug'] . '/">' . $post_type->labels->name . '</a> <i class="fa-angle-right"></i> <span class="current">'.get_the_title().'</span></div></div></div>';
	}
?>
<div class="course-main">
<?php if( have_posts() ): while( have_posts() ): the_post();
llms_print_notices();
?>
<div class="col-md-12 post-trait-w">
	<h1 class="post-title-ps1"><?php the_title() ?></h1>
	<?php //Course Price
		if(isset($course_features['price']) && $course_features['price']){
			echo '<div class="w-course-price">';
			course_price();
			echo '</div>';
		}
	?>
</div>
<section class="col-md-9 course-content cntt-w">
<article class="course-single-post">
	<div class="post-thumbnail">
		<div class="llms-featured-image">
			<?php
			if ( has_post_thumbnail( $post->ID ) ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'michigan_webnus_latest_img' );
				echo apply_filters( 'lifterlms_featured_img', '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />' );
			} elseif ( llms_placeholder_img_src() ) {
				$no_img = get_template_directory_uri().'/images/course_no_image.png';
				echo apply_filters( 'lifterlms_placeholder_img', '<img src="' . $no_img . '" alt="Placeholder" class="llms-course-image llms-placeholder wp-post-image" />' );
			}
			?>
		</div>
	</div>
<?php
	michigan_webnus_setViews(get_the_ID());
	$content = get_the_content(); ?>
<div <?php post_class('post'); ?>>


<?php // content
	echo apply_filters('the_content',$content);
?>
<?php // social share
	if(isset($course_features['sharing']) && $course_features['sharing']) { ?>
	<div class="post-sharing"><div class="blog-social">
		<span><?php esc_html_e('Share','michigan');?>: </span>
		<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a>
		<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="fa-google"></i></a>
		<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a>
		<a class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source=<?php bloginfo( 'name' ); ?>"><i class="fa-linkedin"></i></a>
		<a class="email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><i class="fa-envelope"></i></a>
	</div></div>
<?php } ?>

</div>

<?php
$course_review= new LLMS_Reviews();
add_filter( 'webnus_course_after', array(  $course_review , 'output' ),30 );
do_action( 'webnus_course_after' );
?>

</article>
<?php
	endwhile;
	endif;
if(isset($course_features['comment']) && $course_features['comment']){
	comments_template();
} ?>
</section>
<div class="col-md-3 sidebar">
	<?php
	if ( ! defined( 'ABSPATH' ) ) { exit; }
	global $post, $product;
	if ( ! $product ) {$product = new LLMS_Product( $post->ID );}
	$memberships_required = get_post_meta( $product->id, '_llms_restricted_levels', true );
	?>
	<aside class="course-bar">
		<?php
		if(is_active_sidebar('membership-sidebar')) dynamic_sidebar( 'membership-sidebar' );
		?>

	</aside>
</div>
</div>
<!-- end-main-conten -->

<div class="white-space"></div>
</section>
<?php
	get_footer();
?>