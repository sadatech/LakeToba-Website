<?php

if(!function_exists('eltd_listing_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function eltd_listing_version_class($classes) {
        $classes[] = 'eltd-core-'.ELATED_LISTING_VERSION;

        return $classes;
    }

    add_filter('body_class', 'eltd_listing_version_class');
}

if(!function_exists('eltd_listing_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function eltd_listing_theme_installed() {
        return defined('ELATED_ROOT');
    }
}

if(!function_exists('eltd_listing_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param $shortcode
	 * @param $template
	 * @param string $slug
	 * @param array $params
	 *
	 * @return string
	 */
	function eltd_listing_get_shortcode_module_template_part($shortcode,$template, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = ELATED_LISTING_CPT_PATH .'/'.$shortcode.'/shortcodes/templates';
		
		$temp = $template_path.'/'.$template;
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$template = '';

		if($temp !== '') {
			if($slug !== '') {
				$template = "{$temp}-{$slug}.php";
			}
			$template = $temp.'.php';
		}
		if($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}

if(!function_exists('eltd_listing_get_dashboard_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param $dashboard
	 * @param $template
	 * @param string $slug
	 * @param array $params
	 *
	 * @return string
	 */
	function eltd_listing_get_dashboard_module_template_part($dashboard,$template, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = ELATED_LISTING_MEMBERSHIP_PATH .'/'.$dashboard;

		$temp = $template_path.'/'.$template;
		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if($temp !== '') {
			if($slug !== '') {
				$template = "{$temp}-{$slug}.php";
			}
			$template = $temp.'.php';
		}

		if($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}

if(!function_exists('eltd_listing_advanced_search')){
	
	function eltd_listing_advanced_search(){
		
		$html = $type_id = '';
		
		if(isset($_POST['typeID'])){
			$type_id = $_POST['typeID'];
		}
		if($type_id != ''){
			$html = eltd_listing_get_advanced_search_fields($type_id);
		}
		
		$return_obj = array(
			'html' => $html,
		);

		echo json_encode($return_obj); exit;
	}
	add_action('wp_ajax_eltd_listing_advanced_search', 'eltd_listing_advanced_search');
	add_action('wp_ajax_nopriv_eltd_listing_advanced_search', 'eltd_listing_advanced_search');
}

if(!function_exists('eltd_listing_get_advanced_search_fields')){
	
	function eltd_listing_get_advanced_search_fields($type_id){
		
		$listing_type_custom_fields = get_post_meta($type_id, 'eltd_listing_type_custom_fields', true);
		$show_price = get_post_meta($type_id , 'eltd_listing_type_show_price', true);
		$html = '';
		
		if($show_price === 'yes'){
			$html .='<div class="eltd-advanced-search-item">';
			$html .= '<label for="min_price">Min Price</label>';	
			$html .= '<div class="eltd-advanced-search-input">';
			$html .= '<input name="min_price" type="text" id="min_price" class="eltd-input-field eltd-advanced-input-field" value="" />';
			$html .= '</div>';
			$html .= '</div>';
			
			$html .='<div class="eltd-advanced-search-item">';
			$html .= '<label for="max_price">Max Price</label>';	
			$html .= '<div class="eltd-advanced-search-input">';
			$html .= '<input name="max_price" type="text" id="max_price" class="eltd-input-field eltd-advanced-input-field" value="" />';
			$html .= '</div>';
			$html .= '</div>';
		}		

		if(is_array($listing_type_custom_fields) && count($listing_type_custom_fields)){
		foreach ($listing_type_custom_fields as $custom_field){
			
			switch ($custom_field['type']) {
				case 'text':

					$html .='<div class="eltd-advanced-search-item">';
					$html .= '<label for="'.$custom_field['meta_key'].'">'.$custom_field['title'].'</label>';	
					$html .= '<div class="eltd-advanced-search-input">';
					$html .= '<input name="'.$custom_field['title'].'" type="text" id="'.$custom_field['meta_key'].'" class="eltd-input-field eltd-advanced-input-field" value="" />';
					$html .= '</div>';
					$html .= '</div>';

					break;
				case 'textarea':

					$html .='<div class="eltd-advanced-search-item">';
					$html .= '<label for="'.$custom_field['meta_key'].'">'.$custom_field['title'].'</label>';	
					$html .= '<div class="eltd-advanced-search-input">';
					$html .= '<input name="'.$custom_field['title'].'" type="textarea" id="'.$custom_field['meta_key'].'" class="eltd-input-field eltd-advanced-input-field" value="" />';
					$html .= '</div>';
					$html .= '</div>';

					break;

				case 'select':
					$html .='<div class="eltd-advanced-search-item">';
					$html .= '<p>'.$custom_field['title'].'</p>';
					$html .= '<div class="eltd-advanced-search-input">';
					$html .= '<select class="listing-type-advanced-search eltd-advanced-input-field" multiple="multiple"  name="listingTypeAdvancedSearch" id="'.$custom_field['meta_key'].'">';
					$html .= '<option value=""></option>';

					foreach ( $custom_field['options'] as $option_key => $option_value ) {
						
						$html .= '<option value="'.$option_key.'">';
						$html .=  esc_attr($option_value);
						$html .= '</option>';
					}
					$html .= '</select>';
					$html .= '</div>';
					$html .= '</div>';
					break;

				case 'checkbox':
					$checked = '';
					$value = $custom_field['default_value'];
					if($value == 1){
						$checked = 'checked';
					}
					
					$html .='<div class="eltd-advanced-search-item">';
					$html .= '<label for="'.$custom_field['meta_key'].'">'.$custom_field['title'].'</label>';	
					$html .= '<div class="eltd-advanced-search-input ">';
					$html .= '<input name="'.$custom_field['title'].'" type="checkbox" id="'.$custom_field['meta_key'].'" class="eltd-input-field eltd-advanced-input-field" value="'.$value.'"  "'.$checked.'"/>';
					$html .= '</div>';
					$html .= '</div>';

					break;

				default:
					break;
			}

		}
		}	
	
		return $html;
	}
	
}
if(!function_exists('eltd_listing_advanced_search_query')){
	
	function eltd_listing_advanced_search_query(){
		
		$html = $type_id = '';
		$min_price = $max_price = '';
		$search_params = array();
		
		if(isset($_POST['searchParams'])){
			$search_params = $_POST['searchParams'];
		}
		extract($search_params);
		
		$query_array = array(
			'post_type' => 'listing-item'
		);
		$meta_query = array(
			'relation' => 'AND'
		);
		
		
		//check price range if is set for current type
		if(isset($min_price) && isset($max_price)){
			
			//filter between max and min price 
			if($min_price !== '' && $max_price !== ''){
				
				$meta_query[] = array(

					'key' => 'eltd_listing_price',
					'value' => array($min_price, $max_price),
					'type'    => 'numeric',
					'compare' => 'BETWEEN'

				);
			}
			//filter higher prices of min_price 
			if($min_price !== '' && $max_price == ''){
				
				$meta_query[] = array(
				
					'key' => 'eltd_listing_price',
					'value' => $min_price,
					'type'    => 'numeric',
					'compare' => '>'

				);
			}
			//filter lower prices of max_price
			if($min_price == '' && $max_price !== ''){
			
				$meta_query[] = array(

					'key' => 'eltd_listing_price',
					'value' => $max_price,
					'type'    => 'numeric',
					'compare' => '<'

				);

			}
			
		}				
		
		//check all other cusom fields for selected type
		if(is_array($search_params) && count($search_params)){
		
			foreach ($search_params as $param_key => $param_value){
				
				if($param_value != '' && $param_key != 'min_price' && $param_key != 'max_price'){
					
					$meta_query[] = array(

						'key' => $param_key,
						'value' => $param_value

					);
						
				}
				
			}
			
		}
		
		$query_array['meta_query'] = $meta_query;
		$query_results = new WP_Query($query_array);
		
		if($query_results->have_posts()):			
			while ( $query_results->have_posts() ) : $query_results->the_post();
				
				$html .= eltd_listing_get_shortcode_module_template_part('listing', 'listing-standard', '', array());
				
			endwhile;
			wp_reset_postdata();
		else: 
			
			$html .= '<p>'. esc_html__( 'Sorry, no posts matched your criteria.', 'eltd_listing' ) .'</p>';
		
		endif;
		
		$return_obj = array(
			'html' => $html,
		);

		echo json_encode($return_obj); exit;
	}
	add_action('wp_ajax_eltd_listing_advanced_search_query', 'eltd_listing_advanced_search_query');
	add_action('wp_ajax_nopriv_eltd_listing_advanced_search_query', 'eltd_listing_advanced_search_query');
	
}

if(!function_exists('eltd_listing_check_package_status')){
	
	function eltd_listing_check_package_status(){
		
		$html = $user_id = $package_id = '';
		
		if(isset($_POST['packageID'])){
			$package_id	= $_POST['packageID'];
		}
		if(isset($_POST['userID'])){
			$user_id = $_POST['userID'];
		}

		$paid_package = '';
		$add_new_listing_flag = false;
		$add_new_listing_message = '';
		$package_params = array();
		//return package html 
		
		if($package_id !== ''){

			$currently_items = eltd_listing_get_number_of_items_in_user_package( $user_id, $package_id );
			$remaining_days = eltd_listing_get_remaining_days_in_user_package( $user_id, $package_id );
			
			$package_params['basic_params'] = eltd_listing_get_package_params($package_id);

			$max_items_in_package = (int)$package_params['basic_params']['eltd_listing_package_count']['value'];
			$add_new_listing_flag = $max_items_in_package > $currently_items ? true : false;
			$add_new_listing_message = '';
			
			if( !$add_new_listing_flag ){
				$add_new_listing_message = esc_html__( 'You cannot add more listing in this package ', 'eltd_listing' );
			}

			if($package_params['basic_params']['eltd_listing_package_type']['value'] == 'paid'){
				
				//check if package is paid
				if($user_id !== '' ){

					// check all rows for current user and choosen package. Need to check array because there can be multi rows in database(completed, pending...)
					$package_array = eltd_listing_get_package_status($package_id, $user_id);

					if(is_array($package_array) && count($package_array)){

						foreach ($package_array as $package){

							if ($package->status == 'completed') {

								$paid_package = true;
								
								if($currently_items !== ''){
									$package_params['currently_items'] = $currently_items;
								}
								if($remaining_days !== NUll && $remaining_days !=='' ){									
									$package_params['remaining_days'] = $remaining_days;
								}
								$package_params['info_message'] = 'Thank You. You have paid this package';
							}					
						}
					}else{
						
						$paid_package = false;
						$package_params['info_message'] = 'You need to buy this package';						
						
					}
				}
				
			}else{

				if($currently_items !== ''){					
					$package_params['currently_items'] = $currently_items;					
				}
				if($remaining_days !== NUll && $remaining_days !=='' ){
					$package_params['remaining_days'] = $remaining_days;					
				}
				$package_params['info_message'] = 'This Package is free';				
			}
			
		}
		//generate package html
		$html .= eltd_listing_get_shortcode_module_template_part('listing-package', 'listing-package-template', '', $package_params);
		
		$return_obj = array(
			'html' => $html,
			'packageFlag' => $paid_package,
			'enabled_adding_new_item' => $add_new_listing_flag,
			'enabled_adding_item_messsage' => $add_new_listing_message
		);

		echo json_encode($return_obj); exit;
	}
	add_action('wp_ajax_eltd_listing_check_package_status', 'eltd_listing_check_package_status');
	add_action('wp_ajax_nopriv_eltd_listing_check_package_status', 'eltd_listing_check_package_status');
}

if(!function_exists('eltd_listing_get_package_status')){
	
	function eltd_listing_get_package_status($package_id, $user_id){
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';
		$packages = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id=%s AND package_id=%s", $user_id, $package_id));
		return $packages;
	}
	
}


if(!function_exists('eltd_listing_get_package_params')){
	
	function eltd_listing_get_package_params($package_id){
		
		
		//return only this defined package post meta 
		$package_meta_fields = array(
			'eltd_listing_package_type' => 'Type',
			'eltd_listing_package_price' => 'Price',
			'eltd_listing_package_discount_price' => 'Discount',
			'eltd_listing_package_count' => 'Count',
			'eltd_listing_package_availability' => 'Availability'
		);
		
		$fields_return_array = array();
		
		foreach ($package_meta_fields as $meta_field_key => $meta_field_value){
			
			$meta_value = get_post_meta($package_id, $meta_field_key, true );
			
			$fields_return_array[$meta_field_key]['value'] = $meta_value;
			$fields_return_array[$meta_field_key]['text'] = $meta_field_value;
			$fields_return_array[$meta_field_key]['key'] = $meta_field_key;
			
		}
		$fields_return_array['eltd_listing_package_title']['value'] = get_the_title($package_id);
		$fields_return_array['eltd_listing_package_title']['text'] = 'Title';
		$fields_return_array['eltd_listing_package_title']['key'] = 'eltd_listing_package_title';

		//generate listing package icon
		$icon_pack = get_post_meta( $package_id, 'listing_package_icon_pack', true );
		$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
		$icon = get_post_meta( $package_id, 'listing_package_icon_'.$param, true );


		$fields_return_array['eltd_listing_package_icon']['value'] = '';
		$fields_return_array['eltd_listing_package_icon']['text'] = 'Icon';
		$fields_return_array['eltd_listing_package_icon']['key'] = 'package_icon';
		if ( $icon !== '') {
			$fields_return_array['eltd_listing_package_icon']['value'] = search_and_go_elated_icon_collections()->renderIcon( $icon, $icon_pack );
		}
		
		return $fields_return_array;
				
	}
	
}

if ( ! function_exists( 'eltd_listing_get_number_of_items_in_user_package' ) ) {

	function eltd_listing_get_number_of_items_in_user_package( $user_id, $package_id ) {

		$args = array(
		    'post_type' => 'listing-item',
		    'author' => $user_id,
		    'meta_key'   => 'eltd_listing_package',
		    'meta_value' => $package_id
		);
		$query = new WP_Query($args);
		$number = $query->post_count;
		wp_reset_postdata();
		return $number;

	}

}


if ( ! function_exists( 'eltd_listing_get_listings_in_user_package' ) ) {

	function eltd_listing_get_listings_in_user_package( $package_id , $user_id) {
		
		$listings_id_array = array();
		$args = array(
			'post_type' => 'listing-item',
			'author' => $user_id,
			'meta_key'   => 'eltd_listing_package',
			'meta_value' => $package_id
		);
		$query_results = new WP_Query($args);
		
		if($query_results->have_posts()){
			
			while ( $query_results->have_posts() ) : $query_results->the_post();
			
				$listings_id_array[] = get_the_ID();
			
			endwhile;			
		}
		
		wp_reset_postdata();
		
		return $listings_id_array;

	}

}


if ( ! function_exists( 'eltd_listing_get_remaining_days_in_user_package' ) ) {
	/**
	 * Function that returns difference between currnent datetime and expiry datetime of package
	 *
	 * @param $user_id
	 * @param $package_id
	 *
	 * @return bool|DateInterval|string
	 */
	function eltd_listing_get_remaining_days_in_user_package( $user_id, $package_id ) {
		global $wpdb;

		$table_name = $wpdb->base_prefix . 'eltd_listing_package_transactions';

		$exist = $wpdb->get_results($wpdb->prepare("SELECT expire_date FROM $table_name WHERE user_id=%d AND package_id=%d AND status=%s", $user_id, $package_id, 'completed'));
		if ( $exist ) {
			$expiry_date = $exist[0]->expire_date;
			$expiry_date = new DateTime($expiry_date);
			$current_date = new DateTime('now');
			if ( $current_date < $expiry_date ) {
				$remaining = $expiry_date->diff($current_date);
				$remaining = $remaining->format('%a');
			} else {
				$remaining = false;
			}
			return $remaining;
		}

	}

}

if( !function_exists('eltd_listing_ajax_response_message_holder_html')){
	
	
	function eltd_listing_ajax_response_message_holder_html(){
		
		echo '<div class="eltd-listing-ajax-response-holder"></div>';
		
	}
	add_action('eltd_listing_action_listing_ajax_response', 'eltd_listing_ajax_response_message_holder_html');
	add_action( 'search_and_go_elated_after_listing_item_enquiry_form', 'eltd_listing_ajax_response_message_holder_html' );
}

if ( ! function_exists( 'eltd_listing_ajax_response_message_template' ) ) {
	/**
	 * Template with placeholders for ajax response message
	 *
	 * uses underscore templates
	 *
	 */
	function eltd_listing_ajax_response_message_template() {

		$html = '<script type="text/template" class="eltd-listing-ajax-response">
					<div class="eltd-ajax-response <%= messageTypeClass %> ">
						<div class="eltd-ajax-response-inner">
							<span>
								<%= message %>
							</span>
						</div>
					</div>
				</script>';

		echo $html;

	}

	add_action('eltd_listing_action_listing_ajax_response', 'eltd_listing_ajax_response_message_template');
	add_action( 'search_and_go_elated_after_listing_item_enquiry_form', 'eltd_listing_ajax_response_message_template' );

}


if(!function_exists('eltd_listing_check_all_packages_statuses')){
	
	function eltd_listing_check_all_packages_statuses(){

		$args = array(
			'post_type' => 'listing-package',
			'post_status' => 'publish'
		);			

		$packages = new WP_Query($args);	
		
		// current date
		$users = get_users();
		
		if($packages->have_posts()){
			
			while ( $packages->have_posts() ) : $packages->the_post();
						
				if(is_array($users) && count($users)){
					
					foreach($users as $user){

						$package_object = eltd_listing_get_package_status(get_the_ID(), $user->ID);
						if(!empty($package_object)){

							if ( eltd_listing_get_package_payment_status($user->ID, get_the_ID()) && !eltd_listing_get_package_expiry_status($user->ID, get_the_ID()) ) {
								
								// update all user package listings statuses and set them to be pending
								$package_listings_ids = eltd_listing_get_listings_in_user_package(get_the_ID(), $user->ID);
								
								if(is_array($package_listings_ids) && count($package_listings_ids)){

									foreach($package_listings_ids as $listing_id){

										eltd_listing_change_listing_status($listing_id, 'pending');

									}

								}

							}
							
						}
						
					}

				}	
			
			endwhile;
			
		}	
			
		wp_reset_postdata();
		
	}
	add_action('init', 'eltd_listing_check_all_packages_statuses');
	
}

if(!function_exists('eltd_listing_change_listing_status')){
	
	/**
	 * Change listing item status when package is expired or buy again
	 *
	 */
	
	function eltd_listing_change_listing_status($post_id, $status){
		
		$current_post = get_post( $post_id, 'ARRAY_A' );
		$current_post['post_status'] = $status;
		wp_update_post($current_post);
		
	}
	
}

if(!function_exists( 'eltd_listing_update_table_row' )){
	/**
	 * Function update database table with defined params
	 *
	 * @param $table
	 * @param $params
	 */
	function eltd_listing_update_table_row( $table, $params ) {
		global $wpdb;

		$wpdb->query(
			$wpdb->prepare(
				"UPDATE $table
					SET date = %s, status = %s, transaction_id = %s, expire_date = %s
					WHERE user_id = %d AND package_id = %d;",
				$params['payment_date'], $params['status'], $params['txn_id'], $params['expire_date'], $params['user_id'], $params['package_id']
			)
		);

	}
}

if(!function_exists( 'eltd_listing_insert_table_row' )){
	/**
	 * Function insert new row in database table with defined params
	 *
	 * @param $table
	 * @param $params
	 */
	function eltd_listing_insert_table_row( $table, $params ) {
		global $wpdb;

		$wpdb->query( $wpdb->prepare(
		"
			INSERT INTO $table
			( user_id, package_id, date, status, transaction_id, expire_date )
			VALUES ( %d, %d, %s , %s , %s, %s )
		",
			array(
				$params['user_id'],
				$params['package_id'],
				$params['payment_date'],
				$params['status'],
				$params['txn_id'],
				$params['expire_date']
			)
		) );

	}
	
}

if ( ! function_exists( 'eltd_listing_get_package_payment_status' ) ) {
	/**
	 * Checks if payment status is completed or not paid
	 *
	 * @param $user - user ID
	 * @param $package - package ID
	 */
	function eltd_listing_get_package_payment_status( $user, $package ) {
		global $wpdb;
		$table_name = $wpdb->base_prefix . 'eltd_listing_package_transactions';

		$query = $wpdb->get_results($wpdb->prepare("SELECT 'status' FROM $table_name WHERE user_id=%d AND package_id=%d", $user, $package));

		if ( $query ) {
			return $query[0]->status == 'completed' ? true : false;
		}

	}

}

if ( ! function_exists( 'eltd_listing_get_package_expiry_status' ) ) {
	/**
	 * Checks if package expired
	 *
	 * @param $user
	 * @param $package
	 *
	 * @return bool
	 */
	function eltd_listing_get_package_expiry_status( $user, $package ) {
		global $wpdb;
		$table_name = $wpdb->base_prefix . 'eltd_listing_package_transactions';

		$query = $wpdb->get_results($wpdb->prepare("SELECT expire_date FROM $table_name WHERE user_id=%d AND package_id=%d", $user, $package));

		if ( $query ) {
			$expiry_date = $query[0]->expire_date;
			$expiry_date = new DateTime($expiry_date);
			$current_date = new DateTime('now');
			if ( $current_date < $expiry_date ) {
				return true;
			} else {
				return false;
			}
		}

	}

}

if ( ! function_exists( 'eltd_listing_get_listing_item_rating' ) ) {
	/**
	 * Calculate average rating for listing item
	 *
	 * @return float
	 */
	function eltd_listing_get_listing_item_rating() {

		$args = array(
			'post_id' => get_the_ID()
		);
		$comments = get_comments($args);

		$rating = array();

		foreach ( $comments as $comment ) {
			$rating[] = (int) get_comment_meta( $comment->comment_ID, 'eltd_rating', true );
		}

		if ( $rating ) {
			$average_rating = array_sum($rating)/count($rating);
			return array(
				'average_rating' => $average_rating,
				'ratings_count' => count($rating)
			);
		}


	}

}

if ( ! function_exists( 'eltd_listing_override_listing_type_link' ) ) {
	/**
	 * Override listing type item link to use it with archive listing item template
	 *
	 * @param $permalink
	 * @param $post
	 *
	 * @return string
	 */
	function eltd_listing_override_listing_type_link( $permalink, $post ) {

		if(get_post_type($post) === 'listing-type-item') {
			return get_post_type_archive_link('listing-item').'?type='.get_the_title($post->ID);
		}

		return $permalink;
	}

	add_filter('post_type_link', 'eltd_listing_override_listing_type_link', 10, 2);
}

if ( ! function_exists( 'eltd_listing_override_listing_tax_links' ) ) {
	/**
	 * Override listing taxonomy link to use it with archive listing item template
	 *
	 * @param $termlink
	 * @param $term
	 *
	 * @return string
	 */
	function eltd_listing_override_listing_tax_links( $termlink, $term ) {
		if($term->taxonomy === 'listing-item-category') {
			return get_post_type_archive_link('listing-item').'?category='. urlencode($term->name);
		} elseif ( $term->taxonomy === 'listing-item-tag' ) {
			return get_post_type_archive_link('listing-item').'?item-tag='. urlencode($term->name);
		} elseif ( $term->taxonomy === 'listing-item-location' ) {
			return get_post_type_archive_link('listing-item').'?location='. urlencode($term->name);
		}
		return $termlink;

	}

	add_filter( 'term_link', 'eltd_listing_override_listing_tax_links', 10, 2 );
}

if(!function_exists('eltd_listing_take_free_package')){
    
    function eltd_listing_take_free_package(){
	global $wpdb;
	$html = $package_id = $package_duration = '';
		
	if(isset($_POST['packageID'])){
	    $package_id	= $_POST['packageID'];
	}
	if(isset($_POST['packageDuration'])){
	    $package_duration = $_POST['packageDuration'];
	}

	$current_user_id = get_current_user_id();
	$package_interval = $package_duration;
	
	$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';

	$current_time = current_time( 'mysql' );

	//convert current time format
	$formated_date = new DateTime('now');
	$formated_date->setTimezone(new DateTimezone( 'UTC' ));

	$formated_date->add(new DateInterval('P' . $package_interval . 'D'));
	$expiry_date = $formated_date->format('Y-m-d\TH:i:s\Z');

	$free_package_params = array(

	    'user_id' => $current_user_id,
	    'package_id' => $package_id,
	    'payment_date'	=> $current_time,
	    'status' => 'completed',
	    'txn_id' => 'free',
	    'expire_date' => $expiry_date

	);

	eltd_listing_insert_table_row($table_name, $free_package_params);
	
	$html .= '<p>'. esc_html__( 'You have succesfully taken this package.', 'eltd_listing' ) .'</p>';
	    
	$return_obj = array(
	    'html' => $html
	);

	echo json_encode($return_obj); exit;	
	
    }
    add_action('wp_ajax_eltd_listing_take_free_package', 'eltd_listing_take_free_package');
    add_action('wp_ajax_nopriv_eltd_listing_take_free_package', 'eltd_listing_take_free_package');
}