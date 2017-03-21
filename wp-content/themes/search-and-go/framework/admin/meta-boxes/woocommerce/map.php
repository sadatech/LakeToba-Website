<?php

if (search_and_go_elated_is_woocommerce_installed()) {

	$product_meta_box = search_and_go_elated_add_meta_box(
			array(
					'scope' => array('product'),
					'title' => 'Product',
					'name' => 'product_meta'
			)
	);

	search_and_go_elated_add_meta_box_field(
			array(
					'name' => 'eltd_title_area_subtitle_meta',
					'type' => 'text',
					'default_value' => '',
					'label' => 'Subtitle Text',
					'description' => 'Enter your subtitle text',
					'parent' => $product_meta_box,
					'args' => array(
							'col_width' => 6
					)
			)
	);

	search_and_go_elated_add_meta_box_field(
			array(
					'name' => 'eltd_title_area_background_image_meta',
					'type' => 'image',
					'label' => 'Background Image',
					'description' => 'Choose an Image for Title Area',
					'parent' => $product_meta_box
			)
	);

}