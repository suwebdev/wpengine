<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
$michigan_webnus_options = michigan_webnus_options();
$venue_details = array();

if ( $venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
	$venue_details[] = $venue_name;
}

if ( $venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
	$venue_details[] = $venue_address;
}
// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( $venue_address ) ? ' location' : '';
$ddate = tribe_get_start_date(null,false,'d');
$mdate = tribe_get_start_date(null,false,'F');
?>
<div class="row">
	<div class="col-md-3">
	<!-- Event Image -->
		<?php echo tribe_event_featured_image( null, 'michigan_webnus_square_img' ) ?>

	</div>
	<div class="col-md-6">
		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ) ?>
		<h2 class="tribe-events-list-event-title entry-title summary">
			<a class="url" href="<?php echo esc_url($permalink); ?>" title="<?php the_title() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</h2>
		<?php do_action( 'tribe_events_after_the_event_title' ) ?>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ) ?>
		<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
		<?php $content = get_the_content();
		$content = strip_tags($content);
		echo substr($content,0,300);?>

			<div><a href="<?php echo esc_url($permalink); ?>" class="tribe-events-read-more colorf" rel="bookmark"><?php esc_html_e( 'Find out more', 'michigan' ) ?> &raquo;</a></div>
		</div><!-- .tribe-events-list-event-description -->
		<?php do_action( 'tribe_events_after_the_content' ) ?>

		<!-- Event Social -->
		<ul class="event-sharing">
			<li class="event-share"><i class="event-sharing-icon fa-share-alt"></i>
			<ul class="event-social">
				<li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink ;?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a></li>
				<li><a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php echo $permalink ;?>" target="_blank"><i class="fa-google-plus"></i></a></li>
				<li><a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php echo $permalink ;?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo $permalink ;?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a></li>
			</ul></li>
			<li class="event-map"><a class="fancybox-media" href="<?php echo esc_url(tribe_get_map_link($id));?>"><i class="fa-map-marker"></i></a></li>
			<li><a class="inlinelb" href="#w-contact"><i class="fa-envelope-o"></i></a></li>
		</ul>
	</div>
	<div class="col-md-3">
		<!-- Event Meta -->
		<?php do_action( 'tribe_events_before_the_meta' ) ?>
		<div class="tribe-events-event-meta vcard colorr">
			<!-- Schedule & Recurrence Details -->
			<div class="updated published time-details">
			<?php
			echo '<span class="event-d">'.$ddate.'</span><span class="event-m">'.$mdate.'</span>'
			?>
			</div>
			<?php if ( tribe_get_cost() ) : ?>
			<div class="tribe-events-event-cost day-events">
				<span><?php echo tribe_get_cost( null, true ); ?></span>
			</div>
			<?php endif; ?>
			<div class="author <?php echo $has_venue_address; ?>">
				<?php if ( $venue_details ) : ?>
					<!-- Venue Display Info -->
					<div class="tribe-events-venue-details">
						<?php echo implode( ', ', $venue_details ); ?>
					</div> <!-- .tribe-events-venue-details -->
				<?php endif; ?>
			</div>
		</div><!-- .tribe-events-event-meta -->
		<?php do_action( 'tribe_events_after_the_meta' ) ?>

		<?php
			if($michigan_webnus_options['michigan_webnus_booking_enable']){
				$form_id= $michigan_webnus_options['michigan_webnus_booking_form'];
				$id = get_the_ID();
				$title = get_the_title();
				echo '<div class="btn-wrapper">';
				michigan_webnus_modal_booking($id,$form_id,$title);
				echo '</div>';
			}
		?>

	</div>
<!-- Event Cost -->

</div>
<?php do_action( 'tribe_events_after_the_content' ) ?>
