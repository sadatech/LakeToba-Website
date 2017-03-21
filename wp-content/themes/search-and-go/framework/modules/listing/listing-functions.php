<?php

if ( ! function_exists( 'search_and_go_elated_listing_assets' ) ) {

	function search_and_go_elated_listing_assets() {

		wp_enqueue_style( 'search_and_go_elated_listings', ELATED_ASSETS_ROOT.'/css/listings.min.css' );
		wp_enqueue_script( 'search_and_go_elated_listings', ELATED_ASSETS_ROOT.'/js/listings.min.js', array('jquery', 'underscore', 'jquery-ui-autocomplete'), false, true );

		if(search_and_go_elated_is_responsive_on()) {
			wp_enqueue_style( 'search_and_go_elated_listings_responsive', ELATED_ASSETS_ROOT.'/css/listings-responsive.min.css' );
		}

	}

	add_action( 'wp_enqueue_scripts', 'search_and_go_elated_listing_assets' );

}

if(!function_exists('search_and_go_elated_single_listing')){
	function search_and_go_elated_single_listing(){

		//$listing_template = search_and_go_elated_get_listing_single_type();
		$listing_template = 'standard'; //currently there is only one single listing type

        $params = array(
	    'overlapping_content' => search_and_go_elated_options()->getOptionValue('overlapping_content') == 'yes' ? true : false,
            'listing_template' => $listing_template,
            'holder_class'       => array(
                'eltd-'.$listing_template,
                'eltd-listing-single-holder'
            )
        );

        search_and_go_elated_get_module_template_part('templates/single/holder', 'listing', '', $params);
		
	}
}

if(!(function_exists('search_and_go_elated_get_listing_types'))){
	/**
	 * return listing type obejcts.
	 *
	 */
	function search_and_go_elated_get_listing_types(){
		
		$listing_types_array = array();
		$args = array(
			'post_type' => 'listing-type-item',
			'posts_per_page' => '-1'
		);
		
		$listing_types = get_posts($args);
		
		if (is_array($listing_types) && count($listing_types)) {

            foreach ($listing_types as $listing_type) {
				
				$listing_types_array[$listing_type->ID] = $listing_type->post_title;
				
            }
			
        }
		return $listing_types_array;
		
	}
	
}

if (!function_exists('search_and_go_elated_get_listing_types_VC')){
	  /**
     * Function that returns array of types formatted for Visual Composer
     *
     * @return array of types where key is type name and value is type id
     *
     */
	function search_and_go_elated_get_listing_types_VC(){
		$array = array();
		$array[''] = '';
		$array = array_merge($array, array_flip(search_and_go_elated_get_listing_types()));
		return $array;
	}
}

if(!function_exists('search_and_go_elated_get_listing_categories')){
	/**
	 * return listing categories
	 *
	 */
	function search_and_go_elated_get_listing_categories(){
		
		$listing_cat_array = array();
		$taxonomies = get_terms('listing-item-category');
		
		if (is_array($taxonomies) && count($taxonomies)) {
            foreach ($taxonomies as $cat) {
				$listing_cat_array[$cat->term_id] = $cat->name;				
            }
			
        }
		
		return $listing_cat_array;
		
	}
	
}

if (!function_exists('search_and_go_elated_get_listing_categories_VC')){
	  /**
     * Function that returns array of categories formatted for Visual Composer
     *
     * @return array of categories where key is category name and value is category id
     *
     */
	function search_and_go_elated_get_listing_categories_VC(){
		$array = array();
		$array[''] = '';
		$array = array_merge($array, array_flip(search_and_go_elated_get_listing_categories()));
		return $array;
	}
}

if(!function_exists('search_and_go_elated_get_listing_locations')){
	/**
	 * return listing locations
	 */
	function search_and_go_elated_get_listing_locations(){
		
		$listing_location_array = array();
		$taxonomies = get_terms('listing-item-location');
		
		if (is_array($taxonomies) && count($taxonomies)) {

            foreach ($taxonomies as $location) {
				
				$listing_location_array[$location->term_id] = $location->name;

            }
			
        }
		
		return $listing_location_array;
		
	}
	
}


if (!function_exists('search_and_go_elated_get_listing_locations_VC')){
	  /**
     * Function that returns array of locations formatted for Visual Composer
     *
     * @return array of categories where key is location name and value is location id
     *
     */
	function search_and_go_elated_get_listing_locations_VC(){
		$array = array();
		$array[''] = '';
		$array = array_merge($array, array_flip(search_and_go_elated_get_listing_locations()));
		return $array;
	}
}


if(!(function_exists('search_and_go_elated_get_listing_types_objects'))){
	/**
	 * return listing type obejcts.
	 *
	 */
	function search_and_go_elated_get_listing_types_objects(){
		
		$args = array(
			'post_type' => 'listing-type-item',
			'posts_per_page' => '-1'
		);
		
		$listing_types = get_posts($args);
		
		return $listing_types;
		
	}
	
}

