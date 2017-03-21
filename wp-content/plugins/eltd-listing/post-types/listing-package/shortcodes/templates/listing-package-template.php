<?php foreach($basic_params as $param){
	if($param['key'] !== 'package_icon'){?>
		<input type="hidden" name="<?php echo esc_attr($param['key'])?>" value="<?php echo strtoupper($param['value']);?>" />
	<?php } }
?>
<div class="eltd-dashboard-package-holder">
	
	<div class="eltd-user-package eltd-user-package-box">

		<?php
			if($basic_params['eltd_listing_package_icon']['value'] !== ''){ ?>
				<div class="eltd-user-package-box-inner">
						<span class="eltd-user-package-icon">
							<?php print $basic_params['eltd_listing_package_icon']['value']; ?>
						</span>
				</div>
			<?php }
			foreach ($basic_params as $param){

				if($param['key'] !== 'package_icon' && $param['key'] !=='eltd_listing_package_title'){

					if(isset($param['value']) && $param['value'] !== ''){ ?>
						<div class="eltd-user-package-box-inner">

							<?php if($param['text'] !== ''){ ?>
								<span class="eltd-user-package-inner-title-holder">
									<?php esc_html_e($param['text'].': ', 'eltd_listing'); ?>
								</span>
							<?php } ?>

							<span class="eltd-user-package-inner-value-holder">
								<?php echo ($param['value']); ?>
							</span>
						</div>
					<?php }
				}

			} ?>
	</div>
	
	<div class="eltd-user-package eltd-user-package-box">
				
			<?php if(isset($currently_items) && $currently_items !== ''){ ?>
				<div class="eltd-user-package-box-inner">

					<span class="eltd-user-package-inner-title-holder">
						<?php esc_html_e('Curent items: ', 'eltd_listing'); ?>
					</span>
					<span class="eltd-user-package-inner-value-holder">
						<?php echo esc_attr($currently_items); ?>
					</span>

				</div>
			<?php } ?>

			<?php if(isset($remaining_days) && $remaining_days !== ''){ ?>

				<div class="eltd-user-package-box-inner">

					<span class="eltd-user-package-inner-title-holder">
						<?php esc_html_e('Remaining days: ', 'eltd_listing'); ?>
					</span>
					<span class="eltd-user-package-inner-value-holder">
						<?php esc_html_e($remaining_days.' days', 'eltd_listing'); ?>
					</span>

				</div>
			<?php } ?>

			<?php if(isset($info_message) && $info_message !== ''){ ?>

				<div class="eltd-user-package-box-inner">

					<span class="eltd-user-package-inner-title-holder">
						<?php esc_html_e('Information: ', 'eltd_listing'); ?>
					</span>
					<span class="eltd-user-package-inner-value-holder">
						<?php esc_html_e($info_message, 'eltd_listing'); ?>
					</span>

				</div>
			<?php } ?>
	</div>
</div>