<?php
$subtitle     = get_post_meta( get_the_ID(), 'eltd_listing_subtitle', true );
$post_type_id = get_post_meta( get_the_ID(), 'eltd_listing_item_type', true );
?>
<div class="eltd-listing-item-info">
	<div class="eltd-listing-item-subtitle-address">
		<h6 class="eltd-listing-subititle" itemprop="description">
			<?php echo esc_html( $subtitle ); ?>
			<?php search_and_go_elated_listing_get_info_part( 'address' ); ?>
		</h6>
	</div>
	<div class="eltd-listing-item-open-hours">
		<?php
		if ( isset( $post_type_id ) && $post_type_id !== '' ) {
			//check yes/no fields set on listing type
			$show_phone      = get_post_meta( $post_type_id, 'eltd_listing_type_show_phone', true );
			$show_website    = get_post_meta( $post_type_id, 'eltd_listing_type_show_website', true );
			$show_work_hours = get_post_meta( $post_type_id, 'eltd_listing_type_show_work_hours', true );

			//check values of this fields on listing
			$listing_phone      = get_post_meta( get_the_ID(), 'eltd_listing_phone', true );
			$listing_website    = get_post_meta( get_the_ID(), 'eltd_listing_website', true );
			$listing_work_hours = get_post_meta( get_the_ID(), 'eltd_listing_open_hours', true );

			if ( $show_phone == 'yes' && $listing_phone !== '' ) { ?>
				<div class="eltd-listing-phone" itemprop="telephone">
					<span><?php esc_html_e('Call us anytime', 'search-and-go'); ?></span> <?php echo esc_attr( $listing_phone ); ?>
				</div>
			<?php } ?>

			<!--render website html-->
			<?php if ( $show_website == 'yes' && $listing_website !== '' ) { ?>
				<a href="<?php echo esc_attr( $listing_website ) ?>" class="eltd-listing-website" target="_blank" itemprop="url">
					<?php echo esc_attr( $listing_website ); ?>
				</a>
			<?php } ?>

			<!--render website work hours-->
			<?php if ( $show_work_hours == 'yes' && $listing_work_hours !== '' ) { //TODO set datetime property ?>
				<span class="eltd-listing-work-hours">
					<span itemprop="openingHours">
						<?php echo esc_attr( $listing_work_hours ); ?>
					</span>
				</span>
			<?php }
		} ?>
	</div>
</div>