if(! function_exists('search_and_go_elated_get_listing_social_custom_fields')){
	/**
	 * Function returns links and icons for listing social networks 
	 * 
	 * return array
	 */
	function search_and_go_elated_get_listing_social_custom_fields( $id ){
		
		$listing_social_array = array();
		$social_network_array = array('instagram', 'twitter','pinterest','tumblr','facebook','googleplus','linkedin','soundcloud','vimeo','youtube','skype','yahoo');
		
		foreach($social_network_array as $network){
			
			if(get_post_meta($id, 'eltd_listing_social_'.$network, 'true') != ''){
				
				$$network = array(
					'link' => get_post_meta($id, 'eltd_listing_social_'.$network, 'true'),
					'class' => 'social_'.$network
				);
				
				$listing_social_array[$network] = $$network;
			}
		}	

		return $listing_social_array;
	}
}

if(!function_exists('search_and_go_elated_check_predefined_fields')){
	/**
     * Function checks predefine listing type options by given listing type id
     * returns array with listing type fields options  
     */
	
	function search_and_go_elated_check_predefined_fields($post_id){
		
		$return_array = array();
		
		$standard_fields = array(
			'eltd_listing_type_show_phone',
			'eltd_listing_type_show_website',
			'eltd_listing_type_show_email',
			'eltd_listing_type_show_gallery',
			'eltd_listing_type_show_video',
			'eltd_listing_type_show_audio',
			'eltd_listing_type_show_work_hours',
			'eltd_listing_type_show_social_icons',
			'eltd_listing_type_show_price',
			'eltd_listing_type_show_instagram',
			'eltd_listing_type_show_booking_form'
		);
		
		foreach($standard_fields as $standard_field){
			$return_array[$standard_field] = get_post_meta($post_id, $standard_field , true);			
		}
		
		return $return_array;
	}
	
}

if(!function_exists('search_and_go_elated_generate_day_array')){
	/**
     * Function generate day array 
     * returns array  
     */
	function search_and_go_elated_generate_day_array(){
		
		$day_array = array(
			'monday'	=> 'Monday',
			'tuesday'	=> 'Tuesday',
			'wednesday' => 'Wednesday',
			'thursday'	=> 'Thursday',
			'friday'	=> 'Friday',
			'saturday'	=> 'Saturday',
			'sunday'	=> 'Sunday'
		);
		
		return $day_array;
	}
	
}

if(!function_exists('search_and_go_elated_generate_listing_social_icons_array')){
	/**
     * Function generate social icons array(this is used for listings)
     * returns array  
     */
	function search_and_go_elated_generate_listing_social_icons_array(){
		
		$social_network_array = array(
			
			'instagram'	=> 'Enter Instagram Profile URL',
			'twitter'	=> 'Enter Twitter Profile URL',
			'pinterest'	=> 'Enter Pinterest profile URL',
			'tumblr'	=> 'Enter Tumblr Profile URL',
			'facebook'	=> 'Enter Facebook Profile URL',
			'googleplus' => 'Enter Google Plus Profile URL',
			'linkedin'	=> 'Enter Linkedin Profile URL',
			'soundcloud' => 'Enter Sound Cloud Profile URL',
			'vimeo'	=> 'Enter Vimeo Profile URL',
			'youtube'	=> 'Enter Youtube Profile URL',
			'skype'	=> 'Enter Skype Profile URL',
			'yahoo'	=> 'Enter Yahoo Profile URL'
			
		);
		
		return $social_network_array;
		
	}
	
}

if(!function_exists('search_and_go_elated_set_field_params')){
	/**
     * Function generate array of field values 
     * returns array  
     */
	function search_and_go_elated_set_field_params($field){
		
		$return_array = array();
		
		if(is_array($field) && count($field)>0){
			
			foreach ($field as $key => $value){
				
				if( isset($value) && $value !== '' && $value !== NULL){
					$return_array[$key] = $value; 
				}
				else{
					$return_array[$key] = '';
				}
				
			}
			
		}
		
		return $return_array;
		
	}
}

if(!function_exists('search_and_go_elated_listing_get_info_part')) {
	
    function search_and_go_elated_listing_get_info_part($part, $params = array()) {

        //$listing_template = search_and_go_elated_get_listing_single_type();
		$listing_template = 'standard'; //currently we have only one single listing layout

        search_and_go_elated_get_module_template_part('templates/parts/'.$part, 'listing', $listing_template, $params);
		
    }
}

if ( ! function_exists( 'search_and_go_elated_get_listing_search' ) ) {

	function search_and_go_elated_get_listing_search() {

		$html = '';

		$html .= '<form class="search" action="' . esc_url( home_url( '/' )  ). '">';
		ob_start();
		do_action('search_and_go_elated_advanced_search_form');
		$html .= ob_get_clean();
		$html .= '<input type="submit" value="Search">';
		$html .= '</form>';

		return $html;

	}

}

