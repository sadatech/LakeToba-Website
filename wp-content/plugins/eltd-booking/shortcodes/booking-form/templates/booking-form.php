<div class="eltd-rf-holder">
	<?php if($open_table_id !== '') : ?>
		<form class="eltd-rf" target="_blank" action="http://www.opentable.com/restaurant-search.aspx" name="eltd-rf">
			<div class="eltd-rf-holder clearfix">
				<div class="eltd-rf-field-holder clearfix">
					<select name="partySize" class="eltd-ot-people">
						<option value="1"><?php esc_html_e('1 Person', 'mkd_restaurant'); ?></option>
						<option value="2"><?php esc_html_e('2 People', 'mkd_restaurant'); ?></option>
						<option value="3"><?php esc_html_e('3 People', 'mkd_restaurant'); ?></option>
						<option value="4"><?php esc_html_e('4 People', 'mkd_restaurant'); ?></option>
						<option value="5"><?php esc_html_e('5 People', 'mkd_restaurant'); ?></option>
						<option value="6"><?php esc_html_e('6 People', 'mkd_restaurant'); ?></option>
						<option value="7"><?php esc_html_e('7 People', 'mkd_restaurant'); ?></option>
						<option value="8"><?php esc_html_e('8 People', 'mkd_restaurant'); ?></option>
						<option value="9"><?php esc_html_e('9 People', 'mkd_restaurant'); ?></option>
						<option value="10"><?php esc_html_e('10 People', 'mkd_restaurant'); ?></option>
					</select>
				</div>
				<div class="eltd-rf-field-holder clearfix">
					<input type="text" value="<?php echo date('m/d/Y'); ?>" class="eltd-ot-date" name="startDate">
				</div>
				<div class="eltd-rf-field-holder clearfix">
					<select name="ResTime" class="eltd-ot-time">
						<option value="5:30pm">6:30 am</option>
						<option value="5:30pm">7:00 am</option>
						<option value="5:30pm">7:30 am</option>
						<option value="5:30pm">8:00 am</option>
						<option value="5:30pm">8:30 am</option>
						<option value="5:30pm">9:00 am</option>
						<option value="5:30pm">9:30 am</option>
						<option value="5:30pm">10:00 am</option>
						<option value="5:30pm">10:30 am</option>
						<option value="5:30pm">11:00 am</option>
						<option value="5:30pm">11:30 am</option>
						<option value="5:30pm">12:00 pm</option>
						<option value="5:30pm">12:30 pm</option>
						<option value="5:30pm">1:00 pm</option>
						<option value="5:30pm">1:30 pm</option>
						<option value="5:30pm">2:00 pm</option>
						<option value="5:30pm">2:30 pm</option>
						<option value="5:30pm">3:00 pm</option>
						<option value="5:30pm">3:30 pm</option>
						<option value="5:30pm">4:00 pm</option>
						<option value="5:30pm">4:30 pm</option>
						<option value="5:30pm">5:00 pm</option>
						<option value="5:30pm">5:30 pm</option>
						<option value="6:00pm">6:00 pm</option>
						<option value="6:30pm">6:30 pm</option>
						<option value="7:00pm" selected="selected">7:00 pm</option>
						<option value="7:30pm">7:30 pm</option>
						<option value="8:00pm">8:00 pm</option>
						<option value="8:30pm">8:30 pm</option>
						<option value="9:00pm">9:00 pm</option>
						<option value="9:30pm">9:30 pm</option>
						<option value="10:00pm">10:00 pm</option>
						<option value="10:30pm">10:30 pm</option>
						<option value="11:00pm">11:00 pm</option>
						<option value="11:30pm">11:30 pm</option>
					</select>
				</div>
				<div class="eltd-rf-btn-holder">
					<?php if(eltd_booking_theme_installed()) { ?>
						<?php echo search_and_go_elated_get_button_html(
							array(
								'type'         => 'solid',
								'html_type'    => 'button',
								'text'         => esc_html__('Book Now', 'eltd_booking'),
								'input_name'   => 'eltd-rf-submit',
								'icon_pack'    => 'font_elegant',
								'fe_icon' => 'arrow_carrot-right'
							)
						) ?>
					<?php } else { ?>
						<input type="submit" class="eltd-btn eltd-btn-solid" name="eltd-rf-time">
					<?php } ?>
				</div>
			</div>

			<input type="hidden" name="RestaurantID" class="RestaurantID" value="<?php echo esc_attr($open_table_id); ?>">
			<input type="hidden" name="rid" class="rid" value="<?php echo esc_attr($open_table_id); ?>">
			<input type="hidden" name="GeoID" class="GeoID" value="15">
			<input type="hidden" name="txtDateFormat" class="txtDateFormat" value="MM/dd/yyyy">
			<input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="<?php echo esc_attr($open_table_id); ?>">

		</form>
		<span class="eltd-rf-copyright"><?php esc_html_e('Powered by OpenTable', 'eltd_booking'); ?></span>
	<?php else: ?>
		<p><?php esc_html_e('You haven\'t added OpenTable ID', 'eltd_booking'); ?></p>
	<?php endif; ?>
</div>