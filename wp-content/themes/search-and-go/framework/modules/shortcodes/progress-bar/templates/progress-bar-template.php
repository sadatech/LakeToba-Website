<div class="eltd-progress-bar">
	<<?php echo esc_attr($title_tag);?> class="eltd-progress-title-holder clearfix">
		<span class="eltd-progress-title"><?php echo esc_attr($title)?></span>
		<span class="eltd-progress-number-wrapper <?php echo esc_attr($percentage_classes)?> " >
			<span class="eltd-progress-number">
				<span class="eltd-percent">0</span>
				<?php if($floating_type == 'floating_outside' ){ ?>
					<span class="eltd-down-arrow"></span>
				<?php }?>
			</span>
		</span>
	</<?php echo esc_attr($title_tag)?>>
	<div class="eltd-progress-content-outer ">
		<div data-percentage=<?php echo esc_attr($percent)?> class="eltd-progress-content" ></div>
	</div>
</div>	