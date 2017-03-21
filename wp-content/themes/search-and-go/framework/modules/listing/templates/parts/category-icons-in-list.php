<?php
$categories = wp_get_post_terms(get_the_ID(), 'listing-item-category');
$listing_type_id = get_post_meta(get_the_ID(), 'eltd_listing_item_type', true);

//get listing type icon
$type_icon = '';
$type_icon_pack = '';
$type_param = '';
$type_link = '';
if($listing_type_id !== '' && !$listing_type_id){

	$type_icon_pack = get_post_meta($listing_type_id, 'eltd_listing_item_type', true);
	if( $type_icon_pack && $type_icon_pack !== ''){
		$type_param = 'listing_type_icon_'.search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($type_icon_pack);
	}
	if($type_param != ''){
		$type_icon = get_post_meta( $listing_type_id, $type_param, true );
	}
	$type_link = get_permalink($listing_type_id);

}
?>
<div class="eltd-listing-item-category-icons">
	<?php
	$html = '';

	//Show icons from categories
	if(is_array($categories) && count($categories)){
	    foreach ( $categories as $cat ) {
		$category_link = get_category_link($cat->term_id);
		$icon_pack = get_term_meta( $cat->term_id, 'icon_pack', true );
		$param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
		$icon = get_term_meta( $cat->term_id, $param, true );

		if ( $icon !== '') {
			$html .= '<a class="eltd-listing-item-category-icon" href="' . esc_url( $category_link ) . '">';
			$html .= search_and_go_elated_icon_collections()->renderIcon( $icon, $icon_pack );
			$html .= '</a>';
		}

	    }
	}
	if($html === ''){
		if($type_icon !== ''){
			$html .= '<a class="eltd-listing-item-category-icon" href="' . esc_url( $type_link ) . '">'
			         . search_and_go_elated_icon_collections()->renderIcon( $type_icon, $type_icon_pack ) .
			         '</a>';
		}
	}

	print $html;

	?>
</div>