<?php

if ( ! function_exists('search_and_go_elated_listing_options_map') ) {

	function search_and_go_elated_listing_options_map() {

		search_and_go_elated_add_admin_page( array(
			'slug'  => '_listing',
			'title' => 'Listing',
			'icon'  => 'fa fa-camera-retro'
		) );

		$panel_archive = search_and_go_elated_add_admin_panel( array(
			'title' => 'Archive',
			'name'  => 'panel_archive',
			'page'  => '_listing'
		) );

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_archive,
				'type'			=> 'text',
				'name'			=> 'listing_item_single_slug',
				'default_value'	=> '',
				'label'			=> 'Listing Single Slug',
				'description'   => 'Enter if you wish to use a different Single Listing slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)',
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_archive,
				'type'			=> 'text',
				'name'			=> 'listings_per_page',
				'default_value'	=> '',
				'label'			=> 'Number of listings per page',
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		$panel_listing_item = search_and_go_elated_add_admin_panel( array(
			'title' => 'Listing Item',
			'name'  => 'panel_listing_item',
			'page'  => '_listing'
		) );

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_listing_item,
				'type'			=> 'yesno',
				'name'			=> 'enable_listing_item_rating',
				'default_value'	=> 'yes',
				'label'			=> 'Enable Listing Item Rating',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_listing_item,
				'type'			=> 'yesno',
				'name'			=> 'enable_listing_item_comments',
				'default_value'	=> 'yes',
				'label'			=> 'Enable Listing Item Comments',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_listing_item,
				'type'			=> 'yesno',
				'name'			=> 'enable_listing_item_map',
				'default_value'	=> 'yes',
				'label'			=> 'Enable Listing Item Map',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_listing_item,
				'type'			=> 'yesno',
				'name'			=> 'enable_listing_item_related_listings',
				'default_value'	=> 'yes',
				'label'			=> 'Enable Listing Item Related Listings',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_listing_item,
				'type'			=> 'yesno',
				'name'			=> 'enable_listing_item_enquiry',
				'default_value'	=> 'yes',
				'label'			=> 'Enable Listing Item Enquiry',
				'args'			=> array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_enable_listing_item_enquiry_container'
				),
			)
		);

		$enable_listing_item_enquiry_container = search_and_go_elated_add_admin_container(
			array(
				'parent'        => $panel_listing_item,
				'name'          => 'enable_listing_item_enquiry_container',
				'hidden_property'	=> 'enable_listing_item_enquiry',
				'hidden_value'		=> 'no',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'        => $enable_listing_item_enquiry_container,
				'type'          => 'yesno',
				'name'          => 'listing_item_enquiry_send_to_admin',
				'default_value' => 'yes',
				'label'         => 'Send Enquiries to Site Admin',
				'description'   => 'Site Admin is added in BCC of enquiry mail'
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'        => $enable_listing_item_enquiry_container,
				'type'          => 'yesno',
				'name'          => 'listing_item_enquiry_send_to_author',
				'default_value' => 'yes',
				'label'         => 'Send Enquiries to Listing Item Author',
				'description'   => 'Listing Item Author is added in BCC of enquiry mail'
			)
		);

		$panel_maps = search_and_go_elated_add_admin_panel( array(
			'title' => 'Maps',
			'name'  => 'panel_maps',
			'page'  => '_listing'
		) );

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'textarea',
				'name'			=> 'listing_map_style',
				'default_value'	=> '',
				'label'			=> 'Maps Style',
				'description'	=> 'Insert map style json',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_scrollable',
				'default_value'	=> 'yes',
				'label'			=> 'Scrollable Maps',
				'description'	=> '',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_draggable',
				'default_value'	=> 'yes',
				'label'			=> 'Draggable Maps',
				'description'	=> '',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_street_view_control',
				'default_value'	=> 'yes',
				'label'			=> 'Maps Street View Controls',
				'description'	=> '',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_zoom_control',
				'default_value'	=> 'yes',
				'label'			=> 'Maps Zoom Control',
				'description'	=> '',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'listing_maps_type_control',
				'default_value'	=> 'yes',
				'label'			=> 'Maps Type Control',
				'description'	=> '',
			)
		);

        $panel_payments = search_and_go_elated_add_admin_panel( array(
            'title' => 'Payments',
            'name'  => 'panel_payments',
            'page'  => '_listing'
        ) );

        search_and_go_elated_add_admin_section_title(
            array(
                'parent' => $panel_payments,
                'name' => 'paypal_payment',
                'title' => 'PayPal'
            )
        );

        search_and_go_elated_add_admin_field(
            array(
                'name' => 'paypal_receiver_id',
                'type' => 'text',
                'default_value' => '',
                'label' => 'Account ID',
                'description' => '',
                'parent' => $panel_payments
            )
        );

		search_and_go_elated_add_admin_field(
            array(
                'name' => 'paypal_currency',
                'type' => 'select',
                'default_value' => 'USD',
                'label' => 'Currency',
                'parent' => $panel_payments,
                'options' => array(
                    'USD' => 'U.S. Dollar',
                    'EUR' => 'Euro',
                    'GBP' => 'Pound Sterling',
                    'AUD' => 'Australian Dollar',
                    'CHF' => 'Swiss Franc',
                    'BRL' => 'Brazilian Real ',
                    'CAD' => 'Canadian Dollar',
                    'CZK' => 'Czech Koruna',
                    'DKK' => 'Danish Krone',
                    'HKD' => 'Hong Kong Dollar',
                    'HUF' => 'Hungarian Forint ',
                    'ILS' => 'Israeli New Sheqel',
                    'JPY' => 'Japanese Yen',
                    'MYR' => 'Malaysian Ringgit',
                    'MXN' => 'Mexican Peso',
                    'NOK' => 'Norwegian Krone',
                    'NZD' => 'New Zealand Dollar',
                    'PHP' => 'Philippine Peso',
                    'PLN' => 'Polish Zloty',
                    'SGD' => 'Singapore Dollar',
                    'SEK' => 'Swedish Krona',
                    'TWD' => 'Taiwan New Dollar',
                    'THB' => 'Thai Baht',
                    'TRY' => 'Turkish Lira'
                )
            )
        );
		
		$panel_dashboard = search_and_go_elated_add_admin_panel( array(
            'title' => 'Dashboard',
            'name'  => 'panel_dasboard',
            'page'  => '_listing'
        ) );
		
		search_and_go_elated_add_admin_section_title(
            array(
                'parent' => $panel_dashboard,
                'name' => 'dahboard_title',
                'title' => 'Listing Dasboard'
            )
        );
		
		search_and_go_elated_add_admin_field(
            array(
                'name' => 'dashboard_login_text',
                'type' => 'text',
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam',
                'label' => 'Dashboard Login Text',
                'description' => 'Set description for Login page',
                'parent' => $panel_dashboard
            )
		);	

        search_and_go_elated_add_admin_field(
            array(
                'name' => 'dashboard_profile_text',
                'type' => 'text',
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam',
                'label' => 'My Profile Text',
                'description' => 'Set description for "My Profile" page',
                'parent' => $panel_dashboard
            )
		);	
		search_and_go_elated_add_admin_field(
			array(
                'name' => 'dasboard_edit_profile_text',
                'type' => 'text',
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam',
                'label' => 'Edit Profile Text',
                'description' => 'Set description for "Edit Profile" page',
                'parent' => $panel_dashboard
            )
		);
		search_and_go_elated_add_admin_field(
			array(
                'name' => 'dasboard_new_listing_text',
                'type' => 'text',
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam',
                'label' => 'Submit New Listing Text',
                'description' => 'Set description for "Submit New Listing" page',
                'parent' => $panel_dashboard
            )
		);
			
	
		search_and_go_elated_add_admin_field(
			array(
                'name' => 'dasboard_edit_listing_text',
                'type' => 'text',
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam',
                'label' => 'Edit Listing Text',
                'description' => 'Set description for "Edit Listing" page',
                'parent' => $panel_dashboard
            )
		);			
			
		
		search_and_go_elated_add_admin_field(
			array(
                'name' => 'dasboard_listings_text',
                'type' => 'text',
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam',
                'label' => 'My Listings Text',
                'description' => 'Set description for "My Listings" page',
                'parent' => $panel_dashboard
            )
		);		
			
		
		search_and_go_elated_add_admin_field(
			array(
                'name' => 'dasboard_wishlist_text',
                'type' => 'text',
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam',
                'label' => 'My Wishlist Text',
                'description' => 'Set description for "My Wishlist" page',
                'parent' => $panel_dashboard
            )
		);		
			

	}

	add_action( 'search_and_go_elated_options_map', 'search_and_go_elated_listing_options_map', 13);

}