if ( ! function_exists( 'search_and_go_elated_query_listing_items' ) ) {
	/**
	 * Function for getting listing items
	 *
	 * @param array $params
	 *
	 * @return array
	 */
	function search_and_go_elated_query_listing_items( $params = array() ) {
		global $search_params;
		$search_params = $params;

		$args = array(
			'post_type' => 'listing-item',
			'post_status' => 'publish'
		);

		if ( $params ) {
			extract($params);

			if ( isset( $keywords ) ) {
				$args['s'] = $keywords;
			}
			
			if ( isset($number) ) {
				$args['posts_per_page'] = $number;
			}
			if ( isset($type) ) {
				if($type !== '' && $type !=='all' ){
					$args['meta_key'] = 'eltd_listing_item_type';
					$args['meta_value'] = $type;
				}
			}

			$args['tax_query'] = array(
				'relation' => 'AND'
			);

			if ( isset( $category ) ) {
				if($category !== '' && $category !=='all' ){
					$args['tax_query'][] = array(
						'taxonomy' => 'listing-item-category',
						'field' => 'term_id',
						'terms' => (int)$category
					);
				}
			}

			if ( isset($location) ) {
				if($location !== '' && $location !=='all' ){
					$args['tax_query'][] = array(
						'taxonomy' => 'listing-item-location',
						'field' => 'term_id',
						'terms' => (int)$location
					);
				}
			}

			if ( isset($tag) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'listing-item-tag',
					'field' => 'term_id',
					'terms' => (int)$tag
				);
			}

		}

		$query = new WP_Query($args);

		add_filter('search_and_go_elated_multiple_map_variables', 'search_and_go_elated_return_search_map_data');

		return $query;

	}

}

if ( ! function_exists( 'search_and_go_elated_get_listing_list_item_template' ) ) {

	function search_and_go_elated_get_listing_list_item_template() {

			search_and_go_elated_get_module_template_part('templates/lists/single', 'listing');

	}

}

if ( ! function_exists( 'search_and_go_elated_get_listing_list_extended_item_template' ) ) {

	function search_and_go_elated_get_listing_list_extended_item_template() {

		$params['address'] = get_post_meta(get_the_ID(), 'eltd_listing_address', true);
		$params['rating_html'] = eltd_listing_get_shortcode_module_template_part('listing', 'listing-rating');
		$params['excerpt'] = get_the_excerpt();
		$params['icon_html'] = search_and_go_elated_get_listing_categories_html(get_the_ID());

		search_and_go_elated_get_module_template_part('templates/lists/single-extended', 'listing','',$params);

	}

}

if(!function_exists('search_and_go_elated_listing_comment_additional_fields')) {

	function search_and_go_elated_listing_comment_additional_fields() {

		if (is_singular('listing-item')) {
			$html = '<div class="eltd-rating-form-title-holder">'; //Form title begin
			$html .= '<div class="eltd-rating-form-title"><h5>' . esc_html__('Write a Review','search-and-go') . '</h5></div>';
			$html .= '<div class="eltd-comment-form-rating">
						<label>' . esc_html__('Rate Here', 'search-and-go') . '<span class="required">*</span></label>
						<span class="eltd-comment-rating-box">';
			for ($i = 1; $i <= 5; $i++) {
				$html .= '<span class="eltd-star-rating" data-value="' . $i . '"></span>';
			}
			$html .= '<input type="hidden" name="eltd_rating" id="eltd-rating" value="3">';
			$html .= '</span></div>';
			$html .= '</div>'; //Form title end

			$html .= '<div class="eltd-comment-input-title">';
			$html .= '<input id="title" name="eltd_comment_title" class="eltd-input-field" type="text" placeholder="' . esc_html__('Title of your Review', 'search-and-go') . '"/></div>';

			print $html;
		}
	}

	add_action( 'comment_form_top', 'search_and_go_elated_listing_comment_additional_fields' );

}

if(!function_exists('search_and_go_elated_extend_comment_edit_metafields')) {

	function search_and_go_elated_extend_comment_edit_metafields($comment_id) {
		if ((!isset($_POST['extend_comment_update']) || !wp_verify_nonce($_POST['extend_comment_update'], 'extend_comment_update')) && !is_singular('listing-item')) return;

		if ((isset($_POST['eltd_comment_title'])) && ($_POST['eltd_comment_title'] != '')):
			$title = wp_filter_nohtml_kses($_POST['eltd_comment_title']);
			update_comment_meta($comment_id, 'eltd_comment_title', $title);
		else :
			delete_comment_meta($comment_id, 'eltd_comment_title');
		endif;

		if ((isset($_POST['eltd_rating'])) && ($_POST['eltd_rating'] != '')):
			$rating = wp_filter_nohtml_kses($_POST['eltd_rating']);
			update_comment_meta($comment_id, 'eltd_rating', $rating);
		else :
			delete_comment_meta($comment_id, 'eltd_rating');
		endif;
	}

	add_action('edit_comment', 'search_and_go_elated_extend_comment_edit_metafields');
}

