<?php

if( !function_exists( 'eltd_listing_get_profile_pages' ) ) {
	/**
	 * Return all parts of profile page
	 */
	function eltd_listing_get_profile_pages() {

		$html = '';
		$params = array();
		$action = 'about';

		$user_id = get_current_user_id();

		$params['user_id'] = $user_id;		
		$params['separator_args'] = array(
			'icon_pack' => 'linear_icons',
			'linear_icons'	=> 'lnr-cog',
			'width'			=>	'85',
			'thickness'		=>	'1'
		);
		
		$params['sign_out_button_params'] = array(
			'text' => esc_html__('Sign out',  'eltd_listing'),
			'icon_pack' => 'font_elegant',
			'fe_icon'	=> 'arrow_carrot-right',
			'link' => wp_logout_url( home_url() )
		);		

		if(isset($_GET['user-action'])) {
			$action = $_GET['user-action'];
		}
		
		$html .= '<div class="eltd-listing-dashboard-holder-outer">';
		$html .= eltd_listing_get_dashboard_module_template_part('templates','dashboard-navigation');
		$html .= '<div class="eltd-listing-dashboard-holder-inner '.$action.'">';
		switch ($action):

			case 'edit_profile':

				if ( eltd_listing_theme_installed() ) {
					$params['subtitle_text'] = search_and_go_elated_options()->getOptionValue('dasboard_edit_profile_text');
				} else {
					$params['subtitle_text'] = '';
				}
				$html .= eltd_listing_get_dashboard_module_template_part('templates','edit-profile', '', $params);
				break;
			
            case 'add_new_listing':
				
				$html .= eltd_listing_add_listing_form($user_id);
			    break;
			
			case 'edit_listing':
				
				$html .= eltd_listing_edit_listing_form($user_id);
				break;
			
			case 'listings':

				if ( eltd_listing_theme_installed() ) {
					$params['subtitle_text'] = search_and_go_elated_options()->getOptionValue('dasboard_listings_text');
				} else {
					$params['subtitle_text'] = '';
				}
				$html .= eltd_listing_user_listings($params);
				break;
			
			case 'wishlist':

				if ( eltd_listing_theme_installed() ) {
					$params['subtitle_text'] = search_and_go_elated_options()->getOptionValue('dasboard_wishlist_text');
				} else {
					$params['subtitle_text'] = '';
				}
				$html .= eltd_listing_user_whislist($params);
				break;
			
			case 'comments_reviews':
				
				//this is currently hide on dashboard pages
				$html .= eltd_listing_user_comments_and_reviews($params);
				break;
			
			default:

				if ( eltd_listing_theme_installed() ) {
					$params['subtitle_text'] = search_and_go_elated_options()->getOptionValue('dashboard_profile_text');
				} else {
					$params['subtitle_text'] = '';
				}
				$html .= eltd_listing_get_dashboard_module_template_part('templates','profile', '', $params);
				break;
			
		endswitch;

		$html .= '</div>';
		$html .= '</div>';

		print $html;
	}

}

if(!function_exists( 'eltd_listing_get_dashboard_page_url' )){

	function eltd_listing_get_dashboard_page_url() {
		$url = '';
		$pages = get_all_page_ids();
		foreach($pages as $page) {
			if((get_post_status($page) == 'publish') && (get_page_template_slug($page) == 'user-dashboard.php')){
				$url = esc_url(get_the_permalink($page));
				break;
			}
		}
		return $url;
	}
}


if(!function_exists( 'eltd_listing_set_user_nonce' )) {
	/**
	 * Function that generates global nonce
	 */
	function eltd_listing_set_user_nonce() {

		if(is_user_logged_in()) {
			$parameters = array(
				'nonce' => wp_create_nonce('update-profile-' . get_current_user_id())
			);
			wp_localize_script('search_and_go_elated_modules', 'eltdUpdateProfile', $parameters);
		}
	}

	add_action('wp_enqueue_scripts', 'eltd_listing_set_user_nonce', 1000);
}

if(!function_exists( 'eltd_listing_update_user_profile' )){

	function eltd_listing_update_user_profile() {
		if(empty($_POST) || !isset($_POST)) {
			eltdAjaxStatus('error', esc_html__('All fields are empty', 'eltd_listing'));
		} else {

			$user_id = get_current_user_id();

			$data = $_POST;
			$data_string = $data['post'];
			parse_str($data_string, $data_array);
			$nonce = $data['nonce'];
			$data_array_exlclude = array(
				'email' =>  $data_array['email'],
				'password' =>  $data_array['password'],
				'password2' =>  $data_array['password2']
			);
			$data_meta_array = array_diff($data_array, $data_array_exlclude);

			if(wp_verify_nonce($nonce, 'update-profile-' . $user_id) !== false) {
				$user_ID = get_current_user_id();
				if($user_ID != NULL) {

					if(!empty($data_array['password'])){
						if($data_array['password'] == $data_array['password2']) {
							wp_update_user(array('ID' => $user_id, 'user_pass' => esc_attr($data_array['password'])));
						} else {
							eltdAjaxStatus('error', esc_html__('Passwords dont match', 'eltd_listing'));
						}
					}

					if(!empty($data_array['email']) && filter_var($data_array['email'], FILTER_VALIDATE_EMAIL)){
						wp_update_user( array( 'ID' => $user_id, 'user_email' => esc_attr($data_array['email'])));
					}

					foreach($data_meta_array as $key=>$value) {
						$status = update_user_meta($user_ID, $key, $value);
					}
					eltdAjaxStatus('success', esc_html__('Your profile is updated', 'eltd_listing'));

				} else {
					eltdAjaxStatus('error', esc_html__('You are unauthorized to perform this action.', 'eltd_listing'));
				}

			} else {
				eltdAjaxStatus('error', esc_html__('Wrong nonce code.', 'eltd_listing'));
			}
		}
	}

	add_action( 'wp_ajax_eltd_listing_update_user_profile', 'eltd_listing_update_user_profile' );
}

