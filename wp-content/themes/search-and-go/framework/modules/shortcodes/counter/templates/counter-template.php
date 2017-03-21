<?php
/**
 * Counter shortcode template
 */
?>
<div class="eltd-counter-holder <?php echo esc_attr($position); ?>" <?php echo search_and_go_elated_get_inline_style($counter_holder_styles); ?>>

	<span class="eltd-counter <?php echo esc_attr($type) ?>" <?php echo search_and_go_elated_get_inline_style($counter_styles); ?>>
		<?php echo esc_attr($digit); ?>
	</span>
	<<?php echo esc_html($title_tag); ?> class="eltd-counter-title">
		<?php echo esc_attr($title); ?>
	</<?php echo esc_html($title_tag);; ?>>
	<?php if ($text != "") { ?>
		<p class="eltd-counter-text"><?php echo esc_html($text); ?></p>
	<?php } ?>

</div>