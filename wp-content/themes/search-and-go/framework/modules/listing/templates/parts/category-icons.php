<?php
$categories = wp_get_post_terms(get_the_ID(), 'listing-item-category');
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
	

	//If category icons are empty, show icon from type
	if ( $html == '' ) {
	    
		$listing_type_id = get_post_meta( get_the_ID(), 'eltd_listing_item_type', true);
		if($listing_type_id !== ''){
		    
		    $icon_pack = get_post_meta( $listing_type_id, 'listing_type_icon_pack', true );
		    $param = search_and_go_elated_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
		    $icon = get_post_meta( $listing_type_id, 'listing_type_icon_' . $param, true );

		    if ( $icon !== '' ) {
			    $html .= '<a class="eltd-listing-item-category-icon" href="' . esc_url( get_permalink( $listing_type_id ) ) . '">';
			    $html .= search_and_go_elated_icon_collections()->renderIcon( $icon, $icon_pack );
			    $html .= '</a>';
		    }
		    
		}
		

	}

	print $html;

	?>
</div>