if(!function_exists( 'eltd_listing_add_listing' )){

	function eltd_listing_add_listing() {
		
		global $wpdb;
		
		if(empty($_POST) || !isset($_POST)) {
			eltdAjaxStatus('error', esc_html__('All fields are empty', 'eltd_listing'));
		} else {
			check_ajax_referer( 'eltd-ajax-add-listing-nonce', 'security');

			$post_array = array(
				'post_type'       	=> 'listing-item',
				'post_status'       => 'pending',
				'post_author'       => get_current_user_id()
			);
			$data = $_POST;

			$data_string = $data['post'];
			parse_str($data_string, $data_array);
			$post_array['meta_input'] = array();
			$meta_fields = array(
				'_thumbnail_id',
				'eltd_listing_address',
				'eltd_listing_address_latitude',
				'eltd_listing_address_longitude',
				'eltd_listing_subtitle',
				'eltd_listing_phone',
				'eltd_listing_video',
				'eltd_listing_audio',
				'eltd_listing_website',
				'eltd_listing_gallery_images_meta',
				'eltd_listing_open_hours',
				'eltd_listing_package',
				'eltd_listing_email',
				'eltd_listing_price',
				'eltd_listing_instagram_username',
				'eltd_listing_open_table_id'
			);

			if ( eltd_listing_theme_installed() ) {
				$socials = search_and_go_elated_generate_listing_social_icons_array();
			} else {
				$socials = array();
			}
			foreach($socials as $key=>$value) {
				$meta_fields[] = 'eltd_listing_social_'.strtolower($key);
			}

			$post_array['post_title'] = $data_array['post_title'];
			$post_array['post_content'] = $data_array['post_content'];
			
			if(isset($data_array['eltd_listing_excerpt'])){
				$post_array['post_excerpt'] = $data_array['eltd_listing_excerpt'];
			}
			

			$post_array['tax_input'] = array();
			if(isset($data_array['eltd_listing_category'])) {
				$post_array['tax_input']['listing-item-category'] = $data_array['eltd_listing_category'];
			}

			if(isset($data_array['eltd_listing_location'])) {
				$post_array['tax_input']['listing-item-location'] = $data_array['eltd_listing_location'];
			}

			if(isset($data_array['eltd_listing_tag'])) {
				$post_array['tax_input']['listing-item-tag'] = $data_array['eltd_listing_tag'];
			}

			foreach($meta_fields as $meta_field) {
				if (isset($data_array[$meta_field]) && !empty($data_array[$meta_field])) {
					$post_array['meta_input'][$meta_field] = $data_array[$meta_field];
				}
			}
			//get attachment image url by id and save in proper meta field
			if(isset($data_array['eltd_title_area_background_image_meta'])) {
				$title_img_url = wp_get_attachment_image_src($data_array['eltd_title_area_background_image_meta'],'full');
				$post_array['meta_input']['eltd_title_area_background_image_meta'] = $title_img_url[0];
				$post_array['meta_input']['eltd_title_area_background_image_meta_id'] = $data_array['eltd_title_area_background_image_meta'];
			}

			if(isset($data_array['eltd_listing_item_type']) && !empty($data_array['eltd_listing_item_type'])) {

				$type_id = $data_array['eltd_listing_item_type'];

				//save listing type
				$post_array['meta_input']['eltd_listing_item_type'] = $type_id;

				//get all custom fields for choosen type
				$custom_fields = get_post_meta($type_id,'eltd_listing_type_custom_fields',true);

				if($custom_fields != ''){

					foreach($custom_fields as $custom_field) {

						if(isset($data_array[$custom_field['meta_key']]) && !empty($data_array[$custom_field['meta_key']])){

							//save custom fields values for fields which has user set
							$post_array['meta_input'][$custom_field['meta_key']] = $data_array[$custom_field['meta_key']];

						}

					}

				}
				//get all features from feature list for choosen type
				$feature_list =  get_post_meta($data_array['eltd_listing_item_type'], 'eltd_listing_type_feature_list', true);


				if($feature_list[0] !== ''){
					foreach($feature_list as $feature_list_item) {

						$post_array['meta_input']['listing_feature_list_'.$type_id.'_'.sanitize_title($feature_list_item)] = $data_array['listing_feature_list_'.$type_id.'_'.sanitize_title($feature_list_item)];

					}
				}
			}

			//we need to check manualy if listing package is set because listing package is required field
			if(isset($data_array['eltd_listing_package']) && $data_array['eltd_listing_package'] !== ''){
				$post_id = wp_insert_post($post_array);
			}
			else{
				$post_id = 0;
			}

			$html = '';

			$dashboard_url = eltd_listing_get_dashboard_page_url();
			$success_redirect = esc_url(add_query_arg( array('user-action' => 'listings'), $dashboard_url ));

			if ( $post_id !== 0 ) {
				if(isset($data_array['eltd_listing_package_type'])){

					$current_user = get_current_user_id();
					$package_id = $data_array['eltd_listing_package'];

					if (strtolower($data_array['eltd_listing_package_type']) == 'paid') {

						//send user to pay pal if is first payment or first payment wasn't successfull or package is expired
						$package = eltd_listing_get_package_status( $package_id, $current_user ); //TODO change function name
						$package_price = $data_array['eltd_listing_package_discount_price'] != '' ? $data_array['eltd_listing_package_discount_price'] :$data_array['eltd_listing_package_price'];
						$payment_params = array(
							'package_id' => $data_array['eltd_listing_package'],
							'package_title' => $data_array['eltd_listing_package_title'],
							'package_price'	=> $package_price,
						);
						$custom_array = array();

						$send_to_paypal = false;
						if ( empty($package) ) { //No package in database

							// Add package
							$custom_array = array(
								'user_id' => get_current_user_id(),
								'type'	=> 	 'common'
							);
							$send_to_paypal = true;

						} else { // Package in database

							// Package Not Paid
							if ( ! eltd_listing_get_package_payment_status( $current_user, $package_id ) ) {
								$custom_array = array(
									'user_id' => get_current_user_id(),
									'type'	=> 	 'common'
								);
								$send_to_paypal = true;
							}

							// Package expired
							if ( ! eltd_listing_get_package_expiry_status( $current_user, $package_id ) ) {
								$custom_array = array(
									'user_id' => get_current_user_id(),
									'type'	=> 	 'update_expired_package'
								);
								$send_to_paypal = true;
							}

						}

						$payment_params['custom_array'] = $custom_array;

						if ( $send_to_paypal ) {
							$html .= eltd_listing_get_dashboard_module_template_part('templates', 'paypal-payment-form','', $payment_params);
							eltdAjaxStatus('success', esc_html__('You will be redirected to PayPal', 'eltd_listing'),'', $html);
						} else {
							eltdAjaxStatus('success', esc_html__('You have successfully added new listing', 'eltd_listing'), $success_redirect);
						}

					} elseif(strtolower($data_array['eltd_listing_package_type']) == 'free') {

						if(isset($data_array['eltd_listing_package_availability'])){

							$package = eltd_listing_get_package_status( $package_id, $current_user ); //TODO change function name

							if ( empty($package) ) { // No package in database

								$package_interval = $data_array['eltd_listing_package_availability'];
								$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';

								$current_time = current_time( 'mysql' );

								//convert current time format
								$formated_date = new DateTime('now');
								$formated_date->setTimezone(new DateTimezone( 'UTC' ));

								$formated_date->add(new DateInterval('P' . $package_interval . 'D'));
								$expiry_date = $formated_date->format('Y-m-d\TH:i:s\Z');

								$free_package_params = array(

									'user_id' => $current_user,
									'package_id' => $package_id,
									'payment_date'	=> $current_time,
									'status' => 'completed',
									'txn_id' => 'free',
									'expire_date' => $expiry_date

								);

								eltd_listing_insert_table_row($table_name, $free_package_params);
								eltdAjaxStatus('success', esc_html__('You have successfully added new listing', 'eltd_listing'), $success_redirect);

							} else { // Package in database

								//Package expired
								if ( !eltd_listing_get_package_expiry_status( $current_user, $package_id ) ) {
									eltdAjaxStatus('error', esc_html__('Your package expired', 'eltd_listing'));
								} else {
									eltdAjaxStatus('success', esc_html__('You have successfully added new listing', 'eltd_listing'), $success_redirect );
								}

							}

						}

					}
				}

			}
			else {

				$requried_field_message = 'Error, required fields are empty.';

				if($post_array['post_title'] === ''){

					$requried_field_message .= 'Please, enter post title';

				}
				elseif($data_array['eltd_listing_package'] === ''){

					$requried_field_message .= 'Please, choose listing package';

				}
				eltdAjaxStatus('error', esc_html__($requried_field_message, 'eltd_listing'));
			}

		}

		wp_die();
	}
	add_action( 'wp_ajax_eltd_listing_add_listing', 'eltd_listing_add_listing' );
}

