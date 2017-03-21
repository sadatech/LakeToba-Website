<?php  search_and_go_elated_get_module_template_part('templates/lists/parts/filter', 'blog'); ?>
<div class="eltd-blog-holder eltd-blog-type-masonry eltd-masonry-pagination-<?php echo search_and_go_elated_options()->getOptionValue('masonry_pagination'); ?>">
	<div class="eltd-blog-masonry-grid-sizer"></div>
	<div class="eltd-blog-masonry-grid-gutter"></div>
	<?php
	if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
		search_and_go_elated_get_post_format_html($blog_type);
	endwhile;
	else:
		search_and_go_elated_get_module_template_part('templates/parts/no-posts', 'blog');
	endif;
	?>
</div>
<?php
	if(search_and_go_elated_options()->getOptionValue('pagination') == 'yes') {

		$pagination_type = search_and_go_elated_options()->getOptionValue('masonry_pagination');
		if($pagination_type == 'load-more' || $pagination_type == 'infinite-scroll'){
			if(get_next_posts_page_link($blog_query->max_num_pages)){ ?>
				<div class="eltd-blog-<?php echo esc_attr($pagination_type); ?>-button-holder">
					<span class="eltd-blog-<?php echo esc_attr($pagination_type); ?>-button" data-rel="<?php echo esc_attr($blog_query->max_num_pages); ?>">
						<?php
							echo search_and_go_elated_get_button_html(array(
								'link' => get_next_posts_page_link($blog_query->max_num_pages),
								'text' => 'Show more'
							));
						?>
					</span>
				</div>
			<?php }
		}else {
			search_and_go_elated_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
		}
	}
?>

