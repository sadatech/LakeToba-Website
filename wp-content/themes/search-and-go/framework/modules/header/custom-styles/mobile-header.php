<?php

if(!function_exists('search_and_go_elated_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function search_and_go_elated_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(search_and_go_elated_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = search_and_go_elated_filter_px(search_and_go_elated_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = search_and_go_elated_options()->getOptionValue('mobile_header_background_color');
        }

        echo search_and_go_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-header-inner', $mobile_header_styles);
    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_mobile_header_general_styles');
}

if(!function_exists('search_and_go_elated_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function search_and_go_elated_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(search_and_go_elated_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = search_and_go_elated_options()->getOptionValue('mobile_menu_background_color');
        }

        echo search_and_go_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(search_and_go_elated_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = search_and_go_elated_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = search_and_go_elated_options()->getOptionValue('mobile_text_color');
        }

        if(search_and_go_elated_is_font_option_valid(search_and_go_elated_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = search_and_go_elated_get_formatted_font_family(search_and_go_elated_options()->getOptionValue('mobile_font_family'));
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = search_and_go_elated_filter_px(search_and_go_elated_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = search_and_go_elated_filter_px(search_and_go_elated_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = search_and_go_elated_options()->getOptionValue('mobile_text_transform');
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = search_and_go_elated_options()->getOptionValue('mobile_font_style');
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = search_and_go_elated_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.eltd-mobile-header .eltd-mobile-nav a',
            '.eltd-mobile-header .eltd-mobile-nav h4'
        );

        echo search_and_go_elated_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(search_and_go_elated_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = search_and_go_elated_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.eltd-mobile-header .eltd-mobile-nav a:hover',
            '.eltd-mobile-header .eltd-mobile-nav h4:hover'
        );

        echo search_and_go_elated_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_mobile_navigation_styles');
}

if(!function_exists('search_and_go_elated_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function search_and_go_elated_mobile_logo_styles() {
        if(search_and_go_elated_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo search_and_go_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-logo-wrapper a',
                array('height' => search_and_go_elated_filter_px(search_and_go_elated_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(search_and_go_elated_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo search_and_go_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-logo-wrapper a',
                array('height' => search_and_go_elated_filter_px(search_and_go_elated_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }

        if(search_and_go_elated_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval(search_and_go_elated_filter_px(search_and_go_elated_options()->getOptionValue('mobile_header_height')) * 0.9).'px';
            echo search_and_go_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-logo-wrapper a', array('max-height' => $max_height));
        }
    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_mobile_logo_styles');
}

if(!function_exists('search_and_go_elated_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function search_and_go_elated_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(search_and_go_elated_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = search_and_go_elated_options()->getOptionValue('mobile_icon_color');
        }

        if(search_and_go_elated_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = search_and_go_elated_filter_px(search_and_go_elated_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo search_and_go_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-menu-opener a', $mobile_icon_styles);

        if(search_and_go_elated_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo search_and_go_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-menu-opener a:hover',
                array('color' => search_and_go_elated_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_mobile_icon_styles');
}