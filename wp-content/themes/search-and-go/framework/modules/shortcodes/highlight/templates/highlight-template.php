<?php
/**
 * Highlight shortcode template
 */
?>

<span class="eltd-highlight" <?php search_and_go_elated_inline_style($highlight_style);?>>
	<?php echo esc_html($content);?>
</span>