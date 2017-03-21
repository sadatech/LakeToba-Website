<?php

/*
Plugin Name: Awesome Filterable Portfolio
Plugin URI: https://brinidesigner.com/wordpress-plugins/awesome-filterable-portfolio/?utm_source=AFP&utm_medium=AFP&utm_campaign=AFP
Description: Awesome Filterable Portfolio allows you to create a portfolio that you can filter its elements using smooth animations.
Version: 1.9.7
Author: BriniA
Author URI: https://brinidesigner.com/?utm_source=AFP&utm_medium=AFP&utm_campaign=AFP

Copyright 2012-2016  BriniA

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/




//Loading Translation
function translation(){
	load_plugin_textdomain('awesome-filterable-portfolio', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
}
add_action('init', 'translation');

//Registering Scripts & Styles for the Admin
function afp_enqeue_scripts(){

	wp_register_style( 'afp-admin-css', plugin_dir_url(__FILE__) .
		'css/afp-admin-style.css');
	wp_enqueue_style( 'afp-admin-css' );

	if (get_current_screen()->id == 'portfolio-items_page_afp_options_page') {
		wp_register_script('afp-admin-options', plugin_dir_url(__FILE__) .
			'js/afp-admin-options.js');
		wp_enqueue_script('afp-admin-options');
	}

	else if (get_current_screen()->id ==
		'portfolio-items_page_afp_add_new_portfolio_item'){
		wp_register_style('datepicker-style', plugin_dir_url(__FILE__) . 'css/jquery-ui-datepicker.css');
		wp_enqueue_style('datepicker-style');
		wp_enqueue_media();
		wp_register_script('afp-admin-functions', plugin_dir_url(__FILE__) . 'js/afp-admin-functions.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('afp-admin-functions');
	}
}
add_action('admin_enqueue_scripts', 'afp_enqeue_scripts');


//Creating the menu
function afp_portfolio_items_page(){
	afp_get_potfolio_items_page();
}


function afp_portfolio_items_page_menu(){
	add_menu_page( 'Awesome Filterable Portfolio', __('Portfolio Items', 'awesome-filterable-portfolio'), 'manage_options', 'afp', 'afp_portfolio_items_page', path_join(WP_PLUGIN_URL, dirname(plugin_basename(__FILE__)).'/af-portfolio-icon.png'), '101.1' );
}
add_action( 'admin_menu', 'afp_portfolio_items_page_menu' );


function afp_add_new_page(){
	afp_get_new_portfolio_item_page();
}

function afp_add_new_page_menu(){
	add_submenu_page( 'afp', 'Add New', __('Add New Item', 'awesome-filterable-portfolio'), 'manage_options', 'afp_add_new_portfolio_item', 'afp_add_new_page' );
}
add_action( 'admin_menu', 'afp_add_new_page_menu' );


function afp_categories_page(){
	afp_get_categories_page();
}

function afp_categories_page_menu(){
	add_submenu_page( 'afp', 'Categories List', __('Categories List', 'awesome-filterable-portfolio'), 'manage_options', 'afp_categories', 'afp_categories_page' );

}
add_action( 'admin_menu', 'afp_categories_page_menu' );


function afp_add_new_category_page(){
	afp_get_new_category_page();
}

function afp_add_new_category_page_menu(){
	add_submenu_page( 'afp', 'Add New Category', __('Add New Category', 'awesome-filterable-portfolio'), 'manage_options', 'afp_add_new_category', 'afp_add_new_category_page' );
}
add_action( 'admin_menu', 'afp_add_new_category_page_menu' );


//ADMIN USER INTERFACE

function afp_help_meta_box(){
	?>

<div class="inner-sidebar">
  <div class="postbox">
    <h3><span>Need help?</span></h3>
    <hr />
    <div class="inside">
      <p>Watch the <a target="_blank" href="http://brinidesigner.com/wordpress-plugins/awesome-filterable-portfolio/video/?utm_source=AFP&utm_medium=AFP&utm_campaign=AFP">Video Tutorial</a></p>
      <p>Read the plugin's <a target="_blank" href="http://brinidesigner.com/wordpress-plugins/awesome-filterable-portfolio/docs/?utm_source=AFP&utm_medium=AFP&utm_campaign=AFP">Documentation</a></p>
	  <p>Read <a target="_blank" href="http://brinidesigner.com/blog/?utm_source=AFP&utm_medium=AFP&utm_campaign=AFP">my blog</a></p>
    </div>
  </div>
</div>
<!-- .inner-sidebar -->
<?php
}


function afp_get_new_portfolio_item_page(){
	global $wpdb;
	?>
<div class="wrap">
  <?php if(!isset($_GET['item_id'])) { ?>
  <h2>
    <?php _e('Add New Portfolio Item', 'awesome-filterable-portfolio'); ?>
  </h2>
  <div class="metabox-holder has-right-sidebar">
    <?php afp_help_meta_box(); ?>
    <div id="post-body">
      <div id="post-body-content">
        <div class="postbox">
          <h3><span>
            <?php _e('Add New Portfolio Item', 'awesome-filterable-portfolio'); ?>
            </span></h3>
          <div class="inside">
            <form action="#" method="post" enctype="multipart/form-data">
              <p>
                <label for="title"><b>
                  <?php _e('Project Name :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="title" id="title" class="regular-text">
                <br>
              </p>
              <p>
                <label for="client"><b>
                  <?php _e('Client :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="client" id="client" class="regular-text">
              </p>
              <p>
                <label for="date"><b>
                  <?php _e('Date :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="date" id="date">
                <br />
              </p>
              <p>
                <label for="link"><b>
                  <?php _e('Project Link :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="link" id="link" class="regular-text">
                <br>
                <span class="description">
                <?php _e('Add a URL to your project. If left empty no date will be displayed', 'awesome-filterable-portfolio'); ?>
                </span> </p>
              <p>
                <label for="category"><b>
                  <?php _e('Category :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <select name="category_id" id="category" >
                  <?php
                  $afpOptions = get_option('afpOptions');
                  if( $afpOptions['sort_cat'] == 'on' ){
	                  $orderby = ' ORDER BY cat_name';
                  } else {
	                  $orderby = ' ORDER BY `cat_sorting`';
                  }

                  $cats = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'afp_categories '.$orderby);
							  foreach ($cats as $cat){
							  ?>
                  <option value="<?php echo($cat->cat_id); ?>"><?php echo($cat->cat_name); ?></option>
                  <?php
							  }
							  ?>
                </select>
              </p>
              <p>
                <label for="image"><b>
                  <?php _e('Image', 'awesome-filterable-portfolio'); ?>
                  *</b></label>
                <br />
                <input type="text" name="image_adr" id="image_adr" class="regular-text" />
                <input type="button" name="image" id="image" class="button-secondary" value="<?php _e('Upload Image', 'awesome-filterable-portfolio'); ?>" />
                <br />
                <span class="description">
                <?php _e('This is the image that will be displayed when you show the project details.', 'awesome-filterable-portfolio'); ?>
                </span> </p>
	            <div id="js-image-container"></div>
              <p>
                <label for="thumbnail"><b>
                  <?php _e('Thumbnail', 'awesome-filterable-portfolio', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br />
                <input type="text" name="thumbnail_adr" id="thumbnail_adr" class="regular-text" />
                <input type="button" name="thumbnail" id="thumbnail" class="button-secondary" value="<?php _e('Upload Thumbnail', 'awesome-filterable-portfolio'); ?>" />
                <br />
                <span class="description">
                <?php _e('Use a small image for preview purpose. You may select an image from the Media Library and select Thumbnail for the image size.', 'awesome-filterable-portfolio'); ?>
                </span> </p>
              <p>
                <label for="description"><b>
                  <?php _e('Description :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <textarea name="description" id="description" cols="50" rows="10"></textarea>
              </p>
	            <p>
		            <label for="item_sorting"><b>
				            <?php _e('Sorting :', 'awesome-filterable-portfolio'); ?>
			            </b></label>
		            <input name="item_sorting" style="width: 50px;" id="item_sorting"
		                   value=""/>
	            </p>
              <input type="hidden" name="which" id="which" value="new_portfolio_item"/>
              <input type="submit" value="<?php _e('Save New Portfolio Item', 'awesome-filterable-portfolio'); ?>" class="button-primary">
            </form>
          </div>
          <!-- .inside -->
        </div>
      </div>
      <!-- #post-body-content -->
    </div>
    <!-- #post-body -->

  </div>
  <!-- .metabox-holder -->
  <?php } else {
	$item_id = esc_sql($_GET['item_id']);
	$msg = $_GET['msg'];
	global $wpdb;
	$item = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'afp_items WHERE item_id=' . $item_id.' ORDER BY `item_sorting`');
	?>
  <h2>
    <?php _e('Edit Portfolio Item', 'awesome-filterable-portfolio'); ?>
    <a href="<?php echo admin_url(); ?>admin.php?page=afp_add_new_portfolio_item" title="" class="add-new-h2">
    <?php _e('Add New', 'awesome-filterable-portfolio'); ?>
    </a></h2>
  <?php if(isset($msg)){ ?>
  <div style="padding: 5px" class="updated"><b>
    <?php if ($msg=='added') { _e('Portfolio Item added successfully', 'awesome-filterable-portfolio'); } else { _e('Portfolio Item edited successfully', 'awesome-filterable-portfolio'); } ?>
    </b></div>
  <?php } ?>
  <div class="metabox-holder has-right-sidebar">
    <?php afp_help_meta_box(); ?>
    <div id="post-body">
      <div id="post-body-content">
        <div class="postbox">
          <h3><span>
            <?php _e('Edit Portfolio Item', 'awesome-filterable-portfolio'); ?>
            </span></h3>
          <div class="inside">
            <form action="#" method="post" enctype="multipart/form-data">
              <p>
                <label for="title"><b>
                  <?php _e('Project Name :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="title" id="title" class="regular-text" value="<?php echo($item->item_title); ?>">
                <br>
              </p>
              <p>
                <label for="client"><b>
                  <?php _e('Client :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="client" id="client" class="regular-text" value="<?php echo($item->item_client); ?>">
              </p>
              <p>
                <label for="date"><b>
                  <?php _e('Date :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="date" id="date" value="<?php if($item->item_date =='0000-00-00') { echo(''); } else { echo(date("m/d/Y", strtotime($item->item_date))); } ?>">
                <br />
              </p>
              <p>
                <label for="link"><b>
                  <?php _e('Project Link :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="link" id="link" class="regular-text" value="<?php echo($item->item_link); ?>">
                <br>
              </p>
              <p>
                <label for="category"><b>
                  <?php _e('Category :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <select name="category_id" id="category" >
                  <?php
                  $afpOptions = get_option('afpOptions');
                  if( $afpOptions['sort_cat'] == 'on' ){
	                  $orderby = ' ORDER BY cat_name';
                  } else {
	                  $orderby = ' ORDER BY `cat_sorting`';
                  }
                  $cats = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'afp_categories'.$orderby);
							  foreach ($cats as $cat){
							  ?>
                  <option <?php if($item->item_category_id==$cat->cat_id) { echo("selected"); } ?> value="<?php echo($cat->cat_id); ?>"><?php echo($cat->cat_name); ?></option>
                  <?php
							  }
							  ?>
                </select>
              </p>
              <p>
                <label for="image"><b>
                  <?php _e('Image', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br />
                <input type="text" name="image_adr" id="image_adr" class="regular-text" value="<?php echo($item->item_image); ?>"/>
                <input type="button" name="image" id="image" class="button-secondary" value="<?php _e('Upload Image', 'awesome-filterable-portfolio'); ?>" />
                <br />
                <span class="description">
                <?php _e('This is the image that will be displayed when you show the project details.', 'awesome-filterable-portfolio'); ?>
                </span> </p>
	            <div id="js-image-container"></div>
	            <p>
                <label for="thumbnail"><b>
                  <?php _e('Thumbnail', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br />
                <input type="text" name="thumbnail_adr" id="thumbnail_adr" class="regular-text" value="<?php echo($item->item_thumbnail); ?>" />
                <input type="button" name="thumbnail" id="thumbnail" class="button-secondary" value="<?php _e('Upload Thumbnail', 'awesome-filterable-portfolio'); ?>" />
                <br />
                <span class="description">
                <?php _e('Use a small image for preview purpose. You may select an image from the Media Library and select Thumbnail for the image size.', 'awesome-filterable-portfolio'); ?>
                </span> </p>
              <p>
                <label for="description"><b>
                  <?php _e('Description :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <textarea name="description" id="description" cols="50" rows="10"><?php echo($item->item_description); ?></textarea>
              </p>
	            <p>
		            <label for="item_sorting"><b>
				            <?php _e('Sorting :', 'awesome-filterable-portfolio'); ?>
			            </b></label>
		            <input name="item_sorting" style="width: 50px;" id="item_sorting"
		                   value="<?php echo($item->item_sorting); ?>"/>
	            </p>
              <input type="hidden" name="item_id" id="item_id" value="<?php echo($item_id); ?>"/>
              <input type="hidden" name="which" id="which" value="update_portfolio_item"/>
              <input type="submit" value="<?php _e('Save Portfolio Item', 'awesome-filterable-portfolio'); ?>" class="button-primary">
            </form>
          </div>
          <!-- .inside -->
        </div>
      </div>
      <!-- #post-body-content -->
    </div>
    <!-- #post-body -->

  </div>
  <!-- .metabox-holder -->
  ?> </div>
<!-- .wrap -->
<?php
}
}


function afp_get_potfolio_items_page(){
	global $wpdb;
	?>
<div class="wrap">
<?php
	$item_id = esc_sql($_GET['item_id']);
	$action= $_GET['action'];
	if( $action=='' || $action=='delete' ){
	if ($action=='delete') { $wpdb->query( $wpdb->prepare('DELETE FROM ' . $wpdb->prefix . 'afp_items WHERE item_id=%d', $item_id ) ); }
	?>
<h2>
  <?php _e('Portfolio Items ', 'awesome-filterable-portfolio'); ?>
  <a href="<?php echo admin_url(); ?>admin.php?page=afp_add_new_portfolio_item" title="" class="add-new-h2">
  <?php _e('Add New', 'awesome-filterable-portfolio'); ?>
  </a></h2>
<?php $items = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'afp_items
ORDER BY `item_sorting`');
	if ( $items == null ) {
		echo(__('You don\'t have any portfolio item.', 'awesome-filterable-portfolio') . '&nbsp;' . __('Please', 'awesome-filterable-portfolio') . '&nbsp;<a href="' . get_admin_url() . 'admin.php?page=afp_add_new_portfolio_item" title="">' . __('Add a New Item', 'awesome-filterable-portfolio') . '</a>');
	} else {
	?>
<table class="widefat">
  <thead>
    <tr>
      <th width="120px"><?php _e('Thumbnail', 'awesome-filterable-portfolio'); ?></th>
      <th class="row-title"><?php _e('Title', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Client', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Date', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Link', 'awesome-filterable-portfolio'); ?></th>
	    <th><?php _e('Category', 'awesome-filterable-portfolio'); ?></th>
	    <th><?php _e('Sorting', 'awesome-filterable-portfolio'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php
		foreach ( $items as $item ) {
			echo('<tr>
					<td><a href="' . admin_url() . 'admin.php?page=afp_add_new_portfolio_item&item_id=' . $item->item_id . '"><div style="background: url('.$item->item_thumbnail.') center; background-size: cover; width: 100px; height: 100px;"></div></a></td>
					<td class="title column-title">
						<a href="' . admin_url() . 'admin.php?page=afp_add_new_portfolio_item&item_id=' . $item->item_id . '"><b>' . $item->item_title . '</b></a>
						<div class="row-actions">
							<span class="edit"><a href="' . admin_url() . 'admin.php?page=afp_add_new_portfolio_item&item_id=' . $item->item_id . '">Edit</a></span> |
							<span class="submitdelete"><a href="' . admin_url() . 'admin.php?page=afp&action=confirm&item_id=' . $item->item_id . '">Delete</a></span>
						</div>
					</td>
					<td>' . $item->item_client . '</td>
					<td>' . date("m/d/Y", strtotime($item->item_date)) . '</td>
					<td>' . $item->item_link . '</td>
					<td>' . getCategoryNameById($item->item_category_id) . '</td>
					<td>' . $item->item_sorting . '</td>
				</tr>');
		}
		?>
  </tbody>
  <tfoot>
    <tr>
      <th width="120px"><?php _e('Thumbnail', 'awesome-filterable-portfolio'); ?></th>
      <th class="row-title"><?php _e('Title', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Client', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Date', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Link', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Category', 'awesome-filterable-portfolio'); ?></th>
	    <th><?php _e('Sorting', 'awesome-filterable-portfolio'); ?></th>
    </tr>
  </tfoot>
</table>
<?php
	}
	} elseif( $action == 'confirm' ){
		?>
<h2>
  <?php _e('Delete Confirmation', 'awesome-filterable-portfolio'); ?>
</h2>
<h3>
  <?php _e('Are you sure you want to delete this portfolio item?', 'awesome-filterable-portfolio'); ?>
</h3>
<a class="button-primary" href="<?php echo( admin_url() . 'admin.php?page=afp&action=delete&item_id=' . $item_id ); ?>">
<?php _e( 'Delete', 'awesome-filterable-portfolio'); ?>
</a> <a class="button-secondary" href="<?php echo( admin_url() . 'admin.php?page=afp'); ?>">
<?php _e( 'Cancel', 'awesome-filterable-portfolio'); ?>
</a>
<?php
	}
}


function afp_get_new_category_page(){
	if (!isset($_GET['cat_id'])){
	?>
<div class="wrap">
  <h2>
    <?php _e('Add New Category', 'awesome-filterable-portfolio'); ?>
  </h2>
  <div class="metabox-holder has-right-sidebar">
    <?php afp_help_meta_box(); ?>
    <div id="post-body">
      <div id="post-body-content">
        <div class="postbox">
          <h3><span>
            <?php _e('Add New Category', 'awesome-filterable-portfolio'); ?>
            </span></h3>
          <div class="inside">
            <form action="#" method="post" enctype="multipart/form-data">
              <p>
                <label for="title"><b>
                  <?php _e('Category name :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="title" id="title" class="regular-text">
                <br>
              </p>
              <p>
                <label for="description"><b>
                  <?php _e('Description :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <textarea name="description" id="description" cols="50" rows="10"></textarea>
              </p>
              <input type="hidden" name="which" id="which" value="new_category"/>
              <input type="submit" value="<?php _e('Save New Category', 'awesome-filterable-portfolio'); ?>" class="button-primary">
            </form>
          </div>
          <!-- .inside -->
        </div>
      </div>
      <!-- #post-body-content -->
    </div>
    <!-- #post-body -->

  </div>
  <!-- .metabox-holder -->
</div>
<!-- .wrap -->
<?php
}else{
	$cat_id = esc_sql($_GET['cat_id']);
	$msg = $_GET['msg'];
	global $wpdb;
	$cat = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'afp_categories WHERE cat_id=' . $cat_id);
	?>
<div class="wrap">
  <h2>
    <?php _e('Edit Category', 'awesome-filterable-portfolio'); ?>
    <a href="<?php echo admin_url(); ?>admin.php?page=afp_add_new_category" title=""
       class="add-new-h2">
    <?php _e('Add New', 'awesome-filterable-portfolio'); ?>
    </a></h2>
  <?php if(isset($msg)){ ?>
  <div style="padding: 5px" class="updated"><b>
    <?php if ($msg=='added') { _e('Category added successfully', 'awesome-filterable-portfolio'); } else { _e('Category edited successfully', 'awesome-filterable-portfolio'); } ?>
    </b></div>
  <?php } ?>
  <div class="metabox-holder has-right-sidebar">
    <?php afp_help_meta_box(); ?>
    <div id="post-body">
      <div id="post-body-content">
        <div class="postbox">
          <h3><span>
            <?php _e('Edit Category', 'awesome-filterable-portfolio'); ?>
            </span></h3>
          <div class="inside">
            <form action="#" method="post" enctype="multipart/form-data">
              <p>
                <label for="title"><b>
                  <?php _e('Category name :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <input type="text" name="title" id="title" class="regular-text" value="<?php echo($cat->cat_name); ?>">
                <br>
              </p>
              <p>
                <label for="description"><b>
                  <?php _e('Description :', 'awesome-filterable-portfolio'); ?>
                  </b></label>
                <br>
                <textarea name="description" id="description" cols="50" rows="10"><?php echo($cat->cat_description); ?></textarea>
              </p>
	            <p>
		            <label for="cat_sorting"><b>
				            <?php _e('Sorting :', 'awesome-filterable-portfolio'); ?>
			            </b></label>
		            <input name="cat_sorting" style="width: 50px;" id="cat_sorting"
		            value="<?php echo($cat->cat_sorting); ?>"/>
	            </p>
              <input type="hidden" name="cat_id" id="cat_id" value="<?php echo($cat_id); ?>"/>
              <input type="hidden" name="which" id="which" value="update_category"/>
              <input type="submit" value="<?php _e('Save Category', 'awesome-filterable-portfolio'); ?>" class="button-primary">
            </form>
          </div>
          <!-- .inside -->
        </div>
      </div>
      <!-- #post-body-content -->
    </div>
    <!-- #post-body -->

  </div>
  <!-- .metabox-holder -->
</div>
<!-- .wrap -->

<?php
}
}


function afp_get_categories_page(){
	global $wpdb;
	?>
<div class="wrap">
<?php
	$cat_id = esc_sql($_GET['cat_id']);
	$action=$_GET['action'];
	if( $action=='' || $action=='delete' ){
	if ($action=='delete') { $wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'afp_categories WHERE cat_id=%d', $cat_id ) ); }
	?>
<h2>
  <?php _e('Categories ', 'awesome-filterable-portfolio'); ?>
  <a href="<?php echo admin_url(); ?>admin.php?page=afp_add_new_category" title="" class="add-new-h2">
  <?php _e('Add New', 'awesome-filterable-portfolio'); ?>
  </a></h2>
<?php
		$afpOptions = get_option('afpOptions');
		if( $afpOptions['sort_cat'] == 'on' ){
			$orderby = ' ORDER BY cat_name';
		} else {
			$orderby = ' ORDER BY `cat_sorting`';
		}

		$cats = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'afp_categories'
		.$orderby);
	if ($cats == null) {
		echo(__('You don\'t have any categories.', 'awesome-filterable-portfolio') . '&nbsp;' . __('Please', 'awesome-filterable-portfolio') . '&nbsp;<a href="' . admin_url() . 'admin.php?page=afp_add_new_category" title="">' . __('Add a New Category', 'awesome-filterable-portfolio') . '</a>' );
		} else {
	?>
<table class="widefat">
  <thead>
    <tr>
      <th class="row-title"><?php _e('Name', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Description', 'awesome-filterable-portfolio'); ?></th>
	    <th><?php _e('Sorting', 'awesome-filterable-portfolio'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php
		foreach ( $cats as $cat ) {
			echo('<tr>
					<td class="title column-title">
						<a href="' . admin_url() . 'admin.php?page=afp_add_new_category&cat_id=' . $cat->cat_id . '"><b>' . $cat->cat_name . '</b></a>
						<div class="row-actions">
							<span class="edit"><a href="' . admin_url() . 'admin.php?page=afp_add_new_category&cat_id=' . $cat->cat_id . '">Edit</a></span> |
							<span class="submitdelete"><a href="' . admin_url() . 'admin.php?page=afp_categories&action=confirm&cat_id=' . $cat->cat_id . '">Delete</a></span>
						</div>
					</td>
					<td>' . $cat->cat_description . '</td>
					<td>'.$cat->cat_sorting.'</td>
				</tr>');
		}
		?>
  </tbody>
  <tfoot>
    <tr>
      <th class="row-title"><?php _e('Name', 'awesome-filterable-portfolio'); ?></th>
      <th><?php _e('Description', 'awesome-filterable-portfolio'); ?></th>
	    <th><?php _e('Sorting', 'awesome-filterable-portfolio'); ?></th>
    </tr>
  </tfoot>
</table>
<?php
	}
	} elseif( $action == 'confirm' ){
		?>
<h2>
  <?php _e('Delete Confirmation', 'awesome-filterable-portfolio'); ?>
</h2>
<h3>
  <?php _e('Are you sure you want to delete this category?', 'awesome-filterable-portfolio'); ?>
</h3>
<a class="button-primary" href="<?php echo( admin_url() . 'admin.php?page=afp_categories&action=delete&cat_id=' . $cat_id ); ?>">
<?php _e( 'Delete', 'awesome-filterable-portfolio' ); ?>
</a> <a class="button-secondary" href="<?php echo( admin_url() . 'admin.php?page=afp_categories'); ?>">
<?php _e( 'Cancel', 'awesome-filterable-portfolio' ); ?>
</a>
<?php
	}
}


//Options Page
function afp_options_page(){
	$afpOptions = get_option('afpOptions');
	?>
<div class="wrap">
  <h2>
    <?php _e('Options', 'awesome-filterable-portfolio'); ?>
  </h2>
  <div class="metabox-holder has-right-sidebar">
    <?php afp_help_meta_box(); ?>
    <div id="post-body">
      <div id="post-body-content">
        <div class="postbox">
          <h3><span>
            <?php _e('Portfolio Options', 'awesome-filterable-portfolio'); ?>
            </span></h3>
          <div class="inside">
            <form action="#" method="post" enctype="multipart/form-data"
                  id="js-afp-options-form">
              <table cellpadding="3" class="afp-options-table">
                <tr>
                  <td style="width:140px;"><b>
                    <?php _e('Sort Categories:', 'awesome-filterable-portfolio'); ?>
                    </b></td>
                  <td><input type="checkbox" name="sort_cat" id="sort_cat" <?php if($afpOptions['sort_cat']=='on') { echo('checked'); } ?>>
                    <label for="sort_cat">
                      <?php _e('Sort categories by name', 'awesome-filterable-portfolio'); ?>
                    </label></td>
                </tr>
                <tr>
                  <td style="width:140px;" valign="top"><b>
                    <?php _e('Sort Portfolio Items:', 'awesome-filterable-portfolio'); ?>
                    </b></td>
                  <td><select name="sort_items" id="sort_items">
                      <option value="title" <?php if($afpOptions['sort_items']=='title'){ echo('selected'); } ?>>
                      <?php _e('Project Name', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="date" <?php if($afpOptions['sort_items']=='date'){ echo('selected'); } ?>>
                      <?php _e('Date', 'awesome-filterable-portfolio'); ?>
                      </option>
		                  <option value="client" <?php if($afpOptions['sort_items']=='client'){ echo('selected'); } ?>>
			                  <?php _e('Client Name', 'awesome-filterable-portfolio'); ?>
		                  </option>
		                  <option value="sorting" <?php if($afpOptions['sort_items']=='sorting'){ echo('selected'); } ?>>
			                  <?php _e('Sorting', 'awesome-filterable-portfolio'); ?>
		                  </option>
                      <option value="id" <?php if($afpOptions['sort_items']=='id'){ echo('selected'); } ?>></option>
                    </select>
                    <br />
                    <span class="description">
                    <?php _e('Select a creteria to sort the portfolio items. Choose the empty option to sort by the items\' order of creation.', 'awesome-filterable-portfolio'); ?>
                    </span></td>
                </tr>
              </table>
              <table cellpadding="3" class="afp-options-table">
                <tr>
                  <td style="width:140px;" valign="top"><b>
                    <?php _e('Project Links open in:', 'awesome-filterable-portfolio'); ?>
                    </b></td>
                  <td><select name="project_link" id="project_link">
                      <option value="blank" <?php if($afpOptions['project_link']=='blank'){ echo('selected'); } ?>>
                      <?php _e('New Tab / Window', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="self" <?php if($afpOptions['project_link']=='self'){ echo('selected'); } ?>>
                      <?php _e('Same Tab / Window', 'awesome-filterable-portfolio'); ?>
                      </option>
                    </select>
                    <br />
                    <span class="description">
                    <?php _e('This option specifies where the Project Link for a Portfolio Item should be open.', 'awesome-filterable-portfolio'); ?>
                    </span></td>
                </tr>
              </table>
              <table cellpadding="3" class="afp-options-table">
                <tr>
                  <td style="width:140px;" valign="top"><b>
                    <?php _e('Animation Properties:', 'awesome-filterable-portfolio'); ?>
                    </b></td>
                  <td><?php _e('Speed:', 'awesome-filterable-portfolio'); ?>
                    <select name="anim_speed">
                      <option value="1000" <?php if($afpOptions['anim_speed']=='1000'){ echo('selected'); } ?>>
                      <?php _e('Slow', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="600" <?php if($afpOptions['anim_speed']=='600'){ echo('selected'); } ?>>
                      <?php _e('Medium', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="300" <?php if($afpOptions['anim_speed']=='300'){ echo('selected'); } ?>>
                      <?php _e('Fast', 'awesome-filterable-portfolio'); ?>
                      </option>
                    </select>
                    <br />
                    <input type="checkbox" name="anim_easing" id="anim_easing" <?php if($afpOptions['anim_easing']=='on') { echo('checked'); } ?>>
                    <label for="anim_easing">
                      <?php _e('Use easing for animations', 'awesome-filterable-portfolio'); ?>
                    </label></td>
                </tr>
                <tr>
                  <td style="width:140px;" valign="top"><b>
                    <?php _e('Initial Image Effect:', 'awesome-filterable-portfolio'); ?>
                    </b></td>
                  <td><select name="startFX">
                      <option value="normal" <?php if($afpOptions['startFX']=='normal'){ echo('selected'); } ?>>
                      <?php _e('normal', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="transparent" <?php if($afpOptions['startFX']=='transparent'){ echo('selected'); } ?>>
                      <?php _e('transparent', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="overlay" <?php if($afpOptions['startFX']=='overlay'){ echo('selected'); } ?>>
                      <?php _e('overlay', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="grayscale" <?php if($afpOptions['startFX']=='grayscale'){ echo('selected'); } ?>>
                      <?php _e('grayscale', 'awesome-filterable-portfolio'); ?>
                      </option>
                    </select></td>
                </tr>
                <tr>
                  <td style="width:140px;" valign="top"><b>
                    <?php _e('Image Hover Effect:', 'awesome-filterable-portfolio'); ?>
                    </b></td>
                  <td><select name="hoverFX">
                      <option value="normal" <?php if($afpOptions['hoverFX']=='normal'){ echo('selected'); } ?>>
                      <?php _e('normal', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="popout" <?php if($afpOptions['hoverFX']=='popout'){ echo('selected'); } ?>>
                      <?php _e('popout', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="sliceDown" <?php if($afpOptions['hoverFX']=='sliceDown'){ echo('selected'); } ?>>
                      <?php _e('sliceDown', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="sliceDownLeft" <?php if($afpOptions['hoverFX']=='sliceDownLeft'){ echo('selected'); } ?>>
                      <?php _e('sliceDownLeft', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="sliceUp" <?php if($afpOptions['hoverFX']=='sliceUp'){ echo('selected'); } ?>>
                      <?php _e('sliceUp', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="sliceUpLeft" <?php if($afpOptions['hoverFX']=='sliceUpLeft'){ echo('selected'); } ?>>
                      <?php _e('sliceUpLeft', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="sliceUpRandom" <?php if($afpOptions['hoverFX']=='sliceUpRandom'){ echo('selected'); } ?>>
                      <?php _e('sliceUpRandom', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="sliceUpDown" <?php if($afpOptions['hoverFX']=='sliceUpDown'){ echo('selected'); } ?>>
                      <?php _e('sliceUpDown', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="sliceUpDownLeft" <?php if($afpOptions['hoverFX']=='sliceUpDownLeft'){ echo('selected'); } ?>>
                      <?php _e('sliceUpDownLeft', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="fold" <?php if($afpOptions['hoverFX']=='fold'){ echo('selected'); } ?>>
                      <?php _e('fold', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="foldLeft" <?php if($afpOptions['hoverFX']=='foldLeft'){ echo('selected'); } ?>>
                      <?php _e('foldLeft', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="boxRandom" <?php if($afpOptions['hoverFX']=='boxRandom'){ echo('selected'); } ?>>
                      <?php _e('boxRandom', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="boxRain" <?php if($afpOptions['hoverFX']=='boxRain'){ echo('selected'); } ?>>
                      <?php _e('boxRain', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="boxRainReverse" <?php if($afpOptions['hoverFX']=='boxRainReverse'){ echo('selected'); } ?>>
                      <?php _e('boxRainReverse', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="boxRainGrow" <?php if($afpOptions['hoverFX']=='boxRainGrow'){ echo('selected'); } ?>>
                      <?php _e('boxRainGrow', 'awesome-filterable-portfolio'); ?>
                      </option>
                      <option value="boxRainGrowReverse" <?php if($afpOptions['hoverFX']=='boxRainGrowReverse'){ echo('selected'); } ?>>
                      <?php _e('boxRainGrowReverse', 'awesome-filterable-portfolio'); ?>
                      </option>
                    </select></td>
                </tr>
              </table>
	            <table cellpadding="3" class="afp-options-table">
	              <tr>
		              <td style="width:140px;" valign="top"><b>
				              <?php _e('Display categories', 'awesome-filterable-portfolio'); ?>
			              </b></td>
		              <td>
			              <input type="hidden" name="displayCat" value="0" />
			              <input type="checkbox" name="displayCat"
			                     id="displayCat"
			                     value="1"
				              <?php if ($afpOptions['displayCat'] == 1)
				              {
					              echo 'checked="checked"';
				              } ?> />
			              <label for="displayCat">
				              <?php _e('Display categories under works names', 'awesome-filterable-portfolio'); ?>
			              </label>
		              </td>
	              </tr>
	              <tr>
		              <td valign="top"><b>
				              <?php _e('Thumbnail width', 'awesome-filterable-portfolio'); ?>
			              </b></td>
		              <td>
			              <input type="text" name="thumbnailWidth" value="<?php
			              echo $afpOptions['thumbnailWidth'];
			              ?>"
			                     style="width: 50px;" /> px<BR>
			              <?php _e('Max width, when thumbnail not setted and thumbnail
			              make from big image automatialy (300 as default)',
				              'awesome-filterable-portfolio'); ?>
		              </td>
	              </tr>
	              <tr>
		              <td valign="top"><b>
				              <?php _e('Crop thumbnails', 'awesome-filterable-portfolio')
				              ; ?>
			              </b></td>
		              <td>
			              <input type="hidden" name="cropThumbnails" value="0" />
			              <input type="checkbox" name="cropThumbnails"
			                     id="cropThumbnails"
			                     value="1"
				              <?php if ($afpOptions['cropThumbnails'] == 1)
				              {
					              echo 'checked="checked"';
				              } ?> />
			              <label for="cropThumbnails">
				              <?php _e('Crop thumbnails to the size'); ?>
			              </label>
		              </td>
	              </tr>
	              <tr id="afp-options-form-height">
		              <td valign="top"><b>
				              <?php _e('Thumbnail height', 'awesome-filterable-portfolio')
				              ; ?>
			              </b></td>
		              <td>
			              <input type="text" name="thumbnailHeight" value="<?php
			              echo $afpOptions['thumbnailHeight'];
			              ?>"
			                     style="width: 50px;" /> px<BR>
			              <?php _e('Same as width, 250 as default',
				              'awesome-filterable-portfolio'); ?>
		              </td>
	              </tr>
              </table>
              <input type="hidden" name="which" id="which" value="options_page"/>
              <input type="submit" value="<?php _e('Save Options', 'awesome-filterable-portfolio'); ?>" class="button-primary">
            </form>
          </div>
          <!-- .inside -->
        </div>
      </div>
      <!-- #post-body-content -->
    </div>
    <!-- #post-body -->

  </div>
  <!-- .metabox-holder -->
</div>
<!-- .wrap -->
<?php
}


function afp_options_page_menu(){
	add_submenu_page( 'afp', 'Options', __('Options', 'awesome-filterable-portfolio'), 'manage_options', 'afp_options_page', 'afp_options_page' );
}
add_action( 'admin_menu', 'afp_options_page_menu' );


//ADD, UPDATE PORTFOLIO ITEM/CATEGORY


global $wpdb;

if(isset($_POST['which'])){
  $which = $_POST['which'];
} else {
  $which = '';
}

/**
 * Make a thumbnail from image if thumbnail is empty
 *
 * @param string $imageUrl Url of big image
 * @param string $thumbnailUrl Url of current thumbnail
 * @return string
 */
