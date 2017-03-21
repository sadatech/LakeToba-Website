<?php

if(!function_exists('search_and_go_elated_vc_grid_elements_enabled')) {

	/**
	 * Function that checks if Visual Composer Grid Elements are enabled
	 *
	 * @return bool
	 */
	function search_and_go_elated_vc_grid_elements_enabled() {

		return (search_and_go_elated_options()->getOptionValue('enable_grid_elements') == 'yes') ? true : false;

	}
}

if(!function_exists('search_and_go_elated_visual_composer_grid_elements')) {

	/**
	 * Removes Visual Composer Grid Elements post type if VC Grid option disabled
	 * and enables Visual Composer Grid Elements post type
	 * if VC Grid option enabled
	 */
	function search_and_go_elated_visual_composer_grid_elements() {

		if(!search_and_go_elated_vc_grid_elements_enabled()) {
			remove_action('init', 'vc_grid_item_editor_create_post_type');
		}
	}

	add_action('vc_after_init', 'search_and_go_elated_visual_composer_grid_elements', 12);
}

if(!function_exists('search_and_go_elated_grid_elements_ajax_disable')) {
	/**
	 * Function that disables ajax transitions if grid elements are enabled in theme options
	 */
	function search_and_go_elated_grid_elements_ajax_disable() {
		global $search_and_go_elated_options;

		if(search_and_go_elated_vc_grid_elements_enabled()) {
			$search_and_go_elated_options['page_transitions'] = '0';
		}
	}

	add_action('wp', 'search_and_go_elated_grid_elements_ajax_disable');
}


if(!function_exists('search_and_go_elated_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function search_and_go_elated_get_vc_version() {
		if(search_and_go_elated_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}