if(!function_exists('search_and_go_elated_extend_comment_add_meta_box')) {

	function search_and_go_elated_extend_comment_add_meta_box() {
		add_meta_box('title', esc_html__('Comment - Reviews', 'search-and-go'), 'search_and_go_elated_extend_comment_meta_box', 'comment', 'normal', 'high');
	}

	add_action('add_meta_boxes_comment', 'search_and_go_elated_extend_comment_add_meta_box');

}

if(!function_exists('search_and_go_elated_extend_comment_meta_box')) {

	function search_and_go_elated_extend_comment_meta_box($comment) {

		if ($comment->post_type == 'listing-item') {
			$title = get_comment_meta($comment->comment_ID, 'eltd_comment_title', true);
			$rating = get_comment_meta($comment->comment_ID, 'eltd_rating', true);
			wp_nonce_field('extend_comment_update', 'extend_comment_update', false);
			?>
			<p>
				<label for="title"><?php esc_html_e('Comment Title', 'search-and-go'); ?></label>
				<input type="text" name="eltd_comment_title" value="<?php echo esc_attr($title); ?>" class="widefat"/>
			</p>
			<p>
				<label for="rating"><?php esc_html_e('Rating', 'search-and-go'); ?>: </label>
				<span class="commentratingbox">
					<?php
					for ($i = 1; $i <= 5; $i++) {
						echo '<span class="commentrating"><input type="radio" name="eltd_rating" id="rating" value="' . $i . '"';
						if ($rating == $i) echo ' checked="checked"';
						echo ' />' . $i . ' </span>';
					}
					?>
				</span>
			</p>
			<?php
		}
	}
}

if(!function_exists('search_and_go_elated_save_comment_meta_data')) {

	function search_and_go_elated_save_comment_meta_data($comment_id) {

		if ((isset($_POST['eltd_comment_title'])) && ($_POST['eltd_comment_title'] != '')) {
			$title = wp_filter_nohtml_kses($_POST['eltd_comment_title']);
			add_comment_meta($comment_id, 'eltd_comment_title', $title);
		}

		if ((isset($_POST['eltd_rating'])) && ($_POST['eltd_rating'] != '')) {
			$rating = wp_filter_nohtml_kses($_POST['eltd_rating']);
			add_comment_meta($comment_id, 'eltd_rating', $rating);
		}

	}

	add_action('comment_post', 'search_and_go_elated_save_comment_meta_data');

}

