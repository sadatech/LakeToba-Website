<?php
/**
 * Video Button shortcode template
 */
?>

<div class="eltd-video-button">
	<a class="eltd-video-button-play" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto" <?php echo search_and_go_elated_inline_style($button_style);?>>
		<span class="eltd-video-button-wrapper">
			<span class="arrow_triangle-right"></span>
		</span>
	</a>
	<?php if ($title !== ''){?>
		<<?php echo esc_attr($title_tag);?> class="eltd-video-button-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_attr($title_tag);?>>
	<?php } ?>
</div>