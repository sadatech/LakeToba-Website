<?php if ( search_and_go_elated_options()->getOptionValue('enable_listing_item_related_listings') == 'yes' ) { ?>

	<div class="eltd-listing-item-related-holder">
		<h5><?php esc_html_e('Recommended', 'search-and-go')?></h5>
		<?php
		$related = search_and_go_elated_get_related_listings( array(
			'posts_per_page' => 1
		) );
		if ( $related->have_posts() ) {
			while ( $related->have_posts() ) {
				$related->the_post();
				?>
				<div class="eltd-listing-related-image-holder">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('large');
					}
					?>
					<div class="eltd-listing-related-title-holder">

						<div class="eltd-listing-related-title">
							<div class="eltd-listing-related-categories">
								<?php
								$categories = wp_get_post_terms(get_the_ID(), 'listing-item-category');
								foreach ( $categories as $cat ) {
									$icon_pack = get_term_meta( $cat->term_id, 'icon_pack', true );
									$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
									$icon = get_term_meta( $cat->term_id, $param, true );
									$category_link = get_category_link($cat->term_id);
									?>
									<a class="eltd-listing-item-category-icon" href="<?php echo esc_url( $category_link );?>">
										<?php
										echo search_and_go_elated_icon_collections()->renderIcon( $icon, $icon_pack );
										?>
									</a>
									<?php
								} ?>
							</div>
							<a href="<?php the_permalink(); ?>">
								<?php the_title( '<h5>', '</h5>' ); ?>
							</a>
						</div>
					</div>

				</div>
				<div class="eltd-listing-related-content">
					<?php
					$subtitle     = get_post_meta( get_the_ID(), 'eltd_listing_subtitle', true );
					$address = get_post_meta(get_the_ID(), 'eltd_listing_address', true);
					?>
					<p><?php echo esc_html($subtitle); ?> <?php echo esc_html($address); ?></p>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
		?>
	</div>

<?php } ?>