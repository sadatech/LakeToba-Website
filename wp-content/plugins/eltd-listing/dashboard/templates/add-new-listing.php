<?php
	echo eltd_listing_dashboard_page_top_area( esc_html__( 'Submit New Listing', 'eltd_listing' ), esc_html__( $subtitle_text, 'eltd_listing' ) );
?>


	<form method="post" class="eltd-new-listing-form" enctype="multipart/form-data"
	      action="<?php echo eltd_listing_get_dashboard_page_url(); ?>?user-action=add_new_listing">

		<div class="eltd-new-listing-info">

			<div class="eltd-new-listing-info-list">

				<div class="eltd-new-listing-item">

					<label for="listing_title">
						<?php esc_html_e( 'Listing Name', 'eltd_listing' ); ?>
						<span class="eltd-listing-required-field">*</span>
					</label>

					<div class="eltd-profile-input">
						<input name="post_title" type="text" id="post_title" class="eltd-input-field" value=""
						       placeholder="<?php esc_html_e( 'e.g. Apocalyptus', 'eltd_listing' ); ?>"/>
					</div>

				</div>


				<div class="eltd-new-listing-item">

					<label for="eltd_listing_subtitle">
						<?php esc_html_e( 'Listing Subtitle', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input">
						<input name="eltd_listing_subtitle" type="text" id="eltd-listing-subtitle"
						       class="eltd-input-field" value=""
						       placeholder="<?php esc_html_e( 'e.g. Apocalyptus', 'eltd_listing' ); ?>"/>
					</div>

				</div>


				<div class="eltd-new-listing-item">

					<label for="eltd-listing-description">
						<?php esc_html_e( 'Description', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input eltd-listing-description">
						<?php wp_editor( '', 'listing_content' ); ?>
					</div>

				</div>

				<div class="eltd-new-listing-item">

					<label for="eltd-listing-excerpt">
						<?php esc_html_e( 'Excerpt', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input">
						<textarea name="eltd_listing_excerpt" id="eltd_listing_excerpt" class="eltd-textarea-field"
						          placeholder="<?php esc_html_e( 'Listing Excerpt', 'eltd_listing' ) ?>"></textarea>
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

							<div class="eltd-media-holder clearfix"></div>
							<div class="eltd-action-buttons">
								<a href="javascript: void(0)" data-multiple='false'
								   data-frame-title="<?php esc_html_e( 'Select Image', 'eltd_listing' ); //TODO Change to function for button?>"
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

							<input type="hidden" class="eltd-media-uploader-input eltd-media-thumbnail" value=""
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

							<div class="eltd-media-holder clearfix"></div>
							<div class="eltd-action-buttons">
								<a href="javascript: void(0)" data-multiple='false'
									data-frame-title="<?php esc_html_e( 'Select Image', 'eltd_listing' );?>"
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

							<input type="hidden" class="eltd-media-uploader-input eltd-media-thumbnail" value=""
								name="eltd_title_area_background_image_meta">

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

						echo eltd_listing_get_dropdown_tax_terms( $location_args ); ?>
					</div>

				</div>
				<div class="eltd-new-listing-item">

					<label for="eltd-input-address" class="eltd-label-with-margin">
						<?php esc_html_e( 'Address', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input" class="eltd-label-with-margin">
						<input type="text" id="eltd-input-address" class="eltd-input-field"
						       name="eltd_listing_address" value=""
						       placeholder="<?php echo esc_attr( 'e.g London', 'eltd_listing' ) ?>"/>
					</div>

					<label for="eltd-input-latitude" class="eltd-label-with-margin">
						<?php esc_html_e( 'Latitude', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input eltd-latitude-holder">
						<input type="text" id="eltd-input-latitude" class="eltd-input-field eltd-latitude"
						       name="eltd_listing_address_latitude" value="" readonly="readonly"/>
					</div>

					<label for="eltd-input-longitude" class="eltd-label-with-margin">
						<?php esc_html_e( 'Longitude', 'eltd_listing' ); ?>
					</label>

					<div class="eltd-profile-input eltd-longitude-holder">
						<input type="text" id="eltd-input-longitude" class="eltd-input-field eltd-longitude"
						       name="eltd_listing_address_longitude" value="" readonly="readonly"/>
					</div>

					<div id="map" style="min-height: 300px;"></div>
				</div>

				<?php
				eltd_listing_listing_types();
				eltd_listing_listing_packages();
				?>

				<div class="eltd-listing-submit-holder">
					<?php
					if ( eltd_listing_theme_installed() ) {
						echo search_and_go_elated_get_button_html(
							array(
								'text'         => esc_html__( 'Add Listing', 'eltd_listing' ),
								'html_type'    => 'button',
								'type'         => 'solid',
								'custom_class' => 'eltd-listing-submit-listing'
							)
						);
					}
					?>
					<?php wp_nonce_field( 'eltd-ajax-add-listing-nonce', 'eltd-add-listing-security' ); ?>
				</div>

			</div>
		</div>
	</form>
<?php

do_action( 'eltd_listing_action_listing_ajax_response' );
