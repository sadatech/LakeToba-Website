<?php

if ( ! function_exists('search_and_go_elated_blockquote_options_map') ) {
	/**
	 * Add Blockquote options to elements page
	 */
	function search_and_go_elated_blockquote_options_map() {

		$panel_blockquote = search_and_go_elated_add_admin_panel(
			array(
				'page' => '_elements_page',
				'name' => 'panel_blockquote',
				'title' => 'Blockquote'
			)
		);

	}

	add_action( 'search_and_go_elated_options_elements_map', 'search_and_go_elated_blockquote_options_map');

}