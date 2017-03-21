<?php 
$title_params = array(
	'link_attr' => $link_href_attr
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="eltd-post-content">
		
		<div class="eltd-post-info eltd-top-section">
			<?php search_and_go_elated_post_info(array('category' => 'yes')) ?>
		</div>	
		
		<?php search_and_go_elated_get_module_template_part('templates/single/parts/title', 'blog', '', $title_params); ?>
		
		<div class="eltd-link-image">
			<div class="eltd-link-icon-holder">
				<?php 
					$icon_params = array(
						'icon_pack' => 'font_elegant',
						'fe_icon' => 'icon_link',
						'custom_size' => '16',
						'icon_color'  => '#fff'
					);
					echo search_and_go_elated_execute_shortcode('eltd_icon', $icon_params);
				?>
			</div>
			<?php search_and_go_elated_get_module_template_part('templates/single/parts/image', 'blog'); ?>
		</div>	
		
		
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner clearfix">
				<?php the_content(); ?>
			</div>
		</div>
		
	</div>

	<?php do_action('search_and_go_elated_before_blog_article_closed_tag'); ?>
	
</article>