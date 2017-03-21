<?php if ( ( $sidebar == 'default' ) || ( $sidebar == '' ) ) : ?>
	<?php search_and_go_elated_get_blog_type( $blog_type ); ?>
	<?php the_posts_pagination(); ?>
<?php elseif ( $sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right' ): ?>
	<div <?php echo search_and_go_elated_sidebar_columns_class(); ?>>
		<div class="eltd-column1 eltd-content-left-from-sidebar">
			<div class="eltd-column-inner">
				<?php search_and_go_elated_get_blog_type( $blog_type ); ?>
				<?php the_posts_pagination(); ?>
			</div>
		</div>
		<div class="eltd-column2">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php elseif ( $sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left' ): ?>
	<div <?php echo search_and_go_elated_sidebar_columns_class(); ?>>
		<div class="eltd-column1">
			<?php get_sidebar(); ?>
		</div>
		<div class="eltd-column2 eltd-content-right-from-sidebar">
			<div class="eltd-column-inner">
				<?php search_and_go_elated_get_blog_type( $blog_type ); ?>
				<?php the_posts_pagination(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

