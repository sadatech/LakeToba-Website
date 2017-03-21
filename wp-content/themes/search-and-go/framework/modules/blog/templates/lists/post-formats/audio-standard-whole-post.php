<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltd-post-content">
		<div class="eltd-post-info">
			<?php search_and_go_elated_post_info(array('category' => 'yes')) ?>
		</div>
		<?php search_and_go_elated_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
		<div class="eltd-audio-image-holder">
			<?php search_and_go_elated_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
			<?php search_and_go_elated_get_module_template_part('templates/parts/audio', 'blog'); ?>
		</div>
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner">
				<?php
					the_content();
				?>
			</div>
		</div>
	</div>
</article>