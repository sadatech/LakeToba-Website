<?php

require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/eltd.kses.php";
require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/eltd.layout.inc";
require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/eltd.optionsapi.inc";
require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/google-fonts.inc";
require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/eltd.framework.inc";
require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/eltd.functions.inc";
require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/eltd.common.php";
require_once ELATED_FRAMEWORK_ROOT_DIR."/lib/eltd.icons/eltd.icons.php";
require_once ELATED_FRAMEWORK_ROOT_DIR."/admin/options/eltd-options-setup.php";
require_once ELATED_FRAMEWORK_ROOT_DIR."/admin/meta-boxes/eltd-meta-boxes-setup.php";
require_once ELATED_FRAMEWORK_ROOT_DIR."/modules/eltd-modules-loader.php";

global $search_and_go_elated_Framework;

if(!function_exists('search_and_go_elated_admin_scripts_init')) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function search_and_go_elated_admin_scripts_init() {

        /**
         * @see ElatedSkinAbstract::registerScripts - hooked with 10
         * @see ElatedSkinAbstract::registerStyles - hooked with 10
         */
        do_action('search_and_go_elated_admin_scripts_init');
	}

	add_action('admin_init', 'search_and_go_elated_admin_scripts_init');
}

if(!function_exists('search_and_go_elated_enqueue_admin_styles')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function search_and_go_elated_enqueue_admin_styles() {
		wp_enqueue_style('wp-color-picker');

        /**
         * @see ElatedSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('search_and_go_elated_enqueue_admin_styles');
	}
}

if(!function_exists('search_and_go_elated_enqueue_admin_scripts')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function search_and_go_elated_enqueue_admin_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script("eltd-dependence", get_template_directory_uri().'/framework/admin/assets/js/eltd-ui/eltd-dependence.js', array(), false, true);
        wp_enqueue_script("eltd-twitter-connect", get_template_directory_uri().'/framework/admin/assets/js/eltd-twitter-connect.js', array(), false, true);

        /**
         * @see ElatedSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('search_and_go_elated_enqueue_admin_scripts');
	}
}

if(!function_exists('search_and_go_elated_enqueue_meta_box_styles')) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function search_and_go_elated_enqueue_meta_box_styles() {
		wp_enqueue_style( 'wp-color-picker' );

        /**
         * @see ElatedSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('search_and_go_elated_enqueue_meta_box_styles');
	}
}

if(!function_exists('search_and_go_elated_enqueue_meta_box_scripts')) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function search_and_go_elated_enqueue_meta_box_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script('eltd-dependence');

        /**
         * @see ElatedSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('search_and_go_elated_enqueue_meta_box_scripts');
	}
}

if(!function_exists('search_and_go_elated_enqueue_nav_menu_script')) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 * @param $hook string current page hook to check
	 */
	function search_and_go_elated_enqueue_nav_menu_script($hook) {
		if($hook == 'nav-menus.php') {
			wp_enqueue_script('eltd-nav-menu', get_template_directory_uri().'/framework/admin/assets/js/eltd-nav-menu.js');
			wp_enqueue_style('eltd-nav-menu', get_template_directory_uri().'/framework/admin/assets/css/eltd-nav-menu.css');
		}
	}

	add_action('admin_enqueue_scripts', 'search_and_go_elated_enqueue_nav_menu_script');
}


if(!function_exists('search_and_go_elated_enqueue_widgets_admin_script')) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 * @param $hook string current page hook to check
	 */
	function search_and_go_elated_enqueue_widgets_admin_script($hook) {
		if($hook == 'widgets.php') {
			wp_enqueue_script('eltd-dependence');
		}
	}

	add_action('admin_enqueue_scripts', 'search_and_go_elated_enqueue_widgets_admin_script');
}


