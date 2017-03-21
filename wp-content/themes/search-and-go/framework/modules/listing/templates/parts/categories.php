<?php
$categories = wp_get_post_terms(get_the_ID(), 'listing-item-category');
?>

<div class="eltd-listing-info-item eltd-listing-categories eltd-listing-part clearfix">
	
	<?php if(is_array($categories) && count($categories)) :
		
			foreach($categories as $category) {
		
				$category_link = get_category_link($category->term_id);
				
				?>
	
				<a href="<?php echo esc_url($category_link); ?>"  title="<?php echo esc_attr($category->name)?>">
					
					<?php echo esc_attr($category->name)?>
					
				</a>
	
			<?php }
	endif; ?>
	
</div>