<?php
$open_table_id = '';
$listing_type_id = get_post_meta(get_the_ID(), 'eltd_listing_item_type', true);
$booking_enabled = get_post_meta( $listing_type_id, 'eltd_listing_type_show_booking_form', true ) == 'yes' ? true : false;
if ( $booking_enabled ) {
    $open_table_id = get_post_meta( get_the_ID(), 'eltd_listing_open_table_id', true );
}
if ( $open_table_id !== '' ) { ?>
	<div class="eltd-listing-item-booking">
	    <h5><?php esc_html_e('Book a table online', 'search-and-go'); ?></h5>
	    <?php
	    if ( search_and_go_elated_booking_plugin_installed() ) {
		    echo search_and_go_elated_execute_shortcode( 'eltd_reservation_form', array(
			    'open_table_id' => $open_table_id
		    ) );
	    } else { ?>
		    <p>Please install Elated Booking Plugin</p>
		    <?php
	    }
	    ?>
	</div>
<?php } ?>