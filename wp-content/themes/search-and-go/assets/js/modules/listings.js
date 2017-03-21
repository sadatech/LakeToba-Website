(function ($) {
    'use strict';
    var listings = {};
    eltd.modules.listings = listings;

    listings.eltdOnDocumentReady = eltdOnDocumentReady;
    listings.eltdOnWindowLoad = eltdOnWindowLoad;
    listings.eltdOnWindowResize = eltdOnWindowResize;
    listings.eltdOnWindowScroll = eltdOnWindowScroll;
    listings.eltdMediaUpload = eltdMediaUpload;
    listings.eltdRemoveMedia = eltdRemoveMedia;
    listings.eltdUserRegister = eltdUserRegister;
    listings.eltdInitUpdateProfile = eltdInitUpdateProfile;
    listings.eltdAddListing = eltdAddListing;
    listings.eltdEditListing = eltdEditListing;
    listings.eltdAddToWhislist = eltdAddToWhislist;
    listings.eltdInitAddressField = eltdInitAddressField;
    listings.eltdListingFieldsHtml = eltdListingFieldsHtml;
    listings.eltdListingPackageHtml = eltdListingPackageHtml;
    listings.eltdSaveCheckBoxesValueFront = eltdSaveCheckBoxesValueFront;
    listings.eltdInitCommentRating = eltdInitCommentRating;
    listings.eltdListingAdvancedSearch = eltdListingAdvancedSearch;
    listings.eltdListingAdvancedSearchFields = eltdListingAdvancedSearchFields;
    listings.eltdListingSelect2Fields = eltdListingSelect2Fields;
    listings.eltdDeleteMyListing = eltdDeleteMyListing;
    listings.eltdInitListingEnquiryForm = eltdInitListingEnquiryForm;
    listings.eltdListingArchiveTypeChange = eltdListingArchiveTypeChange;
    listings.eltdListingArchiveLocationChange = eltdListingArchiveLocationChange;
    listings.eltdListingArchiveSortChange = eltdListingArchiveSortChange;
    listings.eltdListingArchiveKeyWordSearch = eltdListingArchiveKeyWordSearch;
    listings.eltdInitListingGallery = eltdInitListingGallery;
    listings.eltdInitListingCheckboxesStyle = eltdInitListingCheckboxesStyle;
	listings.eltdListingArchiveLoadMore = eltdListingArchiveLoadMore;
	listings.eltdInitSocialProfilesInput = eltdInitSocialProfilesInput;
	listings.eltdBindTitles = eltdBindTitles;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdOnDocumentReady() {
        eltdMediaUpload();
		eltdInitUpdateProfile();
		eltdRemoveMedia();
		eltdUserRegister();
		eltdAddListing();
		eltdEditListing();
		eltdAddToWhislist();
		eltdInitAddressField();
        eltdListingFieldsHtml();
        eltdListingPackageHtml();
		eltdSaveCheckBoxesValueFront();
		eltdInitCommentRating();
        eltdListingAdvancedSearchFields();
        eltdListingAdvancedSearch();
        eltdListingSelect2Fields();
		eltdDeleteMyListing();
		eltdInitListingEnquiryForm();
        eltdListingArchiveTypeChange();
        eltdListingArchiveLocationChange();
		eltdListingArchiveSortChange();
        eltdListingArchiveKeyWordSearch();
        eltdInitListingGallery();
		eltdListingArchiveLoadMore();
        eltdBindTitles();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function eltdOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdOnWindowScroll() {

    }

    function eltdListingFieldsHtml(){

        var dashboardHolder = $('.eltd-listing-dashboard-holder-outer');
        if ( ! dashboardHolder.length ) {
            return;
        }
        
        var listingTypeSelectField = $('.eltd-listing-type-select-field');
        var selectedListingType = $('.eltd-listing-type-select-field :selected');
        var selectedListingTypeID = $('.eltd-listing-type-select-field :selected').val();
		var thisListingHolder = $('.eltd-new-listing-type-fields');
        
        listingTypeSelectField.on('change', function(e) {

            //get choosen type id
            var choosenTypeID = $(this).val();
            thisListingHolder.html('');
            
            //set type id value in hidden field(this is for saving in database)
            $('#eltd-listing-type-value').val(choosenTypeID);
            
            e.preventDefault();
            
            var data = {
                action: 'eltd_listing_get_listing_fields',
                listingTypeId: choosenTypeID
            };
            $.ajax({
                type: "POST",
                url: ElatedAjaxUrl,
                data: data,
                success: function (response) {
                    if (response === 'error') {
                        //error handler
                    }
                    //loader if any should be hidden here
                    thisListingHolder.append(response);
                    //$('.eltd-upload-button').off('click');
                    eltdMediaUpload();
                    eltdInitAddressField();
                    eltdInitListingCheckboxesStyle();
                    eltdInitSocialProfilesInput();
                    eltdSaveCheckBoxesValueFront();
                    eltdListingSelect2Fields();
                    eltdRemoveMedia();
                }
            });

            return false;

        });
        
        if(selectedListingTypeID !== ''){
            
            var listingID;
            
            if (typeof selectedListingType.data('listing-id') !== 'undefined' && selectedListingType.data('listing-id') !== false) {                    
                listingID = selectedListingType.data('listing-id');
            }
            
            var data = {
                action: 'eltd_listing_get_listing_fields',
                listingTypeId: selectedListingTypeID,
                listingItemId: listingID
            };
            $.ajax({
                type: "POST",
                url: ElatedAjaxUrl,
                data: data,
                success: function (response) {
                    if (response === 'error') {
                        //error handler
                    }
                    //loader if any should be hidden here
                    thisListingHolder.append(response);
                    //$('.eltd-upload-button').off('click');
                    eltdMediaUpload();
                    eltdInitAddressField();
                    eltdInitListingCheckboxesStyle();
                    eltdSaveCheckBoxesValueFront();
                    eltdListingSelect2Fields();
                    eltdInitSocialProfilesInput();
                    eltdRemoveMedia();
                }
            });

        }

    }
    
    function eltdListingPackageHtml(){
        
        var packageSelect = $('.eltd-listing-select-package');
        var packageHolder = $('.eltd-new-listing-package-fields');
		var packageContainer = $('.eltd-new-listing-package-fields .eltd-listing-package-fields-wrapper');
        var currentUserID = packageSelect.data('user-id');
        var addNewListingButton = $('.eltd-listing-submit-listing');
        
        packageSelect.on('change', function(){
        
            var packageID = $(this).val();
            var ajaxData = {
                action: 'eltd_listing_check_package_status',
                packageID : packageID,
                userID: currentUserID
            };
            
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data);
                    var responseHtml =  response.html;
                    var addingEnabled = response.enabled_adding_new_item;
                    var responseFlag = response.packageFlag;

                    if ( ! addingEnabled ) {
                        
                        addNewListingButton.attr("disabled", true);
                        
                        var response = {
                            status: 'error',
                            message: response.enabled_adding_item_messsage
                        };

                        eltd.modules.common.eltdAjaxResponseMessageHtml(response);
                        
                        
                    }else{
                        
                        addNewListingButton.attr("disabled", false);
                        
                        //clear ajax response holder        
                        var ajaxResponseHolder = $('.eltd-listing-ajax-response-holder');
                        ajaxResponseHolder.empty();
                        
                    }

                    packageContainer.waitForImages(function(){    
                        if(responseHtml !== ''){
                            packageHolder.addClass('show');
                        }else{
                            packageHolder.removeClass('show');
                        }
                        packageContainer.html(responseHtml); // Append the new content                       
                    });
                }
            });
            
        });
        
        
    }    

    function eltdMediaUpload() {
        var uploadButton = $('.eltd-upload-button');
        if (uploadButton.length) {
            uploadButton.each(function () {
                var thisBtn = $(this);
                thisBtn.on('click', function (e) {
                    e.preventDefault();

                    var multiple = (thisBtn.data('multiple')) ? true : false;
                    var title = thisBtn.data('frame-title');
                    var text = thisBtn.data('frame-button-text');
                    if (multiple) {
                        eltdRenderMultipleMediaUploader(thisBtn);
                    } else {
                        eltdRenderSingleMediaUploader(thisBtn);
                    }
                });
            });
        }
    }

	function eltdRemoveMedia(){
        var removeButton = $('.eltd-remove-button');
        if(removeButton.length){
            removeButton.each(function(){
                var self = $(this),
                    actionButtonsHolder = self.parents('.eltd-action-buttons'),
                    mediaHolder = actionButtonsHolder.siblings('.eltd-media-holder'),
                    inputHolder = actionButtonsHolder.siblings('.eltd-media-uploader-input'),
                    mediaHolderInput = (mediaHolder.html()).trim();
                if ( mediaHolderInput == '' ) {
                    self.hide();
                    actionButtonsHolder.addClass('one-button');
                }
                self.on( 'click', function(e){
                    e.preventDefault();
                    mediaHolder.html('');
                    inputHolder.val('');
                    self.hide();
                    actionButtonsHolder.addClass('one-button');
                });
            });
        }
    }

    function eltdRenderSingleMediaUploader(button) {

        var singleUpload;
        var holder = button.parent();
        var input = holder.siblings('.eltd-media-uploader-input');
        var imagesHolder = holder.siblings('.eltd-media-holder');
        var removeButton = button.siblings('.eltd-remove-button');

        var settings = {
            title: button.data('frame-title'),
            button: {
                text: button.data('frame-button-text')
            }
        };
		if(singleUpload){
			singleUpload.open();
			return;
		}

        //create the media frame
        singleUpload = wp.media.frames.fileFrame = wp.media(settings);

		singleUpload.on( 'select', function() {
            var attachment = singleUpload.state().get('selection').first().toJSON();
            input.val(attachment.id);
			if(input.hasClass('eltd-media-thumbnail')){
				input.val(attachment.id);
			} else {
				input.val(attachment.url);
			}
            imagesHolder.html('');
			if(attachment.sizes.medium != undefined) {
				imagesHolder.append('<img src="' + attachment.sizes.medium.url + '" alt="' + attachment.name + '"/>');
			} else {
				imagesHolder.append('<img src="' + attachment.sizes.full.url + '" alt="' + attachment.name + '"/>');
			}
            holder.removeClass('one-button');
            removeButton.show();
        });
		singleUpload.open();

    }

    function eltdRenderMultipleMediaUploader(button) {

        var multipleUpload;
        var holder = button.parent();
        var input = holder.siblings('.eltd-media-uploader-input');
        var imagesHolder = holder.siblings('.eltd-media-holder');
        var removeButton = button.siblings('.eltd-remove-button');

        if ( undefined !== wp.media.frames.multipleUpload ) {
            wp.media.frames.multipleUpload.open();
            return;
        }
        var selection = [];
        if(input.val()){
            var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + input.val() + '"]'),
                defaultPostId = wp.media.gallery.defaults.id,
                attachments;

            // Bail if we didn't match the shortcode or all of the content.
            if (!shortcode)
                return;

            // Ignore the rest of the match object.
            shortcode = shortcode.shortcode;
            if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
                shortcode.set('id', defaultPostId);

            attachments = wp.media.gallery.attachments(shortcode);
            selection = new wp.media.model.Selection(attachments.models, {
                props: attachments.props.toJSON(),
                multiple: true
            });

            selection.gallery = attachments.gallery;
        }

        var settings = {
            frame: "post",
            state: "gallery-edit",
            multiple: true,
            selection:selection
        };

        //create the media frame
        multipleUpload = wp.media.frames.multipleUpload = wp.media(settings);

        multipleUpload.open();

        multipleUpload.on("update", function(){

            var lib = multipleUpload.states.get('gallery-edit').get('library');

            // Need to get all the attachment ids, names, urls for gallery
            var ids = lib.pluck('id');
            var url = lib.pluck('url');
            var names = lib.pluck('name');
            var numOfImages = ids.length;

            input.val(ids);
            imagesHolder.empty();

            for(var i=0;i<numOfImages;i++){
                imagesHolder.append('<img src="'+lib.models[i].changed.sizes.medium.url+'" alt="'+names[i]+'"/>');
            }
            holder.removeClass('one-button');
            removeButton.show();
        });

    }

	/**
	 * Initializes profile update
	 */
	function eltdInitUpdateProfile(){

		$('#eltd-profile-form').on('submit',function(e) {
			e.preventDefault();

			var ajaxData = {
				action: 'eltd_listing_update_user_profile',
				nonce : eltdUpdateProfile.nonce,
				post : $(this).serialize()
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: ElatedAjaxUrl,
				success: function (data) {
                    var response;
                    response = JSON.parse(data);  
                    
                    // append ajax response html
                    eltd.modules.common.eltdAjaxResponseMessageHtml(response);
				}
			});

			return false;

		});

	}

	/**
	 * Initializes user register
	 */
	function eltdUserRegister(){

		$('.eltd-register-form').on('submit',function(e) {
			var nonceField = $(this).find('.eltd-register-button-holder input[type="hidden"]').first();
			var nonce = nonceField.val();

			e.preventDefault();
			var ajaxData = {
				action: 'search_and_go_elated_user_register',
				security: nonce,
				post : $(this).serialize()
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: ElatedAjaxUrl,
				success: function (data) {
                    var response;
                    response = JSON.parse(data);
                    // append ajax response html
                    eltd.modules.common.eltdAjaxResponseMessageHtml(response);
				}
			});

			return false;

		});

	}

	function eltdAddListing(){
        var multiSelect = $('.eltd-multiselect-field');
        var select2Fields = $('.eltd-listing-select-field');
		if(multiSelect.length){
            multiSelect.select2({
                templateSelection: function (data) {
                    return $.trim(data.text);
                }
            });
        }
        if(select2Fields.length){
            select2Fields.select2();
        }
        
        

        var tagSelect = $('.eltd-listings-tags');
        if(tagSelect.length){
            tagSelect.select2({
                tags:true
            });
        }
        var ajaxResponseHolder = $('.eltd-listing-ajax-response-holder');
        
        $('.eltd-new-listing-form').on('submit',function(e) {
            
            var form = $(this);
			e.preventDefault();
                        
            //clear ajax response holder
            ajaxResponseHolder.empty();

			var post_array = form.serialize();
            var results = form.serializeArray(); //this is used for paypal data transfer
            
			if(tinyMCE.activeEditor != null) {
				if (tinyMCE.activeEditor.id === 'listing_content') {
					var newParams = {post_content: tinyMCE.activeEditor.getContent()};
					post_array = post_array + '&' + $.param(newParams);
				}
			} else {
                var content = $('#listing_content').val();
                var newParams = {post_content: content};
                post_array = post_array + '&' + $.param(newParams);
            }
			var ajaxData = {
				action: 'eltd_listing_add_listing',
				security: form.find('#eltd-add-listing-security').val(),
				post : post_array
			};
            
			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: ElatedAjaxUrl,
				success: function (data) {                  
                    var response = $.parseJSON(data);
                    
                    // append ajax response html
                    eltd.modules.common.eltdAjaxResponseMessageHtml(response);

                    if ( response.redirect !== '' ) {
                        setTimeout(function(){
                            window.location.href = response.redirect;
                        }, 500);
                    }

                    // trigger paypal request 
                    form.after(response.data);                    

                    setTimeout(function(){
                        eltdListingSubmitPayPalForm();
                    },800);

				}
			});

			return false;

		});

	}

	function eltdEditListing(){
		var multiSelect = $('.eltd-multiselect-field');
		if(multiSelect.length){
			multiSelect.select2({
				templateSelection: function (data) {
					return $.trim(data.text);
				}
			});
		}

		var tagSelect = $('.eltd-listings-tags');
		if(tagSelect.length){
			tagSelect.select2({
				tags:true
			});
		}

		$('.eltd-edit-listing-form').on('submit',function(e) {
			var form = $(this);
			e.preventDefault();

			var post_array = form.serialize();
			if(tinyMCE.activeEditor != null) {
				if (tinyMCE.activeEditor.id === 'listing_content') {
					var newParams = {post_content: tinyMCE.activeEditor.getContent()};
					post_array = post_array + '&' + $.param(newParams);
				}
			}
			var ajaxData = {
				action: 'eltd_listing_edit_listing',
				security: form.find('#eltd-edit-listing-security').val(),
				post : post_array
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: ElatedAjaxUrl,
				success: function (data) {
                    var response = $.parseJSON(data);
                    // append ajax response html
                    eltd.modules.common.eltdAjaxResponseMessageHtml(response);

                    if ( response.redirect !== '' ) {
                        setTimeout(function(){
                            window.location.href = response.redirect;
                        }, 500);
                    }

                    // trigger paypal request 
                    form.after(response.data);                    

                    setTimeout(function(){
                        eltdListingSubmitPayPalForm();
                    },800);
                    
				}
			});

			return false;

		});

	}

	function eltdResponseSuccess(data) {
		var response;

		response = JSON.parse(data);
		if(response.status === 'success') {
			//$('.eltd-ajax-response-message').text(response.message);
			alert(response.message);
			if(response.redirect != '') {
				window.location.href = response.redirect;
			}
		} else {
			//$('.eltd-ajax-response-message').text(response.message);
			alert(response.message);
		}

	}

	function eltdAddToWhislist(){

		$('.eltd-listing-whislist').on('click',function(e) {
            e.preventDefault();
			var listing = $(this),
                listingID;

			if(typeof listing.data('listing-id') !== 'undefined') {
				listingID = listing.data('listing-id');
			}

			eltdWhishlistAdding(listing, listingID);

		});

	}
    
    function eltdWhishlistAdding(listing, listingID){
        
        var ajaxData = {
				action: 'eltd_listing_add_listing_to_whislist',
				listingID : listingID
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: ElatedAjaxUrl,
				dataType: 'json',
				success: function (data) {
                    listing.attr('title',data.message);
                    listing.find('.eltd-wishlist-title').html(data.message);
                    if ( listing.hasClass('eltd-added-to-wishlist') ) {
                        listing.removeClass('eltd-added-to-wishlist');
                    } else {
                        listing.addClass('eltd-added-to-wishlist');
                    }
				}
			});

		return false;
        
    }

	function eltdInitAddressField() {
		var addressInput = document.getElementById('eltd-input-address'),
			map = document.getElementById('map'),
			latitudeInput = $('.eltd-latitude-holder input'),
			longitudeInput = $('.eltd-longitude-holder input');

		if ( addressInput ) {
			var lat = latitudeInput.val() !== '' ? parseFloat(latitudeInput.val()) : -33.8688,
				lng = longitudeInput.val() !== '' ? parseFloat(longitudeInput.val()) : 151.2195;

			//Init map
			var map = new google.maps.Map(map, {
				center: {lat: lat, lng: lng},
				zoom: 12
			});

            //Set map style
            map.setOptions({
                styles: eltdMapsVars.global.mapStyle
            });
            
			//Init marker
			var marker = new google.maps.Marker({
				map : map,
				draggable: true,
				position: {
					lat: lat, lng: lng
				}
			});
			//Init Places search
			var autocomplete = new google.maps.places.Autocomplete(addressInput);

			autocomplete.addListener('place_changed', function(){
				var place = autocomplete.getPlace(),
					location = place.geometry.location;

				latitudeInput.val(location.lat());
				longitudeInput.val(location.lng());
				map.setCenter(location);
				marker.setPosition(location);
			});

			marker.addListener('dragend', function(){
				var position = this.getPosition();
				latitudeInput.val(position.lat());
				longitudeInput.val(position.lng());
			});
		}
	}

	function eltdSaveCheckBoxesValueFront(){
		var checkboxes = $('.eltd-checkbox-field');

		checkboxes.change(function(){
			eltdDisableHiddenFront($(this));
		});
		checkboxes.each(function(){
			eltdDisableHiddenFront($(this));
		});
		function eltdDisableHiddenFront(thisBox){
			if(thisBox.is(':checked')){
				thisBox.siblings('.eltd-checkbox-field-hidden').prop('disabled', true);
			}else{
				thisBox.siblings('.eltd-checkbox-field-hidden').prop('disabled', false);
			}
		}
	}

	function eltdInitCommentRating() {
		var ratingInput = $('#eltd-rating'),
			ratingValue = ratingInput.val(),
			stars = $('.eltd-star-rating');

		var addActive = function() {
			for ( var i = 0; i < stars.length; i++ ) {
				var star = stars[i];
				if ( i < ratingValue ) {
					$(star).addClass('active');
				} else {
					$(star).removeClass('active');
				}
			}
		};

		addActive();

		stars.click(function(){
			ratingInput.val( $(this).data('value')).trigger('change');
		});

		ratingInput.change(function(){
			ratingValue = ratingInput.val();
			addActive();
		});

	}

    function eltdListingAdvancedSearchFields(){
        
        var typeSelect = $('.eltd-listing-adv-search-holder .eltd-listing-choose-type');
        var fieldContainer = $('.eltd-listing-adv-search-holder .eltd-listing-advanced-fields');
        var preloader = $('.eltd-listing-adv-search-holder .eltd-listing-adv-search-preloader');
        var submitButton = $('.eltd-listing-adv-search-holder .eltd-listing-advanced-submit');
        
        typeSelect.on('change', function(){
            
            submitButton.removeClass('show');
            preloader.show();
            fieldContainer.empty();
            
            var typeID = $(this).val();
            
            var ajaxData = {
                action: 'eltd_listing_advanced_search',
                typeID : typeID
            };            
            
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data);
                    var responseHtml =  response.html;
                    
                    fieldContainer.waitForImages(function(){    
                        fieldContainer.html(responseHtml); // Append the new content                        
                        eltdListingSelect2Fields();
                    });
                    
                    if(responseHtml !== ''){
                        submitButton.addClass('show');                        
                    }else{
                        submitButton.removeClass('show');
                    }
                    
                    
                }
            });
            
            setTimeout(function(){
                eltdGetAdvancedSearchAjaxResponse(typeID);
                preloader.hide();
            },300);
            
            
        });
        
    }

    function eltdListingAdvancedSearch(){
        
        var submitButton = $('.eltd-listing-adv-search-holder .eltd-listing-advanced-submit');
        var typeSelect = $('.eltd-listing-adv-search-holder .eltd-listing-choose-type');
        var preloader = $('.eltd-listing-adv-search-holder .eltd-listing-adv-search-preloader');
        
        submitButton.on('click', function(){
            
            preloader.show();
            var typeID = $(this).val();            
            setTimeout(function(){                
                eltdGetAdvancedSearchAjaxResponse(typeID);
                preloader.hide();
            }, 300);
           
            
        });
        
        
    }
    
    function eltdGetAdvancedSearchAjaxResponse( listingTypeID ){
        
        var advFieldHolder = $('.eltd-listing-adv-search-holder .eltd-listing-advanced-fields');
        var container = $('.eltd-listing-adv-search-holder .eltd-listing-articles-holder');
        
        
        container.empty();
        var searchParams = {};
        
        var typeID  = listingTypeID;
        
        searchParams['eltd_listing_item_type'] = typeID;

        var fields = advFieldHolder.find('.eltd-advanced-search-item');
        
        if(fields.length){
            
            fields.each(function(){

                var currentField = $(this).find('.eltd-advanced-search-input .eltd-advanced-input-field');
                var currentFieldId = currentField.attr('id');
                var currentFieldVal = currentField.val();
                searchParams[currentFieldId] = currentFieldVal;

            });            
            
            
        }
        
        var ajaxData = {
            action: 'eltd_listing_advanced_search_query',
            typeID: typeID,
            searchParams : searchParams
        };

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: ElatedAjaxUrl,
            success: function (data) {
                var response = $.parseJSON(data);
                var responseHtml =  response.html;

                container.waitForImages(function(){    
                    container.html(responseHtml); // Append the new content
                    eltdListingSelect2Fields();
                });
            }
        });
        
    }
    
    function eltdListingSelect2Fields(){
        
        var typeSelect = $('.eltd-listing-adv-search-holder .eltd-listing-choose-type').select2();
        var advancedSelect = $('.eltd-listing-adv-search-holder .listing-type-advanced-search').select2();
        
        var holder = $('.eltd-advanced-search-holder');
        var fieldsHolder = holder.find('.eltd-listing-archive-adv-search-holder');
        
        var archiveTypeSelect = fieldsHolder.find('.eltd-listing-archive-type').select2({
			//minimumResultsForSearch: Infinity,
			placeholder: ''
		});
        var archiveCategorySelect = fieldsHolder.find('.eltd-listing-archive-category').select2({
			minimumResultsForSearch: Infinity,
			placeholder: ''
		});
        var archiveLocationSelect  = fieldsHolder.find('.eltd-listing-archive-location').select2({
			//minimumResultsForSearch: Infinity,
			placeholder: ''
		});
		var archiveSortSelect  = fieldsHolder.find('.eltd-listing-archive-sort').select2({
			minimumResultsForSearch: Infinity,
			placeholder: ''
		});
       
        var dashboardSelectFields = $('.eltd-listing-dashboard-holder-outer .eltd-profile-input select');
        if(dashboardSelectFields.length){

            dashboardSelectFields.each(function(){

               $(this).select2();

            });
            
        }
        var dashboardChooseType = $('.eltd-listing-dashboard-holder-outer .eltd-profile-input select.eltd-listing-type-select-field');
        dashboardChooseType.select2({
            minimumResultsForSearch: Infinity,
            placeholder: ''
        }); 
        
        var dashboardChoosePackage = $('.eltd-listing-dashboard-holder-outer .eltd-profile-input select.eltd-listing-select-package');
        dashboardChoosePackage.select2({
            minimumResultsForSearch: Infinity,
            placeholder: ''
        });
    }    
    
    function eltdListingSubmitPayPalForm(){
        
        var payPalForm = $('#eltd-paypal-payment-form');
        payPalForm.submit();
        
    }

    function eltdDeleteMyListing() {
        var delBtn = $('.eltd-delete-listing');
        delBtn.click(function(e){
            e.preventDefault();
            var btn = $(this),
                listingId = btn.data('listing-id'),
                result = confirm('Are you sure you want to delete this listing item?');
            if ( result ) {
                var data = {
                    action: 'eltd_listing_delete_listing',
                    listingId: listingId
                };
                $.ajax({
                    type: 'POST',
                    data: data,
                    url: ElatedAjaxUrl,
                    success: function(data) {
                        btn.parents('.eltd-user-listing').fadeOut(300);
                    }
                });
            }
        });
    }

	function eltdInitListingEnquiryForm() {

		var enquiryForm = $('#eltd-listing-enquiry-form');
		enquiryForm.submit(function(e){
			e.preventDefault();
			var enquiryData = {
				name: enquiryForm.find('#enquiry-name').val(),
				email: enquiryForm.find('#enquiry-email').val(),
				phone: enquiryForm.find('#enquiry-phone').val(),
				message: enquiryForm.find('#enquiry-message').val(),
				itemId: enquiryForm.find('#enquiry-item-id').val(),
				nonce: enquiryForm.find('#eltd_nonce_listing_item_enquiry').val()
			};

			var requestData = {
				action: 'search_and_go_elated_send_listing_item_enquiry',
				data: enquiryData
			};

			
			$.ajax({
				type: 'POST',
				data: requestData,
				url: ElatedAjaxUrl,
				success: function( response ) {
					if ( response.success ) {
						enquiryForm.fadeOut(300);
						setTimeout(function(){
							enquiryForm.remove();
						}, 300);
                        eltd.modules.common.eltdAjaxResponseMessageHtml({
							status: 'success',
							message: response.data
						});
					} else {
						eltd.modules.common.eltdAjaxResponseMessageHtml({
							status: 'error',
							message: response.data
						});
					}
				}
			});

		});

	}
    
    function eltdListingArchiveKeyWordSearch(){
        
        var holder = $('.eltd-advanced-search-holder');
		var emptyParam = '';
        var archiveKeywordFiels = holder.find('.eltd-listing-archive-keyword');
        var availableTags = eltdGlobalVars.vars.postTitles;
        
        archiveKeywordFiels.autocomplete({
            source: availableTags
        });
        
        
        
        archiveKeywordFiels.on('autocompleteclose', function(){
			holder.data('listing-next-page', 2);
            setTimeout(function(){
                eltdListingArchiveGetAjaxResponse(emptyParam);
            },300);
        });
        
        archiveKeywordFiels.on('click', function(){
			holder.data('listing-next-page', 2);
            var keywordValue = archiveKeywordFiels.val(); 
           
            if( keywordValue !== '' ){
                
                //check if user enter some other value then predefined values
                if( ($.inArray(keywordValue,availableTags ) === -1) ){
                    
                    setTimeout(function(){
                        eltdListingArchiveGetAjaxResponse(emptyParam);
                    },300);
                    
                }
                
            }
            
        });
        
    }
    
    function eltdListingArchiveTypeChange(){
       
        var holder = $('.eltd-advanced-search-holder');
        var typeSelect = holder.find('.eltd-listing-archive-type');
		var selectedValue = holder.find('.eltd-listing-archive-type :selected');
		var typeID;
        if (holder.length){

			if(typeof selectedValue !== 'undefined' && selectedValue !== '' ){
				typeID = selectedValue.val();
				eltdListingArchiveTypeAjaxResponse(typeID);
			}

            typeSelect.on('change', function(){

                holder.data('listing-next-page', 2);
                typeID = $(this).val();
				eltdListingArchiveTypeAjaxResponse(typeID);

            });
            eltdInitListingCheckboxesStyle();
        }
       
   }

	function eltdListingArchiveTypeAjaxResponse(typeID){

		var holder = $('.eltd-advanced-search-holder');
		var amenitiesHolder = holder.find('.eltd-listing-archive-amenities-holder');
		var amenitiesTitle = holder.find('.eltd-listing-archive-amenities-title');
		var emptyParam = '';

		holder.data('listing-next-page', 2);

		var ajaxData = {
			action: 'search_and_go_elated_archive_adv_search_fields',
			typeID : typeID
		};

		$.ajax({
			type: 'POST',
			data: ajaxData,
			url: ElatedAjaxUrl,
			success: function (data) {
				var response = $.parseJSON(data);
				var responseHtml =  response.html;

				amenitiesHolder.waitForImages(function(){
					if (responseHtml !== '') {
						amenitiesTitle.fadeIn(300);
					} else {
						amenitiesTitle.fadeOut(100);
					}
					amenitiesHolder.empty();
					if ( responseHtml !== '' ) {
						amenitiesHolder.fadeIn(300);
					} else {
						amenitiesHolder.fadeOut(300);
					}
					amenitiesHolder.html(responseHtml); // Append the new content

					// call ajax advanced search functionality
					eltdListingArchiveGetAjaxResponse(emptyParam);

					eltdListingSelect2Fields();

					//call listener function for amenities
					eltdListingArchiveAmenitiesSearch();

				});

			}
		});

	}

    function eltdListingArchiveAmenitiesSearch(){
       
        var holder = $('.eltd-advanced-search-holder');
        var amenitiesHolder = holder.find('.eltd-listing-archive-amenities-holder');
        var fields = amenitiesHolder.find('.eltd-listing-archive-advanced-search-amenity');
        var emptyParam = '';
        if(fields.length){
           fields.each(function(){
               
                var currentField = $(this).find('.eltd-advanced-input-field');
                currentField.on('change', function(){
					holder.data('listing-next-page', 2);
                    setTimeout(function(){
                        eltdListingArchiveGetAjaxResponse(emptyParam);
                    },300); 
                   
                });               
               

           });            


        }
   }

    function eltdListingArchiveLocationChange(){

        var holder = $('.eltd-advanced-search-holder');
        var locationSelect = holder.find('.eltd-listing-archive-location');
		var emptyParam = '';
        locationSelect.on('change', function(){
			holder.data('listing-next-page', 2);
            setTimeout(function(){
				eltdMultipleMapVars.multiple.addresses.clear();
                eltdListingArchiveGetAjaxResponse(emptyParam);
            },300); 
            
        });
       
   }

	function eltdListingArchiveSortChange(){

		var holder = $('.eltd-advanced-search-holder');
		var orderBySelect = holder.find('.eltd-listing-archive-sort');
		var emptyParam = '';
		orderBySelect.on('change', function(){
			holder.data('listing-next-page', 2);
			setTimeout(function(){
				eltdListingArchiveGetAjaxResponse(emptyParam);
			},300);

		});

	}

	function eltdInitListingLoadMoreButtonShowing(){

		var holder = $('.eltd-advanced-search-holder');
		var button = $('.eltd-listing-archive-load-more');

		var maxNumPages = holder.data('listing-max-num-pages');
		var nextPage = holder.data('listing-next-page');
		if(nextPage <= maxNumPages){
			button.show();
		}

		if(nextPage === maxNumPages){
			button.hide();
		}

	}

	function eltdListingArchiveLoadMore(){
		var holder = $('.eltd-advanced-search-holder');
		var button = $('.eltd-listing-archive-load-more');

		button.on('click', function(e){

			e.preventDefault();
			e.stopPropagation();
			var maxNumPages = holder.data('listing-max-num-pages');
			var nextPage = holder.data('listing-next-page');
			if(nextPage <= maxNumPages){
				eltdListingArchiveGetAjaxResponse(nextPage);
			}else{
				button.hide();
			}

		});

	}

    function eltdListingArchiveGetAjaxResponse(nextPage){

		var holder = $('.eltd-advanced-search-holder');
		var nextListingPage;
		var loadMoreFlag = false;
		var button = $('.eltd-listing-archive-load-more');

		if(nextPage === '' || nextPage === 'undefined' ){
			nextListingPage = '';
		}
		else{
			nextListingPage = nextPage;
			loadMoreFlag = true;
		}

        var searchParams = {};

        var mapFlag;
        
        if( holder.hasClass('eltd-listing-list-without-map') ){
            mapFlag = false;
        }else{
            mapFlag = true;
        }
        
        var container = holder.find('.eltd-listing-list-items');
        
        var typeSelect = holder.find('.eltd-listing-archive-type');
        var locationSelect = holder.find('.eltd-listing-archive-location');
        var keywordField = holder.find('.eltd-listing-archive-keyword');
        
        var amenitiesHolder = holder.find('.eltd-listing-archive-amenities-holder');
        var fields = amenitiesHolder.find('.eltd-listing-archive-advanced-search-amenity');
       	var postCountHolder = $('.eltd-listing-archive-adv-search-count .eltd-number');

        if(fields.length){

            fields.each(function(){

               var currentField = $(this).find('.eltd-advanced-input-field');
               var currentFieldId = currentField.attr('id');

               var currentFieldVal = currentField.is(':checked');
               searchParams[currentFieldId] = currentFieldVal;

            });

       }

		//order and order by values
		var sort = holder.find('.eltd-listing-archive-sort').val();

        var postPerPage =  holder.data('listing-number-per-page');
		var pageNumber;
		var ajaxData = {
            action: 'search_and_go_elated_archive_adv_search_query',
            locationID : locationSelect.val(),
            typeID : typeSelect.val(),
            searchParams : searchParams,
            searchKeyword : keywordField.val(),
            mapFlag: mapFlag,
			postPerPage: postPerPage,
			nextPage: nextListingPage,
			sort: sort,
			loadMoreFlag: loadMoreFlag
        };

        $.ajax({
            type: 'GET',
            data: ajaxData,
            url: ElatedAjaxUrl,
            success: function (data) {
                var response = $.parseJSON(data);
                eltdListingChangeUrl( response.href );
                var responseHtml =  response.html;
                var mapData = response.mapData;
                var postCount = response.postCount;
				var maxNumPages = response.maxNumPages;

				if(loadMoreFlag){
                    if (mapFlag) {
                        //Get all map data from map and append new data
                        var existingMarkers = eltdMultipleMapVars.multiple.addresses;
                        existingMarkers = existingMarkers.concat(mapData);
                        eltdMultipleMapVars.multiple.addresses = existingMarkers;
                        mapData = eltdMultipleMapVars.multiple.addresses;
                    }

                    nextListingPage++;
					holder.data('listing-next-page', nextListingPage);
					pageNumber = nextListingPage;
				}else{
					if (mapFlag) {
						//Replace map data after each iteration
						eltdMultipleMapVars.multiple.addresses = mapData;
					}
					pageNumber = holder.data('listing-next-page');
				}

				holder.data('listing-max-num-pages', maxNumPages);
                
                if(mapFlag === true){
                    eltd.modules.maps.eltdGoogleMaps.getDirectoryItemsAddresses({
                        addresses: mapData
                    });
                }

                container.waitForImages(function(){
					if(loadMoreFlag){
						container.find('article').last().after(responseHtml); // Append the new content
					}else{
						container.html(responseHtml); // Append the new content
					}
                    postCountHolder.html(postCount);
                    eltdListingSelect2Fields();
                    eltd.modules.common.eltdInitHovers();
                    eltdBindTitles();
                });
				//show button
				if(pageNumber <= maxNumPages){
					button.show();
				}else{
					button.hide();
				}
            }
        });

       eltdListingArchiveInitBack();
       
   }

    function eltdListingChangeUrl( url ) {

        var currentUrl = location.href;
        if (location.href.match(/\?.*/)) {
            currentUrl = location.href.replace(/\?.*/, '');;
        }
        window.history.pushState({page: currentUrl + url}, '', currentUrl + url);

    }

    function eltdListingArchiveInitBack() {

        window.addEventListener("popstate", function(e) { // if a back or forward button is clicked
            location.reload();
        });

    }

    function eltdInitListingGallery() {

        var listingGallery = $('.eltd-listing-gallery');
        if ( listingGallery.length ) {
            listingGallery.slick({
                speed: 800,
                easing:'easeOutQuint',
                nextArrow: '<span class="eltd-gallery-arrow left lnr lnr-chevron-left"></span>',
                prevArrow: '<span class="eltd-gallery-arrow right lnr lnr-chevron-right"></span>',
                variableWidth: true,
                slidesToShow: 2
            });
        }

    }

    function eltdInitListingCheckboxesStyle() {

        var checkboxes = $('input[type="checkbox"]');
        checkboxes.each(function (){
            var self = $(this);
            if (self.prop('checked')) {
                self.parent('.eltd-label-holder').prev().children('.eltd-listing-checkbox-input, .eltd-listing-amenity-input').addClass('active');
            }
        });
        $(document).on('click', '.eltd-listing-checkbox-input, .eltd-listing-amenity-input', function (){
            var self = $(this);
            self.toggleClass('active');
            var checkbox = self.parent('.eltd-checkbox-holder').next().children('.eltd-checkbox-field, .eltd-advanced-input-field');
            checkbox.prop( 'checked', !checkbox.prop( 'checked' )).change();
        });

    }
    function eltdInitSocialProfilesInput() {

        var openers = $('.eltd-social-profiles-icon');
        if ( openers.length ) {
            openers.each(function(){
                var opener = $(this);
                opener.click(function(){
                    var id = opener.data('input');
                    if ( opener.hasClass('active') ) {
                        opener.removeClass('active');
                    } else {
                        opener.addClass('active');
                    }
                    //Find input holder with same class and display it
                    var input = $('.eltd-social-profiles-input.'+id);
                    if ( input.is(':visible') ) {
                        input.fadeOut(300);
                    } else {
                        input.fadeIn(300);
                    }
                });
            });
        }

    }


    function eltdBindTitles() {
        var maps = $('.eltd-map-holder'),
            lists = $('.eltd-listing-list'); 
        if (maps.length && lists.length){
            maps.each(function(){
                var  listItems = lists.find('.eltd-listing-list-item');

                listItems.each(function(){
                    var listItem = $(this);
                    listItem.mouseenter(function(){
                        var itemId = listItem.attr('id');
                        if ($('.eltd-map-marker-holder').length) {
                            $('.eltd-map-marker-holder').each(function(){
                                var markerHolder = $(this),
                                    markerId = markerHolder.attr('id');
                                    if (itemId == markerId) {
                                        markerHolder.addClass('active');
                                        setTimeout(function(){
                                        },300);
                                    } else {
                                        markerHolder.removeClass('active');
                                    }
                            });
                        }
                    });
                });

                lists.mouseleave(function(){
                    $('.eltd-map-marker-holder').removeClass('active');
                });
            });
        }
    }

}(jQuery));