<div class="eltd-footer-top-holder">
	<div class="eltd-footer-top <?php echo esc_attr($footer_top_classes) ?>">
		<?php if($footer_in_grid) { ?>

		<div class="eltd-container">
			<div class="eltd-container-inner">

		<?php }

		switch ($footer_top_columns) {
			case 6:
				search_and_go_elated_get_footer_sidebar_25_25_50();
				break;
			case 5:
				search_and_go_elated_get_footer_sidebar_50_25_25();
				break;
			case 4:
				search_and_go_elated_get_footer_sidebar_four_columns();
				break;
			case 3:
				search_and_go_elated_get_footer_sidebar_three_columns();
				break;
			case 2:
				search_and_go_elated_get_footer_sidebar_two_columns();
				break;
			case 1:
				search_and_go_elated_get_footer_sidebar_one_column();
				break;
		}

		if($footer_in_grid) { ?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>
