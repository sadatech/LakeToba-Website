<?php
$icon_color = '#1ab5c1';
if ( search_and_go_elated_options()->getOptionValue( 'first_color' ) !== '' ) {
	$icon_color = search_and_go_elated_options()->getOptionValue( 'first_color' );
}

$view_icon_params   = array(
	'icon_pack'   => 'linea_icons',
	'linea_icon'  => 'icon-basic-eye',
	'custom_size' => '19',
	'icon_color'  => $icon_color
);
$edit_icon_params   = array(
	'icon_pack'   => 'linea_icons',
	'linea_icon'  => 'icon-software-pencil',
	'custom_size' => '19',
	'icon_color'  => $icon_color
);
$delete_icon_params = array(
	'icon_pack'   => 'linea_icons',
	'linea_icon'  => 'icon-basic-trashcan',
	'custom_size' => '19',
	'icon_color'  => $icon_color
);
?>


<li class="eltd-listing-package-list-item clearfix">

	<div class="eltd-listing-package-list-part">
		<a href="<?php echo esc_url($link); ?>" target="_blank">
			<?php echo esc_html($title); ?>
		</a>
	</div>

	<div class="eltd-listing-package-list-part">
			<span>
				<?php if ( $status == 'publish' ) {
					esc_html_e( 'Published', 'eltd_listing' );
				} else if ( $status == 'pending' ) {
					esc_html_e( 'Pending Review', 'eltd_listing' );
				} ?>
			</span>
	</div>

	<div class="eltd-listing-package-list-part clearfix">
		<a class="eltd-view-listing eltd-listing-item-inner-part" href="<?php echo esc_url($link); ?>">
				<span class="eltd-listing-user-action-icon">
					<?php
					if ( eltd_listing_theme_installed() ) {
						echo search_and_go_elated_execute_shortcode( 'eltd_icon', $view_icon_params );
					}
					?>
				</span>
				<span class="eltd-listing-user-action-text">
						<?php esc_html_e( $view_text, 'eltd_listing' ) ?>
				</span>
		</a>
		<a class="eltd-edit-listing eltd-listing-item-inner-part" href="<?php echo esc_url( add_query_arg( array(
			'user-action' => 'edit_listing',
			'listing-id'  => $listing_id
		), eltd_listing_get_dashboard_page_url() ) ) ?>">
				<span class="eltd-listing-user-action-icon">
					<?php
					if ( eltd_listing_theme_installed() ) {
						echo search_and_go_elated_execute_shortcode( 'eltd_icon', $edit_icon_params );
					}
					?>
				</span>
				<span class="eltd-listing-user-action-text">
						<?php esc_html_e( 'Edit', 'eltd_listing' ) ?>
				</span>
		</a>
		<a class="eltd-delete-listing eltd-listing-item-inner-part" href="" data-listing-id= <?php echo esc_attr( $listing_id ) ?>>
				<span class="eltd-listing-user-action-icon">
					<?php
					if ( eltd_listing_theme_installed() ) {
						echo search_and_go_elated_execute_shortcode( 'eltd_icon', $delete_icon_params );
					}
					?>
				</span>
				<span class="eltd-listing-user-action-text">
						<?php esc_html_e( 'Delete', 'eltd_listing' ) ?>
				</span>
		</a>
	</div>
</li>