if(!function_exists('search_and_go_elated_enqueue_styles_slider_taxonomy')) {
	/**
	 * Enqueue styles when on slider taxonomy page in admin
	 */
	function search_and_go_elated_enqueue_styles_slider_taxonomy() {
		if(isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'slides_category') {
			search_and_go_elated_enqueue_admin_styles();
		}
	}

	add_action('admin_print_scripts-edit-tags.php', 'search_and_go_elated_enqueue_styles_slider_taxonomy');
}

if(!function_exists('search_and_go_elated_init_theme_options_array')) {
	/**
	 * Function that merges $search_and_go_elated_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function search_and_go_elated_init_theme_options_array() {
        global $search_and_go_elated_options, $search_and_go_elated_Framework;

		$db_options = get_option('eltd_options_search_and_go');

		//does eltd_options exists in db?
		if(is_array($db_options)) {
			//merge with default options
			$search_and_go_elated_options  = array_merge($search_and_go_elated_Framework->eltdOptions->options, get_option('eltd_options_search_and_go'));
		} else {
			//options don't exists in db, take default ones
			$search_and_go_elated_options = $search_and_go_elated_Framework->eltdOptions->options;
		}
	}

	add_action('search_and_go_elated_after_options_map', 'search_and_go_elated_init_theme_options_array', 0);
}

if(!function_exists('search_and_go_elated_init_theme_options')) {
	/**
	 * Function that sets $search_and_go_elated_options variable if it does'nt exists
	 */
	function search_and_go_elated_init_theme_options() {
		global $search_and_go_elated_options;
		global $search_and_go_elated_Framework;
		if(isset($search_and_go_elated_options['reset_to_defaults'])) {
			if( $search_and_go_elated_options['reset_to_defaults'] == 'yes' ) delete_option( "eltd_options_search_and_go");
		}

		if (!get_option("eltd_options_search_and_go")) {
			add_option( "eltd_options_search_and_go",
				$search_and_go_elated_Framework->eltdOptions->options
			);

			$search_and_go_elated_options = $search_and_go_elated_Framework->eltdOptions->options;
		}
	}
}

if(!function_exists('search_and_go_elated_register_theme_settings')) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function search_and_go_elated_register_theme_settings() {
		register_setting( 'search_and_go_elated_theme_menu', 'eltd_options' );
	}

	add_action('admin_init', 'search_and_go_elated_register_theme_settings');
}

if(!function_exists('search_and_go_elated_get_admin_tab')) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function search_and_go_elated_get_admin_tab(){
		return isset($_GET['page']) ? search_and_go_elated_strafter($_GET['page'],'tab') : NULL;
	}
}

if(!function_exists('search_and_go_elated_strafter')) {
	/**
	 * Function that returns string that comes after found string
	 * @param $string string where to search
	 * @param $substring string what to search for
	 * @return null|string string that comes after found string
	 */
	function search_and_go_elated_strafter($string, $substring) {
		$pos = strpos($string, $substring);
		if ($pos === false) {
			return NULL;
		}

		return(substr($string, $pos+strlen($substring)));
	}
}

if(!function_exists('search_and_go_elated_save_options')) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_eltd_save_options action.
	 */
	function search_and_go_elated_save_options() {
		global $search_and_go_elated_options;

		$_REQUEST = stripslashes_deep($_REQUEST);

        unset($_REQUEST['action']);

		$search_and_go_elated_options = array_merge($search_and_go_elated_options, $_REQUEST);

		update_option( 'eltd_options_search_and_go', $search_and_go_elated_options );

		do_action('search_and_go_elated_after_theme_option_save');
		echo "Saved";

		die();
	}

	add_action('wp_ajax_search_and_go_elated_save_options', 'search_and_go_elated_save_options');
}

