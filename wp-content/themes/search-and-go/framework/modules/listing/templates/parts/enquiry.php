<?php if ( search_and_go_elated_options()->getOptionValue('enable_listing_item_enquiry') == 'yes' ) { ?>

	<div class="eltd-listing-enquiry-holder">
		<h5><?php esc_html_e('Enquire now', 'search-and-go')?></h5>
		<form id="eltd-listing-enquiry-form" method="POST">
			<input class="eltd-input-field" type="text" name="enquiry-name" id="enquiry-name" placeholder="<?php esc_html_e( 'Name', 'search-and-go' );?>" required pattern=".{6,}" title="<?php esc_html_e('Name must have six or more characters', 'search-and-go'); ?>">
			<input type="email" class="eltd-input-field"  name="enquiry-email" id="enquiry-email" placeholder="<?php esc_html_e( 'Email', 'search-and-go' );?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="<?php esc_html_e( 'Email address has to be in valid format', 'search-and-go' ); ?>">
			<input type="tel" name="enquiry-phone" class="eltd-input-field"  id="enquiry-phone" placeholder="<?php esc_html_e( 'Phone No', 'search-and-go' );?>">
			<textarea name="enquiry-message" id="enquiry-message" class="eltd-textarea-field" placeholder="<?php esc_html_e( 'Message', 'search-and-go' );?>" required></textarea>
			<?php echo search_and_go_elated_get_button_html(array(
				'text' => esc_html__('Submit', 'search-and-go'),
				'html_type' => 'button',
				'type' => 'solid',
				'icon_pack' => 'font_elegant',
				'fe_icon' => 'arrow_carrot-right'
			)); ?>
			<input type="hidden" id="enquiry-item-id" value="<?php echo get_the_ID(); ?>">
			<?php wp_nonce_field('eltd_validate_listing_item_enquiry', 'eltd_nonce_listing_item_enquiry'); ?>
		</form>
		<?php do_action( 'search_and_go_elated_after_listing_item_enquiry_form' ); ?>
	</div>

<?php } ?>