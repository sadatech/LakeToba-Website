<?php

if ( ! function_exists('search_and_go_elated_header_options_map') ) {

	function search_and_go_elated_header_options_map() {

		search_and_go_elated_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => 'Header',
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = search_and_go_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => 'Header'
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'sticky-header-on-scroll-up',
				'label' => 'Choose Header behaviour',
				'description' => 'Select the behaviour of header when you scroll down to page',
				'options' => array(
					'sticky-header-on-scroll-up' => 'Sticky on scrol up',
					'sticky-header-on-scroll-down-up' => 'Sticky on scrol up/down',
					'fixed-on-scroll' => 'Fixed on scroll'
				),
				'args' => array(
					'dependence' => true,
					'show' => array(
						'sticky-header-on-scroll-up' => '#eltd_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#eltd_panel_sticky_header',
						'fixed-on-scroll' => '#eltd_panel_fixed_header'
					),
					'hide' => array(
						'sticky-header-on-scroll-up' => '#eltd_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#eltd_panel_fixed_header',
						'fixed-on-scroll' => '#eltd_panel_sticky_header',
					)
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'name' => 'top_bar',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => 'Top Bar',
				'description' => 'Enabling this option will show top bar area',
				'parent' => $panel_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_container"
				)
			)
		);

		$top_bar_container = search_and_go_elated_add_admin_container(array(
			'name' => 'top_bar_container',
			'parent' => $panel_header,
			'hidden_property' => 'top_bar',
			'hidden_value' => 'no'
		));

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $top_bar_container,
				'type' => 'select',
				'name' => 'top_bar_layout',
				'default_value' => 'two-columns',
				'label' => 'Choose top bar layout',
				'description' => 'Select the layout for top bar',
				'options' => array(
					'two-columns' => 'Two columns',
					'three-columns' => 'Three columns'
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"two-columns" => "#eltd_top_bar_layout_container",
						"three-columns" => ""
					),
					"show" => array(
						"two-columns" => "",
						"three-columns" => "#eltd_top_bar_layout_container"
					)
				)
			)
		);

		$top_bar_layout_container = search_and_go_elated_add_admin_container(array(
			'name' => 'top_bar_layout_container',
			'parent' => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value' => '',
			'hidden_values' => array("two-columns"),
		));

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $top_bar_layout_container,
				'type' => 'select',
				'name' => 'top_bar_column_widths',
				'default_value' => '30-30-30',
				'label' => 'Choose column widths',
				'description' => '',
				'options' => array(
					'30-30-30' => '33% - 33% - 33%',
					'25-50-25' => '25% - 50% - 25%'
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'name' => 'top_bar_in_grid',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Top Bar in grid',
				'description' => 'Set top bar content to be in grid',
				'parent' => $top_bar_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_in_grid_container"
				)
			)
		);

		$top_bar_in_grid_container = search_and_go_elated_add_admin_container(array(
			'name' => 'top_bar_in_grid_container',
			'parent' => $top_bar_container,
			'hidden_property' => 'top_bar_in_grid',
			'hidden_value' => 'no'
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'top_bar_grid_background_color',
			'type' => 'color',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for top bar',
			'parent' => $top_bar_in_grid_container
		));


		search_and_go_elated_add_admin_field(array(
			'name' => 'top_bar_grid_background_transparency',
			'type' => 'text',
			'label' => 'Grid Background Transparency',
			'description' => 'Set grid background transparency for top bar',
			'parent' => $top_bar_in_grid_container,
			'args' => array('col_width' => 3)
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'top_bar_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for top bar',
			'parent' => $top_bar_container
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'top_bar_background_transparency',
			'type' => 'text',
			'label' => 'Background Transparency',
			'description' => 'Set background transparency for top bar',
			'parent' => $top_bar_container,
			'args' => array('col_width' => 3)
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'top_bar_height',
			'type' => 'text',
			'label' => 'Top bar height',
			'description' => 'Enter top bar height (Default is 40px)',
			'parent' => $top_bar_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_style',
				'default_value' => '',
				'label' => 'Header Skin',
				'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
				'options' => array(
					'' => '',
					'light-header' => 'Light',
					'dark-header' => 'Dark'
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'yesno',
				'name' => 'enable_header_style_on_scroll',
				'default_value' => 'no',
				'label' => 'Enable Header Style on Scroll',
				'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
			)
		);

		$panel_header_standard = search_and_go_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header_standard',
				'title' => 'Header Standard',
			)
		);

		search_and_go_elated_add_admin_section_title(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_title',
				'title' => 'Menu Area'
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid_header_standard',
				'default_value' => 'no',
				'label' => 'Header in grid',
				'description' => 'Set header content to be in grid',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_menu_area_in_grid_header_standard_container'
				)
			)
		);

		$menu_area_in_grid_header_standard_container = search_and_go_elated_add_admin_container(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_in_grid_header_standard_container',
				'hidden_property' => 'menu_area_in_grid_header_standard',
				'hidden_value' => 'no'
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'color',
				'name' => 'menu_area_grid_background_color_header_standard',
				'default_value' => '',
				'label' => 'Grid Background color',
				'description' => 'Set grid background color for header area',
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'text',
				'name' => 'menu_area_grid_background_transparency_header_standard',
				'default_value' => '',
				'label' => 'Grid background transparency',
				'description' => 'Set grid background transparency for header',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'color',
				'name' => 'menu_area_background_color_header_standard',
				'default_value' => '',
				'label' => 'Background color',
				'description' => 'Set background color for header'
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_header_standard',
				'default_value' => '',
				'label' => 'Background transparency',
				'description' => 'Set background transparency for header',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_height_header_standard',
				'default_value' => '',
				'label' => 'Height',
				'description' => 'Enter header height (default is 60px)',
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		$panel_sticky_header = search_and_go_elated_add_admin_panel(
			array(
				'title' => 'Sticky Header',
				'name' => 'panel_sticky_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array(
					'fixed-on-scroll'
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'name' => 'scroll_amount_for_sticky',
				'type' => 'text',
				'label' => 'Scroll Amount for Sticky',
				'description' => 'Enter scroll amount for Sticky Menu to appear (deafult is header height)',
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'name' => 'sticky_header_in_grid',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Sticky Header in grid',
				'description' => 'Set sticky header content to be in grid',
				'parent' => $panel_sticky_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_sticky_header_in_grid_container"
				)
			)
		);

		$sticky_header_in_grid_container = search_and_go_elated_add_admin_container(array(
			'name' => 'sticky_header_in_grid_container',
			'parent' => $panel_sticky_header,
			'hidden_property' => 'sticky_header_in_grid',
			'hidden_value' => 'no'
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'sticky_header_grid_background_color',
			'type' => 'color',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for sticky header',
			'parent' => $sticky_header_in_grid_container
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'sticky_header_grid_transparency',
			'type' => 'text',
			'label' => 'Sticky Header Grid Transparency',
			'description' => 'Enter transparency for sticky header grid (value from 0 to 1)',
			'parent' => $sticky_header_in_grid_container,
			'args' => array(
				'col_width' => 1
			)
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'sticky_header_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for sticky header',
			'parent' => $panel_sticky_header
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'sticky_header_transparency',
			'type' => 'text',
			'label' => 'Sticky Header Transparency',
			'description' => 'Enter transparency for sticky header (value from 0 to 1)',
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 1
			)
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'sticky_header_height',
			'type' => 'text',
			'label' => 'Sticky Header Height',
			'description' => 'Enter height for sticky header (default is 60px)',
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		$group_sticky_header_menu = search_and_go_elated_add_admin_group(array(
			'title' => 'Sticky Header Menu',
			'name' => 'group_sticky_header_menu',
			'parent' => $panel_sticky_header,
			'description' => 'Define styles for sticky menu items',
		));

		$row1_sticky_header_menu = search_and_go_elated_add_admin_row(array(
			'name' => 'row1',
			'parent' => $group_sticky_header_menu
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'sticky_color',
			'type' => 'colorsimple',
			'label' => 'Text Color',
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'sticky_hovercolor',
			'type' => 'colorsimple',
			'label' => 'Hover/Active color',
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		$row2_sticky_header_menu = search_and_go_elated_add_admin_row(array(
			'name' => 'row2',
			'parent' => $group_sticky_header_menu
		));

		search_and_go_elated_add_admin_field(
			array(
				'name' => 'sticky_google_fonts',
				'type' => 'fontsimple',
				'label' => 'Font Family',
				'default_value' => '-1',
				'parent' => $row2_sticky_header_menu,
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_fontsize',
				'label' => 'Font Size',
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_lineheight',
				'label' => 'Line height',
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_texttransform',
				'label' => 'Text transform',
				'default_value' => '',
				'options' => search_and_go_elated_get_text_transform_array(),
				'parent' => $row2_sticky_header_menu
			)
		);

		$row3_sticky_header_menu = search_and_go_elated_add_admin_row(array(
			'name' => 'row3',
			'parent' => $group_sticky_header_menu
		));

		search_and_go_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_fontstyle',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => search_and_go_elated_get_font_style_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_fontweight',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => search_and_go_elated_get_font_weight_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_letterspacing',
				'label' => 'Letter Spacing',
				'default_value' => '',
				'parent' => $row3_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$panel_fixed_header = search_and_go_elated_add_admin_panel(
			array(
				'title' => 'Fixed Header',
				'name' => 'panel_fixed_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array('sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up')
			)
		);

		search_and_go_elated_add_admin_field(array(
			'name' => 'fixed_header_grid_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for fixed header',
			'parent' => $panel_fixed_header
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'fixed_header_grid_transparency',
			'type' => 'text',
			'default_value' => '',
			'label' => 'Header Transparency Grid',
			'description' => 'Enter transparency for fixed header grid (value from 0 to 1)',
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'fixed_header_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => 'Background Color',
			'description' => 'Set background color for fixed header',
			'parent' => $panel_fixed_header
		));

		search_and_go_elated_add_admin_field(array(
			'name' => 'fixed_header_transparency',
			'type' => 'text',
			'label' => 'Header Transparency',
			'description' => 'Enter transparency for fixed header (value from 0 to 1)',
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));


		$panel_main_menu = search_and_go_elated_add_admin_panel(
			array(
				'title' => 'Main Menu',
				'name' => 'panel_main_menu',
				'page' => '_header_page',
			)
		);

		search_and_go_elated_add_admin_section_title(
			array(
				'parent' => $panel_main_menu,
				'name' => 'main_menu_area_title',
				'title' => 'Main Menu General Settings'
			)
		);

		search_and_go_elated_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'select',
				'name' => 'menu_dropdown_appearance',
				'default_value' => 'default',
				'label' => 'Main Dropdown Menu Appearance',
				'description' => 'Choose appearance for dropdown menu',
				'options' => array(
					'dropdown-default' => 'Default',
					'dropdown-slide-from-bottom' => 'Slide From Bottom',
					'dropdown-slide-from-top' => 'Slide From Top',
					'dropdown-animate-height' => 'Animate Height',
					'dropdown-slide-from-left' => 'Slide From Left'
				)
			)
		);

	}

	add_action( 'search_and_go_elated_options_map', 'search_and_go_elated_header_options_map', 7);

}