<?php do_action('search_and_go_elated_before_mobile_navigation'); ?>

<nav class="eltd-mobile-nav">
    <div class="eltd-grid">
        <?php wp_nav_menu(array(
            'theme_location' => 'main-navigation' ,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new SearchAndGoMobileNavigationWalker()
        )); ?>
    </div>
</nav>

<?php do_action('search_and_go_elated_after_mobile_navigation'); ?>