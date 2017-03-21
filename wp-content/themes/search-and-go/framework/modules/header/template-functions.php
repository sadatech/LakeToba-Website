<?php

use SearchAndGoElated\Modules\Header\Lib\HeaderFactory;

if(!function_exists('search_and_go_elated_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines search_and_go_elated_header_type_parameters filter
     */
    function search_and_go_elated_get_header() {

        //will be read from options
        $header_type     = 'header-standard';
        $header_behavior = search_and_go_elated_options()->getOptionValue('header_behaviour');

        extract(search_and_go_elated_get_page_options());

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => search_and_go_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
                'menu_area_background_color' => $menu_area_background_color,
                'vertical_header_background_color' => $vertical_header_background_color,
                'vertical_header_opacity' => $vertical_header_opacity,
                'vertical_background_image' => $vertical_background_image
            );

            $parameters = apply_filters('search_and_go_elated_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('search_and_go_elated_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function search_and_go_elated_get_header_top() {

        //generate column width class
        switch(search_and_go_elated_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_widht_class = '50-50';
                break;
            case ('three-columns'):
                $column_widht_class = search_and_go_elated_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths'      => $column_widht_class,
            'show_widget_center' => search_and_go_elated_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
            'show_header_top'    => search_and_go_elated_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => search_and_go_elated_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('search_and_go_elated_header_top_params', $params);

        search_and_go_elated_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('search_and_go_elated_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function search_and_go_elated_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-standard';

        if($slug == 'sticky'){
            $logo_image = search_and_go_elated_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = search_and_go_elated_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = search_and_go_elated_options()->getOptionValue('logo_image_dark');
        $logo_image_light = search_and_go_elated_options()->getOptionValue('logo_image_light');


        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = search_and_go_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_styles' => $logo_styles
        );

        search_and_go_elated_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('search_and_go_elated_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function search_and_go_elated_get_main_menu($additional_class = 'eltd-default-nav') {
        search_and_go_elated_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('search_and_go_elated_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function search_and_go_elated_get_sticky_menu($additional_class = 'eltd-default-nav') {
		search_and_go_elated_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}


if(!function_exists('search_and_go_elated_get_vertical_main_menu')) {
    /**
     * Loads vertical menu HTML
     */
    function search_and_go_elated_get_vertical_main_menu() {
        search_and_go_elated_get_module_template_part('templates/parts/vertical-navigation', 'header', '');
    }
}



if(!function_exists('search_and_go_elated_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function search_and_go_elated_get_sticky_header() {

        $parameters = array(
            'hide_logo'             => search_and_go_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_header_in_grid' => search_and_go_elated_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
        );

        search_and_go_elated_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
    }
}

if(!function_exists('search_and_go_elated_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function search_and_go_elated_get_mobile_header() {
        if(search_and_go_elated_is_responsive_on()) {
            $header_type = 'header-standard';

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => search_and_go_elated_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'menu_opener_icon'       => search_and_go_elated_icon_collections()->getMobileMenuIcon(search_and_go_elated_options()->getOptionValue('mobile_icon_pack'), true),
                'show_navigation_opener' => has_nav_menu('main-navigation')
            );

            search_and_go_elated_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('search_and_go_elated_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function search_and_go_elated_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : 'header-standard';

        //check if mobile logo has been set and use that, else use normal logo
        if(search_and_go_elated_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = search_and_go_elated_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = search_and_go_elated_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = search_and_go_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        search_and_go_elated_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('search_and_go_elated_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function search_and_go_elated_get_mobile_nav() {

        $slug = 'header-standard';

        search_and_go_elated_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}

if(!function_exists('search_and_go_elated_get_page_options')) {
    /**
     * Gets options from page
     */
    function search_and_go_elated_get_page_options() {
        $id = search_and_go_elated_get_page_id();
        $page_options = array();
        $menu_area_background_color_rgba = '';
        $menu_area_background_color = '';
        $menu_area_background_transparency = '';
        $vertical_header_background_color = '';
        $vertical_header_opacity = '';
        $vertical_background_image = '';

        if(($meta_temp = get_post_meta($id, 'eltd_menu_area_background_color_header_standard_meta', true)) != '') {
            $menu_area_background_color = $meta_temp;
        }

        if(($meta_temp = get_post_meta($id, 'eltd_menu_area_background_transparency_header_standard_meta', true)) != '') {
            $menu_area_background_transparency = $meta_temp;
        }

        if(search_and_go_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
            $menu_area_background_color_rgba = 'background-color:'.search_and_go_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        $page_options['menu_area_background_color'] = $menu_area_background_color_rgba;
        $page_options['vertical_header_background_color'] = $vertical_header_background_color;
        $page_options['vertical_header_opacity'] = $vertical_header_opacity;
        $page_options['vertical_background_image'] = $vertical_background_image;

        return $page_options;
    }
}