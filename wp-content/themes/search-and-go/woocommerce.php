<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php

global $woocommerce;

$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);
$sidebar = search_and_go_elated_sidebar_layout();

if(get_post_meta($id, 'eltd_page_background_color', true) != ''){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, 'eltd_page_background_color', true));
}else{
	$background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'eltd_content-top-padding', true) != '') {
	if(get_post_meta($id, 'eltd_content-top-padding-mobile', true) == 'yes') {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'eltd_content-top-padding', true)).'px !important';
	} else {
		$content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'eltd_content-top-padding', true)).'px';
	}
}

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

get_header();

get_template_part( 'title' );
get_template_part('slider');

$full_width = false;

if ( search_and_go_elated_options()->getOptionValue('eltd_woo_products_list_full_width') == 'yes' && !is_singular('product') ) {
	$full_width = true;
}
$overlapping_content = search_and_go_elated_options()->getOptionValue('overlapping_content') == 'yes' ? true : false;
if ( $full_width ) { ?>
	<div class="eltd-full-width" <?php search_and_go_elated_inline_style($background_color); ?>>
<?php } else { ?>
	<div class="eltd-container" <?php search_and_go_elated_inline_style($background_color); ?>>
<?php }

		if ( $overlapping_content ) { ?>
			<div class="eltd-overlapping-content">
		<?php }

		if ( $full_width ) { ?>
			<div class="eltd-full-width-inner" <?php search_and_go_elated_inline_style($content_style); ?>>
		<?php } else { ?>
			<div class="eltd-container-inner clearfix" <?php search_and_go_elated_inline_style($content_style); ?>>
		<?php }

			//page content
			echo do_shortcode($shop->post_content);

			//Woocommerce content
			if ( ! is_singular('product') ) {

				switch( $sidebar ) {

					case 'sidebar-33-right': ?>
						<div class="eltd-two-columns-66-33 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1">
								<div class="eltd-column-inner">
									<?php search_and_go_elated_woocommerce_content(); ?>
								</div>
							</div>
							<div class="eltd-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-right': ?>
						<div class="eltd-two-columns-75-25 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1 eltd-content-left-from-sidebar">
								<div class="eltd-column-inner">
									<?php search_and_go_elated_woocommerce_content(); ?>
								</div>
							</div>
							<div class="eltd-column2">
								<?php get_sidebar();?>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-33-left': ?>
						<div class="eltd-two-columns-33-66 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1">
								<?php get_sidebar();?>
							</div>
							<div class="eltd-column2">
								<div class="eltd-column-inner">
									<?php search_and_go_elated_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					case 'sidebar-25-left': ?>
						<div class="eltd-two-columns-25-75 grid2 eltd-woocommerce-with-sidebar clearfix">
							<div class="eltd-column1">
								<?php get_sidebar();?>
							</div>
							<div class="eltd-column2 eltd-content-right-from-sidebar">
								<div class="eltd-column-inner">
									<?php search_and_go_elated_woocommerce_content(); ?>
								</div>
							</div>
						</div>
					<?php
						break;
					default:
						search_and_go_elated_woocommerce_content();
				}

			} else {
				search_and_go_elated_woocommerce_content();
			} ?>

			</div>

		<?php if ( $overlapping_content ) { ?>
			</div>
		<?php } ?>

	</div>
<?php get_footer(); ?>
