<?php

if ( ! function_exists('search_and_go_elated_pricing_table_options_map') ) {
	/**
	 * Add Pricing Table options to elements page
	 */
	function search_and_go_elated_pricing_table_options_map() {

		$panel_pricing_table = search_and_go_elated_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_pricing_table',
				'title' => 'Pricing Table'
			)
		);

	}

	add_action( 'search_and_go_elated_options_elements_map', 'search_and_go_elated_pricing_table_options_map');

}