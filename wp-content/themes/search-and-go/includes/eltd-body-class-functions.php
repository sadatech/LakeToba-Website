<?php

if(!function_exists('search_and_go_elated_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function search_and_go_elated_boxed_class($classes) {

        //is boxed layout turned on?
        if(search_and_go_elated_options()->getOptionValue('boxed') == 'yes') {
            $classes[] = 'eltd-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_boxed_class');
}

if(!function_exists('search_and_go_elated_overlapped_content_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function search_and_go_elated_overlapped_content_class($classes) {

        //is boxed layout turned on?
        if(search_and_go_elated_options()->getOptionValue('overlapping_content') == 'yes'){
            $classes[] = 'eltd-overlapping-content-enabled';
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_overlapped_content_class');
}

if(!function_exists('search_and_go_elated_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function search_and_go_elated_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_theme_version_class');
}

if(!function_exists('search_and_go_elated_smooth_scroll_class')) {
    /**
     * Function that adds classes on body for smooth scroll
     */
    function search_and_go_elated_smooth_scroll_class($classes) {

        //is smooth scroll enabled enabled?
        if(search_and_go_elated_options()->getOptionValue('smooth_scroll') == 'yes') {
            $classes[] = 'eltd-smooth-scroll';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_smooth_scroll_class');
}

if(!function_exists('search_and_go_elated_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function search_and_go_elated_smooth_page_transitions_class($classes) {

        if(search_and_go_elated_options()->getOptionValue('smooth_page_transitions') == 'yes') {
            $classes[] = 'eltd-smooth-page-transitions';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_smooth_page_transitions_class');
}

if(!function_exists('search_and_go_elated_smooth_pt_true_ajax_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function search_and_go_elated_smooth_pt_true_ajax_class($classes) {

        if(search_and_go_elated_options()->getOptionValue('smooth_pt_true_ajax') !== '') {
            $classes[] = search_and_go_elated_options()->getOptionValue('smooth_pt_true_ajax') === 'no' ? 'eltd-mimic-ajax' : 'eltd-ajax';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_smooth_pt_true_ajax_class');
}

if(!function_exists('search_and_go_elated_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function search_and_go_elated_content_initial_width_body_class($classes) {

        if(search_and_go_elated_options()->getOptionValue('initial_content_width')) {
            $classes[] = 'eltd-'.search_and_go_elated_options()->getOptionValue('initial_content_width');
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_content_initial_width_body_class');
}

if(!function_exists('search_and_go_elated_set_blog_body_class')) {
    /**
     * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function search_and_go_elated_set_blog_body_class($classes) {

        if(search_and_go_elated_load_blog_assets()) {
            $classes[] = 'eltd-blog-installed';
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_set_blog_body_class');
}

if(!function_exists('search_and_go_elated_set_top_bar_body_class')) {
    /**
     * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function search_and_go_elated_set_top_bar_body_class($classes) {

        if(search_and_go_elated_options()->getOptionValue('top_bar') == 'yes') {
            $classes[] = 'eltd-top-bar-enabled';
        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_set_top_bar_body_class');
}

if(!function_exists('search_and_go_elated_set_shop_page_id')){

    function search_and_go_elated_set_shop_page_id($classes){

        if(search_and_go_elated_is_woocommerce_installed() && is_shop()){

            $id = search_and_go_elated_get_page_id();
            $classes[] = 'page-id-'.$id;

        }

        return $classes;
    }

    add_filter('body_class', 'search_and_go_elated_set_shop_page_id');
}