if(!function_exists('search_and_go_elated_meta_box_add')) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function search_and_go_elated_meta_box_add() {
		global $search_and_go_elated_Framework;


		foreach ($search_and_go_elated_Framework->eltdMetaBoxes->metaBoxes as $key=>$box ) {
			$hidden = false;
			if (!empty($box->hidden_property)) {
				foreach ($box->hidden_values as $value) {
					if (search_and_go_elated_option_get_value($box->hidden_property)==$value)
						$hidden = true;

				}
			}

			if(is_string($box->scope)) {
				$box->scope = array($box->scope);
			}

			if(is_array($box->scope) && count($box->scope)) {
				foreach($box->scope as $screen) {
					add_meta_box(
						'eltd-meta-box-'.$key,
						$box->title,
                        'search_and_go_elated_render_meta_box',
						$screen,
						'advanced',
						'high',
						array( 'box' => $box)
					);

					if ($hidden) {
						add_filter( 'postbox_classes_'.$screen.'_eltd-meta-box-'.$key, 'search_and_go_elated_meta_box_add_hidden_class');
					}
				}
			}

		}

		add_action('admin_enqueue_scripts', 'search_and_go_elated_enqueue_meta_box_styles');
		add_action('admin_enqueue_scripts', 'search_and_go_elated_enqueue_meta_box_scripts');
	}

	add_action('add_meta_boxes', 'search_and_go_elated_meta_box_add');
}

