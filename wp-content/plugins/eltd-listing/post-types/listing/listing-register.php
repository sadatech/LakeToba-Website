<?php
namespace ElatedListing\CPT\Listing;

use ElatedListing\Lib\PostTypeInterface;

/**
 * Class ListingRegister
 * @package ElatedListing\CPT\Listing
 */
class ListingRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'listing-item';
        $this->taxBase = 'listing-item-category';

        add_filter('single_template', array($this, 'registerSingleTemplate'));
        add_filter('manage_' . $this->base . '_posts_columns', array($this, 'add_listing_item_admin_table_columns'));
        add_action( 'manage_' . $this->base . '_posts_custom_column', array($this,'manage_listing_item_admin_table_columns'), 10, 2 );
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
        $this->registerTagTax();
		$this->registerLocationTax();
    }

    /**
     * Registers listing-item single template if one does'nt exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-listing-item.php')) {
                return ELATED_LISTING_CPT_PATH.'/listing/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $search_and_go_elated_Framework, $search_and_go_elated_options;

        $menuPosition = 5;
        $menuIcon = 'dashicons-portfolio';
        $slug = $this->base;
        if(eltd_listing_theme_installed()) {
            $custom_slug = search_and_go_elated_options()->getOptionValue('listing_item_single_slug');
            if(isset($custom_slug) && $custom_slug !== '') {
                $slug = $custom_slug;
            }

        }

        register_post_type( $this->base,
            array(
                'labels' => array(
                    'name' => __( 'Listing','eltd_listing' ),
                    'singular_name' => __( 'Listing Item','eltd_listing' ),
                    'add_item' => __('New Listing Item','eltd_listing'),
                    'add_new_item' => __('Add New Listing Item','eltd_listing'),
                    'edit_item' => __('Edit Listing Item','eltd_listing')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui' => true,
                'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'  =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => __( 'Listing Categories', 'eltd_listing' ),
            'singular_name' => __( 'Listing Category', 'eltd_listing' ),
            'search_items' =>  __( 'Search Listing Categories','eltd_listing' ),
            'all_items' => __( 'All Listing Categories','eltd_listing' ),
            'parent_item' => __( 'Parent Listing Category','eltd_listing' ),
            'parent_item_colon' => __( 'Parent Listing Category:','eltd_listing' ),
            'edit_item' => __( 'Edit Listing Category','eltd_listing' ),
            'update_item' => __( 'Update Listing Category','eltd_listing' ),
            'add_new_item' => __( 'Add New Listing Category','eltd_listing' ),
            'new_item_name' => __( 'New Listing Category Name','eltd_listing' ),
            'menu_name' => __( 'Listing Categories','eltd_listing' ),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'listing-item-category' ),
        ));
    }

    /**
     * Registers custom tag taxonomy with WordPress
     */
    private function registerTagTax() {
        $labels = array(
            'name' => __( 'Listing Tags', 'eltd_listing' ),
            'singular_name' => __( 'Listing Tag', 'eltd_listing' ),
            'search_items' =>  __( 'Search Listing Tags','eltd_listing' ),
            'all_items' => __( 'All Listing Tags','eltd_listing' ),
            'parent_item' => __( 'Parent Listing Tag','eltd_listing' ),
            'parent_item_colon' => __( 'Parent Listing Tags:','eltd_listing' ),
            'edit_item' => __( 'Edit Listing Tag','eltd_listing' ),
            'update_item' => __( 'Update Listing Tag','eltd_listing' ),
            'add_new_item' => __( 'Add New Listing Tag','eltd_listing' ),
            'new_item_name' => __( 'New Listing Tag Name','eltd_listing' ),
            'menu_name' => __( 'Listing Tags','eltd_listing' ),
        );

        register_taxonomy('listing-item-tag',array($this->base), array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
			'sort'	=> true,
			'args' => array('orderby' => 'term_order'), 
            'rewrite' => array( 'slug' => 'listing-item-tag' ),
        ));
    }
	/**
     * Registers custom tag taxonomy with WordPress
     */
    private function registerLocationTax() {
        $labels = array(
            'name' => __( 'Listing Locations', 'eltd_listing' ),
            'singular_name' => __( 'Listing Location', 'eltd_listing' ),
            'search_items' =>  __( 'Search Listing Locations','eltd_listing' ),
            'all_items' => __( 'All Listing Locations','eltd_listing' ),
            'parent_item' => __( 'Parent Listing Locations','eltd_listing' ),
            'parent_item_colon' => __( 'Parent Listing Locations:','eltd_listing' ),
            'edit_item' => __( 'Edit Listing Location','eltd_listing' ),
            'update_item' => __( 'Update Listing Location','eltd_listing' ),
            'add_new_item' => __( 'Add New Listing Location','eltd_listing' ),
            'new_item_name' => __( 'New Listing Locations Name','eltd_listing' ),
            'menu_name' => __( 'Listing Locations','eltd_listing' ),
        );

        register_taxonomy('listing-item-location',array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'listing-item-location' ),
        ));
    }

    public function add_listing_item_admin_table_columns( $columns ) {

        return array_merge( $columns, array(
            'payment_status' => esc_html__( 'Status', 'eltd_listing' ),
            'directory_type' => esc_html__( 'Directory Type', 'eltd_listing' )
        ) );

    }

    public function manage_listing_item_admin_table_columns( $column, $post_id ) {
        switch( $column ) {
            case 'payment_status':
                $status = false;
                $listing_package_id = get_post_meta($post_id, 'eltd_listing_package', true);
                $user_id = get_the_author_meta('ID');
                if ( $listing_package_id ) {
                    $status = eltd_listing_get_package_payment_status( $user_id, $listing_package_id);
                }
                if ( $status ) {
                    echo '<h4>'.esc_html_e('Active', 'eltd_listing').'</h4>';
                }
                break;
            case 'directory_type':
                $listing_type_id = get_post_meta($post_id, 'eltd_listing_item_type', true);
                $directory_type = get_the_title( $listing_type_id );
                echo '<h4>' .$directory_type. '</h4>';
                break;
        }
    }

}