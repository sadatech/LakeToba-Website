<?php
namespace ElatedListing\Listing\Shortcodes;

use ElatedListing\Lib;

/**
 * Class ListingFeatureList
 * @package ElatedListing\Listing\Shortcodes
 */
class ListingFeatList implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_listing_feat_list';

		add_action('vc_before_init', array($this, 'vcMap'));
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
				'name' => 'Elated Listing Feature List',
				'base' => $this->getBase(),
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-listing-feature-list extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						'type' => 'textfield',								
						'heading' => 'Number of Listing Items',
						'param_name' => 'listing_feat_list_item_number',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'textfield',								
						'heading' => 'Number of Listing Location Items',
						'param_name' => 'listing_feat_list_tax_number',
						'admin_label' => true,
						'description' => ''
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
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'listing_feat_list_item_number'	=> '-1',
			'listing_feat_list_tax_number'	=> ''
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		
		//set post args
		//Get listing items which are set as featured for listing featured list shortcode 
		$post_args = array(
			'posts_per_page'   => $listing_feat_list_item_number,
			'meta_key'         => 'eltd_listing_feature_item',
			'meta_value'       => 'yes',
			'post_type'        => 'listing-item',
			'post_status'      => 'publish'
		);
		//set taxonomy args
		$tax_args = array(
			'number' => (int)$listing_feat_list_tax_number,
			'meta_query' => array(
				array(
					'key' => 'featured_taxonomy',
					'value' => 'yes'
				)
			)
		);
		
		
		$featured_tax_array = $featured_post_array = array();		
		
		//get all featured listing items
		$posts_array = get_posts( $post_args );
		
		//get feature order number value for all featured post and build array
		foreach($posts_array as $post){
			
			$feature_post_order_number = get_post_meta($post->ID,'eltd_listing_feature_order_number', true);
			$featured_post_array[$post->ID]['post_object'] = $post;
			$featured_post_array[$post->ID]['featured_order_number'] = $feature_post_order_number;
			
		}
		//get all listing loctions
		$taxonomies_array = get_terms('listing-item-location',$tax_args);
		
		//get listing location which are set as featured, get their featured order numbers and build array
		foreach ($taxonomies_array as $tax){

			$featured_tax_array[$tax->term_id]['post_object'] = $tax;
			$featured_tax_array[$tax->term_id]['featured_order_number'] = get_term_meta($tax->term_id,'featured_order_number', true);
			
		}

		//merge feature post array and feature locations array
		$feature_list_array = array_merge($featured_post_array, $featured_tax_array);
		
		//prepare merged array sorting(by featured order number)
		$order_array = array();
		foreach ($feature_list_array as $key => $value){
			$order_array[$key] = $value['featured_order_number'];
		}
		//sort merged array
		array_multisort($order_array, SORT_ASC, $feature_list_array);		
		
		$html = '';		
				
		$html .= '<div class = "eltd-listing-feat-list-holder">';
		
		//render sizer
		$html .= '<div class = "eltd-listing-feat-list-holder-sizer"></div>';
		
		if(is_array($feature_list_array) && count($feature_list_array)){
			
			foreach($feature_list_array as $feature_obj){
				
				if(isset($feature_obj['post_object']->post_type)){
					
					$params['item_permalink'] = $this->getListingPermalink($feature_obj['post_object']->ID);
					$params['item_title'] = $feature_obj['post_object']->post_title;
					
					//get image class and size 
					$image_params = $this->getListingItemImageParams($feature_obj['post_object']->ID);					
					
					$params['item_layout_class'] = $image_params['layout_class']; 
					$params['item_feature_image'] = $this->getListingFeatureImage($feature_obj['post_object']->ID, $image_params['thumb_size']);
					
					//category icon html
					$params['category_icon_array'] = $this->getItemCategoryIconArray($feature_obj['post_object']->ID);
						
					$html .= eltd_listing_get_shortcode_module_template_part('listing', 'listing-feature-item', '', $params);
					
				}elseif(isset($feature_obj['post_object']->taxonomy)){
					
					$params['tax_permalink'] = $this->getTaxonomyPermalink('listing-item-location', $feature_obj['post_object']->term_id);
					$params['tax_title'] =  $feature_obj['post_object']->name;
					
					//get image class and size 
					$image_params = $this->getListingTaxImageParams($feature_obj['post_object']->term_id);
					
					$params['tax_layout_class'] = $image_params['layout_class'];					
					$params['tax_feature_image_html'] = $this->getTaxonomyFeatureImage($feature_obj['post_object']->term_id, $image_params['thumb_size']);
					
					
					$html .= eltd_listing_get_shortcode_module_template_part('listing', 'listing-feature-tax', '', $params);
					
				}
					
			}			
		}
		$html .= '</div>'; //eltd-listing-feat-list-holder
		
		return $html;
	}
	
	private function getListingPermalink($id){
		
		return get_permalink($id);
		
	}
	
	private function getListingFeatureImage($id, $image_size){
		
		$image = '';
		
		if( has_post_thumbnail($id )){
			
			$image = get_the_post_thumbnail($id, $image_size);
			
		}	
		
		return $image;
		
	}
	
	private function getTaxonomyPermalink($taxonomy, $term_id){
		
		return get_term_link($term_id, $taxonomy);
		
	}
	
	private function getTaxonomyFeatureImage($term_id, $image_size){
		
		$image_html = '';
		
		$image_url = get_term_meta($term_id, 'featured_image', true);
		if($image_url !== '' && eltd_listing_theme_installed() ){
			
			$image_id = search_and_go_elated_get_attachment_id_from_url($image_url);
			$image_attr = wp_get_attachment_image_src($image_id, $image_size);
			$image_html = '<img src="'.$image_attr[0].'" width="'.$image_attr[1].'" height="'.$image_attr[2].'" title="'.$image_url.'" alt="taxonomy-feature-image"/>';
			
		}
		
		
		return $image_html;
		
	}
	
	private function getListingItemImageParams($id){
		
		$image_param_array = array();
		$layout = get_post_meta($id, 'eltd_listing_feature_layout', true);
		
		if($layout === 'portrait'){
			
			$image_param_array['layout_class'] = 'eltd-listing-feature-portrait';
			$image_param_array['thumb_size'] = 'search_and_go_elated_large_width';
			
		}else{
			
			$image_param_array['layout_class'] = 'eltd-listing-feature-square';
			$image_param_array['thumb_size']  = 'search_and_go_elated_square';
			
		}
		
		return $image_param_array;	
		
	}
	
	private function getListingTaxImageParams($id){
		
		$image_param_array = array();
		
		$layout = get_term_meta($id, 'featured_taxonomy_layout', true);
		
		if($layout === 'portrait'){
			
			$image_param_array['layout_class'] = 'eltd-listing-feature-portrait';
			$image_param_array['thumb_size'] = 'search_and_go_elated_large_width';
			
		}else{
			
			$image_param_array['layout_class'] = 'eltd-listing-feature-square';
			$image_param_array['thumb_size']  = 'search_and_go_elated_square';
			
		}
		
		return $image_param_array;	
		
	}
	
	private function getItemCategoryIconArray($id){
		
		$categories = wp_get_post_terms($id, 'listing-item-category');
		$category_icon_array = array();
		
		foreach ( $categories as $cat ) {
			
			$icon_pack = get_term_meta( $cat->term_id, 'icon_pack', true );
			if ( eltd_listing_theme_installed() ) {
				$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
				$icon = get_term_meta( $cat->term_id, $param, true );
				$category_link = get_category_link($cat->term_id);

				$category_icon_array[$cat->term_id]['icon_pack'] = $icon_pack;
				$category_icon_array[$cat->term_id]['icon'] = $icon;
				$category_icon_array[$cat->term_id]['category_link'] = $category_link;
			}

		}
		
		return $category_icon_array;
		
	}
}

