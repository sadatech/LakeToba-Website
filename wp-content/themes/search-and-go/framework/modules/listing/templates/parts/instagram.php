<?php
$post_type_id = get_post_meta(get_the_ID(),'eltd_listing_item_type',true);
if(isset($post_type_id) && $post_type_id !== '') {
	$show_instagram = get_post_meta($post_type_id,'eltd_listing_type_show_instagram',true);
	if ( $show_instagram == 'yes' ) { ?>
		<div class="eltd-listing-social-instagram">
			<?php
			$username = get_post_meta( get_the_ID(), 'eltd_listing_instagram_username', true );
			if ( $username ) {
				if ( ! class_exists( 'ElatedInstagramApi' ) ) {
					echo '<h5>' . esc_html__('Please install Elated Instagram Feed Plugin', 'search-and-go') . '</h5>';
					return;
				}
				$instagram_api = ElatedInstagramApi::getInstance();
				if ( ! $instagram_api->hasUserConnected() ) {
					echo '<h5>' . esc_html__('Please connect with Instagram', 'search-and-go') . '</h5>';
					return;
				}
				$user_instagram_id = $instagram_api->getUserIDFromUsername( $username );
				$number_of_photos = 6;
				$transient_name = sanitize_title( get_the_title().get_the_ID() );
				$transient_time = 0; //in seconds, refresh images time
				$image_size = 'low_resolution';
				$images_array = $instagram_api->getImages($number_of_photos, '', $user_instagram_id, array(
					'use_transients' => true,
					'transient_name' => $transient_name,
					'transient_time' => $transient_time
				));
				?>
				<h5>
					<?php esc_html_e('Follow us on Instagram', 'search-and-go'); ?>
				</h5>
				<ul class="eltd-listing-instagram-images clearfix">
					<?php foreach ($images_array as $image) { ?>
						<li>
							<a href="<?php echo esc_url($instagram_api->getHelper()->getImageLink($image)); ?>" target="_blank">
								<?php echo search_and_go_elated_kses_img($instagram_api->getHelper()->getImageHTML($image, $image_size)); ?>
							</a>
						</li>
					<?php } ?>
				</ul>
				<?php
			}
			?>
		</div>
	<?php }
}
