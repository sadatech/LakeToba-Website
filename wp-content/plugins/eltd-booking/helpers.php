<?php

if(!function_exists('eltd_booking_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function eltd_booking_version_class($classes) {
        $classes[] = 'eltd-booking-'.ELATED_BOOKING_VERSION;

        return $classes;
    }

    add_filter('body_class', 'eltd_booking_version_class');
}

if(!function_exists('eltd_booking_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function eltd_booking_theme_installed() {
        return defined('ELATED_ROOT');
    }
}

if(!function_exists('eltd_booking_get_template_part')) {
    /**
     * Loads template part with parameters. If file with slug parameter added exists it will load that file, else it will load file without slug added.
     * Child theme friendly function
     *
     * @param string $template name of the template to load without extension
     * @param string $slug
     * @param array $params array of parameters to pass to template
     * @param bool $return whether to return it as a string
     *
     * @return mixed
     */
    function eltd_booking_get_template_part($template, $slug = '', $params = array(), $return = false) {
        //HTML Content from template
        $html = '';
        $template_path = ELATED_BOOKING_ABS_PATH;

        $temp = $template_path.'/'.$template;
        if(is_array($params) && count($params)) {
            extract($params);
        }

        $template = '';

        if($temp !== '') {
            $template = $temp.'.php';

            if($slug !== '') {
                $template = "{$temp}-{$slug}.php";
            }
        }

        if($template) {
            if($return) {
                ob_start();
            }

            include($template);

            if($return) {
                $html = ob_get_clean();
            }

        }

        if($return) {
            return $html;
        }
    }
}