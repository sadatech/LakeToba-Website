<?php

if(!function_exists('search_and_go_elated_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function search_and_go_elated_get_button_html($params) {
        $button_html = search_and_go_elated_execute_shortcode('eltd_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}