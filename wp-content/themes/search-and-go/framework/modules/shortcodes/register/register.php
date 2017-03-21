<?php
namespace SearchAndGoElated\Modules\Shortcodes\ElatedUserRegister;

use SearchAndGoElated\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ElatedUserRegister
 */
class ElatedUserRegister implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_user_register';

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
		$html = '';

		$button_hover_color = '#1ab5c1';
		if(search_and_go_elated_options()->getOptionValue('first_color') !== ''){
			$button_hover_color = search_and_go_elated_options()->getOptionValue('first_color');
		}
		$params['button_hover_color'] = $button_hover_color;

		if(!is_user_logged_in()) {
			if (get_option('users_can_register')) {

				$html .= search_and_go_elated_get_shortcode_module_template_part('template/register-template', 'register', '', $params);
			} else {
				$message = esc_html__('You dont have permission to register', 'search-and-go');
				$html .= search_and_go_elated_get_shortcode_module_template_part('template/register-message', 'register', '', array('message'=>$message));
			}
		} else {
			$message = esc_html__('You are already logged in', 'search-and-go');
			$html .= search_and_go_elated_get_shortcode_module_template_part('template/register-message', 'register', '', array('message'=>$message));
		}

		return $html;
	}

}