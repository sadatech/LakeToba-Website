<?php

if (!function_exists('search_and_go_elated_register_widgets')) {

	function search_and_go_elated_register_widgets() {

		$widgets = array(
			'SearchAndGoLatestPosts',
			'SearchAndGoSocialIconWidget',
			'SearchAndGoSeparatorWidget',
			'SearchAndGoLoginRegister',
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'search_and_go_elated_register_widgets');