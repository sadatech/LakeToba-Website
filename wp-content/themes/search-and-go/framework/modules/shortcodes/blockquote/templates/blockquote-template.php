<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="eltd-blockquote-shortcode" <?php search_and_go_elated_inline_style($blockquote_style); ?> >
	<span class="eltd-icon-quotations-holder">
		<?php echo search_and_go_elated_icon_collections()->getQuoteIcon("font_awesome", true); ?>
	</span>
	<<?php echo esc_attr($blockquote_title_tag); ?> class="eltd-blockquote-text">
	<span><?php echo esc_attr($text); ?></span>
	</<?php echo esc_attr($blockquote_title_tag);?>>
</blockquote>