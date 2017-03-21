<?php
$listing_type_id            = get_post_meta( get_the_ID(), 'eltd_listing_item_type', true );
$listing_type_custom_fields = get_post_meta( $listing_type_id, 'eltd_listing_type_custom_fields', true );

$listing_custom_fields = array();

if ( is_array( $listing_type_custom_fields ) && count( $listing_type_custom_fields ) ) {

	foreach ( $listing_type_custom_fields as $custom_field ) {
		if ( get_post_meta( get_the_ID(), $custom_field['meta_key'], true ) != '' ) {
			$listing_custom_fields[] = array(
				'label'     => $custom_field['title'],
				'value'     => get_post_meta( get_the_ID(), $custom_field['meta_key'], true ),
				'type'      => $custom_field['type'],
				'icon_pack' => isset( $custom_field['icon_pack'] ) ? $custom_field['icon_pack'] : '',
				'icon'      => isset( $custom_field['icon'] ) ? $custom_field['icon'] : ''
			);
		}
	}

}

if ( is_array( $listing_custom_fields ) && count( $listing_custom_fields ) ) { ?>

	<div class="eltd-listing-custom-fields eltd-listing-part">

		<h5>
			<?php esc_html_e( 'Specification', 'search-and-go' ); ?>
		</h5>

		<?php

		foreach ( $listing_custom_fields as $field ) {
			if ( $field['type'] == 'checkbox' ) {
				if ( $field['value'] == '1' ) { ?>
					<span class="eltd-listing-custom-field">
						<span class="eltd-listing-custom-field-icon">
							<?php echo search_and_go_elated_icon_collections()->renderIcon( $field['icon'], $field['icon_pack'] ); ?>
						</span>
						<span><?php echo esc_attr( $field['label'] ); ?></span>
					</span>
				<?php }
			} else {
				if ( $field['value'] !== '' ) { ?>
					<span class="eltd-listing-custom-field">
						<span class="eltd-listing-custom-field-icon">
							<?php echo search_and_go_elated_icon_collections()->renderIcon( $field['icon'], $field['icon_pack'] ); ?>
						</span>
						<span><?php echo esc_attr( $field['label'] ); ?>:<span><?php echo esc_attr( $field['value'] ); ?></span></span>
				</span>
				<?php }
			}
		} ?>

	</div>

<?php }