if(!function_exists('search_and_go_elated_meta_box_save')) {
	/**
	 * Function that saves meta box to postmeta table
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function search_and_go_elated_meta_box_save( $post_id, $post ) {
		global $search_and_go_elated_Framework;

		$nonces_array = array();
		$meta_boxes = search_and_go_elated_framework()->eltdMetaBoxes->getMetaBoxesByScope($post->post_type);
		
		if(is_array($meta_boxes) && count($meta_boxes)) {
			foreach($meta_boxes as $meta_box) {
				$nonces_array[] = 'search_and_go_elated_meta_box_'.$meta_box->name.'_save';
			}
		}

		if(is_array($nonces_array) && count($nonces_array)) {
			foreach($nonces_array as $nonce) {
				if(!isset($_POST[$nonce]) || !wp_verify_nonce($_POST[$nonce], $nonce)) {
					return;
				}
			}
		}

		$postTypes = array( "page", "post", "portfolio-item", "testimonials", "slides", "carousels", "masonry_gallery", "listing-item", "listing-type-item", "listing-package");

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!isset( $_POST[ '_wpnonce' ])) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (!in_array($post->post_type, $postTypes)) {
			return;
		}

		foreach ($search_and_go_elated_Framework->eltdMetaBoxes->options as $key=>$box ) {
			if (isset($_POST[$key]) && trim($_POST[$key] !== '')) {

				$value = $_POST[$key];
				
				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}
		$portfolios = false;
		if (isset($_POST['optionLabel'])) {
			foreach ($_POST['optionLabel'] as $key => $value) {
				$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]);
				$portfolios = true;

			}
		}

		if ($portfolios) {
			update_post_meta( $post_id,  'eltd_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'eltd_portfolios' );
		}

		$portfolio_images = false;
		if (isset($_POST['portfolioimg'])) {
			foreach ($_POST['portfolioimg'] as $key => $value) {
				$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key], 'portfoliovideoimage'=>$_POST['portfoliovideoimage'][$key], 'portfoliovideowebm'=>$_POST['portfoliovideowebm'][$key], 'portfoliovideomp4'=>$_POST['portfoliovideomp4'][$key], 'portfoliovideoogv'=>$_POST['portfoliovideoogv'][$key], 'portfolioimgtype'=>$_POST['portfolioimgtype'][$key] );
				$portfolio_images = true;
			}
		}


		if ($portfolio_images) {
			update_post_meta( $post_id,  'eltd_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id,  'eltd_portfolio_images' );
		}

        $custom_fields_flag = false;
        if(isset($_POST['eltd_custom_field_type'])){
            $custom_fields_flag = true;
            $case1_counter = 0;
            $case2_counter = 0;

            foreach($_POST['eltd_custom_field_type'] as $key => $value){
                switch ($value){
                    case 'text':
                    case 'textarea':
                    case 'checkbox':
						$icon_pack = $_POST['eltd_custom_field_icon_pack'][$key];
	                    $custom_fields[$key] = array(
							'type' => $value,
							'required' => $_POST['eltd_custom_field_required'][$case1_counter],
							'meta_key' => sanitize_title($_POST['eltd_custom_field_meta_key'][$key]),
							'title' => $_POST['eltd_custom_field_title'][$key],
		                    'icon_pack' => $icon_pack,
                        );
	                    $icon_field = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey( $icon_pack );
	                    $custom_fields[$key]['icon'] = $_POST['eltd_custom_field_'.$icon_field][$key];
	                    $default_value = isset( $_POST['eltd_custom_field_default_value'][$case1_counter] ) ? $_POST['eltd_custom_field_default_value'][$case1_counter] : '';
						$custom_fields[ $key ]['default_value'] = $default_value;
						
                        $case1_counter++;
                        break;
                    case 'select':
                        $def_value_index = (int)$_POST['eltd_custom_field_options_default'][$case2_counter];
                        $custom_fields[$key] = array('type'=>'select','meta_key'=>sanitize_title($_POST['eltd_custom_field_meta_key'][$key]),'title'=>$_POST['eltd_custom_field_title'][$key],'options'=>array_combine($_POST['eltd_custom_field_options_value'][$case2_counter],$_POST['eltd_custom_field_options_label'][$case2_counter]),'default_value'=>$_POST['eltd_custom_field_options_value'][$case2_counter][$def_value_index],'default_value_index'=>$def_value_index);

	                    $icon_pack = $_POST['eltd_custom_field_icon_pack'][$key];
	                    $icon_field = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey( $icon_pack );
	                    $custom_fields[$key]['icon_pack'] = $icon_pack;
	                    $custom_fields[$key]['icon'] = $_POST['eltd_custom_field_'.$icon_field][$key];

                        $case2_counter++;
                        break;
                }
            }
        }

        if($custom_fields_flag){
            update_post_meta( $post_id,  'eltd_listing_type_custom_fields', $custom_fields );
        }else{
            delete_post_meta( $post_id,  'eltd_listing_type_custom_fields' );
        }

		if ( isset($_POST['eltd_listing_address']) && $_POST['eltd_listing_address'] !== '' ) {
			update_post_meta($post_id, 'eltd_listing_address_latitude', $_POST['eltd_listing_address_latitude']);
			update_post_meta($post_id, 'eltd_listing_address_longitude', $_POST['eltd_listing_address_longitude']);
		} else {
			delete_post_meta( $post_id,  'eltd_listing_address_latitude' );
			delete_post_meta( $post_id,  'eltd_listing_address_longitude' );
		}

	}

	add_action( 'save_post', 'search_and_go_elated_meta_box_save', 1, 2 );
}

if(!function_exists('search_and_go_elated_render_meta_box')) {
	/**
	 * Function that renders meta box
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function search_and_go_elated_render_meta_box($post, $metabox) {?>

		<div class="eltd-meta-box eltd-page">
			<div class="eltd-meta-box-holder">

				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field('search_and_go_elated_meta_box_'.$metabox['args']['box']->name.'_save', 'search_and_go_elated_meta_box_'.$metabox['args']['box']->name.'_save'); ?>

			</div>
		</div>

	<?php
	}
}

if(!function_exists('search_and_go_elated_meta_box_add_hidden_class')) {
	/**
	 * Function that adds class that will initially hide meta box
	 * @param array $classes array of classes
	 * @return array modified array of classes
	 */
	function search_and_go_elated_meta_box_add_hidden_class( $classes=array() ) {
		if( !in_array( 'eltd-meta-box-hidden', $classes ) )
			$classes[] = 'eltd-meta-box-hidden';

		return $classes;
	}

}

if(!function_exists('search_and_go_elated_remove_default_custom_fields')) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function search_and_go_elated_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( array( "page", "post", "portfolio_page", "testimonials", "slides", "carousels" ) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action('do_meta_boxes', 'search_and_go_elated_remove_default_custom_fields');
}


