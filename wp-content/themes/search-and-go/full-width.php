<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
$sidebar = search_and_go_elated_sidebar_layout(); ?>

<?php get_header(); ?>
<?php search_and_go_elated_get_title(); ?>
<?php get_template_part('slider'); ?>

<div class="eltd-full-width">
<div class="eltd-full-width-inner">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(($sidebar == 'default')||($sidebar == '')) : ?>
			<?php the_content(); ?>
			<?php do_action('search_and_go_elated_page_after_content'); ?>
		<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
			<div <?php echo search_and_go_elated_sidebar_columns_class(); ?>>
				<div class="eltd-column1 eltd-content-left-from-sidebar">
					<div class="eltd-column-inner">
						<?php the_content(); ?>
						<?php do_action('search_and_go_elated_page_after_content'); ?>
					</div>
				</div>
				<div class="eltd-column2">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
			<div <?php echo search_and_go_elated_sidebar_columns_class(); ?>>
				<div class="eltd-column1">
					<?php get_sidebar(); ?>
				</div>
				<div class="eltd-column2 eltd-content-right-from-sidebar">
					<div class="eltd-column-inner">
						<?php the_content(); ?>
						<?php do_action('search_and_go_elated_page_after_content'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
<?php get_footer(); ?>