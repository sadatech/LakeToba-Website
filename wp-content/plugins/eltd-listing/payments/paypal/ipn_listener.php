<?php

if (file_exists('../../../../../wp-load.php')) {
    require_once('../../../../../wp-load.php');
}

$sandbox = false;

// Build the required acknowledgement message out of the notification just received
$validate_ipn = array('cmd' => '_notify-validate');

$post_unslash = wp_unslash($_POST);
$validate_ipn += $post_unslash;

// Send back post vars to paypal
$params = array(
    'body' => $validate_ipn,
    'timeout' => 60,
    'httpversion' => '1.1',
    'compress' => false,
    'decompress' => false,
    'user-agent' => 'ElatedListing/' . ELATED_LISTING_VERSION
);

// Post back to get a response.
$response = wp_safe_remote_post($sandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr', $params);

if (!is_wp_error($response) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 && strstr($response['body'], 'VERIFIED')) {
	
    $payment_status = strtolower($post_unslash['payment_status']);
	
    if ($sandbox && $post_unslash['test_ipn'] == 1) {
        $payment_status = 'completed';
    }
	
	//if($post_unslash['txn_id'])   check if the transaction has already been processed - get from database
	if ( eltd_listing_theme_installed() && $post_unslash['receiver_email'] == search_and_go_elated_options()->getOptionValue('paypal_receiver_id')) {
		// everything is ok - save to database

		$custom = $post_unslash['custom'];
		$custom = explode('-', $custom);
		$user_id = $custom[0];
		$transaction_type = $custom[1];
			
		global $wpdb;
		$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';

		$package_id = $post_unslash['item_number'];
		$txn_id = $post_unslash['txn_id'];
		$date = $post_unslash['payment_date'];
		$status = $payment_status;
		$description = '';
		$package_interval = get_post_meta( $package_id, 'eltd_listing_package_availability', true );
		
		//convert date format
		$formated_date = new DateTime($date);
		$formated_date->setTimezone(new DateTimezone( 'UTC' ));
		$payment_date = $formated_date->format('Y-m-d\TH:i:s\Z');

		if ( $status == 'completed' ) {
			$formated_date->add(new DateInterval('P' . $package_interval . 'D'));
			$expiry_date = $formated_date->format('Y-m-d\TH:i:s\Z');
			
			if($transaction_type == 'update_expired_package'){
				
				// update all user package listings statuses and set them to be pending
				$package_listings_ids = eltd_listing_get_listings_in_user_package($package_id, $user_id);

				if(is_array($package_listings_ids) && count($package_listings_ids)){

					foreach($package_listings_ids as $listing_id){

						eltd_listing_change_listing_status($listing_id, 'publish');

					}

				}
			}
			
		} else {
			
			$expiry_date = $payment_date;
			$status = 'not_paid'; //Set status to not paid
			
		}

		$table_params = array(
			'user_id' => $user_id,
			'package_id' => $package_id,
			'payment_date'	=> $payment_date,
			'status' => $status,
			'txn_id' => $txn_id,
			'expire_date' => $expiry_date
		);

		$exist = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id=%d AND package_id=%d", $user_id, $package_id));

		if ( $exist ) {
			eltd_listing_update_table_row( $table_name, $table_params );
		} else {
			eltd_listing_insert_table_row( $table_name, $table_params );
		}

	}
	
}