<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header( 'llms_shop' );
global $lifterlms_loop, $product;

if ( empty( $lifterlms_loop['loop'] ) ) {
	$lifterlms_loop['loop'] = 0; }
if ( empty( $lifterlms_loop['columns'] ) ) {
	$lifterlms_loop['columns'] = apply_filters( 'loop_memberships_columns', 4 ); }
$lifterlms_loop['loop']++;
$classes = array();
if ( 0 == ( $lifterlms_loop['loop'] - 1 ) % $lifterlms_loop['columns'] || 1 == $lifterlms_loop['columns'] ) {
	$classes[] = 'first'; }
if ( 0 == $lifterlms_loop['loop'] % $lifterlms_loop['columns'] ) {
	$classes[] = 'last'; }
?>

<section id="headline" style="">
	<div class="container">
			<h2 style="">
				<?php
					if ( is_search() ) {
						echo sprintf( esc_html__( 'Search Results: &ldquo;%s&rdquo;', 'michigan' ), get_search_query() );
					if ( get_query_var( 'paged' ) ) {
						echo sprintf( esc_html__( '&nbsp;&ndash; Page %s', 'michigan' ), get_query_var( 'paged' ) ); }
					} elseif ( is_tax() ) {
						echo single_term_title( '', false );
					}else{
						echo esc_html__('All Memberships','michigan');
					}
				?>
			</h2>
	</div>
</section>

