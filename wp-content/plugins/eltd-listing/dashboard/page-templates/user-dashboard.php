<?php
/**
 * Template Name: User Dashboard
 */
get_header();
if ( eltd_listing_theme_installed() ) {
	search_and_go_elated_get_title();
	$overlapping_content = search_and_go_elated_options()->getOptionValue('overlapping_content') == 'yes' ? true : false;
	$subtitle_text = search_and_go_elated_options()->getOptionValue('dashboard_login_text');
} else {
	$overlapping_content = false;
	$subtitle_text = '';
}

$url = eltd_listing_get_dashboard_page_url();

?>
<div class="eltd-container">
	
	<?php if ( $overlapping_content ) { ?>
		<div class="eltd-overlapping-content">
	<?php } ?>

	<div class="eltd-container-inner">
		<?php if(is_user_logged_in()) {
			eltd_listing_get_profile_pages();
		} else { ?>
		<div class="eltd-listing-dashboard-holder-outer">
			<?php
				echo eltd_listing_dashboard_page_top_area(esc_html__('Log in to your Account', 'eltd_listing'),esc_html__($subtitle_text, 'eltd_listing'));
			?>
			<div class="eltd-login-content">
				<div class="eltd-login-title"><?php esc_html_e('Sign up', 'eltd_listing') ?></div>
				<div class="eltd-login-content-inner eltd-login-content-action">
					<div class="eltd-wp-login-holder">
						<?php
						if ( eltd_listing_theme_installed() ) {
						echo search_and_go_elated_execute_shortcode( 'eltd_user_login', array() );
						}
						?>
					</div>
				</div>
				<div class="eltd-register-content-inner eltd-register-content eltd-register-content-action">
					<div class="eltd-wp-register-holder">
						<?php
						if ( eltd_listing_theme_installed() ) {
							echo search_and_go_elated_execute_shortcode( 'eltd_user_register', array() );
						}
						?>
					</div>
				</div>
				<div class="eltd-reset-pass-content-inner eltd-reset-pass-content eltd-reset-pass-content-action">
					<div class="eltd-wp-reset-pass-holder">
						<?php
						if ( eltd_listing_theme_installed() ) {
							echo search_and_go_elated_execute_shortcode( 'eltd_user_reset_password', array() );
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php }
		?>
	</div>
			
	<?php if ( $overlapping_content ) { ?>
		</div>
	<?php } ?>
	
</div>
<?php get_footer(); ?>
