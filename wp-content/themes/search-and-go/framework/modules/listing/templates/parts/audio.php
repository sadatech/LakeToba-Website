<?php
$post_type_id = get_post_meta(get_the_ID(),'eltd_listing_item_type',true);

if(isset($post_type_id) && $post_type_id !== ''){
	
	$show_audio = get_post_meta($post_type_id,'eltd_listing_type_show_audio',true);
	
	if($show_audio == 'yes'){
		
		$audio_link = get_post_meta(get_the_ID(), "eltd_listing_audio", true);
		
		if($audio_link !== ""){ ?>

			<div class="eltd-listing-audio-holder eltd-listing-part" itemscope itemtype="http://schema.org/AudioObject">
				
				<audio class="eltd-listing-audio" src="<?php echo esc_url($audio_link) ?>" controls="controls">
					
					<?php esc_html_e("Your browser don't support audio player","search-and-go"); ?>
					
				</audio>
				
			</div>

		<?php }
		
	}
}
	
