<?php
$post_id = get_the_ID();
if ( is_user_logged_in() ) {
	if ( in_array( $post_id, eltd_listing_get_user_whislist() ) ) {
		$title = esc_html__( 'Remove from Wishlist', 'search-and-go' );
		$class = 'eltd-added-to-wishlist';
	} else {
		$title = esc_html__( 'Add to Wishlist', 'search-and-go' );
		$class = '';
	}
} else {
	$class = '';
	$title = esc_html__( 'Add to Wishlist', 'search-and-go' );
}
?>
<div class="eltd-single-listing-wishlist">
	<a class="eltd-listing-whislist <?php echo esc_attr( $class ) ?>" data-listing-id="<?php the_ID(); ?>"
	   title="<?php echo esc_attr( $title ); ?>">
		<i class="icon-star"></i>
		<span class="eltd-wishlist-title">
		<?php echo $title;?>
		</span>
	</a>
</div>