<?php

if (!function_exists('search_and_go_elated_get_footer_classes')) {
	/**
	 * Return all footer classes
	 *
	 * @param $page_id
	 * @return string|void
	 */
	function search_and_go_elated_get_footer_classes($page_id) {

		$footer_classes                     = '';
		$footer_classes_array               = array();

		//is uncovering footer option set in theme options?
		if(search_and_go_elated_options()->getOptionValue('uncovering_footer') == 'yes') {
			$footer_classes_array[] = 'eltd-footer-uncover';
		}

		if(get_post_meta($page_id, 'eltd_disable_footer_meta', true) == 'yes'){
			$footer_classes_array[] = 'eltd-disable-footer';
		}

		//is some class added to footer classes array?
		if(is_array($footer_classes_array) && count($footer_classes_array)) {
			//concat all classes and prefix it with class attribute
			$footer_classes = esc_attr(implode(' ', $footer_classes_array));
		}

		return $footer_classes;

	}

}

if ( ! function_exists( 'search_and_go_elated_get_footer_background_image' ) ) {

	function search_and_go_elated_get_footer_background_image( $page_id ) {

		if ( get_post_meta( $page_id, 'eltd_footer_background_image_meta', true ) !== '' ) {
			$background_image = get_post_meta( $page_id, 'eltd_footer_background_image_meta', true );
		} else {
			$background_image = (search_and_go_elated_options()->getOptionValue('footer_background_image') !== '') ? search_and_go_elated_options()->getOptionValue('footer_background_image') : '';
		}
		return $background_image;

	}

}

if (!function_exists('search_and_go_elated_footer_top_classes')) {
	/**
	 * Return classes for footer top
	 *
	 * @return string
	 */
	function search_and_go_elated_footer_top_classes() {

		$footer_top_classes = array();

		if(search_and_go_elated_options()->getOptionValue('footer_in_grid') !== 'yes') {
			$footer_top_classes[] = 'eltd-footer-top-full';
		}

		//footer aligment
		if(search_and_go_elated_options()->getOptionValue('footer_top_columns_alignment') != '') {
			$footer_top_classes[] = 'eltd-footer-top-aligment-'.search_and_go_elated_options()->getOptionValue('footer_top_columns_alignment');
		}


		return implode(' ', $footer_top_classes);
	}

}