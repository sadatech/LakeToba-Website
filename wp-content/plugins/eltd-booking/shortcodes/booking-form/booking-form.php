<?php
namespace ElatedBooking\Shortcodes;

use ElatedBooking\Lib\ShortcodeInterface;

class ReservationForm implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'eltd_reservation_form';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => 'Elated Reservation Form',
			'base'                      => $this->base,
			'category'                  => 'by ELATED',
			'icon'                      => 'extended-custom-icon icon-wpb-reservation-form',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => 'OpenTable ID',
					'param_name'  => 'open_table_id',
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'open_table_id' => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		return eltd_booking_get_template_part('shortcodes/booking-form/templates/booking-form', '', $params, true);
	}

}