<div class="eltd-numbered-steps-holder clearfix <?php echo esc_attr($skin_class)?>" <?php search_and_go_elated_inline_style($holder_styles); ?> >
	
	<div class="eltd-numbered-steps-top-holder">
		
		<div class="eltd-numbered-steps-number-holder">
			<?php echo esc_attr($numbered_steps_number).'.'; ?>
		</div>	
		
		<div class="eltd-numbered-steps-title-subtitle-holder">
			
			<h4 class="eltd-numbered-steps-title">
				<?php echo esc_attr($numbered_steps_title)?>
			</h4>

			<p class="eltd-numbered-steps-subtitle">
				<?php echo esc_attr($numbered_steps_subtitle)?>
			</p>	
			
		</div>
		
	</div>
	
	<div class="eltd-numbered-steps-bottom-holder">
		<?php echo do_shortcode($content); ?>
	</div>	
	
</div>	