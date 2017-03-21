<?php
/**
 * Location location add taxonomy meta fields
 */

if ( ! function_exists( 'eltd_listing_location_taxonomy_add_meta_fields' ) ) {
	/**
	 * Add field to add new listing location form
	 */
	function eltd_listing_location_taxonomy_add_meta_fields() { ?>
		<div class="form-field term-featured-image-wrap">
			<label for="term-featured-image"><?php esc_html_e( 'Featured Image', 'eltd_listing' ); ?></label>
			<div class="eltd-media-uploader">
				<div class="eltd-media-image-holder">
					<img src="" alt="" class="eltd-media-image img-thumbnail"/>
				</div>
				<a class="eltd-media-upload-btn btn btn-sm btn-primary"
				   href="javascript:void(0)"
				   data-frame-title="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"
				   data-frame-button-text="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"><?php esc_html_e( 'Upload', 'eltd_listing' ); ?></a>
				<a style="display: none;" href="javascript: void(0)"
				   class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'eltd_listing' ); ?></a>
				<div style="display: none" class="eltd-media-meta-fields">
					<input type="hidden" name="featured_image" class="eltd-media-upload-url"/>
				</div>
			</div>
		</div>

		<tr class="form-field">
			<td>
				<div style="margin:0 10px 20px 0">
					<label style="margin-right:5px"
					       for="featured_taxonomy"><?php esc_html_e( 'Set as Featured', 'eltd_listing' ); ?></label>

					<select name="featured_taxonomy" id="featured_taxonomy" style="min-width: 200px;">
						<option value=0></option>
						<option value='no'>No</option>
						<option value='yes'>Yes</option>
					</select>

				</div>

				<div style="margin:0 10px 20px 0">
					<label style="margin-right:5px"
					       for="featured_order_number"><?php esc_html_e( 'Set Feature Order', 'eltd_listing' ); ?></label>
					<input style="width:100px" type="text" name="featured_order_number" id="featured_order_number"
					       size="3" value="">
				</div>

				<div style="margin:0 10px 20px 0">
					<label style="margin-right:5px"
					       for="featured_taxonomy_layout"><?php esc_html_e( 'Choose Featured Location Layout', 'eltd_listing' ); ?></label>

					<select name="featured_taxonomy_layout" id="featured_taxonomy_layout" style="min-width: 200px;">
						<option value=0></option>
						<option value='square'><?php esc_html_e( 'Square', 'eltd_listing' ); ?></option>
						<option value='portrait'><?php esc_html_e( 'Portrait', 'eltd_listing' ); ?></option>
					</select>

				</div>
			</td>
		</tr>

	<?php }

	add_action( 'listing-item-location_add_form_fields', 'eltd_listing_location_taxonomy_add_meta_fields', 10, 2 );

}

if ( ! function_exists( 'eltd_listing_location_taxonomy_save_meta_fields' ) ) {
	/**
	 * Save listing location taxonomy meta field
	 *
	 * @param $term_id
	 * @param $taxonomy_id
	 */
	function eltd_listing_location_taxonomy_save_meta_fields( $term_id, $taxonomy_id ) {
		if ( isset( $_POST ) ) {

			if ( isset($_POST['featured_image']) && $_POST['featured_image'] !== '' ) {

				$image = esc_url( $_POST['featured_image'] );
				add_term_meta( $term_id, 'featured_image', $image, true );

			}

			if (isset($_POST['featured_taxonomy']) && $_POST['featured_taxonomy'] !== '' ) {

				$featured_tax = esc_attr( $_POST['featured_taxonomy'] );
				add_term_meta( $term_id, 'featured_taxonomy', $featured_tax, true );

			}
			if (isset($_POST['featured_order_number']) && $_POST['featured_order_number'] !== '' ) {

				$featured_order_number = esc_attr( $_POST['featured_order_number'] );
				add_term_meta( $term_id, 'featured_order_number', $featured_order_number, true );

			}
			if ( isset($_POST['featured_taxonomy_layout']) && $_POST['featured_taxonomy_layout'] !== '' ) {

				$featured_tax_layout = esc_attr( $_POST['featured_taxonomy_layout'] );
				add_term_meta( $term_id, 'featured_taxonomy_layout', $featured_tax_layout, true );

			}
		}


	}

	add_action( 'created_listing-item-location', 'eltd_listing_location_taxonomy_save_meta_fields', 10, 2 );

}

