<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	<div class="eltd-single-product-summary">
		<div class="summary entry-summary">

			<div class="eltd-single-product-title clearfix">
				<?php
				/**
				 * search_and_go_elated_woocommerce_single_product_title hook
				 *
				 * @hooked search_and_go_elated_woocommerce_template_single_category
				 * @hooked search_and_go_elated_woocommerce_template_single_title
				 */

				do_action( 'search_and_go_elated_woocommerce_single_product_title' );
				?>
			</div>

			<div class="eltd-single-product-price clearfix">
				<?php
				/**
				 * search_and_go_elated_woocommerce_single_product_price hook
				 *
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_rating - 10
				 */
				do_action( 'search_and_go_elated_woocommerce_single_product_price' );
				echo search_and_go_elated_get_social_share_html(array('type' => 'dropdown'));
				?>
			</div>

			<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>

		</div>
	</div><!-- .eltd-signle-product-summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
