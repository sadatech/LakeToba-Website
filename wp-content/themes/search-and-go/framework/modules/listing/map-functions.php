<?php

if ( ! function_exists( 'search_and_go_elated_set_global_map_variables' ) ) {
	/**
	 * Function for setting global map variables
	 */
	function search_and_go_elated_set_global_map_variables() {
		$global_map_variables = array();

		$global_map_variables['mapStyle'] = json_decode( search_and_go_elated_options()->getOptionValue('listing_map_style') );
		$global_map_variables['scrollable'] = search_and_go_elated_options()->getOptionValue('listing_maps_scrollable') == 'yes' ? true : false;
		$global_map_variables['draggable'] = search_and_go_elated_options()->getOptionValue('listing_maps_draggable') == 'yes' ? true : false;
		$global_map_variables['streetViewControl'] = search_and_go_elated_options()->getOptionValue('listing_maps_street_view_control') == 'yes' ? true : false;
		$global_map_variables['zoomControl'] = search_and_go_elated_options()->getOptionValue('listing_maps_zoom_control') == 'yes' ? true : false;
		$global_map_variables['mapTypeControl'] = search_and_go_elated_options()->getOptionValue('listing_maps_type_control') == 'yes' ? true : false;

		$global_map_variables = apply_filters('search_and_go_elated_global_map_variables', $global_map_variables);

		wp_localize_script('search_and_go_elated_modules', 'eltdMapsVars', array(
			'global' => $global_map_variables
		));
	}

	add_action('wp_enqueue_scripts', 'search_and_go_elated_set_global_map_variables');

}

if( ! function_exists( 'search_and_go_elated_set_single_map_variables' ) ) {
	/**
	 * Function for setting single map variables
	 */
	function search_and_go_elated_set_single_map_variables() {

		$single_map_variables = array();
		if ( is_singular('listing-item') ) {
			//Get item id
			$listing_item_id = get_the_ID();
			$image_id = get_post_thumbnail_id( $listing_item_id );
			$image = wp_get_attachment_image_src( $image_id );

			//Get item type
			$listing_type_id = get_post_meta($listing_item_id, 'eltd_listing_item_type', true);
			
			
			$marker_pin_icon = '';

			$categories = wp_get_post_terms($listing_item_id, 'listing-item-category');
			
			if(is_array($categories) && count($categories)){
				
				$marker_pin_icon_pack = get_term_meta( $categories[0]->term_id, 'icon_pack', true );
				$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
				$marker_pin_icon = get_term_meta( $categories[0]->term_id, $param, true );
				
			}
			
			if ( $marker_pin_icon == '' && $listing_type_id !== '') {
				$marker_pin_icon_pack = get_post_meta( $listing_type_id, 'listing_type_icon_pack', true );
				$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
				$marker_pin_icon = get_post_meta( $listing_type_id, 'listing_type_icon_' . $param, true );			    
			}
			
			$marker_pin = '';
			if($marker_pin_icon !== ''){
				$marker_pin = search_and_go_elated_icon_collections()->renderIcon( $marker_pin_icon, $marker_pin_icon_pack );
			}
			

			//Get item location
			$single_map_variables['location'] = array(
				'address' => get_post_meta( $listing_item_id, 'eltd_listing_address', true ),
				'latitude' => get_post_meta($listing_item_id, 'eltd_listing_address_latitude', true),
				'longitude' => get_post_meta($listing_item_id, 'eltd_listing_address_longitude', true)
			);
			//Get item title
			$single_map_variables['title'] = get_the_title();

			$listing_item_type_name = $listing_type_id !== '' ? get_post($listing_type_id)->post_name : null;
			$single_map_variables['listingType'] = $listing_item_type_name;
			//Get item marker pin
			$single_map_variables['markerPin'] = $marker_pin;
			$single_map_variables['featuredImage'] = $image;
			$single_map_variables['itemUrl'] = get_the_permalink();
		}

		$single_map_variables = apply_filters('search_and_go_elated_single_map_variables', $single_map_variables);

		wp_localize_script('search_and_go_elated_modules', 'eltdSingleMapVars', array(
			'single' => $single_map_variables
		));

	}

	add_action('wp_enqueue_scripts', 'search_and_go_elated_set_single_map_variables');
}

