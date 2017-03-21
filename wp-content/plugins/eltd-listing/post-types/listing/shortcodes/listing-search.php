<?php
namespace ElatedListing\Listing\Shortcodes;

use ElatedListing\Lib;

/**
 * Class ListingAdvancedSearch
 * @package ElatedListing\Listing\Shortcodes
 */
class ListingSearch implements Lib\ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_listing_search';

		add_action('vc_before_init', array($this, 'vcMap'));

		//Filters For autocomplete param:
		//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
		add_filter( 'vc_autocomplete_eltd_listing_search_selected_categories_callback', array(
			&$this,
			'listingTypeIdAutocompleteSuggester',
		), 10, 1 ); // Get suggestion(find). Must return an array

		add_filter( 'vc_autocomplete_eltd_listing_search_selected_categories_render', array(
			&$this,
			'listingTypeIdAutocompleteRender',
		), 10, 1 ); // Render exact listingType. Must return an array (label,value)
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map( array(
					'name' => 'Listing Search',
					'base' => $this->getBase(),
					'category' => 'by ELATED',
					'icon' => 'icon-wpb-listing-search extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params' => array(
							array(
								'type'        => 'autocomplete',
								'heading'     => 'Choose Featured Categories',
								'param_name'  => 'selected_categories',
								'settings'    => array(
									'multiple'      => true,
									'sortable'      => true,
									'unique_values' => true
								),
								'description' => 'Here you can choose which categories will be displayed as featured in the search. These categories will be displayed as icons underneath the search form. If you don\'t choose featured categories, your 5 latest categories will be displayed underneath the search form.',
								'save_always' => true
							)
					)
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {

		$args = array(
			'selected_categories'   => ''
		);

		$params = shortcode_atts( $args, $atts );
		extract( $params );

		$params['top_categories'] = $this->getTopCategories($params);
		$params['locations'] = $this->getLocations();
		$params['categories'] = $this->getCategories();
		$params['button_hover_color'] = $this->getButtonHoverColor();

		$html = eltd_listing_get_shortcode_module_template_part('listing', 'listing-search-template', '', $params);
		return $html;

	}

	/**
	 * Sort listing categories by listing item count and take maximum 5 categories
	 *
	 * @return array
	 */
	private function getTopCategories($params) {

		$listing_cat_ids = null;
		$query_array = array(
			'post_type' => 'listing-type-item',
			'posts_per_page' => '5'
		);

		if ( ! empty( $params['selected_categories'] ) ) {
			$listing_cat_ids    = explode( ',', $params['selected_categories'] );
			$query_array['post__in'] = $listing_cat_ids;
		}

		$listing_types = get_posts($query_array);
		return $listing_types;

	}

	private function getLocations() {

		$locations = array();
		$args = array(
			'number' => 0,
			'taxonomy' => 'listing-item-location'
		);
		$taxonomies = get_terms($args);
		foreach ($taxonomies as $location) {
			$locations[$location->term_id] = $location->name;
		}
		return $locations;

	}

	private function getCategories() {

		$listing_types = array();
		$args = array(
			'post_type' => 'listing-type-item',
			'posts_per_page' => '-1'
		);
		$types = get_posts($args);

		foreach ($types as $type) {
			$listing_types[$type->ID] = $type->post_title;
		}
		return $listing_types;

	}

	private function getButtonHoverColor(){

		$button_hover_color = '#1ab5c1';
		if(search_and_go_elated_options()->getOptionValue('first_color') !== ''){
			$button_hover_color = search_and_go_elated_options()->getOptionValue('first_color');
		}
		return $button_hover_color;
	}

	/**
	 * Filter listing types by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function listingTypeIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$listingType_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts}
					WHERE post_type = 'listing-type-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $listingType_id > 0 ? $listingType_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];  //Param that will be saved in shortcode
				$data['label'] = esc_html__( 'Id', 'eltd_listing' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'eltd_listing' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;

	}

	/**
	 * Find listingType by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function listingTypeIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get listingType
			$listingType = get_post( (int) $query );
			if ( ! is_wp_error( $listingType ) ) {

				$listingType_id    = $listingType->ID;
				$listingType_title = $listingType->post_title;

				$listingType_title_display = '';
				if ( ! empty( $listingType_title ) ) {
					$listingType_title_display = ' - ' . esc_html__( 'Title', 'eltd_listing' ) . ': ' . $listingType_title;
				}

				$listingType_id_display = esc_html__( 'Id', 'eltd_listing' ) . ': ' . $listingType_id;

				$data          = array();
				$data['value'] = $listingType_id;
				$data['label'] = $listingType_id_display . $listingType_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

}