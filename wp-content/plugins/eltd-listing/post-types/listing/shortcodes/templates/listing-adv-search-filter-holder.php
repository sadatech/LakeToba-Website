<?php
if ( eltd_listing_theme_installed() ) {
	$types = search_and_go_elated_get_listing_types();
} else {
	$types = array();
}
?>
<div class="eltd-listing-adv-search-filter-holder">
	<select class="eltd-listing-choose-type">

		<option value=""></option>
		<?php foreach ( $types as $option_key => $option_value ) { ?>

			<option value="<?php echo $option_key ?>">
				<?php echo esc_attr( $option_value ) ?>
			</option>

		<?php } ?>

	</select>

	<div class="eltd-listing-advanced-fields"></div>

	<div class="eltd-listing-advanced-submit">

		<?php
		$params = array(
			'text' => 'Submit',
			'size' => 'medium'
		);
		if ( eltd_listing_theme_installed() ) {
			echo search_and_go_elated_get_button_html( $params );
		}
		?>

	</div>

</div>
	