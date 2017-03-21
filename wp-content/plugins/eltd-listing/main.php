<?php
/*
Plugin Name: Elated Listing
Description: Plugin that adds listing features to theme
Author: Elated Themes
Version: 1.1
*/

require_once 'load.php';

use ElatedListing\CPT;
use ElatedListing\Lib;

add_action('after_setup_theme', array(CPT\PostTypesRegister::getInstance(), 'register'), 1);

Lib\ShortcodeLoader::getInstance()->load();

if(!function_exists('eltd_listing_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines eltd_listing_action_core_on_activate action
     */
    function eltd_listing_activation() {
        do_action('eltd_listing_action_core_on_activate');

        ElatedListing\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'eltd_listing_activation');
}

if(!function_exists('eltd_listing_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function eltd_listing_text_domain() {
        load_plugin_textdomain('eltd_listing', false, ELATED_LISTING_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'eltd_listing_text_domain');
}

if(!function_exists('eltd_listing_add_user_role')) {
	function eltd_listing_add_user_role()
	{
		$capabilities = array(
			'read' => true,
			'edit_posts' => true,
			'edit_pages' => true,
			'edit_others_posts' => false,
			'create_posts' => true,
			'manage_categories' => false,
			'publish_posts' => true,
			'edit_themes' => false,
			'install_plugins' => false,
			'update_plugin' => false,
			'update_core' => false,
			'upload_files' => true,
			'edit_files' => false
		);
		add_role( 'owner', esc_html__('Owner', 'eltd_listing'), $capabilities);

	}

	register_activation_hook(ELATED_LISTING_ABS_PATH . '/main.php', 'eltd_listing_add_user_role');
}
if(!function_exists( 'eltd_listing_remove_user_role' )) {
	function eltd_listing_remove_user_role()
	{
		remove_role( 'owner' );
	}
	register_deactivation_hook(ELATED_LISTING_ABS_PATH . '/main.php', 'eltd_listing_remove_user_role' );
}
if(!function_exists('eltd_listing_enqueue_scripts')){
    /**
     * Enqueue required scripts
     */
    function eltd_listing_enqueue_scripts(){
        wp_enqueue_media();
    }
    add_action('wp_enqueue_scripts', 'eltd_listing_enqueue_scripts');
}

if(!function_exists('eltd_listing_add_package_table')){
	
	function eltd_listing_add_package_table() {
		
		global $wpdb;

		$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			user_id mediumint(9),
			package_id mediumint(9),
			date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			status text,
			transaction_id varchar(55) DEFAULT '' NOT NULL,
			expire_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			UNIQUE KEY id (id)
				
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
	 register_activation_hook(__FILE__, 'eltd_listing_add_package_table');
}