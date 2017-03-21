<?php

$eltd_blog_categories = array();
$categories = get_categories();
foreach($categories as $category) {
    $eltd_blog_categories[$category->term_id] = $category->name;
}

$blog_meta_box = search_and_go_elated_add_meta_box(
    array(
        'scope' => array('page'),
        'title' => 'Blog',
        'name' => 'blog_meta'
    )
);

    search_and_go_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_blog_category_meta',
            'type'        => 'selectblank',
            'label'       => 'Blog Category',
            'description' => 'Choose category of posts to display (leave empty to display all categories)',
            'parent'      => $blog_meta_box,
            'options'     => $eltd_blog_categories
        )
    );

    search_and_go_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_show_posts_per_page_meta',
            'type'        => 'text',
            'label'       => 'Number of Posts',
            'description' => 'Enter the number of posts to display',
            'parent'      => $blog_meta_box,
            'args'        => array("col_width" => 3)
        )
    );
	

