<div class="tribe-events-meta-group tribe-events-meta-group-details">
	
	<dl>
		<?php
		do_action( 'tribe_events_single_meta_details_section_start' );

		$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
		$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

		$start_datetime = tribe_get_start_date();
		$start_date = tribe_get_start_date( null, false );
		$start_time = tribe_get_start_date( null, false, $time_format );
		$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

		$end_datetime = tribe_get_end_date();
		$end_date = tribe_get_end_date( null, false );
		$end_time = tribe_get_end_date( null, false, $time_format );
		$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			?>
			<div class="w-single-event-date">
				<h3> <?php esc_attr_e( 'Start','michigan') ?>: </h3>
				<dd>
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $start_ts) ?>"> <?php echo esc_html( $start_date) ?> </abbr>
				</dd>

				<h3> <?php esc_attr_e( 'End','michigan') ?>: </h3>
				<dd>
					<abbr class="tribe-events-abbr dtend" title="<?php echo esc_html( $end_ts) ?>"> <?php echo esc_html( $end_date) ?> </abbr>
				</dd>
			</div>
		<?php
		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
			?>
			<div class="w-single-event-date">
				<h3 class="te-date"> <?php esc_attr_e('Date','michigan') ?>: </h3>
				<dd>
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $start_ts) ?>"> <?php echo esc_html( $start_date) ?> </abbr>
				</dd>
			</div>
		<?php
		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
			?>
			<div class="w-tribe-events-meta-date">
			<h3 class="tribe-events-single-section-title"><?php esc_html_e('Date','michigan')?></h3>
			<i class="fa fa-calendar"></i> <h6><?php esc_attr_e( 'Start','michigan') ?></h6>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $start_ts) ?>"> <?php echo esc_html( $start_datetime) ?> </abbr>
			</dd>

			<i class="fa fa-calendar-o"></i> <h6><?php esc_attr_e('End','michigan') ?></h6>
			<dd>
				<abbr class="tribe-events-abbr dtend" title="<?php echo esc_html( $end_ts ) ?>"> <?php echo esc_html( $end_datetime) ?> </abbr>
			</dd>
			</div>
		<?php
		// Single day events
		else :
			?>
			<div class="w-single-event-date">
				<h3 class="te-date"> <?php esc_html_e( 'Date', 'michigan' ) ?></h3>
				<dd>
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html($start_ts) ?>"> <?php echo esc_html($start_date) ?> </abbr>
				</dd>
			</div>
			<div class="w-single-event-time">
			<h3 class="te-time"> <?php esc_html_e( 'Time', 'michigan' ) ?></h3>
				<dd>
					<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $end_ts) ?>">
						<?php if ( $start_time == $end_time ) {
							echo esc_html( $start_time);
						} else {
							echo esc_html($start_time . $time_range_separator . $end_time);
						} ?>
					</abbr>
				</dd>
			</div>

		<?php endif ?>

		<?php
		$cost = tribe_get_formatted_cost();
		if ( ! empty( $cost ) ):
			?>
			<div class="w-tribe-event-cost">
			<h3 class="te-cost"> <?php esc_html_e( 'Cost','michigan') ?></h3>
			<dd class="tribe-events-event-cost"> <?php echo esc_html($cost) ?> </dd>
			</div>
		<?php endif ?>
		<div class="w-single-event-category">
			<?php
				$events_label_singular = tribe_get_event_label_singular();
				$post_id = null; 
				$args = array();
				$post_id    = is_null( $post_id ) ? get_the_ID() : $post_id;
				$defaults   = array(
					'before'       => '',
					'sep'          => ', ',
					'after'        => '',
					'label'        => null, // An appropriate plural/singular label will be provided
					'label_before' => '<dt>',
					'label_after'  => '</dt>',
					'wrap_before'  => '<dd class="tribe-events-event-categories">',
					'wrap_after'   => '</dd>',
				);
				$args       = wp_parse_args( $args, $defaults );
				$categories = tribe_get_event_taxonomy( $post_id, $args );

				// check for the occurrences of links in the returned string
				if ( null === $args[ 'label' ] ) {
					$label = sprintf(
						/* translators: %s is the singular translation of "Event" */
						_nx( 'Category', 'Categories', substr_count( $categories, '<a href' ), 'category list label', 'michigan' ),
						$events_label_singular
					);
				}
				else {
					$label = $args[ 'label' ];
				}

				$html = ! empty( $categories ) ? sprintf(
					'%s%s%s %s%s%s',
					$args['label_before'],
					$label,
					$args['label_after'],
					$args['wrap_before'],
					$categories,
					$args['wrap_after']
				) : '';
				echo apply_filters( 'tribe_get_event_categories', $html, $post_id, $args, $categories );
			?>
		</div>
		<?php
		$website = tribe_get_event_website_link();
		if ( ! empty( $website ) ):
			?>
			<div class="w-tribe-event-website">
			<h3 class="te-web"> <?php esc_html_e( 'Website','michigan') ?></h3>
			<dd class="tribe-events-event-url"> <?php echo $website; ?> </dd>
			</div>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
	</dl>

</div>