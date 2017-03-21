<?php

if ( ! function_exists('search_and_go_elated_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function search_and_go_elated_load_elements_map() {

		search_and_go_elated_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-header'
			)
		);

		do_action( 'search_and_go_elated_options_elements_map' );

	}

	add_action('search_and_go_elated_options_map', 'search_and_go_elated_load_elements_map',15);

}