<article class="eltd-listing-feat-listing-tax <?php echo esc_attr($tax_layout_class); ?>">
	
	<a href="<?php echo esc_url($tax_permalink)?>"></a>
		
	<?php if($tax_feature_image_html != '') { ?>

		<div class="eltd-listing-feat-image-holder">

			<?php print $tax_feature_image_html; ?>				

		</div>

	<?php } ?>

	<div class="eltd-listing-feat-title-holder">

		<div class="eltd-listing-feat-title-holder-inner">

			<div class="eltd-listing-feat-title-wrapper">

				<h2 class="eltd-listing-feat-title">
					<a href="<?php echo esc_url($tax_permalink)?>">
						<?php echo esc_attr($tax_title) ?>
					</a>
				</h2>

			</div>	

		</div>

	</div>		
	
</article>
	