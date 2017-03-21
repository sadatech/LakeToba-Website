<?php do_action('search_and_go_elated_before_top_navigation'); ?>

<nav class="eltd-main-menu eltd-drop-down <?php echo esc_attr($additional_class); ?>">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'main-navigation' ,
        'container'  => '',
        'container_class' => '',
        'menu_class' => 'clearfix',
        'menu_id' => '',
        'fallback_cb' => 'top_navigation_fallback',
        'link_before' => '<span>',
        'link_after' => '</span>',
        'walker' => new SearchAndGoTopNavigationWalker()
    ));
    ?>
</nav>

<?php do_action('search_and_go_elated_after_top_navigation'); ?>