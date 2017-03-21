<article class = "eltd-listing-basic-item-holder">
	
	
	<?php if($feature_image !== ''){ ?>
		
		<div class="eltd-listing-item-image">
			
			<a href=" <?php echo esc_url($permalink);?>" >
				<?php
					print $feature_image;
				?>
			</a>	

		</div>
		
	<?php } ?>
	
	
	<div class="eltd-listing-item-info-holder">
		
		<?php if( function_exists( 'eltd_listing_whislist' ) ){
			echo eltd_listing_whislist();
		} ?>
		
		<h3 class="eltd-listing-item-title">
			
			<a href=" <?php echo esc_url($permalink);?>" >
				<?php 
					echo esc_attr($title);
				?>
			</a>
			
		</h3>	
		
		
		<?php if($address !== ''){ ?>
		
			<h6 class="eltd-listing-item-address-holder">
				
				<?php echo esc_attr($address); ?>
				
			</h6>
			
		<?php } ?>
		
		<?php if($excerpt !== ''){ ?>
		
			<div class="eltd-listing-item-except">
			
				<?php echo esc_attr($excerpt); ?>

			</div>
		
		<?php } ?>
		
		
		<?php if($icon_html !== '' || $rating_html !==''){ ?>
			
			<div class="eltd-listing-item-bottom-section">
			
				<?php

				if($icon_html !== ''){ ?>

					<div class="eltd-listing-item-icon">

						<?php print $icon_html ?>					

					</div>

				<?php }
				
				if($rating_html !== ''){ ?>
				
					<div class="eltd-listing-item-rating-holder">
						<?php
							//render rating html
							print $rating_html;
						?>			
					</div>
				
				<?php } ?>
				

			</div>
		
		<?php } ?>		
		
	</div>
		
</article>