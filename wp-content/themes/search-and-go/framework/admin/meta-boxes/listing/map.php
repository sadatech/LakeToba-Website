<?php
if ( ! search_and_go_elated_listing_plugin_installed() ) {
	//exit if listing plugin is not installed
	return;
}
if(!function_exists('search_and_go_elated_map_listing_settings')) {
    function search_and_go_elated_map_listing_settings() {

		$meta_box_listing = search_and_go_elated_add_meta_box(array(
            'scope' => 'listing-item',
            'title' => 'Listing Settings',
            'name'  => 'listing_settings_meta_box'
        ));
		
		search_and_go_elated_add_meta_box_field(
			array(
				'parent' => $meta_box_listing,
				'type' => 'text',
				'name' => 'eltd_listing_subtitle',
				'default_value' => '',
				'label' => 'Listing Subtitle',
				'description' => ''
			)
		);

	    search_and_go_elated_add_meta_box_field(
		    array(
			    'parent' => $meta_box_listing,
			    'type' => 'packagedisabled',
			    'name' => 'eltd_listing_package',
			    'default_value' => '',
			    'label' => 'Listing Package',
			    'description' => ''
		    )
	    );
	    search_and_go_elated_add_meta_box_field(array(
		    'parent'      => $meta_box_listing,
		    'name'        => 'eltd_listing_address',
		    'type'        => 'address',
		    'label'       => 'Address',
		    'description' => 'Find address'
	    ));

	    search_and_go_elated_add_meta_box_field(array(
            'name'        => 'eltd_listing_feature_item',
            'type'        => 'select',
            'label'       => 'Set as Featured Item',
			'default_value' => 'no',
			'options'		 => array(
				'no'=> 'No',
				'yes'=> 'Yes'
			),	
            'description' => 'Set listing item as featured listing feature list shortcode',
            'parent'      => $meta_box_listing
        ));
		search_and_go_elated_add_meta_box_field(
			array(
				'parent' => $meta_box_listing,
				'type' => 'text',
				'name' => 'eltd_listing_feature_order_number',
				'default_value' => '',
				'label' => 'Set listing item order number in feature list shortcode',
				'description' => ''
			)
		);
		
		search_and_go_elated_add_meta_box_field(
			array(
				'parent' => $meta_box_listing,
				'type' => 'select',
				'name' => 'eltd_listing_feature_layout',
				'default_value' => '',
				'label' => 'Set listing item layout in feature list shortcode',
				'description' => '',
				'options'  => array(
					'square'=> 'Square',
					'portrait'=> 'Portrait'
				)
			)
		);
		
		$listing_types = search_and_go_elated_get_listing_types_objects();
		
		$listing_type_show_array = $listing_type_hide_array = array();
		$video_hide_array = $audio_hide_array = $social_icons_hide_array = $work_hours_hide_array = array();
		$phone_hide_array = $website_hide_array = $gallery_hide_array = $price_hide_array = $email_hide_array = $instagram_hide_array = $booking_form_hide_array = array();

		if (is_array($listing_types) && count($listing_types)) {
			
			foreach ($listing_types as $listing_type_obj) {
				
				$listing_type_hide_array[$listing_type_obj->ID] = '';
				
				//generate show array for eltd_listing_item_type field(listing type select field)
				//set current listing type container to be visible
				
				$listing_type_show_array[$listing_type_obj->ID] = '#eltd_listing_type_' . sanitize_title($listing_type_obj->name).$listing_type_obj->ID . '_container,';
				$listing_type_show_array[$listing_type_obj->ID] .= '#eltd_listing_type_feature_list_' . sanitize_title($listing_type_obj->name).$listing_type_obj->ID .'_container,';

				foreach ($listing_types as $list_type) {
					
					if ($list_type->ID !== $listing_type_obj->ID) {
						
						//generate hide array for eltd_listing_item_type field(listing type select field)
						//hide listing type container(except current listing type)
						$listing_type_hide_array[$listing_type_obj->ID] .= '#eltd_listing_type_' . sanitize_title($list_type->name).$list_type->ID . '_container,';
						$listing_type_hide_array[$listing_type_obj->ID] .= '#eltd_listing_type_feature_list_' . sanitize_title($list_type->name).$list_type->ID . '_container,';
					}
					
				}

				
				//check yes/no common fields for each listing type
				
				$common_fields_array = search_and_go_elated_check_predefined_fields($listing_type_obj->ID);
				
				foreach($common_fields_array as $field_key => $field_value){
					
					$field_key_sub = str_replace('eltd_listing_type_show_', '', $field_key); // get cut off predefined field name(remove eltd_listing_type_show_)
					
					
					if(isset($field_value) && $field_value == 'no'){
						
						//generate hide array for eltd_listing_item_type field(listing type select field)
						
						$listing_type_hide_array[$listing_type_obj->ID] .= '#eltd_listing_'. $field_key_sub .'_container,';
						
						//generate hide array for each field on listing 
						
						
						switch($field_key_sub){
							
							case 'phone':
								$phone_hide_array[] = $listing_type_obj->ID;
							break;
						
							case 'website':
								$website_hide_array[] = $listing_type_obj->ID;
							break;

							case 'email':
								$email_hide_array[] = $listing_type_obj->ID;
								break;
						
							case 'gallery':
								$gallery_hide_array[] = $listing_type_obj->ID;
							break;
						
							case 'video':
								$video_hide_array[] = $listing_type_obj->ID;
							break;
						
							case 'audio':
								$audio_hide_array[] = $listing_type_obj->ID;
							break;
						
							case 'work_hours':
								$work_hours_hide_array[] = $listing_type_obj->ID;
							break;
						
							case 'social_icons':
								$social_icons_hide_array[] = $listing_type_obj->ID;
							break;

							case 'instagram':
								$instagram_hide_array[] = $listing_type_obj->ID;
								break;
							case 'booking_form':
								$booking_form_hide_array[] = $listing_type_obj->ID;
								break;
							case 'price':
								$price_hide_array[] = $listing_type_obj->ID;
								break;
						
						}
						
					}
					
					else{
						//generate show array for eltd_listing_item_type field(listing type select field)
						$listing_type_show_array[$listing_type_obj->ID] .=  '#eltd_listing_'. $field_key_sub .'_container,';
						
					}	
					
				}	
				
				$listing_type_hide_array[$listing_type_obj->ID] = rtrim($listing_type_hide_array[$listing_type_obj->ID], ',');
				$listing_type_show_array[$listing_type_obj->ID] = rtrim($listing_type_show_array[$listing_type_obj->ID], ',');				
			}

			
		}
	
		if (is_array($listing_types) && count($listing_types)) {
			
			search_and_go_elated_add_meta_box_field(array(
			
				'name'        => 'eltd_listing_item_type',
				'type'        => 'select',
				'label'       => 'Listing Type',
				'description' => 'Choose a default type for Single Listing pages',
				'default_value' => $listing_types[0]->ID,
				'parent'      => $meta_box_listing,
				'options'     => search_and_go_elated_get_listing_types(),
				'args' => array(
					'dependence' => true,
					'hide' => $listing_type_hide_array,
					'show' => $listing_type_show_array
				)

			));

			//generate listing phone field if is enabled for choosen listing type
			$phone_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_phone_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $phone_hide_array
				)
			);

				search_and_go_elated_add_meta_box_field(
					array(
						'parent' => $phone_container,
						'type' => 'text',
						'name' => 'eltd_listing_phone',
						'default_value' => '',
						'label' => 'Listing Phone',
						'description' => ''
					)
				);

			//generate listing website field if is enabled for choosen listing type
			$website_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_website_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $website_hide_array
				)
			);

				search_and_go_elated_add_meta_box_field(
					array(
						'parent' => $website_container,
						'type' => 'text',
						'name' => 'eltd_listing_website',
						'default_value' => '',
						'label' => 'Listing Website',
						'description' => ''
					)			
				);

			//generate listing email field if is enabled for choosen listing type
			$email_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_email_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $email_hide_array
				)
			);

			search_and_go_elated_add_meta_box_field(
				array(
					'parent' => $email_container,
					'type' => 'text',
					'name' => 'eltd_listing_email',
					'default_value' => '',
					'label' => 'Listing Email',
					'description' => ''
				)
			);

			//generate listing gallery field if is enabled for choosen listing type	
			$gallery_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_gallery_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $gallery_hide_array
				)
			);


				search_and_go_elated_add_multiple_images_field(
					array(
						'parent'      => $gallery_container,
						'name'        => 'eltd_listing_gallery_images_meta',
						'label'       => 'Gallery Images',
						'description' => 'Choose your gallery images'				
					)
				);


			//generate listing video field if is enabled for choosen listing type
			$video_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_video_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $video_hide_array
				)
			);

				search_and_go_elated_add_meta_box_field(
					array(
						'parent' => $video_container,
						'type' => 'text',
						'name' => 'eltd_listing_video',
						'default_value' => '',
						'label' => 'Video File URL',
						'description' => 'Enter Youtube ot Vimeo URL address'
					)
				);


			//generate listing audio field if is enabled for choosen listing type
			$audio_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_audio_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $audio_hide_array
				)
			);
				search_and_go_elated_add_meta_box_field(

					array(
						'parent' => $audio_container,
						'type' => 'text',
						'name' => 'eltd_listing_audio',
						'default_value' => '',
						'label' => 'Audio File URL',
						'description' => 'Enter Audio File'
					)
				);
				
			//generate listing price field if is enabled for choosen listing type
			$price_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_price_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $price_hide_array
				)
			);
				search_and_go_elated_add_meta_box_field(

					array(
						'parent' => $price_container,
						'type' => 'text',
						'name' => 'eltd_listing_price',
						'default_value' => '',
						'label' => 'Price',
						'description' => 'Enter Price'
					)
				);

			$instagram_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_instagram_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $instagram_hide_array
				)
			);
			search_and_go_elated_add_meta_box_field(

				array(
					'parent' => $instagram_container,
					'type' => 'text',
					'name' => 'eltd_listing_instagram_username',
					'default_value' => '',
					'label' => 'Instagram Username',
					'description' => ''
				)
			);

			$booking_form_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_booking_form_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $booking_form_hide_array
				)
			);
			search_and_go_elated_add_meta_box_field(

				array(
					'parent' => $booking_form_container,
					'type' => 'text',
					'name' => 'eltd_listing_open_table_id',
					'default_value' => '',
					'label' => 'Open Table ID',
					'description' => 'Insert Open Table ID of place for booking'
				)
			);

			//generate listing opening hours field if is enabled for choosen listing type	
			$work_hours_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_work_hours_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $work_hours_hide_array
				)
			);	

				$work_hours_title = search_and_go_elated_add_admin_section_title(
					array(
						'parent' => $work_hours_container,
						'title'  => 'Listing Opening Hours',
						'name'	 => 'listing_opening_hours_title'
					)
				);



				search_and_go_elated_add_meta_box_field(
					array(
						'parent' => $work_hours_container,
						'type' => 'textarea',
						'name' => 'eltd_listing_open_hours',
						'default_value' => '',
						'label' => 'Open Hours',
						'description' => ''
					)
				);



			//generate listing social icons field if is enabled for choosen listing type
			$social_icons_container = search_and_go_elated_add_admin_container_no_style(
				array(
					'parent' => $meta_box_listing,
					'name' => 'listing_social_icons_container',
					'hidden_property' => 'eltd_listing_item_type',
					'hidden_value' => '',
					'hidden_values' => $social_icons_hide_array
				)
			);

				$social_icons_title = search_and_go_elated_add_admin_section_title(
					array(
						'parent' => $social_icons_container,
						'title'  => 'Listing Social Icons',
						'name'	 => 'listing_social_icons_title'
					)
				);

				$social_network_array = search_and_go_elated_generate_listing_social_icons_array();

				foreach($social_network_array as $network_key => $network_value){

					search_and_go_elated_add_meta_box_field(
						array(
							'parent' => $social_icons_container,
							'type' => 'text',
							'name' => 'eltd_listing_social_'.$network_key,
							'default_value' => '',
							'label' => $network_value,
							'description' => ''
						)			
					);

				}

			// render custom fields which are specfic for each listing type
			if (is_array($listing_types) && count($listing_types)) {

				foreach ($listing_types as $listing_type){

					$listing_type_hide_values = array();

					foreach($listing_types as $list_type){

						if($list_type->ID !== $listing_type->ID){

							$listing_type_hide_values[] = $list_type->ID;

						}

					}

					// check custom fields and render container with fields if custom fields are created
					$list_type_custom_fields = get_post_meta($listing_type->ID, 'eltd_listing_type_custom_fields' , true);

					if((is_array($list_type_custom_fields) && count($list_type_custom_fields))){

						$listing_type_custom_container = search_and_go_elated_add_admin_container_no_style(
							array(
								'parent' => $meta_box_listing,
								'name' => 'listing_type_' . sanitize_title($listing_type->name).$listing_type->ID . '_container',
								'hidden_property' => 'eltd_listing_item_type',
								'hidden_value' => '',
								'hidden_values' => $listing_type_hide_values
							)
						);
						$custom_fields_title = search_and_go_elated_add_admin_section_title(
							array(
								'parent' => $listing_type_custom_container,
								'title'  => 'Listing Type Specific Fields ',
								'name'	 => 'listing_type_custom_fields_title'
							)
						);

						foreach ($list_type_custom_fields as $custom_field){

							$field_params = search_and_go_elated_set_field_params($custom_field);

							if(isset($field_params['options'])){
								$options = $field_params['options'];
							}
							else{
								$options = array();
							}
							if(isset($field_params['default_value'])){
								$default_value = $field_params['default_value'];
							}else{
								$default_value = '';
							}

							search_and_go_elated_add_meta_box_field(

								array(
									'type'         => $field_params['type'],
									'name'         => $field_params['meta_key'],
									'default_value'    => $default_value,									
									'label'           => $field_params['title'],									
									'options'         => $options,									
									'parent'           => $listing_type_custom_container		
								)

							);
						}
					}

					// check listing type feature list and render container with checkboxes if feature list is created				
					$list_type_feature_list = get_post_meta($listing_type->ID, 'eltd_listing_type_feature_list' , true);
					
					if(is_array($list_type_feature_list) && count($list_type_feature_list)){
						
						if($list_type_feature_list[0] != ''){ // this need to be done because empty value is always saved in database when field is empty
							
							$listing_type_feature_list_container = search_and_go_elated_add_admin_container_no_style(
								array(
									'parent' => $meta_box_listing,
									'name' => 'listing_type_feature_list_' . sanitize_title($listing_type->name).$listing_type->ID .'_container',
									'hidden_property' => 'eltd_listing_item_type',
									'hidden_value' => '',
									'hidden_values' => $listing_type_hide_values
								)
							);

							$featured_list_title = search_and_go_elated_add_admin_section_title(
								array(
									'parent' => $listing_type_feature_list_container,
									'title'  => 'Listing Type Feature List',
									'name'	 => 'listing_type_feature_list_title'
								)
							);
							
							foreach( $list_type_feature_list as $feature_value){
							
							if($feature_value != ''){
								
									search_and_go_elated_add_meta_box_field(

										array(
											'type'         => 'checkbox',
											'name'         => 'listing_feature_list_'.$listing_type->ID.'_'.sanitize_title($feature_value),
											'default_value'    => '',									
											'label'           => $feature_value,									
											'parent'           => $listing_type_feature_list_container		
										)

									);
								}

							}
						}

					}

				}
			}	
		}
		

	}	

    add_action('search_and_go_elated_meta_boxes_map', 'search_and_go_elated_map_listing_settings');
}