<main class="container content llms-content w-membership" role="main">
<hr class="vertical-space2">
	<aside class="col-md-3">
	<?php //do_action( 'lifterlms_sidebar' ); ?>
		<div class="filter-category">
		<div class="widget widget_michigan_course_categories">
			<h3> <?php esc_html_e('FILTER CATEGORIES','michigan'); ?> </h3>
			<?php
			$m_cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'id',
			'order'			=> 'ASC',
			'hide_empty'	=> false,
			'hierarchical'	=> 1,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> 'membership_cat',
			'pad_counts'	=> false,
			);
			$m_categories	= get_categories( $m_cat_args );
			if ( ! empty( $m_categories ) && ! is_wp_error( $m_categories ) ){
				echo '<ul class="course-categories">';
					echo '<li class="course-category">
							<a class="hcolorf" href="' . esc_url( get_site_url() ) . '/memberships/" title="' . esc_attr( 'View all Categories', 'michigan' ). '"> <i class="fa-group"></i> ' . esc_html__('All Memberships','michigan'). '</a>
						</li>';
				foreach ( $m_categories as $m_category ) :
					if(function_exists('tax_icons_output_term_icon')){
						$cat_icon =  tax_icons_output_term_icon( $m_category->term_id );
					}else{
						$cat_icon = '';
					}
					echo '
						<li class="course-category">
							<a class="hcolorf" href="' . esc_url( get_category_link( $m_category ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all courses under %s', 'michigan' ), $m_category->name ) ) . '">'. $cat_icon . esc_html( $m_category->name ) .'<span> (' . $m_category->count . ')</span>' . '</a>
						</li>';
				endforeach;
			echo '</ul>';
			}
			?>
		</div>
		</div>
		<hr class="vertical-space">
	</aside>
	<div id="page-<?php the_ID(); ?>" class="col-md-9" >
	<?php do_action( 'lifterlms_archive_description' );
	if ( have_posts() ) {
		//do_action( 'lifterlms_before_memberships_loop' );
		//lifterlms_membership_loop_start(); ?>
		</ul>
		<div class="modern-grid llms-course-list">
		<?php
			$rcount=1;
			$row=3;
			while ( have_posts() ) : the_post();
			echo ($rcount == 1)?'<div class="row">':''; ?>
				<div <?php post_class( 'col-md-4' ); ?>>
					<div class="llms-course-link">
						<?php do_action( 'lifterlms_before_memberships_loop_item' ); ?>

					<?php
					if (get_option( 'redirect_to_checkout' ) == 'yes') {

						$product = new LLMS_Product( get_the_ID() );
						$single_price = $product->get_single_price();
						$rec_price = $product->get_recurring_price();

						if ( ! is_user_logged_in() ) {
							$account_url = get_permalink( llms_get_page_id( 'myaccount' ) );
							$account_redirect = add_query_arg( 'product-id', get_the_ID(), $account_url );
							?>
							<a class="llms-membership-link" href="<?php echo esc_url($account_redirect); ?>">
							<?php
						}
						elseif ( ! llms_is_user_member( get_current_user_id(), get_the_ID() ) ) {
							if ($single_price > 0 || $rec_price > 0) {
								?>
								<a class="llms-membership-link" href="<?php echo esc_url($product->get_checkout_url()); ?>">
								<?php
							}
							else {
								?>
								<form action="" method="post" id="hiddenform">
									<input type="hidden" name="payment_option" value="none_0" />
									<input type="hidden" name="product_id" value="<?php echo $product->id; ?>" />
									<input type="hidden" name="product_price" value="<?php echo $product->get_price(); ?>" />
									<input type="hidden" name="product_sku" value="<?php echo $product->get_sku(); ?>" />
									<input type="hidden" name="product_title" value="<?php echo $post->post_title; ?>" />

									<input id="payment_method_<?php echo 'none' ?>" type="hidden" name="payment_method" value="none" />
									<?php wp_nonce_field( 'create_order_details' ); ?>
									<input type="hidden" name="action" value="create_order_details" />
								</form>
								<a class="llms-membership-link" onclick="document.getElementById('hiddenform').submit();" href="#">
								<?php
							}
						}
					} else { }
							global $post;
								if (get_the_terms($post->ID, 'membership_cat' )) {
									echo '<div class="modern-cat">';
									$categories = get_the_terms($post->ID, 'membership_cat' );
									$typeName = array();
									foreach ( $categories as $category ) :
										if(function_exists('tax_icons_output_term_icon')){
											$cat_icon =  tax_icons_output_term_icon( $category->term_id );
										}else{
											$cat_icon = '';
										}

										$typeName[] = '<a class="hcolorf" href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all memberships under %s', 'michigan' ), $category->name ) ) . '">'. $cat_icon . esc_html( $category->name ). '</a>';

									endforeach;
									echo implode(', ', $typeName);
									echo '</div>';
								}
							?>
							<div class="modern-feature"><a class="" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail( $post->ID ) ) {
								$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'michigan_webnus_blog2_img' );
								echo apply_filters( 'lifterlms_featured_img', '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />' );
							} elseif ( llms_placeholder_img_src() ) {
								$no_img = get_template_directory_uri().'/images/course_no_image.png';?>
								<?php echo apply_filters( 'lifterlms_placeholder_img', '<img src="' . $no_img . '" alt="Placeholder" class="llms-course-image llms-placeholder wp-post-image" />' );
							}
							echo '</a>';
							echo '</div>';
							?>
							<div class="modern-content">
							<h3 class="llms-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p> <?php echo michigan_webnus_excerpt(18); ?> </p>
							</div>

							<?php
							global $post;
							$llms_product = new LLMS_Product( $post->ID );
							if ( ! llms_is_user_enrolled( get_current_user_id(), $post->ID ) ){ ?>
							<div class="llms-price-wrapper">
								<?php foreach ( $llms_product as $option ):
									  if ( 'single' == $option || 'free' == $option ) { ?>
										<h4 class="llms-price"><span><?php echo apply_filters( 'lifterlms_single_payment_text', $llms_product->get_single_price_html(), $llms_product ); ?></span></h4>
									<?php }elseif ( $option == 'recurring' ){
											foreach ( $llms_product->get_subscriptions() as $id => $sub ) :
												if ( count( $llms_product->get_payment_options() ) > 1 ) { ?>
												<span class="llms-price-option-separator"><?php echo apply_filters( 'lifterlms_price_option_separator', esc_html__( 'or', 'michigan' ), $llms_product ); ?></span>
											<?php } ?>
											<h4 class="llms-price"><span><?php echo $llms_product->get_subscription_price_html( $sub ); ?></span></h4>
										<?php endforeach;
										}
										do_action( 'lifterlms_product_payment_option_'.$option, $llms_product );
									endforeach; ?>
							</div>
							<?php }
							do_action( 'lifterlms_after_memberships_loop_item' ); ?>
					</div>
				</div>
			<?php
			if($rcount == $row){
				echo '</div>';
				$rcount = 0;
			}
			$rcount++;
		 endwhile; // end of the loop.

		//lifterlms_membership_loop_end();
		do_action( 'lifterlms_after_memberships_loop' );
		if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
			echo '<div class="wp-pagenavi">';
			next_posts_link(esc_html__('&larr; Previous page', 'michigan'));
			previous_posts_link(esc_html__('Next page &rarr;', 'michigan'));
		}
		echo '</div>'; // end of if have post
		echo '<ul class="courses">';
	}else{
		llms_get_template( 'loop/no-courses-found.php' );
	}
	 ?>

	</div>
</main>

<?php get_footer(); ?>