function afp_auto_thumbnail($imageUrl, $thumbnailUrl) {
	if ($thumbnailUrl) {
		return $thumbnailUrl;
	}

	if( !function_exists( 'wp_get_current_user' ) ) {
		include( ABSPATH . "wp-includes/pluggable.php" );
	}

	$afpOptions = get_option('afpOptions');
	if (!$afpOptions['thumbnailWidth']) {
		$afpOptions['thumbnailWidth'] = 300;
	}
	if (!$afpOptions['thumbnailHeight']) {
		$afpOptions['thumbnailHeight'] = 250;
	}

	$upload = wp_upload_dir();
	/*$uploadDirArr = wp_upload_dir();
	$uploadPath = $uploadDirArr['path'];
	$uploadUrl = $uploadDirArr['url'];
	$uploadPath = preg_replace('~(.*wp-content/uploads/)~', '', $uploadPath);*/
	$imageRelPath = preg_replace('~(.*wp-content/uploads/)~', '', $imageUrl);
	$imageAbsPath = $upload['basedir'].'/'.$imageRelPath;
	$imageInfo = pathinfo($imageAbsPath);
	print_r($imageInfo);
	$n = 1;
	do {
		$thumbnailAbsPath = $imageInfo['dirname'].'/'
			.$imageInfo['filename'].'_'.$afpOptions['thumbnailWidth'].'_'.$n.'.'
			.$imageInfo['extension'];
		$n ++;
	}
	while(is_file($thumbnailAbsPath));

	/*echo $thumbnailRelPath;

	print_r($upload);
	echo("\n\n<BR>\n\n");
	//echo($fileRelPath."\n\n<BR>\n\n");
	echo(wp_make_link_relative($imageUrl));
	exit();*/

	$image = wp_get_image_editor($imageUrl);
	$height = $afpOptions['cropThumbnails'] == 1
		? $afpOptions['thumbnailHeight'] : 10000;
	$image->resize($afpOptions['thumbnailWidth'], $height, $afpOptions['cropThumbnails']);
	$image->save($thumbnailAbsPath);

	return str_replace(
		$upload['basedir'],
		$upload['baseurl'],
		$thumbnailAbsPath
	);
}


