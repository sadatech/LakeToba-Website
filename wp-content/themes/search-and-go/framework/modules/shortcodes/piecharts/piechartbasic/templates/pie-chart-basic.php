<?php
/**
 * Pie Chart Basic Shortcode Template
 */
?>
<div class="eltd-pie-chart-holder">
	<div class="eltd-percentage" <?php echo search_and_go_elated_get_inline_attrs($pie_chart_data); ?>>
		<?php if ($type_of_central_text == "title") { ?>
			<<?php echo esc_attr($title_tag); ?> class="eltd-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } else { ?>
			<span class="eltd-to-counter">
				<?php echo esc_html($percent ); ?>
			</span>
		<?php } ?>
	</div>
	<div class="eltd-pie-chart-text" <?php search_and_go_elated_inline_style($pie_chart_style); ?>>
		<?php if ($type_of_central_text == "title") { ?>
			<span class="eltd-to-counter">
				<?php echo esc_html($percent ); ?>
			</span>
		<?php } else { ?>
			<<?php echo esc_attr($title_tag); ?> class="eltd-pie-title">
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<p><?php echo esc_html($text); ?></p>
	</div>
</div>