<?php

$rating = eltd_listing_get_listing_item_rating();
if ( $rating ) {
	$average_rating = $rating['average_rating'];
	$width          = $average_rating * 20;
	$items          = $rating['ratings_count'];
} else {
	$average_rating = null;
	$width          = 0;
	$items          = null;
}
?>
	<div class="eltd-listing-item-rating eltd-listing-part" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<meta itemprop="ratingValue" content="<?php echo $average_rating; ?>">
		<meta itemprop="ratingCount" content="<?php echo $items; ?>">
		<span class="rating-inner" style="width: <?php print $width; ?>%"></span>
	</div>