/**
 * Return next number for table field
 *
 * It's can be use for get new sorting number
 *
 * @param string $tableName Table name
 * @param string $fieldName Field name
 * @param int $step Plus to previews number
 * @return int
 */
function getNextFieldNumber($tableName, $fieldName, $step=10) {

	global $wpdb;

	$item_sorting = 0;

	$lastSorting = $wpdb->get_results(
		'SELECT `'.$fieldName.'` FROM `' . $wpdb->prefix . $tableName. '`
			ORDER BY `'.$fieldName.'` DESC LIMIT 1'
	);
	if (count($lastSorting)) {
		$item_sorting = $lastSorting[0]->$fieldName;
	}
	$item_sorting += $step;

	return $item_sorting;
}


/**
 * Return category name by id
 *
 * @param int $item_category_id ID of category
 * @return string
 */
function getCategoryNameById($item_category_id) {
	global $wpdb;

	$sel = $wpdb->get_results(
		$wpdb->prepare(
			'SELECT `cat_name` FROM `' . $wpdb->prefix . 'afp_categories`
			WHERE `cat_id`=%d',
			$item_category_id
		)
	);

	if (isset($sel[0]->cat_name)) {
		return $sel[0]->cat_name;
	}
}

/*** PORTFOLIO ITEM ***/
if($which=='new_portfolio_item'){
	$item_title = $_POST['title'];
	$item_link = $_POST['link'];
	$item_category_id = $_POST['category_id'];
	$item_category = getCategoryNameById($item_category_id);
	$item_client = $_POST['client'];
	$item_date = $_POST['date'];
	$item_thumbnail = $_POST['thumbnail_adr'];
	$item_image = $_POST['image_adr'];
	$item_description = $_POST['description'];
	$item_sorting = $_POST['item_sorting'];

	$item_thumbnail = afp_auto_thumbnail($item_image, $item_thumbnail);
	if ($item_date != NULL) {
		$item_date = date("Y-m-d", strtotime($item_date));
	} else {
		$item_date = '0000-00-00';
	}

	// Auto sorting
	if (!$item_sorting) {
		$item_sorting = getNextFieldNumber('afp_items', 'item_sorting');
	}

	$wpdb->query($wpdb->prepare('
	INSERT INTO ' . $wpdb->prefix . 'afp_items(item_title, item_link, item_description, item_client, item_date, item_thumbnail, item_image, item_category, item_category_id, item_sorting)
	VALUES( %s, %s, %s, %s, %s, %s, %s, %s, %d, %d)' , $item_title, $item_link, $item_description, $item_client, $item_date, $item_thumbnail, $item_image, $item_category, $item_category_id, $item_sorting
	));
	header ('Location: ' . admin_url() . 'admin.php?page=afp_add_new_portfolio_item&msg=added&item_id=' . $wpdb->insert_id);
}
if($which=='update_portfolio_item'){
	$item_id = $_POST['item_id'];
	$item_title = $_POST['title'];
	$item_link = $_POST['link'];
	$item_category_id = $_POST['category_id'];
	$item_category = getCategoryNameById($item_category_id);
	$item_client = $_POST['client'];
	$item_date = $_POST['date'];
	$item_thumbnail = $_POST['thumbnail_adr'];
	$item_image = $_POST['image_adr'];
	$item_description = $_POST['description'];
	$item_sorting = $_POST['item_sorting'];

	// Auto sorting
	if (!$item_sorting) {
		$item_sorting = getNextFieldNumber('afp_items', 'item_sorting');
	}

	$item_thumbnail = afp_auto_thumbnail($item_image, $item_thumbnail);
	if ($item_date != '') {
		$item_date = date("Y-m-d", strtotime($item_date));
	} else {
		$item_date = '0000-00-00';
	}
	$wpdb->query($wpdb->prepare('UPDATE ' . $wpdb->prefix . 'afp_items SET item_title = %s , item_link = %s , item_description = %s , item_client = %s , item_date = %s , item_thumbnail = %s , item_image = %s , item_category = %s, item_category_id = %d, item_sorting = %d WHERE item_id= %d',
	$item_title, $item_link, $item_description, $item_client, $item_date, $item_thumbnail, $item_image, $item_category, $item_category_id, $item_sorting, $item_id
	));
	header ('Location: ' . admin_url() . 'admin.php?page=afp_add_new_portfolio_item&msg=edited&item_id=' . $item_id);
}

