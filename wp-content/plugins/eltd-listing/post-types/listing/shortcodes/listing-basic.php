<?php
namespace ElatedListing\Listing\Shortcodes;

use ElatedListing\Lib;

/**
 * Class ListingBasic
 * @package ElatedListing\Listing\Shortcodes
 */
class ListingBasic implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_listing_basic';

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
		if(function_exists('vc_map') && eltd_listing_theme_installed() ) {

			vc_map( array(
				'name' => 'Elated Listing',
				'base' => $this->getBase(),
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-listing-basic extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						'type' => 'textfield',								
						'heading' => 'Number of Items',
						'param_name' => 'listing_basic_number',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',								
						'heading' => 'Column Number',
						'param_name' => 'listing_basic_columns',
						'value'	=> array(
							'Two' => 'two',
							'Three' => 'three',
							'Four' => 'four'							
						),
						'save_always' => true,
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',								
						'heading' => 'Choose Listing Type',
						'param_name' => 'listing_basic_type',
						'value'	=> search_and_go_elated_get_listing_types_VC(),
						'save_always' => true,
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',								
						'heading' => 'Choose Listing Category',
						'param_name' => 'listing_basic_category',
						'value'	=> search_and_go_elated_get_listing_categories_VC(),
						'save_always' => true,
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',								
						'heading' => 'Choose Listing Location',
						'param_name' => 'listing_basic_location',
						'value'	=> search_and_go_elated_get_listing_locations_VC(),
						'save_always' => true,
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
			'listing_basic_title' => '',
			'listing_basic_columns' => 'three',
			'listing_basic_type' => '',
			'listing_basic_category' => '',
			'listing_basic_location' => '',
			'listing_basic_number'	=> '-1',
			'listing_advanced_query'	=> ''
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$query_results = $query_params = array();
		
		
		if($listing_advanced_query === ''){
			
			if($listing_basic_number !== ''){
				$query_params['number'] = $listing_basic_number;
			}
			if($listing_basic_type !== ''){
				$query_params['type'] = $listing_basic_type;
			}
			if($listing_basic_category !== ''){
				$query_params['category'] = $listing_basic_category;
			}
			if($listing_basic_location !== ''){
				$query_params['location'] = $listing_basic_location;
			}
			
			//generate query results based on shortcode params
			if ( eltd_listing_theme_installed() ) {
				$query_results = search_and_go_elated_query_listing_items($query_params);
			}
			
		}
		else{			
			//use generated query
			$query_results = $listing_advanced_query;			
		}
		
		
				
		
		$holder_classes = $this->getListingHolderClasses($params);
		
		$html = '';		
				
		$html .= '<div class = "eltd-listing-basic-holder clearfix '.$holder_classes.'">';
		
		//render listing items html 
		$html .= '<div class = "eltd-listing-basic-inner-holder clearfix">';
		
		if($query_results->have_posts()):
			
			while ( $query_results->have_posts() ) : $query_results->the_post();
				
				$params['permalink'] = $this->getListingPermalink();
				$params['feature_image'] = $this->getListingFeatureImage();
				$params['title'] = get_the_title();
				$params['address'] = $this->getListingAddress();
				$params['excerpt'] = $this->getListingExcerpt();
				$params['rating_html'] = $this->getListingRating();
				$params['icon_html'] = $this->getListingIconHtml();
				
				$html .= eltd_listing_get_shortcode_module_template_part('listing', 'listing-basic-template', '', $params);
				
			endwhile;
			
			$query_results->reset_postdata();
			
		else: 
			
			$html .= '<p>'. esc_html__( 'Sorry, no posts matched your criteria.', 'eltd_listing' ) .'</p>';
		
		endif;
		$html .= '</div>'; //eltd-listing-basic-inner-holder
		
		$html .= '</div>'; //eltd-listing-basic-holder
		return $html;
	}
	
	private function getListingPermalink(){
		
		return get_permalink();
		
	}
	
	private function getListingFeatureImage(){
		
		$image = '';
		
		if( has_post_thumbnail(get_the_ID() )){
			
			$image = get_the_post_thumbnail(get_the_ID(),'full');
			
		}	
		
		return $image;
		
	}	
	
	private function getListingAddress(){
		
		$address = get_post_meta(get_the_ID(), 'eltd_listing_address', true);
		
		return $address;
		
	}
	
	private function getListingExcerpt(){
		
		$excerpt = get_the_excerpt();
		
		return $excerpt;
		
	}	

	
	private function getListingRating(){
		
		$rating_html = eltd_listing_get_shortcode_module_template_part('listing', 'listing-rating');
		
		return $rating_html;
		
	}
	
	private function getListingIconHtml(){
		if ( eltd_listing_theme_installed() ) {
			$icon_html = search_and_go_elated_get_listing_categories_html(get_the_ID());
		}else{
			$icon_html = '';
		}

		return $icon_html;
		
	}
	
	private function getListingHolderClasses($params){
		
		$classes = array();
		
		$columns = $params['listing_basic_columns'];
		
		switch($columns){
			
			case 'two':				
				$classes[] = 'eltd-listing-two-cols';
				break;
			
			case 'three':				
				$classes[] = 'eltd-listing-three-cols';
				break;
			
			case 'four':				
				$classes[] = 'eltd-listing-four-cols';
				break;
			
		}
		
		return implode('',$classes);
		
	}
	

}

