<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$michigan_webnus_options = michigan_webnus_options();
$event_id = get_the_ID();
?>
<div id="tribe-events-content" class="tribe-events-single vevent hentry">
<?php tribe_the_notices() ?>
<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>></div>
	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="col-md-8">
				<?php echo tribe_event_featured_image( $event_id, 'michigan_webnus_latest_img', false ); ?>
				<div class="w-event-content">
					<?php the_title( '<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>' ); ?>
					<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
					<div class="tribe-events-single-event-description tribe-events-content entry-content description">
						<?php the_content(); ?>
					</div>
					<?php echo tribe_meta_event_tags( esc_html__( 'Event Tags','michigan'), ' ', false ) ?>
					<?php
						do_action( 'tribe_events_single_event_after_the_content' );
						echo '<div class="w-rsvp" style="margin-top: 20px">';
						do_action( 'tribe_events_single_event_after_the_meta' );
						echo '</div>';
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="w-event-meta">
					<?php
					tribe_get_template_part( 'modules/meta/details' );
					if ( tribe_get_venue_id() ) {
					$phone = tribe_get_phone();
					?>
					<div class="tribe-events-meta-group tribe-events-meta-group-venue">
						<div class="w-single-event-location">
						<h3 class="tribe-events-single-section-title te-location"> <?php esc_html_e( 'Location', 'michigan' ) ?></h3>

							<?php do_action( 'tribe_events_single_meta_venue_section_start' ) ?>
							<dd class="author fn org"> <?php echo tribe_get_venue() ?> </dd>

							<?php
							$address = tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : '';
							if ( ! empty( $address ) ) {
								echo '<dd class="location">' . "$address</dd></div>";
							}
							?>

							<?php if ( ! empty( $phone ) ): ?>
							<div class="w-single-event-phone">
								<h3 class="te-phone"> <?php esc_html_e( 'Phone', 'michigan' ); ?></h3>
								<dd class="tel"> <?php echo esc_attr($phone);?> </dd>
							</div>
							<?php endif;
							do_action( 'tribe_events_single_meta_venue_section_end' ) ?>

					</div>
					<?php
					}
					if ( tribe_has_organizer() ) {
						tribe_get_template_part( 'modules/meta/organizer' );
					}
					if($michigan_webnus_options['michigan_webnus_booking_enable']){
						$form_id=$michigan_webnus_options['michigan_webnus_booking_form'];
						$id = get_the_ID();
						$title = get_the_title();
						michigan_webnus_modal_booking($id,$form_id,$title);
					}
					echo '</div>';?>
					<div class="w-event-social w-event-meta">
						<h3 class="tribe-events-single-section-title"><?php esc_html_e( 'Share this event', 'michigan' ) ?></h3>
						<div class="event-sharing">
							<div class="sharing-box">
							<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a>
							<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="fa-google"></i></a>
							<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a>
							<a class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;source=<?php bloginfo( 'name' ); ?>"><i class="fa-linkedin"></i></a>
							<a class="email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><i class="fa-envelope"></i></a>
							</div>
						</div>
					</div>
					<?php echo '<div class="tribe-events-meta-group tribe-events-meta-group-gmap">';
					tribe_get_template_part( 'modules/meta/map' );
					echo '</div>';
					?>
			</div>
		</div>
	<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>
</div>