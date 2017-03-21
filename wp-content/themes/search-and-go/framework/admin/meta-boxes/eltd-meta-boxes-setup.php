<?php

add_action('after_setup_theme', 'search_and_go_elated_meta_boxes_map_init', 1);
function search_and_go_elated_meta_boxes_map_init() {
    /**
    * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
    * and loads map.php file in each.
    *
    * @see http://php.net/manual/en/function.glob.php
    */

    do_action('search_and_go_elated_before_meta_boxes_map');

	global $search_and_go_elated_options;
	global $search_and_go_elated_Framework;
	global $search_and_go_elated_options_fontstyle;
	global $search_and_go_elated_options_fontweight;
	global $search_and_go_elated_options_texttransform;
	global $search_and_go_elated_options_fontdecoration;
	global $search_and_go_elated_options_arrows_type;
	global $search_and_go_elated_IconCollections;

    foreach(glob(ELATED_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
        include_once $meta_box_load;
    }

	do_action('search_and_go_elated_meta_boxes_map');

	do_action('search_and_go_elated_after_meta_boxes_map');
}