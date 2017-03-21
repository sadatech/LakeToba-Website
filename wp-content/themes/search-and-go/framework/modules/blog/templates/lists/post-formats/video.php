<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltd-post-content">
		<div class="eltd-post-image">
			<?php search_and_go_elated_get_module_template_part('templates/parts/video', 'blog'); ?>
		</div>	
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner">
				<div class="eltd-post-info eltd-top-section">
					<?php search_and_go_elated_post_info(array('category' => 'yes')) ?>
				</div>

				<?php search_and_go_elated_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php
					search_and_go_elated_excerpt($excerpt_length);
					$args_pages = array(
							'before'           => '<div class="eltd-single-links-pages"><div class="eltd-single-links-pages-inner">',
							'after'            => '</div></div>',
							'link_before'      => '<span>',
							'link_after'       => '</span>',
							'pagelink'         => '%'
					);

					wp_link_pages($args_pages);
				?>
				<div class="eltd-post-info">
					<?php search_and_go_elated_post_info(array(
						'date' => 'yes',					
						'author' => 'yes'
					)) ?>
				</div>
				<?php
					search_and_go_elated_read_more_button();
				?>
			</div>
		</div>
	</div>
</article>