<div class="eltd-listing-package-holder">
	<div class="eltd-package-title">
		<h3><?php the_title(); ?></h3>
	</div>
	<?php if ( $params['package_discount_price'] ) { ?>
		<div class="eltd-package-discount-price">
			<span><?php echo esc_html( $params['package_discount_price'] ); ?></span>
			<span><?php echo esc_html( $params['package_currency_symbol'] ); ?></span>
		</div>
	<?php } ?>
	<?php if ( $params['package_price'] ) { ?>
		<div class="eltd-package-price">
			<span><?php echo esc_html( $params['package_price'] ); ?></span>
			<span><?php echo esc_html( $params['package_currency_symbol'] ); ?></span>
		</div>
	<?php } ?>
	<?php if ( $params['package_count'] ) { ?>
		<div class="eltd-package-count">
			<span><?php echo esc_html( $params['package_count'] ); ?></span>
			<span><?php echo esc_html( _n( 'Listing', 'Listings', $params['package_count'], 'eltd_listing' ) ); ?></span>
		</div>
	<?php } ?>
	<?php if ( $params['package_availability'] ) { ?>
		<div class="eltd-package-availability">
			<span><?php echo esc_html( $params['package_availability'] ); ?></span>
			<span><?php echo esc_html( _n( 'Day', 'Days', $params['package_availability'], 'eltd_listing' ) ); ?></span>
		</div>
	<?php } ?>
	<?php if ( $params['package_add_features'][0] ) { ?>
		<ul class="eltd-package-features">
			<?php
			foreach ( $params['package_add_features'] as $feature ) { ?>
				<li class="eltd-package-feature"><?php echo esc_html( $feature ); ?></li>
				<?php
			}
			?>
		</ul>
		<?php

	} ?>

	<?php if ( $params['package_availability'] ) { ?>
		<div class="eltd-package-availability">
			<span><?php echo esc_html( $params['package_availability'] ); ?></span>
			<span><?php echo esc_html( _n( 'Day', 'Days', $params['package_availability'], 'eltd_listing' ) ); ?></span>
		</div>
	<?php } ?>

	<?php if ( $params['package_status_message'] ) { ?>

		<p class="eltd-package-info-message">
			<?php echo esc_html( $params['package_status_message'], 'eltd_listing' ); ?>
		</p>

	<?php } ?>

	<?php

	if ( $params['package_type'] == 'paid' ) {

		if ( $send_to_paypal ) {

			$user_id = get_current_user_id();
			$price   = ( $params['package_discount_price'] != '' ) ? $params['package_discount_price'] : $params['package_price'];

			$custom_array = $params['custom_array']; ?>

			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="charset" value="utf-8">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business"
				       value="<?php
				       if ( eltd_listing_theme_installed() ) {
					       echo search_and_go_elated_options()->getOptionValue( 'paypal_receiver_id' );
		       }
				       ?>"/>
				<input type="hidden" name="currency_code" value="<?php
				if ( eltd_listing_theme_installed() ) {
					echo search_and_go_elated_options()->getOptionValue( 'paypal_currency' );
				}
				?>"/>
				<input type="hidden" name="custom"
				       value="<?php echo esc_attr( $custom_array['user_id'] ) . '-' . $custom_array['type'] ?>"/>
				<input type="hidden" name="amount" value="<?php echo esc_html( $price ); ?>"/>
				<input type="hidden" name="item_number" value="<?php the_ID(); ?>"/>
				<input type="hidden" name="item_name" value="<?php the_title(); ?>"/>
				<input type="hidden" name="notify_url"
				       value="<?php echo plugins_url() . '/eltd-listing/payments/paypal/ipn_listener.php'; ?>"/>
				<input type="submit" class="eltd-btn eltd-btn-solid eltd-btn-medium"
				       value="<?php esc_html_e( 'Purchase', 'eltd_listing' ); ?>">
			</form>

		<?php }
	} else {
		//check free package which user didn't take
		if ( $params['package_status_info'] == 'free_not_taken' ) {

			$data_params = '';
			$data_params .= 'data-package-id="' . $params['free_package_id'] . '" ';
			$data_params .= ' data-package-duration="' . $params['free_package_availability'] . '"';
			?>

			<div class="eltd-listing-take-package-holder" <?php print $data_params ?> >
				<?php
				$atts = array(
					'text'         => esc_html__( 'Take a Package', 'eltd_listing' ),
					'type'         => 'solid',
					'custom_class' => 'eltd-listing-take-free-package'
				);
				if ( eltd_listing_theme_installed() ) {
					echo search_and_go_elated_execute_shortcode( 'eltd_button', $atts );
				}
				?>
				<div class="eltd-listing-take-package-response"></div>
			</div>

		<?php }
		?>

	<?php }
	?>
</div>