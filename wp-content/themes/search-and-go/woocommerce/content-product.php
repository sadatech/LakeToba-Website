<?php
/**
 * The template for displaying product content within loops
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>
<li <?php post_class(); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="eltd-image-add-to-cart-holder">

		<a href="<?php the_permalink(); ?>">

			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 * @hooked chandelier_elated_woocommerce_loop_add_to_cart_link - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			?>

		</a>
		<div class="eltd-image-overlay"></div>
	</div>

	<a href="<?php the_permalink(); ?>">
		<div class="eltd-product-list-product-title-holder">
			<?php
			/**
			 * woocommerce_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			?>
		</div>
	</a>

	<?php

	/**
	 * woocommerce_after_shop_loop_item_title hook
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
	?>

</li>
