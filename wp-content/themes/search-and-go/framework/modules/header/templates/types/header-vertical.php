<?php do_action('search_and_go_elated_before_page_header'); ?>
<aside class="eltd-vertical-menu-area">
    <div class="eltd-vertical-menu-area-inner">
        <div class="eltd-vertical-area-background" <?php search_and_go_elated_inline_style(array($vertical_header_background_color,$vertical_header_opacity,$vertical_background_image)); ?>></div>
        <?php if(!$hide_logo) {
            search_and_go_elated_get_logo();
        } ?>
        <?php search_and_go_elated_get_vertical_main_menu(); ?>
        <div class="eltd-vertical-area-widget-holder">
            <?php if(is_active_sidebar('eltd-vertical-area')) : ?>
                <?php dynamic_sidebar('eltd-vertical-area'); ?>
            <?php endif; ?>
        </div>
    </div>
</aside>

<?php do_action('search_and_go_elated_after_page_header'); ?>