<?php

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div class="container">
	<div class="col-md-9 cntt-w">
		<div id="bbpress-forums">

			<?php bbp_breadcrumb(); ?>

			<?php do_action( 'bbp_template_before_forums_index' ); ?>

			<?php if ( bbp_has_forums() ) : ?>

				<?php bbp_get_template_part( 'loop',     'forums'    ); ?>

			<?php else : ?>

				<?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>

			<?php endif; ?>

			<?php do_action( 'bbp_template_after_forums_index' ); ?>

		</div>
	</div>
	<div class="col-md-3 sidebar">
		<?php if(is_active_sidebar('bbpress-sidebar')) dynamic_sidebar('bbpress-sidebar'); ?>
	</div>
</div>

