<?php
$post_type_id = get_post_meta(get_the_ID(),'eltd_listing_item_type',true);

if(isset($post_type_id) && $post_type_id !== ''){
	
	//check yes/no fields set on listing type
	$show_phone = get_post_meta($post_type_id,'eltd_listing_type_show_phone',true);
	$show_website = get_post_meta($post_type_id,'eltd_listing_type_show_website',true);
	$show_work_hours = get_post_meta($post_type_id,'eltd_listing_type_show_work_hours',true);
	
	//check values of this fields on listing
	$listing_phone = get_post_meta(get_the_ID(),'eltd_listing_phone', true);
	$listing_website = get_post_meta(get_the_ID(),'eltd_listing_website', true);
	$listing_work_hours = get_post_meta(get_the_ID(),'eltd_listing_open_hours', true);
	
	
	if($show_phone == 'yes' || $show_website == 'yes' || $show_work_hours == 'yes'){?>
		
		<div class="eltd-listing-basic-info eltd-listing-part clearfix">
			<!--render phone html-->
			<?php if($show_phone == 'yes' && $listing_phone !== ''){ ?>
				<span class = "eltd-listing-phone" itemprop="telephone">
					<?php echo esc_attr($listing_phone);?>
				</span>
			<?php } ?>

			<!--render website html-->
			<?php if($show_website == 'yes' && $listing_website !== ''){ ?>
				<a href="<?php echo esc_attr($listing_website) ?>" class = "eltd-listing-website" target="_blank" itemprop="url">
					<?php echo esc_attr($listing_website);?>
				</a>
			<?php } ?>
				
			<!--render website work hours-->
			<?php if($show_work_hours == 'yes' && $listing_work_hours !== ''){ //TODO set datetime property ?>
				<span class = "eltd-listing-work-hours">
					<time itemprop="openingHours" datetime="">
						<?php echo esc_attr($listing_work_hours) ;?>
					</time>
				</span>
			<?php } ?>
		</div>	
		
	<?php }
	
}