if ( ! function_exists( 'eltd_listing_location_taxonomy_edit_meta_fields' ) ) {
	/**
	 * Edit Listing location taxonomy featured image
	 *
	 * @param $term
	 * @param $taxonomy
	 */
	function eltd_listing_location_taxonomy_edit_meta_fields( $term, $taxonomy ) {
		$featured_image = get_term_meta( $term->term_id, 'featured_image', true );
		?>
		<tr class="form-field term-featured-image-wrap">
			<th scope="row"><label
					for="term-featured-image"><?php esc_html_e( 'Featured Image', 'eltd_listing' ); ?></label></th>
			<td>
				<div class="eltd-media-uploader">
					<div class="eltd-media-image-holder">
						<img src="<?php
						if ( isset( $featured_image ) ) {
							echo $featured_image;
						}
						?>" alt="" class="eltd-media-image img-thumbnail" style="width: 150px"/>
					</div>
					<a class="eltd-media-upload-btn btn btn-sm btn-primary"
					   href="javascript:void(0)"
					   data-frame-title="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"
					   data-frame-button-text="<?php esc_html_e( 'Select Image', 'eltd_listing' ); ?>"><?php esc_html_e( 'Upload', 'eltd_listing' ); ?></a>
					<a style="display: none;" href="javascript: void(0)"
					   class="eltd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'eltd_listing' ); ?></a>
					<div style="display: none" class="eltd-media-meta-fields">
						<input type="hidden" name="featured_image" value="
				<?php
						if ( isset( $featured_image ) ) {
							echo $featured_image;
						}
						?>" class="eltd-media-upload-url"/>
					</div>
				</div>
			</td>
		</tr>
		<?php
		$featured_taxonomy        = get_term_meta( $term->term_id, 'featured_taxonomy', true );
		$featured_order_number    = get_term_meta( $term->term_id, 'featured_order_number', true );
		$featured_taxonomy_layout = get_term_meta( $term->term_id, 'featured_taxonomy_layout', true );
		?>

		<tr class="form-field">
			<td>
				<div style="margin:0 10px 20px 0">
					<label style="margin-right:5px"
					       for="featured_taxonomy"><?php esc_html_e( 'Set as Featured', 'eltd_listing' ); ?></label>

					<select name="featured_taxonomy" id="featured_taxonomy" style="min-width: 200px;">
						<option value=0></option>
						<option <?php if ( isset( $featured_taxonomy ) && $featured_taxonomy == "no" ) {
							echo "selected='selected'";
						} ?> value='no'>No
						</option>
						<option <?php if ( isset( $featured_taxonomy ) && $featured_taxonomy == "yes" ) {
							echo "selected='selected'";
						} ?> value='yes'>Yes
						</option>
					</select>

				</div>

				<div style="margin:0 10px 20px 0">
					<label style="margin-right:5px"
					       for="featured_order_number"><?php esc_html_e( 'Set Feature Order', 'eltd_listing' ); ?></label>
					<input style="width:100px" type="text" name="featured_order_number" id="featured_order_number"
					       size="3"
					       value="<?php if ( isset( $featured_order_number ) && $featured_order_number !== '' ) {
						       echo esc_attr( $featured_order_number );
					       } ?>">
				</div>


				<div style="margin:0 10px 20px 0">
					<label style="margin-right:5px"
					       for="featured_taxonomy_layout"><?php esc_html_e( 'Choose Featured Location Layout', 'eltd_listing' ); ?></label>

					<select name="featured_taxonomy_layout" id="featured_taxonomy_layout" style="min-width: 200px;">
						<option value=0></option>
						<option
							<?php if ( isset( $featured_taxonomy_layout ) && $featured_taxonomy_layout == "square" ) {
								echo "selected='selected'";
							} ?>value='square'><?php esc_html_e( 'Square', 'eltd_listing' ); ?></option>
						<option
							<?php if ( isset( $featured_taxonomy_layout ) && $featured_taxonomy_layout == "portrait" ) {
								echo "selected='selected'";
							} ?>value='portrait'><?php esc_html_e( 'Portrait', 'eltd_listing' ); ?></option>
					</select>

				</div>

			</td>
		</tr>

	<?php }

	add_action( 'listing-item-location_edit_form_fields', 'eltd_listing_location_taxonomy_edit_meta_fields', 11, 2 );

}

