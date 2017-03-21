<?php
namespace ElatedListing\ListingPackages\Shortcodes;

use ElatedListing\Lib;

/**
 * Class ListingPackages
 * @package ElatedListing\ListingPackages\Shortcodes
 */
class ListingPackages implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_listing_packages';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map
	 */
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'                      => 'Listing Packages',
					'base'                      => $this->getBase(),
					'category'                  => 'by ELATED',
					'icon'                      => 'icon-wpb-listing-package extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'admin-label' => true,
							'heading'     => 'Number of Columns',
							'param_name'  => 'column_count',
							'value'       => array(
								'Default' => '',
								'Two'     => '2',
								'Three'   => '3',
								'Four'    => '4'
							),
							'description' => 'Default value is 3.'
						),
						array(
							'type'        => 'dropdown',
							'heading'     => 'Order By',
							'param_name'  => 'packages_orderby',
							'value'       => array(
								'Name'       => 'name',
								'Menu Order' => 'menu_order',
							),
							'save_always' => true,
							'description' => ''
						),
						array(
							'type'        => 'dropdown',
							'heading'     => 'Sort',
							'param_name'  => 'packages_sort',
							'value'       => array(
								'Ascending'  => 'asc',
								'Descending' => 'desc',
							),
							'save_always' => true,
							'description' => ''
						)
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {

		$args = array(
			'packages_orderby' => '',
			'packages_sort'    => '',
			'column_count'     => '3'
		);

		$params = shortcode_atts( $args, $atts );
		extract( $params );
		$html       = '';
		$form_html  = '';
		$query_args = $this->eltd_get_query_args( $params );

		$packages = new \WP_Query( $query_args );

		if ( $packages->have_posts() ) {

			$currency_symbols = array(
				'AUD' => '&#36;',
				'BRL' => '&#82;&#36;',
				'CAD' => '&#36;',
				'CHF' => '&#67;&#72;&#70;',
				'CZK' => '&#75;&#269;',
				'DKK' => '&#107;&#114;',
				'EUR' => '&#8364;',
				'GBP' => '&#163;',
				'HKD' => '&#36;',
				'HUF' => '&#70;&#116;',
				'ILS' => '&#8362;',
				'JPY' => '&#165;',
				'MXN' => '&#36;',
				'MYR' => '&#82;&#77;',
				'NOK' => '&#107;&#114;',
				'NZD' => '&#36;',
				'PHP' => '&#8369;',
				'PLN' => '&#122;&#322;',
				'SEK' => '&#107;&#114;',
				'SGD' => '&#36;',
				'THB' => '&#3647;',
				'TRY' => '&#8356;',
				'TWD' => '&#78;&#84;&#36;',
				'USD' => '&#36;'
			);

			if ( eltd_listing_theme_installed() ) {
				$params['package_currency_symbol'] = $currency_symbols[ search_and_go_elated_options()->getOptionValue( 'paypal_currency' ) ];
			} else {
				$params['package_currency_symbol'] = '';
			}
			$html .= '<div class="eltd-listing-packages-wrapper eltd-columns-' . $column_count . '">';
			$html .= '<div class="eltd-pricing-tables clearfix eltd-three-columns">'; //generate pricing table wrapper for packages

			while ( $packages->have_posts() ) {
				$packages->the_post();

				$id = get_the_ID();

				// get all post meta for a package
				// reduce db calls
				$package_metas = get_post_meta( $id );

				//reset values each time

				$params['package_type']           = $package_metas['eltd_listing_package_type'][0];
				$params['package_price']          = '';
				$params['package_discount_price'] = '';
				$params['package_availability']   = '';
				$params['package_count']          = '';
				$params['package_add_features']   = array();

				if ( isset( $package_metas['eltd_listing_package_count'] ) ) {
					$params['package_count'] = $package_metas['eltd_listing_package_count'][0];
				}
				if ( isset( $package_metas['eltd_listing_package_availability'] ) ) {
					$params['package_availability'] = $package_metas['eltd_listing_package_availability'][0];
				}
				if ( isset( $package_metas['listing_package_additional_features'] ) ) {
					$params['package_add_features'] = unserialize( $package_metas['listing_package_additional_features'][0] );
				}
				if ( isset( $package_metas['eltd_listing_package_price'] ) ) {
					$params['package_price'] = $package_metas['eltd_listing_package_price'][0];
				}
				if ( isset( $package_metas['eltd_listing_package_discount_price'] ) ) {
					$params['package_discount_price'] = $package_metas['eltd_listing_package_discount_price'][0];
				}

				$price = '';
				if ( $params['package_discount_price'] !== '' ) {
					$price = $params['package_discount_price'];
				} elseif ( $params['package_price'] !== '' ) {
					$price = $params['package_price'];
				}
				//check package status for current user
				$current_user_id = get_current_user_id();
				$package_status  = eltd_listing_get_package_status( $id, $current_user_id );

				$send_to_paypal         = false;
				$package_status_info    = '';
				$package_status_message = '';
				$free_package_duration  = '';
				$button_text            = '';

				if ( $params['package_type'] == 'paid' ) {

					$custom_array = array();
					if ( empty( $package_status ) ) { //user don't have this package

						$send_to_paypal         = true;
						$package_status_info    = 'buy';
						$package_status_message = 'You need to buy this package';

						$custom_array = array(
							'user_id' => get_current_user_id(),
							'type'    => 'common'
						);

					} else { //user allready have this package

						//1. package is not paid
						if ( ! eltd_listing_get_package_payment_status( $current_user_id, $id ) ) {

							$send_to_paypal         = true;
							$package_status_info    = 'not_paid';
							$package_status_message = 'Package is not paid.You need to buy this package';

							$custom_array = array(
								'user_id' => get_current_user_id(),
								'type'    => 'common'
							);

						} //2. package expired
						elseif ( ! eltd_listing_get_package_expiry_status( $current_user_id, $id ) ) {

							$send_to_paypal         = true;
							$package_status_info    = 'expired';
							$package_status_message = 'Package expired.You need to buy this package';
							$custom_array           = array(
								'user_id' => get_current_user_id(),
								'type'    => 'update_expired_package'
							);

						} else {

							//3. package is valid
							$package_status_info    = 'valid_package';
							$package_status_message = 'You allready buy this package';
							$send_to_paypal         = false;

						}

					}
					if ( $send_to_paypal ) {

						$payment_params = array(
							'custom_array'  => $custom_array,
							'package_price' => $price,
							'package_id'    => $id,
							'package_title' => get_the_title()
						);
						$button_text    = 'Buy Package';
						$form_html .= eltd_listing_get_shortcode_module_template_part( 'listing-package', 'paypal-form', '', $payment_params );
					}


				} elseif ( $params['package_type'] == 'free' ) {

					if ( isset( $params['package_availability'] ) ) {

						if ( empty( $package_status ) ) { //user don't have this package

							$package_status_info    = 'free_not_taken';
							$package_status_message = 'Package is free.You can take this package';

							$params['free_package_id']           = $id;
							$params['free_package_availability'] = $params['package_availability'];
							$button_text                         = 'Take a Package';
							$free_package_duration               = $params['package_availability'];

						} else { //user allready have this package
							$package_status_info    = 'free_taken';
							$package_status_message = 'Package is free.You allready have this package.';
							if ( ! eltd_listing_get_package_expiry_status( $current_user_id, $id ) ) {
								$package_status_message = 'Package is free, but expired.';
							}
						}

					}
				}

				$params['package_status_info']    = $package_status_info;
				$params['package_status_message'] = $package_status_message;

				//get package info
				$content = $this->eltd_get_package_info_content( $params );

				//set values for pricing table shortcode
				$pricing_table_array = array(
					'title'            => get_the_title(),
					'price'            => $price,
					'price_period'     => '',
					'button_text'      => $button_text,
					'button_id'        => 'eltd-package-id-' . $id,
					'package_duration' => $free_package_duration
				);

				if ( eltd_listing_theme_installed() ) {
					$html .= search_and_go_elated_execute_shortcode( 'eltd_pricing_table', $pricing_table_array, $content );
				}

			}
			$packages->reset_postdata();
			$html .= '</div>';
			$html .= '<div class="eltd-listing-package-payment-form">';
			$html .= $form_html;
			$html .= '</div>';
			$html .= '</div>';
		} else {

			$html .= '<p>' . _e( 'Sorry, no posts matched your criteria.', 'eltd_listing' ) . '</p>';

		}

		return $html;
	}

	private function eltd_get_query_args( $params ) {
		$args = array();

		$args['orderby']   = $params['packages_orderby'];
		$args['order']     = $params['packages_sort'];
		$args['post_type'] = 'listing-package';

		return $args;
	}

	private function eltd_get_package_info_content( $params ) {
		$content = '<ul>';

		if ( $params['package_type'] !== '' ) {
			$content .= '<li>';
			$content .= '<span>' . esc_html( 'Type: ', 'eltd_listing' ) . '</span>';
			$content .= $params['package_type'];
			$content .= '</li>';
		}
		if ( $params['package_availability'] !== '' ) {
			$content .= '<li>';
			$content .= '<span>' . esc_html( 'Availability: ', 'eltd_listing' ) . '</span>';
			$content .= $params['package_availability'];
			$content .= '</li>';
		}
		if ( $params['package_count'] !== '' ) {
			$content .= '<li>';
			$content .= '<span>' . esc_html( 'Count: ', 'eltd_listing' ) . '</span>';
			$content .= $params['package_count'];
			$content .= '</li>';
		}

		if ( $params['package_status_message'] !== '' ) {
			$content .= '<li>';
			$content .= '<span>' . esc_html( 'Info Message: ', 'eltd_listing' ) . '</span>';
			$content .= $params['package_status_message'];
			$content .= '</li>';
		}
		$content .= '</ul>';

		return $content;
	}


}