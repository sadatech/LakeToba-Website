<?php

namespace ElatedCore\CPT\Testimonials\Shortcodes;


use ElatedCore\Lib;

/**
 * Class Testimonials
 * @package ElatedCore\CPT\Testimonials\Shortcodes
 */
class Testimonials implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'eltd_testimonials';

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
     * @see vc_map()
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => 'Testimonials',
                'base' => $this->base,
                'category' => 'by ELATED',
                'icon' => 'icon-wpb-testimonials extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
                    array(
                        'type' => 'textfield',
						'admin_label' => true,
                        'heading' => 'Category',
                        'param_name' => 'category',
                        'value' => '',
                        'description' => 'Category Slug (leave empty for all)'
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Number',
                        'param_name' => 'number',
                        'value' => '',
                        'description' => 'Number of Testimonials'
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Title',
                        'param_name' => 'show_title',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author',
                        'param_name' => 'show_author',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author Job Position',
                        'param_name' => 'show_position',
                        'value' => array(
                            'Yes' => 'yes',
							'No' => 'no',
                        ),
						'save_always' => true,
                        'dependency' => array('element' => 'show_author', 'value' => array('yes')),
                        'description' => ''
                    ), 
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Animation speed',
                        'param_name' => 'animation_speed',
                        'value' => '',
                        'description' => __('Speed of slide animation in miliseconds')
                    )
                )
            ) );
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
            'number' => '-1',
            'category' => '',
            'show_title' => 'no',
            'show_author' => 'yes',
            'show_position' => 'yes',
            'animation_speed' => ''
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);

        $number = esc_attr($number);
        $category = esc_attr($category);
        $animation_speed = esc_attr($animation_speed);
		
		$data_attr = $this->getDataParams($params);
		$query_args = $this->getQueryParams($params);
		$query_results = new \WP_Query($query_args);

		$html = '';
        $html .= '<div class="eltd-testimonials-holder clearfix">';
        $html .= '<div class="eltd-testimonials '.$data_attr.'">';

		
		$post_count = 0;
		
        if ($query_results->have_posts()) {
			
			$html .= '<div class="eltd-testimonial-slide-item clearfix">';
			while ($query_results->have_posts()){
				
				$query_results->the_post();
		
				$post_count++;
                $author = get_post_meta(get_the_ID(), 'eltd_testimonial_author', true);
                $text = get_post_meta(get_the_ID(), 'eltd_testimonial_text', true);
                $title = get_post_meta(get_the_ID(), 'eltd_testimonial_title', true);
                $job = get_post_meta(get_the_ID(), 'eltd_testimonial_author_position', true);

				$params['author'] = $author;
				$params['text'] = $text;
				$params['title'] = $title;
				$params['job'] = $job;
				$params['current_id'] = get_the_ID();	
				$params['image_style'] = $this->getFeatureImageStyle();
				$params['feature_image'] = $this->getFeatureImage();
				
				$html .= eltd_core_get_shortcode_module_template_part('testimonials','testimonials-template', '', $params);
				
				if( $post_count % 4 === 0 && $post_count !== $query_results->found_posts ){
					
					$html .= '</div>'; //close eltd-testimonial-slide-item for each fourth post
					$html .= '<div class = "eltd-testimonial-slide-item">'; //open eltd-testimonial-slide-item for each fifth post
					
				}
			}
			
			$html .= '</div>'; //close eltd-testimonial-slide-item
			
		}		
            
		else{
			$html .= __('Sorry, no posts matched your criteria.', 'eltd_core');
		}	
		
        wp_reset_postdata();
        $html .= '</div>';
		$html .= '</div>';
		
        return $html;
    }
	/**
    * Generates testimonial data attribute array
    *
    * @param $params
    *
    * @return string
    */
	private function getDataParams($params){
		$data_attr = '';
		
		if(!empty($params['animation_speed'])){
			$data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
		}
		
		return $data_attr;
	}
	/**
    * Generates testimonials query attribute array
    *
    * @param $params
    *
    * @return array
    */
	private function getQueryParams($params){
		
		$args = array(
            'post_type' => 'testimonials',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $params['number']
        );

        if ($params['category'] != '') {
            $args['testimonials_category'] = $params['category'];
        }
		return $args;
	}
	
	/**
    * Generates testimonials feature image background image style
    *
    * @return string
    */
	
	private function getFeatureImageStyle(){
		
		$image_style = '';
		
		if( has_post_thumbnail(get_the_ID() )){
			
			$image_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
			$image_style = 'background-image: url("'.$image_url_array[0].'")';
			
		}
		return $image_style;
		
	}
	
	/**
    * Generates testimonials feature image
    *
    * @return string
    */
	
	private function getFeatureImage(){
		
		$image = '';
		
		if( has_post_thumbnail(get_the_ID() )){
			
			$image = get_the_post_thumbnail(get_the_ID(),'full');
			
		}	
		
		return $image;
		
	}
	 
}