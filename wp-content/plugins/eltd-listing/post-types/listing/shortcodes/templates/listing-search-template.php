<form method="get" action="<?php echo esc_url(get_post_type_archive_link( 'listing-item' )); ?>">
	<div class="eltd-listing-search-holder">
		<div class="clearfix">
			<div class="eltd-listing-search-field keywords">
				<input type="text" placeholder="Keywords" name="keywords" id="keywords">
			</div>
			<div class="eltd-listing-search-field location">
				<select name="location" id="location">
					<option value="all"><?php esc_html_e('All Locations', 'eltd_listing')?></option>
					<?php
						if(is_array($locations) && count($locations)){
							foreach($locations as $key => $value){ ?>
								<option value = "<?php echo esc_attr($value)?>">
									<?php echo esc_attr($value);?>
								</option>
							<?php }
						} ?>
				</select>
			</div>
			<div class="eltd-listing-search-field category">
				<select name="type" id="category">
					<option value="all"><?php esc_html_e('All Categories', 'eltd_listing')?></option>
					<?php if(is_array($categories) && count($categories)){
						foreach($categories as $key => $value){?>
							<option value = "<?php echo esc_attr($value)?>">
								<?php echo esc_attr($value)?>
							</option>
						<?php }
					} ?>
				</select>
			</div>
		</div>
		<div class="eltd-listing-search-submit-holder">
			<?php
			if ( eltd_listing_theme_installed() ) {
				echo search_and_go_elated_get_button_html(array(
					'type' => 'solid',
					'text' => esc_html__('Search Places', 'eltd_listing'),
					'html_type' => 'button',
					'hover_border_color'   => '#fff',
					'hover_color'   => '#fff',
					'icon_pack' => 'font_elegant',
					'fe_icon' => 'arrow_carrot-right',
					'size' => 'large'
				));
			}
			?>
		</div>
		<div class="eltd-listing-search-categories-holder">
			<?php  foreach ( $top_categories as $tcategory )  { ?>
				<a href="<?php echo get_permalink( $tcategory->ID ); ?>" class="eltd-listing-search-category-link">
					<span class="eltd-listing-search-category-link-inner-holder">
						<?php
						$icon_pack = get_post_meta( $tcategory->ID, 'listing_type_icon_pack', true );
						if ( eltd_listing_theme_installed() ) {
							$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
							$icon = get_post_meta( $tcategory->ID, 'listing_type_icon_' . $param, true );
							echo search_and_go_elated_icon_collections()->renderIcon( $icon, $icon_pack );
						}
						?>
						<span class="eltd-listing-search-category-title">
							<?php echo esc_html($tcategory->post_title, 'eltd_listing'); ?>
						</span>
					</span>
				</a>
			<?php } ?>
		</div>
	</div>
</form>