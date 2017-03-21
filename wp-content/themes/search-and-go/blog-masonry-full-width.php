<?php
/*
Template Name: Blog: Masonry
*/
get_header();
search_and_go_elated_get_title();
get_template_part( 'slider' );

$overlapping_content = search_and_go_elated_get_meta_field_intersect('overlapping_content') == 'yes' ? true : false;
?>
	<div class="eltd-container">

		<?php if ( $overlapping_content ) { ?>
		<div class="eltd-overlapping-content">
			<?php } ?>

			<?php do_action( 'search_and_go_elated_after_container_open' ); ?>
			<div class="eltd-container-inner">
				<?php the_content(); ?>
				<?php search_and_go_elated_get_blog( 'masonry' ); ?>
			</div>
			<?php do_action( 'search_and_go_elated_before_container_close' ); ?>

			<?php if ( $overlapping_content ) { ?>
		</div>
	<?php } ?>
	</div>
<?php get_footer(); ?>