<?php if(search_and_go_elated_options()->getOptionValue('enable_social_share') == 'yes' && search_and_go_elated_options()->getOptionValue('enable_social_share_on_listing-item') == 'yes') { ?>
	<div class ="eltd-listing-share">
		<?php echo search_and_go_elated_get_social_share_html(array(
			'type' => 'dropdown'
		)); ?>
	</div>
<?php } ?>
