<?php
namespace ElatedListing\CPT\ListingType;

use ElatedListing\Lib\PostTypeInterface;

/**
 * Class ListingTypeRegister
 * @package ElatedListing\CPT\ListingType
 */
class ListingTypeRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'listing-type-item';
        $this->taxBase = 'listing-type-category';
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
        //$this->registerTax();
    }



    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {

        $slug = $this->base;

        register_post_type( $this->base,
            array(
                'labels' => array(
                    'name' => __( 'Listing Type','eltd_listing' ),
                    'singular_name' => __( 'Listing Type','eltd_listing' ),
                    'add_item' => __('New Listing Type','eltd_listing'),
                    'add_new_item' => __('Add New Listing Type','eltd_listing'),
                    'edit_item' => __('Edit Listing Type','eltd_listing')
                ),
                'public' => false,
                'has_archive' => false,
                'rewrite' => array('slug' => $slug),
                'show_ui' => true,
				'capability_type'     => 'post',
			    'show_in_menu' 		  => 'edit.php?post_type=listing-item',
	            'show_in_nav_menus'   => true,
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'hierarchical'        => false, 
				'query_var'           => true,
				'supports'            => array( 'title' )
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Listing Type Categories', 'taxonomy general name' ),
            'singular_name' => __( 'Listing Type Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Listing Type','eltd_listing' ),
            'all_items' => __( 'All Listing Type','eltd_listing' ),
            'parent_item' => __( 'Parent Listing Type','eltd_listing' ),
            'parent_item_colon' => __( 'Parent Listing Type:','eltd_listing' ),
            'edit_item' => __( 'Edit Listing Type','eltd_listing' ),
            'update_item' => __( 'Update Listing Type','eltd_listing' ),
            'add_new_item' => __( 'Add New Listing Type','eltd_listing' ),
            'new_item_name' => __( 'New Listing Type Name','eltd_listing' ),
            'menu_name' => __( 'Listing Type Categories','eltd_listing' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
			'public' => true,
            'rewrite' => array( 'slug' => $this->taxBase ),
        ));
    }
}