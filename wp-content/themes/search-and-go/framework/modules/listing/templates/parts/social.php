<?php

$post_type_id = get_post_meta(get_the_ID(),'eltd_listing_item_type',true);

if(isset($post_type_id) && $post_type_id !== ''){
	
	$show_social_icons = get_post_meta($post_type_id,'eltd_listing_type_show_social_icons',true);
	
	if($show_social_icons == 'yes'){		
		
		//get all social icons set for choosen listing
		$social_list_icons = search_and_go_elated_get_listing_social_custom_fields(get_the_ID());
		
		if(is_array($social_list_icons) && count($social_list_icons)){ ?>

			<div class ="eltd-listing-social-holder eltd-listing-part clearfix">

				<h5><?php esc_html_e('Social Profiles', 'search-and-go'); ?></h5>
				<?php foreach($social_list_icons as $social_icon){ ?>

					<a href="<?php echo esc_attr($social_icon['link'])?>" target="blank" itemprop="url">

						<span class="<?php echo esc_attr($social_icon['class'])?>"></span>

					</a>

				<?php }?>						
			</div>	

		<?php } 
		
	}

}