if ( ! function_exists( 'eltd_listing_location_taxonomy_update_meta_fields' ) ) {
	/**
	 * Update listing location taxonomy meta field
	 *
	 * @param $term_id
	 * @param $taxonomy_id
	 */
	function eltd_listing_location_taxonomy_update_meta_fields( $term_id, $taxonomy_id ) {

		if ( isset( $_POST ) ) {
			if ( isset($_POST['featured_image']) && $_POST['featured_image'] !== '' ) {

				$image = esc_url( $_POST['featured_image'] );
				update_term_meta( $term_id, 'featured_image', $image );
			}

			if ( isset($_POST['featured_taxonomy']) && $_POST['featured_taxonomy'] !== '' ) {

				$featured_tax = esc_attr( $_POST['featured_taxonomy'] );
				update_term_meta( $term_id, 'featured_taxonomy', $featured_tax );

			}
			if ( isset($_POST['featured_order_number']) && $_POST['featured_order_number'] !== '' ) {

				$featured_order_number = esc_attr( $_POST['featured_order_number'] );
				update_term_meta( $term_id, 'featured_order_number', $featured_order_number );

			}
			if ( isset($_POST['featured_taxonomy_layout']) && $_POST['featured_taxonomy_layout'] !== '' ) {

				$featured_tax_layout = esc_attr( $_POST['featured_taxonomy_layout'] );
				update_term_meta( $term_id, 'featured_taxonomy_layout', $featured_tax_layout );

			}

		}

	}

	add_action( 'edited_listing-item-location', 'eltd_listing_location_taxonomy_update_meta_fields', 10, 2 );

}


/**
 * Location category add taxonomy meta fields
 */

