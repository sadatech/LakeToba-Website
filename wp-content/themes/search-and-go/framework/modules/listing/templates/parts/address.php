<span class="eltd-listing-item-address">
	<?php
	$address = get_post_meta(get_the_ID(), 'eltd_listing_address', true);
	?>
	<span><?php echo esc_html($address); ?></span>
</span>