if(!function_exists( 'eltd_listing_edit_listing' )){

	function eltd_listing_edit_listing() {
		global $wpdb;

		if(empty($_POST) || !isset($_POST)) {
			eltdAjaxStatus('error', esc_html__('All fields are empty', 'eltd_listing'));
		} else {
			check_ajax_referer( 'eltd-ajax-edit-listing-nonce', 'security');

			$data = $_POST;

			$data_string = $data['post'];
			parse_str($data_string, $data_array);

			$meta_fields = array(
				'_thumbnail_id',
				'eltd_listing_address',
				'eltd_listing_address_latitude',
				'eltd_listing_address_longitude',
				'eltd_listing_subtitle',
				'eltd_listing_phone',
				'eltd_listing_video',
				'eltd_listing_audio',
				'eltd_listing_website',
				'eltd_listing_gallery_images_meta',
				'eltd_listing_open_hours',
				'eltd_listing_package',
				'eltd_listing_email',
				'eltd_listing_price',
				'eltd_listing_instagram_username',
				'eltd_listing_open_table_id'
			);
			$id = $data_array['post_id'];
			$meta_fields_values = array();
			$post_array = array();

			foreach($meta_fields as $meta_field) {
				if(isset($data_array[$meta_field])) {
					$meta_fields_values[$meta_field] = $data_array[$meta_field];
				}
			}
			if(isset($data_array['post_title'])) {
				$post_array['post_title'] = $data_array['post_title'];
			}
			if(isset($data_array['post_content'])) {
				$post_array['post_content'] = $data_array['post_content'];
			}
			if(isset($data_array['eltd_listing_excerpt'])) {
				$post_array['post_excerpt'] = $data_array['eltd_listing_excerpt'];
			}

			if ( eltd_listing_theme_installed() ) {
				$socials = search_and_go_elated_generate_listing_social_icons_array();
			} else {
				$socials = array();
			}
			foreach($socials as $key=>$value) {
				if (isset($data_array['eltd_listing_social_'.strtolower($key)]) && !empty($data_array['eltd_listing_social_'. strtolower($key)])) {
					$meta_fields_values['eltd_listing_social_'.strtolower($key)] = $data_array['eltd_listing_social_'.strtolower($key)];
				}
			}

			if(isset($data_array['eltd_listing_item_type']) && !empty($data_array['eltd_listing_item_type'])) {

				$type_id = $data_array['eltd_listing_item_type'];

				//set listing type id in update query
				$meta_fields_values['eltd_listing_item_type'] = $type_id;

				//get listing type custom fields
				$custom_fields = get_post_meta($type_id,'eltd_listing_type_custom_fields',true);
				if($custom_fields != ''){

					foreach($custom_fields as $custom_field) {

						if(isset($data_array[$custom_field['meta_key']])){

							$meta_fields_values[$custom_field['meta_key']] = $data_array[$custom_field['meta_key']];

						}

					}
				}

				//get listing type feature list
				$feature_list =  get_post_meta($type_id, 'eltd_listing_type_feature_list', true);

				if($feature_list[0] !== ''){

					foreach($feature_list as $feature_list_item) {

						$meta_fields_values['listing_feature_list_'.$type_id.'_'.sanitize_title($feature_list_item)] = $data_array['listing_feature_list_'.$type_id.'_'.sanitize_title($feature_list_item)];

					}
				}

			}

			if(!empty($post_array)){
				$post_array['ID'] = $id;

				//check required fields
				if($post_array['post_title'] !== '' && $data_array['eltd_listing_package'] !== ''){
					wp_update_post($post_array);
				}else{
					eltdAjaxStatus('error', esc_html__('Error, required fields are empty', 'eltd_listing'));
				}
			}
			if(isset($data_array['eltd_listing_tag'])) {
				$tags = array();
				foreach( $data_array['eltd_listing_tag'] as $tag_item ) {
					$tags[] = $tag_item;
				}
				wp_set_object_terms($id, $tags, 'listing-item-tag');
			}

			if(isset($data_array['eltd_listing_location'])) {
				$locations = array();
				foreach( $data_array['eltd_listing_location'] as $location_item ) {
					$locations[] = (int)$location_item;
				}
				wp_set_object_terms($id, $locations, 'listing-item-location');
			}


			if(isset($data_array['eltd_listing_category'])) {
				$categories = array();
				foreach( $data_array['eltd_listing_category'] as $cat_item ) {
					$categories[] = (int) $cat_item;
				}
				wp_set_object_terms($id, $categories, 'listing-item-category');
			}

			//get attachment image url by id and save in proper meta field
			if(isset($data_array['eltd_title_area_background_image_meta'])) {

				$title_img = wp_get_attachment_image_src($data_array['eltd_title_area_background_image_meta_id'],'full');
				update_post_meta($id, 'eltd_title_area_background_image_meta', $title_img[0]);
				update_post_meta($id, 'eltd_title_area_background_image_meta_id', $data_array['eltd_title_area_background_image_meta_id']);

			}
			foreach($meta_fields_values as $meta_field=>$value) {
				update_post_meta($id, $meta_field, $value);
			}
			$dashboard_url = eltd_listing_get_dashboard_page_url();
			$success_redirect = esc_url(add_query_arg( array('user-action' => 'listings'), $dashboard_url ));
			if ( $id != 0 ) {

				if(isset($data_array['eltd_listing_package_type'])){
					$html = '';

					$current_user = get_current_user_id();
					$package_id = $data_array['eltd_listing_package'];

					if(strtolower($data_array['eltd_listing_package_type']) == 'paid'){

						//send user to pay pal if is first payment or first payment wasn't successfull or package is expired
						$package = eltd_listing_get_package_status( $package_id, $current_user );
						$package_price = $data_array['eltd_listing_package_discount_price'] != '' ? $data_array['eltd_listing_package_discount_price'] :$data_array['eltd_listing_package_price'];
						$payment_params = array(
							'package_id' => $data_array['eltd_listing_package'],
							'package_title' => $data_array['eltd_listing_package_title'],
							'package_price'	=> $package_price,
						);
						$custom_array = array();

						$send_to_paypal = false;
						if ( empty($package) ) { // No package in database

							// Add package
							$custom_array = array(
								'user_id' => get_current_user_id(),
								'type'	=> 	 'common'
							);
							$send_to_paypal = true;

						} else { // Package in database

							// Not paid
							if ( ! eltd_listing_get_package_payment_status( $current_user, $package_id ) ) {
								$custom_array = array(
									'user_id' => get_current_user_id(),
									'type'	=> 	 'common'
								);
								$send_to_paypal = true;
							}

							// Expired
							if ( ! eltd_listing_get_package_expiry_status( $current_user, $package_id ) ) {
								$custom_array = array(
									'user_id' => get_current_user_id(),
									'type'	=> 	 'update_expired_package'
								);
								$send_to_paypal = true;
							}

						}

						$payment_params['custom_array'] = $custom_array;

						if ( $send_to_paypal ) {
							$html .= eltd_listing_get_dashboard_module_template_part('templates', 'paypal-payment-form','', $payment_params);
							eltdAjaxStatus('success', esc_html__('You will be redirected to PayPal', 'eltd_listing'),'', $html);
						} else {
							eltdAjaxStatus('success', esc_html__('You have successfully edited listing', 'eltd_listing'), $success_redirect);
						}

					} elseif(strtolower($data_array['eltd_listing_package_type']) == 'free') {

						if(isset($data_array['eltd_listing_package_availability'])){

							$package = eltd_listing_get_package_status( $package_id, $current_user);

							if ( empty( $package ) ) { // No package in database

								$package_interval = $data_array['eltd_listing_package_availability'];
								$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';

								$current_time = current_time( 'mysql' );

								//convert current time format
								$formated_date = new DateTime('now');
								$formated_date->setTimezone(new DateTimezone( 'UTC' ));

								$formated_date->add(new DateInterval('P' . $package_interval . 'D'));
								$expiry_date = $formated_date->format('Y-m-d\TH:i:s\Z');

								$free_package_params = array(

									'user_id' => $current_user,
									'package_id' => $package_id,
									'payment_date'	=> $current_time,
									'status' => 'completed',
									'txn_id' => 'free',
									'expire_date' => $expiry_date

								);

								eltd_listing_insert_table_row($table_name, $free_package_params);
								eltdAjaxStatus('success', esc_html__('You have successfully updated listing', 'eltd_listing'), $success_redirect );

							} else {

								if ( !eltd_listing_get_package_expiry_status( $current_user, $package_id ) ) {
									eltdAjaxStatus('error', esc_html__('Your package expired', 'eltd_listing'));
								} else {
									eltdAjaxStatus('success', esc_html__('You have successfully updated listing', 'eltd_listing'), $success_redirect );
								}
							}

						}

					}
				}
			}
			$dashboard_url = eltd_listing_get_dashboard_page_url();
			$success_redirect = esc_url(add_query_arg( array('user-action' => 'listings'), $dashboard_url ));
			eltdAjaxStatus('success', esc_html__('You have successfully updated listing', 'eltd_listing'), $success_redirect);
		}
		wp_die();
	}
	add_action( 'wp_ajax_eltd_listing_edit_listing', 'eltd_listing_edit_listing' );
}

