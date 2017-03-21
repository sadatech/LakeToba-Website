<?php

if(!function_exists('search_and_go_elated_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function search_and_go_elated_header_top_bar_styles() {
        global $search_and_go_elated_options;

        if($search_and_go_elated_options['top_bar_height'] !== '') {
            echo search_and_go_elated_dynamic_css('.eltd-top-bar', array('height' => $search_and_go_elated_options['top_bar_height'].'px'));
            echo search_and_go_elated_dynamic_css('.eltd-top-bar .eltd-logo-wrapper a', array('max-height' => $search_and_go_elated_options['top_bar_height'].'px'));
        }

        if($search_and_go_elated_options['top_bar_in_grid'] == 'yes') {
            $top_bar_grid_selector = '.eltd-top-bar .eltd-grid .eltd-vertical-align-containers';
            $top_bar_grid_styles = array();
            if($search_and_go_elated_options['top_bar_grid_background_color'] !== '') {
                $grid_background_color    = $search_and_go_elated_options['top_bar_grid_background_color'];
                $grid_background_transparency = 1;

                if(search_and_go_elated_options()->getOptionValue('top_bar_grid_background_transparency')) {
                    $grid_background_transparency = search_and_go_elated_options()->getOptionValue('top_bar_grid_background_transparency');
                }

                $grid_background_color = search_and_go_elated_rgba_color($grid_background_color, $grid_background_transparency);
                $top_bar_grid_styles['background-color'] = $grid_background_color;
            }

            echo search_and_go_elated_dynamic_css($top_bar_grid_selector, $top_bar_grid_styles);
        }

        $background_color = search_and_go_elated_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $background_transparency = 1;
            if(search_and_go_elated_options()->getOptionValue('top_bar_background_transparency') !== '') {
               $background_transparency = search_and_go_elated_options()->getOptionValue('top_bar_background_transparency');
            }

            $background_color = search_and_go_elated_rgba_color($background_color, $background_transparency);
            $top_bar_styles['background-color'] = $background_color;
        }

        echo search_and_go_elated_dynamic_css('body:not(.post-type-archive-listing-item) .eltd-top-bar', $top_bar_styles);
    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_header_top_bar_styles');
}

