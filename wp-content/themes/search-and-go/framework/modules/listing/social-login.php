<?php

if ( ! function_exists( 'search_and_go_elated_set_social_vars' ) ) {
	/**
	 * Save social variables for later use in js files
	 */
	function search_and_go_elated_set_social_vars() {

		$social_login_enabled = search_and_go_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
		if ( $social_login_enabled ) {

			$social_variables = array(
				'facebookAppId' => search_and_go_elated_options()->getOptionValue('enable_facebook_social_login') == 'yes' ? search_and_go_elated_options()->getOptionValue('enable_facebook_login_fbapp_id') : null,
				'googleClientId' => search_and_go_elated_options()->getOptionValue('enable_google_social_login') == 'yes' ? search_and_go_elated_options()->getOptionValue('enable_google_login_client_id') : null
			);

			wp_localize_script('search_and_go_elated_modules', 'eltdSocialVars', array(
				'social' => $social_variables
			));
		}


	}

	add_action('wp_enqueue_scripts', 'search_and_go_elated_set_social_vars');

}

if ( ! function_exists( 'search_and_go_elated_set_wp_login_social_login' ) ) {
	/**
	 * Add social login html to default login page
	 */
	function search_and_go_elated_set_wp_login_social_login() {

		$social_login_enabled = search_and_go_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
		$facebook_login_enabled = search_and_go_elated_options()->getOptionValue('enable_facebook_social_login') == 'yes' ? true : false;
		$google_login_enabled = search_and_go_elated_options()->getOptionValue('enable_google_social_login') == 'yes' ? true : false;

		$html = '';
		if ( $social_login_enabled ) {
			$html .= '<div class="eltd-login-form-social-login">';
			$html .= '<span class="eltd-login-social-title">'. esc_html__('Connect with Social Networks: ', 'search-and-go') .'</span>';
			$html .= '<div class="eltd-social-login-wrapper">';
			if ( $facebook_login_enabled ) {
				$html .= '<a href="#" id="eltd-facebook-login"><span class="social_facebook"></span></a>';
			}
			if ( $google_login_enabled ) {
				$html .= '<a href="#" id="eltd-google-login"><span class="social_googleplus"></span></a>';
			}
			$html .= '</div>';
			$html .= '</div>';
		}
		print $html;

	}

	add_action( 'login_form', 'search_and_go_elated_set_wp_login_social_login' );

}

if ( ! function_exists( 'search_and_go_elated_enqueue_login_scripts' ) ) {
	/**
	 * Enqueue scripts for social login
	 */
	function search_and_go_elated_enqueue_login_scripts() {

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'search_and_go_elated_login', ELATED_FRAMEWORK_ROOT . '/admin/assets/js/eltd-login.js', array(), null, true );
		//include google+ api
		wp_enqueue_script('search_and_go_elated_google_plus_api', 'https://apis.google.com/js/platform.js', array(), null, false);
		wp_enqueue_style( 'search_and_go_elated_login_font_elegant', ELATED_ASSETS_ROOT . '/css/elegant-icons/style.min.css' );
		$social_login_enabled = search_and_go_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
		if ( $social_login_enabled ) {
			$social_variables = array(
				'facebookAppId' => search_and_go_elated_options()->getOptionValue('enable_facebook_social_login') == 'yes' ? search_and_go_elated_options()->getOptionValue('enable_facebook_login_fbapp_id') : null,
				'googleClientId' => search_and_go_elated_options()->getOptionValue('enable_google_social_login') == 'yes' ? search_and_go_elated_options()->getOptionValue('enable_google_login_client_id') : null
			);
			wp_localize_script('search_and_go_elated_login', 'eltdSocialVars', array(
				'social' => $social_variables
			));
		}
		echo '<script type="application/javascript">var ElatedAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
		?>
		<style type="text/css">
			.eltd-login-form-social-login {
				margin-bottom: 20px !important;
			}
			.eltd-social-login-wrapper{
				margin: 10px 0 !important;
				overflow: hidden;
			}

			#eltd-facebook-login,
			#eltd-google-login {
				background-color: #1ab5c1;
				-webkit-border-radius: 50%;
				-moz-border-radius: 50%;
				border-radius: 50%;
				width: 20px;
				height: 20px;
				line-height: 20px;
				text-decoration: none;
				color: #fff;
				display: inline-block;
				text-align: center;
				font-size: 11px;
				float: left;
			}
			#eltd-google-login{
				margin-left: 5px;
			}
		</style>
		<?php
	}

	add_action( 'login_enqueue_scripts', 'search_and_go_elated_enqueue_login_scripts' );

}