if(!function_exists('search_and_go_elated_get_custom_sidebars')) {
	/**
	 * Function that returns all custom made sidebars.
	 *
	 * @uses get_option()
	 * @return array array of custom made sidebars where key and value are sidebar name
	 */
	function search_and_go_elated_get_custom_sidebars() {
		$custom_sidebars = get_option('eltd_sidebars');
		$formatted_array = array();

		if(is_array($custom_sidebars) && count($custom_sidebars)) {
			foreach ($custom_sidebars as $custom_sidebar) {
				$formatted_array[sanitize_title($custom_sidebar)] = $custom_sidebar;
			}
		}

		return $formatted_array;
	}
}

if(!function_exists('search_and_go_elated_generate_icon_pack_options')) {
    /**
     * Generates options HTML for each icon in given icon pack
     * Hooked to wp_ajax_update_admin_nav_icon_options action
     */
    function search_and_go_elated_generate_icon_pack_options() {
        global $search_and_go_elated_IconCollections;

        $html = '';
        $icon_pack = isset($_POST['icon_pack']) ? $_POST['icon_pack'] : '';
        $collections_object = $search_and_go_elated_IconCollections->getIconCollection($icon_pack);

        if($collections_object) {
            $icons = $collections_object->getIconsArray();
            if(is_array($icons) && count($icons)) {
                foreach ($icons as $key => $icon) {
                    $html .= '<option value="'.esc_attr($key).'">'.esc_html($key).'</option>';
                }
            }
        }

        print $html;
    }

    add_action('wp_ajax_update_admin_nav_icon_options', 'search_and_go_elated_generate_icon_pack_options');
}

if(!function_exists('search_and_go_elated_admin_notice')) {
    /**
     * Prints admin notice. It checks if notice has been disabled and if it hasn't then it displays it
     * @param $id string id of notice. It will be used to store notice dismis
     * @param $message string message to show to the user
     * @param $class string HTML class of notice
     * @param bool $is_dismisable whether notice is dismisable or not
     */
    function search_and_go_elated_admin_notice($id, $message, $class, $is_dismisable = true) {
        $is_dismised = get_user_meta(get_current_user_id(), 'dismis_'.$id);

        //if notice isn't dismissed
        if(!$is_dismised && is_admin()) {
            echo '<div style="display: block;" class="'.esc_attr($class).' is-dismissible notice">';
            echo '<p>';

            echo wp_kses_post($message);

            if($is_dismisable) {
                echo '<strong style="display: block; margin-top: 7px;"><a href="'.esc_url(add_query_arg('eltd_dismis_notice', $id)).'">'.esc_html__('Dismiss this notice', 'search-and-go').'</a></strong>';
            }

            echo '</p>';

            echo '</div>';
        }

    }
}

if(!function_exists('search_and_go_elated_save_dismisable_notice')) {
    /**
     * Updates user meta with dismisable notice. Hooks to admin_init action
     * in order to check this on every page request in admin
     */
    function search_and_go_elated_save_dismisable_notice() {
        if(is_admin() && !empty($_GET['eltd_dismis_notice'])) {
            $notice_id = sanitize_key($_GET['eltd_dismis_notice']);
            $current_user_id = get_current_user_id();

            update_user_meta($current_user_id, 'dismis_'.$notice_id, 1);
        }
    }

    add_action('admin_init', 'search_and_go_elated_save_dismisable_notice');
}

if(!function_exists('search_and_go_elated_hook_twitter_request_ajax')) {
    /**
     * Wrapper function for obtaining twitter request token.
     * Hooks to wp_ajax_eltd_twitter_obtain_request_token ajax action
     *
     * @see ElatedTwitterApi::obtainRequestToken()
     */
    function search_and_go_elated_hook_twitter_request_ajax() {
        ElatedTwitterApi::getInstance()->obtainRequestToken();
    }

    add_action('wp_ajax_eltd_twitter_obtain_request_token', 'search_and_go_elated_hook_twitter_request_ajax');
}