if(!function_exists('search_and_go_elated_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function search_and_go_elated_header_standard_menu_area_styles() {
        global $search_and_go_elated_options;

        $menu_area_header_standard_styles = array();
        $menu_area_color_header_standard_styles = array();

        if($search_and_go_elated_options['menu_area_background_color_header_standard'] !== '') {
            $menu_area_background_color        = $search_and_go_elated_options['menu_area_background_color_header_standard'];
            $menu_area_background_transparency = 1;

            if($search_and_go_elated_options['menu_area_background_transparency_header_standard'] !== '') {
                $menu_area_background_transparency = $search_and_go_elated_options['menu_area_background_transparency_header_standard'];
            }

            $menu_area_color_header_standard_styles['background-color'] = search_and_go_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        echo search_and_go_elated_dynamic_css('.eltd-header-standard:not(.post-type-archive-listing-item) .eltd-page-header .eltd-menu-area', $menu_area_color_header_standard_styles);

        if($search_and_go_elated_options['menu_area_height_header_standard'] !== '') {
            $max_height = intval(search_and_go_elated_filter_px($search_and_go_elated_options['menu_area_height_header_standard']) * 0.9).'px';
            echo search_and_go_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_standard_styles['height'] = search_and_go_elated_filter_px($search_and_go_elated_options['menu_area_height_header_standard']).'px';

        }

        echo search_and_go_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-menu-area', $menu_area_header_standard_styles);

        $menu_area_grid_header_standard_styles = array();

        if($search_and_go_elated_options['menu_area_in_grid_header_standard'] == 'yes' && $search_and_go_elated_options['menu_area_grid_background_color_header_standard'] !== '') {
            $menu_area_grid_background_color        = $search_and_go_elated_options['menu_area_grid_background_color_header_standard'];
            $menu_area_grid_background_transparency = 1;

            if($search_and_go_elated_options['menu_area_grid_background_transparency_header_standard'] !== '') {
                $menu_area_grid_background_transparency = $search_and_go_elated_options['menu_area_grid_background_transparency_header_standard'];
            }

            $menu_area_grid_header_standard_styles['background-color'] = search_and_go_elated_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);
        }

        echo search_and_go_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-menu-area .eltd-grid .eltd-vertical-align-containers', $menu_area_grid_header_standard_styles);
    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_header_standard_menu_area_styles');
}


if(!function_exists('search_and_go_elated_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function search_and_go_elated_sticky_header_styles() {
        global $search_and_go_elated_options;

        if($search_and_go_elated_options['sticky_header_in_grid'] == 'yes' && $search_and_go_elated_options['sticky_header_grid_background_color'] !== '') {
            $sticky_header_grid_background_color        = $search_and_go_elated_options['sticky_header_grid_background_color'];
            $sticky_header_grid_background_transparency = 1;

            if($search_and_go_elated_options['sticky_header_grid_transparency'] !== '') {
                $sticky_header_grid_background_transparency = $search_and_go_elated_options['sticky_header_grid_transparency'];
            }

            echo search_and_go_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-grid .eltd-vertical-align-containers', array('background-color' => search_and_go_elated_rgba_color($sticky_header_grid_background_color, $sticky_header_grid_background_transparency)));
        }

        if($search_and_go_elated_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $search_and_go_elated_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($search_and_go_elated_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $search_and_go_elated_options['sticky_header_transparency'];
            }

            echo search_and_go_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-sticky-holder', array('background-color' => search_and_go_elated_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($search_and_go_elated_options['sticky_header_height'] !== '') {
            $max_height = intval(search_and_go_elated_filter_px($search_and_go_elated_options['sticky_header_height']) * 0.9).'px';

            echo search_and_go_elated_dynamic_css('.eltd-page-header .eltd-sticky-header', array('height' => $search_and_go_elated_options['sticky_header_height'].'px'));
            echo search_and_go_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-logo-wrapper a', array('max-height' => $max_height));
        }

        $sticky_menu_item_styles = array();
        if($search_and_go_elated_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $search_and_go_elated_options['sticky_color'];
        }
        if($search_and_go_elated_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = search_and_go_elated_get_formatted_font_family($search_and_go_elated_options['sticky_google_fonts']);
        }
        if($search_and_go_elated_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $search_and_go_elated_options['sticky_fontsize'].'px';
        }
        if($search_and_go_elated_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $search_and_go_elated_options['sticky_lineheight'].'px';
        }
        if($search_and_go_elated_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $search_and_go_elated_options['sticky_texttransform'];
        }
        if($search_and_go_elated_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $search_and_go_elated_options['sticky_fontstyle'];
        }
        if($search_and_go_elated_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $search_and_go_elated_options['sticky_fontweight'];
        }
        if($search_and_go_elated_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $search_and_go_elated_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.eltd-main-menu.eltd-sticky-nav > ul > li > a'
        );

        echo search_and_go_elated_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($search_and_go_elated_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $search_and_go_elated_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.eltd-main-menu.eltd-sticky-nav > ul > li:hover > a',
            '.eltd-main-menu.eltd-sticky-nav > ul > li.eltd-active-item:hover > a',
            'body:not(.eltd-menu-item-first-level-bg-color) .eltd-main-menu.eltd-sticky-nav > ul > li:hover > a',
            'body:not(.eltd-menu-item-first-level-bg-color) .eltd-main-menu.eltd-sticky-nav > ul > li.eltd-active-item:hover > a'
        );

        echo search_and_go_elated_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_sticky_header_styles');
}

if(!function_exists('search_and_go_elated_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function search_and_go_elated_fixed_header_styles() {
        global $search_and_go_elated_options;

        if($search_and_go_elated_options['fixed_header_grid_background_color'] !== '') {

            $fixed_header_grid_background_color              = $search_and_go_elated_options['fixed_header_grid_background_color'];
            $fixed_header_grid_background_color_transparency = 1;

            if($search_and_go_elated_options['fixed_header_grid_transparency'] !== '') {
                $fixed_header_grid_background_color_transparency = $search_and_go_elated_options['fixed_header_grid_transparency'];
            }

            echo search_and_go_elated_dynamic_css('.eltd-header-type1 .eltd-fixed-wrapper.fixed .eltd-grid .eltd-vertical-align-containers,
                                    .eltd-header-type3 .eltd-fixed-wrapper.fixed .eltd-grid .eltd-vertical-align-containers',
                array('background-color' => search_and_go_elated_rgba_color($fixed_header_grid_background_color, $fixed_header_grid_background_color_transparency)));
        }

        if($search_and_go_elated_options['fixed_header_background_color'] !== '') {

            $fixed_header_background_color              = $search_and_go_elated_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($search_and_go_elated_options['fixed_header_transparency'] !== '') {
                $fixed_header_background_color_transparency = $search_and_go_elated_options['fixed_header_transparency'];
            }

            echo search_and_go_elated_dynamic_css('.eltd-header-type1 .eltd-fixed-wrapper.fixed .eltd-menu-area,
                                    .eltd-header-type3 .eltd-fixed-wrapper.fixed .eltd-menu-area',
                array('background-color' => search_and_go_elated_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
        }

    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_fixed_header_styles');
}