if(!function_exists('search_and_go_elated_set_multiple_map_variables')) {
	/**
	 * Function for setting multiple map variables
	 */
	function search_and_go_elated_set_multiple_map_variables() {

		$multiple_map_variables = array();

		if ( is_post_type_archive( 'listing-item' ) || is_tax( 'listing-item-category' ) || is_tax( 'listing-item-tag' ) ) {

			$multiple_map_variables['addresses'] = search_and_go_elated_get_map_items();

		}

		$multiple_map_variables = apply_filters('search_and_go_elated_multiple_map_variables', $multiple_map_variables);

		wp_localize_script('search_and_go_elated_modules', 'eltdMultipleMapVars', array(
			'multiple' => $multiple_map_variables
		));

	}

	add_action('wp_enqueue_scripts', 'search_and_go_elated_set_multiple_map_variables');
}

if ( ! function_exists( 'search_and_go_elated_get_listing_item_map' ) ) {
	/**
	 * Function that renders map holder for single listing item
	 *
	 * @return string
	 */
	function search_and_go_elated_get_listing_item_map() {

		$id = get_the_ID();
		$latitude = get_post_meta( $id, 'eltd_listing_address_latitude', true );
		$longitude = get_post_meta( $id, 'eltd_listing_address_longitude', true );


		$html = '<div id="eltd-listing-single-map"></div>
				<meta itemprop="latitude" content="'. $latitude .'">
				<meta itemprop="longitude" content="'. $longitude .'">';

		do_action('search_and_go_elated_after_listing_map');

		return $html;

	}

}

if ( ! function_exists( 'search_and_go_elated_get_listing_multiple_map' ) ) {
	/**
	 * Function that renders map holder for multiple listing item
	 *
	 * @return string
	 */
	function search_and_go_elated_get_listing_multiple_map() {

		$html = '<div id="eltd-listing-multiple-map-holder"></div>';

		do_action('search_and_go_elated_after_listing_map');

		return $html;

	}

}

if ( ! function_exists( 'search_and_go_elated_listing_marker_info_template' ) ) {
	/**
	 * Template with placeholders for marker info window
	 *
	 * uses underscore templates
	 *
	 */
	function search_and_go_elated_listing_marker_info_template() {

		$html = '<script type="text/template" class="eltd-info-window-template">
				<div class="eltd-info-window">
					<div class="eltd-info-window-inner">
						<a href="<%= itemUrl %>"></a>
						<div class="eltd-info-window-details">
							<h5>
								<%= title %>
							</h5>
							<p><%= address %></p>
						</div>
						<% if ( featuredImage ) { %>
							<div class="eltd-info-window-image">
								<img src="<%= featuredImage[0] %>" alt="<%= title %>" width="<%= featuredImage[1] %>" height="<%= featuredImage[2] %>">
							</div>
						<% } %>
					</div>
				</div>
			</script>';

		print $html;

	}

	add_action('search_and_go_elated_after_listing_map', 'search_and_go_elated_listing_marker_info_template');

}

if ( ! function_exists( 'search_and_go_elated_listing_marker_template' ) ) {
	/**
	 * Template with placeholders for marker
	 */
	function search_and_go_elated_listing_marker_template() {

		$html = '<script type="text/template" class="eltd-marker-template">
				<div class="eltd-map-marker">
					<div class="eltd-map-marker-inner">
					<%= pin %>
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		                    width="56px" height="67.316px" viewBox="0 0 56 67.316" enable-background="new 0 0 56 67.316" xml:space="preserve">
						<path fill="#1CB5C1" d="M55.939,27.722c-0.054-7.367-2.957-14.287-8.176-19.494c-5.27-5.26-12.28-8.161-19.736-8.157
							c-7.456-0.004-14.47,2.895-19.743,8.157c-5.267,5.255-8.172,12.255-8.171,19.697C0.113,35.363,3.018,42.359,8.29,47.62
							l19.738,19.696l19.513-19.472l0.08-0.078c0.05-0.051,0.098-0.099,0.143-0.143c0.052-0.053,0.099-0.099,0.146-0.147l0.074-0.071
							L49,46.305C53.535,41.163,55.997,34.617,55.939,27.722z"/>
						</svg>
					</div>
				</div>
			</script>';

		print $html;

	}

	add_action('search_and_go_elated_after_listing_map', 'search_and_go_elated_listing_marker_template');

}