if(!function_exists('search_and_go_elated_clone_field')) {
    /**
     * Return fields' html
     */
    function search_and_go_elated_clone_field()
    {
        if (isset($_POST['type'])) {
            $count = $_POST['count'];
            foreach ($_POST['type'] as $type) {
                switch (strtolower($type)) {

                    case 'text':
                        $field = new SearchAndGoFieldText();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'textsimple':
                        $field = new SearchAndGoFieldTextSimple();
                        $field->render('eltd_repeated_field', '', '', array(), array(), false, array('index' => $count, 'value' => ''));
                        break;

                    case 'textarea':
                        $field = new SearchAndGoFieldTextArea();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'textareasimple':
                        $field = new SearchAndGoFieldTextAreaSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'color':
                        $field = new SearchAndGoFieldColor();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'colorsimple':
                        $field = new SearchAndGoFieldColorSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'image':
                        $field = new SearchAndGoFieldImage();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'imagesimple':
                        $field = new SearchAndGoFieldImageSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'font':
                        $field = new SearchAndGoFieldFont();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'fontsimple':
                        $field = new SearchAndGoFieldFontSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'select':
                        $field = new SearchAndGoFieldSelect();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'selectblank':
                        $field = new SearchAndGoFieldSelectBlank();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'selectsimple':
                        $field = new SearchAndGoFieldSelectSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'selectblanksimple':
                        $field = new SearchAndGoFieldSelectBlankSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'yesno':
                        $field = new SearchAndGoFieldYesNo();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'yesnosimple':
                        $field = new SearchAndGoFieldYesNoSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'onoff':
                        $field = new SearchAndGoFieldOnOff();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'portfoliofollow':
                        $field = new SearchAndGoFieldPortfolioFollow();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'zeroone':
                        $field = new SearchAndGoFieldZeroOne();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'imagevideo':
                        $field = new SearchAndGoFieldImageVideo();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'yesempty':
                        $field = new SearchAndGoFieldYesEmpty();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'flagpost':
                        $field = new SearchAndGoFieldFlagPost();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'flagpage':
                        $field = new SearchAndGoFieldFlagPage();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'flagmedia':
                        $field = new SearchAndGoFieldFlagMedia();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'flagportfolio':
                        $field = new SearchAndGoFieldFlagPortfolio();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'flagproduct':
                        $field = new SearchAndGoFieldFlagProduct();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'range':
                        $field = new SearchAndGoFieldRange();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'rangesimple':
                        $field = new SearchAndGoFieldRangeSimple();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'radio':
                        $field = new SearchAndGoFieldRadio();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'checkbox':
                        $field = new SearchAndGoFieldCheckBox();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;

                    case 'date':
                        $field = new SearchAndGoFieldDate();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;
                    case 'radiogroup':
                        $field = new SearchAndGoFieldRadioGroup();
                        $field->render($name, $label, $description, $options, $args, $hidden);
                        break;
                    default:
                        break;

                }
            }
        }
        wp_die();
    }

    add_action('wp_ajax_search_and_go_elated_clone_field', 'search_and_go_elated_clone_field');
}

if ( ! function_exists( 'search_and_go_elated_add_taxonomy_media_upload' ) ) {
	/**
	 * Enqueue media upload on taxonomy pages
	 */
	function search_and_go_elated_add_taxonomy_media_upload() {

		if(isset($_GET['taxonomy'])) {
			wp_enqueue_media();
			wp_enqueue_script('search_and_go_elated_taxonomy_upload_script', get_template_directory_uri().'/framework/admin/assets/js/eltd-upload-taxonomy.js');
		}
	}
	add_action( 'admin_enqueue_scripts', 'search_and_go_elated_add_taxonomy_media_upload' );

}

?>