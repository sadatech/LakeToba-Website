<article class="eltd-listing-feat-listing-item <?php echo esc_attr( $item_layout_class ); ?>">

	<div class="eltd-listing-feat-listing-item-inner">
		<?php if ( isset( $item_feature_image ) ) { ?>

			<div class="eltd-listing-feat-image-holder">

				<a href="<?php echo esc_url( $item_permalink ) ?>">
					<?php print $item_feature_image ?>
				</a>

			</div>

		<?php } ?>

		<div class="eltd-listing-feat-title-wrapper">

			<?php
			if ( is_array( $category_icon_array ) && count( $category_icon_array ) ) {

				foreach ( $category_icon_array as $cat_array ) { ?>

					<a class="eltd-listing-item-category-icon"
					   href="<?php echo esc_url( $cat_array['category_link'] ); ?>">
						<?php
						if ( eltd_listing_theme_installed() ) {
							echo search_and_go_elated_icon_collections()->renderIcon( $cat_array['icon'], $cat_array['icon_pack'] );
						}
						?>
					</a>

				<?php }
			} ?>

			<h5 class="eltd-listing-feat-title">
				<a href="<?php echo esc_url( $item_permalink ) ?>">
					<?php echo esc_attr( $item_title ) ?>
				</a>
			</h5>

		</div>
	</div>

</article>
	