<?php do_action('search_and_go_elated_before_page_header'); ?>

<header class="eltd-page-header">
    <div class="eltd-logo-area">
        <?php if($logo_area_in_grid) : ?>
        <div class="eltd-grid">
        <?php endif; ?>
			<?php do_action( 'search_and_go_elated_after_header_logo_area_html_open' )?>
            <div class="eltd-vertical-align-containers eltd-50-50">
                <div class="eltd-position-left">
                    <div class="eltd-position-left-inner">
                        <?php if(!$hide_logo) {
                            search_and_go_elated_get_logo();
                        } ?>
                    </div>
                </div>

                <div class="eltd-position-right">
                    <div class="eltd-position-right-inner">
                        <?php if(is_active_sidebar('eltd-right-from-logo')) : ?>
                            <?php dynamic_sidebar('eltd-right-from-logo'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php if($logo_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        <div class="eltd-fixed-wrapper">
    <?php endif; ?>
    <div class="eltd-menu-area">
        <?php if($menu_area_in_grid) : ?>
            <div class="eltd-grid">
        <?php endif; ?>
			<?php do_action( 'search_and_go_elated_after_header_menu_area_html_open' )?>
            <div class="eltd-vertical-align-containers">
                <div class="eltd-position-left">
                    <div class="eltd-position-left-inner">
                        <?php search_and_go_elated_get_main_menu(); ?>
                    </div>
                </div>
				<?php if(is_active_sidebar('eltd-right-from-main-menu')) :
					$widget_class = 'eltd-has-widget'; ?>
					<div class="eltd-position-right <?php echo esc_attr($widget_class)?>">
						<div class="eltd-position-right-inner">
							<?php dynamic_sidebar('eltd-right-from-main-menu'); ?>
						</div>
					</div>
				 <?php endif; ?>
            </div>
        <?php if($menu_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        </div>
    <?php endif; ?>
    <?php if($show_sticky) {
        search_and_go_elated_get_sticky_header();
    } ?>
</header>

<?php do_action('search_and_go_elated_after_page_header'); ?>