if(!function_exists( 'eltd_listing_user_listings' )){

	function eltd_listing_user_listings($params = array()) {
		global $wpdb;

		$user_id = get_current_user_id();
		$results = array();

		$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';
		$user_packages = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name where user_id=%d", $user_id));

		foreach ( $user_packages as $package ) {
			$package_id = $package->package_id;
			$package_expiry_date = $package->expire_date;
			$package = get_post( $package_id );

			$query_args = array(
				'post_type' => 'listing-item',
				'post_status' => array( 'pending', 'publish' ),
				'author' => $user_id,
				'meta_key'   => 'eltd_listing_package',
				'meta_value' => $package_id,
				'posts_per_page'=> '-1'
			);

			$return_items = new \WP_Query($query_args);
			if ( $return_items->have_posts() ) {
				$results[] = array(
					'package' => $package,
					'expiry_date' => $package_expiry_date,
					'items' => $return_items->have_posts() ? $return_items : null
				);
			}

		}
		$html = '';

		$html .= '<div class="eltd-user-listings-holder">';
		$html .= eltd_listing_dashboard_page_top_area(esc_html__('My Listings', 'eltd_listing'), esc_html__($params['subtitle_text'], 'eltd_listing'));

		$admin_listings_html = '';
		$has_listings = false;

		if(current_user_can( 'manage_options' )){
			$admin_listings_html = search_and_go_elated_get_admin_listings_outside_of_the_package($user_id);
		}

		if($results || $admin_listings_html !== ''){
			$has_listings = true;
		}
		if($has_listings){
			if ( $results ) {
				foreach ( $results as $result ) {
					$html .= eltd_listing_get_dashboard_module_template_part('templates','listings', '', $result);
				}
			}
			//get html of admin listings which are not set in any package
			if(current_user_can( 'manage_options' )){
				$html .= $admin_listings_html;
			}
		}
		elseif(!$has_listings) {

			$dashboard_url = eltd_listing_get_dashboard_page_url();

			$html .= '<div class="eltd-listing-empty-listings-holder">';
			$html .= '<p>' . esc_html__( 'You currently have no listings', 'eltd_listing' ) . '</p>';
			if ( eltd_listing_theme_installed() ) {
				$html .= search_and_go_elated_get_button_html( array(
					'type' => 'outline',
					'text' => esc_html__('Add New Listing', 'eltd_listing'),
					'link' => esc_url(add_query_arg( array('user-action' => 'add_new_listing'), $dashboard_url )),
					'icon_pack' => 'font_elegant',
					'fe_icon' => 'arrow_carrot-right'
				) );
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}

}

if(!function_exists( 'eltd_listing_user_whislist' )){

	function eltd_listing_user_whislist( $params = array()) {

		$users_wishlists = eltd_listing_get_user_whislist();
		$html = '';

		if ( $users_wishlists ) {

			$query_args = array(
				'post_type' => 'listing-item',
				'post__in' => $users_wishlists
			);

			$query = new WP_Query($query_args);

			if ( $query->post_count ) {

				$shortcode_params = array(
					'listing_basic_columns' => 'two',
					'listing_advanced_query'	=> $query
				);

				$html .= eltd_listing_dashboard_page_top_area(esc_html__('My Whislist', 'eltd_listing'),esc_html__($params['subtitle_text'],'eltd_listing'));

				if ( eltd_listing_theme_installed() ) {
					$html .= search_and_go_elated_execute_shortcode('eltd_listing_basic', $shortcode_params);
				}

			} else {

				$html .= eltd_listing_dashboard_page_top_area(esc_html__('My Whislist', 'eltd_listing'),esc_html__($params['subtitle_text'],'eltd_listing'));

				$html .= '<div class="eltd-listing-empty-wishlist-holder">';
				$html .= '<p>' . esc_html__('Your wishlist is empty.', 'eltd_listing') . '</p>';
				$html .= '</div>';
				
			}

		} else {

			$html .= eltd_listing_dashboard_page_top_area(esc_html__('My Whislist', 'eltd_listing'),esc_html__($params['subtitle_text'],'eltd_listing'));

			$html .= '<div class="eltd-listing-empty-wishlist-holder">';
			$html .= '<p>' . esc_html__('Your wishlist is empty.', 'eltd_listing') . '</p>';
			$html .= '</div>';
		}

		return $html;
	}

}

if(!function_exists( 'eltd_listing_add_listing_to_whislist' )){

	function eltd_listing_add_listing_to_whislist() {

		$user_id = get_current_user_id();
		if(empty($_POST) || !isset($_POST)) {
			eltdAjaxStatus('error', esc_html__('All fields are empty', 'eltd_listing'));
		} else {
			$listing_id = $_POST['listingID'];
			$current_listing_array =  get_user_meta($user_id, 'eltd_listing_whislist', true);

			if(!empty($current_listing_array) && in_array($listing_id, $current_listing_array)) {
				$temp_array[] = $listing_id;
				$current_listing_array = array_diff($current_listing_array, $temp_array);
				$message = esc_html__('Add to Wishlist', 'eltd_listing');
				$added = false;
			} else {
				$current_listing_array[] = $listing_id;
				$current_listing_array = array_unique($current_listing_array);
				$message = esc_html__('Remove from Wishlist', 'eltd_listing');
				$added = true;
			}

			update_user_meta($user_id, 'eltd_listing_whislist', $current_listing_array);
			$output = json_encode( array(
				'message' => $message,
				'class'=>$added
			));
			exit($output);
		}
		wp_die();
	}
	add_action( 'wp_ajax_eltd_listing_add_listing_to_whislist', 'eltd_listing_add_listing_to_whislist' );
}

if(!function_exists( 'eltd_listing_whislist' )){

	function eltd_listing_whislist() {

		$html = '';

		$post_id = get_the_ID();
		if(is_user_logged_in()) {
			if (in_array($post_id, eltd_listing_get_user_whislist())) {
				$title = esc_html__('Remove listing from wishlist', 'eltd_listing');
				$class = 'eltd-added-to-wishlist';
			} else {
				$title = esc_html__('Add listing to wishlist', 'eltd_listing');
				$class = '';
			}
		} else {
			$class = '';
			$title = '';
		}
		$html .= '<a class="eltd-listing-whislist ' . $class .  '" data-listing-id = "' . get_the_ID() . '" title="' . $title . '"><i class="icon-heart"></i></a>';

		return $html;
	}

}

if(!function_exists( 'eltd_listing_get_user_whislist' )){

	function eltd_listing_get_user_whislist() {
		$user_id = get_current_user_id();

		$user_wishlist = get_user_meta($user_id, 'eltd_listing_whislist', true);
		if(!empty($user_wishlist)) {
			return $user_wishlist;
		}

		return array();
	}

}

if(!function_exists( 'eltd_listing_user_comments_and_reviews' )){

	function eltd_listing_user_comments_and_reviews($params = array()) {

		$html = '';
		$comments_args = array(
			'post_type' => 'listing-item',
			'author__in' => get_current_user_id()
		);

		$html .= eltd_listing_dashboard_page_top_area(esc_html__('Comments and Reviews', 'eltd_listing'));
		$html .= eltd_listing_dashboard_get_user_holder($params['user_id'], $params['sign_out_button_params']);

		$comments = get_comments($comments_args);
		foreach($comments as $comment) :
			$html .= eltd_listing_get_dashboard_module_template_part('templates','reviews', '', array('comment'=>$comment));
		endforeach;

		return $html;
	}


}

if(!function_exists( 'eltd_listing_block_owner_access' )) {

	function eltd_listing_block_owner_access() {
		if (is_admin() && current_user_can('owner') && !(defined('DOING_AJAX') && DOING_AJAX)) {
				wp_redirect(eltd_listing_get_dashboard_page_url());
			exit;
		}
	}

	add_action('init', 'eltd_listing_block_owner_access' );
}

if(!function_exists( 'eltd_listing_get_listing_fields' )){
    /**
     * Ajax call
     * Function that returns specific listing item fields
     */
    function eltd_listing_get_listing_fields(){
        if(isset($_POST['listingTypeId'])){

			$params = array();
			$html = '';
	        if ( eltd_listing_theme_installed() ) {
		        $predefined_fields = search_and_go_elated_check_predefined_fields($_POST['listingTypeId']);
		        $params['working_days'] = search_and_go_elated_generate_day_array();
		        $params['social'] = search_and_go_elated_generate_listing_social_icons_array();
	        } else {
		        $predefined_fields = array();
	        }

			if(isset($_POST['listingItemId'])) {
				$params['listing_ID'] = $_POST['listingItemId'];
			}else {
				$params['listing_ID'] = -1;
			}

			foreach($predefined_fields as $predefined_field=>$value) {
				$param_field =  str_replace('eltd_listing_type_', '', $predefined_field);
				$params[$param_field] = $value;
			}
	        $params['media_icon_multiple_images_params'] = array(
		        'icon_pack' => 'linea_icons',
		        'linea_icon' => 'icon-basic-picture-multiple',
		        'custom_size' => '40',
		        'icon_color'  => '#a7a7a7'
	        );
	        $params['listing_type_id'] = $_POST['listingTypeId'];
	        $params['category_meta_query'] = search_and_go_elated_get_type_category_meta_params($_POST['listingTypeId']);

	        $params['category_defaults'] = array();
	        $params['tags_defaults'] = array();
	        if($params['listing_ID'] !== '-1'){
		        $params['category_defaults'] = search_and_go_elated_get_taxonomy_defaults($params['listing_ID'], 'listing-item-category');
		        $params['tags_defaults'] = search_and_go_elated_get_taxonomy_defaults($params['listing_ID'], 'listing-item-tag');
	        }

			$html .= eltd_listing_get_dashboard_module_template_part('templates','listing-type-fields', '', $params);
			echo $html;
			eltd_listing_get_custom_listing_fields($_POST['listingTypeId'], $params['listing_ID']);
        }
        wp_die();
    }

	add_action('wp_ajax_eltd_listing_get_listing_fields', 'eltd_listing_get_listing_fields' );
}

if(!function_exists( 'eltd_listing_get_custom_listing_fields' )){

	function eltd_listing_get_custom_listing_fields($id, $itemId){

		$custom_fields = get_post_meta($id, 'eltd_listing_type_custom_fields',true);
		$feature_list  =  get_post_meta($id, 'eltd_listing_type_feature_list', true);
		$listing_type_id = $id;

		if($custom_fields != ''){ ?>
			<div class="eltd-listing-custom-fields-holder">

				<h5 class="eltd-listing-custom-fields-title-holder">
					<?php esc_html_e('Specifications', 'eltd_listing'); ?>
				</h5>

				<?php
				$text_fields_array = $select_fields_array = $textarea_fields_array = $checkbox_fields_array = array();

				if(is_array($custom_fields) && count($custom_fields)){

					foreach($custom_fields as $custom_field) {

						switch ($custom_field['type']):
							case 'text':
								$text_fields_array[] = $custom_field;
								break;
							case 'select':
								$select_fields_array[] =$custom_field;
								break;
							case 'textarea':
								$textarea_fields_array[] = $custom_field;
								break;
							case 'checkbox':
								$checkbox_fields_array[] = $custom_field;
								break;
						endswitch;
					}
				}

				//render all text custom fields
				if(is_array($text_fields_array) && count($text_fields_array)){ ?>
					<div class="eltd-listing-custom-text-fields-holder">
						<?php foreach($text_fields_array as $custom_field){ ?>

							<div class="eltd-new-listing-item">

								<label for="<?php echo esc_attr($custom_field['meta_key']); ?>">
									<?php echo esc_attr($custom_field['title']); ?>
								</label>

								<div class="eltd-profile-input">
									<input name="<?php echo esc_attr($custom_field['meta_key']); ?>" type="text"
										id="<?php echo esc_attr($custom_field['meta_key']); ?>" class="eltd-input-field"
										value="<?php echo eltd_listing_check_listing_custom_fields_values(eltd_listing_check_listing_fields_values($itemId, $custom_field['meta_key']), esc_attr($custom_field['default_value'])); ?>"/>
								</div>

							</div>

						<?php }?>
					</div>
				<?php }

				//render all select custom fields
				if(is_array($select_fields_array) && count($select_fields_array)){ ?>
					<div class="eltd-listing-custom-select-fields-holder">
						<?php foreach($select_fields_array as $custom_field){ ?>

							<div class="eltd-new-listing-item">

								<label for="<?php echo esc_attr($custom_field['meta_key']); ?>">
									<?php echo esc_attr($custom_field['title']); ?>
								</label>

								<div class="eltd-profile-input">
									<select name="<?php echo esc_attr($custom_field['meta_key']); ?>" id="<?php echo esc_attr($custom_field['meta_key']); ?>">
										<?php foreach ($custom_field['options'] as $options=>$key) :
											$selected = '';
											if( eltd_listing_check_listing_fields_values($itemId, $custom_field['meta_key']) == $options){
												$selected = 'selected';
											}
											?>
											<option value="<?php echo esc_attr($options); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($key); ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>

						<?php }?>
					</div>
				<?php }

				//render all textarea custom fields
				if(is_array($textarea_fields_array) && count($textarea_fields_array)){ ?>
					<div class="eltd-listing-custom-textarea-fields-holder">
						<?php foreach($textarea_fields_array as $custom_field){ ?>

							<div class="eltd-new-listing-item">

								<label for="<?php echo esc_attr($custom_field['meta_key']); ?>">
									<?php echo esc_attr($custom_field['title']); ?>
								</label>

								<div class="eltd-profile-input">
									<textarea name="<?php echo esc_attr($custom_field['meta_key']); ?>" id="<?php echo esc_attr($custom_field['meta_key']); ?>" class="eltd-textarea-field"><?php echo eltd_listing_check_listing_custom_fields_values(eltd_listing_check_listing_fields_values($itemId, $custom_field['meta_key']), esc_attr($custom_field['default_value'])); ?></textarea>
								</div>

							</div>

						<?php }?>
					</div>
				<?php }

			//render all checkbox custom fields
			if(is_array($checkbox_fields_array) && count($checkbox_fields_array)){ ?>
				<div class="eltd-listing-custom-checkbox-fields-holder clearfix">
					<?php foreach($checkbox_fields_array as $custom_field){

						$checked = '';
						if( eltd_listing_check_listing_fields_values($itemId, $custom_field['meta_key']) == '1'){
							$checked = 'checked';
						}
						?>

						<div class="eltd-profile-input">
							<div class="eltd-checkbox-holder">
								<div class="eltd-listing-checkbox-input"></div>
							</div>
							<div class="eltd-label-holder">
								<input name="<?php echo esc_attr($custom_field['meta_key']); ?>" type="checkbox" value="1"  class="eltd-checkbox-field"  <?php echo esc_attr($checked); ?> />
								<label for="<?php echo esc_attr($custom_field['meta_key']); ?>"  class ="eltd-checbox-label"><?php echo esc_attr($custom_field['title']); ?></label>
								<input name="<?php echo esc_attr($custom_field['meta_key']); ?>" class="eltd-checkbox-field-hidden" type="hidden"/>
							</div>
						</div>

					<?php }?>
				</div>
			<?php } ?>


			</div> <!-- close eltd-listing-custom-fields-holder -->

		<?php }

		if( $feature_list[0] !== '' ) { ?>

			<div class="eltd-new-listing-item">

				<h5 class="eltd-listing-custom-fields-title-holder">
					<?php esc_html_e('Amenities', 'eltd_listing'); ?>
				</h5>

				<div class="eltd-listing-amenities-holder clearfix">

					<?php foreach($feature_list as $feature_list_item) {

						$checked = '';

						if( eltd_listing_check_listing_fields_values($itemId, 'listing_feature_list_' . $listing_type_id . '_' . sanitize_title($feature_list_item)) == '1'){
							$checked = 'checked';
						}
						?>

						<div class="eltd-profile-input">
							<div class="eltd-checkbox-holder">
								<div class="eltd-listing-checkbox-input"></div>
							</div>
							<div class="eltd-label-holder">
								<input name="listing_feature_list_<?php echo $listing_type_id.'_'.sanitize_title($feature_list_item); ?>" id="listing_feature_list_<?php echo $listing_type_id.'_'.sanitize_title($feature_list_item); ?>"type="checkbox" value="1" class="eltd-checkbox-field eltd-input-field" <?php echo esc_attr($checked); ?>/>
								<label  class ="eltd-checbox-label" for="listing_feature_list_<?php echo $listing_type_id.'_'.sanitize_title($feature_list_item); ?>"><?php echo esc_attr($feature_list_item); ?></label>
								<input name="listing_feature_list_<?php echo $listing_type_id.'_'.sanitize_title($feature_list_item); ?>" class="eltd-checkbox-field-hidden" type="hidden"/>
							</div>
						</div>

					<?php } ?>

				</div>

			</div>

		<?php }
	}

}

if(!function_exists( 'eltd_listing_get_category_args' )){

    function eltd_listing_get_category_args($default_values = array()){

		$args = array(
			'taxonomy'               => 'listing-item-category',
			'hide_empty'             => 0,
			'select_name'            => 'eltd_listing_category[]',
			'class'                  => 'eltd-multiselect-field',
			'id'                 	 => 'eltd-listings-categories'
		);

		$args = array_merge($args, $default_values);

		return $args;
    }
}

if(!function_exists( 'eltd_listing_get_location_args' )){

	function eltd_listing_get_location_args($default_values = array()){

		$args = array(
			'taxonomy'               => 'listing-item-location',
			'hide_empty'             => 0,
			'select_name'            => 'eltd_listing_location[]',
			'class'                  => 'eltd-multiselect-field',
			'id'                 	 => 'eltd-listings-locations'
		);

		$args = array_merge($args, $default_values);

		return $args;
	}
}

if(!function_exists( 'eltd_listing_get_tags_args' )){

	function eltd_listing_get_tags_args($default_values = array()){

		$args = array(
			'taxonomy'               => 'listing-item-tag',
			'hide_empty'             => 0,
			'hierarchical'           => false,
			'select_name'            => 'eltd_listing_tag[]',
			'class'                  => 'eltd-listings-tags',
			'id'                 	 => 'eltd-listings-tags',
		);
		$args = array_merge($args, $default_values);
		return $args;
	}
}

if(!function_exists( 'eltd_listing_listing_types' )){

	function eltd_listing_listing_types($id = ''){

			$args = array(
				'post_type' => 'listing-type-item',
				'post_status' => 'publish',
				'posts_per_page' => '-1'
			);

			if($id != '') {
				$active_item_id = eltd_listing_check_listing_fields_values($id, 'eltd_listing_item_type');
			}else{
				$active_item_id = '';
			}

			$listing_types = new WP_Query($args);

			if( $listing_types->have_posts() ) { ?>

				<div class="eltd-new-listing-item">

					<label for="listing_type">
						<?php esc_html_e('Listing Category', 'eltd_listing'); ?>
					</label>

					<div class="eltd-profile-input">

						<select name="eltd_listing_type" class="eltd-listing-type-select-field">
							<option></option>
							<?php

							$selected = '';
							$active_class = '';
							$data_params = '';

							if($id !== ''){
								$data_params = 'data-listing-id = ' .esc_attr($id);
							}

							while ($listing_types->have_posts()) {

								$listing_types->the_post();

								if($id != ''){

									if($active_item_id == get_the_ID()){

										$active_class = 'eltd-active-listing-type';

									} else {

										$active_class = '';

									}

									$choosen_id = get_the_ID();
									$selected = (int) $active_item_id == $choosen_id ? 'selected' : '';

								}
								?>


								<option  <?php print $data_params?> value="<?php echo esc_attr(get_the_ID())?>" <?php echo $selected; ?> class="<?php echo esc_attr($active_class)?>">

									<?php echo esc_attr(get_the_title())?>

								</option>


							<?php } ?>

						</select>

						<input type="hidden" id="eltd-listing-type-value" name="eltd_listing_item_type" value="<?php echo esc_attr($active_item_id); ?>" />

					</div>

				</div>

				<div class="eltd-new-listing-type-fields"></div>
			<?php }
			wp_reset_postdata();

	}
}

if(!function_exists( 'eltd_listing_listing_packages' )){

	function eltd_listing_listing_packages( $package_id = '' ){

		$args = array(
			'post_type' => 'listing-package',
			'post_status' => 'publish',
			'posts_per_page' => '-1'
		);
		$current_user_id = get_current_user_id();

		$listing_packages = new WP_Query($args);

		$data_params = '';
		if ( eltd_listing_theme_installed() ) {
			$paypal_currency = search_and_go_elated_options()->getOptionValue('paypal_currency');
			$paypal_receiver_id = search_and_go_elated_options()->getOptionValue('paypal_receiver_id');
		} else {
			$paypal_currency = '';
			$paypal_receiver_id = '';
		}

		if ( $paypal_currency !== '') {
			$data_params .= 'data-currency = ' . $paypal_currency . ' ';
		}

		if ( $paypal_receiver_id !== '' ) {
			$data_params .= 'data-receiver-id = '.$paypal_receiver_id. ' ';
		}

		$data_params .= 'data-user-id = '.$current_user_id. ' ';

		if( $listing_packages->have_posts() ) { ?>
			<div class="eltd-new-listing-item eltd-listing-item-package" >

				<label for="listing_package">
					<?php esc_html_e('Listing Package', 'eltd_listing'); ?>
					<span class="eltd-listing-required-field">*</span>
				</label>

				<div class="eltd-profile-input">

					<select name="eltd_listing_package" class="eltd-listing-select-field eltd-listing-select-package" <?php echo esc_attr($data_params)?>>

						<option></option>
						<?php while ($listing_packages->have_posts()) : $listing_packages->the_post();

							$id = get_the_ID();
							$selected = (int) $package_id == $id ? 'selected' : '';
							?>

							<option value="<?php echo esc_attr(get_the_ID())?>" <?php echo $selected; ?>>
								<?php echo esc_attr(get_the_title())?>
							</option>

						<?php endwhile; ?>

					</select>

				</div>


				<div class="eltd-new-listing-package-fields">
					<div class="eltd-listing-package-fields-wrapper clearfix"></div>
				</div>

			</div>

		<?php }
		wp_reset_postdata();

	}
}

if(!function_exists( 'eltd_listing_check_listing_fields_values' )){

	function eltd_listing_check_listing_fields_values($id, $field_name, $meta = true, $type = '', $standard_field = ''){

		$value = '';
		if($id != -1) {
			if($meta) {
				$value = get_post_meta($id, $field_name, true);
			} else {
				if(isset($standard_field)){
					switch ($standard_field):

						case 'title':
								$value = get_the_title($id);
							break;
						case 'content':
								$value =  get_post_field('post_content', $id);
							break;
						case 'excerpt':
								$value =  get_post_field('post_excerpt', $id);
							break;
					endswitch;
				}
			}
		}

		return $value;
	}
}

if(!function_exists( 'eltd_listing_check_listing_custom_fields_values' )){
	/**
	 * @param $current_value
	 * @param $default_value
	 *
	 * @return string
	 */
	function eltd_listing_check_listing_custom_fields_values($current_value, $default_value){

		$value = '';

		if($current_value != ''){
			$value = $current_value;
		} elseif ($default_value != ''){
			$value = $default_value;
		}

		return $value;
	}
}

if(!function_exists( 'eltd_listing_get_dropdown_tax_terms' )){
	/**
	 * @param array $args
	 *
	 * @return bool|string
	 */
    function eltd_listing_get_dropdown_tax_terms($args = array()){

        if(empty($args['taxonomy'])){
            return false;
        }

        $defaults = array(
            'orderby'                => 'name',
            'order'                  => 'ASC',
            'hide_empty'             => false,
            'include'                => array(),
            'exclude'                => array(),
            'exclude_tree'           => array(),
            'number'                 => '',
            'offset'                 => '',
            'fields'                 => 'all',
            'name'                   => '',
            'slug'                   => '',
            'hierarchical'           => true,
            'search'                 => '',
            'name__like'             => '',
            'description__like'      => '',
            'pad_counts'             => false,
            'get'                    => '',
            'child_of'               => 0,
            'parent'                 => 0,
            'childless'              => false,
            'cache_domain'           => 'core',
            'update_term_meta_cache' => true,
            'meta_query'             => '',
            'multiple' => true,
            'class'    => '',
            'select_name'     => '',
            'defaults'  => array()
        );

        $args = wp_parse_args( $args, apply_filters( 'get_terms_defaults', $defaults) );

        $terms = get_terms($args['taxonomy'], $args);

        $html = '<select name="'.$args['select_name'].'" class="'.$args['class'].'"'.($args['multiple']?"multiple":"").'>';

        foreach($terms as $term){

            $children = get_term_children($term->term_id, $args['taxonomy']);
			if($args['hierarchical']){
				$html.= '<option '.(in_array(($term->term_id),$args['defaults'])?'selected':'').' value="'.$term->term_id.'">'.$term->name.'</option>';
			}else {
				$html.= '<option '.(in_array(($term->term_id),$args['defaults'])?'selected':'').' value="'.$term->name.'">'.$term->name.'</option>';
			}

            if(!empty($children)){
                $html .= eltd_listing_get_term_children($children, $args['taxonomy'],$args['defaults']);
            }

        }

        $html .= '</select>';

        return $html;
    }
}

if(!function_exists( 'eltd_listing_get_checkbox_tax_terms' )){
	
	function eltd_listing_get_checkbox_tax_terms($args = array() , $listing_id = ''){
		if(empty($args['taxonomy'])){
            return false;
        }

        $defaults = array(
            'orderby'                => 'name',
            'order'                  => 'ASC',
            'hide_empty'             => false,
            'include'                => array(),
            'exclude'                => array(),
            'exclude_tree'           => array(),
            'number'                 => '',
            'offset'                 => '',
            'fields'                 => 'all',
            'name'                   => '',
            'slug'                   => '',
            'hierarchical'           => true,
            'search'                 => '',
            'name__like'             => '',
            'description__like'      => '',
            'pad_counts'             => false,
            'get'                    => '',
            'child_of'               => 0,
            'parent'                 => 0,
            'childless'              => false,
            'cache_domain'           => 'core',
            'update_term_meta_cache' => true,
            'meta_query'             => '',
            'multiple' => true,
            'class'    => '',
            'select_name'     => '',
			'taxonomy'	=> '',
            'defaults'  => array()
        );
		
        $args = wp_parse_args( $args, apply_filters( 'get_terms_defaults', $defaults) );
		$terms = get_terms($args['taxonomy'], $args);
		$return_array = array();
		$html = '';
		
		$current_listing_tags = array();
		
		if($listing_id !== ''){
			$current_listing_tags = wp_get_post_terms($listing_id, $args['taxonomy'], array("fields" => "ids"));
		}
		
		foreach($terms as $term){
			
			$checked = '';
			if(in_array($term->term_id, $current_listing_tags)){
				$checked = 'checked';
			}
			$children = get_term_children($term->term_id, $args['taxonomy']);
			$html .= '<div class="eltd-listing-tax-wrapper">';
			$html .= '<div class="eltd-listing-checkbox-input"></div>';
			$html .= '<input type="checkbox" name="'.$args['select_name'].'_'.$term->term_id.'" id="'.$args['select_name'].'_'.$term->term_id.'" class="eltd-input-field eltd-advanced-input-field" value="'.$term->name.'"/ '.$checked.' >';
			$html .= '<label for="'.$args['select_name'].'_'.$term->term_id.'" class="eltd-checbox-label">'.$term->name.'</label>';
			$html .= '</div>';
			
			$return_array[] = $args['select_name'].'_'.$term->term_id;

            if(!empty($children)){
                $html .= eltd_listing_get_term_children($children, $args['taxonomy'],$args['defaults']);
            }
			
		}	
		$html .= '<input type="hidden" name="'.$args['select_name'].'" value="'.implode(' ',$return_array).'"/>';
		return $html;
		
	}
	
}

if ( ! function_exists( 'eltd_listing_get_term_children' ) ) {

	function eltd_listing_get_term_children($children, $taxonomy, $defaults = array()){
		$html = '';
		$level = 1;
		$space = '&nbsp;&nbsp;';
		foreach($children as $child){
			$space = str_repeat($space, $level++);
			$term = get_term_by( 'id', $child, $taxonomy);
			$html.= '<option '.(in_array(($term->term_id),$defaults)?'selected':'').' value="'.$child.'">'.$space.$term->name.'</option>';
		}
		return $html;
	}

}

if(!function_exists( 'eltd_listing_add_listing_form' )) {

	function eltd_listing_add_listing_form($user_id) {

		if(is_user_logged_in() && current_user_can( 'edit_posts' )) {
			
			$params['tags_args'] = eltd_listing_get_tags_args();
			$params['category_args'] = eltd_listing_get_category_args();
			$params['separator_args'] = array(
				'icon_pack' => 'linear_icons',
				'linear_icons'	=> 'lnr-cog',
				'width'			=>	'85',
				'thickness'		=>	'1'
			);
			if ( eltd_listing_theme_installed() ) {
				$params['subtitle_text'] = search_and_go_elated_options()->getOptionValue('dasboard_new_listing_text');
			} else {
				$params['subtitle_text'] = '';
			}
			$params['user_id'] = $user_id;			
			
			$params['sign_out_button_params'] = array(
				'text' => esc_html__('Sign out',  'eltd_listing'),
				'icon_pack' => 'font_elegant',
				'fe_icon'	=> 'arrow_carrot-right'
			);
			
			$params['media_icon_params'] = array(
				'icon_pack' => 'linea_icons',
				'linea_icon' => 'icon-basic-server-download',
				'custom_size' => '40',
				'icon_color'  => '#a7a7a7'				
			);

			$icon_color = '#1ab5c1';
			if(search_and_go_elated_options()->getOptionValue('first_color') !== ''){
				$icon_color  = search_and_go_elated_options()->getOptionValue('first_color');
			}
			$params['media_icon_add_photo_params'] = array(
				'icon_pack' => 'font_elegant',
				'fe_icon' => 'arrow_carrot-right',
				'custom_size' => '13',
				'icon_color'  => $icon_color
			);

			$html = eltd_listing_get_dashboard_module_template_part('templates', 'add-new-listing', '', $params);
		} else {
			$html = esc_html__('You don\'t have permissions to add new listing', 'eltd_listing');
		}
		return $html;
	}
}

if(!function_exists( 'eltd_listing_edit_listing_form' )) {

	function eltd_listing_edit_listing_form($user_id) {
		if(isset($_GET['listing-id']) && is_user_logged_in() && current_user_can( 'edit_posts' ) && get_current_user_id() == get_post_field( 'post_author', $_GET['listing-id'] )) {
			$params['tags_args'] = eltd_listing_get_tags_args(array( 'defaults' => wp_get_post_terms($_GET['listing-id'], 'listing-item-tag', array( "fields" => "ids"))));
			$params['category_args'] = eltd_listing_get_category_args(array( 'defaults' => wp_get_post_terms($_GET['listing-id'], 'listing-item-category', array( "fields" => "ids"))));
			$params['listing_ID'] = $_GET['listing-id'];
			$params['separator_args'] = array(
				'icon_pack' => 'linear_icons',
				'linear_icons'	=> 'lnr-cog',
				'width'			=>	'85',
				'thickness'		=>	'1'
			);
			if ( eltd_listing_theme_installed() ) {
				$params['subtitle_text'] = search_and_go_elated_options()->getOptionValue('dasboard_edit_listing_text');
			} else {
				$params['subtitle_text'] = '';
			}
			$params['user_id'] = $user_id;
			
			$params['sign_out_button_params'] = array(
				'text' => esc_html__('Sign out',  'eltd_listing'),
				'icon_pack' => 'font_elegant',
				'fe_icon'	=> 'arrow_carrot-right'
			);
			
			$params['media_icon_params'] = array(
				'icon_pack' => 'linea_icons',
				'linea_icon' => 'icon-basic-server-download',
				'custom_size' => '40',
				'icon_color'  => '#a7a7a7'				
			);
			$icon_color = '#1ab5c1';
			if(search_and_go_elated_options()->getOptionValue('first_color') !== ''){
				$icon_color  = search_and_go_elated_options()->getOptionValue('first_color');
			}
			$params['media_icon_add_photo_params'] = array(
				'icon_pack' => 'font_elegant',
				'fe_icon' => 'arrow_carrot-right',
				'custom_size' => '13',
				'icon_color'  => $icon_color
			);
			
			
			$html = eltd_listing_get_dashboard_module_template_part('templates','edit-listing', '', $params);
		} else {
			$html = esc_html__('You don\'t have permissions to edit this listing', 'eltd_listing');
		}

		return $html;
	}
}

if ( ! function_exists( 'eltd_listing_delete_listing' ) ) {

	function eltd_listing_delete_listing() {

		if ( isset($_POST['listingId']) ) {
			wp_delete_post( $_POST['listingId'] );
			echo 'Post successfully deleted';
		}
		wp_die();

	}
	
	add_action( 'wp_ajax_eltd_listing_delete_listing', 'eltd_listing_delete_listing' );

}

if(!function_exists( 'eltd_listing_dashboard_get_user_holder' )){
	
	function eltd_listing_dashboard_get_user_holder($user_id, $sign_out_button_params){
		
		$user_link = get_author_posts_url($user_id);
		$user_nickname = get_the_author_meta( 'display_name', $user_id );
		$html = '';
		
		$html .= '<div class = "eltd-dasboard-user-info-holder">';
		$html .= '<h5 class="eltd-dasboard-user-text">';
		$html .= esc_html__('Your Account','eltd_listing');
		$html .= '</h5>';
		$html .= '<div class="eltd-dasboard-user-info-holder-inner clearfix">';
		$html .= '<div class="eltd-dasboard-user-info-image-holder">';

		$profile_image = get_user_meta( $user_id, 'social_profile_image', true );
		if ( $profile_image == '' ) {
			$profile_image = get_avatar( $user_id, 96 );
		} else {
			$profile_image = '<img src="' . esc_url( $profile_image ) . '">';
		}

		if ( eltd_listing_theme_installed() ) {
			$html .= search_and_go_elated_kses_img( $profile_image );
		}
		$html .= '</div>'; //close 	eltd-dasboard-user-info-image-holder
		$html .= '<div class="eltd-dasboard-user-info-text-holder">';
		$html .= '<span>';
		$html .= esc_html__('You are currently signed in as ', 'eltd_listing');
		$html .= '<a href="'.esc_url($user_link).'">';
		$html .= esc_attr($user_nickname);
		$html .= '</a>';
		$html .= '</span>';
		$html .= '</div>'; //close eltd-dasboard-user-info-text-holder
		$html .= '<div class="eltd-dasboard-user-info-button-holder">';
		if ( eltd_listing_theme_installed() ) {
			$html .= search_and_go_elated_execute_shortcode('eltd_button', $sign_out_button_params);
		}
		$html .= '</div>';
		$html .= '</div>'; //close 	eltd-dasboard-user-info-holder-inner
		$html .= '</div>'; //close 	eltd-dasboard-user-info-holder
		
		return $html;
		
	}
	
}

if(!function_exists( 'eltd_listing_dashboard_page_top_area' )){
	
	function eltd_listing_dashboard_page_top_area($page_title, $subtitle_text){
		
		$separator_args = array(
			'icon_pack' => 'linear_icons',
			'linear_icons'	=> 'lnr-cog',
			'width'			=>	'85',
			'thickness'		=>	'1'
		);
		
		$html = '<div class="eltd-dashboard-title-wrapper">';
		$html .= '<div class="eltd-dashboard-title-holder">';
		$html .= '<h2 class="eltd-dashboard-title">';
		$html .= $page_title;
		$html .= '</h2>'; //close eltd-dashboard-title
		$html .= '</div>'; //eltd-dashboard-title-holder
		if ( eltd_listing_theme_installed() ) {
			$html .= search_and_go_elated_execute_shortcode('eltd_separator_with_icon', $separator_args);
		}
		$html .= '<p class="eltd-dashboard-title-text">';
		$html .= esc_html__($subtitle_text,'eltd_listing');
		$html .= '</p>';
		$html .= '</div>'; //close eltd-dashboard-title-wrapper
		
		return $html;
	}
	
}

if ( ! function_exists( 'eltd_listing_generate_dashboard_menu_items' ) ) {

	function eltd_listing_generate_dashboard_menu_items() {

		$dashboard_url = eltd_listing_get_dashboard_page_url();
		$action = '';
		$active_class = 'eltd-listing-active-item';

		if(isset($_GET[ "user-action" ])){
			$action = $_GET[ "user-action" ];
		}
		$html = '';

		if($action == 'profile' || $action == ''){
			$html .= '<li class="'.$active_class.'">';
		}else{
			$html .= '<li>';
		}
		$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-user"></span>';
		$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'profile'), $dashboard_url )) . '">' . esc_html__('My Profile', 'eltd_listing') . '</a>';
		$html .= '</li>';

		if($action == 'edit_profile'){
			$html .= '<li class="'.$active_class.'">';
		}else{
			$html .= '<li>';
		}
		$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-pencil"></span>';
		$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'edit_profile'), $dashboard_url )) . '">' . esc_html__('Edit Profile', 'eltd_listing') . '</a>';
		$html .= '</li>';

		if($action == 'add_new_listing'){
			$html .= '<li class="'.$active_class.'">';
		}else{
			$html .= '<li>';
		}
		$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-file-add"></span>';
		$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'add_new_listing'), $dashboard_url )) . '">' . esc_html__('Submit New Listing', 'eltd_listing') . '</a>';
		$html .= '</li>';

		if($action == 'listings'){
			$html .= '<li class="'.$active_class.'">';
		}else{
			$html .= '<li>';
		}
		$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-layers"></span>';
		$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'listings'), $dashboard_url )) . '">' . esc_html__('My Listings', 'eltd_listing') . '</a>';
		$html .= '</li>';
		if($action == 'wishlist'){
			$html .= '<li class="'.$active_class.'">';
		}else{
			$html .= '<li>';
		}
		$html .= '<span class="eltd-dashboard-menu-icon lnr lnr-star"></span>';
		$html .= '<a href="' . esc_url(add_query_arg( array('user-action' => 'wishlist'), $dashboard_url )) . '">' . esc_html__('My Wishlist', 'eltd_listing') . '</a>';

		echo $html;


	}

	add_action( 'search_and_go_elated_dashboard_menu_items', 'eltd_listing_generate_dashboard_menu_items' );
	add_action( 'search_and_go_elated_login_dropdown_menu_items', 'eltd_listing_generate_dashboard_menu_items' );

}

