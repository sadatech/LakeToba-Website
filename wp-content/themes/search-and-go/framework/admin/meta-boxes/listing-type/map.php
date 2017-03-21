<?php
if ( ! search_and_go_elated_listing_plugin_installed() ) {
	//exit if listing plugin is not installed
	return;
}
if(!function_exists('search_and_go_elated_map_listing_type_settings')) {
    function search_and_go_elated_map_listing_type_settings() {
		
		$meta_box_listing_type = search_and_go_elated_add_meta_box(array(
            'scope' => 'listing-type-item',
            'title' => 'Listing Type Settings',
            'name'  => 'listing_type_settings_meta_box'
        ));
		
		search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_phone',
            'type'        => 'yesno',
            'label'       => 'Show Phone Field',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));
		
		search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_website',
            'type'        => 'yesno',
            'label'       => 'Show Website Field',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));

	    search_and_go_elated_add_meta_box_field(array(
		    'name'        => 'eltd_listing_type_show_email',
		    'type'        => 'yesno',
		    'label'       => 'Show Email Field',
		    'default_value' => 'yes',
		    'parent'      => $meta_box_listing_type
	    ));
		
		search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_gallery',
            'type'        => 'yesno',
            'label'       => 'Show Gallery Images',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));
		
		search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_video',
            'type'        => 'yesno',
            'label'       => 'Show Video',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));

        search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_audio',
            'type'        => 'yesno',
            'label'       => 'Show Audio',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));
		
		search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_work_hours',
            'type'        => 'yesno',
            'label'       => 'Show Working Hours',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));
		
		search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_social_icons',
            'type'        => 'yesno',
            'label'       => 'Show Social Icons',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));
		search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_type_show_price',
            'type'        => 'yesno',
            'label'       => 'Show Price',
			'default_value' => 'yes',
            'parent'      => $meta_box_listing_type
        ));

	    search_and_go_elated_add_meta_box_field(array(
		    'name'        => 'eltd_listing_type_show_instagram',
		    'type'        => 'yesno',
		    'label'       => 'Show Instagram Profile',
		    'description' => 'Requires Elated Instagram Feed Plugin to be installed',
		    'default_value' => 'yes',
		    'parent'      => $meta_box_listing_type
	    ));

	    search_and_go_elated_add_meta_box_field(array(
		    'name'        => 'eltd_listing_type_show_booking_form',
		    'type'        => 'yesno',
		    'label'       => 'Show Booking Form',
		    'description' => 'Requires Elated Booking Plugin to be installed',
		    'default_value' => 'yes',
		    'parent'      => $meta_box_listing_type
	    ));

	    //init icon pack hide and show array. It will be populated dinamically from collections array
		$listing_type_icon_pack_hide_array = array();
		$listing_type_icon_pack_show_array = array();

		//do we have some collection added in collections array?
		if (is_array(search_and_go_elated_icon_collections()->iconCollections) && count(search_and_go_elated_icon_collections()->iconCollections)) {

			//get collections params array. It will contain values of 'param' property for each collection
			$listing_type_icon_collections_params = search_and_go_elated_icon_collections()->getIconCollectionsParams();

			//foreach collection generate hide and show array
			foreach (search_and_go_elated_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
				$listing_type_icon_pack_hide_array[$dep_collection_key] = '';

				//we need to include only current collection in show string as it is the only one that needs to show
				$listing_type_icon_pack_show_array[$dep_collection_key] = '#eltd_listing_type_icon_' . $dep_collection_object->param . '_container';

				//for all collections param generate hide string
				foreach ($listing_type_icon_collections_params as $listing_icon_collections_param) {
					//we don't need to include current one, because it needs to be shown, not hidden
					if ($listing_icon_collections_param !== $dep_collection_object->param) {
						$listing_type_icon_pack_hide_array[$dep_collection_key] .= '#eltd_listing_type_icon_' . $listing_icon_collections_param . '_container,';
					}
				}

				//remove remaining ',' character
				$listing_type_icon_pack_hide_array[$dep_collection_key] = rtrim($listing_type_icon_pack_hide_array[$dep_collection_key], ',');
			}

		}

		search_and_go_elated_add_meta_box_field(

			array(
				'parent' => $meta_box_listing_type,
				'type' => 'select',
				'name' => 'listing_type_icon_pack',
				'default_value' => 'font_awesome',
				'label' => 'Listing Type Icon Pack',
				'description' => 'Choose icon pack for listing',
				'options' => search_and_go_elated_icon_collections()->getIconCollections(),
				'args' => array(
					'dependence' => true,
					'hide' => $listing_type_icon_pack_hide_array,
					'show' => $listing_type_icon_pack_show_array
				)
			)

		);

		if (is_array(search_and_go_elated_icon_collections()->iconCollections) && count(search_and_go_elated_icon_collections()->iconCollections)) {

			//foreach icon collection we need to generate separate container that will have dependency set
			//it will have one field inside with icons dropdown
			foreach (search_and_go_elated_icon_collections()->iconCollections as $collection_key => $collection_object) {
				$icons_array = $collection_object->getIconsArray();

				//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
				$icon_collections_keys = search_and_go_elated_icon_collections()->getIconCollectionsKeys();

				//unset current one, because it doesn't have to be included in dependency that hides icon container
				unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

				$listing_icon_hide_values = $icon_collections_keys;

				$listing_icon_container = search_and_go_elated_add_admin_container(
					array(
						'parent' => $meta_box_listing_type,
						'name' => 'listing_type_icon_' . $collection_object->param . '_container',
						'hidden_property' => 'listing_type_icon_pack',
						'hidden_value' => '',
						'hidden_values' => $listing_icon_hide_values
					)
				);

				search_and_go_elated_add_meta_box_field(
					array(
						'parent' => $listing_icon_container,
						'type' => 'select',
						'name' => 'listing_type_icon_' . $collection_object->param,
						'default_value' => '',
						'label' => 'Listing Type Icon',
						'description' => 'Choose Listing Type Icon',
						'options' => $icons_array,
					)
				);

			}
		}
		
		search_and_go_elated_add_custom_fields_creator(array(
			'name' => 'listing_custom_fields' , 
			'label' => 'Custom Fields Creator',
			'desciption' => 'Create listing type custom fields',
			'parent' => $meta_box_listing_type
		));
		
		$feature_list_title = search_and_go_elated_add_admin_section_title(
				array(
					'parent' => $meta_box_listing_type,
					'title'  => 'Listing Type Feature List',
					'name'	 => 'listing_type_feature_list_title'
				)
			);
		
		search_and_go_elated_add_repeater_field(array(
                'name' => 'eltd_listing_type_repeater',
                'parent' => $meta_box_listing_type,
                'fields' => array(
                    array(
                        'type' => 'textsimple',
                        'name' => 'eltd_listing_type_feature_list',
                        'label' => '',
                        'description' => '',
                    ),
                )
            )
        );
		
    }

    add_action('search_and_go_elated_meta_boxes_map', 'search_and_go_elated_map_listing_type_settings');
}