if ( ! function_exists( 'search_and_go_elated_get_facebook_social_login' ) ) {
	/**
	 * Render form for facebook login
	 */
	function search_and_go_elated_get_facebook_social_login() {

		$social_login_enabled = search_and_go_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
		$facebook_login_enabled = search_and_go_elated_options()->getOptionValue('enable_facebook_social_login') == 'yes' ? true : false;
		$enabled = ( $social_login_enabled && $facebook_login_enabled ) ? true : false;

		if ( ! is_user_logged_in() && $enabled ) {

			$html = '<form class="eltd-facebook-login-holder">';
			$html .= wp_nonce_field( 'eltd_validate_facebook_login', 'eltd_nonce_facebook_login_'.rand() , true, false );
			$html .= '<button type="submit" class="eltd-facebook-login"><span class="social_facebook"></span></button></form>';
			print $html;

		}

	}

	add_action( 'search_and_go_elated_social_login', 'search_and_go_elated_get_facebook_social_login' );

}

if ( ! function_exists( 'search_and_go_elated_get_google_social_login' ) ) {
	/**
	 * Render form for google login
	 */
	function search_and_go_elated_get_google_social_login() {

		$social_login_enabled = search_and_go_elated_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
		$google_login_enabled = search_and_go_elated_options()->getOptionValue('enable_google_social_login') == 'yes' ? true : false;
		$enabled = ( $social_login_enabled && $google_login_enabled ) ? true : false;

		if ( ! is_user_logged_in() && $enabled ) {

			$html = '<form class="eltd-google-login-holder">';
			$html .= wp_nonce_field( 'eltd_validate_googleplus_login', 'eltd_nonce_google_login_'.rand() , true, false );
			$html .= '<button type="submit" class="eltd-google-login"><span class="social_googleplus"></span></button></form>';
			print $html;

		}

	}

	add_action( 'search_and_go_elated_social_login', 'search_and_go_elated_get_google_social_login' );

}

if ( ! function_exists( 'search_and_go_elated_check_facebook_user' ) ) {
	/**
	 * Function for getting facebook user data.
	 * Checks for user mail and register or log in user
	 */
	function search_and_go_elated_check_facebook_user() {

		if ( isset($_POST['response'] ) ) {
			$response = $_POST['response'];
			$user_email = $response['email'];
			$network = 'facebook';
			$response['network'] = $network;
			$from_login = isset($response['loginPage']) ? true : false;
			//There is no nonce field on wp login page
			if ( $from_login ) {
				$nonce = null;
			} else {
				$nonce = $response['nonce'];
			}

			if ( email_exists( $user_email ) ) {
				//User already exist, log in user
				search_and_go_elated_login_user_from_social_network( $user_email, $nonce, $network, $from_login );
			} else {
				//Register new user
				search_and_go_elated_register_user_from_social_network( $response );
			}
			$url = eltd_listing_get_dashboard_page_url();
			if ( $url == '' ) {
				$url = esc_url(home_url('/'));
			}
			eltdAjaxStatus('success', esc_html__('Login successful, redirecting...', 'search-and-go'), $url);
		}
		wp_die();

	}

	add_action('wp_ajax_search_and_go_elated_check_facebook_user', 'search_and_go_elated_check_facebook_user');
	add_action('wp_ajax_nopriv_search_and_go_elated_check_facebook_user', 'search_and_go_elated_check_facebook_user');

}