if(!function_exists('search_and_go_elated_verify_comment_meta_data')) {

	function search_and_go_elated_verify_comment_meta_data($commentdata) {

		if ( is_singular('listing-item') ) {
			if (!isset($_POST['eltd_rating'])) {
				wp_die(esc_html__('Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'search-and-go'));
			}
		}
		return $commentdata;
	}

	add_filter('preprocess_comment', 'search_and_go_elated_verify_comment_meta_data');

}

if ( ! function_exists( 'search_and_go_elated_rating' ) ) {

	function search_and_go_elated_rating($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'eltd-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' eltd-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' eltd-pingback-comment';
		}

		?>

		<li itemprop="review" itemscope itemtype="http://schema.org/Review">
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="eltd-comment-image" itemprop="author" itemscope itemtype="http://schema.org/Person">
					<?php echo search_and_go_elated_kses_img(get_avatar($comment, 98)); ?>
				</div>
			<?php } ?>

			<div class="eltd-comment-text">

				<div class="eltd-comment-info">
					<?php
					$review_rating = get_comment_meta( $comment->comment_ID, 'eltd_rating', true );
					$review_title = get_comment_meta( $comment->comment_ID, 'eltd_comment_title', true );
					?>
					<div class="eltd-review-rating">
						<span class="rating-inner" style="width: <?php print $review_rating * 20; ?>%"></span>
					</div>
					<div class="eltd-review-title">
						<span>"<?php echo esc_html( $review_title ); ?>"</span>
					</div>
				</div>

				<?php if(!$is_pingback_comment) { ?>

					<div class="eltd-text-holder" id="comment-<?php echo comment_ID(); ?>"  itemprop="reviewBody">
						<?php comment_text(); ?>
					</div>

					<?php
					$commentDateTime = new DateTime( get_comment_time() );
					$commentMetaDate = $commentDateTime->format(DateTime::ISO8601);
					?>
					<div class="eltd-comment-bottom-info">

						<span class="eltd-comment-date" itemprop="datePublished" content="<?php echo esc_attr($commentMetaDate); ?>">
							<?php comment_date(get_option('date_format')); ?>
						</span>

					</div>

				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>

		<?php
	}

}

if ( ! function_exists( 'search_and_go_elated_get_listing_item_rating' ) ) {
	/**
	 * Calculate average rating for listing item
	 *
	 * @return float
	 */
	function search_and_go_elated_get_listing_item_rating() {

		$args = array(
			'post_id' => get_the_ID()
		);
		$comments = get_comments($args);

		$rating = array();

		foreach ( $comments as $comment ) {
			$rating[] = (int) get_comment_meta( $comment->comment_ID, 'eltd_rating', true );
		}

		if ( $rating ) {
			$average_rating = array_sum($rating)/count($rating);
			return array(
				'average_rating' => $average_rating,
				'ratings_count' => count($rating)
			);
		}


	}

}

if(!function_exists('search_and_go_elated_set_listing_item_rating')){

	function search_and_go_elated_set_listing_item_rating(){
		$args = array(
			'post_type' => 'listing-item',
			'post_status' => 'publish',
			'posts_per_page' => '-1'
		);
		$listing_items = get_posts($args);

		if(is_array($listing_items) && count($listing_items)){

			foreach ($listing_items as $item){

				$args = array(
					'post_id' => $item->ID
				);
				$comments = get_comments($args);

				$rating = array();

				foreach ( $comments as $comment ) {
					$rating[] = (int) get_comment_meta( $comment->comment_ID, 'eltd_rating', true );
				}

				if ( $rating ) {
					$average_rating = array_sum($rating)/count($rating);
					update_post_meta($item->ID, 'eltd_listing_item_rating', $average_rating);
				}

			}

		}

	}
	add_action('init', 'search_and_go_elated_set_listing_item_rating');
}

if ( ! function_exists( 'search_and_go_elated_send_listing_item_enquiry' ) ) {
	
	function search_and_go_elated_send_listing_item_enquiry() {

		if ( isset($_POST['data']) ) {

			$error = false;
			$responseMessage = '';

			$email_data = $_POST['data'];
			$nonce = $email_data['nonce'];

			if ( wp_verify_nonce( $nonce, 'eltd_validate_listing_item_enquiry' ) ) {

				//Validate
				if ( $email_data['name'] ) {
					$name = esc_html($email_data['name']);
				} else {
					$error = true;
					$responseMessage = esc_html__('Please insert valid name', 'search-and-go');
				}

				if ( $email_data['email'] ) {
					$email = esc_html($email_data['email']);
				} else {
					$error = true;
					$responseMessage = esc_html__('Please insert valid email', 'search-and-go');
				}

				if ( $email_data['phone'] ) {
					$phone = esc_html($email_data['phone']);
				}

				if ( $email_data['message'] ) {
					$message = esc_html($email_data['message']);
				} else {
					$error = true;
					$responseMessage = esc_html__('Please insert valid phone', 'search-and-go');
				}

				//Send Mail and response
				if ( $error ) {

					wp_send_json_error( $responseMessage );

				} else {

					//Get post id from request
					$post_id = $email_data['itemId'];
					//Get email address
					$mail_to = get_post_meta( $post_id, 'eltd_listing_email', true );

					$headers = array(
						'From: ' . $name . ' <' . $email . '>',
						'Reply-To: ' . $name . ' <' . $email . '>',
					);

					$additional_emails = array();
					if ( search_and_go_elated_options()->getOptionValue('listing_item_enquiry_send_to_admin') == 'yes' ) {
						$additional_emails[] = get_option('admin_email');
					}
					if ( search_and_go_elated_options()->getOptionValue('listing_item_enquiry_send_to_author') == 'yes' ) {
						$post = get_post($post_id);
						$additional_emails[] = get_the_author_meta( 'user_email', (int) $post->post_author );
					}
					$additional_emails = array_unique( $additional_emails );
					$headers[] = 'Bcc: ' . implode(',', $additional_emails);


					$messageTemplate = esc_html__('From', 'search-and-go'). ': ' . $name . "\r\n";
					$messageTemplate .= esc_html__('Phone', 'search-and-go') . ': ' . $phone . "\r\n\n";
					$messageTemplate .= esc_html__('Message', 'search-and-go') . ': ' . $message . "\r\n\n";
					$messageTemplate .= esc_html__( 'Message sent via enquiry form on', 'search-and-go' ) . ' ' . get_bloginfo('name') . ' - ' . esc_url( home_url('/') );

					wp_mail(
						$mail_to, //Mail To
						esc_html__('New Enquiry form blog name', 'search-and-go'), //Subject
						$messageTemplate, //Message
						$headers //Additional Headers
					);

					$responseMessage = esc_html__('Enquiry sent successfully', 'search-and-go');
					wp_send_json_success( $responseMessage );
				}

			}



		} else {
			$message = esc_html__('Please review your enquiry and send again', 'search-and-go');
			wp_send_json_error( $message );
		}

	}

	add_action( 'wp_ajax_search_and_go_elated_send_listing_item_enquiry', 'search_and_go_elated_send_listing_item_enquiry' );
	add_action( 'wp_ajax_nopriv_search_and_go_elated_send_listing_item_enquiry', 'search_and_go_elated_send_listing_item_enquiry' );

}

if(!function_exists('search_and_go_elated_get_advanced_search_html')){
	/**
	 * Function generates listing type custom fields for advanced search
	 *
	 * @return html
	 */
	function search_and_go_elated_get_advanced_search_html($post_count = ''){
		global $wp_query;
	
		$html = $post_count_number =  '';
		$params = array();
		
		//check if is set post count.In advanced search without map post count need to be set because there is not used global wp query
		if($post_count !== ''){
			$post_count_number = $post_count;
		}else{
			$post_count_number = $wp_query->post_count;
		}

		$params['types'] = search_and_go_elated_get_listing_types();
		$params['categories']= search_and_go_elated_get_listing_categories();
		$params['locations'] = search_and_go_elated_get_listing_locations();
		$params['post_count'] = $post_count_number;
		
		$html .=  search_and_go_elated_get_module_template_part('templates/parts/listing-archive-advanced-fields', 'listing', '', $params);
		
		return $html; 		
	
	}	
}


if(!function_exists('search_and_go_elated_archive_adv_search_fields')){
	
	function search_and_go_elated_archive_adv_search_fields(){
		
		$html = $type_id = '';
		
		if(isset($_POST['typeID'])){
			$type_id = $_POST['typeID'];
		}
		if($type_id == 'all'){
			$type_id = '';
		}
		if($type_id !== ''){
			$html = search_and_go_elated_get_amenities_fields($type_id);
		}
		
		$return_obj = array(
			'html' => $html,
		);

		echo json_encode($return_obj); exit;
	}
	add_action('wp_ajax_search_and_go_elated_archive_adv_search_fields', 'search_and_go_elated_archive_adv_search_fields');
	add_action('wp_ajax_nopriv_search_and_go_elated_archive_adv_search_fields', 'search_and_go_elated_archive_adv_search_fields');
}

if(!function_exists('search_and_go_elated_get_amenities_fields')){
	
	function search_and_go_elated_get_amenities_fields($id){
		
		$html = '';
		$listing_type_amenities = get_post_meta($id, 'eltd_listing_type_feature_list', true);

		if ( $listing_type_amenities !== '' ) {
			foreach($listing_type_amenities as $amenity){

				if ( $amenity !== '' ) {
					$amenity_name = sanitize_title(strtolower($amenity));

					$html .='<div class="eltd-listing-archive-advanced-search-amenity">';
					$html .= '<div class="eltd-checkbox-holder">';
					$html .= '<div class="eltd-listing-amenity-input"></div>';
					$html .= '</div>';
					$html .= '<div class="eltd-label-holder">';
					$html .= '<input name="'.$amenity_name.'" type="checkbox" id="'.$amenity_name.'" class="eltd-input-field eltd-advanced-input-field"/>';
					$html .= '<label for="'.$amenity_name.'">'.$amenity.'</label>';
					$html .= '</div>';
					$html .= '</div>';
				}

			}
		}

		return $html;

		
	}
	
}

if(!function_exists('search_and_go_elated_archive_adv_search_query')){
	
	function search_and_go_elated_archive_adv_search_query(){

		$html =  '';
		$location_id = $type_id = $keyword = $postPerPage = $nextPage = $sort = $order = $order_by = '';
		$sort_array = array();
		$map_flag = true;
		$loadMoreFlag = false;
		$search_params = array();
		
		if(isset($_GET['typeID'])){
			$type_id = $_GET['typeID'];
		}
		if(isset($_GET['locationID'])){
			$location_id = $_GET['locationID'];
		}
		if(isset($_GET['searchKeyword'])){
			$keyword = $_GET['searchKeyword'];
		}
		if(isset($_GET['searchParams'])){
			$search_params = $_GET['searchParams'];
		}
		if(isset($_GET['mapFlag'])){
			$map_flag = $_GET['mapFlag'];
		}
		if(isset($_GET['postPerPage'])){
			$postPerPage = $_GET['postPerPage'];
		}
		if(isset($_GET['nextPage'])){
			$nextPage = $_GET['nextPage'];
		}
		if(isset($_GET['sort'])){
			$sort = $_GET['sort'];
		}
		if(isset($_GET['loadMoreFlag'])){
			$loadMoreFlag = $_GET['loadMoreFlag'];
		}
		if($type_id == 'all'){
			$type_id = '';
		}
		if($location_id == 'all'){
			$location_id = '';
		}

		$href = search_and_go_elated_build_search_query_url( $type_id, $location_id, $keyword );
		extract($search_params);
		
		$query_array = array(
			'post_type' => 'listing-item',
			'post_status' => 'publish'
		);
		if($postPerPage !== ''){
			$query_array['posts_per_page'] = $postPerPage;
		}
		if($nextPage !== ''){
			$query_array['paged'] = $nextPage;
		}
		
		if($keyword !== ''){
			$query_array['s'] = $keyword;
		}
		
		//check location taxonomy 
		if ( $location_id !== '' && $location_id !=='all') {
			$query_array['tax_query'][] = array(
				'taxonomy' => 'listing-item-location',
				'field' => 'term_id',
				'terms' => (int)$location_id
			);
		}

		$meta_query = array(
			'relation' => 'AND'
		);
		
		//check selected type		
		if($type_id !== '' && $type_id !=='all'){
			$meta_query[] = array(
				'key' => 'eltd_listing_item_type',
				'value' => $type_id
			);
		}
		
		//check custom amenities for selected type

		$meta_query_amenities = array();
		if(is_array($search_params) && count($search_params)){
			$meta_query_amenities = array(
				'relation' => 'OR'
			);
			foreach ($search_params as $param_key => $param_value){
				
				if($param_value === 'true'){
					
					$meta_query_amenities[] = array(
						
						'key' => 'listing_feature_list_'.$type_id.'_'.$param_key,
						'value' => '1' //amenities has value 1 or 0

					);
						
				}
				
			}
			
		}
		
		$meta_query[] = $meta_query_amenities;
		$query_array['meta_query'] = $meta_query;


		//order and orderby params
		if($sort !== ''){

			$sort_array = explode('-', $sort);

			$order_by = $sort_array[0];
			$order = strtoupper($sort_array[1]);

			if($order !== ''){
				$query_array['order'] = $order;
			}
			if($order_by !== ''){
				switch ($order_by){
					case 'date':
						$query_array['orderby'] = 'date';
						break;
					case 'name':
						$query_array['orderby'] = 'title';
						break;
					case 'rating':
						$query_array['orderby'] = 'meta_value_num date';
						$query_array['meta_key'] = 'eltd_listing_item_rating';
						break;
				}
			}

		}

		$query_results = new WP_Query($query_array);
		$post_count = $query_results->found_posts;
		$max_num_pages = $query_results->max_num_pages;

		$mapData = array();

		if($query_results->have_posts()){

			while ( $query_results->have_posts() ) {

				$query_results->the_post();
					//render html and generate map data for advanced search with map
					if($map_flag === 'true'){

						ob_start();
						search_and_go_elated_get_module_template_part('templates/lists/single', 'listing' );
						$html .= ob_get_clean();
						//get map data
						$mapData[]  =  search_and_go_elated_get_map_data_by_listing_id(get_the_ID());
					}
					else{
						ob_start();
						search_and_go_elated_get_listing_list_extended_item_template();
						$html .= ob_get_clean();
					}

			}


		}



		else{
			$html .= '<p>'. esc_html__( 'Sorry, no posts matched your criteria.', 'search-and-go' ) .'</p>';
		}

		$return_obj = array(
			'html' => $html,
			'mapData' => $mapData,
			'postCount' => $post_count,
			'href' => $href,
			'maxNumPages' => $max_num_pages
		);

		echo json_encode($return_obj); exit;
		
	}
	
	add_action('wp_ajax_search_and_go_elated_archive_adv_search_query', 'search_and_go_elated_archive_adv_search_query');
	add_action('wp_ajax_nopriv_search_and_go_elated_archive_adv_search_query', 'search_and_go_elated_archive_adv_search_query');
	
}

if(!function_exists('search_and_go_elated_get_map_data_by_listing_id')){

	function search_and_go_elated_get_map_data_by_listing_id($item_id){

		//data for map - start
		$item_id = get_the_ID();
		$image_id = get_post_thumbnail_id( $item_id );
		$image = wp_get_attachment_image_src( $image_id );

		//Get item type
		$item_type_id = get_post_meta($item_id, 'eltd_listing_item_type', true);
		$categories = array();
		$marker_pin_icon = '';
		$marker_pin = '';
		if($item_type_id !== ''){
			$categories = wp_get_post_terms($item_id, 'listing-item-category');
		}
		if(is_array($categories) && count($categories)){
			$marker_pin_icon_pack = get_term_meta( $categories[0]->term_id, 'icon_pack', true );
			$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
			$marker_pin_icon = get_term_meta( $categories[0]->term_id, $param, true );
		}
		if ( $marker_pin_icon == '' && $item_type_id !== '') {
			$marker_pin_icon_pack = get_post_meta( $item_type_id, 'listing_type_icon_pack', true );
			$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
			$marker_pin_icon = get_post_meta( $item_type_id, 'listing_type_icon_' . $param, true );
		}
		if($marker_pin_icon !==''){
			$marker_pin = search_and_go_elated_icon_collections()->renderIcon( $marker_pin_icon, $marker_pin_icon_pack );
		}

		//Get item location, title and type
		$item = array(
			'location' => array(
				'address' => get_post_meta( $item_id, 'eltd_listing_address', true ),
				'latitude' => get_post_meta( $item_id, 'eltd_listing_address_latitude', true ),
				'longitude' => get_post_meta( $item_id, 'eltd_listing_address_longitude', true )
			),
			'title' => get_the_title($item_id),
			'listingType' => $item_type_id,
			'markerPin' => $marker_pin,
			'featuredImage' => $image,
			'itemUrl' => get_the_permalink()
		);

		return $item;

	}

}

if ( ! function_exists( 'search_and_go_elated_set_listing_archive_autocomplete_values' ) ) {

	function search_and_go_elated_set_listing_archive_autocomplete_values( $global_variables ) {

		$args = array(
			'post_type' => 'listing-item',
			'post_status' => 'publish',
			'posts_per_page' => '-1'
		);

		$listing_items = get_posts($args);
		$titles = array();
		foreach ( $listing_items as $listing_item ) {
			$titles[] = $listing_item->post_title;
		}

		$global_variables['postTitles'] = $titles;

		return $global_variables;

	}

	add_filter('search_and_go_elated_js_global_variables', 'search_and_go_elated_set_listing_archive_autocomplete_values' );

}

if ( ! function_exists( 'search_and_go_elated_build_search_query_url' ) ) {

	function search_and_go_elated_build_search_query_url( $type_id, $location_id, $keyword ) {
		$type = $location = $location_name = '';

		if($location_id !== ''){
			$location = get_term( $location_id, 'listing-item-location' );
		}

		if($location !== ''){
			$location_name = !is_wp_error($location) ? $location->name : '';
		}

		$type = $type_id !== '' ? get_the_title( $type_id ) : '';

		$query = http_build_query(array(
			'keywords' => $keyword,
			'location' => $location_name,
			'type' => $type
		));

		return '?' . $query;

	}

}

if ( ! function_exists( 'eltdAjaxStatus' ) ) {

	function eltdAjaxStatus($status, $message, $redirect = '', $data = NULL) {

		$response = array (
			'status' => $status,
			'message' => $message,
			'redirect' => $redirect,
			'data' => $data
		);

		$output = json_encode($response);

		exit($output);

	}

}

if ( ! function_exists( 'search_and_go_elated_get_claim_modal' ) ) {

	function search_and_go_elated_get_claim_modal() {
		global $wpdb;

		$params = array();
		$packages = array();

		$user_id = get_current_user_id();

		//Select all users packages
		$table_name = $wpdb->prefix . 'eltd_listing_package_transactions';
		$user_packages = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id=%d", $user_id));


		if ( $user_packages ) {
			foreach ( $user_packages as $package ) {
				$paid = eltd_listing_get_package_payment_status( $user_id, $package->package_id );
				$not_expired = eltd_listing_get_package_expiry_status( $user_id, $package->package_id );
				if ( $paid && $not_expired ) {
					$packages[] = array(
						'id' => $package->package_id,
						'name' => get_the_title($package->package_id)
					);
				}
			}
		}

		$params['packages'] = $packages;
		$params['user'] = $user_id;
		$params['post'] = get_queried_object_id();

		search_and_go_elated_get_module_template_part( 'templates/parts/claim-modal', 'listing', '', $params );

	}

}

if ( ! function_exists( 'search_and_go_elated_claim_listing' ) ) {

	function search_and_go_elated_claim_listing() {

		if(empty($_POST) || !isset($_POST)) {
			eltdAjaxStatus('error', esc_html__('All fields are empty', 'search-and-go'));
		} else {
			$data = $_POST;

			$data_string = $data['post'];
			parse_str($data_string, $data_array);
			$post_id = $data_array['post'];
			$package_id = $data_array['package'];
			$user_id = $data_array['user'];

			$post = get_post($post_id);
			if ( $post ) { //Check if post exist
				update_post_meta( $post_id, 'eltd_listing_package', $package_id );
				$post_data = array(
					'ID' => $post_id,
					'post_author' => $user_id,
					'post_status' => 'pending'
				);
				$updated_post = wp_update_post( $post_data, true );
				if ( is_wp_error( $updated_post ) ) {
					eltdAjaxStatus('error', esc_html__('Listing cannot be claimed.', 'search-and-go'));
				} else {
					eltdAjaxStatus('success', esc_html__('Listing successfully claimed, waiting for Administrator approval.', 'search-and-go'));
				}
			}

		}
		wp_die();

	}

	add_action( 'wp_ajax_search_and_go_elated_claim_listing', 'search_and_go_elated_claim_listing' );

}
if(!function_exists('search_and_go_elated_get_listing_categories_html')){

	function search_and_go_elated_get_listing_categories_html($listing_id){

		$icon_html = array();
		$categories = wp_get_post_terms($listing_id, 'listing-item-category');
		foreach ( $categories as $cat ) {
			$icon_pack = get_term_meta( $cat->term_id, 'icon_pack', true );
			if ( eltd_listing_theme_installed() ) {
				$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
				$icon = get_term_meta( $cat->term_id, $param, true );
				$category_link = get_category_link($cat->term_id);

				$icon_html[] = '<a class="eltd-listing-item-category-icon" href="' . esc_url( $category_link ) . '">'
				               . search_and_go_elated_icon_collections()->renderIcon( $icon, $icon_pack ) .
				               '</a>';
			}
		}
		$icon_html = implode('',$icon_html);
		return $icon_html;
	}

}