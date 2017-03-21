<?php
if ( ! search_and_go_elated_listing_plugin_installed() ) {
    //exit if listing plugin is not installed
    return;
}
if(!function_exists('search_and_go_elated_map_listing_package_settings')) {
    function search_and_go_elated_map_listing_package_settings() {

        $meta_box_listing_package = search_and_go_elated_add_meta_box(array(
            'scope' => 'listing-package',
            'title' => 'Listing Package Settings',
            'name'  => 'listing_package_settings_meta_box'
        ));

        search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_package_type',
            'type'        => 'select',
            'options'     => array(
                'free'  => 'Free',
                'paid'  => 'Paid'
            ),
            'label'     => 'Package Type',
            'parent'      => $meta_box_listing_package,
            'args'      => array(
                'dependence'    => true,
                "hide" => array(
                    "free" => "#eltd_package_price_container",
                    "paid" => ""
                ),
                "show" => array(
                    "free" => "",
                    "paid" => "#eltd_package_price_container"
                )
            )
        ));

        $package_price_container = search_and_go_elated_add_admin_container(
            array(
                'parent' => $meta_box_listing_package,
                'name' => 'package_price_container',
                'hidden_property' => 'eltd_listing_package_type',
                'hidden_values' => array('free')
            )
        );

        search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_package_price',
            'type'        => 'text',
            'label'       => 'Price',
            'parent'      => $package_price_container
        ));

        search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_package_discount_price',
            'type'        => 'text',
            'label'       => 'Discount Price',
            'parent'      => $package_price_container
        ));

        search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_package_count',
            'type'        => 'text',
            'label'       => 'Number of Listings',
            'parent'      => $meta_box_listing_package
        ));

        search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_package_availability',
            'type'        => 'text',
            'label'       => 'Availability of Listings (in days)',
            'parent'      => $meta_box_listing_package
        ));

        //init icon pack hide and show array. It will be populated dinamically from collections array
        $listing_package_icon_pack_hide_array = array();
        $listing_package_icon_pack_show_array = array();

        //do we have some collection added in collections array?
        if (is_array(search_and_go_elated_icon_collections()->iconCollections) && count(search_and_go_elated_icon_collections()->iconCollections)) {

            //get collections params array. It will contain values of 'param' property for each collection
            $listing_package_icon_collections_params = search_and_go_elated_icon_collections()->getIconCollectionsParams();

            //foreach collection generate hide and show array
            foreach (search_and_go_elated_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
                $listing_package_icon_pack_hide_array[$dep_collection_key] = '';

                //we need to include only current collection in show string as it is the only one that needs to show
                $listing_package_icon_pack_show_array[$dep_collection_key] = '#eltd_listing_package_icon_' . $dep_collection_object->param . '_container';

                //for all collections param generate hide string
                foreach ($listing_package_icon_collections_params as $listing_icon_collections_param) {
                    //we don't need to include current one, because it needs to be shown, not hidden
                    if ($listing_icon_collections_param !== $dep_collection_object->param) {
                        $listing_package_icon_pack_hide_array[$dep_collection_key] .= '#eltd_listing_package_icon_' . $listing_icon_collections_param . '_container,';
                    }
                }

                //remove remaining ',' character
                $listing_package_icon_pack_hide_array[$dep_collection_key] = rtrim($listing_package_icon_pack_hide_array[$dep_collection_key], ',');
            }

        }

        search_and_go_elated_add_meta_box_field(

            array(
                'parent' => $meta_box_listing_package,
                'type' => 'select',
                'name' => 'listing_package_icon_pack',
                'default_value' => 'font_awesome',
                'label' => 'Listing Type Icon Pack',
                'description' => 'Choose icon pack for listing',
                'options' => search_and_go_elated_icon_collections()->getIconCollections(),
                'args' => array(
                    'dependence' => true,
                    'hide' => $listing_package_icon_pack_hide_array,
                    'show' => $listing_package_icon_pack_show_array
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
                        'parent' => $meta_box_listing_package,
                        'name' => 'listing_package_icon_' . $collection_object->param . '_container',
                        'hidden_property' => 'listing_package_icon_pack',
                        'hidden_value' => '',
                        'hidden_values' => $listing_icon_hide_values
                    )
                );

                search_and_go_elated_add_meta_box_field(
                    array(
                        'parent' => $listing_icon_container,
                        'type' => 'select',
                        'name' => 'listing_package_icon_' . $collection_object->param,
                        'default_value' => '',
                        'label' => 'Listing Package Icon',
                        'description' => 'Choose Listing Package Icon',
                        'options' => $icons_array,
                    )
                );

            }
        }

    }

    add_action('search_and_go_elated_meta_boxes_map', 'search_and_go_elated_map_listing_package_settings');
}