/*** CATEGORY ***/

if($which=='new_category'){
	$cat_name = $_POST['title'];
	$cat_description = $_POST['description'];
	$cat_sorting = $_POST['cat_sorting'];

	// Auto sorting
	if (!$cat_sorting) {
		$cat_sorting = getNextFieldNumber('afp_categories', 'cat_sorting');
	}

	$wpdb->query($wpdb->prepare('
	INSERT INTO ' . $wpdb->prefix . 'afp_categories(cat_name, cat_description, cat_sorting)
	VALUES( %s, %s, %d)' , $cat_name, $cat_description, $cat_sorting ));
	header ('Location: ' . admin_url() . 'admin.php?page=afp_add_new_category&msg=added&cat_id=' . $wpdb->insert_id);
}
if($which=='update_category'){
	$cat_id = $_POST['cat_id'];
	$cat_name = $_POST['title'];
	$cat_description = $_POST['description'];
	$cat_sorting = $_POST['cat_sorting'];

	// Auto sorting
	if (!$cat_sorting) {
		$cat_sorting = getNextFieldNumber('afp_categories', 'cat_sorting');
	}

	$wpdb->query( $wpdb->prepare('UPDATE ' . $wpdb->prefix . 'afp_categories SET cat_name = %s , cat_description = %s, cat_sorting = %d WHERE cat_id= %d',
	$cat_name, $cat_description, $cat_sorting, $cat_id ) );
	header ('Location: ' . admin_url() . 'admin.php?page=afp_add_new_category&msg=edited&cat_id=' . $cat_id);
}


/**
 * Add column to talbe if column not exists
 *
 * Need for add columns to existing table after update table structure
 *
 * Example:
 * <code>
 * addColumnIfNotExists('afp_items', 'item_sorting', '`item_sorting` INT(11) NOT NULL');
 * </code>
 *
 * @param string $tableName Table name
 * @param string $columnName Column name
 * @param string $columnAddStringQuery Query for add column, example: `item_sorting` INT
 * (11) NOT NULL
 * @return bool True, if field added
 */
function addColumnIfNotExists($tableName, $columnName, $columnAddStringQuery) {
	global $wpdb;

	$needToAdd = true;

	$fields = @$wpdb->get_results(
		'SHOW COLUMNS FROM `'.$wpdb->prefix.$tableName.'`',
		ARRAY_A
	);

	if (is_array($fields)) {
		foreach($fields as $field) {
			if ($field['Field'] == $columnName) {
				$needToAdd = false;
			}
		}
	}

	if ($needToAdd) {
		$wpdb->query('ALTER TABLE `'.$wpdb->prefix.$tableName.'`
		ADD COLUMN '.$columnAddStringQuery);

		return true;
	}
}

/*** OPTIONS PAGE ***/
if($which=='options_page'){
	$sort_cat = $_POST['sort_cat'];
	$sort_items = $_POST['sort_items'];
	$project_link = $_POST['project_link'];
	$anim_speed = $_POST['anim_speed'];
	$anim_easing = $_POST['anim_easing'];
	$startFX = $_POST['startFX'];
	$hoverFX = $_POST['hoverFX'];
	$displayCat = $_POST['displayCat'];
	$thumbnailWidth = $_POST['thumbnailWidth'];
	$thumbnailHeight = $_POST['thumbnailHeight'];
	$cropThumbnails = $_POST['cropThumbnails'];
	$afpOptions = array(
		'sort_cat'        => $sort_cat,
		'sort_items'      => $sort_items,
		'project_link'    => $project_link,
		'anim_speed'      => $anim_speed,
		'anim_easing'     => $anim_easing,
		'startFX'         => $startFX,
		'hoverFX'         => $hoverFX,
		'displayCat'      => $displayCat,
		'thumbnailWidth'  => $thumbnailWidth,
		'thumbnailHeight' => $thumbnailHeight,
		'cropThumbnails'  => $cropThumbnails,
	);
	update_option( 'afpOptions', $afpOptions );
}


//Activation Code
function afp_activation(){
	global $wpdb;
	$req = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "afp_items(
			item_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			item_title VARCHAR (100),
			item_link VARCHAR (500),
			item_description TEXT,
			item_client VARCHAR (100),
			item_date DATE,
			item_thumbnail VARCHAR (200),
			item_image VARCHAR (200),
			item_category VARCHAR (150),
			item_sorting INT(11),
			item_category_id INT(11) NOT NULL
			); ";
	$wpdb->query( $req );
	$req = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "afp_categories(
			cat_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			cat_name VARCHAR (100),
			cat_description TEXT,
			cat_sorting INT(11)
			);";
	$wpdb->query( $req );

	// Update Tables from version 1.9 to 1.10
	// (add columns, if columns not exists)
	addColumnIfNotExists('afp_items', 'item_sorting', '`item_sorting` INT(11) NOT NULL');
	addColumnIfNotExists('afp_categories', 'cat_sorting', '`cat_sorting` INT(11) NOT NULL');
	if (addColumnIfNotExists('afp_items', 'item_category_id', '`item_category_id` INT(11) NOT NULL')) {
		$selCategories = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix
			.'afp_categories');
		foreach($selCategories as $category) {
			$wpdb->query(
				$wpdb->prepare(
					'UPDATE `'.$wpdb->prefix.'afp_items`
					SET item_category_id=%d WHERE `item_category`=%s',
					$category->cat_id, $category->cat_name)
			);
		}
	}


	//Create the plugin options
	$afpOptions = array(
		'sort_cat' => NULL,
		'sort_items' => 'id',
		'project_link' => 'new',
		'anim_speed' => '600',
		'anim_easing' => 'on',
		'startFX' => 'normal',
		'hoverFX' => 'normal',
		'displayCat'=> '0',
		'thumbnailHeight'=>250,
		'thumbnailWidth'=>300,
	);
	update_option( 'afpOptions', $afpOptions );
}
register_activation_hook(__FILE__, 'afp_activation');


