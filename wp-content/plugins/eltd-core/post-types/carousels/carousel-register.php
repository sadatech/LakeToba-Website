<?php
namespace ElatedCore\CPT\Carousels;

use ElatedCore\Lib;

/**
 * Class CarouselRegister
 * @package ElatedCore\CPT\Carousels
 */
class CarouselRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base = 'carousels';
        $this->taxBase = 'carousels_category';
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $search_and_go_elated_Framework;

        $menuPosition = 5;
        $menuIcon = 'dashicons-admin-post';
        if(eltd_core_theme_installed()) {
            $menuPosition = $search_and_go_elated_Framework->getSkin()->getMenuItemPosition('carousel');
            $menuIcon = $search_and_go_elated_Framework->getSkin()->getMenuIcon('carousel');
        }

        register_post_type($this->base,
            array(
                'labels'    => array(
                    'name'        => __('Elated Carousel','eltd_core' ),
                    'menu_name' => __('Elated Carousel','eltd_core' ),
                    'all_items' => __('Carousel Items','eltd_core' ),
                    'add_new' =>  __('Add New Carousel Item','eltd_core'),
                    'singular_name'   => __('Carousel Item','eltd_core' ),
                    'add_item'      => __('New Carousel Item','eltd_core'),
                    'add_new_item'    => __('Add New Carousel Item','eltd_core'),
                    'edit_item'     => __('Edit Carousel Item','eltd_core')
                ),
                'public'    =>  false,
                'show_in_menu'  =>  true,
                'rewrite'     =>  array('slug' => 'carousels'),
                'menu_position' =>  $menuPosition,
                'show_ui'   =>  true,
                'has_archive' =>  false,
                'hierarchical'  =>  false,
                'supports'    =>  array('title'),
                'menu_icon'  =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Carousels', 'taxonomy general name' ),
            'singular_name' => __( 'Carousel', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Carousels','eltd_core' ),
            'all_items' => __( 'All Carousels','eltd_core' ),
            'parent_item' => __( 'Parent Carousel','eltd_core' ),
            'parent_item_colon' => __( 'Parent Carousel:','eltd_core' ),
            'edit_item' => __( 'Edit Carousel','eltd_core' ),
            'update_item' => __( 'Update Carousel','eltd_core' ),
            'add_new_item' => __( 'Add New Carousel','eltd_core' ),
            'new_item_name' => __( 'New Carousel Name','eltd_core' ),
            'menu_name' => __( 'Carousels','eltd_core' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'carousels-category' ),
        ));
    }

}