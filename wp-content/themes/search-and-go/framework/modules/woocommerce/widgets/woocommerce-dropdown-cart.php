<?php
class SearchAndGoWoocommerceDropdownCart extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'eltd_woocommerce_dropdown_cart', // Base ID
			'Elated Woocommerce Dropdown Cart', // Name
			array( 'description' => esc_html__( 'Elated Woocommerce Dropdown Cart', 'search_and_go' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		
		global $woocommerce;
		
		$cart_style = 'eltd-with-icon';

		$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');
		
		?>
		<div class="eltd-shopping-cart-outer">
			<div class="eltd-shopping-cart-inner">
				<div class="eltd-shopping-cart-header">
					<a class="eltd-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
						<i class="icon-handbag"></i>
						<span class="eltd-header-cart-span">
							<?php echo esc_html($woocommerce->cart->cart_contents_count); ?>
						</span>
					</a>
					<div class="eltd-shopping-cart-dropdown">
						<?php
						$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
						$list_class = array( 'eltd-cart-list', 'product_list_widget' );
						?>
						<ul>

							<?php if ( !$cart_is_empty ) : ?>

								<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

									$_product = $cart_item['data'];

									// Only display if allowed
									if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
										continue;
									}

									// Get price
									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
									?>


									<li>
										<div class="eltd-item-image-holder">
											<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
												<?php echo wp_kses($_product->get_image(), array(
													'img' => array(
														'src' => true,
														'width' => true,
														'height' => true,
														'class' => true,
														'alt' => true,
														'title' => true,
														'id' => true
													)
												)); ?>
											</a>
										</div>
										<div class="eltd-item-info-holder">
											<div class="eltd-item-left">
												<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'])); ?>">
													<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
												</a>
												<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
												<span class="eltd-quantity"><?php esc_html_e('Quantity: ','search_and_go'); echo esc_html($cart_item['quantity']); ?></span>
											</div>
											<div class="eltd-item-right">
												<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'search_and_go') ), $cart_item_key ); ?>
											</div>
										</div>
									</li>

								<?php endforeach; ?>

						</ul>

								<div class="eltd-cart-bottom">
									<div class="eltd-subtotal-holder clearfix">
										<span class="eltd-total"><?php esc_html_e( 'Total', 'search_and_go' ); ?>:</span>
										<span class="eltd-total-amount">
											<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
												'span' => array(
													'class' => true,
													'id' => true
												)
											)); ?>
										</span>
									</div>
									<div class="eltd-btns-holder clearfix">
										<?php $add_to_cart = search_and_go_elated_get_button_html(array(
												'link' => $woocommerce->cart->get_cart_url(),
												'text' => esc_html__( 'Shopping Bag', 'search_and_go' ),
												'custom_class' => 'view-cart',
												'type' => 'solid',
												'background_color' => $button_back_color,
												'size' => 'small'
										));
										print $add_to_cart;
										?>
										<?php $add_to_cart = search_and_go_elated_get_button_html(array(
												'link' => $woocommerce->cart->get_checkout_url(),
												'text' => esc_html__( 'Checkout', 'search_and_go' ),
												'custom_class' => 'checkout',
												'type' => 'solid',
												'size' => 'small',
												'icon_pack' => 'font_elegant',
												'background_color' => $button_back_color,
												'fe_icon' => 'arrow_right'
										));
										print $add_to_cart;
										?>
									</div>
								</div>
							<?php else : ?>

								<li class="eltd-empty-cart"><?php esc_html_e( 'No products in the cart.', 'search_and_go' ); ?></li>

						</ul>
							<?php endif; ?>

						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
						

						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "SearchAndGoWoocommerceDropdownCart" );' ) );
?>
<?php
add_filter('add_to_cart_fragments', 'search_and_go_elated_woocommerce_header_add_to_cart_fragment');
function search_and_go_elated_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	$button_back_color = search_and_go_elated_options()->getOptionValue('first_color');
	ob_start();
	?>
	<div class="eltd-shopping-cart-header">
		<a class="eltd-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
			<i class="icon-handbag"></i>
			<span class="eltd-header-cart-span">
				<?php echo esc_html($woocommerce->cart->cart_contents_count); ?>
			</span>
		</a>		
		<div class="eltd-shopping-cart-dropdown">
			<?php
			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
			//$list_class = array( 'eltd-cart-list', 'product_list_widget' );
			?>
			<ul>

				<?php if ( !$cart_is_empty ) : ?>

					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

						$_product = $cart_item['data'];

						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}

						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
						?>

						<li>
							<div class="eltd-item-image-holder">
								<?php echo wp_kses($_product->get_image(), array(
									'img' => array(
										'src' => true,
										'width' => true,
										'height' => true,
										'class' => true,
										'alt' => true,
										'title' => true,
										'id' => true
									)
								)); ?>
							</div>
							<div class="eltd-item-info-holder">
								<div class="eltd-item-left">
									<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
										<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
									</a>
									<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
									<span class="eltd-quantity"><?php esc_html_e('Quantity: ','search_and_go'); echo esc_html($cart_item['quantity']); ?></span>
								</div>
								<div class="eltd-item-right">
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'search_and_go') ), $cart_item_key ); ?>
								</div>
							</div>
						</li>

					<?php endforeach; ?>

					</ul>

						<div class="eltd-cart-bottom">
							<div class="eltd-subtotal-holder clearfix">
								<span class="eltd-total"><?php esc_html_e( 'Total', 'search_and_go' ); ?>:</span>
								<span class="eltd-total-amount">
									<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
										'span' => array(
											'class' => true,
											'id' => true
										)
									)); ?>
								</span>
							</div>
							<div class="eltd-btns-holder clearfix">
								<?php $add_to_cart = search_and_go_elated_get_button_html(array(
										'link' => $woocommerce->cart->get_cart_url(),
										'text' => esc_html__( 'Shopping Bag', 'search_and_go' ),
										'custom_class' => 'view-cart',
										'type' => 'solid',
										'background_color' => $button_back_color,
										'size' => 'small'
								));
								print $add_to_cart;
								?>
								<?php $add_to_cart = search_and_go_elated_get_button_html(array(
										'link' => $woocommerce->cart->get_checkout_url(),
										'text' => esc_html__( 'Checkout', 'search_and_go' ),
										'custom_class' => 'checkout',
										'type' => 'solid',
										'size' => 'small',
										'icon_pack' => 'font_elegant',
										'background_color' => $button_back_color,
										'fe_icon' => 'arrow_right'
								));
								print $add_to_cart;
								?>
							</div>
						</div>
				<?php else : ?>

					<li class="eltd-empty-cart"><?php esc_html_e( 'No products in the cart.', 'search_and_go' ); ?></li>

				</ul>
				<?php endif; ?>


			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
			

			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
		</div>
	</div>

	<?php
	$fragments['div.eltd-shopping-cart-header'] = ob_get_clean();
	return $fragments;
}
?>