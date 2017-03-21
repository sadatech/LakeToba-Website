<?php do_action('search_and_go_elated_before_page_header'); ?>

<header class="eltd-page-header">
    <div class="eltd-logo-area">
        <?php if($logo_area_in_grid) : ?>
        <div class="eltd-grid">
        <?php endif; ?>
            <div class="eltd-vertical-align-containers">
                <div class="eltd-position-center">
                    <div class="eltd-position-center-inner">
                        <?php if(!$hide_logo) {
                            search_and_go_elated_get_logo();
                        } ?>
                    </div>
                </div>
            </div>
        <?php if($logo_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_sticky) {
        search_and_go_elated_get_sticky_header();
    } ?>
</header>

<?php do_action('search_and_go_elated_after_page_header'); ?>