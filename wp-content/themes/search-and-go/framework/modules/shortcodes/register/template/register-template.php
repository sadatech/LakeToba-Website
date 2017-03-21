<?php $user_mail_id = 'user_mail_id_'.rand(); ?>
<form method="post" class="eltd-register-form">
	<fieldset>
		<div>
			<input type="text" name="user_login" id="user_login_<?php echo esc_attr(rand())?>" class="eltd-input-field eltd-user-login-field"  placeholder="<?php esc_html_e('User Name','search-and-go') ?>" value="" required pattern=".{3,}" title="<?php esc_html_e('Three or more characters', 'search-and-go'); ?>"/>
		</div>
		<div>
			<input type="email" name="user_email" id="<?php echo esc_attr($user_mail_id)?>" class="eltd-input-field"  placeholder="<?php esc_html_e('Email','search-and-go') ?>" value="" required/>
		</div>
		<div class="eltd-register-button-holder">
			<?php
			$nonce_field_id = 'eltd-register-security-'.rand();
			wp_nonce_field( 'eltd-ajax-register-nonce', $nonce_field_id );
			echo search_and_go_elated_get_button_html(array(
				'html_type' => 'button',
				'text' => esc_html__('Register', 'search-and-go'),
				'type' => 'solid',
				'background_color' => '#4c4c4c',
				'border_color' => '#4c4c4c',
				'hover_color' => '#fff',
				'hover_border_color' => $button_hover_color,
				'hover_background_color' =>  $button_hover_color,
				'icon_pack' => 'font_elegant',
				'fe_icon' => 'arrow_carrot-right'
			));
			?>
		</div>
	</fieldset>
</form>
<div class="eltd-login-form-action-holder">
	<p><?php esc_html_e( 'Have an account? Log in?', 'search-and-go' ); ?></p>
	<a href="#" class="eltd-login-action-btn" data-el=".eltd-login-content-action" data-title="<?php esc_html_e('Log in', 'search-and-go'); ?>"><?php esc_html_e('Log in', 'search-and-go'); ?></a>
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