if ( ! function_exists( 'search_and_go_elated_check_google_user' ) ) {
	/**
	 * Function for getting google user data.
	 * Checks for user mail and register or log in user
	 */
	function search_and_go_elated_check_google_user() {

		if ( isset($_POST['response'] ) ) {
			$response = $_POST['response'];
			$user_email = $response['email'];
			$network = 'googleplus';
			$response['network'] = $network;
			$from_login = isset($response['loginPage']) ? true : false;
			//There is no nonce field on wp login page
			if ( $from_login ) {
				$nonce = null;
			} else {
				$nonce = $response['nonce'];
			}

			if ( email_exists( $user_email ) ) {
				//User already exist, log in user
				search_and_go_elated_login_user_from_social_network( $user_email, $nonce, $network, $from_login );
			} else {
				//Register new user
				search_and_go_elated_register_user_from_social_network( $response );
			}
			$url = eltd_listing_get_dashboard_page_url();
			if ( $url == '' ) {
				$url = esc_url(home_url('/'));
			}
			eltdAjaxStatus('success', esc_html__('Login successful, redirecting...', 'search-and-go'), $url);
		}
		wp_die();

	}

	add_action('wp_ajax_search_and_go_elated_check_google_user', 'search_and_go_elated_check_google_user');
	add_action('wp_ajax_nopriv_search_and_go_elated_check_google_user', 'search_and_go_elated_check_google_user');

}

if ( ! function_exists( 'search_and_go_elated_login_user_from_social_network' ) ) {
	/**
	 * Login facebook user
	 *
	 * @param $email
	 * @param $nonce
	 */
	function search_and_go_elated_login_user_from_social_network( $email, $nonce, $network, $login ) {

		$user = get_user_by( 'email', $email );

		if ( ! is_wp_error($user) ) {
			if ( $login ) {
				wp_set_current_user( $user->ID, $user->user_login );
				wp_set_auth_cookie( $user->ID );
				do_action( 'wp_login', $user->user_login );
			} else {
				if ( wp_verify_nonce( $nonce, 'eltd_validate_' . $network . '_login' ) ) {
					wp_set_current_user( $user->ID, $user->user_login );
					wp_set_auth_cookie( $user->ID );
					do_action( 'wp_login', $user->user_login );
				}
			}
		} else {
			echo 'Not valid user';
		}

	}

}

if ( ! function_exists( 'search_and_go_elated_register_user_from_social_network' ) ) {
	/**
	 * Register facebook user
	 *
	 * @param $params - parameters for logging in
	 */
	function search_and_go_elated_register_user_from_social_network( $params ) {

		$nicename = $params['name'];
		$email = $params['email'];
		$password = $params['id'];
		$network = $params['network'];
		$username = str_replace( '-', '_', sanitize_title( $params['name'] ) ) . '_' . $network;
		$link = isset($params['link']) ? $params['link'] : '';
		$profile_image = isset($params['image']) ? $params['image'] : '';
		$from_login = isset($params['loginPage']) ? true : false;
		//There is no nonce field on wp login page
		if ( $from_login ) {
			$nonce = null;
		} else {
			$nonce = $params['nonce'];
		}

		$password = search_and_go_elated_generate_password( $password, $username );

		if ( $from_login ) {

			$userdata = array(
				'user_login'   => $username,
				'display_name' => $nicename,
				'user_email'   => $email,
				'user_pass'    => $password,
				'role' => 'owner'
			);

			$user_id = wp_insert_user( $userdata );
			update_user_meta( $user_id, $network, $link );

			//On success
			if ( ! is_wp_error( $user_id ) ) {
				search_and_go_elated_login_user_from_social_network( $email, $nonce, $network, $from_login );
			} else {
				echo esc_html($user_id->get_error_message());
			}

		} else {

			if ( wp_verify_nonce( $nonce, 'eltd_validate_' . $network . '_login' ) ) {

				$userdata = array(
					'user_login'   => $username,
					'display_name' => $nicename,
					'user_email'   => $email,
					'user_pass'    => $password,
					'role' => 'owner'
				);

				$user_id = wp_insert_user( $userdata );
				add_user_meta( $user_id, 'social_profile_image', $profile_image, true );
				update_user_meta( $user_id, $network, $link );

				//On success
				if ( ! is_wp_error( $user_id ) ) {
					search_and_go_elated_login_user_from_social_network( $email, $nonce, $network, $from_login );
				} else {
					echo esc_html($user_id->get_error_message());
				}

			}

		}

	}

}

