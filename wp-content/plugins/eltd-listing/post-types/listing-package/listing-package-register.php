<?php
namespace ElatedListing\CPT\ListingPackage;

use ElatedListing\Lib\PostTypeInterface;

/**
 * Class ListingPackageRegister
 * @package ElatedListing\CPT\ListingPackage
 */
class ListingPackageRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'listing-package';
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
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {

        $slug = $this->base;

        register_post_type( $this->base,
            array(
                'labels' => array(
                    'name' => __( 'Listing Package','eltd_listing' ),
                    'singular_name' => __( 'Listing Package','eltd_listing' ),
                    'add_item' => __('New Listing Package','eltd_listing'),
                    'add_new_item' => __('Add New Listing Package','eltd_listing'),
                    'edit_item' => __('Edit Listing Package','eltd_listing')
                ),
                'public' => false,
                'has_archive' => false,
                'rewrite' => array('slug' => $slug),
                'show_ui' => true,
                'supports' => array('page-attributes', 'title'),
		'capability_type'     => 'post',
		'show_in_menu' 		  => 'edit.php?post_type=listing-item',
		'map_meta_cap'        => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'hierarchical'        => false, 
		'query_var'           => true,
            )
        );
    }
}