if ( ! function_exists( 'eltd_listing_restrict_media_library_access' ) ) {

	function eltd_listing_restrict_media_library_access( $wp_query ) {

		$user = wp_get_current_user();
		if ( isset( $wp_query->query['post_type'] ) && $wp_query->query['post_type'] === 'attachment' ) {
			if ( in_array( 'owner', (array) $user->roles ) ) {
				$wp_query->set('author', $user->ID);
			}
		}

	}

	add_action( 'pre_get_posts', 'eltd_listing_restrict_media_library_access' );

}

if ( ! function_exists( 'eltd_listing_remove_admin_toolbar' ) ) {

	/**
	 * Removes admin bar for all users except administrator
	 */
	function eltd_listing_remove_admin_toolbar() {

		if ( !current_user_can('administrator') && !is_admin() ) {
			show_admin_bar(false);
		}

	}

	add_action( 'after_setup_theme', 'eltd_listing_remove_admin_toolbar' );

}

if(!function_exists('search_and_go_elated_get_type_category_meta_params')){

	function search_and_go_elated_get_type_category_meta_params($id){

		$query_array = array(
			array(
				array(
					'key'   => 'listing_type',
					'value' =>  $id
				)
			)
		);

		return $query_array;

	}

}
if(!function_exists('search_and_go_elated_get_type_location_meta_params')){

	function search_and_go_elated_get_type_location_meta_params($id){

		$query_array = array(
			array(
				array(
					'key'   => 'listing_type',
					'value' =>  $id
				)
			)
		);

		return $query_array;

	}

}


