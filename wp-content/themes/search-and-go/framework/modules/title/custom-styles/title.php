<?php

if (!function_exists('search_and_go_elated_title_area_typography_style')) {

    function search_and_go_elated_title_area_typography_style(){

        $title_styles = array();

        if(search_and_go_elated_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = search_and_go_elated_options()->getOptionValue('page_title_color');
        }
        if(search_and_go_elated_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = search_and_go_elated_get_formatted_font_family(search_and_go_elated_options()->getOptionValue('page_title_google_fonts'));
        }
        if(search_and_go_elated_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = search_and_go_elated_options()->getOptionValue('page_title_fontsize').'px';
        }
        if(search_and_go_elated_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = search_and_go_elated_options()->getOptionValue('page_title_lineheight').'px';
        }
        if(search_and_go_elated_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = search_and_go_elated_options()->getOptionValue('page_title_texttransform');
        }
        if(search_and_go_elated_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = search_and_go_elated_options()->getOptionValue('page_title_fontstyle');
        }
        if(search_and_go_elated_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = search_and_go_elated_options()->getOptionValue('page_title_fontweight');
        }
        if(search_and_go_elated_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = search_and_go_elated_options()->getOptionValue('page_title_letter_spacing').'px';
        }

        $title_selector = array(
            '.eltd-title .eltd-title-holder h1'
        );

        echo search_and_go_elated_dynamic_css($title_selector, $title_styles);


        $subtitle_styles = array();

        if(search_and_go_elated_options()->getOptionValue('page_subtitle_color') !== '') {
            $subtitle_styles['color'] = search_and_go_elated_options()->getOptionValue('page_subtitle_color');
        }
        if(search_and_go_elated_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
            $subtitle_styles['font-family'] = search_and_go_elated_get_formatted_font_family(search_and_go_elated_options()->getOptionValue('page_subtitle_google_fonts'));
        }
        if(search_and_go_elated_options()->getOptionValue('page_subtitle_fontsize') !== '') {
            $subtitle_styles['font-size'] = search_and_go_elated_options()->getOptionValue('page_subtitle_fontsize').'px';
        }
        if(search_and_go_elated_options()->getOptionValue('page_subtitle_lineheight') !== '') {
            $subtitle_styles['line-height'] = search_and_go_elated_options()->getOptionValue('page_subtitle_lineheight').'px';
        }
        if(search_and_go_elated_options()->getOptionValue('page_subtitle_texttransform') !== '') {
            $subtitle_styles['text-transform'] = search_and_go_elated_options()->getOptionValue('page_subtitle_texttransform');
        }
        if(search_and_go_elated_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
            $subtitle_styles['font-style'] = search_and_go_elated_options()->getOptionValue('page_subtitle_fontstyle');
        }
        if(search_and_go_elated_options()->getOptionValue('page_subtitle_fontweight') !== '') {
            $subtitle_styles['font-weight'] = search_and_go_elated_options()->getOptionValue('page_subtitle_fontweight');
        }
        if(search_and_go_elated_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
            $subtitle_styles['letter-spacing'] = search_and_go_elated_options()->getOptionValue('page_subtitle_letter_spacing').'px';
        }

        $subtitle_selector = array(
            '.eltd-title .eltd-title-holder .eltd-subtitle'
        );

        echo search_and_go_elated_dynamic_css($subtitle_selector, $subtitle_styles);


        $breadcrumb_styles = array();

        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_color') !== '') {
            $breadcrumb_styles['color'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_color');
        }
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = search_and_go_elated_get_formatted_font_family(search_and_go_elated_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.eltd-title .eltd-title-holder .eltd-breadcrumbs a, .eltd-title .eltd-title-holder .eltd-breadcrumbs span'
        );

        echo search_and_go_elated_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(search_and_go_elated_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = search_and_go_elated_options()->getOptionValue('page_breadcrumb_hovercolor');
        }

        $breadcrumb_hover_selector = array(
            '.eltd-title .eltd-title-holder .eltd-breadcrumbs a:hover'
        );

        echo search_and_go_elated_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);

    }

    add_action('search_and_go_elated_style_dynamic', 'search_and_go_elated_title_area_typography_style');

}


