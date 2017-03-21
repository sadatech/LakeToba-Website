<?php if ( search_and_go_elated_options()->getOptionValue('enable_listing_item_map') == 'yes' ) {
	$address = get_post_meta( get_the_ID(), 'eltd_listing_address', true ) ? get_post_meta( get_the_ID(), 'eltd_listing_address', true ) : '';
	$latitude = get_post_meta( get_the_ID(), 'eltd_listing_address_latitude', true );
	$longitude = get_post_meta( get_the_ID(), 'eltd_listing_address_longitude', true );
	$get_directions_link = '';
	if ( $latitude !== '' && $longitude !== '' ) {
		$get_directions_link = '//maps.google.com/maps?daddr=' . $latitude . ',' . $longitude;
	}
?>
	<div class="eltd-listing-single-map-holder" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
		<?php echo search_and_go_elated_get_listing_item_map(); ?>
		<div class="eltd-listing-map-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<p><?php echo esc_html( $address ); ?></p>
			<a href="<?php echo esc_url( $get_directions_link );?>" target="_blank">
				<?php echo search_and_go_elated_icon_collections()->renderIcon('icon-map', 'simple_line_icons'); ?>
				<?php esc_html_e( 'Get Directions', 'search-and-go' ); ?>
			</a>
		</div>
	</div>

<?php } ?>
