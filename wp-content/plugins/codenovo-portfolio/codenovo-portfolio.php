<?php
/*
  Plugin Name: Codenovo Portfolio
  Plugin URI: http://cnfolio.codenovo.com
  Description: Using this free portfolio plugin you can showcase your work in a jquery filtered portfolio system.
  Version: 1.2.3
  Author: codenovo
  Author URI: http://www.codenovo.com/
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'CODENOVO_PLUGIN_DIR' ) )
    define( 'CODENOVO_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );
require_once CODENOVO_PLUGIN_DIR . '/widget.php';

function codenovo_get_version(){
	if (!function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}

function codenovo_portfolio_init(){
    $labels = array(
        'name' => _x('Portfolio', 'post type general name'),
        'singular_name' => _x('Portfolio', 'post type singular name'),
        'add_new' => _x('Add New', 'portfolio'),
        'add_new_item' => __('Add New Portfolio'),
        'edit_item' => __('Edit Portfolio'),
        'new_item' => __('New Portfolio'),
        'view_item' => __('View Portfolio'),
        'search_items' => __('Search Portfolio'),
        'not_found' =>  __('No portfolio found'),
        'not_found_in_trash' => __('No portfolio found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Portfolio'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','editor','thumbnail'),
        'rewrite' => array(
            'slug'       => 'portfolio',
            'with_front' => FALSE,
        )
    );
    register_post_type('portfolio',$args);

    $labels = array(
        'name' => _x( 'Portfolio Category', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Types' ),
        'all_items' => __( 'All Category' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
    );


    register_taxonomy('portfoliocategory',array('portfolio'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portifolio_category' ),
    ));
}
add_action('init', 'codenovo_portfolio_init');

function codenovo_portfolio_messages( $messages ) {
    global $post, $post_ID;
    $messages['portfolios'] = array(
        0 => '',
        1 => sprintf( __('Portfolio updated. <a href="%s">View portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Portfolio updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Portfolio published. <a href="%s">View portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Portfolio saved.'),
        8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio</a>'),
          date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter('post_updated_messages', 'codenovo_portfolio_messages');


function codenovo_portfolio_meta_setup(){
    global $post;
?>
    <style>
        .full-text{
            width: 100%;
        }
    </style>
    <div class="portfolio_meta_control">
        <label>Company Name</label>
        <p>
            <input class="full-text" type="text" name="_company" value="<?php echo get_post_meta($post->ID,'_company',TRUE); ?>" />
        </p>
        <label>Project URL (Please put "http:// or "www" for external ilnk)</label>
        <p>
            <input class="full-text" type="text" name="_url" placeholder="http://www.codenovo.com" value="<?php echo get_post_meta($post->ID,'_url',TRUE); ?>" />
        </p>
        <label>Open in new tab?</label>
        <p>
            <select class="full-text" name="_ntab">
                <option value="1" <?php echo (get_post_meta($post->ID,'_ntab', TRUE) == 1) ? 'SELECTED':''; ?>>YES</option>
                <option value="0" <?php echo (get_post_meta($post->ID,'_ntab', TRUE) == 0) ? 'SELECTED':''; ?>>NO</option>
            </select>
        </p>
    </div>
<?php
    echo '<input type="hidden" name="meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

function codenovo_portfolio_meta_save($post_id){
    if (!isset($_POST['meta_noncename']) || !wp_verify_nonce($_POST['meta_noncename'], __FILE__)) {
        return $post_id;
    }
	if ('post' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_page', $post_id)) {
		return $post_id;
    }
    if (defined('DOING_AUTOSAVE') == DOING_AUTOSAVE) {
		return $post_id;
    }
    if(isset($_POST['_url'])){
        update_post_meta($post_id, '_url', $_POST['_url']);
    }
    else{
        delete_post_meta($post_id, '_url');
    }
    if(isset($_POST['_ntab'])){
        update_post_meta($post_id, '_ntab', $_POST['_ntab']);
    }
    else{
        delete_post_meta($post_id, '_ntab');
    }
    if(isset($_POST['_company'])){
        update_post_meta($post_id, '_company', $_POST['_company']);
    }
    else{
        delete_post_meta($post_id, '_company');
    }
}
function codenovo_portfolio_meta_init(){
    add_meta_box('codenovo_portfolio_meta', 'Portfolio Extra Field', 'codenovo_portfolio_meta_setup', 'portfolio', 'advanced', 'core');
    add_action('save_post','codenovo_portfolio_meta_save');
}
add_action('admin_init','codenovo_portfolio_meta_init');


/* Admin Option + CSS*/
add_action( 'admin_init', 'register_plugin_styles' );
add_action('admin_menu', 'codenovo_portfolio_admin_menu');

