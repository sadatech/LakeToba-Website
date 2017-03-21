<?php
namespace SearchAndGoElated\Modules\Shortcodes\ElatedUserLogin;

use SearchAndGoElated\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class UserLogin
 */
class ElatedUserLogin implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_user_login';

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
		);

		$params = shortcode_atts($args, $atts);
		extract($params);

		$button_hover_color = '#1ab5c1';
		if(search_and_go_elated_options()->getOptionValue('first_color') !== ''){
			$button_hover_color = search_and_go_elated_options()->getOptionValue('first_color');
		}
		$params['button_hover_color'] = $button_hover_color;

		$html = search_and_go_elated_get_shortcode_module_template_part('template/login-template', 'login', '', $params);

		return $html;
	}

}