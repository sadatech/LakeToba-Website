<?php

$header_meta_box = search_and_go_elated_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header_meta'
    )
);
    search_and_go_elated_add_meta_box_field(
        array(
            'name' => 'eltd_header_style_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => 'Header Skin',
            'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
            'parent' => $header_meta_box,
            'options' => array(
                '' => '',
                'light-header' => 'Light',
                'dark-header' => 'Dark'
            )
        )
    );

    search_and_go_elated_add_meta_box_field(
        array(
            'parent' => $header_meta_box,
            'type' => 'select',
            'name' => 'eltd_enable_header_style_on_scroll_meta',
            'default_value' => '',
            'label' => 'Enable Header Style on Scroll',
            'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            )
        )
    );

    search_and_go_elated_add_meta_box_field(
        array(
            'name' => 'eltd_menu_area_background_color_header_standard_meta',
            'type' => 'color',
            'label' => 'Background Color',
            'description' => 'Choose a background color for header area',
            'parent' => $header_meta_box
        )
    );

    search_and_go_elated_add_meta_box_field(
        array(
            'name' => 'eltd_menu_area_background_transparency_header_standard_meta',
            'type' => 'text',
            'label' => 'Transparency',
            'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
            'parent' => $header_meta_box,
            'args' => array(
                'col_width' => 2
            )
        )
    );
