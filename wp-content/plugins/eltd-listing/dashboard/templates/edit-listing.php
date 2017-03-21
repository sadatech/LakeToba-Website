<?php
	echo eltd_listing_dashboard_page_top_area( esc_html__( 'Edit Listing', 'eltd_listing' ), esc_html__( $subtitle_text, 'eltd_listing' ) );
?>

	<form method="post" class="eltd-edit-listing-form" enctype="multipart/form-data"
	      action="<?php echo eltd_listing_get_dashboard_page_url(); ?>?user-action=add_new_listing">
		<div class="eltd-new-listing-info">
			<div class="eltd-new-listing-info-list">
				<div class="eltd-new-listing-item">

					<label for="listing_title">
						<?php esc_html_e( 'Listing Name', 'eltd_listing' ); ?>
						<span class="eltd-listing-required-field">*</span>
					</label>

					<div class="eltd-profile-input">
						<input name="post_title" type="text" id="post_title" class="eltd-input-field"
						       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'post_title', false, '', 'title' ) ?>"/>
					</div>

				</div>

				<div class="eltd-new-listing-item">

					<label for="eltd_listing_subtitle">
						<?php esc_html_e( 'Listing Subtitle', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input">
						<input name="eltd_listing_subtitle" type="text" class="eltd-input-field"
						       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_subtitle' ); ?>"/>
					</div>

				</div>

				<div class="eltd-new-listing-item">

					<label for="eltd-listing-description">
						<?php esc_html_e( 'Description', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input">
						<?php wp_editor( eltd_listing_check_listing_fields_values( $listing_ID, 'post_content', false, '', 'content' ), 'listing_content' ); ?>
					</div>

				</div>

				<div class="eltd-new-listing-item">

					<label for="eltd-listing-excerpt">
						<?php esc_html_e( 'Excerpt', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input">
						<?php
						$value = eltd_listing_check_listing_fields_values( $listing_ID, 'post_excerpt', false, '', 'excerpt' );
						?>
						<textarea name="eltd_listing_excerpt" id="eltd_listing_excerpt" class="eltd-textarea-field"
						          placeholder="<?php esc_html_e( 'Listing Excerpt', 'eltd_listing' ) ?>">
						<?php echo esc_attr( $value ); ?>
					</textarea>
					</div>

				</div>

				<div class="eltd-new-listing-item eltd-media-uploader-holder">

					<label for="eltd-listing-description">
						<?php esc_html_e( 'Featured Image', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-media-uploader-buttons-wrapper">

						<div class="eltd-media-uploader-icon-holder">
							<?php
							if ( eltd_listing_theme_installed() ) {
								echo search_and_go_elated_execute_shortcode( 'eltd_icon', $media_icon_params );
							}
							?>
						</div>

						<div class="eltd-media-uploader-button-holder">

							<div class="eltd-media-holder clearfix">
								<?php echo wp_get_attachment_image( eltd_listing_check_listing_fields_values( $listing_ID, '_thumbnail_id' ) ); ?>
							</div>
							<div class="eltd-action-buttons">
								<a href="javascript: void(0)" data-multiple='false'
								   data-frame-title="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"
								   data-frame-button-text="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"
								   class="eltd-upload-button">
									<?php
									if ( eltd_listing_theme_installed() ) {
										echo search_and_go_elated_icon_collections()->renderIcon( 'icon_plus', 'font_elegant' );
									}
									?>
								</a>
								<a href="javascript: void(0)" class="eltd-remove-button">
									<?php
									if ( eltd_listing_theme_installed() ) {
										echo search_and_go_elated_icon_collections()->renderIcon( 'icon_close', 'font_elegant' );
									}
									?>
								</a>
							</div>

							<input type="hidden" class="eltd-media-uploader-input eltd-media-thumbnail"
							       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, '_thumbnail_id' ); ?>"
							       name="_thumbnail_id">

						</div>

					</div>

				</div>

				<div class="eltd-new-listing-item eltd-media-uploader-holder">

					<label for="eltd-listing-description">
						<?php esc_html_e( 'Title Background Image', 'eltd_listing' ); ?>
					</label>
					<div class="eltd-media-uploader-buttons-wrapper">

						<div class="eltd-media-uploader-icon-holder">
							<?php
							if ( eltd_listing_theme_installed() ) {
								echo search_and_go_elated_execute_shortcode( 'eltd_icon', $media_icon_params );
							}
							?>
						</div>

						<div class="eltd-media-uploader-button-holder">

							<div class="eltd-media-holder clearfix">
								<?php
									echo '<img src="'.eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_title_area_background_image_meta' ).'"/>'
								?>
							</div>
							<div class="eltd-action-buttons">
								<a href="javascript: void(0)" data-multiple='false'
									data-frame-title="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"
									data-frame-button-text="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"
									class="eltd-upload-button">
									<?php
									if ( eltd_listing_theme_installed() ) {
										echo search_and_go_elated_icon_collections()->renderIcon( 'icon_plus', 'font_elegant' );
									}
									?>
								</a>
								<a href="javascript: void(0)" class="eltd-remove-button">
									<?php
									if ( eltd_listing_theme_installed() ) {
										echo search_and_go_elated_icon_collections()->renderIcon( 'icon_close', 'font_elegant' );
									}
									?>
								</a>
							</div>

							<input type="hidden" class="eltd-media-uploader-input eltd-media-thumbnail"
								value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_title_area_background_image_meta' ); ?>"
								name="eltd_title_area_background_image_meta">
							<input type="hidden" class="eltd-media-uploader-input eltd-media-thumbnail"
								value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_title_area_background_image_meta_id' ); ?>"
								name="eltd_title_area_background_image_meta_id">

						</div>

					</div>
				</div>
				<div class="eltd-new-listing-item">

					<label for="listing_location">
						<?php esc_html_e( 'Locations', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input">
						<?php
						//set meta query to get listing location
						$location_args = eltd_listing_get_location_args();
						$location_args['defaults'] =  search_and_go_elated_get_taxonomy_defaults($listing_ID, 'listing-item-location');

						echo eltd_listing_get_dropdown_tax_terms( $location_args ); ?>
					</div>

				</div>
				<div class="eltd-new-listing-item">


					<label for="eltd-input-address" class="eltd-label-with-margin">
						<?php esc_html_e( 'Address', 'eltd_listing' ); ?>
					</label>


					<div class="eltd-profile-input" class="eltd-label-with-margin">
						<input type="text" id="eltd-input-address" class="eltd-input-field"
						       name="eltd_listing_address"
						       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_address' ); ?>"
						       placeholder="<?php echo esc_attr( 'e.g London', 'eltd_listing' ) ?>"/>
					</div>

					<label for="eltd-input-latitude" class="eltd-label-with-margin">
						<?php esc_html_e( 'Latitude', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input eltd-latitude-holder">
						<input type="text" id="eltd-input-latitude" class="eltd-input-field eltd-latitude"
						       name="eltd_listing_address_latitude"
						       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_address_latitude' ); ?>"
						       readonly="readonly"/>
					</div>

					<label for="eltd-input-longitude" class="eltd-label-with-margin">
						<?php esc_html_e( 'Longitude', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input eltd-longitude-holder">
						<input type="text" id="eltd-input-longitude" class="eltd-input-field eltd-longitude"
						       name="eltd_listing_address_longitude"
						       value="<?php echo eltd_listing_check_listing_fields_values( $listing_ID, 'eltd_listing_address_longitude' ); ?>"
						       readonly="readonly"/>
					</div>

					<div id="map" style="min-height: 300px;"></div>
				</div>
				<?php

				eltd_listing_listing_types( $listing_ID );
				$package_id = get_post_meta( $listing_ID, 'eltd_listing_package', true );
				eltd_listing_listing_packages( $package_id );

				?>
				<div class="eltd-listing-submit-holder">
					<input type="hidden" value="<?php echo esc_attr( $listing_ID ); ?>" name="post_id"/>
					<?php
					if ( eltd_listing_theme_installed() ) {
						echo search_and_go_elated_get_button_html(
							array(
								'text'      => esc_html__( 'Save Listing', 'themanametd' ),
								'html_type' => 'button',
								'type'      => 'solid',
							)
						);
					}
					?>
					<?php wp_nonce_field( 'eltd-ajax-edit-listing-nonce', 'eltd-edit-listing-security' ); ?>
				</div>

			</div>
		</div>
	</form>
<?php
do_action( 'eltd_listing_action_listing_ajax_response' );

