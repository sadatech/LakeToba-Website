<div class="eltd-claim-holder">
	<div class="eltd-claim-content">
		<div class="eltd-claim-title"><?php esc_html_e('Claim Listing', 'search-and-go'); ?></div>
		<div class="eltd-claim-content-inner" id="eltd-claim-content">
			<form action="" class="eltd-claim-listing-form">
				<?php if ( $packages ) { ?>
					<label for="package"><?php esc_html_e('Select Package for Listing', 'search-and-go'); ?></label>
					<select name="package" id="package">
						<?php foreach ($packages as $package) { ?>
							<option value="<?php echo esc_html($package['id']); ?>"><?php echo esc_html($package['name']); ?></option>
						<?php } ?>
					</select>
					<input type="hidden" name="user" value="<?php echo esc_html( $user ); ?>">
					<input type="hidden" name="post" value="<?php echo esc_html( $post ); ?>">
				<div class="eltd-claim-button-holder">
				<?php
					echo search_and_go_elated_get_button_html(array(
						'html_type' => 'button',
						'text' => esc_html__('Claim Listing', 'search-and-go'),
						'type' => 'solid',
						'background_color' => '#4c4c4c',
						'border_color' => '#4c4c4c',
						'hover_color' => '#4c4c4c',
						'hover_border_color' => '#4c4c4c',
						'icon_pack' => 'font_elegant',
						'fe_icon' => 'arrow_carrot-right'
					));
				?>
				</div>
				<?php } else { ?>
					<p><?php esc_html_e('You don\'t have available packages', 'search-and-go'); ?></p>
				<?php } ?>
			</form>
		</div>
		<?php
		do_action('eltd_listing_action_listing_ajax_response');
		?>
	</div>
</div>