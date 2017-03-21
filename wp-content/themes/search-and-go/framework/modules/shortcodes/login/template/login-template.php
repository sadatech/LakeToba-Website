<form method="post" class="eltd-login-form">
	<?php
	$redirect = '';
	if ( isset( $_GET['redirect_uri'] ) ) {
		$redirect = $_GET['redirect_uri'];
	}
	$rememberme_id = 'rememberme_'.rand();
	$user_password_id = 'user_password_'.rand();
	$redirect_id = 'redirect_'.rand();
	?>
	<fieldset>
		<div>
			<input type="text" name="user_login" id="user_login_<?php echo esc_attr(rand())?>" class="eltd-input-field eltd-user-login-field" placeholder="<?php esc_html_e('User Name','search-and-go') ?>" value="" required pattern=".{3,}" title="<?php esc_html_e('Three or more characters', 'search-and-go'); ?>"/>
		</div>
		<div>
			<input type="password" name="user_password"  class="eltd-input-field" id="<?php echo esc_attr($user_password_id)?>" placeholder="<?php esc_html_e('Password','search-and-go') ?>" value="" required/>
		</div>
		<div class="eltd-lost-pass-remember-holder clearfix">
			<span class="eltd-login-remember">
				<span class="eltd-login-remember-me-checkbox"></span>
				<input name="rememberme" value="forever" id="<?php echo esc_attr($rememberme_id)?>" class='eltd-rememberme' type="checkbox"/>
				<label for="<?php echo esc_attr($rememberme_id)?>" class="eltd-checbox-label"><?php esc_html_e('Remember me','search-and-go') ?></label>
			</span>
			<a href="<?php echo wp_lostpassword_url(); ?>" class="eltd-login-action-btn" data-el=".eltd-reset-pass-content-action" data-title="<?php esc_html_e('Lost Password?', 'search-and-go'); ?>"><?php esc_html_e('Lost Your Password?', 'search-and-go'); ?></a>
		</div>
		<input type="hidden" name="redirect" id="<?php echo esc_attr($redirect_id)?>" value="<?php echo esc_url($redirect); ?>">
		<div class="eltd-login-button-holder">
			<?php
			$nonce_field_id = 'eltd-login-security-'.rand();
			wp_nonce_field( 'eltd-ajax-login-nonce', $nonce_field_id );
			echo search_and_go_elated_get_button_html(array(
				'html_type' => 'button',
				'text' => esc_html__('Log in', 'search-and-go'),
				'type' => 'solid',
				'background_color' => '#4c4c4c',
				'border_color' => '#4c4c4c',
				'hover_color' => '#fff',
				'hover_border_color' => $button_hover_color,
				'hover_background_color' =>  $button_hover_color,
				'icon_pack' => 'font_elegant',
				'fe_icon' => 'arrow_carrot-right'
			));?>
		</div>
	</fieldset>
</form>
<div class="eltd-login-form-action-holder">
	<p><?php esc_html_e( 'Don\'t have an account? Want to create?', 'search-and-go' ); ?></p>
	<a href="#" class="eltd-login-action-btn" data-el=".eltd-register-content-action" data-title="<?php esc_html_e('Sign up', 'search-and-go'); ?>"><?php esc_html_e('Sign up', 'search-and-go'); ?></a>
</div>
<?php
$social_login_enabled = search_and_go_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;

if ( $social_login_enabled ) { ?>
	<div class="eltd-login-form-social-login">
		<span class="eltd-login-social-title"><?php esc_html_e('Connect with Social Networks', 'search-and-go'); ?></span>
		<?php
		do_action( 'search_and_go_elated_social_login' );
		?>
	</div>
<?php } ?>

<?php
do_action('eltd_listing_action_listing_ajax_response');
