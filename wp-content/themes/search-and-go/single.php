<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php search_and_go_elated_get_title(); ?>
<?php get_template_part('slider');

$overlapping_content = search_and_go_elated_options()->getOptionValue('overlapping_content') == 'yes' ? true : false;
?>
	<div class="eltd-container">
		
		<?php if ( $overlapping_content ) { ?>
			<div class="eltd-overlapping-content">
		<?php } ?>
				
		<?php do_action('search_and_go_elated_after_container_open'); ?>
		<div class="eltd-container-inner">
			<?php search_and_go_elated_get_blog_single(); ?>
		</div>
		<?php do_action('search_and_go_elated_before_container_close'); ?>
		
		<?php if ( $overlapping_content ) { ?>
			</div>
		<?php } ?>		
	</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>