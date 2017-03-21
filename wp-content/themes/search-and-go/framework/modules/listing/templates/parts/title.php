<?php
$categories   = wp_get_post_terms(get_the_ID(), 'listing-item-category');
?>
<div class="eltd-listing-title-holder eltd-listing-part">
	<div class="eltd-listing-title-category">
		<?php search_and_go_elated_listing_get_info_part('categories'); ?>
		<h2 class="eltd-listing-title" itemprop="name">
			<?php the_title(); ?>
		</h2>
	</div>
	<div class="eltd-listing-rating-info clearfix">
		<?php
		search_and_go_elated_listing_get_info_part('wishlist');//Different wishlist button html for single item
		search_and_go_elated_listing_get_info_part('rating');
		search_and_go_elated_listing_get_info_part('category-icons');
		?>
	</div>
</div>