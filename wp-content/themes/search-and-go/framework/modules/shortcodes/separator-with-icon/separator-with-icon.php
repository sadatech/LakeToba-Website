<?php
namespace SearchAndGoElated\Modules\Shortcodes\Separator;

use SearchAndGoElated\Modules\Shortcodes\Lib\ShortcodeInterface;

class SeparatorWithIcon implements ShortcodeInterface{

	private $base;

	function __construct() {
		$this->base = 'eltd_separator_with_icon';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map(
			array(
				'name' => esc_html__('Elated Separator With Icon', 'search-and-go'),
				'base' => $this->base,
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-separator extended-custom-icon',
				'show_settings_on_create' => true,
				'class' => 'wpb_vc_separator',
				'custom_markup' => '<div></div>',
				'params' => array_merge(
					array(
						array(
							'type' => 'textfield',
							'heading' => 'Extra class name',
							'param_name' => 'class_name',
							'value' => '',
							'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Type',
							'param_name' => 'type',
							'value' => array(
								'Normal'		=>	'normal',
								'Full Width'	=>	'full-width'
							),
							'description' => ''
						)
					),
					search_and_go_elated_icon_collections()->getVCParamsArray(array(), '', true),
					array(
						array(
							'type' => 'dropdown',
							'heading' => 'Position',
							'param_name' => 'position',
							'value' => array(
								'Center'		=> 'center',
								'Left'			=> 'left',
								'Right'			=> 'right'
							),
							'save_always' => true,
							'dependency' => array('element' => 'type', 'value' => array('normal'))
						),
						array(
							'type' => 'colorpicker',
							'heading' => 'Color',
							'param_name' => 'color',
							'value' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => 'Width',
							'param_name' => 'width',
							'value' => '',
							'description' => '',
							'dependency' => array('element' => 'type', 'value' => array('normal'))
						),
						array(
							'type' => 'textfield',
							'heading' => 'Thickness (px)',
							'param_name' => 'thickness',
							'value' => '',
							'description' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => 'Top Margin',
							'param_name' => 'top_margin',
							'value' => '',
							'description' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => 'Bottom Margin',
							'param_name' => 'bottom_margin',
							'value' => '',
						)
					)
				)
			)
		);

	}

	public function render($atts, $content = null) {
		$args = array(
			'class_name'	=>	'',
			'type'			=>	'',
			'position'		=>	'center',
			'color'			=>	'',
			'width'			=>	'80',
			'thickness'		=>	'1',
			'top_margin'	=>	'',
			'bottom_margin'	=>	''
		);

		$args = array_merge($args, search_and_go_elated_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
		$iconPackName   = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $iconPackName ? $params[$iconPackName] : '';
		$params['separator_class'] = $this->getSeparatorClass($params);
		$params['separator_style'] = $this->getSeparatorStyle($params);
		$params['separator_holder_style'] = $this->getSeparatorHolderStyle($params);

		$html = search_and_go_elated_get_shortcode_module_template_part('templates/separator-template-with-icon', 'separator-with-icon', '', $params);

		return $html;
	}


	/**
	 * Return Separator classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getSeparatorClass($params) {

		$separator_class = array();

		if ($params['class_name'] !== '') {
			$separator_class[] = $params['class_name'];
		}
		if ($params['position'] !== '') {
			$separator_class[] = 'eltd-separator-'.$params['position'];
		}
		if ($params['type'] !== '') {
			$separator_class[] = 'eltd-separator-'.$params['type'];
		}

		return implode(' ', $separator_class);

	}

	/**
	 * Return Elements Holder Item Content style
	 *
	 * @param $params
	 * @return array
	 */
	private function getSeparatorStyle($params) {

		$separator_style = array();

		if ($params['color'] !== '') {
			$separator_style[] = 'background-color: ' . $params['color'];
		}
		if ($params['width'] !== '') {
			if(search_and_go_elated_string_ends_with($params['width'], '%') || search_and_go_elated_string_ends_with($params['width'], 'px')) {
				$separator_style[] = 'width: ' . $params['width'];
			}else{
				$separator_style[] = 'width: ' . $params['width'] . 'px';
			}
		}
		if ($params['thickness'] !== '') {
			$separator_style[] = 'height: ' . $params['thickness'] . 'px';
		}
		return implode(';', $separator_style);

	}

	private function getSeparatorHolderStyle( $params ) {

		$separator_style = array();
		if ($params['top_margin'] !== '') {
			if(search_and_go_elated_string_ends_with($params['top_margin'], '%') || search_and_go_elated_string_ends_with($params['top_margin'], 'px')) {
				$separator_style[] = 'margin-top: ' . $params['top_margin'];
			}else{
				$separator_style[] = 'margin-top: ' . $params['top_margin'] . 'px';
			}
		}
		if ($params['bottom_margin'] !== '') {
			if(search_and_go_elated_string_ends_with($params['bottom_margin'], '%') || search_and_go_elated_string_ends_with($params['bottom_margin'], 'px')) {
				$separator_style[] = 'margin-bottom: ' . $params['bottom_margin'];
			}else{
				$separator_style[] = 'margin-bottom: ' . $params['bottom_margin'] . 'px';
			}
		}
		return implode(';', $separator_style);

	}

}
