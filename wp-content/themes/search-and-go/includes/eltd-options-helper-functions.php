<?php

if(!function_exists('search_and_go_elated_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function search_and_go_elated_is_responsive_on() {
        return search_and_go_elated_options()->getOptionValue('responsiveness') !== 'no';
    }
}