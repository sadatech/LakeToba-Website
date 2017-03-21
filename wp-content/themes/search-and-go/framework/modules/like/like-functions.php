<?php

if ( ! function_exists('search_and_go_elated_like') ) {
	/**
	 * Returns SearchAndGoLike instance
	 *
	 * @return SearchAndGoLike
	 */
	function search_and_go_elated_like() {
		return SearchAndGoLike::get_instance();
	}

}

function search_and_go_elated_get_like() {

	echo wp_kses(search_and_go_elated_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('search_and_go_elated_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function search_and_go_elated_like_latest_posts() {
		return search_and_go_elated_like()->add_like();
	}

}

if ( ! function_exists('search_and_go_elated_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function search_and_go_elated_like_portfolio_list($portfolio_project_id) {
		return search_and_go_elated_like()->add_like_portfolio_list($portfolio_project_id);
	}

}