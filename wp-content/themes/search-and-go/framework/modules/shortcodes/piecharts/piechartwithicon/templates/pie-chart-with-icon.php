<div class="eltd-pie-chart-with-icon-holder">
	<div class="eltd-percentage-with-icon" <?php echo search_and_go_elated_get_inline_attrs($pie_chart_data); ?>>
		<?php print $icon; ?>
	</div>
	<div class="eltd-pie-chart-text" <?php search_and_go_elated_inline_style($pie_chart_style)?>>
		<<?php echo esc_html($title_tag)?> class="eltd-pie-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_html($title_tag)?>>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>