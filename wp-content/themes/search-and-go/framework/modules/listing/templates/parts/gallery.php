<?php
$post_type_id = get_post_meta(get_the_ID(),'eltd_listing_item_type',true);

if(isset($post_type_id) && $post_type_id !== ''){
	
	$show_gallery = get_post_meta($post_type_id,'eltd_listing_type_show_gallery',true);
	
	if($show_gallery == 'yes'){
		
		$image_gallery_val = get_post_meta(get_the_ID(), 'eltd_listing_gallery_images_meta', true );

		if($image_gallery_val !== ''){ ?>

			<div class="eltd-listing-image-gallery eltd-listing-part">
				<div class="eltd-listing-gallery">

					<?php
					if($image_gallery_val != '' ) {
						$image_gallery_array = explode(',',$image_gallery_val);
					}

					if(isset($image_gallery_array) && count($image_gallery_array)!= 0):

						foreach($image_gallery_array as $gimg_id): 

						?>
							<div class="eltd-listing-gallery-slide">
								<?php echo wp_get_attachment_image( $gimg_id, 'search_and_go_elated_listing_gallery', false, array( 'itemprop' => 'image' ) ); ?>
							</div>

						<?php endforeach;

					endif;
					?>

				</div>
			</div>
		<?php }
	}
	
}	
