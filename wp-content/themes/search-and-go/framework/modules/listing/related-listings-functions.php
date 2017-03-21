<?php

if ( ! function_exists('search_and_go_elated_get_related_listings')) {

	function search_and_go_elated_get_related_listings( $options = array() ) {

		$listing_id = get_the_ID();
		$category_tax = 'listing-item-category';
		$tag_tax = 'listing-item-tag';

		$categories = wp_get_object_terms( $listing_id, $category_tax );
		$tags = wp_get_object_terms( $listing_id, $tag_tax );
		//Get listing type and features list
		$listing_type_id = get_post_meta( $listing_id, 'eltd_listing_item_type', true );
		$listing_type_feature_list = get_post_meta($listing_type_id, 'eltd_listing_type_feature_list', true);

		$cat_ids = array();
		$tag_ids = array();

		//Get all category ids
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$cat_ids[] = $category->term_id;
			}
		}

		//Get all tag ids
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}
		}

		//Try to find related listings by category
		$related_listings = search_and_go_elated_related_listing_filter_by_taxonomy( $listing_id, $listing_type_id, $cat_ids, $category_tax, $listing_type_feature_list, $options );
		$has_related_by_category = false;
		if ( $related_listings->have_posts() ) {
			$has_related_by_category = true;
		}

		//If search by category fails try to search by tags
		if ( ! $has_related_by_category ) {
			$related_listings = search_and_go_elated_related_listing_filter_by_taxonomy( $listing_id, $listing_type_id, $tag_ids, $tag_tax, $listing_type_feature_list, $options );
		}

		return $related_listings;

	}

}

if ( ! function_exists( 'search_and_go_elated_related_listing_filter_by_taxonomy' ) ) {

	function search_and_go_elated_related_listing_filter_by_taxonomy( $listing_id, $listing_type_id, $tax_ids, $taxonomy, $feature_list = array(), $options ) {

		//Query options
		$posts_per_page = -1;

		//Override query options
		extract($options);

		//Get all features and create meta query from checked features
		$meta_query = array();
		$meta_query_feature_list = array();
		if ( is_array( $feature_list ) && count( $feature_list ) ) {
			foreach ( $feature_list as $feature_item ) {
				if ( get_post_meta( $listing_id, 'listing_feature_list_'.$listing_type_id.'_'.sanitize_title($feature_item), true) == 1) {
					$meta_query_feature_list[] = array(
						'key' => 'listing_feature_list_'.$listing_type_id.'_'.sanitize_title($feature_item),
						'value' => '1'
					);
				}
			}
			$meta_query = array(
				'relation' => 'AND',
				array(
					'key' => 'eltd_listing_item_type',
					'value' => $listing_type_id
				),
//				array(
//					'relation' => 'OR',
//					$meta_query_feature_list
//				)
			);
		}

		$args = array(
			'post_type' => 'listing-item',
			'post__not_in'  => array($listing_id),
			'order'         => 'DESC',
			'orderby'       => 'date',
			'posts_per_page'=> $posts_per_page,
			'tax_query'     => array(
				array(
					'taxonomy'  => $taxonomy,
					'field'     => 'term_id',
					'terms'     => $tax_ids,
				),
			),
			'meta_query'    => $meta_query
		);

		$query = new WP_Query( $args );

		return $query;

	}

}