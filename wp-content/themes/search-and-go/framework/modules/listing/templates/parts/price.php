<?php

$listing_type_id = get_post_meta(get_the_ID(), 'eltd_listing_item_type', true);
$show_price = get_post_meta($listing_type_id, 'eltd_listing_type_show_price', true);

if($show_price == 'yes'){
	
	$price = get_post_meta(get_the_ID(), 'eltd_listing_price', true);
	
	if($price !== ""){ ?>

		<div class="eltd-listing-price-holder eltd-listing-part" itemscope itemtype="http://schema.org/AudioObject">
			<h4>
				<?php esc_html_e('Price: ', 'search-and-go'); ?>
			</h4>
			<span>
				
				<?php echo esc_attr($price)?>
				
			</span>		

		</div>

	<?php }
	
}

