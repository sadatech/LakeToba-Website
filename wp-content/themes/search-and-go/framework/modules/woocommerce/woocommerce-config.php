<?php
/**
 * Woocommerce configuration file
 */

// Adds theme support for woocommerce
add_theme_support('woocommerce');

//Disable the default WooCommerce stylesheet.
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

if (!function_exists('search_and_go_elated_woocommerce_content')){
	/**
	 * Output WooCommerce content.
	 *
	 * This function is only used in the optional 'woocommerce.php' template
	 * which people can add to their themes to add basic woocommerce support
	 * without hooks or modifying core templates.
	 *
	 * @access public
	 * @return void
	 */
	function search_and_go_elated_woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) : the_post();

				wc_get_template_part( 'content', 'single-product' );

			endwhile;

		} else {

			if ( have_posts() ) :

				do_action('woocommerce_before_shop_loop');

				woocommerce_product_loop_start();

				woocommerce_product_subcategories();

				while ( have_posts() ) : the_post();

					wc_get_template_part( 'content', 'product' );

				endwhile; // end of the loop.

				woocommerce_product_loop_end();

				do_action('woocommerce_after_shop_loop');

			elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :

				wc_get_template( 'loop/no-products-found.php' );

			endif;

		}
	}
}


//PRODUCT LIST

//Define number of products per page
add_filter('loop_shop_per_page', 'search_and_go_elated_woocommerce_products_per_page', 20);

//Set number of related products
add_filter( 'woocommerce_output_related_products_args', 'search_and_go_elated_woocommerce_related_products_args');

//Overide Product List Loop Title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'search_and_go_elated_woocommerce_template_loop_product_title', 10 );

//Add Lightbox icon to Products Loop
add_action( 'woocommerce_shop_loop_item_title', 'search_and_go_elated_woocommerce_template_loop_lightbox', 10 );

//Override Product List Loop Add To Cart
add_action('woocommerce_before_shop_loop_item_title', 'search_and_go_elated_woocommerce_loop_add_to_cart_link');

//Add out of stock notice to products loop
add_action( 'woocommerce_before_shop_loop_item_title', 'search_and_go_elated_woocommerce_loop_out_of_stock' );

//Remove open link position
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

//SINGLE PRODUCT

//Single Product Title template override
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'search_and_go_elated_woocommerce_single_product_title', 'search_and_go_elated_woocommerce_template_single_title' );

//Single product price and rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating' );
add_action( 'search_and_go_elated_woocommerce_single_product_price', 'woocommerce_template_single_price' );
add_action( 'search_and_go_elated_woocommerce_single_product_price', 'woocommerce_template_single_rating' );

//Single Product override tabs position
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);

//Sale flash template override
add_filter( 'woocommerce_sale_flash', 'search_and_go_elated_woocommerce_sale_flash');
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );
add_action( 'search_and_go_elated_woocommerce_single_product_sale_flash', 'woocommerce_show_product_sale_flash' );

//Set Woocommerce button style
//Simple and grouped products
add_action('search_and_go_elated_woocommerce_add_to_cart_button', 'search_and_go_elated_get_woocommerce_add_to_cart_button');

//External product
add_action('search_and_go_elated_woocommerce_add_to_cart_button_external', 'search_and_go_elated_get_woocommerce_add_to_cart_button_external');

//Variable product
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'search_and_go_elated_woocommerce_single_variation_add_to_cart_button', 20 );

//Apply Coupon Button
add_action('search_and_go_elated_woocommerce_apply_coupon_button', 'search_and_go_elated_get_woocommerce_apply_coupon_button');

//Update Cart
add_action('search_and_go_elated_woocommerce_update_cart_button', 'search_and_go_elated_get_woocommerce_update_cart_button');

//Proceed To Checkout Button
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
add_action( 'woocommerce_proceed_to_checkout', 'search_and_go_elated_woocommerce_button_proceed_to_checkout', 20 );

//Update Totals Button, Shipping Calculator
add_action('search_and_go_elated_woocommerce_update_totals_button', 'search_and_go_elated_get_woocommerce_update_totals_button');

//Pay For Order Button, Checkout page
add_filter('woocommerce_pay_order_button_html', 'search_and_go_elated_woocommerce_pay_order_button_html');

//Place Order Button, Checkout page
add_filter('woocommerce_order_button_html', 'search_and_go_elated_woocommerce_order_button_html');

//Remove cart collaterals from cart totals
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );