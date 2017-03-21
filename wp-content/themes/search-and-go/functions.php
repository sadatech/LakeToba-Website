<?php
include_once get_template_directory().'/theme-includes.php';

if(!function_exists('search_and_go_elated_styles')) {
    /**
     * Function that includes theme's core styles
     */
    function search_and_go_elated_styles() {
        wp_register_style('search_and_go_elated_blog', ELATED_ASSETS_ROOT.'/css/blog.min.css');

        //include theme's core styles
        wp_enqueue_style('search_and_go_elated_default_style', ELATED_ROOT.'/style.css');
        wp_enqueue_style('search_and_go_elated_modules_plugins', ELATED_ASSETS_ROOT.'/css/plugins.min.css');
        wp_enqueue_style('search_and_go_elated_modules', ELATED_ASSETS_ROOT.'/css/modules.min.css');

        search_and_go_elated_icon_collections()->enqueueStyles();

        if(search_and_go_elated_load_blog_assets()) {
            wp_enqueue_style('search_and_go_elated_blog');
        }

        if(search_and_go_elated_load_blog_assets() || is_singular('portfolio-item')) {
            wp_enqueue_style('wp-mediaelement');
        }

        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();

        if(search_and_go_elated_load_woo_assets()) {
            $style_dynamic_deps_array = array('eltd_woocommerce', 'eltd_woocommerce_responsive');
        }
        if(search_and_go_elated_listing_plugin_installed()) {
            $style_dynamic_deps_array = array('search_and_go_elated_listings', 'search_and_go_elated_listings_responsive');
        }

        if(file_exists(ELATED_ROOT_DIR.'/assets/css/style_dynamic.css') && search_and_go_elated_is_css_folder_writable() && !is_multisite()) {
            wp_enqueue_style('search_and_go_elated_style_dynamic', ELATED_ASSETS_ROOT.'/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(ELATED_ROOT_DIR.'/assets/css/style_dynamic.css'));
        }

        //is responsive option turned on?
        if(search_and_go_elated_is_responsive_on()) {
            wp_enqueue_style('search_and_go_elated_modules_responsive', ELATED_ASSETS_ROOT.'/css/modules-responsive.min.css');
            wp_enqueue_style('search_and_go_elated_blog_responsive', ELATED_ASSETS_ROOT.'/css/blog-responsive.min.css');

            //include proper styles
            if(file_exists(ELATED_ROOT_DIR.'/assets/css/style_dynamic_responsive.css') && search_and_go_elated_is_css_folder_writable() && !is_multisite()) {
                wp_enqueue_style('search_and_go_elated_style_dynamic_responsive', ELATED_ASSETS_ROOT.'/css/style_dynamic_responsive.css', array(), filemtime(ELATED_ROOT_DIR.'/assets/css/style_dynamic_responsive.css'));
            }
        }

        //include Visual Composer styles
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_enqueue_scripts', 'search_and_go_elated_styles');
}

if(!function_exists('search_and_go_elated_google_fonts_styles')) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
    function search_and_go_elated_google_fonts_styles() {
        $font_simple_field_array = search_and_go_elated_options()->getOptionsByType('fontsimple');
        if(!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = search_and_go_elated_options()->getOptionsByType('font');
        if(!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);
        $font_weight_str        = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        //define available font options array
        $fonts_array = array();
        foreach($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = search_and_go_elated_options()->getOptionValue($font_option);
            if(search_and_go_elated_is_font_option_valid($font_option_value) && !search_and_go_elated_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value.':'.$font_weight_str;
                if(!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        wp_reset_postdata();

        $fonts_array         = array_diff($fonts_array, array('-1:'.$font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts should be separated with %7C because of HTML validation
        $default_font_string = 'Open Sans:'.$font_weight_str.'|Courgette:'.$font_weight_str.'|Poppins:'.$font_weight_str;
        $protocol = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode('latin,latin-ext'),
            );

            $search_and_go_elated_fonts = add_query_arg( $fonts_full_list_args, $protocol.'//fonts.googleapis.com/css' );
            wp_enqueue_style( 'search_and_go_elated_google_fonts', esc_url_raw($search_and_go_elated_fonts), array(), '1.0.0' );

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode('latin,latin-ext'),
            );
            $search_and_go_elated_fonts = add_query_arg( $default_fonts_args, $protocol.'//fonts.googleapis.com/css' );
            wp_enqueue_style( 'search_and_go_elated_google_fonts', esc_url_raw($search_and_go_elated_fonts), array(), '1.0.0' );
        }

    }

	add_action('wp_enqueue_scripts', 'search_and_go_elated_google_fonts_styles');
}

if(!function_exists('search_and_go_elated_scripts')) {
    /**
     * Function that includes all necessary scripts
     */
    function search_and_go_elated_scripts() {
        global $wp_scripts;

        //init theme core scripts
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-tabs');
		wp_enqueue_script( 'jquery-ui-accordion');
		wp_enqueue_script( 'wp-mediaelement');

        wp_enqueue_script('search_and_go_elated_third_party', ELATED_ASSETS_ROOT.'/js/third-party.min.js', array('jquery'), false, true);
        wp_enqueue_script('isotope', ELATED_ASSETS_ROOT.'/js/jquery.isotope.min.js', array('jquery'), false, true);

		if(search_and_go_elated_is_smoth_scroll_enabled()) {
			wp_enqueue_script("search_and_go_elated_smooth_page_scroll", ELATED_ASSETS_ROOT . "/js/smoothPageScroll.js", array(), false, true);
		}

        //include google map api script
   		wp_enqueue_script('search_and_go_elated_google_places_api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBnqj3SyJ90r_cTV16OBs0OKZfMOjZYpz8&libraries=places', array(), null, true);

        //include google+ api
        wp_enqueue_script('search_and_go_elated_google_plus_api', 'https://apis.google.com/js/platform.js', array(), null, false);

        wp_enqueue_script('search_and_go_elated_modules', ELATED_ASSETS_ROOT.'/js/modules.min.js', array('jquery'), false, true);

        if(search_and_go_elated_load_blog_assets()) {
            wp_enqueue_script('search_and_go_elated_blog', ELATED_ASSETS_ROOT.'/js/blog.min.js', array('jquery'), false, true);
        }

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if(is_singular()) {
            wp_enqueue_script("comment-reply");
        }

        //include Visual Composer script
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_script('wpb_composer_front_js');
        }
    }

    add_action('wp_enqueue_scripts', 'search_and_go_elated_scripts');
}

if(!function_exists('search_and_go_elated_is_ajax_request')) {
    /**
     * Function that checks if the incoming request is made by ajax function
     */
    function search_and_go_elated_is_ajax_request() {

        return isset($_POST["ajaxReq"]) && $_POST["ajaxReq"] == 'yes';
                
    }
}

if(!function_exists('search_and_go_elated_is_ajax_enabled')) {
    /**
     * Function that checks if ajax is enabled
     */
    function search_and_go_elated_is_ajax_enabled() {

        return search_and_go_elated_options()->getOptionValue('smooth_page_transitions') === 'yes' && search_and_go_elated_options()->getOptionValue('smooth_pt_true_ajax') != 'no';
                
    }
}

if(!function_exists('search_and_go_elated_ajax_meta')) {
    /**
     * Function that echoes meta data for ajax
     *
     * @since 4.3
     * @version 0.2
     */
    function search_and_go_elated_ajax_meta() {

        $id = search_and_go_elated_get_page_id();
        
        $page_transition = get_post_meta($id, "eltd_page_transition_type", true);
        ?>

        <div class="eltd-seo-title"><?php echo wp_get_document_title(); ?></div>

        <?php if($page_transition !== ''){ ?>
            <div class="eltd-page-transition"><?php echo esc_html($page_transition); ?></div>
        <?php } else if(search_and_go_elated_options()->getOptionValue('default_page_transition')) {?>
            <div class="eltd-page-transition"><?php echo esc_html(search_and_go_elated_options()->getOptionValue('default_page_transition')); ?></div>
        <?php }
    }

    add_action('search_and_go_elated_ajax_meta', 'search_and_go_elated_ajax_meta');
}

if(!function_exists('search_and_go_elated_no_ajax_pages')) {
    /**
     * Function that echoes pages on which ajax should not be applied
     *
     * @since 4.3
     * @version 0.2
     */
    function search_and_go_elated_no_ajax_pages($global_variables) {

        //is ajax enabled?
        if(search_and_go_elated_is_ajax_enabled()) {
            $no_ajax_pages = array();

            //get posts that have ajax disabled and merge with main array
            $no_ajax_pages = array_merge($no_ajax_pages, search_and_go_elated_get_objects_without_ajax());

            //is wpml installed?
            if(search_and_go_elated_is_wpml_installed()) {
                //get translation pages for current page and merge with main array
                $no_ajax_pages = array_merge($no_ajax_pages, search_and_go_elated_get_wpml_pages_for_current_page());
            }

            //do we have some internal pages that want to be without ajax?
            if ( search_and_go_elated_options()->getOptionValue('internal_no_ajax_links') !== '' ) {
                //get array of those pages
                $options_no_ajax_pages_array = explode(',', search_and_go_elated_options()->getOptionValue('internal_no_ajax_links'));

                if(is_array($options_no_ajax_pages_array) && count($options_no_ajax_pages_array)) {
                    $no_ajax_pages = array_merge($no_ajax_pages, $options_no_ajax_pages_array);
                }
            }

            //add logout url to main array
            $no_ajax_pages[] = htmlspecialchars_decode(wp_logout_url());

            $global_variables['no_ajax_pages'] = $no_ajax_pages;
        }

        return $global_variables;

    }

    add_filter('search_and_go_elated_js_global_variables', 'search_and_go_elated_no_ajax_pages');
}

if(!function_exists('search_and_go_elated_get_objects_without_ajax')) {
   /**
     * Function that returns urls of objects that have ajax disabled.
     * Works for posts, pages and portfolio pages.
     * @return array array of urls of posts that have ajax disabled
     *
     * @version 0.1
     */
    function search_and_go_elated_get_objects_without_ajax() {
        $posts_without_ajax = array();

        $posts_args =  array(
            'post_type'  => array('post', 'portfolio-item', 'page'),
            'post_status' => 'publish',
            'meta_key' => 'eltd_page_transition_type',
            'meta_value' => 'no-animation'
        );

        $posts_query = new WP_Query($posts_args);

        if($posts_query->have_posts()) {
            while($posts_query->have_posts()) {
                $posts_query->the_post();
                $posts_without_ajax[] = get_permalink(get_the_ID());
            }
        }

        wp_reset_postdata();

        return $posts_without_ajax;        
    }
}


//defined content width variable
if (!isset( $content_width )) $content_width = 1060;

if(!function_exists('search_and_go_elated_theme_setup')) {
    /**
     * Function that adds various features to theme. Also defines image sizes that are used in a theme
     */
    function search_and_go_elated_theme_setup() {
        //add support for feed links
        add_theme_support('automatic-feed-links');

        //add support for post formats
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

        //add theme support for post thumbnails
        add_theme_support('post-thumbnails');

        //add theme support for title tag
        add_theme_support('title-tag');

        //define thumbnail sizes
        add_image_size('search_and_go_elated_square', 550, 550, true);
        add_image_size('search_and_go_elated_landscape', 800, 600, true);
        add_image_size('search_and_go_elated_portrait', 600, 800, true);
        add_image_size('search_and_go_elated_large_width', 1000, 500, true);
        add_image_size('search_and_go_elated_large_height', 500, 1000, true);
        add_image_size('search_and_go_elated_large_width_height', 1000, 1000, true);
        add_image_size('search_and_go_elated_listing_gallery', 580, 387, true);

        add_filter('widget_text', 'do_shortcode');

        load_theme_textdomain( 'search-and-go', get_template_directory().'/languages' );
    }

    add_action('after_setup_theme', 'search_and_go_elated_theme_setup');
}


if(!function_exists('search_and_go_elated_rgba_color')) {
    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function search_and_go_elated_rgba_color($color, $transparency) {
        if($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = search_and_go_elated_hex2rgb($color);
            $rgba_color .= 'rgba('.implode(', ', $rgb_color_array).', '.$transparency.')';

            return $rgba_color;
        }
    }
}

if(!function_exists('search_and_go_elated_wp_title_text')) {
    /**
     * Function that sets page's title. Hooks to wp_title filter
     *
     * @param $title string current page title
     * @param $sep string title separator
     *
     * @return string changed title text if SEO plugins aren't installed
     */
    function search_and_go_elated_wp_title_text($title, $sep) {

        //is SEO plugin installed?
        if(search_and_go_elated_seo_plugin_installed()) {
            //don't do anything, seo plugin will take care of it
        } else {
            //get current post id
            $id           = search_and_go_elated_get_page_id();
            $sep          = ' | ';
            $title_prefix = get_bloginfo('name');
            $title_suffix = '';

            //is WooCommerce installed and is current page shop page?
            if(search_and_go_elated_is_woocommerce_installed() && search_and_go_elated_is_woocommerce_shop()) {
                //get shop page id
                $id = search_and_go_elated_get_woo_shop_page_id();
            }

            //is WP 4.1 at least?
            if(function_exists('_wp_render_title_tag')) {
                //set unchanged title variable so we can use it later
                $title_array     = explode($sep, $title);
                $unchanged_title = array_shift($title_array);
            } //pre 4.1 version of WP
            else {
                //set unchanged title variable so we can use it later
                $unchanged_title = $title;
            }

            //title suffix is empty, which means that it wasn't set by eltd seo
            if(empty($title_suffix)) {
                //if current page is front page append site description, else take original title string
                $title_suffix = is_front_page() ? get_bloginfo('description') : $unchanged_title;
            }

            //concatenate title string
            $title = $title_prefix.$sep.$title_suffix;

            //return generated title string
            return $title;
        }
    }

    add_filter('wp_title', 'search_and_go_elated_wp_title_text', 10, 2);
}

if(!function_exists('search_and_go_elated_wp_title')) {
    /**
     * Function that outputs title tag. It checks if _wp_render_title_tag function exists
     * and if it does'nt it generates output. Compatible with versions of WP prior to 4.1
     */
    function search_and_go_elated_wp_title() {
        if(!function_exists('_wp_render_title_tag')) { ?>
            <title><?php wp_title(''); ?></title>
        <?php }
    }
}

if(!function_exists('search_and_go_elated_header_meta')) {
    /**
     * Function that echoes meta data if our seo is enabled
     */
    function search_and_go_elated_header_meta() { ?>

        <meta charset="<?php bloginfo('charset'); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <?php }

    add_action('search_and_go_elated_header_meta', 'search_and_go_elated_header_meta');
}

if(!function_exists('search_and_go_elated_user_scalable_meta')) {
    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to search_and_go_elated_header_meta action
     */
    function search_and_go_elated_user_scalable_meta() {
        //is responsiveness option is chosen?
        if(search_and_go_elated_is_responsive_on()) { ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=no">
        <?php }
    }

    add_action('search_and_go_elated_header_meta', 'search_and_go_elated_user_scalable_meta');
}

if(!function_exists('search_and_go_elated_get_page_id')) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
     *
	 */
	function search_and_go_elated_get_page_id() {

        if(search_and_go_elated_is_woocommerce_installed() && search_and_go_elated_is_woocommerce_shop()) {
            return search_and_go_elated_get_woo_shop_page_id();
        }

		if(is_archive() || is_search() || is_404() || (is_home() && is_front_page())) {
			return -1;
		}

		return get_queried_object_id();
	}
}


if(!function_exists('search_and_go_elated_is_default_wp_template')) {
    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function search_and_go_elated_is_default_wp_template() {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }
}

if(!function_exists('search_and_go_elated_get_page_template_name')) {
    /**
     * Returns current template file name without extension
     * @return string name of current template file
     */
    function search_and_go_elated_get_page_template_name() {
        $file_name = '';

        if(!search_and_go_elated_is_default_wp_template()) {
            $file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

            if($file_name_without_ext !== '') {
                $file_name = $file_name_without_ext;
            }
        }

        return $file_name;
    }
}

if(!function_exists('search_and_go_elated_has_shortcode')) {
    /**
     * Function that checks whether shortcode exists on current page / post
     *
     * @param string shortcode to find
     * @param string content to check. If isn't passed current post content will be used
     *
     * @return bool whether content has shortcode or not
     */
    function search_and_go_elated_has_shortcode($shortcode, $content = '') {
        $has_shortcode = false;

        if($shortcode) {
            //if content variable isn't past
            if($content == '') {
                //take content from current post
                $page_id = search_and_go_elated_get_page_id();
                if(!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if(is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if(stripos($content, '['.$shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }
}

if(!function_exists('search_and_go_elated_rewrite_rules_on_theme_activation')) {
    /**
     * Function that flushes rewrite rules on deactivation
     */
    function search_and_go_elated_rewrite_rules_on_theme_activation() {
        flush_rewrite_rules();
    }

    add_action('after_switch_theme', 'search_and_go_elated_rewrite_rules_on_theme_activation');
}

if(!function_exists('search_and_go_elated_get_dynamic_sidebar')) {
    /**
     * Return Custom Widget Area content
     *
     * @return string
     */
    function search_and_go_elated_get_dynamic_sidebar($index = 1) {
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();

        return $sidebar_contents;
    }
}

if(!function_exists('search_and_go_elated_get_sidebar')) {
    /**
     * Return Sidebar
     *
     * @return string
     */
    function search_and_go_elated_get_sidebar() {

        $id = search_and_go_elated_get_page_id();

        $sidebar = "sidebar";

        if (get_post_meta($id, 'eltd_custom_sidebar_meta', true) != '') {
            $sidebar = get_post_meta($id, 'eltd_custom_sidebar_meta', true);
        } else {
            if (is_single() && search_and_go_elated_options()->getOptionValue('blog_single_custom_sidebar') != '') {
                $sidebar = esc_attr(search_and_go_elated_options()->getOptionValue('blog_single_custom_sidebar'));
            } elseif ((is_archive() || (is_home() && is_front_page())) && search_and_go_elated_options()->getOptionValue('blog_custom_sidebar') != '') {
                $sidebar = esc_attr(search_and_go_elated_options()->getOptionValue('blog_custom_sidebar'));
            } elseif (is_page() && search_and_go_elated_options()->getOptionValue('page_custom_sidebar') != '') {
                $sidebar = esc_attr(search_and_go_elated_options()->getOptionValue('page_custom_sidebar'));
            }
        }

        return $sidebar;
    }
}



if( !function_exists('search_and_go_elated_sidebar_columns_class') ) {

    /**
     * Return classes for columns holder when sidebar is active
     *
     * @return array
     */

    function search_and_go_elated_sidebar_columns_class() {

        $sidebar_class = array();
        $sidebar_layout = search_and_go_elated_sidebar_layout();

        switch($sidebar_layout):
            case 'sidebar-33-right':
                $sidebar_class[] = 'eltd-two-columns-66-33';
                break;
            case 'sidebar-25-right':
                $sidebar_class[] = 'eltd-two-columns-75-25';
                break;
            case 'sidebar-33-left':
                $sidebar_class[] = 'eltd-two-columns-33-66';
                break;
            case 'sidebar-25-left':
                $sidebar_class[] = 'eltd-two-columns-25-75';
                break;

        endswitch;

        $sidebar_class[] = 'clearfix';

        return search_and_go_elated_class_attribute($sidebar_class);

    }

}


if( !function_exists('search_and_go_elated_sidebar_layout') ) {

    /**
     * Function that check is sidebar is enabled and return type of sidebar layout
     */

    function search_and_go_elated_sidebar_layout() {

        $sidebar_layout = '';
        $page_id        = search_and_go_elated_get_page_id();

        $page_sidebar_meta = get_post_meta($page_id, 'eltd_sidebar_meta', true);

        if(($page_sidebar_meta !== '') && $page_id !== -1) {
            if($page_sidebar_meta == 'no-sidebar') {
                $sidebar_layout = '';
            } else {
                $sidebar_layout = $page_sidebar_meta;
            }
        } else {
            if(is_single() && search_and_go_elated_options()->getOptionValue('blog_single_sidebar_layout')) {
                $sidebar_layout = esc_attr(search_and_go_elated_options()->getOptionValue('blog_single_sidebar_layout'));
            } elseif((is_archive() || (is_home() && is_front_page())) && search_and_go_elated_options()->getOptionValue('archive_sidebar_layout')) {
                $sidebar_layout = esc_attr(search_and_go_elated_options()->getOptionValue('archive_sidebar_layout'));
            } elseif(is_page() && search_and_go_elated_options()->getOptionValue('page_sidebar_layout')) {
                $sidebar_layout = esc_attr(search_and_go_elated_options()->getOptionValue('page_sidebar_layout'));
            }
        }

        return $sidebar_layout;

    }

}


if( !function_exists('search_and_go_elated_page_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function search_and_go_elated_page_custom_style() {
       $style = '';
       $html = '';
       $style = apply_filters('search_and_go_elated_add_page_custom_style', $style);
        if($style !== '') {
            $html .= '<style type="text/css">';
            $html .= $style;
            $html .= '</style>';
        }
        print $html;
    }
    
}


if( !function_exists('search_and_go_elated_register_page_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function search_and_go_elated_register_page_custom_style() {
       add_action( (search_and_go_elated_is_ajax_enabled() && search_and_go_elated_is_ajax_request()) ? 'search_and_go_elated_ajax_meta' : 'wp_head', 'search_and_go_elated_page_custom_style' );
    }

    add_action( 'search_and_go_elated_after_options_map', 'search_and_go_elated_register_page_custom_style' );
}


if( !function_exists('search_and_go_elated_vc_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function search_and_go_elated_vc_custom_style() {
        if(search_and_go_elated_visual_composer_installed()) {
            $id = search_and_go_elated_get_page_id();
            if(is_page() || is_single() || is_singular('portfolio-item')) {

                $shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
                if ( ! empty( $shortcodes_custom_css ) ) {
                    echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.esc_attr($id).'">';
                    echo get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
                    echo '</style>';
                }

                $post_custom_css = get_post_meta( $id, '_wpb_post_custom_css', true );
                if ( ! empty( $post_custom_css ) ) {
                    echo '<style type="text/css" data-type="vc_custom-css-'.esc_attr($id).'">';
                    echo get_post_meta( $id, '_wpb_post_custom_css', true );
                    echo '</style>';
                }
            }
        }
    }
    
}


if( !function_exists('search_and_go_elated_register_vc_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function search_and_go_elated_register_vc_custom_style() {
        if (search_and_go_elated_is_ajax_enabled() && search_and_go_elated_is_ajax_request()) {
            add_action( 'search_and_go_elated_ajax_meta', 'search_and_go_elated_vc_custom_style' );
        }
       
    }

    add_action( 'search_and_go_elated_after_options_map', 'search_and_go_elated_register_vc_custom_style' );
}



if( !function_exists('search_and_go_elated_container_style') ) {

    /**
     * Function that return container style
     */

    function search_and_go_elated_container_style($style) {
        $id = search_and_go_elated_get_page_id();
        $class_prefix = search_and_go_elated_get_unique_page_class();

        $container_selector = array(
            $class_prefix.' .eltd-content .eltd-content-inner > .eltd-container',
            $class_prefix.' .eltd-content .eltd-content-inner > .eltd-full-width',
        );

        $container_class = array();
        $page_backgorund_color = get_post_meta($id, "eltd_page_background_color_meta", true);

        if($page_backgorund_color){
            $container_class['background-color'] = $page_backgorund_color;
        }

        $current_style = search_and_go_elated_dynamic_css($container_selector, $container_class);
        $current_style = $current_style . $style;

        return $current_style;

    }
    add_filter('search_and_go_elated_add_page_custom_style', 'search_and_go_elated_container_style');
}

if(!function_exists('search_and_go_elated_get_unique_page_class')) {
    /**
     * Returns unique page class based on post type and page id
     *
     * @return string
     */
    function search_and_go_elated_get_unique_page_class() {
        $id = search_and_go_elated_get_page_id();
        $page_class = '';

        if(is_single()) {
            $page_class = '.postid-'.$id;
        } else {
            $page_class .= '.page-id-'.$id;
        }

        return $page_class;
    }
}

if( !function_exists('search_and_go_elated_page_padding') ) {

    /**
     * Function that return container style
     */

    function search_and_go_elated_page_padding( $style ) {
		
		$id = search_and_go_elated_get_page_id();

        $page_selector = array(
            '.page-id-' . $id . ' .eltd-content .eltd-content-inner > .eltd-container > .eltd-container-inner',
			'.page-id-' . $id . ' .eltd-content .eltd-content-inner > .eltd-full-width > .eltd-full-width-inner'
        );
        $page_css = array();

        $page_padding = get_post_meta($id, 'eltd_page_padding_meta', true);

        if($page_padding !== ''){
            $page_css['padding'] = $page_padding;
        }

        $current_style = search_and_go_elated_dynamic_css($page_selector, $page_css);

        $current_style = $current_style . $style;

        return $current_style;

    }
    add_filter('search_and_go_elated_add_page_custom_style', 'search_and_go_elated_page_padding');
}

if( !function_exists('search_and_go_elated_overlapping_content_padding') ) {

    /**
     * Function that return container style
     */

    function search_and_go_elated_overlapping_content_padding( $style ) {

        $id = search_and_go_elated_get_page_id();

        $page_selector = array(
            '.page-id-' . $id . ' .eltd-overlapping-content',
            '.postid-' . $id . ' .eltd-overlapping-content'
        );
        $page_css = array();

        $overlapping_content_padding = get_post_meta($id, 'eltd_overlapping_content_padding_meta', true);

        if($overlapping_content_padding !== ''){
            $page_css['padding'] = $overlapping_content_padding;
        }

        $current_style = search_and_go_elated_dynamic_css($page_selector, $page_css);

        $current_style = $current_style . $style;

        return $current_style;

    }
    add_filter('search_and_go_elated_add_page_custom_style', 'search_and_go_elated_overlapping_content_padding');
}


if( !function_exists('search_and_go_elated_archive_header_content_position') ) {

	/**
	 * Function that return container style
	 */

	function search_and_go_elated_archive_header_content_position( $style ) {

		$header_selector = 'body.post-type-archive-listing-item .eltd-page-header';
		$content_selector = 'body.post-type-archive-listing-item .eltd-content';

		$top_bar_height = 0;
		$top_bar_enabled = search_and_go_elated_options()->getOptionValue('top_bar');
		if($top_bar_enabled === 'yes'){
			$top_bar_height = 34; //default value
			if(search_and_go_elated_options()->getOptionValue('top_bar_height') !== ''){
				$top_bar_height =  search_and_go_elated_options()->getOptionValue('top_bar_height');
			}
		}

		$header_height = 80;//default value
		if(search_and_go_elated_options()->getOptionValue('menu_area_height_header_standard') !== ''){
			$header_height = search_and_go_elated_options()->getOptionValue('menu_area_height_header_standard');
		}
		$content_margin_top = $header_height + $top_bar_height;

		$header_css = array();
		$header_css['top'] = $top_bar_height.'px';
		$header_style = search_and_go_elated_dynamic_css($header_selector, $header_css );

		$content_css = array();
		$content_css['margin-top'] = $content_margin_top.'px';
		$content_style = search_and_go_elated_dynamic_css($content_selector, $content_css );

		$current_style = $header_style . $content_style;
		$current_style = $current_style . $style;

		return $current_style;

	}
	add_filter('search_and_go_elated_add_page_custom_style', 'search_and_go_elated_archive_header_content_position');
}

if(!function_exists('search_and_go_elated_print_custom_css')) {
    /**
     * Prints out custom css from theme options
     */
    function search_and_go_elated_print_custom_css() {
        $custom_css = search_and_go_elated_options()->getOptionValue('custom_css');

        if($custom_css !== '') {
            wp_add_inline_style( 'search_and_go_elated_modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'search_and_go_elated_print_custom_css');
}

if(!function_exists('search_and_go_elated_print_custom_js')) {
    /**
     * Prints out custom css from theme options
     */
    function search_and_go_elated_print_custom_js() {
        $custom_js = search_and_go_elated_options()->getOptionValue('custom_js');
        $output = '';

        if($custom_js !== '') {
            $output .= '<script type="text/javascript" id="search_and_go_elated-custom-js">';
            $output .= '(function($) {';
            $output .= $custom_js;
            $output .= '})(jQuery)';
            $output .= '</script>';
        }

        print $output;
    }

    add_action('wp_footer', 'search_and_go_elated_print_custom_js', 1000);
}


if(!function_exists('search_and_go_elated_get_global_variables')) {
    /**
     * Function that generates global variables and put them in array so they could be used in the theme
     */
    function search_and_go_elated_get_global_variables() {

        $global_variables = array();
        $element_appear_amount = -150;

        $global_variables['eltdAddForAdminBar'] = is_admin_bar_showing() ? 32 : 0;
        $global_variables['eltdElementAppearAmount'] = search_and_go_elated_options()->getOptionValue('element_appear_amount') !== '' ? search_and_go_elated_options()->getOptionValue('element_appear_amount') : $element_appear_amount;
        $global_variables['eltdFinishedMessage'] = esc_html__('No more posts', 'search-and-go');
        $global_variables['eltdMessage'] = esc_html__('Loading new posts...', 'search-and-go');

        $global_variables = apply_filters('search_and_go_elated_js_global_variables', $global_variables);

        wp_localize_script('search_and_go_elated_modules', 'eltdGlobalVars', array(
            'vars' => $global_variables
        ));

    }

    add_action('wp_enqueue_scripts', 'search_and_go_elated_get_global_variables');
}

if(!function_exists('search_and_go_elated_per_page_js_variables')) {
	/**
	 * Outputs global JS variable that holds page settings
	 */
	function search_and_go_elated_per_page_js_variables() {
        $per_page_js_vars = apply_filters('search_and_go_elated_per_page_js_vars', array());

        wp_localize_script('search_and_go_elated_modules', 'eltdPerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'search_and_go_elated_per_page_js_variables');
}

if(!function_exists('search_and_go_elated_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function search_and_go_elated_content_elem_style_attr() {
        $styles = apply_filters('search_and_go_elated_content_elem_style_attr', array());

        search_and_go_elated_inline_style($styles);
    }
}

if(!function_exists('search_and_go_elated_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function search_and_go_elated_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if(!function_exists('search_and_go_elated_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function search_and_go_elated_visual_composer_installed() {
        //is Visual Composer installed?
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('search_and_go_elated_seo_plugin_installed')) {
    /**
     * Function that checks if popular seo plugins are installed
     * @return bool
     */
    function search_and_go_elated_seo_plugin_installed() {
        //is 'YOAST' or 'All in One SEO' installed?
        if(defined('WPSEO_VERSION') || class_exists('All_in_One_SEO_Pack')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('search_and_go_elated_contact_form_7_installed')) {
    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function search_and_go_elated_contact_form_7_installed() {
        //is Contact Form 7 installed?
        if(defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('search_and_go_elated_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function search_and_go_elated_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if ( ! function_exists( 'search_and_go_elated_listing_plugin_installed' ) ) {
    /**
     * Check if Elated Listing Plugin installed
     *
     * @return bool
     */
    function search_and_go_elated_listing_plugin_installed() {
        return defined('ELATED_LISTING_VERSION');
    }

}

if ( ! function_exists( 'search_and_go_elated_booking_plugin_installed' ) ) {
    /**
     * Check if Elated Booking Plugin installed
     *
     * @return bool
     */
    function search_and_go_elated_booking_plugin_installed() {
        return defined('ELATED_BOOKING_VERSION');
    }

}


if(!function_exists('search_and_go_elated_max_image_width_srcset')) {
	/**
	 * Set max width for srcset to 1920
	 *
	 * @return int
	 */
	function search_and_go_elated_max_image_width_srcset() {
        return 1920;
    }

	add_filter('max_srcset_image_width', 'search_and_go_elated_max_image_width_srcset');
}

function search_and_go_elated_add_user_custom_fields($user_contact) {

	/**
	 * Function that add custom user fields
	 **/
	$user_contact['facebook']		= esc_html__( 'Facebook', 'search-and-go');
	$user_contact['twitter']		= esc_html__( 'Twitter', 'search-and-go');
	$user_contact['googleplus']		= esc_html__( 'Google Plus', 'search-and-go' );
	$user_contact['instagram']		= esc_html__( 'Instagram', 'search-and-go' );

	return $user_contact;
	
}

add_filter( 'user_contactmethods', 'search_and_go_elated_add_user_custom_fields' );

if(! function_exists('search_and_go_elated_get_user_custom_fields')){
	/**
	 * Function returns links and icons for author social networks 
	 * 
	 * return array
	 *
	 */
	function search_and_go_elated_get_user_custom_fields( $id ){
		
		$user_social_array = array();
		$social_network_array = array('instagram', 'twitter','facebook','googleplus');
		
		foreach($social_network_array as $network){
			
			$$network = array(
				'name' => $network,
				'link' => get_the_author_meta($network, $id),
				'class' => 'social_'.$network
			);
			
			$user_social_array[$network] = $$network;
			
		}	

		return $user_social_array;
	}
}

if(! function_exists('search_and_go_elated_restore_jquery_version')) {
    function search_and_go_elated_restore_jquery_version()
    {
        // Load jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"), false);
        wp_enqueue_script('jquery');
    }

    add_action('wp_enqueue_scripts', 'search_and_go_elated_restore_jquery_version');
}
