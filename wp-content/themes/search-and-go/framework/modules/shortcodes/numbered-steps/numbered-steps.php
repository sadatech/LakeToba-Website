<?php
namespace SearchAndGoElated\Modules\Shortcodes\NumberedSteps;

use SearchAndGoElated\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class NumberedSteps
 */
class NumberedSteps implements ShortcodeInterface	{
	private $base; 
	
	function __construct() {
		$this->base = 'eltd_numbered_steps';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
		* Returns base for shortcode
		* @return string
	 */
	public function getBase() {
		return $this->base;
	}	
	public function vcMap() {
						
		vc_map( array(
			'name' => esc_html__('Elated Numbered Steps', 'search-and-go'),
			'base' => $this->base,
			'category' => 'by ELATED',
			'icon' => 'icon-wpb-numbered-steps extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Choose Skin',
						'param_name' => 'numbered_steps_skin',
						'value'	=> array(
							'Default' => '',
							'Dark' => 'dark',
							'Light' => 'light'							
						),
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Padding',
						'param_name' => 'numbered_steps_padding',
						'description' => 'Please insert padding in format (top right bottom left) i.e. 5px 5px 5px 5px or 5% 5% 5% 5%'
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Enter Number',
						'param_name' => 'numbered_steps_number',
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Enter title',
						'param_name' => 'numbered_steps_title',
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Enter subtitle',
						'param_name' => 'numbered_steps_subtitle',
						'save_always' => true
					),
					array(
						'type' => 'textarea_html',
						'heading' => 'Content',
						'param_name' => 'content',
						'value' => '<p>'.'I am test text for numbered steps shortcode.'.'</p>',
						'description' => ''
					)
				)
		) );

	}

	public function render($atts, $content = null) {
		
		$args = array(
			'numbered_steps_skin' => 'dark',
            'numbered_steps_number' => '',
			'numbered_steps_title' => '',
			'numbered_steps_subtitle' => '',
			'numbered_steps_content' => '',
			'numbered_steps_padding' => ''
        );
		
		$params = shortcode_atts($args, $atts);
		$params['content']= $content;
		
		//Extract params for use in method
		extract($params);
		$params['skin_class'] = $this->getSkinClass($params);
		$params['holder_styles'] = $this->getHolderStyles($params);
		
		$html = search_and_go_elated_get_shortcode_module_template_part('templates/numbered-steps-template', 'numbered-steps', '', $params);
		
		return $html;
	}
	
	private function getSkinClass($params){
		
		
		$class = '';
		
		if($params['numbered_steps_skin'] == 'light'){
			
			$class = 'eltd-light-skin';
			
		}
		elseif($params['numbered_steps_skin'] == 'dark') {
			
			$class = 'eltd-dark-skin';
			
		}
		return $class;
	}	
	
	private function getHolderStyles($params){
		
		$styles = array();
		
		if($params['numbered_steps_padding'] !== ''){
			
			$styles[] = 'padding: '.$params['numbered_steps_padding'];
			
		}
		
		return $styles;
	}
	
}
