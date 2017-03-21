<?php

if(!function_exists('search_and_go_elated_register_required_plugins')) {
    /**
     * Registers Visual Composer, Layer Slider, Revolution Slider, Elated Core, Elated Instagram Feed, Elated Twitter Feed  as required plugins. Hooks to tgmpa_register hook
     */
    function search_and_go_elated_register_required_plugins() {
        $plugins = array(
            array(
                'name'               => 'WPBakery Visual Composer',
                'slug'               => 'js_composer',
                'source'             => get_template_directory().'/includes/plugins/js_composer.zip',
                'required'           => true,
                'version'            => '4.12',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => 'Elated Core',
                'slug'               => 'eltd-core',
                'source'             => get_template_directory().'/includes/plugins/eltd-core.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => 'Elated Instagram Feed',
                'slug'               => 'eltd-instagram-feed',
                'source'             => get_template_directory().'/includes/plugins/eltd-instagram-feed.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => 'Elated Listing',
                'slug'               => 'eltd-listing',
                'source'             => get_template_directory().'/includes/plugins/eltd-listing.zip',
                'required'           => true,
                'version'            => '1.1',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            ),
            array(
                'name'               => 'Elated Booking',
                'slug'               => 'eltd-booking',
                'source'             => get_template_directory().'/includes/plugins/eltd-booking.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => ''
            )
        );

        $config = array(
            'domain'           => 'search-and-go',
            'default_path'     => '',
            'parent_slug' 	   => 'themes.php',
            'capability' 	   => 'edit_theme_options',
            'menu'             => 'install-required-plugins',
            'has_notices'      => true,
            'is_automatic'     => false,
            'message'          => '',
            'strings'          => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'search-and-go'),
                'menu_title'                      => esc_html__('Install Plugins', 'search-and-go'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'search-and-go'),
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'search-and-go'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'search-and-go'),
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'search-and-go'),
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'search-and-go'),
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'search-and-go'),
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'search-and-go'),
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'search-and-go'),
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'search-and-go'),
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'search-and-go'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'search-and-go'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'search-and-go'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'search-and-go'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'search-and-go'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'search-and-go'),
                'nag_type'                        => 'updated'
            )
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'search_and_go_elated_register_required_plugins');
}


