<?php
/*
Template Name: Advanced Search (Without Map)
*/
?>

<?php $sidebar = search_and_go_elated_sidebar_layout(); ?>
<?php get_header(); ?>
<?php search_and_go_elated_get_title(); ?>
<?php get_template_part('slider'); ?>
<?php    
$overlapping_content = search_and_go_elated_get_meta_field_intersect('overlapping_content') == 'yes' ? true : false;


$params = array();

//Type params
$listing_type = isset($_GET['type']) && $_GET['type'] !== '' ? $_GET['type'] : null;
if ( $listing_type ) {
	$listing = get_page_by_title( $listing_type, OBJECT, 'listing-type-item' );
	$params['type'] = $listing->ID;
}

//Keywords params
$keywords = isset($_GET['keywords']) && $_GET['keywords'] !== '' ? $_GET['keywords'] : null;
if ( $keywords ) {
	$params['keywords'] = $keywords;
}

//Location params
$location = isset($_GET['location']) && $_GET['location'] !== '' ? $_GET['location'] : null;
if ( $location ) {
	$location = get_term_by( 'name', $location, 'listing-item-location' );
	$params['location'] = $location->term_id;
}

$category = isset($_GET['category']) && $_GET['category'] !== '' ? $_GET['category'] : null;
if ( $category ) {
	$category = get_term_by( 'name', $category, 'listing-item-category' );
	$params['category'] = $category->term_id;
}

$tag = isset($_GET['item-tag']) && $_GET['item-tag'] !== '' ? $_GET['item-tag'] : null;
if ( $tag ) {
	$tag = get_term_by( 'name', $tag, 'listing-item-tag' );
	$params['tag'] = $tag->term_id;
}

if(search_and_go_elated_options()->getOptionValue('listings_per_page') != ""){
	$listing_post_per_page = search_and_go_elated_options()->getOptionValue('listings_per_page');
}else{
	$listing_post_per_page = esc_attr(get_option('posts_per_page'));
}
$params['number'] = $listing_post_per_page;
//Query
$query = search_and_go_elated_query_listing_items($params);
$data_params = '';
$max_items = $query->found_posts;
$paged = search_and_go_elated_paged();
$data_params .= 'data-listing-next-page= '.esc_attr($paged+1).' ';
$data_params .= 'data-listing-max-num-pages= '.esc_attr($max_items).' ';
$data_params .= 'data-listing-number-per-page= '.esc_attr($listing_post_per_page).' ';

$custom_class = 'eltd-listing-archive-load-more';
if($max_items === 0){
	$custom_class .= ' eltd-hide-button';
}
$button_params = array(
	'text' => esc_html__('Load More',  'search-and-go'),
	'custom_class' => $custom_class,
	'type' => 'solid',
	'color' => '#444',
	'hover_color' => '#444',
	'background_color' => '#ebebeb',
	'border_color' => '#ebebeb',
	'hover_background_color' => '',
	'hover_border_color'     => '#ebebeb',
	'icon_pack'              => 'font_elegant',
	'fe_icon'                => 'arrow_carrot-right'
);
$post_count = $query->found_posts;

$shortcode_params = array(
	'listing_basic_columns' => 'three',
	'listing_advanced_query'	=> $query
);

?>
	
<div class="eltd-container">
	<?php do_action('search_and_go_elated_after_container_open'); ?>
	
	<?php if ( $overlapping_content ) { ?>
		<div class="eltd-overlapping-content">
	<?php } ?>
	
	<div class="eltd-container-inner clearfix">

			<?php if( $sidebar == 'default' || $sidebar == '' ) {  ?>
				
				<!--render advanced search html-->
				<div class="eltd-listing-list eltd-listing-list-without-map eltd-advanced-search-holder" <?php echo esc_attr($data_params)?>>
					<div class="eltd-listing-list-inner">
						<?php search_and_go_elated_get_advanced_search_html($max_items); ?>
						<div class="eltd-listing-list-items eltd-listing-three-columns clearfix">
							<?php
								 if ( $query->have_posts() ) {
									while( $query->have_posts() ) {
										$query->the_post();
										search_and_go_elated_get_listing_list_extended_item_template();
									}
								}
							?>
						</div>
						<div class="eltd-listing-load-more-button-holder">
							<?php echo search_and_go_elated_execute_shortcode('eltd_button', $button_params );?>
						</div>
					</div>
				</div>
				
			<?php } 
				
			elseif ($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right' ) { ?>
				
				<div <?php echo search_and_go_elated_sidebar_columns_class(); ?>>
					<div class="eltd-column1 eltd-content-left-from-sidebar">
						<div class="eltd-column-inner">
							
							<!--render advanced search html-->
							<div class="eltd-listing-list eltd-listing-list-without-map eltd-advanced-search-holder" <?php echo esc_attr($data_params)?>>
								<div class="eltd-listing-list-inner">
									<?php search_and_go_elated_get_advanced_search_html($max_items); ?>
									<div class="eltd-listing-list-items eltd-listing-three-columns clearfix">
										<?php
										if ( $query->have_posts() ) {
											while( $query->have_posts() ) {
												$query->the_post();
												search_and_go_elated_get_listing_list_extended_item_template();
											}
										}
										?>
									</div>
									<div class="eltd-listing-load-more-button-holder">
										<?php echo search_and_go_elated_execute_shortcode('eltd_button', $button_params );?>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="eltd-column2">
						<?php get_sidebar(); ?>
					</div>
				</div>
				
			<?php } 
			
			elseif( $sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left' ){ ?>
				<div <?php echo search_and_go_elated_sidebar_columns_class(); ?>>
					<div class="eltd-column1">
						<?php get_sidebar(); ?>
					</div>
					<div class="eltd-column2 eltd-content-right-from-sidebar">
						<div class="eltd-column-inner">
							
							<!--render advanced search html-->
							<div class="eltd-listing-list eltd-listing-list-without-map eltd-advanced-search-holder" <?php echo esc_attr($data_params)?>>
								<div class="eltd-listing-list-inner">
									<?php search_and_go_elated_get_advanced_search_html($max_items); ?>
									<div class="eltd-listing-list-items eltd-listing-three-columns clearfix">
										<?php
										if ( $query->have_posts() ) {
											while( $query->have_posts() ) {
												$query->the_post();
												search_and_go_elated_get_listing_list_extended_item_template();
											}
										}
										?>
									</div>
									<div class="eltd-listing-load-more-button-holder">
										<?php echo search_and_go_elated_execute_shortcode('eltd_button', $button_params );?>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
		<?php } ?>
	</div>
			
	<?php do_action('search_and_go_elated_before_container_close'); ?>
			
	<?php if ( $overlapping_content ) { ?>
		</div>
	<?php } ?>
	
</div>

<?php get_footer(); ?>

