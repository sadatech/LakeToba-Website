<?php 
$name = get_the_author_meta( 'first_name', $user_id );
$last_name = get_the_author_meta( 'last_name', $user_id );
$link = get_author_posts_url($user_id);
$description = get_the_author_meta( 'description', $user_id );
if ( eltd_listing_theme_installed() ) {
	$user_social_icons = search_and_go_elated_get_user_custom_fields($user_id);
} else {
	$user_social_icons = array();
}
$email = get_the_author_meta( 'email', $user_id );
$website = get_the_author_meta( 'url', $user_id );

$users_wishlists = eltd_listing_get_user_whislist();
$wishlist_html = '';
if ( $users_wishlists ) {

	$query_args = array(
		'post_type' => 'listing-item',
		'post__in' => $users_wishlists,
		'post_per_page' => 4
	);

	$query = new WP_Query($query_args);	
	
	$shortcode_params = array(
		'listing_basic_columns' => 'two',
		'listing_advanced_query'	=> $query
	);
	if ( eltd_listing_theme_installed() ) {
		$wishlist_html .= search_and_go_elated_execute_shortcode('eltd_listing_basic', $shortcode_params);
	}

} 

?>

<div class="eltd-dashboard-profile-info-holder">
	
	<?php
	
	echo eltd_listing_dashboard_page_top_area(esc_html__('My Profile', 'eltd_listing'), esc_html__($subtitle_text, 'eltd_listing'));
	echo eltd_listing_dashboard_get_user_holder($user_id, $sign_out_button_params);
	
	if( $name !== '' || $last_name !== '' ){ ?>
		
		<div class="eltd-dashboard-profile-info-item">
			
			<h5>
				<?php esc_html_e('Name', 'eltd_listing') ?>
			</h5>
			
			<div class="eltd-dashboard-profile-item-inner">
				
				<a href="<?php echo esc_url($link)?>">
					<?php echo esc_attr($name .' '.$last_name ) ?>
				</a>	
				
			</div>		
			
		</div>
		
	<?php }
	
	if( $email !== '' ){ ?>
	
		<div class="eltd-dashboard-profile-info-item">
			
			<h5>
				<?php esc_html_e('Mail', 'eltd_listing') ?>
			</h5>

			<div class="eltd-dashboard-profile-item-inner">
				<span>
					<?php echo esc_attr($email) ?>		
				</span>	
			</div>
			
		</div>	
		
	<?php }
	
	if( $website !== '' ){ ?>
	
		<div class="eltd-dashboard-profile-info-item">
			
			<h5>
				<?php esc_html_e('Website', 'eltd_listing') ?>
			</h5>
			
			<div class="eltd-dashboard-profile-item-inner">
				<a href = "<?php echo esc_url($website)?>">
					<?php esc_html_e('Go to Site', 'eltd_listing')?>
				</a>
			</div>	
			
		</div>	
		
	<?php }
	
	
	if(is_array($user_social_icons) && count($user_social_icons)){ ?>
	
		<div class="eltd-dashboard-profile-info-item">
			<h5>
				<?php esc_html_e('Social Profiles', 'eltd_listing') ?>
			</h5>
			
			<div class="eltd-dashboard-profile-item-inner eltd-dashboard-profile-social-item">
				
				<?php foreach($user_social_icons as $network){
				
					if($network['link'] !== ''){ ?>

						<a href="<?php echo esc_attr($network['link'])?>" target="blank" class="eltd-author-social-icon">

							<span class="<?php echo esc_attr($network['class'])?>"></span>

						</a>	

					<?php }?>

				<?php } ?>
				
			</div>			
			
		</div>	
		
	<?php } 
	
	if( $description !== '' ){ ?>
		
		<div class="eltd-dashboard-profile-info-item">
			<h5>
				<?php esc_html_e('Description', 'eltd_listing') ?>
			</h5>
			
			<div class="eltd-dashboard-profile-item-inner">
				<span>					
					<?php echo esc_attr($description) ?>
				</span>
			</div>
			
		</div>	
	
	<?php } ?>
	
	<div class="eltd-dashboard-profile-info-item">
		
		<?php if($wishlist_html !== ''){ ?>

				<h5>
					<?php esc_html_e('Latest in Whislist', 'eltd_listing') ?>
				</h5>

				<div class="eltd-dashboard-profile-item-inner eltd-dashboard-profile-item-wishlist">
					
					<?php echo $wishlist_html ?>
						
				</div>

		<?php }else{

			echo '<div class="eltd-listing-empty-wishlist-holder">
					<p>' . esc_html__('Your wishlist is empty.', 'eltd_listing') . '</p>
				</div>';
			
		}?>
		
	</div>
	
</div>