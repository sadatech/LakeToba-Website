<?php

class SearchAndGoLoginRegister extends SearchAndGoWidget {
	protected $params;
	public function __construct() {
		parent::__construct(
			'eltd_login_register_widget', // Base ID
			'Elated Login', // Name
			array( 'description' => esc_html__( 'Login and register, connect with social networks', 'search-and-go' ), ) // Args
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(

		);
	}

	public function widget($args, $instance) {
		extract($args);

		echo '<div class="widget eltd-login-register-widget">';
		if ( ! is_user_logged_in() ) {
			echo search_and_go_elated_get_button_html(array(
				'text' => 'Sign In',
				'type' => 'outline',
				'custom_class' => 'eltd-login-opener',
				'border_color' => '#eeeeee'
			));
			echo '<a href="#" class="eltd-mobile-login-icon eltd-login-opener">' . search_and_go_elated_icon_collections()->renderIcon( 'lnr-users', 'linear_icons' ).'</a>';

			add_action( 'wp_footer', array( $this, 'search_and_go_elated_render_login_form' ) );

		} else {
			$current_user = wp_get_current_user();
			$name = $current_user->display_name;
			$current_user_id = $current_user->ID;
			?>
			<div class="eltd-logged-in-user">
				<span>
					<span class="eltd-logged-in-user-name"><?php echo esc_html($name);?></span><?php
					echo search_and_go_elated_icon_collections()->renderIcon('arrow_carrot-down', 'font_elegant');
					$profile_image = get_user_meta( $current_user_id, 'social_profile_image', true );
					if ( $profile_image == '' ) {
						$profile_image = get_avatar( $current_user_id, 28 );
					} else {
						$profile_image = '<img src="' . esc_url( $profile_image ) . '">';
					}
					echo search_and_go_elated_kses_img($profile_image);
					?>
				</span>
			</div>
			<ul class="eltd-login-dropdown">
				<?php do_action('search_and_go_elated_login_dropdown_menu_items'); ?>
				<li>
					<span class="eltd-dashboard-menu-icon lnr lnr-exit"></span>
					<a href="<?php echo wp_logout_url( esc_url(home_url('/')) ); ?>">
						<?php esc_html_e( 'Log out', 'search-and-go' ); ?>
					</a>
				</li>
			</ul>
			<?php
		}
		echo '</div>';

	}

	public function search_and_go_elated_render_login_form() {

		echo '<div class="eltd-login-register-holder">
<div class="eltd-login-content">
	<div class="eltd-login-title">'. esc_html__('Log in', 'search-and-go') .'</div>
	<div class="eltd-login-content-inner widget-section eltd-login-content-action">
		<div class="eltd-wp-login-holder">' . search_and_go_elated_execute_shortcode( 'eltd_user_login', array() ). '</div>
	</div>
	<div class="eltd-register-content-inner widget-section eltd-register-content eltd-register-content-action">
		<div class="eltd-wp-register-holder">' . search_and_go_elated_execute_shortcode( 'eltd_user_register', array() ). '</div>
	</div>
	<div class="eltd-reset-pass-content-inner widget-section eltd-reset-pass-content eltd-reset-pass-content-action">
		<div class="eltd-wp-reset-pass-holder">' . search_and_go_elated_execute_shortcode( 'eltd_user_reset_password', array() ). '</div>
	</div>
</div>
</div>';

	}
}
