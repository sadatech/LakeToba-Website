<?php
namespace ElatedListing\Listing\Shortcodes;

use ElatedListing\Lib;

/**
 * Class ListingAdvancedSearch
 * @package ElatedListing\Listing\Shortcodes
 */
class ListingAdvancedSearch implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_listing_adv_search';

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
				'name' => 'Listing Advanced Search',
				'base' => $this->getBase(),
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-listing-advanced-search extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						'type' => 'textfield',								
						'heading' => 'Title',
						'param_name' => 'listing_adv_search_title',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'textfield',								
						'heading' => 'Subitle',
						'param_name' => 'listing_adv_search_subtitle',
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
			'listing_adv_search_title',
			'listing_adv_search_subtitle'
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		
		
		$query_results = array();
		
		if(eltd_listing_theme_installed()){
			$query_results = search_and_go_elated_query_listing_items();
		}
		
		$html = '';		
				
		$html .= '<div class = "eltd-listing-adv-search-holder clearfix">';
		
		//render preloader html 
		$html .= eltd_listing_get_shortcode_module_template_part('listing', 'listing-preloader', '', $params);
		
		//render advance search html 
		$html .= eltd_listing_get_shortcode_module_template_part('listing', 'listing-adv-search-filter-holder', '', $params);
		
		//render listing items html 
		$html .= '<div class = "eltd-listing-articles-holder">';
		
		if($query_results->have_posts()):
			
			while ( $query_results->have_posts() ) : $query_results->the_post();
				
				$html .= eltd_listing_get_shortcode_module_template_part('listing', 'listing-standard', '', $params);
				
			endwhile;
			
			$query_results->reset_postdata();
			
		else: 
			
			$html .= '<p>'. esc_html_e( 'Sorry, no posts matched your criteria.', 'eltd_listing' ) .'</p>';
		
		endif;
		$html .= '</div>'; //close eltd-listing-articles-holder
		
		$html .= '</div>'; //close eltd-listing-advanced-search-holder
		return $html;
	}

}