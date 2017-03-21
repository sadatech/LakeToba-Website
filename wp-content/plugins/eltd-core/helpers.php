<?php

if(!function_exists('eltd_core_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function eltd_core_version_class($classes) {
        $classes[] = 'eltd-core-'.ELATED_CORE_VERSION;

        return $classes;
    }

    add_filter('body_class', 'eltd_core_version_class');
}

if(!function_exists('eltd_core_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function eltd_core_theme_installed() {
        return defined('ELATED_ROOT');
    }
}

if (!function_exists('eltd_core_get_carousel_slider_array')){
    /**
     * Function that returns associative array of carousels,
     * where key is term slug and value is term name
     * @return array
     */
    function eltd_core_get_carousel_slider_array() {
        $carousels_array = array();
        $terms = get_terms('carousels_category');

        if (is_array($terms) && count($terms)) {
            $carousels_array[''] = '';
            foreach ($terms as $term) {
                $carousels_array[$term->slug] = $term->name;
            }
        }

        return $carousels_array;
    }
}

if(!function_exists('eltd_core_get_carousel_slider_array_vc')) {
    /**
     * Function that returns array of carousels formatted for Visual Composer
     *
     * @return array array of carousels where key is term title and value is term slug
     *
     * @see eltd_core_get_carousel_slider_array
     */
    function eltd_core_get_carousel_slider_array_vc() {
        return array_flip(eltd_core_get_carousel_slider_array());
    }
}

if(!function_exists('eltd_core_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @see search_and_go_elated_get_template_part()
	 */
	function eltd_core_get_shortcode_module_template_part($shortcode,$template, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = ELATED_CORE_CPT_PATH.'/'.$shortcode.'/shortcodes/templates';
		
		$temp = $template_path.'/'.$template;
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$template = '';

		if($temp !== '') {
			if($slug !== '') {
				$template = "{$temp}-{$slug}.php";
			}
			$template = $temp.'.php';
		}
		if($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}