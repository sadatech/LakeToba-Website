<?php

$footer_meta_box = search_and_go_elated_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Footer',
        'name' => 'footer_meta'
    )
);

    search_and_go_elated_add_meta_box_field(
        array(
            'name' => 'eltd_disable_footer_meta',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Disable Footer for this Page',
            'description' => 'Enabling this option will hide footer on this page',
            'parent' => $footer_meta_box,
        )
    );

    search_and_go_elated_add_meta_box_field(
        array(
            'name' => 'eltd_footer_background_image_meta',
            'type' => 'image',
            'default_value' => '',
            'label' => 'Footer Background Image for this Page',
            'parent' => $footer_meta_box,
        )
    );