function register_plugin_styles() {
    wp_register_style( 'codenovo-portfolio-admin-css', plugins_url( '/' . basename(dirname(__FILE__)) . '/css/codenovo-portfolio-admin.css', 'portfolio_settings' ) );
}

function codenovo_portfolio_admin_menu() {
    $page = add_submenu_page('edit.php?post_type=portfolio', 'settings', 'Settings', 'manage_options', 'portfolio_settings', 'portfolio_settings_page');
    add_action( 'admin_print_styles-' . $page, 'my_plugin_admin_styles' );
}

function my_plugin_admin_styles() {
    wp_enqueue_style( 'codenovo-portfolio-admin-css' );
}

function portfolio_settings_page(){
    require_once( ABSPATH . 'wp-content/plugins/' . basename(dirname(__FILE__)) . '/settings.php' );
}

/* Admin Option + CSS*/
function plugin_settings_link($link) {
    $settings_link = '<a href="edit.php?post_type=portfolio&page=portfolio_settings">Settings</a>';
    array_unshift($link, $settings_link);
    return $link;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'plugin_settings_link' );

function codenovo_portfolio_js(){
    wp_register_script('cd-pf-js-easing', get_bloginfo('wpurl') . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/jquery-easing.js', array( 'jquery' ), '1.3'  );
    wp_enqueue_script('cd-pf-js-easing');
    wp_register_script( 'cd-pf-js', get_bloginfo('wpurl').'/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/jquery.quicksand.js', array( 'jquery' ), '1.4' );
    wp_enqueue_script( 'cd-pf-js' );
    wp_register_script( 'cd-pf-mp-js', get_bloginfo('wpurl').'/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/magnific.popup.js', array( 'jquery' ), '0.9.9' );
    wp_enqueue_script( 'cd-pf-mp-js' );
    wp_register_script( 'cd-pf-cycle-js', get_bloginfo('wpurl').'/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/cycle.js', array( 'jquery' ), '3.0.3' );
    wp_enqueue_script( 'cd-pf-cycle-js' );
    wp_register_script( 'cd-pf-hoverdirection-js', get_bloginfo('wpurl').'/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/jquery-hoverdirection.js', array( 'jquery' ), '0.0.1' );
    wp_enqueue_script( 'cd-pf-hoverdirection-js' );
    wp_register_script( 'cd-pf-custom-js', get_bloginfo('wpurl').'/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/cn_pf_custom_js.js', array( 'jquery' ), '0.0.1' );
    wp_enqueue_script( 'cd-pf-custom-js' );

    wp_enqueue_style( 'cd-portfolio-css',  get_bloginfo('wpurl').'/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/codenovo-portfolio-frontend-css.css');
    wp_enqueue_style( 'jquery-hoverdirection-css',  get_bloginfo('wpurl').'/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/jquery-hoverdirection.css');
}
add_action('wp_enqueue_scripts', 'codenovo_portfolio_js');

function codenovo_portfolio(){
    $column = get_option("cd_pf_column");
    $navigation = get_option("cd_pf_animation");
    if($navigation == ''){
        $navigation = 1;
    }
    if(!empty($column) && $column != 0 ){
        $width = (100/intval($column))."%";

    ?>
        <style>
            ul.cnOurHolder li.item{
                width: calc( <?php echo $width; ?> - 6px);
            }
        </style>
    <?php
        if($column > 2){
        ?>
            <style>
            #cnfolioHolder .cnportfolio-hover .cnlinks a,
            #cnfolioHolder .cnportfolio-hover .cnlinks a span{
                height: 50px;
            }
            </style>
        <?php
        }
        if($column > 3){
            ?>
        <style>
            #cnfolioHolder .cnportfolio-hover .cnlinks a,
            #cnfolioHolder .cnportfolio-hover .cnlinks a span{
                height: 40px;
            }
        </style>
        <?php
        }
    }
    else{
        $column = 2;
    }
    $terms = get_terms("portfoliocategory");
    $item = count($terms);
    $cn_pf_button_text = "Show All";
    if(get_option("cd_pf_effect")){
        $cn_pf_button_text = get_option("cd_pf_effect");
    }
    if($navigation == 1){
        echo '<ul id="cnFilterOptions">';
        echo '<li class="active"><a href="javascript:void(0)" class="all">'.$cn_pf_button_text.'</a></li>';
        if ( $item > 0 ){
            foreach ( $terms as $term ) {
                    $termname = strtolower($term->name);
                    $termname = str_replace(' ', '-', $termname);
                    echo '<li><a href="javascript:void(0)" class="'.$termname.'">'.$term->name.'</a></li>';
            }
        }
        echo "</ul>";
    }
    $loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => -1));
    $item = 0;
    ?>
    <div id="cnfolioHolder">
        <ul class="cnOurHolder">
            <?php if ( $loop ) :
                $i = 1;
                while ( $loop->have_posts() ) :
                    $loop->the_post();
                    $terms = get_the_terms( get_the_ID(), 'portfoliocategory' );
                    $checkCat = 0;
                    if ( $terms && ! is_wp_error( $terms ) ) :
                        $cd_pf_class = '';
                        $termname = array();
                        foreach ( $terms as $term )
                        {
                                $termname[] = strtolower($term->name);
                        }
                        $termname = str_replace(' ', '-', $termname);
                        $cd_pf_class .= join( " ", $termname );
                    else :
                        $cd_pf_class = '';
                    endif;

                    ?>
                    <?php
                    $portfolio_url = get_post_custom_values('_url');
                    $portfolio_url_tab = get_post_custom_values('_ntab');
                    $nTab = '';
                    if($portfolio_url_tab[0]){
                        $nTab = 'target="_blank"';
                    }
                    if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $portfolio_url[0])) {
                        $url = parse_url($portfolio_url[0]);
                        if(!isset($url['scheme'])){
                            $url = 'http://'.$portfolio_url[0];
                        }
                        else{
                            $url = $portfolio_url[0];
                        }
                    }
                    else{
                        $url = $portfolio_url[0];
                    }
                    $portfolio_company = get_post_custom_values('_company');
                    ?>
                    <li class="item" data-id="id-<?php echo $i++; ?>" data-type="<?php echo $cd_pf_class; ?>">
                        <div class="mix cnportfolio-image">
                            <?php
                                $imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                            ?>
                            <img src="<?php echo $imgUrl[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                            <div class="cnportfolio-hover inner">
                                <div class="cnportfolio-content-wrapper">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="cnlinks">
                                    <?php if(empty($url)){ ?>
                                    <a class="popup-with-zoom-anim cnportfolio-details" href="#popup-content-<?php echo get_the_ID(); ?>" style="float: none; margin: 0 auto;">
                                        <span></span>
                                    </a>
                                    <?php }else{ ?>
                                        <a class="popup-with-zoom-anim cnportfolio-details" href="#popup-content-<?php echo get_the_ID(); ?>">
                                            <span></span>
                                        </a>
                                    <?php } ?>
                                    <?php if(!empty($url)){ ?>
                                        <a class="cnportfolio-live" href="<?php echo $url; ?>" <?php echo $nTab ?>>
                                            <span></span>
                                        </a>
                                    <?php } ?>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div id="popup-content-<?php echo get_the_ID(); ?>" class="zoom-anim-dialog mfp-hide">
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            <?php
                            if(!empty($portfolio_company[0])){
                                echo '<p>'.$portfolio_company[0].'</p>';
                            }
                            ?>
                            <div class="image">
                                <?php
                                $imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                                ?>
                                <img src="<?php echo $imgUrl[0]; ?>" alt="<?php echo get_the_title(); ?>" style="max-width: <?php echo $imgUrl[1]; ?>;max-height: <?php echo $imgUrl[2]; ?>;" />
                            </div>
                            <?php
                            the_content();
                            if(!empty($portfolio_url[0])){
                            ?>
                            <a class="popuplink" href="<?php echo $url; ?>" target="_blank">
                                View
                            </a>
                            <?php } ?>
                        </div>
                    </li>
                <?php endwhile;
            else: ?>
                <li class="error-not-found">Sorry, no portfolio entries for while.</li>
            <?php endif; ?>
        </ul>
    </div>
    <div id="mixCss"></div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                /*popup*/
                $('.popup-with-zoom-anim').magnificPopup({
                    type: 'inline',

                    fixedContentPos: false,
                    fixedBgPos: true,

                    overflowY: 'auto',

                    closeBtnInside: true,
                    preloader: false,

                    midClick: true,
                    removalDelay: 500,
                    mainClass: 'my-mfp-zoom-in',
                    callbacks: {
                        open: function () {

                        },
                        close: function () {
                            $('li .mix').removeClass('hover-leave-bottom');
                            $('li .mix').removeClass('hover-leave-top');
                            $('li .mix').removeClass('hover-leave-left');
                            $('li .mix').removeClass('hover-leave-right');
                        }
                    }
                });
                /*data resize*/
                var ulWidth = $("#cnfolioHolder ul.cnOurHolder").width();
                var ulHeight = $("#cnfolioHolder ul.cnOurHolder").height();
                var liWidth = $("#cnfolioHolder ul.cnOurHolder li.item").width();
                var liHeight = $("#cnfolioHolder ul.cnOurHolder li.item").height();
                $('#mixCss').html('<style>#cnfolioHolder ul.cnOurHolder li.item{width:'+liWidth+'px;height:auto;}#cnfolioHolder ul.cnOurHolder{width:'+ulWidth+'px;height:auto}</style>')
                $( window ).resize(function() {
                    var winSize = $(window).width();
                    if(winSize > 767){
                        $("#cnfolioHolder ul.cnOurHolder").css('width', '100%');
                        var ulWidth = $("#cnfolioHolder ul.cnOurHolder").width();
                        var ulHeight = $("#cnfolioHolder ul.cnOurHolder").height();
                        var liWidth = parseInt(((parseInt(ulWidth)*<?php echo (100/intval($column)); ?>)/100) - 6);
                        var liHeight = $("#cnfolioHolder ul.cnOurHolder li.item").height();
                        $('#mixCss').html('<style>#cnfolioHolder ul.cnOurHolder li.item{width:'+liWidth+'px;height:auto;}#cnfolioHolder ul.cnOurHolder{width:'+ulWidth+'px;height:auto}</style>')
                    }
                    else{
                        $("#cnfolioHolder ul.cnOurHolder").css('width', '100%');
                        var ulWidth = $("#cnfolioHolder ul.cnOurHolder").width();
                        var ulHeight = $("#cnfolioHolder ul.cnOurHolder").height();
                        var liWidth = parseInt(ulWidth);
                        var liHeight = $("#cnfolioHolder ul.cnOurHolder li.item").height();
                        $('#mixCss').html('<style>#cnfolioHolder ul.cnOurHolder li.item{width:'+liWidth+'px;height:auto;}#cnfolioHolder ul.cnOurHolder{width:'+ulWidth+'px;height:auto}</style>')
                    }
                });
                /*filter*/
                var $filterType = $('#cnFilterOptions li.active a').attr('class');
                var $holder = $('#cnfolioHolder ul.cnOurHolder');
                var $data = $holder.clone();
                <?php
                $getEasing = 'easeInOutQuad';
                if(get_option("cd_pf_easing")){
                    $getEasing = get_option("cd_pf_easing");
                }
                ?>
                $('#cnFilterOptions li a').click(function(e) {
                    $('#cnFilterOptions li').removeClass('active');
                    var $filterType = $(this).attr('class');
                    $(this).parent().addClass('active');

                    if ($filterType == 'all') {
                        var $filteredData = $data.find('li');
                    }
                    else {
                        var $filteredData = $data.find('li[data-type*=' + $filterType + ']');
                    }
                    $holder.quicksand($filteredData, {
                        duration: <?php echo (get_option("cd_pf_duration")) ? get_option("cd_pf_duration"): '1000' ?>,
                        easing: '<?php echo (get_option("cd_pf_easing")) ? $getEasing : "easeInOutQuad" ?>'
                    });
                    $('li .mix').removeClass('hover-leave-bottom');
                    $('li .mix').removeClass('hover-leave-top');
                    $('li .mix').removeClass('hover-leave-left');
                    $('li .mix').removeClass('hover-leave-right');
                    $('li .mix').hoverDirection();
                    $('.popup-with-zoom-anim').magnificPopup({
                        type: 'inline',

                        fixedContentPos: false,
                        fixedBgPos: true,

                        overflowY: 'auto',

                        closeBtnInside: true,
                        preloader: false,

                        midClick: true,
                        removalDelay: 500,
                        mainClass: 'my-mfp-zoom-in',
                        callbacks: {
                            open: function () {

                            },
                            close: function () {
                                $('li .mix').removeClass('hover-leave-bottom');
                                $('li .mix').removeClass('hover-leave-top');
                                $('li .mix').removeClass('hover-leave-left');
                                $('li .mix').removeClass('hover-leave-right');
                            }
                        }
                    });
                    return false;
                });
            });
        </script>
<?php
}

function codenovo_portfolio_shortcode($atts, $content = null) {
    ob_start();
    codenovo_portfolio();
	$out1 = ob_get_contents();
	ob_end_clean();
	return $out1;
}
add_shortcode('codenovo-portfolio','codenovo_portfolio_shortcode');

?>
