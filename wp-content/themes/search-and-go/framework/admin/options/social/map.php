<?php

if ( ! function_exists('search_and_go_elated_social_options_map') ) {

	function search_and_go_elated_social_options_map() {

		search_and_go_elated_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => 'Social Networks',
				'icon'  => 'fa fa-share-alt'
			)
		);

		/**
		 * Enable Social Login
		 */
		$panel_social_login = search_and_go_elated_add_admin_panel(array(
			'page'  => '_social_page',
			'name'  => 'panel_social_login',
			'title' => 'Enable Social Login'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_login',
			'default_value'	=> 'no',
			'label'			=> 'Enable Social Login',
			'description'	=> 'Enabling this option will allow login from social networks of your choice',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_panel_enable_social_login'
			),
			'parent'		=> $panel_social_login
		));

		$panel_enable_social_login = search_and_go_elated_add_admin_panel(array(
			'page'  => '_social_page',
			'name'  => 'panel_enable_social_login',
			'title' => 'Enable Login via',
			'hidden_property'	=> 'enable_social_login',
			'hidden_value'		=> 'no'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_facebook_social_login',
			'default_value'	=> 'no',
			'label'			=> 'Facebook',
			'description'	=> 'Enabling this option will allow login via Facebook',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_facebook_social_login_container'
			),
			'parent'		=> $panel_enable_social_login
		));

		$enable_facebook_social_login_container = search_and_go_elated_add_admin_container(array(
			'name'		        => 'enable_facebook_social_login_container',
			'hidden_property'	=> 'enable_facebook_social_login',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_enable_social_login
		));

		search_and_go_elated_add_admin_field(array(
			'type'          => 'text',
			'name'			=> 'enable_facebook_login_fbapp_id',
			'default_value'	=> '',
			'label'			=> 'Facebook App ID',
			'description'	=> 'Copy your application ID form created Facebook Application',
			'parent'        => $enable_facebook_social_login_container
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_google_social_login',
			'default_value'	=> 'no',
			'label'			=> 'Google+',
			'description'	=> 'Enabling this option will allow login via Google+',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_google_social_login_container'
			),
			'parent'		=> $panel_enable_social_login
		));

		$enable_google_social_login_container = search_and_go_elated_add_admin_container(array(
			'name'		        => 'enable_google_social_login_container',
			'hidden_property'	=> 'enable_google_social_login',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_enable_social_login
		));

		search_and_go_elated_add_admin_field(array(
			'type'          => 'text',
			'name'			=> 'enable_google_login_client_id',
			'default_value'	=> '',
			'label'			=> 'Client ID',
			'description'	=> 'Copy your Client ID form created Google Application',
			'parent'        => $enable_google_social_login_container
		));





		/**
		 * Enable Social Share
		 */
		$panel_social_share = search_and_go_elated_add_admin_panel(array(
			'page'  => '_social_page',
			'name'  => 'panel_social_share',
			'title' => 'Enable Social Share'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Social Share',
			'description'	=> 'Enabling this option will allow social share on networks of your choice',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_panel_social_networks, #eltd_panel_show_social_share_on'
			),
			'parent'		=> $panel_social_share
		));

		$panel_show_social_share_on = search_and_go_elated_add_admin_panel(array(
			'page'  			=> '_social_page',
			'name'  			=> 'panel_show_social_share_on',
			'title' 			=> 'Show Social Share On',
			'hidden_property'	=> 'enable_social_share',
			'hidden_value'		=> 'no'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_post',
			'default_value'	=> 'no',
			'label'			=> 'Posts',
			'description'	=> 'Show Social Share on Blog Posts',
			'parent'		=> $panel_show_social_share_on
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_page',
			'default_value'	=> 'no',
			'label'			=> 'Pages',
			'description'	=> 'Show Social Share on Pages',
			'parent'		=> $panel_show_social_share_on
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_attachment',
			'default_value'	=> 'no',
			'label'			=> 'Media',
			'description'	=> 'Show Social Share for Images and Videos',
			'parent'		=> $panel_show_social_share_on
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_portfolio-item',
			'default_value'	=> 'no',
			'label'			=> 'Portfolio Item',
			'description'	=> 'Show Social Share for Portfolio Items',
			'parent'		=> $panel_show_social_share_on
		));
		
		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_listing-item',
			'default_value'	=> 'no',
			'label'			=> 'Listing Item',
			'description'	=> 'Show Social Share for Listing Items',
			'parent'		=> $panel_show_social_share_on
		));

		if(search_and_go_elated_is_woocommerce_installed()){
			search_and_go_elated_add_admin_field(array(
				'type'			=> 'yesno',
				'name'			=> 'enable_social_share_on_product',
				'default_value'	=> 'no',
				'label'			=> 'Product',
				'description'	=> 'Show Social Share for Product Items',
				'parent'		=> $panel_show_social_share_on
			));
		}

		/**
		 * Social Share Networks
		 */
		$panel_social_networks = search_and_go_elated_add_admin_panel(array(
			'page'  			=> '_social_page',
			'name'				=> 'panel_social_networks',
			'title'				=> 'Social Networks',
			'hidden_property'	=> 'enable_social_share',
			'hidden_value'		=> 'no'
		));

		/**
		 * Facebook
		 */
		search_and_go_elated_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'facebook_title',
			'title'		=> 'Share on Facebook'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_facebook_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Facebook',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_facebook_share_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_facebook_share_container = search_and_go_elated_add_admin_container(array(
			'name'		=> 'enable_facebook_share_container',
			'hidden_property'	=> 'enable_facebook_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'facebook_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_facebook_share_container
		));

		/**
		 * Twitter
		 */
		search_and_go_elated_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'twitter_title',
			'title'		=> 'Share on Twitter'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_twitter_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Twitter',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_twitter_share_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_twitter_share_container = search_and_go_elated_add_admin_container(array(
			'name'		=> 'enable_twitter_share_container',
			'hidden_property'	=> 'enable_twitter_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'twitter_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_twitter_share_container
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'text',
			'name'			=> 'twitter_via',
			'default_value'	=> '',
			'label'			=> 'Via',
			'parent'		=> $enable_twitter_share_container
		));

		/**
		 * Google Plus
		 */
		search_and_go_elated_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'google_plus_title',
			'title'		=> 'Share on Google Plus'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_google_plus_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Google Plus',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_google_plus_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_google_plus_container = search_and_go_elated_add_admin_container(array(
			'name'		=> 'enable_google_plus_container',
			'hidden_property'	=> 'enable_google_plus_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'google_plus_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_google_plus_container
		));

		/**
		 * Linked In
		 */
		search_and_go_elated_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'linkedin_title',
			'title'		=> 'Share on LinkedIn'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_linkedin_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via LinkedIn',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_linkedin_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_linkedin_container = search_and_go_elated_add_admin_container(array(
			'name'		=> 'enable_linkedin_container',
			'hidden_property'	=> 'enable_linkedin_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'linkedin_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_linkedin_container
		));

		/**
		 * Tumblr
		 */
		search_and_go_elated_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'tumblr_title',
			'title'		=> 'Share on Tumblr'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_tumblr_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Tumblr',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_tumblr_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_tumblr_container = search_and_go_elated_add_admin_container(array(
			'name'		=> 'enable_tumblr_container',
			'hidden_property'	=> 'enable_tumblr_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'tumblr_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_tumblr_container
		));

		/**
		 * Pinterest
		 */
		search_and_go_elated_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'pinterest_title',
			'title'		=> 'Share on Pinterest'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_pinterest_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via Pinterest',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_pinterest_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_pinterest_container = search_and_go_elated_add_admin_container(array(
			'name'				=> 'enable_pinterest_container',
			'hidden_property'	=> 'enable_pinterest_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'pinterest_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_pinterest_container
		));

		/**
		 * VK
		 */
		search_and_go_elated_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'vk_title',
			'title'		=> 'Share on VK'
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_vk_share',
			'default_value'	=> 'no',
			'label'			=> 'Enable Share',
			'description'	=> 'Enabling this option will allow sharing via VK',
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#eltd_enable_vk_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_vk_container = search_and_go_elated_add_admin_container(array(
			'name'				=> 'enable_vk_container',
			'hidden_property'	=> 'enable_vk_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		search_and_go_elated_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'vk_icon',
			'default_value'	=> '',
			'label'			=> 'Upload Icon',
			'parent'		=> $enable_vk_container
		));

		if(defined('ELATED_TWITTER_FEED_VERSION')) {
            $twitter_panel = search_and_go_elated_add_admin_panel(array(
                'title' => 'Twitter',
                'name'  => 'panel_twitter',
                'page'  => '_social_page'
            ));

            search_and_go_elated_add_admin_twitter_button(array(
                'name'   => 'twitter_button',
                'parent' => $twitter_panel
            ));
        }

        if(defined('ELATED_INSTAGRAM_FEED_VERSION')) {
            $instagram_panel = search_and_go_elated_add_admin_panel(array(
                'title' => 'Instagram',
                'name'  => 'panel_instagram',
                'page'  => '_social_page'
            ));

            search_and_go_elated_add_admin_instagram_button(array(
                'name'   => 'instagram_button',
                'parent' => $instagram_panel
            ));
        }
	}

	add_action( 'search_and_go_elated_options_map', 'search_and_go_elated_social_options_map', 18);
}