//Deactivation Code
function afp_deactivation(){
	//This is commented because the plugin data will still be available even if you deactivate or delete the plugin (just in case to be used again)
	//delete_option('afpOptions');
	/*global $wpdb;
	$req = "DROP TABLE IF EXISTS " . $wpdb->prefix . "afp_items;";
	$wpdb->query($req);
	$req = "DROP TABLE IF EXISTS " . $wpdb->prefix . "afp_categories;";
	$wpdb->query($req);*/
}
register_deactivation_hook(__FILE__, 'afp_deactivation');


/*** FRONT END ***/
function afp_footer_js(){
	$afpOptions = get_option('afpOptions');
	if( $afpOptions['anim_easing'] == 'on'){
		$anim_easing ='easeInOutQuad';
	}else{
		$anim_easing ='jswing';
	}
	echo("
<script type='text/javascript'>
window.afp_dur=" . $afpOptions['anim_speed'] . ";
window.afp_easing = '" . $anim_easing . "';
window.afp_startFX = '" . $afpOptions['startFX'] . "';
window.afp_hoverFX = '" . $afpOptions['hoverFX'] . "';
</script>
	");
}


function afp_shortcode(){
	global $wpdb;

	//Registering Scripts & Styles for the FrontEnd
	wp_register_script('afp-easing', plugin_dir_url(__FILE__) . 'js/jquery-easing.js');
	wp_register_script('afp-quicksand', plugin_dir_url(__FILE__) . 'js/quicksand.js');
	wp_register_script('afp-colorbox', plugin_dir_url(__FILE__) . 'js/jquery.colorbox-min.js');
	wp_register_script('afp-functions', plugin_dir_url(__FILE__) . 'js/afp-functions.js');
	wp_register_script('adipoli', plugin_dir_url(__FILE__) . 'js/adipoli.js');

	wp_register_style('colorbox-style', plugin_dir_url(__FILE__) . 'css/colorbox.css');
	wp_register_style('afp-style', plugin_dir_url(__FILE__) . 'css/afp-style.css');

	wp_register_style('adipoli-style', plugin_dir_url(__FILE__) . 'css/adipoli.css');


	//Enqeueing Scripts & Styles
	wp_enqueue_script('jquery');
	wp_enqueue_script('afp-easing');
	wp_enqueue_script('afp-quicksand');
	wp_enqueue_style('afp-style');
	wp_enqueue_script('afp-colorbox');
	wp_enqueue_style('colorbox-style');
	wp_enqueue_script('afp-functions');
	wp_enqueue_script('adipoli');
	wp_enqueue_style('adipoli-style');

	//Get The Plugin Options
	$afpOptions = get_option('afpOptions');

	//SQL Queries
	switch( $afpOptions['sort_items'] ){
		case 'sorting':
			$orderby = 'item_sorting ASC';
			break;
		case 'title':
			$orderby = 'item_title ASC';
			break;
		case 'date':
			$orderby = 'item_date DESC';
			break;
		case 'client':
			$orderby = 'item_title ASC';
			break;
		case 'id':
			$orderby = 'item_id ASC';
			break;
	}
	$items = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'afp_items ORDER BY ' . $orderby);
	if( $afpOptions['sort_cat'] == 'on' ){
		$orderby = ' ORDER BY cat_name';
	} else {
		$orderby = ' ORDER BY `cat_sorting`';
	}
	$cats = $wpdb->get_results(
		'SELECT * FROM ' . $wpdb->prefix . 'afp_categories' . $orderby);
	?>
<?php
		//AFP Main Container
		$output='<div class="afp-clear"></div>
		<div id="afp-container">';

		//Start Echo Categories
        $output.='<ul id="afp-filter">
        <li class="afp-active-cat"><a href="#" class="All" data-value="All">' . __('All', 'awesome-filterable-portfolio') . '</a></li>';
        foreach ( $cats as $cat ){
            	$output.='<li><a href="#" class="' . preg_replace("~[^A-Za-z0-9]~", "", $cat->cat_name) . '" data-value="'.$cat->cat_id.'">' . $cat->cat_name . '</a></li>';
        }
        $output.='</ul>';
		//End Echo Categories

		//Start Echo Portfolio Items
        $output.='<ul class="afp-items">';
        $k = 1;
        foreach ($items as $item ){
            	$output.='<li class="afp-single-item" data-id="id-' . $k . '" data-type="' .
		            $item->item_category_id . '">
                <a class="colorbox" title="' . $item->item_description . '" href="' . $item->item_image . '"><img alt="" class="img-link-initial" src="' . $item->item_thumbnail . '"></a><br />
                <ul class="afp-item-details">';
                    if($item->item_title != null) { $output.='<li><strong>' . $item->item_title . '</strong></li>'; }
					if($item->item_client != null) { $output.='<li>' . $item->item_client . '</li>'; }
					if($item->item_date != '0000-00-00') { $output.='<li>' . date("m/d/Y", strtotime($item->item_date)) . '</li>'; }
					if($item->item_link != null) { $output.='<li><a target="_' . $afpOptions['project_link'] . '" href="' . $item->item_link . '">' . __('Project Link', 'awesome-filterable-portfolio') . '</a></li>'; }
	                if ($afpOptions['displayCat'] == 1) {
		                $output .= '<li class="afp-item-category">'.
			                getCategoryNameById($item->item_category_id).'</li>';
	                }
                $output.='</ul>
            </li>';

            $k++;
		}
        $output.='</ul>

    </div>

    <div class="afp-clear"></div>';
	add_action('wp_footer', 'afp_footer_js');
	return $output;

}

add_shortcode('af-portfolio', 'afp_shortcode');

?>
