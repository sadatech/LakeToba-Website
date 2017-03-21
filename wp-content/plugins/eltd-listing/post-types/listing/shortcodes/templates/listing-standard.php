<article class="eltd-listing-list-item">
	<?php if ( has_post_thumbnail() ) {
		$image_id = get_post_thumbnail_id();
		$image = wp_get_attachment_image_src($image_id, 'medium');
		?>
		<div class="eltd-listing-item-image" style="background-image: url(<?php echo esc_url($image[0]) ?>);">

		</div>
	<?php } ?>
	<div class="eltd-listing-item-content">
		<?php
		if ( eltd_listing_theme_installed() ) {
			search_and_go_elated_listing_get_info_part('title-list');
			search_and_go_elated_listing_get_info_part('address');
			search_and_go_elated_listing_get_info_part('content');
			search_and_go_elated_listing_get_info_part('rating');
			search_and_go_elated_listing_get_info_part('custom-fields');
			search_and_go_elated_listing_get_info_part('price');
		}
		?>
	</div>
</article>