if ( ! function_exists( 'search_and_go_elated_generate_password' ) ) {

	function search_and_go_elated_generate_password( $str1, $str2 ) {

		$str1 = str_split($str1);
		$str2 = str_split($str2);

		$password = array_merge( $str1, $str2 );
		shuffle($password);
		$password = implode('', $password);

		return $password;
	}

}



if(!function_exists('search_and_go_elated_user_login')){

	function search_and_go_elated_user_login() {

		if(empty($_POST) || !isset($_POST)) {
			eltdAjaxStatus('error', esc_html__('All fields are empty', 'search-and-go'));
		} else {
			check_ajax_referer( 'eltd-ajax-login-nonce', 'security');
			$data = $_POST;

			$data_string = $data['post'];
			parse_str($data_string, $data_array);

			$info['user_login'] = $data_array['user_login'];
			$info['user_password'] = $data_array['user_password'];
			$redirect_uri = $data_array['redirect'];

			if(isset($info['remember']) && $info['remember'] == 'forever') {
				$info['remember'] = true;
			}else {
				$info['remember'] = false;
			}
			$user_signon = wp_signon( $info, false );

			if ( is_wp_error($user_signon) ){
				eltdAjaxStatus('error', esc_html__('Wrong username or password.', 'search-and-go'));
			} else {
				if ( $redirect_uri == '' ) {
					$redirect_uri = eltd_listing_get_dashboard_page_url();
				}
				eltdAjaxStatus('success', esc_html__('Login successful, redirecting...', 'search-and-go'), $redirect_uri);
			}

		}
		wp_die();
	}
	add_action( 'wp_ajax_nopriv_search_and_go_elated_user_login', 'search_and_go_elated_user_login' );
}

if(!function_exists('search_and_go_elated_user_register')){

	function search_and_go_elated_user_register() {

		if(empty($_POST) || !isset($_POST)) {
			eltdAjaxStatus('error', esc_html__('All fields are empty', 'search-and-go'));
		} else {
			check_ajax_referer( 'eltd-ajax-register-nonce', 'security');
			$data = $_POST;

			$data_string = $data['post'];
			parse_str($data_string, $data_array);
			$info['user_login'] = $data_array['user_login'];
			$info['user_email'] = $data_array['user_email'];

			$user_id = username_exists( $info['user_login'] );
			if ( !$user_id and email_exists($info['user_email']) == false ) {
				$user_id = register_new_user( $info['user_login'], $info['user_email'] );
				wp_update_user( array( 'ID' => $user_id, 'role' => 'owner' ) );
				eltdAjaxStatus('success', esc_html__('You are sucssesfully registered. Please check your email', 'search-and-go'));
			} else {
				eltdAjaxStatus('error', esc_html__('User already exists', 'search-and-go'));
			}
		}
		wp_die();
	}
	add_action( 'wp_ajax_nopriv_search_and_go_elated_user_register', 'search_and_go_elated_user_register' );
}

if(!function_exists('search_and_go_elated_user_lost_password')){

	function search_and_go_elated_user_lost_password() {

		if( !function_exists('retrieve_password') ){
			ob_start();
			include_once(ABSPATH.'wp-login.php');
			ob_clean();
		}
		$result = retrieve_password();
		if ( $result === true ) {
			eltdAjaxStatus('success', esc_html__('We have sent you an email', 'search-and-go'));
		} else {
			eltdAjaxStatus('error', $result->get_error_message());
		}

		wp_die();

	}

	add_action( 'wp_ajax_nopriv_search_and_go_elated_user_lost_password', 'search_and_go_elated_user_lost_password' );

}