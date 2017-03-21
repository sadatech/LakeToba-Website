<form action="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" method="post"
      class="eltd-reset-pass-form eltd-lost-password-form">
	<div>
		<input type="text" name="user_login" class="eltd-input-field eltd-user-login-field" id="user_login_<?php echo esc_attr(rand())?>"
		       placeholder="<?php esc_html_e( 'Enter username or email', 'search-and-go' ) ?>" value="" size="20">
	</div>
	<?php do_action( 'lostpassword_form' ); ?>
	<div class="eltd-reset-password-button-holder">
		<?php echo search_and_go_elated_get_button_html( array(
			'html_type'              => 'button',
			'text'                   => esc_html__( 'New Password', 'search-and-go' ),
			'type'                   => 'solid',
			'background_color'       => '#4c4c4c',
			'border_color'           => '#4c4c4c',
			'hover_color'            => '#fff',
			'hover_border_color'     => $button_hover_color,
			'hover_background_color' => $button_hover_color,
			'icon_pack'              => 'font_elegant',
			'fe_icon'                => 'arrow_carrot-right'
		) );
		?>
	</div>
</form>
<div class="eltd-reset-password-form-action-holder">
	<p><?php esc_html_e( 'Password reset link will be sent to your email', 'search-and-go' ); ?></p>
	<a href="#" class="eltd-login-action-btn" data-el=".eltd-login-content-action"
	   data-title="<?php esc_html_e( 'Log in', 'search-and-go' ); ?>"><?php esc_html_e( 'Cancel', 'search-and-go' ); ?></a>
</div>
<?php
do_action( 'eltd_listing_action_listing_ajax_response' );

