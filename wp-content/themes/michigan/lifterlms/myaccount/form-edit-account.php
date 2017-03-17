<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(function_exists('llms_print_notices')){
	llms_print_notices();
}
global $current_user;
$errors = array();
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    if ( !empty($_POST['pass11'] ) && !empty( $_POST['pass22'] ) ) {
        if ( $_POST['pass11'] == $_POST['pass22'] )
            wp_set_password( esc_attr( $_POST['pass11']), $current_user->ID );
        else
            $errors[] = esc_html__('The passwords you entered do not match.  Your password was not updated.', 'michigan');
    }
    if ( !empty( $_POST['url'] ) )
        wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
	
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] ))){
			$errors[] = esc_html__('The Email you entered is not valid.  please try again.', 'michigan');			
		}elseif(email_exists(esc_attr( $_POST['email'] )) && email_exists(esc_attr( $_POST['email'] )) != $current_user->ID){
				$errors[] = esc_html__('This email is already used by another user.  try a different one.', 'michigan');
		}else{
			wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }
	
	if ( !empty( $_POST['nickname'] ) ){
        update_user_meta( $current_user->ID, 'nickname', esc_attr( $_POST['nickname'] ) );
	}else{
		$errors[] = esc_html__('Please enter a nickname', 'michigan');
	}
	
    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
	if ( !empty( $_POST['url'] ) )
        update_user_meta( $current_user->ID, 'url', esc_attr( $_POST['url'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
	if ( !empty( $_POST['biography'] ) )
        update_user_meta( $current_user->ID, 'biography', esc_attr( $_POST['biography'] ) );
	if ( !empty( $_POST['display-email'] ) )
        update_user_meta($current_user->ID, 'display_email', esc_attr( $_POST['display-email'] ) );
	if ( !empty( $_POST['twitter'] ) )
        update_user_meta($current_user->ID, 'twitter', esc_attr( $_POST['twitter'] ) );
	if ( !empty( $_POST['facebook'] ) )
        update_user_meta($current_user->ID, 'facebook', esc_attr( $_POST['facebook'] ) );
	if ( !empty( $_POST['googleplus'] ) )
        update_user_meta($current_user->ID, 'googleplus', esc_attr( $_POST['googleplus'] ) );
	if ( !empty( $_POST['linkedin'] ) )
        update_user_meta($current_user->ID, 'linkedin', esc_attr( $_POST['linkedin'] ) );
	if ( !empty( $_POST['youtube'] ) )
        update_user_meta($current_user->ID, 'youtube', esc_attr( $_POST['youtube'] ) );
	if ( !empty( $_POST['title'] ) )
        update_user_meta($current_user->ID, 'title', esc_attr( $_POST['title'] ) );
	if ( !empty( $_POST['biography'] ) )
        update_user_meta($current_user->ID, 'biography', esc_attr( $_POST['biography'] ) );
	if ( !empty( $_POST['billing-address-1'] ) )
        update_user_meta($current_user->ID, 'llms_billing_address_1', esc_attr( $_POST['billing-address-1'] ) );
	if ( !empty( $_POST['billing-address-2'] ) )
        update_user_meta($current_user->ID, 'llms_billing_address_2', esc_attr( $_POST['billing-address-2'] ) );
	if ( !empty( $_POST['llms-billing-city'] ) )
        update_user_meta($current_user->ID, 'llms_billing_city', esc_attr( $_POST['llms-billing-city'] ) );
	if ( !empty( $_POST['llms-billing-state'] ) )
        update_user_meta($current_user->ID, 'llms_billing_state', esc_attr( $_POST['llms-billing-state'] ) );
	if ( !empty( $_POST['llms-billing-zip'] ) )
        update_user_meta($current_user->ID, 'llms_billing_zip', esc_attr( $_POST['llms-billing-zip'] ) );
	if ( !empty( $_POST['llms_country_options'] ) )
        update_user_meta($current_user->ID, 'llms_billing_country', esc_attr( $_POST['llms_country_options'] ) );
	if ( count($errors) == 0 ) {
        do_action('edit_user_profile_update', $current_user->ID);
		add_action( 'pre_posts', 'webnus_edi_profile_redirect' );
		function webnus_edi_profile_redirect() {
			if( is_user_logged_in() ){
				wp_redirect( get_the_permalink() );
				exit;
			}
		}
    }
}
if ( !is_user_logged_in() ){
	echo '<p class="w-error">';
	esc_html_e('You must be logged in to edit your profile.', 'michigan');
	echo '</p>';
}else{
if ( count($errors) > 0 ) echo '<p class="w-error">' . implode("<br />", $errors) . '</p>'; 
?>
<form action="" class="course-content standard-form llms-person-information-form" method="post">
    <div class="llms-basic-information">
	<h4 class="course-titles"><?php esc_html_e( 'Basic Information', 'michigan' ) ?></h4>
		<div class="row">
			<div class="col-md-6">
				<label for="first-name"><?php esc_html_e('First Name', 'michigan'); ?></label>
				<input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
			</div>
			<div class="col-md-6">
				<label for="last-name"><?php esc_html_e('Last Name', 'michigan'); ?></label>
				<input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
			</div>
		</div>
        <div class="row">
			<div class="col-md-6">
				<label for="nickname"><?php esc_html_e('Nickname', 'michigan'); ?></label>
				<input type="text" name="nickname" id="nickname" class="text-input" value="<?php the_author_meta( 'nickname', $current_user->ID ); ?>">
			</div>
			<div class="col-md-6">
				<label for="title"><?php esc_html_e('Title', 'michigan'); ?></label>
				<input class="text-input" name="title" type="text" id="title" value="<?php the_author_meta( 'title', $current_user->ID ); ?>" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="email"><?php esc_html_e('E-mail *', 'michigan'); ?></label>
				<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
			</div>
			<div class="col-md-6">
				<label for="display-email"><?php esc_html_e('Display E-mail', 'michigan'); ?></label>
				<input class="text-input" name="display-email" type="text" id="display-email" value="<?php the_author_meta( 'display_email', $current_user->ID ); ?>" />
			</div>
		</div>
		<label for="url"><?php esc_html_e('Website', 'michigan'); ?></label>
		<input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" />
		<div class="row">
			<div class="col-md-6">
				<label for="description"><?php esc_html_e( 'Description', 'michigan' ); ?></label>
				<textarea name="description" id="description" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
			</div>
			<div class="col-md-6">
				<label for="biography"><?php esc_html_e( 'Biography (Summary Description)', 'michigan' ); ?></label>
				<textarea name="biography" id="biography" rows="3" cols="50"><?php the_author_meta( 'biography', $current_user->ID ); ?></textarea>
			</div>
		</div>
	</div>	
	<div class="llms-socials-profile">
		<hr class="vertical-space2">
		<h4 class="course-titles"><?php esc_html_e( 'Socials', 'michigan' ) ?></h4>
		<div class="row">
			<div class="col-md-6">
				<label for="facebook"><?php esc_html_e('Facebook', 'michigan'); ?></label>
				<input class="text-input" name="facebook" type="text" id="facebook" value="<?php the_author_meta( 'facebook', $current_user->ID ); ?>" />
			</div>
			<div class="col-md-6">
				<label for="twitter"><?php esc_html_e('Twitter', 'michigan'); ?></label>
				<input class="text-input" name="twitter" type="text" id="twitter" value="<?php the_author_meta( 'twitter', $current_user->ID ); ?>" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="googleplus"><?php esc_html_e('Google+', 'michigan'); ?></label>
				<input class="text-input" name="googleplus" type="text" id="googleplus" value="<?php the_author_meta( 'googleplus', $current_user->ID ); ?>" />
			</div>
			<div class="col-md-6">
				<label for="linkedin"><?php esc_html_e('Linkedin', 'michigan'); ?></label>
				<input class="text-input" name="linkedin" type="text" id="linkedin" value="<?php the_author_meta( 'linkedin', $current_user->ID ); ?>" />
			</div>
		</div>
		<label for="youtube"><?php esc_html_e('Youtube', 'michigan'); ?></label>
		<input class="text-input" name="youtube" type="text" id="youtube" value="<?php the_author_meta( 'youtube', $current_user->ID ); ?>" />
	</div>
	<div class="llms-change-password">
		<hr class="vertical-space2">
        <h4 class="course-titles"><?php esc_html_e( 'Change Password', 'michigan' ) ?></h4>
		<div class="row">
			<div class="col-md-6">
				<label for="password_1"><?php esc_html_e( 'Password (leave blank to leave unchanged)', 'michigan' ); ?></label>
				<input class="text-input" name="pass11" type="password" id="pass11" />
			</div>
			<div class="col-md-6">
				<label for="password_2"><?php esc_html_e( 'Confirm new password', 'michigan' ); ?></label>
				<input class="text-input" name="pass22" type="password" id="pass22" />
			</div>
		</div>
    </div>
    <?php if ( 'yes' === get_option( 'lifterlms_registration_require_address' ) ) : ?>
        <div class="llms-billing-information">
			<hr class="vertical-space2">
            <h4 class="course-titles"><?php esc_html_e( 'Billing Information', 'michigan' ) ?></h4>
            <?php
			$billing_country    = ( get_user_meta( $current_user->ID, 'llms_billing_country' ) )        ? get_user_meta( $current_user->ID, 'llms_billing_country', true )   : '';
			?>
			<div class="row">
				<div class="col-md-6">
					<label for="billing_country"><?php esc_html_e( 'Billing Country', 'michigan' ); ?> <span class="required">*</span></label>
					<select id="llms_country_options" name="llms_country_options">
					<?php $country_options = get_lifterlms_countries();
					foreach ( $country_options as $code => $name ) : ?>
							<?php if (get_user_meta( $current_user->ID, 'llms_billing_country', true ) == $code) : ?>
								<option value="<?php echo esc_attr($code); ?>" selected><?php echo esc_attr($name); ?></option>
							<?php else : ?>
							<option value="<?php echo esc_attr($code); ?>"><?php echo esc_attr($name); ?></option>
							<?php endif;
							endforeach; ?>
					</select>
				</div>
				<div class="col-md-6">
					<label for="billing-zip"><?php esc_html_e( 'Billing Zip', 'michigan' ); ?> <span class="required">*</span></label>
					<input class="text-input" name="llms-billing-zip" type="text" id="llms-billing-zip" value="<?php echo get_user_meta( $current_user->ID, 'llms_billing_zip', true ); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="billing-address-1"><?php esc_html_e( 'Billing Address 1', 'michigan' ); ?> <span class="required">*</span></label>
					<input class="text-input" name="billing-address-1" type="text" id="billing-address-1" value="<?php echo get_user_meta( $current_user->ID, 'llms_billing_address_1', true ); ?>" />
				</div>
				<div class="col-md-6">
					<label for="billing_address_2"><?php esc_html_e( 'Billing Address 2', 'michigan' ); ?></label>
					<input class="text-input" name="billing-address-2" type="text" id="billing-address-2" value="<?php echo get_user_meta( $current_user->ID, 'llms_billing_address_2', true ); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="billing-city"><?php esc_html_e( 'Billing City', 'michigan' ); ?> <span class="required">*</span></label>
					<input class="text-input" name="llms-billing-city" type="text" id="llms-billing-city" value="<?php echo get_user_meta( $current_user->ID, 'llms_billing_city', true ); ?>" />
				</div>
				<div class="col-md-6">
					<label for="billing-state"><?php esc_html_e( 'Billing State', 'michigan' ); ?> <span class="required">*</span></label>
					<input class="text-input" name="llms-billing-state" type="text" id="llms-billing-state" value="<?php echo get_user_meta( $current_user->ID, 'llms_billing_state', true ); ?>" />
				</div>
			</div>
		</div>
    <?php endif; ?>
    <?php do_action( 'lifterlms_edit_account_form_end' ); ?>
    <div class="clear"></div>
	<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php esc_html_e('Update', 'michigan'); ?>" />
	<?php wp_nonce_field( 'update-user' ) ?>
	<input name="action" type="hidden" id="action" value="update-user" />
</form>
<?php } ?>