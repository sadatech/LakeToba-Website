<?php
    /*
    Template Name: Blog: Standard Whole Post
    */
?>
<?php get_header(); ?>
<?php search_and_go_elated_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="eltd-container">
        <?php do_action('search_and_go_elated_after_container_open'); ?>
        <div class="eltd-container-inner">
            <?php search_and_go_elated_get_blog('standard-whole-post'); ?>
        </div>
        <?php do_action('search_and_go_elated_before_container_close'); ?>
    </div>
<?php get_footer(); ?>