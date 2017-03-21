<div class="eltd-listing-archive-adv-search-holder clearfix">
<?php
$type = isset($_GET['type']) ? $_GET['type'] : null;
$keywords = isset($_GET['keywords']) ? $_GET['keywords'] : null;
$location = isset($_GET['location']) ? $_GET['location'] : null;

$sort_params = array(
	'date-desc' => esc_html('Date Desc' , 'search_and_go'),
	'date-asc' => esc_html('Date Asc' , 'search_and_go'),
	'name-desc' => esc_html('Name Desc' , 'search_and_go'),
	'name-asc' => esc_html('Name Asc' , 'search_and_go'),
	'rating-desc' => esc_html('Rating Desc' , 'search_and_go'),
	'rating-asc' => esc_html('Rating Asc' , 'search_and_go')
);

?>
	<div class="eltd-listing-archive-adv-search-field">
		<h5><?php esc_html_e('Keywords', 'search-and-go'); ?></h5>
		<input type="text" name="keyword" id="keyword" class="eltd-listing-archive-keyword" placeholder="Keyword" value="<?php echo esc_html( $keywords )?>">
	</div>
	<div class="eltd-listing-archive-adv-search-field">
		<h5><?php esc_html_e('Category', 'search-and-go'); ?></h5>
		<select class="eltd-listing-archive-type" data-placeholder="<?php esc_html_e('Category', 'search-and-go'); ?>" data-allow-clear="true">
			<option value="all"><?php esc_html_e('All', 'search-and-go')?></option>
			<?php foreach($types as $option_key => $option_value){ ?>
				<option value="<?php echo esc_attr($option_key)?>" <?php if ( $type == $option_value ) { echo 'selected'; } ?>>
					<?php echo esc_attr($option_value); ?>
				</option>
			<?php } ?>
		</select>
	</div>
	<div class="eltd-listing-archive-adv-search-field">
		<h5><?php esc_html_e('Location', 'search-and-go'); ?></h5>
		<select class="eltd-listing-archive-location" data-placeholder="<?php esc_html_e('Location', 'search-and-go'); ?>" data-allow-clear="true">
			<option value="all"><?php esc_html_e('All', 'search-and-go')?></option>
			<?php foreach($locations as $option_key => $option_value){ ?>
				<option value="<?php echo esc_attr($option_key)?>" <?php if ( $location == $option_value ) { echo 'selected'; } ?>>
					<?php echo esc_attr($option_value); ?>
				</option>
			<?php } ?>
		</select>
	</div>
	
	<!--render amenities fields which are specific for each type-->
	<h5 class="eltd-listing-archive-amenities-title"><?php esc_html_e('Filter by Amenities', 'search-and-go'); ?>:</h5>
	<div class="eltd-listing-archive-amenities-holder clearfix"></div>

	<div class="eltd-listing-archive-adv-search-count clearfix">
		<div class="eltd-listing-archive-adv-search-count-inner">
			<p>
				<?php printf( _nx( '<span class="eltd-number">%1$s</span> Result Found', '<span class="eltd-number">%1$s</span> Results Found', $post_count, 'post count', 'search-and-go' ), $post_count ); ?>
			</p>
		</div>
		<div class="eltd-listing-archive-sort-holder">
			<div class="eltd-listing-left-section">
				<p>
					<?php esc_html_e('Sort by', 'search-and-go'); ?>
				</p>
			</div>
			<div class="eltd-listing-right-section">
				<select class="eltd-listing-archive-sort" data-placeholder="<?php esc_html_e('Sort', 'search-and-go'); ?>" data-allow-clear="true">
					<?php foreach($sort_params as $option_key => $option_value){ ?>

						<option value="<?php echo esc_attr($option_key)?>" >
							<?php echo esc_attr($option_value); ?>
						</option>

					<?php } ?>
				</select>
			</div>

		</div>
	</div>