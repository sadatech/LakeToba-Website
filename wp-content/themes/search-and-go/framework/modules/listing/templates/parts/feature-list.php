<?php
$listing_type_id = get_post_meta(get_the_ID(), 'eltd_listing_item_type', true);
$listing_type_feature_list = get_post_meta($listing_type_id, 'eltd_listing_type_feature_list', true);

$listing_features = array();

if(is_array($listing_type_feature_list) && count($listing_type_feature_list)){
	
	foreach ($listing_type_feature_list as $feature_value){
		
		
		if(get_post_meta(get_the_ID(), 'listing_feature_list_'.$listing_type_id.'_'.sanitize_title($feature_value), true) === '1'){
			
			$listing_features[] = $feature_value;

		}		
		
	}
}

if(is_array($listing_features) && count($listing_features)){	?>
	
	<div class="eltd-listing-feature-list eltd-listing-part">
		
		<h5>
			<?php esc_html_e('Amenities', 'search-and-go'); ?>
		</h5>
		
		<?php

		foreach($listing_features as $feature){	?>
		
			<span itemprop="additionalProperty">
				<?php echo esc_attr($feature); ?>
			</span>
		
		<?php } ?>
		
	</div>

<?php }