<?php
$title = get_the_title();
$title = strtolower($title);
$title = str_replace( ' ', '-', $title );
?>
<article class="eltd-listing-list-item" id="<?php echo htmlspecialchars($title); ?>" itemscope itemtype="http://schema.org/LocalBusiness">
	<?php if ( has_post_thumbnail() ) {
		$image_id = get_post_thumbnail_id();
		$image = wp_get_attachment_image_src($image_id, 'medium');
		?>
		<div class="eltd-listing-item-image" style="background-image: url(<?php echo esc_url($image[0]) ?>);">
		<a class="eltd-listing-item-image-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
			<?php the_post_thumbnail()?>
		</div>
	<?php } ?>
	<div class="eltd-listing-item-content">
		<?php
		search_and_go_elated_listing_get_info_part('title-list');
		search_and_go_elated_listing_get_info_part('address');
		search_and_go_elated_listing_get_info_part('excerpt');
		?>
		<div class="eltd-listing-item-category-rating clearfix">
			<?php
			//echo search_and_go_elated_get_listing_categories_html(get_the_ID());
			search_and_go_elated_listing_get_info_part('category-icons-in-list');
			search_and_go_elated_listing_get_info_part('rating');
			?>
		</div>
	</div>
</article>