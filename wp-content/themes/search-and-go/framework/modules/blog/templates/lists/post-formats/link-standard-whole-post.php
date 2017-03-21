<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltd-post-content">

		<div class="eltd-post-info eltd-top-section">
			<?php search_and_go_elated_post_info(array('category' => 'yes')) ?>
		</div>

		<?php search_and_go_elated_get_module_template_part('templates/lists/parts/title', 'blog'); ?>

		<?php search_and_go_elated_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner">
				<div class="eltd-link-icon-holder">
					<?php
					$icon_params = array(
						'icon_pack' => 'font_elegant',
						'fe_icon' => 'icon_link',
						'custom_size' => '16',
						'icon_color'  => '#fff'
					);
					echo search_and_go_elated_execute_shortcode('eltd_icon', $icon_params)?>
				</div>
				<?php
					the_content();
				?>
			</div>
		</div>
	</div>
</article>