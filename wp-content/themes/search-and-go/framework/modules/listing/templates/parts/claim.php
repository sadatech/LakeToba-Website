<?php
$listing = get_queried_object();
$id = $listing->post_author;
$user = get_user_by('ID', $id);
if ( ! in_array( 'administrator', $user->roles ) ) {
	return;
}
if ( ! is_user_logged_in() ) {
	$claim_link = add_query_arg( array('redirect_uri' => get_permalink()), eltd_listing_get_dashboard_page_url() );
	$claim_class = '';
} else {
	$claim_link = '';
	$claim_class = 'user-logged-in';
	add_action( 'wp_footer', 'search_and_go_elated_get_claim_modal' );
}
?>
<div class ="eltd-listing-claim">
	<a href="<?php echo esc_url( $claim_link ); ?>" class="<?php echo esc_html($claim_class); ?>">
		<?php
		echo search_and_go_elated_icon_collections()->renderIcon('lnr-file-add', 'linear_icons');
		esc_html_e('Claim Listing', 'search-and-go');
		?>
	</a>
</div>