if ( ! function_exists( 'search_and_go_elated_listing_map_filter' ) ) {
	/**
	 * Function that renders map filter
	 */
	function search_and_go_elated_listing_map_filter() {

		if ( ! is_single() ) {

			$types = get_posts(array(
				'post_type' => 'listing-type-item',
				'posts_per_page' => '-1'
			));

			$html = '';

			$html .= '<div class="eltd-map-filter-holder">';
			$html .= '<input type="hidden" name="s"><input type="hidden" name="type" value="listing-item">';

			if ( $types ) {

				$html .= '<select id="listing-type-select" name="listingType">';
				$html .= '<option value="">All Types</option>';
				foreach ( $types as $type ) {
					$html .= '<option value="' . $type->ID . '">' . apply_filters( 'get_the_title', $type->post_title ) . '</option>';
				}
				$html .= '</select>';

			}

			$tax = 'listing-item-category';
			$terms = get_terms($tax);

			if ( $terms ) {

				$html .= '<select id="listing-category-select" name="listingCategory">';
				$html .= '<option value="">All Categories</option>';
				foreach ( $terms as $term ) {
					$html .= '<option value="' . $term->term_id . '">' . apply_filters( 'get_the_title', $term->name ) . '</option>';
				}
				$html .= '</select>';

			}

			$tax = 'listing-item-location';
			$terms = get_terms($tax);

			if ( $terms ) {

				$html .= '<select id="listing-location-select" name="listingLocation">';
				$html .= '<option value="">All Locations</option>';
				foreach ( $terms as $term ) {
					$html .= '<option value="' . $term->term_id . '">' . apply_filters( 'get_the_title', $term->name ) . '</option>';
				}
				$html .= '</select>';

			}

			$html .= '</div>';

			print $html;

		}

	}

//	add_action('search_and_go_elated_after_listing_map', 'search_and_go_elated_listing_map_filter');
	add_action('search_and_go_elated_advanced_search_form', 'search_and_go_elated_listing_map_filter');

}


if ( ! function_exists( 'search_and_go_elated_filter_listing_items' ) ) {
	/**
	 * Function for filtering listing items
	 */
	function search_and_go_elated_filter_listing_items() {


		$params = array();

		$params['type'] = isset($_POST['listingType']) ? $_POST['listingType'] : null;
		$params['category'] = isset($_POST['listingCategory']) ? $_POST['listingCategory'] : null;
		$params['location'] = isset($_POST['listingLocation']) ? $_POST['listingLocation'] : null;

		$mapData = search_and_go_elated_query_map_items( $params );
		$cotnentData = search_and_go_elated_query_listing_items( $params );

		$cotnent = search_and_go_elated_get_cotnent_after_map_refresh( $cotnentData );

		$data = array(
			'mapData' => $mapData,
			'contentData' => $cotnent
		);

		echo json_encode($data);
		wp_die();
	}

	add_action('wp_ajax_search_and_go_elated_filter_listing_items', 'search_and_go_elated_filter_listing_items');
	add_action('wp_ajax_nopriv_search_and_go_elated_filter_listing_items', 'search_and_go_elated_filter_listing_items');

}

if ( ! function_exists( 'search_and_go_elated_get_map_items' ) ) {
	/**
	 * Function for getting listing items on archive pages from current query
	 *
	 * @return array
	 */
	function search_and_go_elated_get_map_items() {
		$items = array();

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				$item_id = get_the_ID();
				$image_id = get_post_thumbnail_id( $item_id );
				$image = wp_get_attachment_image_src( $image_id );

				//Get item type
				$item_type_id = get_post_meta($item_id, 'eltd_listing_item_type', true);
				
				$marker_pin_icon = '';
				$categories = wp_get_post_terms($item_id, 'listing-item-category');
				
				
				if(is_array($categories) && count($categories)){
					
					$marker_pin_icon_pack = get_term_meta( $categories[0]->term_id, 'icon_pack', true );
					$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
					$marker_pin_icon = get_term_meta( $categories[0]->term_id, $param, true );
					
				}
				

				if ( $marker_pin_icon == '' && $item_type_id !== '') {
					
					$marker_pin_icon_pack = get_post_meta( $item_type_id, 'listing_type_icon_pack', true );
					$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
					$marker_pin_icon = get_post_meta( $item_type_id, 'listing_type_icon_' . $param, true );
					
				}
				
				$marker_pin = '';
				if($marker_pin_icon !== ''){
					$marker_pin = search_and_go_elated_icon_collections()->renderIcon( $marker_pin_icon, $marker_pin_icon_pack );
				}				
			
				
				//Get item location, title and type
				$item = array(
					'location' => array(
						'address' => get_post_meta( $item_id, 'eltd_listing_address', true ),
						'latitude' => get_post_meta( $item_id, 'eltd_listing_address_latitude', true ),
						'longitude' => get_post_meta( $item_id, 'eltd_listing_address_longitude', true )
					),
					'title' => get_the_title($item_id),
					'listingType' => $item_type_id,
					'markerPin' => $marker_pin,
					'featuredImage' => $image,
					'itemUrl' => get_the_permalink()
				);

				$items[] = $item;

			}
		}
		return $items;

	}

}

