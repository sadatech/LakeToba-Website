<?php
namespace SearchAndGoElated\Modules\Shortcodes\PricingTables;

use SearchAndGoElated\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTables implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'eltd_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
				'name' => esc_html__('Elated Pricing Tables', 'search-and-go'),
				'base' => $this->base,
				'as_parent' => array('only' => 'eltd_pricing_table'),
				'content_element' => true,
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'params' => array(
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Columns',
						'param_name' => 'columns',
						'value' => array(
							'Two'       => 'eltd-two-columns',
							'Three'     => 'eltd-three-columns',
							'Four'      => 'eltd-four-columns',
						),
						'save_always' => true,
						'description' => ''
					)
				),
				'js_view' => 'VcColumnView'
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         => 'eltd-two-columns'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$html = '<div class="eltd-pricing-tables clearfix '.$columns.'">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}