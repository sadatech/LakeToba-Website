<?php

if ( ! function_exists('search_and_go_elated_call_to_action_options_map') ) {
	/**
	 * Add Call to Action options to elements page
	 */
	function search_and_go_elated_call_to_action_options_map() {

		$panel_call_to_action = search_and_go_elated_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_call_to_action',
				'title' => 'Call To Action'
			)
		);

	}

	add_action( 'search_and_go_elated_options_elements_map', 'search_and_go_elated_call_to_action_options_map');

}