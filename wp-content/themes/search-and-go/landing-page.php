<?php
/*
Template Name: Landing Page
*/
$sidebar = search_and_go_elated_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php if (!search_and_go_elated_is_ajax_request()) search_and_go_elated_wp_title(); ?>

        <?php
        /**
         * search_and_go_elated_header_meta hook
         *
         * @see search_and_go_elated_header_meta() - hooked with 10
         * @see eltd_user_scalable_meta() - hooked with 10
         */
        if (!search_and_go_elated_is_ajax_request()) do_action('search_and_go_elated_header_meta');
        ?>

        <?php if (!search_and_go_elated_is_ajax_request()) wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<?php 
if ((!search_and_go_elated_is_ajax_request()) && search_and_go_elated_options()->getOptionValue('smooth_page_transitions') == "yes") {
	$ajax_class = search_and_go_elated_options()->getOptionValue('smooth_pt_true_ajax') === 'no' ? 'eltd-mimic-ajax' : 'eltd-ajax';
?>
<div class="eltd-smooth-transition-loader <?php echo esc_html($ajax_class); ?>">
    <div class="eltd-st-loader">
        <div class="eltd-st-loader1">
            <?php search_and_go_elated_loading_spinners(); ?>
        </div>
    </div>
</div>
<?php } ?>

<div class="eltd-wrapper">
	<div class="eltd-wrapper-inner">
		<div class="eltd-content">
            <?php if(search_and_go_elated_is_ajax_enabled()) { ?>
            <div class="eltd-meta">
                <?php do_action('search_and_go_elated_ajax_meta'); ?>
                <span id="eltd-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
                <div class="eltd-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
            </div>
            <?php } ?>
			<div class="eltd-content-inner">
				<?php get_template_part( 'title' ); ?>
				<?php get_template_part('slider');?>
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
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>