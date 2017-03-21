<?php
/**
 * The template for displaying product widget entries
 * @see 	https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>
<li>
	<div class="eltd-woocommerce-product-holder clearfix">
		<div class="eltd-woocommerce-product-left">
			<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
				<span class="eltd-product-title"><?php echo $product->get_title(); ?></span>
			</a>
			<div class="eltd-product-price">
				<?php echo $product->get_price_html(); ?>
			</div>
			<div class="eltd-product-rating">
				<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
			</div>
		</div>
		<div class="eltd-woocommerce-product-right">
			<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
				<?php echo $product->get_image(); ?>
			</a>
		</div>
	</div>
</li>