if(!function_exists('search_and_go_elated_get_taxonomy_defaults')){

	function search_and_go_elated_get_taxonomy_defaults($id, $taxonomy){

		$post_taxs      = wp_get_post_terms( $id, $taxonomy );
		$post_tax_array = array();

		if ( is_array( $post_taxs ) && count( $post_taxs ) ) {
			foreach ( $post_taxs as $tax ) {
				$post_tax_array[] = $tax->term_id;
			}
		}
		return $post_tax_array;
	}

}

if(!function_exists('search_and_go_elated_get_admin_listings_outside_of_the_package')){

	function search_and_go_elated_get_admin_listings_outside_of_the_package($user_id){
		$html = '';
		$query_args = array(
			'post_type' => 'listing-item',
			'post_status' => array( 'pending', 'publish' ),
			'author' => $user_id,
			'posts_per_page'=> '-1'
		);

		$query = new \WP_Query($query_args);
		if($query->have_posts()){
			while($query->have_posts()){
				$query->the_post();

				$package = get_post_meta(get_the_ID(),'eltd_listing_package',true);
				if($package === ''){
					$status    = get_post_status();
					$view_text = 'view';
					if($status === 'pending') {
						$view_text = 'preview';
					};
					$admin_listings[] = array(
						'listing_id' => get_the_ID(),
						'title' => get_the_title(),
						'link'  => get_the_permalink(),
						'status' => $status,
						'view_text' => $view_text
					);
				}
			}
		}
		$html .= '<div class="eltd-user-package-info-section">';
		$html .= '<div class="eltd-user-package-top-section clearfix">';
		$html .= '<div class="eltd-user-package-top-section-part">';
		$html .= '<span>'.esc_html('Other Listings','eltd_listing').'</span>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<ul class="eltd-listing-package-list">';
		foreach($admin_listings as $admin_listing){
			$html .= eltd_listing_get_dashboard_module_template_part('templates','admin-listings', '',$admin_listing );
		}
		$html .= '</ul>';
		$html .= '</div>';

		return  $html;

	}

}