if ( ! function_exists( 'eltd_listing_taxonomy_listing_category_add_meta_fields' ) ) {
	/**
	 * Add field to add new listing location form
	 */
	function eltd_listing_taxonomy_listing_category_add_meta_fields() { ?>
		<div class="form-field term-icons-wrap">
			<label for="term-icons"><?php esc_html_e( 'Icon', 'eltd_listing' ); ?></label>
			<?php if ( function_exists( 'search_and_go_elated_icon_collections' ) ) {
				$icon_collections = search_and_go_elated_icon_collections()->getIconCollections();
				$collections      = array();
				foreach ( $icon_collections as $ic_key => $ic_name ) {
					$collections[] = search_and_go_elated_icon_collections()->getIconCollection( $ic_key );
				}
			} else {
				$icon_collections = array();
				$collections      = array();
			} ?>
			<div>
				<label for="icon_pack">Icon Pack</label>
				<select name="icon_pack" id="icon_pack">
					<?php
					foreach ( $icon_collections as $key => $value ) { ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				</select>
			</div>
			<?php foreach ( $collections as $col ) { ?>
				<div class="icon-collection <?php echo str_replace( ' ', '_', strtolower( $col->title ) ); ?>"
				     style="display: none">
					<label for="<?php echo $col->param; ?>"><?php echo $col->title; ?></label>
					<select name="<?php echo $col->param; ?>" id="<?php echo $col->param; ?>">
						<?php
						$icons = search_and_go_elated_icon_collections()->getIconCollectionIcons( $col );
						foreach ( $icons as $key => $value ) { ?>
							<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>
			<?php } ?>
		</div>
		<div style="margin:0 10px 20px 0">
			<label style="margin-bottom: 10px;display: block"
			       for="listing_type"><?php esc_html_e( 'Choose Listing Type ( only for top parent categories )', 'eltd_listing' ); ?></label>

			<?php
			if ( eltd_listing_theme_installed() ) {
				$types = search_and_go_elated_get_listing_types();
			} else {
				$types = array();
			}
			?>
			<select name="listing_type" id="listing_type" style="min-width: 200px;">
				<option value=0></option>
				<?php foreach ( $types as $type_key => $type_value ) { ?>
					<option value="<?php echo esc_attr( $type_key ) ?>">
						<?php echo esc_attr( $type_value ) ?>
					</option>
				<?php } ?>
			</select>

		</div>
	<?php }

	add_action( 'listing-item-category_add_form_fields', 'eltd_listing_taxonomy_listing_category_add_meta_fields', 10, 2 );

}

if ( ! function_exists( 'eltd_listing_taxonomy_listing_category_save_meta_fields' ) ) {
	/**
	 * Save listing location taxonomy meta field
	 *
	 * @param $term_id
	 * @param $taxonomy_id
	 */
	function eltd_listing_taxonomy_listing_category_save_meta_fields( $term_id, $taxonomy_id ) {
		if ( isset( $_POST ) ) {

			$icon_pack         = esc_html( $_POST['icon_pack'] );
			$fa_icon           = esc_html( $_POST['fa_icon'] );
			$fe_icon           = esc_html( $_POST['fe_icon'] );
			$ion_icon          = esc_html( $_POST['ion_icon'] );
			$linea_icon        = esc_html( $_POST['linea_icon'] );
			$simple_line_icons = esc_html( $_POST['simple_line_icons'] );
			$dripicon          = esc_html( $_POST['dripicon'] );
			$linear_icons      = esc_html( $_POST['linear_icons'] );

			add_term_meta( $term_id, 'icon_pack', $icon_pack, true );
			add_term_meta( $term_id, 'fa_icon', $fa_icon, true );
			add_term_meta( $term_id, 'fe_icon', $fe_icon, true );
			add_term_meta( $term_id, 'ion_icon', $ion_icon, true );
			add_term_meta( $term_id, 'linea_icon', $linea_icon, true );
			add_term_meta( $term_id, 'simple_line_icons', $simple_line_icons, true );
			add_term_meta( $term_id, 'dripicon', $dripicon, true );
			add_term_meta( $term_id, 'linear_icons', $linear_icons, true );

			//check if current term has ancestors
			$ancestors = get_ancestors( $term_id, 'listing-item-category' );

			//if current tax has ancestors, get top parent and set for child category listing type id from top parent
			if ( is_array( $ancestors ) && count( $ancestors ) ) {

				//get top parent id(always last element in ancestors array)
				$top_parent_id              = end( $ancestors );
				$top_parent_listing_type_id = get_term_meta( $top_parent_id, 'listing_type', true );

				if ( $top_parent_listing_type_id !== '' && !$top_parent_listing_type_id) {
					add_term_meta( $term_id, 'listing_type', esc_attr( $top_parent_listing_type_id ), true );
				}

			} else {
				if ( isset ( $_POST['listing_type'] ) ) {
					add_term_meta( $term_id, 'listing_type', esc_attr( $_POST['listing_type'] ), true );
				}
			}
		}
	}

	add_action( 'created_listing-item-category', 'eltd_listing_taxonomy_listing_category_save_meta_fields', 10, 2 );

}

if ( ! function_exists( 'eltd_listing_taxonomy_listing_category_edit_meta_fields' ) ) {
	/**
	 * Edit Listing location taxonomy featured image
	 *
	 * @param $term
	 * @param $taxonomy
	 */
	function eltd_listing_taxonomy_listing_category_edit_meta_fields( $term, $taxonomy ) {

		$icon_pack     = get_term_meta( $term->term_id, 'icon_pack', true );
		$selected_type = get_term_meta( $term->term_id, 'listing_type', true );

		?>
		<tr class="form-field term-icons-wrap">
			<th scope="row"><label for="term-icons"><?php esc_html_e( 'Icon', 'eltd_listing' ); ?></label></th>
			<td>
				<?php if ( function_exists( 'search_and_go_elated_icon_collections' ) ) {
					$icon_collections = search_and_go_elated_icon_collections()->getIconCollections();
					$collections      = array();
					foreach ( $icon_collections as $ic_key => $ic_name ) {
						$collections[] = search_and_go_elated_icon_collections()->getIconCollection( $ic_key );
					}
				} else {
					$icon_collections = array();
					$collections = array();
				} ?>
				<div>
					<label for="icon_pack">Icon Pack</label>
					<select name="icon_pack" id="icon_pack">
						<?php
						foreach ( $icon_collections as $key => $value ) { ?>
							<option value="<?php echo $key; ?>" <?php if ( $key == $icon_pack ) {
								echo 'selected';
							} ?>><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>
				<?php foreach ( $collections as $col ) { ?>
					<div class="icon-collection <?php echo str_replace( ' ', '_', strtolower( $col->title ) ); ?>"
					     style="display: none">
						<label for="<?php echo $col->param; ?>"><?php echo $col->title; ?></label>
						<select name="<?php echo $col->param; ?>" id="<?php echo $col->param; ?>">
							<?php
							$selected_icon = get_term_meta( $term->term_id, $col->param, true );
							$icons         = search_and_go_elated_icon_collections()->getIconCollectionIcons( $col );
							foreach ( $icons as $key => $value ) { ?>
								<option value="<?php echo $key; ?>" <?php if ( $key == $selected_icon ) {
									echo 'selected';
								} ?>><?php echo $value; ?></option>
							<?php } ?>
						</select>
					</div>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td>
				<div style="margin:0 10px 20px 0">
					<label style="margin-bottom: 10px;display: block"
					       for="listing_type"><?php esc_html_e( 'Choose Listing Type ( only for top parent categories )', 'eltd_listing' ); ?></label>

					<?php
					if ( eltd_listing_theme_installed() ) {
						$types = search_and_go_elated_get_listing_types();
					} else {
						$types = array();
					}
					?>

					<select name="listing_type" id="listing_type" style="min-width: 200px;">
						<option value=0></option>
						<?php foreach ( $types as $type_key => $type_value ) {
							?>
							<option
								value="<?php echo esc_attr( $type_key ) ?>" <?php if ( $type_key == $selected_type ) {
								echo 'selected';
							} ?>>
								<?php echo esc_attr( $type_value ) ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</td>
		</tr>

	<?php }

	add_action( 'listing-item-category_edit_form_fields', 'eltd_listing_taxonomy_listing_category_edit_meta_fields', 11, 2 );

}

if ( ! function_exists( 'eltd_listing_taxonomy_listing_category_update_meta_fields' ) ) {
	/**
	 * Update listing location taxonomy meta field
	 *
	 * @param $term_id
	 * @param $taxonomy_id
	 */
	function eltd_listing_taxonomy_listing_category_update_meta_fields( $term_id, $taxonomy_id ) {

		if ( isset( $_POST ) ) {

			$icon_pack         = esc_html( $_POST['icon_pack'] );
			$fa_icon           = esc_html( $_POST['fa_icon'] );
			$fe_icon           = esc_html( $_POST['fe_icon'] );
			$ion_icon          = esc_html( $_POST['ion_icon'] );
			$linea_icon        = esc_html( $_POST['linea_icon'] );
			$simple_line_icons = esc_html( $_POST['simple_line_icons'] );
			$dripicon          = esc_html( $_POST['dripicon'] );
			$linear_icons      = esc_html( $_POST['linear_icons'] );

			update_term_meta( $term_id, 'icon_pack', $icon_pack );
			update_term_meta( $term_id, 'fa_icon', $fa_icon );
			update_term_meta( $term_id, 'fe_icon', $fe_icon );
			update_term_meta( $term_id, 'ion_icon', $ion_icon );
			update_term_meta( $term_id, 'linea_icon', $linea_icon );
			update_term_meta( $term_id, 'simple_line_icons', $simple_line_icons );
			update_term_meta( $term_id, 'dripicon', $dripicon );
			update_term_meta( $term_id, 'linear_icons', $linear_icons );

			//check if current term has ancestors
			$ancestors = get_ancestors( $term_id, 'listing-item-category' );

			//if current tax has ancestors, get top parent and set for child category listing type id from top parent
			if ( is_array( $ancestors ) && count( $ancestors ) ) {

				//get top parent id(always last element in ancestors array)
				$top_parent_id              = end( $ancestors );
				$top_parent_listing_type_id = get_term_meta( $top_parent_id, 'listing_type', true );

				if ( $top_parent_listing_type_id !== '' &&  !$top_parent_listing_type_id) {
					update_term_meta( $term_id, 'listing_type', esc_attr( $top_parent_listing_type_id ) );
				}

			} else {
				if ( isset ( $_POST['listing_type'] ) ) {
					update_term_meta( $term_id, 'listing_type', esc_attr( $_POST['listing_type'] ) );
				}
			}

		}

	}

	add_action( 'edited_listing-item-category', 'eltd_listing_taxonomy_listing_category_update_meta_fields', 10, 2 );

}