<div class="eltd-new-listing-item">

	<label for="listing_tags">
		<?php esc_html_e( 'Tags', 'eltd_listing' ); ?>
	</label>

	<div class="eltd-profile-input  eltd-listing-dashboard-tags-holder clearfix">
		<?php
		$tags_args = eltd_listing_get_tags_args();

		//get tags for current post(for editing).See eltd_listing_get_listing_fields

		$tags_args['defaults'] = $tags_defaults;
		echo eltd_listing_get_dropdown_tax_terms( $tags_args ); ?>
	</div>

</div>
<div class="eltd-new-listing-item">

	<label for="listing_category">
		<?php esc_html_e( 'Subcategories', 'eltd_listing' ); ?>
	</label>

	<div class="eltd-profile-input">
		<?php
		//set meta query to get listing type categories
		$category_args = eltd_listing_get_category_args();

		//this is generated in dashboard-functions.php.See eltd_listing_get_listing_fields
		$category_args['meta_query'] = $category_meta_query;
		$category_args['defaults'] = $category_defaults;

		echo eltd_listing_get_dropdown_tax_terms( $category_args ); ?>
	</div>

</div>


<?php if ( $show_gallery == 'yes' ) : ?>

	<div class="eltd-new-listing-item eltd-media-uploader-holder">

		<label for="eltd-listing-description">
			<?php esc_html_e( 'Gallery Images', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-media-uploader-buttons-wrapper">

			<div class="eltd-media-uploader-icon-holder">
				<?php
				if ( eltd_listing_theme_installed() ) {
					echo search_and_go_elated_execute_shortcode( 'eltd_icon', $media_icon_multiple_images_params );
				}
				?>
			</div>

			<div class="eltd-media-uploader-button-holder">

				<div class="eltd-media-holder eltd-multiple-media-upload clearfix">
					<?php
					$gallery   = eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_gallery_images_meta' );
					$images_id = explode( ',', $gallery );
					foreach ( $images_id as $img_id ) {
						echo wp_get_attachment_image( $img_id );
					}
					?>
				</div>
				<div class="eltd-action-buttons">
					<a href="javascript: void(0)" data-multiple='true'
					   data-frame-title="<?php esc_html_e( 'Select Image', 'eltd_listing' ); //TODO Change to function for button?>"
					   data-frame-button-text="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"
					   class="eltd-upload-button">
						<?php
						if ( eltd_listing_theme_installed() ) {
							echo search_and_go_elated_icon_collections()->renderIcon( 'icon_plus', 'font_elegant' );
						}
						?>
					</a>

					<a href="javascript: void(0)" data-multiple="true" class="eltd-remove-button">
						<?php
						if ( eltd_listing_theme_installed() ) {
							echo search_and_go_elated_icon_collections()->renderIcon( 'icon_close', 'font_elegant' );
						}
						?>
					</a>
				</div>

				<input type="hidden" class="eltd-media-uploader-input" name="eltd_listing_gallery_images_meta"
				       value="<?php echo esc_attr( $gallery ); ?>">

			</div>

		</div>

	</div>

<?php endif; ?>

<?php if ( $show_video == 'yes' ) : ?>
	<div class="eltd-new-listing-item">

		<label for="eltd_listing_video">
			<?php esc_html_e( 'Listing Video', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_video" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_video' ); ?>"
			       placeholder="<?php esc_html_e( 'e.g. videourl.com (You Tube or Vimeo url)', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_audio == 'yes' ) : ?>
	<div class="eltd-new-listing-item">

		<label for="eltd_listing_audio">
			<?php esc_html_e( 'Listing Audio', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_audio" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_audio' ); ?>"
			       placeholder="<?php esc_html_e( 'e.g. audiourl.com', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_phone == 'yes' ) : ?>
	<div class="eltd-new-listing-item">

		<label for="eltd_listing_phone">
			<?php esc_html_e( 'Listing Phone', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_phone" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_phone' ); ?>"
			       placeholder="<?php esc_html_e( 'e.g. (385) 567-2187', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_website == 'yes' ) : ?>
	<div class="eltd-new-listing-item">

		<label for="eltd_listing_website">
			<?php esc_html_e( 'Listing Website', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_website" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_website' ); ?>"
			       placeholder="<?php esc_html_e( 'e.g. yourwebsite.com', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_work_hours == 'yes' ) : ?>
	<div class="eltd-new-listing-item">


		<label for="eltd_listing_open_hours">
			<?php esc_html_e( 'Working Hours', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<textarea name="eltd_listing_open_hours" id="listing_open_hours" class="eltd-textarea-field"
			          placeholder="<?php esc_html_e( 'Mon-Fri: 09:00-24:00 Sat-Sun: 12:00-02:00', 'eltd_listing' ) ?>"><?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_open_hours' ); ?></textarea>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_email == 'yes' ) : ?>
	<div class="eltd-new-listing-item">


		<label for="eltd_listing_open_hours">
			<?php esc_html_e( 'Email', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_email" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_email' ); ?>"
			       placeholder="<?php esc_html_e( 'e.g. mailaddress@mailserver.com', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_price == 'yes' ) : ?>
	<div class="eltd-new-listing-item">


		<label for="eltd_listing_open_hours">
			<?php esc_html_e( 'Price', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_price" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_price' ); ?>"
			       placeholder="<?php esc_html_e( 'e.g 100$', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_instagram == 'yes' ) : ?>
	<div class="eltd-new-listing-item">


		<label for="eltd_listing_open_hours">
			<?php esc_html_e( 'Instagram Username', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_instagram_username" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_instagram_username' ); ?>"
			       placeholder="<?php esc_html_e( 'Enter Instagram Username', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_booking_form == 'yes' ) : ?>
	<div class="eltd-new-listing-item">


		<label for="eltd_listing_open_hours">
			<?php esc_html_e( 'Open Table ID', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-profile-input">
			<input name="eltd_listing_open_table_id" type="text" class="eltd-input-field"
			       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_open_table_id' ); ?>"
			       placeholder="<?php esc_html_e( 'Enter Open Table ID', 'eltd_listing' ) ?>"/>
		</div>

	</div>
<?php endif; ?>

<?php if ( $show_social_icons == 'yes' ) : ?>
	<div class="eltd-new-listing-item">

		<label>
			<?php esc_html_e( 'Enter Profile URL', 'eltd_listing' ); ?>
		</label>

		<div class="eltd-social-profiles-icons clearfix">
			<?php
			foreach ( $social as $key => $value ) {
				$field_value  = eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_social_' . esc_attr( strtolower( $key ) ) );
				$active_class = $field_value !== '' ? 'active' : '';
				?>
				<div class="eltd-social-profiles-icon <?php echo $active_class; ?>" data-input="<?php echo $key; ?>">
					<?php
					if ( $key !== 'yahoo' && $key !== 'soundcloud' ) {
						if ( eltd_listing_theme_installed() ) {
							echo search_and_go_elated_icon_collections()->renderIcon( 'social_' . $key, 'font_elegant' );
						}
					} else {
						//yahoo and soundcloud from font-awesome
						if ( eltd_listing_theme_installed() ) {
							echo search_and_go_elated_icon_collections()->renderIcon( 'fa-' . $key, 'font_awesome' );
						}
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<div class="eltd-social-proiles-input-holder">
			<?php foreach ( $social as $key => $value ):
				$field_value = eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_social_' . esc_attr( strtolower( $key ) ) );
				$active_class = $field_value !== '' ? 'active' : '';
				?>
				<div class="eltd-social-profiles-input <?php echo $key . ' ' . $active_class; ?>">
					<label for="eltd_listing_social_<?php echo esc_attr( strtolower( $key ) ); ?>">
						<?php echo esc_attr( ucwords( $value ) ); ?>
					</label>
					<div class="eltd-profile-input">
						<input name="eltd_listing_social_<?php echo esc_attr( strtolower( $key ) ); ?>" type="text"
						       class="eltd-input-field"
						       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_social_' . esc_attr( strtolower( $key ) ) ); ?>"
						       placeholder="<?php esc_html_e( 'e.g. socialprofileurl.com', 'eltd_listing' ) ?>"/>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif;
