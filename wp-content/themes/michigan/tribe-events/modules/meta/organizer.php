<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();

if ( tribe_get_organizer_label( ! $multiple ) ) {?>
<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<div class="w-single-event-organizer">
	<h3 class="tribe-events-single-section-title"><?php echo tribe_get_organizer_label( ! $multiple ); ?></h3>
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

			?>
			<dt style="display:none;"><?php // This element is just to make sure we have a valid HTML ?></dt>
			<dd class="tribe-organizer">
				<?php echo '<i class="fa fa-home"></i><h6>'.tribe_get_organizer_link( $organizer ).'</h6>' ?>
			</dd>
			<?php
		}

		if ( ! $multiple ) { // only show organizer details if there is one
			if ( ! empty( $phone ) ) {
				?>
				
					<i class="fa fa-phone"></i><h6><?php esc_html_e( 'Phone', 'michigan' ) ?></h6>
				
				<dd class="tribe-organizer-tel">
					<?php echo esc_html( $phone ); ?>
				</dd>
				<?php
			}//end if

			if ( ! empty( $email ) ) {
				?>
				<i class="fa fa-envelope"></i><h6><?php esc_html_e( 'Email', 'michigan' ) ?></h6>

				<dd class="tribe-organizer-email">
					<?php echo esc_html( $email ); ?>
				</dd>
				<?php
			}//end if

			if ( ! empty( $website ) ) {
				?>
				
					<i class="fa fa-sitemap"></i><h6><?php esc_html_e( 'Website', 'michigan' ) ?></h6>
				
				<dd class="tribe-organizer-url">
					<?php echo $website; ?>
				</dd>
				<?php
			}//end if
		}//end if
		echo'</div>';
		do_action( 'tribe_events_single_meta_organizer_section_end' );
		?>
</div>
<?php } ?>
