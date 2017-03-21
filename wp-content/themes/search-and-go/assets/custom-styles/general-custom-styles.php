<?php
if ( ! function_exists( 'search_and_go_elated_design_styles' ) ) {
	/**
	 * Generates general custom styles
	 */
	function search_and_go_elated_design_styles() {

		$preload_background_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
			$preload_background_styles['background-image'] = 'url(' . search_and_go_elated_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
		} else {
			$preload_background_styles['background-image'] = 'url(' . esc_url( ELATED_ASSETS_ROOT . "/img/preload_pattern.png" ) . ') !important';
		}

		echo search_and_go_elated_dynamic_css( '.eltd-preload-background', $preload_background_styles );

		if ( search_and_go_elated_options()->getOptionValue( 'google_fonts' ) ) {
			$font_family = search_and_go_elated_options()->getOptionValue( 'google_fonts' );
			if ( search_and_go_elated_is_font_option_valid( $font_family ) ) {
				echo search_and_go_elated_dynamic_css( 'body', array( 'font-family' => search_and_go_elated_get_font_option_val( $font_family ) ) );
			}
		}

		if ( search_and_go_elated_options()->getOptionValue( 'first_color' ) !== "" ) {
			$color_selector = array(
				'.eltd-login-content .eltd-wp-login-holder .eltd-login-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-login-holder .eltd-register-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-login-holder .eltd-reset-pass-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-register-holder .eltd-login-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-register-holder .eltd-register-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-register-holder .eltd-reset-pass-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-reset-pass-holder .eltd-login-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-reset-pass-holder .eltd-register-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.eltd-login-content .eltd-wp-reset-pass-holder .eltd-reset-pass-form .eltd-lost-pass-remember-holder .active.eltd-login-remember-me-checkbox:after',
				'.wpcf7-form-control.wpcf7-text',
				'.wpcf7-form-control.wpcf7-number',
				'.wpcf7-form-control.wpcf7-date',
				'.wpcf7-form-control.wpcf7-textarea',
				'.wpcf7-form-control.wpcf7-select',
				'.wpcf7-form-control.wpcf7-quiz',
				'#respond textarea',
				'#respond input[type="text"]',
				'.post-password-form input[type="password"]',
				'.eltd-input-field',
				'.eltd-textarea-field',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'a',
				'p a',
				'.eltd-comment .eltd-comment-info > span:hover > span',
				'.eltd-comment .eltd-comment-info > span:hover > a',
				'.post-password-form input[type="submit"]:hover',
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'.eltd-pagination li.active span',
				'.eltd-main-menu ul li:hover a',
				'.eltd-main-menu ul li.eltd-active-item a',
				'body:not(.eltd-menu-item-first-level-bg-color) .eltd-main-menu > ul > li:hover > a',
				'.eltd-main-menu > ul > li.eltd-active-item > a',
				'.eltd-light-header .eltd-page-header > div:not(.eltd-sticky-header) .eltd-main-menu > ul > li > a:hover',
				'.eltd-light-header.eltd-header-style-on-scroll .eltd-page-header .eltd-main-menu > ul > li > a:hover',
				'.eltd-light-header .eltd-page-header > div:not(.eltd-sticky-header) .eltd-main-menu > ul > li.eltd-active-item > a',
				'.eltd-light-header.eltd-header-style-on-scroll .eltd-page-header .eltd-main-menu > ul > li.eltd-active-item > a',
				'.eltd-dark-header .eltd-page-header > div:not(.eltd-sticky-header) .eltd-main-menu > ul > li > a:hover',
				'.eltd-dark-header.eltd-header-style-on-scroll .eltd-page-header .eltd-main-menu > ul > li > a:hover',
				'.eltd-dark-header .eltd-page-header > div:not(.eltd-sticky-header) .eltd-main-menu > ul > li.eltd-active-item > a',
				'.eltd-dark-header.eltd-header-style-on-scroll .eltd-page-header .eltd-main-menu > ul > li.eltd-active-item > a',
				'.eltd-drop-down .second .inner > ul > li:hover > a',
				'.eltd-drop-down .second .inner ul li.sub ul li:hover > a',
				'.eltd-drop-down .wide .second .inner > ul > li > a:hover',
				'.eltd-mobile-header .eltd-mobile-nav a:hover',
				'.eltd-mobile-header .eltd-mobile-nav h4:hover',
				'.eltd-mobile-header .eltd-mobile-menu-opener a:hover',
				'.eltd-call-to-action .eltd-text-wrapper .eltd-call-to-action-icon .eltd-call-to-action-icon-inner',
				'.eltd-counter-holder .eltd-counter',
				'.countdown-amount',
				'.eltd-message .eltd-message-inner a.eltd-close i:hover',
				'.eltd-ordered-list ol > li:before',
				'.eltd-unordered-list.eltd-line ul > li:before',
				'.eltd-icon-list-item .eltd-icon-list-icon-holder',
				'.eltd-progress-bar .eltd-progress-number-wrapper.eltd-static .eltd-progress-number',
				'.eltd-price-table .eltd-price-table-inner .eltd-table-prices .eltd-price',
				'.eltd-price-table .eltd-price-table-inner .eltd-table-prices .eltd-value',
				'.eltd-price-table .eltd-price-table-inner .eltd-table-prices .eltd-mark',
				'.eltd-price-table .eltd-price-table-inner .eltd-table-content ul li:before',
				'.eltd-price-table .eltd-price-table-inner .eltd-table-content ul li:nth-child(even)',
				'.eltd-btn.eltd-btn-outline',
				'blockquote .eltd-icon-quotations-holder',
				'.eltd-video-button-play .eltd-video-button-wrapper:hover',
				'.eltd-dropcaps',
				'.eltd-numbered-steps-holder .eltd-numbered-steps-top-holder .eltd-numbered-steps-number-holder',
				'.widget_search input[type="text"]',
				'.widget_search input[type="submit"]',
				'.widget_archive select',
				'.widget_categories select',
				'.widget_calendar table caption',
				'.eltd-top-bar .eltd-top-bar-widget ul li a:hover',
				'.eltd-login-register-widget .eltd-login-dropdown li a:hover',
				'.eltd-light-header .eltd-mobile-header .eltd-login-register-widget a.eltd-btn',
				'.eltd-sticky-header .eltd-login-register-widget .eltd-logged-in-user > span:hover',
				'.eltd-login-content .eltd-wp-login-holder .eltd-login-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-login-holder .eltd-register-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-login-holder .eltd-reset-pass-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-register-holder .eltd-login-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-register-holder .eltd-register-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-register-holder .eltd-reset-pass-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-reset-pass-holder .eltd-login-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-reset-pass-holder .eltd-register-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-wp-reset-pass-holder .eltd-reset-pass-form .eltd-lost-pass-remember-holder',
				'.eltd-login-content .eltd-login-form-social-login button:hover',
				'.eltd-blog-holder article.sticky .eltd-post-title a',
				'.eltd-blog-holder article .eltd-post-info > .eltd-post-info-category a:hover',
				'.eltd-blog-holder article.format-quote .eltd-post-quote-author',
				'.eltd-filter-blog-holder li.eltd-active',
				'.eltd-single-tags-holder .eltd-tags a:hover',
				'.eltd-blog-single-navigation .eltd-blog-navigation-info:hover',
				'.eltd-single-links-pages .eltd-single-links-pages-inner > a:hover',
				'.eltd-single-links-pages .eltd-single-links-pages-inner > span:hover',
				'.eltd-related-posts-holder .eltd-related-post .eltd-related-post-title a h5:hover',
				'.eltd-author-description .eltd-author-social-holder a:hover',
				'.eltd-listing-archive-adv-search-holder .eltd-listing-archive-amenities-holder .eltd-listing-archive-advanced-search-amenity .active.eltd-listing-amenity-input:after',
				'.eltd-listing-dashboard-holder-outer .active.eltd-listing-checkbox-input:after',
				'.eltd-listing-archive-adv-search-holder .eltd-listing-archive-keyword',
				'.eltd-listing-item-booking select',
				'.eltd-listing-item-booking input',
				'.eltd-listing-enquiry-holder textarea',
				'.eltd-listing-enquiry-holder input',
				'.eltd-listing-item-rating .rating-inner',
				'.ui-autocomplete.ui-widget-content li:hover',
				'.eltd-listing-single-holder .eltd-listing-title-holder .eltd-listing-rating-info .eltd-single-listing-wishlist .eltd-listing-whislist.eltd-added-to-wishlist',
				'.eltd-listing-single-holder .eltd-listing-title-holder .eltd-listing-rating-info .eltd-single-listing-wishlist .eltd-listing-whislist:hover',
				'.eltd-listing-item-info .eltd-listing-website:hover',
				'.eltd-listing-custom-fields .eltd-listing-custom-field .eltd-listing-custom-field-icon',
				'.eltd-listing-feature-list span:before',
				'.eltd-listing-tags-holder a:hover',
				'.eltd-listing-comments .eltd-comments .eltd-review-rating .rating-inner',
				'.eltd-listing-comments .eltd-comments .eltd-review-title',
				'.eltd-listing-comments .eltd-comment-form .eltd-rating-form-title-holder .eltd-comment-form-rating label',
				'.eltd-comment-rating-box .eltd-star-rating.active',
				'.eltd-listing-social-holder a:hover',
				'.eltd-listing-item-booking .select2-container--default .select2-selection--single .select2-selection__rendered',
				'.eltd-listing-item-booking .select2-container--default .select2-selection--single .select2-selection__arrow:after',
				'.select2-container .select2-container .select2-results__option[aria-selected=true]',
				'.select2-container .select2-container .select2-results__option--highlighted[aria-selected]',
				'.eltd-claim-holder .eltd-claim-content .select2-container .select2-selection__rendered',
				'.eltd-claim-holder .eltd-claim-content .select2-container .select2-selection__arrow:after',
				'.eltd-listing-dashboard-holder-outer .eltd-listing-required-field',
				'.eltd-dashboard-profile-info-item .eltd-dashboard-profile-item-inner > a',
				'.eltd-dashboard-profile-info-item .eltd-dashboard-profile-item-inner > span',
				'.eltd-listing-search-holder .eltd-listing-search-field .select2-container .select2-selection .select2-selection__rendered',
				'.eltd-map-marker-holder .eltd-map-marker .eltd-map-marker-inner > i',
				'.eltd-map-marker-holder .eltd-map-marker .eltd-map-marker-inner > span',
				'.eltd-listing-dashboard-holder-outer label.eltd-checbox-label',
				'.eltd-listing-dashboard-nav-holder ul li a:hover',
				'.eltd-listing-dashboard-nav-holder ul li.eltd-listing-active-item a',
				'.eltd-user-package tbody tr td',
				'.select2-results__option:hover',
				'.select2-container .select2-results__option[aria-selected=true]',
				'.select2-container .select2-results__option--highlighted[aria-selected]',
				'.eltd-listing-archive-adv-search-holder .eltd-listing-archive-amenities-holder .eltd-listing-archive-advanced-search-amenity label',
				'.eltd-listing-search-holder .eltd-listing-search-field .select2-container .select2-selection .select2-selection__placeholder',
				'.eltd-listing-search-holder .eltd-listing-search-field .select2-container .select2-selection .select2-selection__arrow:after',
				'.eltd-listing-archive-adv-search-holder .select2-container .select2-selection .select2-selection__rendered',
				'.eltd-listing-archive-adv-search-holder .select2-container .select2-selection .select2-selection__placeholder',
				'.eltd-listing-archive-adv-search-holder .select2-container .select2-selection .select2-selection__arrow:after',
				'.eltd-footer-inner #lang_sel a:hover',
				'.eltd-side-menu #lang_sel a:hover',
				'.eltd-top-bar #lang_sel .lang_sel_sel:hover',
				'.eltd-top-bar #lang_sel ul ul a:hover',
				'.eltd-top-bar #lang_sel_list ul li a:hover',
				'.eltd-main-menu .menu-item-language .submenu-languages a:hover',
				'.eltd-sticky-header .eltd-position-right .widget_icl_lang_sel_widget #lang_sel .lang_sel_sel:hover',
				'.eltd-menu-area .eltd-position-right .widget_icl_lang_sel_widget #lang_sel .lang_sel_sel:hover',
				'.eltd-sticky-header .eltd-position-right .widget_icl_lang_sel_widget #lang_sel_list ul li a:hover',
				'.eltd-menu-area .eltd-position-right .widget_icl_lang_sel_widget #lang_sel_list ul li a:hover',
				'.eltd-listing-basic-holder .eltd-listing-basic-item-holder.eltd-item-hovered a:not(.eltd-listing-item-category-icon):not(.eltd-listing-whislist)',
				'.eltd-listing-list-item.eltd-item-hovered .eltd-listing-item-content .eltd-listing-title-holder .eltd-listing-title',
				'.eltd-map-marker-holder .eltd-info-window-inner > a:hover ~ .eltd-info-window-details h5',
				'.eltd-listing-list.eltd-listing-list-without-map .eltd-listing-list-items .eltd-listing-basic-item-holder.eltd-item-hovered a:not(.eltd-listing-item-category-icon):not(.eltd-listing-whislist)',
				'.eltd-blog-list-holder.eltd-boxes>ul>li.eltd-item-hovered .eltd-item-title a',
				'.eltd-login-register-widget .eltd-mobile-login-icon',
				'.eltd-top-bar a:hover',
				'.eltd-listing-custom-fields-holder > div.eltd-listing-custom-select-fields-holder .select2-selection.select2-selection--single .select2-selection__rendered'
			);

			$color_important_selector = array(
				'.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-hover-color):hover',
				'.eltd-light-header header .eltd-login-register-widget .eltd-logged-in-user span:hover',
				'.eltd-light-header header .eltd-login-register-widget .eltd-logged-in-user span:hover span',
				'.eltd-light-header header .eltd-login-register-widget .eltd-login-dropdown li a:hover',
				'.eltd-dark-header header .eltd-login-register-widget .eltd-logged-in-user span:hover',
				'.eltd-dark-header header .eltd-login-register-widget .eltd-logged-in-user span:hover span',
				'.eltd-dark-header header .eltd-login-register-widget .eltd-login-dropdown li a:hover'
			);

			$background_color_selector = array(
				'.eltd-st-loader .pulse',
				'.eltd-st-loader .double_pulse .double-bounce1',
				'.eltd-st-loader .double_pulse .double-bounce2',
				'.eltd-st-loader .cube',
				'.eltd-st-loader .rotating_cubes .cube1',
				'.eltd-st-loader .rotating_cubes .cube2',
				'.eltd-st-loader .stripes > div',
				'.eltd-st-loader .wave > div',
				'.eltd-st-loader .two_rotating_circles .dot1',
				'.eltd-st-loader .two_rotating_circles .dot2',
				'.eltd-st-loader .five_rotating_circles .container1 > div',
				'.eltd-st-loader .five_rotating_circles .container2 > div',
				'.eltd-st-loader .five_rotating_circles .container3 > div',
				'.eltd-st-loader .lines .line1',
				'.eltd-st-loader .lines .line2',
				'.eltd-st-loader .lines .line3',
				'.eltd-st-loader .lines .line4',
				'.post-password-form input[type="submit"]',
				'input.wpcf7-form-control.wpcf7-submit',
				'#eltd-back-to-top > span',
				'.eltd-title',
				'.eltd-icon-shortcode.circle',
				'.eltd-icon-shortcode.square',
				'.eltd-unordered-list:not(.eltd-line) ul > li:before',
				'.eltd-progress-bar .eltd-progress-number-wrapper.eltd-floating-outside .eltd-progress-number',
				'.eltd-progress-bar .eltd-progress-content-outer .eltd-progress-content',
				'.eltd-price-table.eltd-active .eltd-active-text',
				'.eltd-pie-chart-doughnut-holder .eltd-pie-legend ul li .eltd-pie-color-holder',
				'.eltd-pie-chart-pie-holder .eltd-pie-legend ul li .eltd-pie-color-holder',
				'.eltd-btn.eltd-btn-solid',
				'.eltd-dropcaps.eltd-square, .eltd-dropcaps.eltd-circle',
				'.eltd-login-content .eltd-login-title',
				'.eltd-login-content .eltd-login-form-social-login button',
				'.eltd-blog-holder article.format-link .eltd-link-icon-holder',
				'.eltd-blog-holder article.format-audio .mejs-container .mejs-controls',
				'.eltd-listing-single-holder .eltd-listing-title-holder .eltd-listing-rating-info .eltd-listing-item-category-icons .eltd-listing-item-category-icon',
				'.eltd-listing-feat-list-holder article.eltd-listing-feat-listing-item .eltd-listing-item-category-icon',
				'.eltd-listing-archive-adv-search-holder .eltd-listing-archive-adv-search-count .eltd-listing-archive-adv-search-count-inner',
				'.eltd-listing-whislist:hover',
				'.eltd-listing-whislist.eltd-added-to-wishlist',
				'.eltd-cluster-marker:hover .eltd-cluster-marker-number',
				'.eltd-listing-item-related-holder .eltd-listing-related-image-holder .eltd-listing-related-categories a',
				'.eltd-claim-holder .eltd-claim-title',
				'.eltd-social-profiles-icons .eltd-social-profiles-icon:hover, .eltd-social-profiles-icons .eltd-social-profiles-icon.active',
				'.eltd-listing-ajax-response-holder .eltd-ajax-response.eltd-listing-ajax-error',
				'ul.select2-results__options::-webkit-scrollbar-thumb',
				'.eltd-listing-search-holder .eltd-listing-search-categories-holder .eltd-listing-search-category-link:hover',
				'.eltd-map-marker-holder.active .eltd-map-marker .eltd-map-marker-inner > i',
				'.eltd-map-marker-holder.active .eltd-map-marker .eltd-map-marker-inner > span',
				'.eltd-listing-share .eltd-social-share-holder.eltd-dropdown:hover',
				'.eltd-single-listing-share-claim .eltd-listing-claim a:hover'
			);

			$background_selector = array(
				'.eltd-st-loader .atom .ball-1:before',
				'.eltd-st-loader .atom .ball-2:before',
				'.eltd-st-loader .atom .ball-3:before',
				'.eltd-st-loader .atom .ball-4:before',
				'.eltd-st-loader .clock .ball:before',
				'.eltd-st-loader .mitosis .ball',
				'.eltd-st-loader .fussion .ball',
				'.eltd-st-loader .fussion .ball-1',
				'.eltd-st-loader .fussion .ball-2',
				'.eltd-st-loader .fussion .ball-3',
				'.eltd-st-loader .fussion .ball-4',
				'.eltd-st-loader .wave_circles .ball',
				'.eltd-st-loader .pulse_circles .ball',
				'.eltd-testimonials.owl-carousel .owl-pagination .owl-page span',
				'.eltd-map-marker-holder .eltd-map-marker:hover .eltd-map-marker-inner > i',
				'.eltd-map-marker-holder .eltd-map-marker:hover .eltd-map-marker-inner > span'
			);

			$background_color_important_selector = array(
				'.eltd-btn.eltd-btn-outline:not(.eltd-btn-custom-hover-bg):hover'
			);

			$border_color_selector           = array(
				'.post-password-form input[type="submit"]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.eltd-progress-bar .eltd-progress-number-wrapper.eltd-floating .eltd-down-arrow',
				'.eltd-btn.eltd-btn-solid',
				'.eltd-btn.eltd-btn-outline',
				'.widget_search input[type="text"]',
				'.widget_archive select',
				'.widget_categories select',
				'.eltd-sticky-header .eltd-login-register-widget .eltd-logged-in-user > span:hover',
				'.eltd-login-content .eltd-login-form-social-login button',
				'.eltd-single-tags-holder .eltd-tags a:hover',
				'.select2-container--default .select2-search--dropdown .select2-search__field',
				'.eltd-listing-tags-holder a:hover',
				'.eltd-sidebar #lang_sel',
				'.wpb_widgetised_column #lang_sel',
				'.eltd-footer-inner #lang_sel',
				'.eltd-side-menu #lang_sel'
			);

			$border_color_important_selector = array(
				'.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-border-hover):hover',
				'.eltd-btn.eltd-btn-outline:not(.eltd-btn-custom-border-hover):hover',
				'.eltd-light-header header .eltd-login-register-widget a.eltd-btn:hover',
				'.eltd-light-header header .eltd-login-register-widget .eltd-logged-in-user span:hover',
				'.eltd-light-header .eltd-mobile-header .eltd-login-register-widget a.eltd-btn:hover',
				'.eltd-dark-header header .eltd-login-register-widget a.eltd-btn:hover',
				'.eltd-dark-header header .eltd-login-register-widget .eltd-logged-in-user span:hover'
			);

			$webkit_text_fill_color_selector = array(
				'.wpcf7-form-control.wpcf7-text:-webkit-autofill',
				'.wpcf7-form-control.wpcf7-number:-webkit-autofill',
				'.wpcf7-form-control.wpcf7-date:-webkit-autofill',
				'.wpcf7-form-control.wpcf7-textarea:-webkit-autofill',
				'.wpcf7-form-control.wpcf7-select:-webkit-autofill',
				'.wpcf7-form-control.wpcf7-quiz:-webkit-autofill',
				'#respond textarea:-webkit-autofill',
				'#respond input[type="text"]:-webkit-autofill',
				'.post-password-form input[type="password"]:-webkit-autofill',
				'.eltd-input-field:-webkit-autofill',
				'.eltd-textarea-field:-webkit-autofill',
				'.eltd-listing-archive-adv-search-holder .eltd-listing-archive-keyword:-webkit-autofill',
				'.eltd-listing-item-booking select:-webkit-autofill',
				'.eltd-listing-item-booking input:-webkit-autofill',
				'.eltd-listing-enquiry-holder textarea:-webkit-autofill',
				'.eltd-listing-enquiry-holder input:-webkit-autofill, .eltd-listing-search-holder .eltd-listing-search-field input:-webkit-autofill'
			);

			$fill_color_selector = array(
				'.eltd-map-marker-holder .eltd-map-marker svg path',
				'.eltd-cluster-marker svg path'
			);

			echo search_and_go_elated_dynamic_css( $color_selector, array( 'color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) ) );
			echo search_and_go_elated_dynamic_css( $color_important_selector, array( 'color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) . '!important' ) );
			echo search_and_go_elated_dynamic_css( '::selection', array( 'background' => search_and_go_elated_options()->getOptionValue( 'first_color' ) ) );
			echo search_and_go_elated_dynamic_css( '::-moz-selection', array( 'background' => search_and_go_elated_options()->getOptionValue( 'first_color' ) ) );
			echo search_and_go_elated_dynamic_css( $background_selector, array( 'background' => search_and_go_elated_options()->getOptionValue( 'first_color' ) ) );
			echo search_and_go_elated_dynamic_css( $background_color_selector, array( 'background-color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) ) );
			echo search_and_go_elated_dynamic_css( $background_color_important_selector, array( 'background-color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) . '!important' ) );
			echo search_and_go_elated_dynamic_css( $border_color_selector, array( 'border-color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) ) );
			echo search_and_go_elated_dynamic_css( $border_color_important_selector, array( 'border-color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) . '!important' ) );
			echo search_and_go_elated_dynamic_css( $webkit_text_fill_color_selector, array( '-webkit-text-fill-color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) . '!important' ) );
			echo search_and_go_elated_dynamic_css( $fill_color_selector, array( 'fill' => search_and_go_elated_options()->getOptionValue( 'first_color' ) . '!important' ) );

			//generate placeholder css rules based on first color
			$placeholder_color_selector = array(
				'#respond textarea::-webkit-input-placeholder',
				'#respond textarea::-moz-placeholder',
				'#respond textarea:-ms-input-placeholder',
				'#respond textarea:-moz-placeholder',
				'#respond input[type="text"]::-webkit-input-placeholder',
				'#respond input[type="text"]::-moz-placeholder',
				'#respond input[type="text"]:-ms-input-placeholder',
				'#respond input[type="text"]:-moz-placeholder',
				'.eltd-textarea-field::-webkit-input-placeholder',
				'.eltd-textarea-field::-moz-placeholder',
				'.eltd-textarea-field:-ms-input-placeholder',
				'.eltd-textarea-field:-moz-placeholder',
				'.eltd-input-field::-webkit-input-placeholder',
				'.eltd-input-field::-moz-placeholder',
				'.eltd-input-field:-ms-input-placeholder',
				'.eltd-input-field:-moz-placeholder',
				'.eltd-listing-archive-adv-search-holder input[type="text"]::-webkit-input-placeholder',
				'.eltd-listing-archive-adv-search-holder input[type="text"]::-moz-placeholder',
				'.eltd-listing-archive-adv-search-holder input[type="text"]:-ms-input-placeholder',
				'.eltd-listing-archive-adv-search-holder input[type="text"]:-moz-placeholder',
				'.eltd-listing-search-holder .eltd-listing-search-field input[type="text"]::-webkit-input-placeholder',
				'.eltd-listing-search-holder .eltd-listing-search-field input[type="text"]::-moz-placeholder',
				'.eltd-listing-search-holder .eltd-listing-search-field input[type="text"]:-ms-input-placeholder',
				'.eltd-listing-search-holder .eltd-listing-search-field input[type="text"]:-moz-placeholder'
			);

			echo search_and_go_elated_set_placeholder_dynamic_style( $placeholder_color_selector, array( 'color' => search_and_go_elated_options()->getOptionValue( 'first_color' ) ) );

			//generate woocommerce css rules based on first color
			if( search_and_go_elated_is_woocommerce_installed() ){

				$woocommerce_color_selectors = array(
					'.eltd-woocommerce-page .woocommerce-result-count',
					'.woocommerce .woocommerce-result-count',
				    '.eltd-woocommerce-page .product .eltd-product-list-product-title:hover',
				    '.woocommerce .product .eltd-product-list-product-title:hover',
					'.eltd-woocommerce-page .product .eltd-woocommerce-lightbox:hover',
					'.woocommerce .product .eltd-woocommerce-lightbox:hover',
				    '.eltd-woocommerce-page .star-rating span',
				    '.woocommerce .star-rating span',
					'.eltd-single-product-summary .eltd-single-product-categories',
					'.eltd-single-product-summary .eltd-single-product-categories a',
					'.eltd-single-product-summary .eltd-single-product-price .woocommerce-review-link:hover',
					'.eltd-single-product-summary form.cart .label',
					'.eltd-single-product-summary form.cart .reset_variations:hover',
					'.eltd-single-product-summary .single_variation .price',
				    '.eltd-woocommerce-page .eltd-tabs.eltd-horizontal .eltd-tabs-nav li.active a',
				    '.eltd-woocommerce-page .eltd-tabs.eltd-horizontal .eltd-tabs-nav li:hover a',
				    '.eltd-woocommerce-page .eltd-tab-container .comment-form-rating label',
				    '.eltd-woocommerce-page .eltd-tab-container .comment-form-comment label',
				    '.eltd-woocommerce-page .eltd-tab-container .comment-form-rating .stars a.active:after',
				    '.eltd-woocommerce-page .eltd-tab-container .comment-form-rating .stars a:hover:after',
					'.eltd-woocommerce-page .related.products .eltd-related-products-subtitle',
					'.eltd-woocommerce-page .woocommerce-message',
				    '.eltd-woocommerce-page .woocommerce-info',
					'.eltd-woocommerce-page .woocommerce-error',
				    '.woocommerce .woocommerce-message',
				    '.woocommerce .woocommerce-info',
				    '.woocommerce .woocommerce-error',
				    '.eltd-woocommerce-page .woocommerce-message .button',
				    '.eltd-woocommerce-page .woocommerce-info .button',
				    '.eltd-woocommerce-page .woocommerce-error .button',
				    '.woocommerce .woocommerce-message .button',
				    '.woocommerce .woocommerce-info .button',
				    '.woocommerce .woocommerce-error .button',
				    '.eltd-woocommerce-page thead th',
				    '.woocommerce thead th',
					'.eltd-woocommerce-page .woocommerce-MyAccount-navigation ul li a:hover',
					'.widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content ul li a:not(.remove):hover',
					'.widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content ul li .remove:hover',
					'.widget.woocommerce.widget_layered_nav a:hover, .widget.woocommerce.widget_layered_nav_filters a:hover',
					'.widget.woocommerce.widget_product_categories a',
					'.widget.woocommerce.widget_products ul li a:hover',
				    '.widget.woocommerce.widget_recently_viewed_products ul li a:hover',
				    '.widget.woocommerce.widget_recent_reviews ul li a:hover',
				    '.widget.woocommerce.widget_top_rated_products ul li a:hover',
					'.widget.woocommerce.widget_product_tag_cloud .tagcloud a:hover',
					'.widget.woocommerce.widget_product_search .woocommerce-product-search button',
					'.eltd-shopping-cart-outer .eltd-shopping-cart-header .eltd-header-cart i',
					'.eltd-shopping-cart-dropdown ul li a:hover',
					'.eltd-shopping-cart-dropdown .eltd-item-info-holder .eltd-item-right .remove:hover',
					'.select2-drop',
					'.select2-results .select2-highlighted ul',
					'.eltd-woocommerce-page .select2-container .select2-choice',
					'.eltd-woocommerce-page .woocommerce-ordering .select2-container--default .select2-selection--single .select2-selection__rendered',
					'.eltd-woocommerce-page .woocommerce-ordering .select2-container--default .select2-selection--single .select2-selection__arrow b:before'
				);
				$woocommerce_background_color_selectors = array(
					'.eltd-woocommerce-page .product .eltd-image-add-to-cart-holder .added_to_cart',
				    '.woocommerce .product .eltd-image-add-to-cart-holder .added_to_cart',
					'.eltd-woocommerce-page .product .eltd-out-of-stock',
				    '.eltd-woocommerce-page .product .eltd-onsale',
				    '.woocommerce .product .eltd-out-of-stock',
					'.woocommerce .product .eltd-onsale',
					'.woocommerce-pagination .page-numbers li span.current',
				    '.woocommerce-pagination .page-numbers li a:hover',
				    '.woocommerce-pagination .page-numbers li span:hover',
				    '.woocommerce-pagination .page-numbers li span.current:hover',
					'.eltd-single-product-summary .eltd-single-product-price .price del:after',
					'.widget.woocommerce.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range',
				    '.eltd-woocommerce-page a.button',
				    '.eltd-woocommerce-page input.button',
				    '.woocommerce a.button',
				    '.woocommerce input.button',
					'.eltd-shopping-cart-outer .eltd-shopping-cart-header .eltd-header-cart-span',
					'.eltd-woocommerce-page .select2-results .select2-highlighted'
				);
				$woocommerce_border_color_selectors = array(
					'.woocommerce-pagination .page-numbers li span.current'
				);
				echo search_and_go_elated_dynamic_css($woocommerce_color_selectors, array('color' => search_and_go_elated_options()->getOptionValue('first_color')));
				echo search_and_go_elated_dynamic_css($woocommerce_background_color_selectors, array('background-color' => search_and_go_elated_options()->getOptionValue('first_color')));
				echo search_and_go_elated_dynamic_css($woocommerce_border_color_selectors, array('border-color' => search_and_go_elated_options()->getOptionValue('first_color')));

			}
		}

		if ( search_and_go_elated_options()->getOptionValue( 'page_background_color' ) ) {
			$background_color_selector = array(
				'.eltd-wrapper-inner',
				'.eltd-content'
			);
			echo search_and_go_elated_dynamic_css( $background_color_selector, array( 'background-color' => search_and_go_elated_options()->getOptionValue( 'page_background_color' ) ) );
		}

		if ( search_and_go_elated_options()->getOptionValue( 'selection_color' ) ) {
			echo search_and_go_elated_dynamic_css( '::selection', array( 'background' => search_and_go_elated_options()->getOptionValue( 'selection_color' ) ) );
			echo search_and_go_elated_dynamic_css( '::-moz-selection', array( 'background' => search_and_go_elated_options()->getOptionValue( 'selection_color' ) ) );
		}

		$boxed_background_style = array();
		if ( search_and_go_elated_options()->getOptionValue( 'page_background_color_in_box' ) ) {
			$boxed_background_style['background-color'] = search_and_go_elated_options()->getOptionValue( 'page_background_color_in_box' );
		}

		if ( search_and_go_elated_options()->getOptionValue( 'boxed_background_image' ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( search_and_go_elated_options()->getOptionValue( 'boxed_background_image' ) ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}

		if ( search_and_go_elated_options()->getOptionValue( 'boxed_pattern_background_image' ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( search_and_go_elated_options()->getOptionValue( 'boxed_pattern_background_image' ) ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}

		if ( search_and_go_elated_options()->getOptionValue( 'boxed_background_image_attachment' ) ) {
			$boxed_background_style['background-attachment'] = ( search_and_go_elated_options()->getOptionValue( 'boxed_background_image_attachment' ) );
		}

		echo search_and_go_elated_dynamic_css( '.eltd-boxed .eltd-wrapper', $boxed_background_style );

		$overlapping_content_style = array();
		if ( search_and_go_elated_options()->getOptionValue( 'overlapping_content_padding' ) !== '' ) {
			$overlapping_content_style['padding'] = search_and_go_elated_options()->getOptionValue( 'overlapping_content_padding' );
		}

		echo search_and_go_elated_dynamic_css( '.eltd-overlapping-content', $overlapping_content_style );

	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_design_styles' );
}

if ( ! function_exists( 'search_and_go_elated_h1_styles' ) ) {

	function search_and_go_elated_h1_styles() {

		$h1_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'h1_color' ) !== '' ) {
			$h1_styles['color'] = search_and_go_elated_options()->getOptionValue( 'h1_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h1_google_fonts' ) !== '-1' ) {
			$h1_styles['font-family'] = search_and_go_elated_get_formatted_font_family( search_and_go_elated_options()->getOptionValue( 'h1_google_fonts' ) );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h1_fontsize' ) !== '' ) {
			$h1_styles['font-size'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h1_fontsize' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h1_lineheight' ) !== '' ) {
			$h1_styles['line-height'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h1_lineheight' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h1_texttransform' ) !== '' ) {
			$h1_styles['text-transform'] = search_and_go_elated_options()->getOptionValue( 'h1_texttransform' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h1_fontstyle' ) !== '' ) {
			$h1_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'h1_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h1_fontweight' ) !== '' ) {
			$h1_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'h1_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h1_letterspacing' ) !== '' ) {
			$h1_styles['letter-spacing'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h1_letterspacing' ) ) . 'px';
		}

		$h1_selector = array(
			'h1'
		);

		if ( ! empty( $h1_styles ) ) {
			echo search_and_go_elated_dynamic_css( $h1_selector, $h1_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_h1_styles' );
}

if ( ! function_exists( 'search_and_go_elated_h2_styles' ) ) {

	function search_and_go_elated_h2_styles() {

		$h2_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'h2_color' ) !== '' ) {
			$h2_styles['color'] = search_and_go_elated_options()->getOptionValue( 'h2_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h2_google_fonts' ) !== '-1' ) {
			$h2_styles['font-family'] = search_and_go_elated_get_formatted_font_family( search_and_go_elated_options()->getOptionValue( 'h2_google_fonts' ) );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h2_fontsize' ) !== '' ) {
			$h2_styles['font-size'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h2_fontsize' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h2_lineheight' ) !== '' ) {
			$h2_styles['line-height'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h2_lineheight' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h2_texttransform' ) !== '' ) {
			$h2_styles['text-transform'] = search_and_go_elated_options()->getOptionValue( 'h2_texttransform' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h2_fontstyle' ) !== '' ) {
			$h2_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'h2_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h2_fontweight' ) !== '' ) {
			$h2_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'h2_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h2_letterspacing' ) !== '' ) {
			$h2_styles['letter-spacing'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h2_letterspacing' ) ) . 'px';
		}

		$h2_selector = array(
			'h2'
		);

		if ( ! empty( $h2_styles ) ) {
			echo search_and_go_elated_dynamic_css( $h2_selector, $h2_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_h2_styles' );
}

if ( ! function_exists( 'search_and_go_elated_h3_styles' ) ) {

	function search_and_go_elated_h3_styles() {

		$h3_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'h3_color' ) !== '' ) {
			$h3_styles['color'] = search_and_go_elated_options()->getOptionValue( 'h3_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h3_google_fonts' ) !== '-1' ) {
			$h3_styles['font-family'] = search_and_go_elated_get_formatted_font_family( search_and_go_elated_options()->getOptionValue( 'h3_google_fonts' ) );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h3_fontsize' ) !== '' ) {
			$h3_styles['font-size'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h3_fontsize' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h3_lineheight' ) !== '' ) {
			$h3_styles['line-height'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h3_lineheight' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h3_texttransform' ) !== '' ) {
			$h3_styles['text-transform'] = search_and_go_elated_options()->getOptionValue( 'h3_texttransform' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h3_fontstyle' ) !== '' ) {
			$h3_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'h3_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h3_fontweight' ) !== '' ) {
			$h3_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'h3_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h3_letterspacing' ) !== '' ) {
			$h3_styles['letter-spacing'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h3_letterspacing' ) ) . 'px';
		}

		$h3_selector = array(
			'h3'
		);

		if ( ! empty( $h3_styles ) ) {
			echo search_and_go_elated_dynamic_css( $h3_selector, $h3_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_h3_styles' );
}

if ( ! function_exists( 'search_and_go_elated_h4_styles' ) ) {

	function search_and_go_elated_h4_styles() {

		$h4_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'h4_color' ) !== '' ) {
			$h4_styles['color'] = search_and_go_elated_options()->getOptionValue( 'h4_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h4_google_fonts' ) !== '-1' ) {
			$h4_styles['font-family'] = search_and_go_elated_get_formatted_font_family( search_and_go_elated_options()->getOptionValue( 'h4_google_fonts' ) );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h4_fontsize' ) !== '' ) {
			$h4_styles['font-size'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h4_fontsize' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h4_lineheight' ) !== '' ) {
			$h4_styles['line-height'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h4_lineheight' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h4_texttransform' ) !== '' ) {
			$h4_styles['text-transform'] = search_and_go_elated_options()->getOptionValue( 'h4_texttransform' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h4_fontstyle' ) !== '' ) {
			$h4_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'h4_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h4_fontweight' ) !== '' ) {
			$h4_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'h4_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h4_letterspacing' ) !== '' ) {
			$h4_styles['letter-spacing'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h4_letterspacing' ) ) . 'px';
		}

		$h4_selector = array(
			'h4'
		);

		if ( ! empty( $h4_styles ) ) {
			echo search_and_go_elated_dynamic_css( $h4_selector, $h4_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_h4_styles' );
}

if ( ! function_exists( 'search_and_go_elated_h5_styles' ) ) {

	function search_and_go_elated_h5_styles() {

		$h5_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'h5_color' ) !== '' ) {
			$h5_styles['color'] = search_and_go_elated_options()->getOptionValue( 'h5_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h5_google_fonts' ) !== '-1' ) {
			$h5_styles['font-family'] = search_and_go_elated_get_formatted_font_family( search_and_go_elated_options()->getOptionValue( 'h5_google_fonts' ) );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h5_fontsize' ) !== '' ) {
			$h5_styles['font-size'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h5_fontsize' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h5_lineheight' ) !== '' ) {
			$h5_styles['line-height'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h5_lineheight' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h5_texttransform' ) !== '' ) {
			$h5_styles['text-transform'] = search_and_go_elated_options()->getOptionValue( 'h5_texttransform' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h5_fontstyle' ) !== '' ) {
			$h5_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'h5_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h5_fontweight' ) !== '' ) {
			$h5_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'h5_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h5_letterspacing' ) !== '' ) {
			$h5_styles['letter-spacing'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h5_letterspacing' ) ) . 'px';
		}

		$h5_selector = array(
			'h5'
		);

		if ( ! empty( $h5_styles ) ) {
			echo search_and_go_elated_dynamic_css( $h5_selector, $h5_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_h5_styles' );
}

if ( ! function_exists( 'search_and_go_elated_h6_styles' ) ) {

	function search_and_go_elated_h6_styles() {

		$h6_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'h6_color' ) !== '' ) {
			$h6_styles['color'] = search_and_go_elated_options()->getOptionValue( 'h6_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h6_google_fonts' ) !== '-1' ) {
			$h6_styles['font-family'] = search_and_go_elated_get_formatted_font_family( search_and_go_elated_options()->getOptionValue( 'h6_google_fonts' ) );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h6_fontsize' ) !== '' ) {
			$h6_styles['font-size'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h6_fontsize' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h6_lineheight' ) !== '' ) {
			$h6_styles['line-height'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h6_lineheight' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h6_texttransform' ) !== '' ) {
			$h6_styles['text-transform'] = search_and_go_elated_options()->getOptionValue( 'h6_texttransform' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h6_fontstyle' ) !== '' ) {
			$h6_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'h6_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h6_fontweight' ) !== '' ) {
			$h6_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'h6_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'h6_letterspacing' ) !== '' ) {
			$h6_styles['letter-spacing'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'h6_letterspacing' ) ) . 'px';
		}

		$h6_selector = array(
			'h6'
		);

		if ( ! empty( $h6_styles ) ) {
			echo search_and_go_elated_dynamic_css( $h6_selector, $h6_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_h6_styles' );
}

if ( ! function_exists( 'search_and_go_elated_text_styles' ) ) {

	function search_and_go_elated_text_styles() {

		$text_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'text_color' ) !== '' ) {
			$text_styles['color'] = search_and_go_elated_options()->getOptionValue( 'text_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'text_google_fonts' ) !== '-1' ) {
			$text_styles['font-family'] = search_and_go_elated_get_formatted_font_family( search_and_go_elated_options()->getOptionValue( 'text_google_fonts' ) );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'text_fontsize' ) !== '' ) {
			$text_styles['font-size'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'text_fontsize' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'text_lineheight' ) !== '' ) {
			$text_styles['line-height'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'text_lineheight' ) ) . 'px';
		}
		if ( search_and_go_elated_options()->getOptionValue( 'text_texttransform' ) !== '' ) {
			$text_styles['text-transform'] = search_and_go_elated_options()->getOptionValue( 'text_texttransform' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'text_fontstyle' ) !== '' ) {
			$text_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'text_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'text_fontweight' ) !== '' ) {
			$text_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'text_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'text_letterspacing' ) !== '' ) {
			$text_styles['letter-spacing'] = search_and_go_elated_filter_px( search_and_go_elated_options()->getOptionValue( 'text_letterspacing' ) ) . 'px';
		}

		$text_selector = array(
			'p'
		);

		if ( ! empty( $text_styles ) ) {
			echo search_and_go_elated_dynamic_css( $text_selector, $text_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_text_styles' );
}

if ( ! function_exists( 'search_and_go_elated_link_styles' ) ) {

	function search_and_go_elated_link_styles() {

		$link_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'link_color' ) !== '' ) {
			$link_styles['color'] = search_and_go_elated_options()->getOptionValue( 'link_color' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'link_fontstyle' ) !== '' ) {
			$link_styles['font-style'] = search_and_go_elated_options()->getOptionValue( 'link_fontstyle' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'link_fontweight' ) !== '' ) {
			$link_styles['font-weight'] = search_and_go_elated_options()->getOptionValue( 'link_fontweight' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'link_fontdecoration' ) !== '' ) {
			$link_styles['text-decoration'] = search_and_go_elated_options()->getOptionValue( 'link_fontdecoration' );
		}

		$link_selector = array(
			'a',
			'p a'
		);

		if ( ! empty( $link_styles ) ) {
			echo search_and_go_elated_dynamic_css( $link_selector, $link_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_link_styles' );
}

if ( ! function_exists( 'search_and_go_elated_link_hover_styles' ) ) {

	function search_and_go_elated_link_hover_styles() {

		$link_hover_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'link_hovercolor' ) !== '' ) {
			$link_hover_styles['color'] = search_and_go_elated_options()->getOptionValue( 'link_hovercolor' );
		}
		if ( search_and_go_elated_options()->getOptionValue( 'link_hover_fontdecoration' ) !== '' ) {
			$link_hover_styles['text-decoration'] = search_and_go_elated_options()->getOptionValue( 'link_hover_fontdecoration' );
		}

		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);

		if ( ! empty( $link_hover_styles ) ) {
			echo search_and_go_elated_dynamic_css( $link_hover_selector, $link_hover_styles );
		}

		$link_heading_hover_styles = array();

		if ( search_and_go_elated_options()->getOptionValue( 'link_hovercolor' ) !== '' ) {
			$link_heading_hover_styles['color'] = search_and_go_elated_options()->getOptionValue( 'link_hovercolor' );
		}

		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);

		if ( ! empty( $link_heading_hover_styles ) ) {
			echo search_and_go_elated_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_link_hover_styles' );
}

if ( ! function_exists( 'search_and_go_elated_smooth_page_transition_styles' ) ) {

	function search_and_go_elated_smooth_page_transition_styles() {

		$loader_style = array();

		if ( search_and_go_elated_options()->getOptionValue( 'smooth_pt_bgnd_color' ) !== '' ) {
			$loader_style['background-color'] = search_and_go_elated_options()->getOptionValue( 'smooth_pt_bgnd_color' );
		}

		$loader_selector = array( '.eltd-smooth-transition-loader' );

		if ( ! empty( $loader_style ) ) {
			echo search_and_go_elated_dynamic_css( $loader_selector, $loader_style );
		}

		$spinner_style = array();

		if ( search_and_go_elated_options()->getOptionValue( 'smooth_pt_spinner_color' ) !== '' ) {
			$spinner_style['background-color'] = search_and_go_elated_options()->getOptionValue( 'smooth_pt_spinner_color' );
		}

		$spinner_selectors = array(
			'.eltd-st-loader .pulse',
			'.eltd-st-loader .double_pulse .double-bounce1',
			'.eltd-st-loader .double_pulse .double-bounce2',
			'.eltd-st-loader .cube',
			'.eltd-st-loader .rotating_cubes .cube1',
			'.eltd-st-loader .rotating_cubes .cube2',
			'.eltd-st-loader .stripes > div',
			'.eltd-st-loader .wave > div',
			'.eltd-st-loader .two_rotating_circles .dot1',
			'.eltd-st-loader .two_rotating_circles .dot2',
			'.eltd-st-loader .five_rotating_circles .container1 > div',
			'.eltd-st-loader .five_rotating_circles .container2 > div',
			'.eltd-st-loader .five_rotating_circles .container3 > div',
			'.eltd-st-loader .atom .ball-1:before',
			'.eltd-st-loader .atom .ball-2:before',
			'.eltd-st-loader .atom .ball-3:before',
			'.eltd-st-loader .atom .ball-4:before',
			'.eltd-st-loader .clock .ball:before',
			'.eltd-st-loader .mitosis .ball',
			'.eltd-st-loader .lines .line1',
			'.eltd-st-loader .lines .line2',
			'.eltd-st-loader .lines .line3',
			'.eltd-st-loader .lines .line4',
			'.eltd-st-loader .fussion .ball',
			'.eltd-st-loader .fussion .ball-1',
			'.eltd-st-loader .fussion .ball-2',
			'.eltd-st-loader .fussion .ball-3',
			'.eltd-st-loader .fussion .ball-4',
			'.eltd-st-loader .wave_circles .ball',
			'.eltd-st-loader .pulse_circles .ball'
		);

		if ( ! empty( $spinner_style ) ) {
			echo search_and_go_elated_dynamic_css( $spinner_selectors, $spinner_style );
		}
	}

	add_action( 'search_and_go_elated_style_dynamic', 'search_and_go_elated_smooth_page_transition_styles' );
}