<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top"
      class="eltd-package-paypal-payment-form" id="eltd-package-id-<?php echo esc_attr( $package_id ) ?>">

	<input type="hidden" name="charset" value="utf-8">

	<input type="hidden" name="cmd" value="_xclick">

	<input type="hidden" name="business"
	       value="<?php
	       if ( eltd_listing_theme_installed() ) {
		       echo search_and_go_elated_options()->getOptionValue( 'paypal_receiver_id' );
	       }
	       ?>"/>

	<input type="hidden" name="currency_code"
	       value="<?php
	       if ( eltd_listing_theme_installed() ) {
		       echo search_and_go_elated_options()->getOptionValue( 'paypal_currency' );
	       }
	       ?>"/>

	<input type="hidden" name="custom"
	       value="<?php echo esc_attr( $custom_array['user_id'] ) . '-' . $custom_array['type'] ?>"/>

	<input type="hidden" name="amount" value="<?php echo esc_html( $package_price ); ?>"/>

	<input type="hidden" name="item_number" value="<?php echo esc_attr( $package_id ) ?>"/>

	<input type="hidden" name="item_name" value="<?php echo esc_attr( $package_title ); ?>"/>

	<input type="hidden" name="return" value="<?php echo esc_url(add_query_arg( array('user-action' => 'listings'), eltd_listing_get_dashboard_page_url() )); ?>">

	<input type="hidden" name="notify_url"
	       value="<?php echo plugins_url() . '/eltd-listing/payments/paypal/ipn_listener.php'; ?>"/>

</form>