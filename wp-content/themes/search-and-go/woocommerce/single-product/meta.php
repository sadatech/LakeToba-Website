<?php
/**
 * Single Product Meta
  * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><span class="sku_wrapper-title"><?php esc_html_e( 'SKU:', 'search_and_go' ); ?></span> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'search_and_go' ); ?></span></span>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in"><span class="posted_in-title">' . _n( 'Category:', 'Categories:', $cat_count, 'search_and_go' ) . '</span> ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as"><span class="tagged_as-title">' . _n( 'Tag:', 'Tags:', $tag_count, 'search_and_go' ) . '</span> ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
