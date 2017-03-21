<?php
if(!function_exists('search_and_go_elated_shop_single_style')) {

	function search_and_go_elated_shop_single_style() {
		$selector = '.single-product .eltd-overlapping-content';
		$styles = array();

		$padding = search_and_go_elated_options()->getOptionValue('woo_single_overlapping_content_padding');
		if(!empty($padding)) {
			$styles['padding'] = $padding;
		}

		echo search_and_go_elated_dynamic_css($selector, $styles);
	}

	add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_shop_single_style');
}
?>