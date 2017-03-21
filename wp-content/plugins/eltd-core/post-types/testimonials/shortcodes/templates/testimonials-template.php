<div id="eltd-testimonials<?php echo esc_attr($current_id) ?>" class="eltd-testimonial-content">
	<div class="eltd-testimonial-content-wrapper-inner">
		
		<div class="eltd-testimonial-image-holder" <?php echo search_and_go_elated_get_inline_style($image_style);?> >
			<a class="eltd-testimonial-image" href="<?php echo get_the_permalink() ?>">
				<?php
					print $feature_image;
				?>
			</a>	
		</div>		
		<div class="eltd-testimonial-content-inner">
			<div class="eltd-testimonial-text-holder">
				<div class="eltd-testimonial-text-inner">
					
					<?php if($show_title == "yes"){ ?>
						<h3 class="eltd-testimonial-title">
							<?php echo esc_attr($title) ?>
						</h3>
					<?php }?>
						
					<?php if ($show_author == "yes") { ?>
						<h4 class="eltd-testimonial-author">
							<?php echo esc_attr($author)?>								
						</h4>
					<?php } ?>
						
					<?php if($show_position == "yes" && $job !== ''){ ?>
						<h6 class="eltd-testimonials-job">
							<?php echo esc_attr($job)?>
						</h6>
					<?php }?>	
						
					<p class="eltd-testimonial-text">
						<span>
							<?php echo trim($text) ?>
						</span>
					</p>
									
				</div>
			</div>
		</div>	
	</div>	
</div>
