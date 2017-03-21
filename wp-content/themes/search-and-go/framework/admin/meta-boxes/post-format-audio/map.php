<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = search_and_go_elated_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Audio Post Format',
		'name' 	=> 'post_format_audio_meta'
	)
);

search_and_go_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_audio_link_meta',
		'type'        => 'text',
		'label'       => 'Link',
		'description' => 'Enter audion link',
		'parent'      => $audio_post_format_meta_box,

	)
);
