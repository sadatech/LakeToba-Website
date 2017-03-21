<?php
/*
Plugin Name: Elated Booking
Description: Plugin that adds booking functionality
Author: Elated Themes
Version: 1.0
*/

require_once 'load.php';

\ElatedBooking\Lib\ShortcodeLoader::getInstance()->load();

if(!function_exists('eltd_booking_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines eltd_booking_booking_on_activate action
     */
    function eltd_booking_activation() {
        do_action('eltd_booking_booking_on_activate');

        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'eltd_booking_activation');
}

if(!function_exists('eltd_booking_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function eltd_booking_text_domain() {
        load_plugin_textdomain('eltd_booking', false, ELATED_BOOKING_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'eltd_booking_text_domain');
}

if (!function_exists('eltd_booking_enqueue_scripts')) {

    function eltd_booking_enqueue_scripts() {

        wp_enqueue_script('jquery-ui-datepicker');
    }

    add_action('wp_enqueue_scripts', 'eltd_booking_enqueue_scripts');

}