if ( ! function_exists( 'search_and_go_elated_query_map_items' ) ) {
	/**
	 * Function for getting listing items (used in search)
	 *
	 * @param array $params
	 *
	 * @return array
	 */
	function search_and_go_elated_query_map_items( $params = array() ) {

		$items = array();

		$posts_per_page = get_option('posts_per_page');
		if(search_and_go_elated_options()->getOptionValue('listings_per_page') !== ''){
			$posts_per_page = search_and_go_elated_options()->getOptionValue('listings_per_page');
		};

		$args = array(
			'post_type' => 'listing-item',
			'post_status' => 'publish',
			'posts_per_page' => $posts_per_page
		);

		if ( $params ) {
			extract($params);

			if ( isset($type) ) {
				$args['meta_key'] = 'eltd_listing_item_type';
				$args['meta_value'] = $type;
			}

			$args['tax_query'] = array(
				'relation' => 'AND'
			);

			if ( isset($keywords) ) {
				$args['s'] = $keywords;
			}

			if ( isset($category) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'listing-item-category',
					'field' => 'term_id',
					'terms' => (int)$category
				);
			}

			if ( isset($location) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'listing-item-location',
					'field' => 'term_id',
					'terms' => (int)$location
				);
			}

		}

		$query = new WP_Query($args);

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$item_id = get_the_ID();
				$image_id = get_post_thumbnail_id( $item_id );
				$image = wp_get_attachment_image_src( $image_id );

				//Get item type
				$item_type_id = get_post_meta($item_id, 'eltd_listing_item_type', true);
				
				$marker_pin_icon = '';
				
				$categories = wp_get_post_terms($item_id, 'listing-item-category');
				
				
				if(is_array($categories) && count($categories)){
					
					$marker_pin_icon_pack = get_term_meta( $categories[0]->term_id, 'icon_pack', true );
					$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
					$marker_pin_icon = get_term_meta( $categories[0]->term_id, $param, true );
					
				}
				
				
				if ( $marker_pin_icon == '' && $item_type_id !== '' ) {
					$marker_pin_icon_pack = get_post_meta( $item_type_id, 'listing_type_icon_pack', true );
					$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
					$marker_pin_icon = get_post_meta( $item_type_id, 'listing_type_icon_' . $param, true );
				}
				
				$marker_pin = '';
				
				if($marker_pin_icon !== ''){
					$marker_pin = search_and_go_elated_icon_collections()->renderIcon( $marker_pin_icon, $marker_pin_icon_pack );
				}

				//Get item location, title and type
				$item = array(
					'location' => array(
						'address' => get_post_meta( $item_id, 'eltd_listing_address', true ),
						'latitude' => get_post_meta( $item_id, 'eltd_listing_address_latitude', true ),
						'longitude' => get_post_meta( $item_id, 'eltd_listing_address_longitude', true )
					),
					'title' => get_the_title($item_id),
					'listingType' => $item_type_id,
					'markerPin' => $marker_pin,
					'featuredImage' => $image,
					'itemUrl' => get_the_permalink()
				);

				$items[] = $item;

			}
		}

		return $items;

	}

}

if ( ! function_exists('search_and_go_elated_return_search_map_data') ) {

	function search_and_go_elated_return_search_map_data($multiple_map_variables) {

		global $search_params;

		$multiple_map_variables['addresses'] = search_and_go_elated_query_map_items( $search_params );

		return $multiple_map_variables;

	}

}

if ( ! function_exists( 'search_and_go_elated_get_cotnent_after_map_refresh' ) ) {

	function search_and_go_elated_get_cotnent_after_map_refresh( $query ) {

		$html = '';
		if ( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post();
				ob_start();
				search_and_go_elated_get_module_template_part('templates/lists/single', 'listing');
				$html .= ob_get_clean();
			}
		} else {
			$html .= 'No listing items';
		}

		return $html;

	}

}