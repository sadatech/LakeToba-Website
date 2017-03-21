<?php

if (!function_exists('search_and_go_elated_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function search_and_go_elated_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (search_and_go_elated_options()->getOptionValue('eltd_woo_products_per_page')) {
			$products_per_page = search_and_go_elated_options()->getOptionValue('eltd_woo_products_per_page');
		}

		return $products_per_page;

	}

}

if (!function_exists('search_and_go_elated_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function search_and_go_elated_woocommerce_related_products_args($args) {

		if (search_and_go_elated_options()->getOptionValue('eltd_woo_product_list_columns')) {

			$related = search_and_go_elated_options()->getOptionValue('eltd_woo_product_list_columns');
			switch ($related) {
				case 'eltd-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'eltd-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}

		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;

	}

}

if (!function_exists('search_and_go_elated_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function search_and_go_elated_woocommerce_template_loop_product_title() {

		$tag = search_and_go_elated_options()->getOptionValue('eltd_products_list_title_tag');
		the_title('<' . $tag . ' class="eltd-product-list-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('search_and_go_elated_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function search_and_go_elated_woocommerce_template_single_title() {

		$tag = search_and_go_elated_options()->getOptionValue('eltd_single_product_title_tag');
		the_title('<' . $tag . '  itemprop="name" class="eltd-single-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('search_and_go_elated_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function search_and_go_elated_woocommerce_sale_flash() {

		return '<span class="eltd-onsale"><span class="eltd-onsale-inner">' . esc_html__('Sale', 'search_and_go') . '</span></span>';
	}
}

if (!function_exists('search_and_go_elated_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from eltd_button
	 *
	 * @return mixed|string
	 */
	function search_and_go_elated_woocommerce_loop_add_to_cart_link() {

		global $product;

		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s product_type_%s',
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button ajax_add_to_cart' : '',
			esc_attr( $product->product_type )
		);
		$button_text = $product->add_to_cart_text();
		$button_attrs = array(
			'rel' => 'nofollow',
			'data-product_id' => esc_attr( $product->id ),
			'data-product_sku' => esc_attr( $product->get_sku() ),
			'data-quantity' => esc_attr( isset( $quantity ) ? $quantity : 1 )
		);
		$button_icon = ($product->is_in_stock()) ? 'icon-handbag' : 'icon-action-redo';

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');
		
		$add_to_cart_button = search_and_go_elated_get_button_html(
			array(
				'type'			=> 'solid',
				'background_color' => $button_back_color,
				'link'			=> $button_url,
				'custom_class'	=> $button_classes,
				'text'			=> $button_text,
				'custom_attrs'	=> $button_attrs
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('search_and_go_elated_get_woocommerce_add_to_cart_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on simple and grouped product single template
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_get_woocommerce_add_to_cart_button() {

		global $product;

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');

		$add_to_cart_button = search_and_go_elated_get_button_html(

			array(
				'type'			=> 'solid',
				'icon_pack'          => 'font_elegant',
				'fe_icon'       => 'arrow_carrot-right',
				'background_color' => $button_back_color,
				'custom_class'	=> 'button ajax_add_to_cart single_add_to_cart_button eltd-single-product-add-to-cart alt',
				'text'			=> $product->single_add_to_cart_text(),
				'html_type'		=> 'button'
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('search_and_go_elated_get_woocommerce_add_to_cart_button_external')) {
	/**
	 * Function that overrides default woocommerce add to cart button on external product single template
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_get_woocommerce_add_to_cart_button_external() {

		global $product;
		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');
		
		$add_to_cart_button = search_and_go_elated_get_button_html(
			array(
				'type'			=> 'solid',
				'icon_pack'          => 'font_elegant',
				'fe_icon'       => 'arrow_carrot-right',
				'background_color' => $button_back_color,
				'link'			=> $product->add_to_cart_url(),
				'custom_class'	=> 'single_add_to_cart_button eltd-single-product-add-to-cart alt',
				'text'			=> $product->single_add_to_cart_text(),
				'custom_attrs'	=> array(
					'rel' 		=> 'nofollow'
				)
			)
		);

		print $add_to_cart_button;

	}

}

if ( ! function_exists('search_and_go_elated_woocommerce_single_variation_add_to_cart_button') ) {
	/**
	 * Function that overrides default woocommerce add to cart button on variable product single template
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_woocommerce_single_variation_add_to_cart_button() {
		global $product;

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');
		
		$html = '<div class="variations_button">';
		woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );

		$button = search_and_go_elated_get_button_html(array(
			'type'			=> 'solid',
			'icon_pack'          => 'font_elegant',
			'fe_icon'       => 'arrow_carrot-right',
			'background_color' => $button_back_color,
			'html_type'		=> 'button',
			'custom_class'	=> 'single_add_to_cart_button eltd-single-product-add-to-cart alt',
			'text'			=> $product->single_add_to_cart_text()
		));

		$html .= $button;

		$html .= '<input type="hidden" name="add-to-cart" value="' . absint( $product->id ) . '" />';
		$html .= '<input type="hidden" name="product_id" value="' . absint( $product->id ) . '" />';
		$html .= '<input type="hidden" name="variation_id" class="variation_id" value="" />';
		$html .= '</div>';

		print $html;

	}

}

if (!function_exists('search_and_go_elated_get_woocommerce_apply_coupon_button')) {
	/**
	 * Function that overrides default woocommerce apply coupon button
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_get_woocommerce_apply_coupon_button() {

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');

		$coupon_button = search_and_go_elated_get_button_html(array(
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'html_type'		=> 'input',
			'input_name'	=> 'apply_coupon',
			'text'			=> esc_html__( 'Apply Coupon', 'search_and_go' ),
		));

		print $coupon_button;

	}

}

if (!function_exists('search_and_go_elated_get_woocommerce_update_cart_button')) {
	/**
	 * Function that overrides default woocommerce update cart button
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_get_woocommerce_update_cart_button() {

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');

		$update_cart_button = search_and_go_elated_get_button_html(array(
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'html_type'		=> 'input',
			'input_name'	=> 'update_cart',
			'text'			=> esc_html__( 'Update Cart', 'search_and_go' )
		));

		print $update_cart_button;

	}

}

if (!function_exists('search_and_go_elated_woocommerce_button_proceed_to_checkout')) {
	/**
	 * Function that overrides default woocommerce proceed to checkout button
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_woocommerce_button_proceed_to_checkout() {

		$proceed_to_checkout_button = search_and_go_elated_get_button_html(array(
			'type'			=> 'solid',
			'link'			=> WC()->cart->get_checkout_url(),
			'custom_class'	=> 'checkout-button alt wc-forward',
			'text'			=> esc_html__( 'Proceed to Checkout', 'search_and_go' )
		));

		print $proceed_to_checkout_button;

	}

}

if (!function_exists('search_and_go_elated_get_woocommerce_update_totals_button')) {
	/**
	 * Function that overrides default woocommerce update totals button
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_get_woocommerce_update_totals_button() {

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');

		$update_totals_button = search_and_go_elated_get_button_html(array(
			'html_type'		=> 'button',
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'text'			=> esc_html__( 'Update Totals', 'search_and_go' ),
			'custom_attrs'	=> array(
				'value'		=> 1,
				'name'		=> 'calc_shipping'
			)
		));

		print $update_totals_button;

	}

}

if (!function_exists('search_and_go_elated_woocommerce_pay_order_button_html')) {
	/**
	 * Function that overrides default woocommerce pay order button on checkout page
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_woocommerce_pay_order_button_html() {

		$pay_order_button_text = esc_html__('Pay for order', 'search_and_go');

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');

		$place_order_button = search_and_go_elated_get_button_html(array(
			'html_type'		=> 'input',
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'custom_class'	=> 'alt',
			'custom_attrs'	=> array(
				'id'			=> 'place_order',
				'data-value'	=> $pay_order_button_text
			),
			'text'			=> $pay_order_button_text,
		));

		return $place_order_button;

	}

}

if (!function_exists('search_and_go_elated_woocommerce_order_button_html')) {
	/**
	 * Function that overrides default woocommerce place order button on checkout page
	 * Uses HTML from eltd_button
	 */
	function search_and_go_elated_woocommerce_order_button_html() {

		$pay_order_button_text = esc_html__('Place Order', 'search_and_go');

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');

		$place_order_button = search_and_go_elated_get_button_html(array(
			'html_type'		=> 'input',
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'custom_class'	=> 'alt',
			'custom_attrs'	=> array(
				'id'			=> 'place_order',
				'data-value'	=> $pay_order_button_text,
				'name'			=> 'woocommerce_checkout_place_order'
			),
			'text'			=> $pay_order_button_text,
		));

		return $place_order_button;

	}

}

if ( ! function_exists( 'search_and_go_elated_woocommerce_loop_out_of_stock' ) ) {

	function search_and_go_elated_woocommerce_loop_out_of_stock() {

		global $product;

		if ( ! $product->is_in_stock() ) {
			echo '<span class="eltd-out-of-stock"><span class="eltd-out-of-stock-inner">' . esc_html__('Out ', 'search_and_go') . '<span class="eltd-out-of-stock-inner-small">' . esc_html__('of Stock', 'search_and_go') . '</span></span></span>';
		}

	}

}

if ( ! function_exists( 'search_and_go_elated_woocommerce_template_single_category' ) ) {

	/**
	 * Add product categories before product title on single product page
	 */
	function search_and_go_elated_woocommerce_template_single_category() {

		global $product;

		$categories = $product->get_categories(', ');

		echo '<div class="eltd-single-product-categories">';
		echo wp_kses($categories, array(
			'a' => array(
				'href' => true,
				'rel' => true
			)
		));
		echo '</div>';

	}

}

if ( ! function_exists( 'search_and_go_elated_woocommerce_template_loop_lightbox' ) ) {

	function search_and_go_elated_woocommerce_template_loop_lightbox() {

		$lightbox_html = '';
		if ( search_and_go_elated_options()->getOptionValue('eltd_woo_products_lightbox') == 'yes' ) {

			global $product;

			$image_id = $product->get_image_id();
			$image = wp_get_attachment_image_src($image_id, 'full');
			$image_title = $product->get_title();

			$lightbox_html = '<a class="eltd-woocommerce-lightbox" data-rel="prettyPhoto[single_pretty_photo]" href="'. $image[0] .'" title="'. $image_title .'">';
			$lightbox_html .= '<i class="icon-magnifier-add"></i>';
			$lightbox_html .= '</a>';

		}

		print $lightbox_html;

	}

}