<?php
if ( eltd_listing_theme_installed() ) {
	$user_social_icons = search_and_go_elated_get_user_custom_fields( $user_id );
} else {
	$user_social_icons = array();
}

echo eltd_listing_dashboard_page_top_area( esc_html__( 'Edit Profile', 'eltd_listing' ), esc_html__( $subtitle_text, 'eltd_listing' ) );
?>

	<div class="eltd-profile-form-holder">
		<span class="eltd-ajax-response-message"></span>
		<form method="POST" id="eltd-profile-form">
			<div class="eltd-profile-meta-info">
				<div class="eltd-profile-meta-info-list">
					<div class="eltd-profile-meta-item">

						<label for="first_name">
							<?php esc_html_e( 'First Name', 'eltd_listing' ); ?>
						</label>

						<div class="eltd-profile-input">
							<input name="first_name" type="text" id="first_name" class="eltd-input-field"
							       value="<?php the_author_meta( 'first_name', $user_id ); ?>"/>
						</div>

					</div>
					<div class="eltd-profile-meta-item">

						<label for="last_name">
							<?php esc_html_e( 'Last Name', 'eltd_listing' ); ?>
						</label>

						<div class="eltd-profile-input">
							<input name="last_name" type="text" id="last_name" class="eltd-input-field"
							       value="<?php the_author_meta( 'last_name', $user_id ); ?>"/>
						</div>

					</div>

					<div class="eltd-profile-meta-item">

						<label for="email">
							<?php esc_html_e( 'Email', 'eltd_listing' ); ?>
						</label>

						<div class="eltd-profile-input">
							<input name="email" type="email" id="email" class="eltd-input-field"
							       value="<?php the_author_meta( 'email', $user_id ); ?>"/>
						</div>

					</div>

					<div class="eltd-profile-meta-item">

						<label for="url">
							<?php esc_html_e( 'Website', 'eltd_listing' ); ?>
						</label>

						<div class="eltd-profile-input">
							<input name="url" type="url" id="url" class="eltd-input-field"
							       value="<?php the_author_meta( 'url', $user_id ); ?>"/>
						</div>

					</div>

					<?php if ( is_array( $user_social_icons ) && count( $user_social_icons ) ) {

						foreach ( $user_social_icons as $network ) { ?>

							<div class="eltd-profile-meta-item">

								<label for="<?php echo esc_attr( $network['name'] ) ?>">
									<?php esc_html_e( $network['name'], 'eltd_listing' ); ?>
								</label>

								<div class="eltd-profile-input">
									<input name="<?php echo esc_attr( $network['name'] ) ?>" type="text"
									       id="<?php echo esc_attr( $network['name'] ) ?>" class="eltd-input-field"
									       value="<?php echo esc_attr( $network['link'] ); ?>"/>
								</div>

							</div>

						<?php } ?>

					<?php } ?>

					<div class="eltd-profile-meta-item">

						<label for="description">
							<?php esc_html_e( 'Description', 'eltd_listing' ); ?>
						</label>

						<div class="eltd-profile-input">
							<textarea name="description" id="description" class="eltd-textarea-field" rows="8"
							          cols="45"><?php the_author_meta( 'description', $user_id ); ?></textarea>
						</div>

					</div>

					<div class="eltd-profile-meta-item">

						<label for="password">
							<?php esc_html_e( 'Password', 'eltd_listing' ); ?>
						</label>

						<div class="eltd-profile-input">
							<input name="password" type="password" id="password" class="eltd-input-field" value=""/>
						</div>

					</div>

					<div class="eltd-profile-meta-item">

						<label for="password">
							<?php esc_html_e( 'Repeat Password', 'eltd_listing' ); ?>
						</label>

						<div class="eltd-profile-input">
							<input name="password2" type="password" id="password2" class="eltd-input-field" value=""/>
						</div>

					</div>

					<div class="eltd-profile-meta-item">
						<button class="eltd-btn eltd-btn-solid"
						        type="submit"><?php esc_html_e( 'Update Profile', 'eltd_listing' ); ?></button>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php

do_action( 'eltd_listing_action_listing_ajax_response' );