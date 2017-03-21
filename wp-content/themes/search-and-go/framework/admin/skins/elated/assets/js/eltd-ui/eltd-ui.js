(function($){
    $(document).ready(function() {
        //plugins init goes here
        eltdInitSelectChange();
        eltdInitSwitch();
        eltdInitTooltips();
        eltdInitColorpicker();
        eltdInitRangeSlider();
        eltdInitMediaUploader();
        eltdInitGalleryUploader();
        eltdRepeater();
        if ($('.eltd-page-form').length > 0) {
            eltdInitAjaxForm();
            eltdScrollToAnchor();
            eltdScrollToAnchorSelect();
            eltdAnchorSelectOnLoad();
            initTopAnchorHolderSize();
            eltdCheckVisibilityOfAnchorButtons();
            eltdCheckVisibilityOfAnchorOptions();
            eltdCheckAnchorsOnDependencyChange();
            eltdCheckOptionAnchorsOnDependencyChange();
            eltdChangedInput();
            eltdFixHeaderAndTitle();
            totop_button();
            backButtonShowHide();
            backToTop();
            eltdInitSelectPicker();
        }
        eltdInitPortfolioImagesVideosBox();
        eltdInitPortfolioMediaAcc();
        eltdInitPortfolioItemsBox();
        eltdInitPortfolioItemAcc();
        eltdInitDatePicker();
		eltdShowHidePostFormats();
        eltdPageTemplatesMetaBoxDependency();
        eltdCreateCustomField();
        eltdInitCustomFieldCreator();
        eltdInitAddressField();
        eltdSaveCheckBoxesValue();
        eltdCustomFieldIconsDependency();
    });

    function eltdCreateCustomField(){
        var customField = $('.eltd-add-custom-field');
        if(customField.length){
            customField.on('click',function(){
                var thisField = $(this);
                var parent = thisField.parents('.container-fluid');
                var data = {
                    type: thisField.data('type'),
                    action: 'search_and_go_elated_get_custom_field_html',
                    index:$('.eltd-select-custom-field').length
                };
                $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: data,
                    success: function (response) {
                        if (response === 'error') {
                            //error handler
                        }else{

                            parent.append(response);
                            eltdRepeater();
                            eltdCustomFieldIconsDependency();
                            //loader if any should be hidden here
                        }
                    }
                });
                return false;
            });
        }
    }

    /**
     Custom Field Creator script - start
     */

    function eltdInitCustomFieldCreator() {
        //remove custom-field item
        $(document).on('click', '.remove-custom-field-item', function(event) {
            event.preventDefault();
            var toggleHolder = $(this).parent().parent().parent();
            toggleHolder.fadeOut(300,function() {
                $(this).remove();
                //after removing custom-field, set new names
                var selectBoxes = $('.eltd-select-custom-field');
                selectBoxes.each(function(counter) {
                    $(this).find('.eltd-repeater-field :input').each(function(){
                    var name = $(this).attr('name');
                    $(this).attr('name', function () {
                        return name.replace(/\d+/,counter);
                    });
                });
            });
                //hide expand all button if all items are removed
                noSlideElementItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noSlideElementItemShown();
        function noSlideElementItemShown()  {
            if($('.eltd-custom-item').length == 0){
                $('.eltd-toggle-all-custom-item').hide();
            }
        }

        //expand all additional items on click on 'expand all' button
        $(document).on('click', '.eltd-toggle-all-custom-item', function(event) {
            event.preventDefault();
            $('.eltd-custom-item').each(function(i){

                var $toggleContent = $(this).find('.eltd-custom-field-toggle-content');
                var $this = $(this).find('.toggle-custom-field-item');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }
            });
            return false;
        });
        //toggle for custom-field item
        $(document).on('click', '.eltd-custom-item .eltd-custom-field-toggle-holder', function(event) {
            event.preventDefault();

            var thisBtn = $(this);
            var caretHolder = thisBtn.find('.toggle-custom-field-item');
            caretHolder.html('<i class="fa fa-caret-up"></i>');
            var toggleContent = thisBtn.next();
            toggleContent.slideToggle(function() {
                if (toggleContent.is(':visible')) {
                    caretHolder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    caretHolder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click','.eltd-toggle-all-custom-item', function(event) {
            event.preventDefault();
            $(this).hide();
        });        

        function checkExpandAllBtn() {
            if($('.eltd-custom-item .eltd-custom-field-toggle-content:hidden').length == 0){ console.log('test');
                $('.eltd-toggle-all-custom-item').hide();
            }else{
                $('.eltd-toggle-all-custom-item').show();
            }
        }

    }

    function eltdSaveCheckBoxesValue(){
        var checkboxes = $('.eltd-single-checkbox-field');
        checkboxes.change(function(){
            eltdDisableHidden($(this));
        });
        checkboxes.each(function(){
            eltdDisableHidden($(this));
        });
        function eltdDisableHidden(thisBox){
            if(thisBox.is(':checked')){
                thisBox.siblings('.eltd-single-checkbox-field-hidden').prop('disabled', true);
            }else{
                thisBox.siblings('.eltd-single-checkbox-field-hidden').prop('disabled', false);
            }
        }
    }

    function eltdRepeater(){
        var addNew = $('.eltd-repeater-add .eltd-clone'); // add new button
        var removeBtn = $('.eltd-clone-remove');
        if (addNew.length) {
            $('.eltd-repeater-fields-holder').each(function(){
                var thisHolderRows = $(this).find('.eltd-repeater-fields-row');
                if(thisHolderRows.length == 1 && thisHolderRows.find(':input').val() == ''){
                    thisHolderRows.hide();
                }
            });
            addNew.on('click', function (e) {
                e.preventDefault();
                var thisAddNew = $(this);
                var append = true; // flag for showing or appending new row
                var fieldsHolder = thisAddNew.parent().siblings('.eltd-repeater-fields-holder'); // container of all rows - parent to append new row
                var rows = fieldsHolder.find('.eltd-repeater-fields-row');
                if (rows.length == 1 && rows.css('display') == 'none') {
                    rows.show();
                    append = false;
                }
                if (append) {
                    var rowIndex = thisAddNew.data('count'); // number of rows for changing id stored as data of add new button
                    var firstChild = rows.eq(0).clone(); // clone first row
                    var colorPicker = false; // flag for initializing color picker - calling wpColorPicker
                    var mediaUploader = false; // flag for initializing media uploader - calling wpColorPicker

                    firstChild.find('.eltd-repeater-field').each(function () {
                            var thisField = $(this);
                            var id = thisField.attr('id');
                            if (typeof id !== 'undefined') {
                                thisField.attr('id', id.slice(0, -1) + rowIndex); // change id - first row will have 0 as the last char
                            }
                            thisField.find(':input').each(function () {
                                var thisInput = $(this);
                                if (thisInput.hasClass('my-color-field')) { // if input type is color picker
                                    thisInput.parents('.wp-picker-container').html(thisInput); // overwrite added html with field html- wpColorPicker adds it on initialization
                                    colorPicker = true;
                                }
                                else if (thisInput.hasClass('eltd-media-upload-url')) {// if input type is media uploader
                                    mediaUploader = true;
                                    var btn = thisInput.parent().siblings('.eltd-media-remove-btn');
                                    eltdInitMediaRemoveBtn(btn); // get and init new remove btn
                                    btn.trigger('click'); // trigger click to reset values
                                }
                                thisInput.val('').removeAttr('checked').removeAttr('selected'); //empty fields values
                                if(thisInput.is(':radio')){
                                    thisInput.val(fieldsHolder.find(':radio').length);
                                }
                            });
                        }
                    );

                    thisAddNew.data('count', rowIndex + 1); //increase number of rows
                    firstChild.appendTo(fieldsHolder); // append html
                    removeRow($('.eltd-clone-remove'));
                    if (colorPicker) { // reinit colorpickers
                        $('.eltd-page .my-color-field').wpColorPicker();
                    }
                    if (mediaUploader) {
                        // deregister click on all media buttons (multiple frames will be opened otherwise)
                        $('.eltd-media-uploader').off('click', '.eltd-media-upload-btn');
                        eltdInitMediaUploader();
                    }

                }
            });
        }
        if (removeBtn.length) {
            removeRow(removeBtn);
        }

        function removeRow(removeBtn){
            removeBtn.on('click', function (e) {
                e.preventDefault();
                var thisRemoveBtn = $(this);
                var parentRow = thisRemoveBtn.parents('.eltd-repeater-fields-row');
                if (parentRow.is(':first-child') && thisRemoveBtn.parents('.eltd-repeater-fields-holder').find('.eltd-repeater-fields-row').length == 1) {
                    parentRow.find(':input').val('').removeAttr('checked').removeAttr('selected');
                    parentRow.hide();
                } else if(!parentRow.is(':first-child')) {
                    parentRow.remove();
                }
            });
        }
    }

    function eltdFixHeaderAndTitle () {
        var pageHeader 				= $('.eltd-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
        var pageTitle				= $('.eltd-page-title-holder');
        var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
        var tabsNavWrapper			= $('.eltd-tabs-navigation-wrapper');
        var tabsNavWrapperTop		= pageHeaderHeight;
        var tabsContentWrapper	    = $('.eltd_ajax_form');
        var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

        $(window).on('scroll load', function() {
            if($(window).scrollTop() >= pageHeaderTopPosition) {
                pageHeader.addClass('eltd-header-fixed');
                pageTitle.addClass('eltd-page-title-fixed').css('top', pageTitleTopPosition);
                tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
                tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
            } else {
                pageHeader.removeClass('eltd-header-fixed');
                pageTitle.removeClass('eltd-page-title-fixed').css('top', 0);
                tabsNavWrapper.css('marginTop', 0);
                tabsContentWrapper.css('marginTop', 0);
            }
        });
    }

    function initTopAnchorHolderSize() {
        function initTopSize() {
            $('.eltd-top-section-holder-inner').css({
                'width' : $('.eltd-top-section-holder').width()
            });
            $('.eltd-page-title-holder').css({
                'width' : $('.eltd-page-section-title:visible').outerWidth()- 2*parseInt($('.eltd-page-title-holder').css('marginLeft'))
            });
        };
        initTopSize();

        $(window).on('resize', function() {
            initTopSize();
        });
    }

    function eltdScrollToAnchor () {
        $('#anchornav a').click( function() {
            eltdScrollToPanel($(this).attr('href'));
        });
    }

    function eltdScrollToAnchorSelect() {
        var selectAnchor = $('#eltd-select-anchor');
        selectAnchor.on('change', function() {
            var selectAnchor = $('option:selected', selectAnchor);

            if(typeof selectAnchor.data('anchor') !== 'undefined') {
                eltdScrollToPanel(selectAnchor.data('anchor'));
            }
        });
    }

    function eltdAnchorSelectOnLoad() {
        var currentPanel = window.location.hash;
        if(currentPanel) {
            var selectAnchor = $('#eltd-select-anchor');
            var currentOption = selectAnchor.find('option[data-anchor="'+currentPanel+'"]').first();

            if(currentOption) {
                currentOption.attr('selected', 'selected');
            }
        }

    }

    function eltdScrollToPanel(panel) {
        var pageHeader 				= $('.eltd-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageTitle				= $('.eltd-page-title-holder');
        var pageTitleHeight			= pageTitle.outerHeight();

        var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;

        $('html, body').animate({
            scrollTop: panelTopPosition
        }, 1000);

        return false;
    }

    function totop_button(a) {
        "use strict";

        var b = $("#back_to_top");
        b.removeClass("off on");
        if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
    }

    function backButtonShowHide(){
        "use strict";

        $(window).scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
        });
    }

    function backToTop(){
        "use strict";

        $(document).on('click','#back_to_top',function(){
            $('html, body').animate({
                scrollTop: $('html').offset().top}, 1000);
            return false;
        });
    }


    function eltdChangedInput () {
        $('.eltd-tabs-content form.eltd_ajax_form:not(.eltd-import-page-holder)').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
            $('.eltd-input-change').addClass('yes');
        });
        $('.eltd-tabs-content form.eltd_ajax_form:not(.eltd-import-page-holder) .field.switch label:not(.selected)').click( function() {
            $('.eltd-input-change').addClass('yes');
        });
        $(window).on('beforeunload', function () {
            if ($('.eltd-input-change.yes').length) {
                return 'You haven\'t saved your changes.';
            }
        });
        $('.eltd-tabs-content form.eltd_ajax_form:not(.eltd-import-page-holder) #anchornav input').click(function() {
            if ($('.eltd-input-change.yes').length) {
                $('.eltd-input-change.yes').removeClass('yes');
            }
            $('.eltd-changes-saved').addClass('yes');
            setTimeout(function(){$('.eltd-changes-saved').removeClass('yes');}, 3000);
        });
    }

    function eltdCheckVisibilityOfAnchorButtons () {

        $('.eltd-page-form > div:hidden').each( function() {
            var $panelID =  $(this).attr('id');
            $('#anchornav a').each ( function() {
                if ($(this).attr('href') == '#'+$panelID) {
                    $(this).parent().hide();//hide <li>s
                }
            });
        })
    }

    function eltdCheckVisibilityOfAnchorOptions() {
        $('.eltd-page-form > div:hidden').each( function() {
            var $panelID =  $(this).attr('id');
            $('#eltd-select-anchor option').each ( function() {
                if ($(this).data('anchor') == '#'+$panelID) {
                    $(this).hide();//hide <li>s
                }
            });
        })
    }

    function eltdGetArrayOfHiddenElements(changedElement) {
        var hidden_elements_string = changedElement.data('hide');
        hidden_elements_array = [];
        if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function eltdGetArrayOfShownElements(changedElement) {
        //check for links to show
        var shown_elements_string = changedElement.data('show');
        shown_elements_array = [];
        if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }
	
	function eltdGetArrayOfHiddenElementsSelectBox(changedElement,changedElementValue) {
        var hidden_elements_string = changedElement.data('hide-'+changedElementValue);
        hidden_elements_array = [];
        if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function eltdGetArrayOfShownElementsSelectBox(changedElement,changedElementValue) {
        //check for links to show
        var shown_elements_string = changedElement.data('show-'+changedElementValue);
        shown_elements_array = [];
        if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }
	
    function eltdCheckAnchorsOnDependencyChange(){
        $(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
            hidden_elements_array = eltdGetArrayOfHiddenElements($(this));
            shown_elements_array  = eltdGetArrayOfShownElements($(this));

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#anchornav a').each ( function() {

                    if ($(this).attr('href') == value) {
                        $(this).parent().hide();//hide <li>s
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#anchornav a').each ( function() {
                    if ($(this).attr('href') == value) {
                        $(this).parent().show();//show <li>s
                    }
                });
            });
        });
		
		
		$(document).on('change','.eltd-form-element.dependence',function(){
            hidden_elements_array = eltdGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = eltdGetArrayOfShownElementsSelectBox($(this),$(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#anchornav a').each ( function() {

                    if ($(this).attr('href') == value) {
                        $(this).parent().hide();//hide <li>s
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#anchornav a').each ( function() {
                    if ($(this).attr('href') == value) {
                        $(this).parent().show();//show <li>s
                    }
                });
            });
        });
    }

    function eltdCheckOptionAnchorsOnDependencyChange() {
        $(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
            hidden_elements_array = eltdGetArrayOfHiddenElements($(this));
            shown_elements_array  = eltdGetArrayOfShownElements($(this));

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#eltd-select-anchor option').each ( function() {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#eltd-select-anchor option').each ( function() {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#eltd-select-anchor').selectpicker('refresh');
        });
		
		$(document).on('change','.eltd-form-element.dependence',function(){
            hidden_elements_array = eltdGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = eltdGetArrayOfShownElementsSelectBox($(this),$(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#eltd-select-anchor option').each ( function() {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#eltd-select-anchor option').each ( function() {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#eltd-select-anchor').selectpicker('refresh');
        });
    }

    function checkBottomPaddingOfFormWrapDiv(){
        //check bottom padding of form wrap div, since bottom holder is changing its height because of the info messages
        setTimeout(function(){
            $('.eltd-page-form').css('padding-bottom', $('.form-button-section').height());
        },350);
    }




    function eltdInitSelectChange() {
        $('select.dependence').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value.replace(/ /g, '');
            $($(this).data('hide-'+valueSelected)).fadeOut();
            $($(this).data('show-'+valueSelected)).fadeIn();
        });
    }

    function eltdInitSwitch() {
        $(".cb-enable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-disable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', true);
            $('.checkboxhidden_yesno',parent).val("yes");
            $('.checkboxhidden_onoff',parent).val("on");
            $('.checkboxhidden_portfoliofollow',parent).val("portfolio_single_follow");
            $('.checkboxhidden_zeroone',parent).val("1");
            $('.checkboxhidden_imagevideo',parent).val("image");
            $('.checkboxhidden_yesempty',parent).val("yes");
            $('.checkboxhidden_flagpost',parent).val("post");
            $('.checkboxhidden_flagpage',parent).val("page");
            $('.checkboxhidden_flagmedia',parent).val("attachment");
            $('.checkboxhidden_flagportfolio',parent).val("portfolio_page");
            $('.checkboxhidden_flagproduct',parent).val("product");
        });
        $(".cb-disable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-enable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', false);
            $('.checkboxhidden_yesno',parent).val("no");
            $('.checkboxhidden_onoff',parent).val("off");
            $('.checkboxhidden_portfoliofollow',parent).val("portfolio_single_no_follow");
            $('.checkboxhidden_zeroone',parent).val("0");
            $('.checkboxhidden_imagevideo',parent).val("video");
            $('.checkboxhidden_yesempty',parent).val("");
            $('.checkboxhidden_flagpost',parent).val("");
            $('.checkboxhidden_flagpage',parent).val("");
            $('.checkboxhidden_flagmedia',parent).val("");
            $('.checkboxhidden_flagportfolio',parent).val("");
            $('.checkboxhidden_flagproduct',parent).val("");
        });
        $(".cb-enable.dependence").click(function(){
            $($(this).data('hide')).fadeOut();
            $($(this).data('show')).fadeIn();
        });
        $(".cb-disable.dependence").click(function(){
            $($(this).data('hide')).fadeOut();
            $($(this).data('show')).fadeIn();
        });
    }

    function eltdInitTooltips() {
        $('.eltd-tooltip').tooltip();
    }

    function eltdInitColorpicker() {
        $('.eltd-page .my-color-field').wpColorPicker({
            change:    function( event, ui ) {
                $('.eltd-input-change').addClass('yes');
            }
        });
    }

    /**
     * Function that initializes
     */
    function eltdInitRangeSlider() {
        if($('.eltd-slider-range').length) {

            $('.eltd-slider-range').each(function() {
                var Link = $.noUiSlider.Link;

                var start       = 0;            //starting position of slider
                var min         = 0;            //minimal value
                var max         = 100;          //maximal value of slider
                var step        = 1;            //number of steps to snap to
                var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
                var prefix      = '';           //prefix to the serialized value that is written field
                var postfix     = '';           //postfix to the serialized value that is written to field
                var thousand    = '';           //separator for thousand
                var decimals    = 2;            //number of decimals
                var mark        = '.';          //decimal separator

                //is data-start attribute set for current instance?
                if($(this).data('start') != null && $(this).data('start') !== "" && $(this).data('start') != "0.00") {
                    start = $(this).data('start');
                    if (start == "1.00") start = 1;
                    if(parseInt(start) == start){
                        start = parseInt(start);
                    }
                }

                //is data-min attribute set for current instance?
                if($(this).data('min') != null && $(this).data('min') !== "") {
                    min = $(this).data('min');
                }

                //is data-max attribute set for current instance?
                if($(this).data('max') != null && $(this).data('max') !== "") {
                    max = $(this).data('max');
                }

                //is data-step attribute set for current instance?
                if($(this).data('step') != null && $(this).data('step') !== "") {
                    step = $(this).data('step');
                }

                //is data-orientation attribute set for current instance?
                if($(this).data('orientation') != null && $(this).data('orientation') !== "") {
                    //define available orientations
                    var availableOrientations = ['horizontal', 'vertical'];

                    //is data-orientation value in array of available orientations?
                    if(availableOrientations.indexOf($(this).data('orientation'))) {
                        orientation = $(this).data('orientation');
                    }
                }

                //is data-prefix attribute set for current instance?
                if($(this).data('prefix') != null && $(this).data('prefix') !== "") {
                    prefix = $(this).data('prefix');
                }

                //is data-postfix attribute set for current instance?
                if($(this).data('postfix') != null && $(this).data('postfix') !== "") {
                    postfix = $(this).data('postfix');
                }

                //is data-thousand attribute set for current instance?
                if($(this).data('thousand') != null && $(this).data('thousand') !== "") {
                    thousand = $(this).data('thousand');
                }

                //is data-decimals attribute set for current instance?
                if($(this).data('decimals') != null && $(this).data('decimals') !== "") {
                    decimals = $(this).data('decimals');
                }

                //is data-mark attribute set for current instance?
                if($(this).data('mark') != null && $(this).data('mark') !== "") {
                    mark = $(this).data('mark');
                }

                $(this).noUiSlider({
                    start: start,
                    step: step,
                    orientation: orientation,
                    range: {
                        'min': min,
                        'max': max
                    },
                    serialization: {
                        lower: [
                            new Link({
                                target: $(this).prev('.eltd-slider-range-value')
                            })
                        ],
                        format: {
                            // Set formatting
                            thousand: thousand,
                            postfix: postfix,
                            prefix: prefix,
                            decimals: decimals,
                            mark: mark
                        }
                    }
                }).on({
                    change: function(){
                        $('.eltd-input-change').addClass('yes');
                    }
                });
            });
        }
    }

    function eltdInitMediaUploader() {
        if($('.eltd-media-uploader').length) {
            $('.eltd-media-uploader').each(function() {
                var fileFrame;
                var uploadUrl;
                var uploadHeight;
                var uploadWidth;
                var uploadImageHolder;
                var attachment;
                var removeButton;

                //set variables values
                uploadUrl           = $(this).find('.eltd-media-upload-url');
                uploadHeight        = $(this).find('.eltd-media-upload-height');
                uploadWidth        = $(this).find('.eltd-media-upload-width');
                uploadImageHolder   = $(this).find('.eltd-media-image-holder');
                removeButton        = $(this).find('.eltd-media-remove-btn');

                if (uploadImageHolder.find('img').attr('src') != "") {
                    removeButton.show();
                    eltdInitMediaRemoveBtn(removeButton);
                }

                $(this).on('click', '.eltd-media-upload-btn', function() {
                    //if the media frame already exists, reopen it.
                    if (fileFrame) {
                        fileFrame.open();
                        return;
                    }

                    //create the media frame
                    fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: $(this).data('frame-title'),
                        button: {
                            text: $(this).data('frame-button-text')
                        },
                        multiple: false
                    });

                    //when an image is selected, run a callback
                    fileFrame.on( 'select', function() {
                        attachment = fileFrame.state().get('selection').first().toJSON();
                        removeButton.show();
                        eltdInitMediaRemoveBtn(removeButton);
                        //write to url field and img tag
                        if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
                            uploadUrl.val(attachment.url);
                            if (attachment.sizes.thumbnail)
                                uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
                            else
                                uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        } else if (attachment.hasOwnProperty('url')) {
                            uploadUrl.val(attachment.url);
                            uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        }

                        //write to hidden meta fields
                        if(attachment.hasOwnProperty('height')) {
                            uploadHeight.val(attachment.height);
                        }

                        if(attachment.hasOwnProperty('width')) {
                            uploadWidth.val(attachment.width);
                        }
                        $('.eltd-input-change').addClass('yes');
                    });

                    //open media frame
                    fileFrame.open();
                });
            });
        }
    }

    function eltdInitMediaRemoveBtn(btn) {
        btn.on('click', function() {
            //remove image src and hide it's holder
            btn.siblings('.eltd-media-image-holder').hide();
            btn.siblings('.eltd-media-image-holder').find('img').attr('src', '');

            //reset meta fields
            btn.siblings('.eltd-media-meta-fields').find('input[type="hidden"]').each(function(e) {
                $(this).val('');
            });

            btn.hide();
        });
    }

    function eltdInitGalleryUploader() {

        var $eltd_upload_button = jQuery('.eltd-gallery-upload-btn');

        var $eltd_clear_button = jQuery('.eltd-gallery-clear-btn');

        wp.media.customlibEditGallery1 = {

            frame: function() {

                if ( this._frame )
                    return this._frame;

                var selection = this.select();

                this._frame = wp.media({
                    id: 'eltd_portfolio-image-gallery',
                    frame: 'post',
                    state: 'gallery-edit',
                    title: wp.media.view.l10n.editGalleryTitle,
                    editing: true,
                    multiple: true,
                    selection: selection
                });

                this._frame.on('update', function() {

                    var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
                    var library = controller.get('library');
                    // Need to get all the attachment ids for gallery
                    var ids = library.pluck('id');

                    $input_gallery_items.val(ids);

                    jQuery.ajax({
                        type: "post",
                        url: ajaxurl,
                        data: "action=search_and_go_elated_gallery_upload_get_images&ids=" + ids,
                        success: function(data) {

                            $thumbs_wrap.empty().html(data);

                        }
                    });

                });

                return this._frame;
            },

            init: function() {

                $eltd_upload_button.click(function(event) {

                    $thumbs_wrap = $(this).parent().prev().prev();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    wp.media.customlibEditGallery1.frame().open();

                });

                $eltd_clear_button.click(function(event) {

                    $thumbs_wrap = $eltd_upload_button.parent().prev().prev();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    $thumbs_wrap.empty();
                    $input_gallery_items.val("");
                });
            },

            // Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
            // in wp-includes/js/media-editor.js.source.html
            select: function() {

                var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
                    defaultPostId = wp.media.gallery.defaults.id,
                    attachments, selection;

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

                // Fetch the query's attachments, and then break ties from the
                // query to allow for sorting.
                selection.more().done(function() {
                    // Break ties with the query.
                    selection.props.set({
                        query: false
                    });
                    selection.unmirror();
                    selection.props.unset('orderby');
                });

                return selection;

            }

        };
        $(wp.media.customlibEditGallery1.init);
    }

    function eltdInitPortfolioItemAcc() {
        //remove portfolio item
        $(document).on('click', '.remove-portfolio-item', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.eltd-portfolio-additional-item').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    eltdSetIdOnRemoveItem($(this),i+1);
                });
                //hide expand all button if all items are removed
                noPortfolioItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noPortfolioItemShown();
        function noPortfolioItemShown()  {
            if($('.eltd-portfolio-additional-item').length == 0){
                $('.eltd-toggle-all-item').hide();
            }
        }

        //expand all additional sidebar items on click on 'expand all' button
        $(document).on('click', '.eltd-toggle-all-item', function(event) {
            event.preventDefault();
            $('.eltd-portfolio-additional-item').each(function(i){

                var $toggleContent = $(this).find('.eltd-portfolio-toggle-content');
                var $this = $(this).find('.toggle-portfolio-item');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }
            });
            return false;
        });
        //toggle for portfolio additional sidebar items
        $(document).on('click', '.eltd-portfolio-additional-item .eltd-portfolio-toggle-holder', function(event) {
            event.preventDefault();

            var $this = $(this);
            var $caret_holder = $this.find('.toggle-portfolio-item');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $this.next();
            $toggleContent.slideToggle(function() {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click','.eltd-toggle-all-item', function(event) {
            event.preventDefault();
            $(this).hide();
        })

        function checkExpandAllBtn() {
            if($('.eltd-portfolio-additional-item .eltd-portfolio-toggle-content:hidden').length == 0){
                $('.eltd-toggle-all-item').hide();
            }else{
                $('.eltd-toggle-all-item').show();
            }
        }

    }

    function eltdInitPortfolioItemsBox() {
        var eltd_portfolio_additional_item = $('.eltd-portfolio-additional-item-holder').clone().html();
        $portfolio_item = '<div class="eltd-portfolio-additional-item" rel="">'+ eltd_portfolio_additional_item +'</div>';

        $('a.eltd-add-item').click(function (event) {
            event.preventDefault();
            $(this).parent().before($($portfolio_item).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.eltd-portfolio-additional-item').length;
            $(this).parent().siblings('.eltd-portfolio-additional-item:last').attr('rel',portfolio_num);
            eltdSetIdOnAddItem($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });
    }

    function eltdSetIdOnAddItem(addButton,portfolio_num){

        addButton.siblings('.eltd-portfolio-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });
    }

    function eltdSetIdOnRemoveItem(portfolio,portfolio_num){

        if(portfolio_num == undefined){
            var portfolio_num = portfolio.attr('rel');
        }else{
            var portfolio_num = portfolio_num;
        }

        portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name').split('[')[0];
            var new_name = name+"[]";
            var new_id = name+"_"+portfolio_num;
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });

    }

    function eltdInitPortfolioMediaAcc() {
        //remove portfolio media
        $(document).on('click', '.remove-portfolio-media', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.eltd-portfolio-media').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    eltdSetIdOnRemoveMedia($(this),i+1);
                });
                //hide expand all button if all medias are removed
                noPortfolioMedia()
            });  return false;
        });

        //hide 'expand all' button if there is no media
        noPortfolioMedia();
        function noPortfolioMedia() {
            if($('.eltd-portfolio-media').length == 0){
                $('.eltd-toggle-all-media').hide();
            }
        }

        //expand all portfolio medias (video and images) onClick on 'expand all' button
        $(document).on('click','.eltd-toggle-all-media', function(event) {
            event.preventDefault();
            $('.eltd-portfolio-media').each(function(i){

                var $toggleContent = $(this).find('.eltd-portfolio-toggle-content');
                var $this = $(this).find('.toggle-portfolio-media');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }

            });        return false;
        });
        //toggle for portfolio media (images or videos)
        $(document).on('click', '.eltd-portfolio-media .eltd-portfolio-toggle-holder', function(event) {
            event.preventDefault();
            var $this = $(this);
            var $caret_holder = $this.find('.toggle-portfolio-media');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $(this).next();
            $toggleContent.slideToggle(function() {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllMediaBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click','.eltd-toggle-all-media', function(event) {
            event.preventDefault();
            $(this).hide();
        });
        function checkExpandAllMediaBtn() {
            if($('.eltd-portfolio-media .eltd-portfolio-toggle-content:hidden').length == 0){
                $('.eltd-toggle-all-media').hide();
            }else{
                $('.eltd-toggle-all-media').show();
            }
        }
    }



    function eltdInitPortfolioImagesVideosBox() {
        var eltd_portfolio_images = $('.eltd-hidden-portfolio-images').clone().html();
        $portfolio_image = '<div class="eltd-portfolio-images eltd-portfolio-media" rel="">'+ eltd_portfolio_images +'</div>';
        var eltd_portfolio_videos = $('.eltd-hidden-portfolio-videos').clone().html();

        $portfolio_videos = '<div class="eltd-portfolio-videos eltd-portfolio-media" rel="">'+ eltd_portfolio_videos +'</div>';
        $('a.eltd-add-image').click(function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_image).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.eltd-portfolio-media').length;
            $(this).parent().siblings('.eltd-portfolio-media:last').attr('rel',portfolio_num);
            eltdInitMediaUploaderAdded($(this).parent());
            eltdSetIdOnAddMedia($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $('a.eltd-add-video').click(function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_videos).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.eltd-portfolio-media').length;
            $(this).parent().siblings('.eltd-portfolio-media:last').attr('rel',portfolio_num);
            eltdInitMediaUploaderAdded($(this).parent());
            eltdSetIdOnAddMedia($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $(document).on('click', '.eltd-remove-last-row-media', function(event) {
            event.preventDefault();
            $(this).parent().prev().fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.eltd-portfolio-media').each(function(i){
                    $(this).attr('rel',i+1);
                    eltdSetIdOnRemoveMedia($(this),i+1);
                });
            });

        });
        eltdShowHidePorfolioImageVideoType();
        $(document).on('change', 'select.eltd-portfoliovideotype', function(e) {
            eltdShowHidePorfolioImageVideoType();
        });
    }

    function eltdSetIdOnAddMedia(addButton,portfolio_num){

        addButton.siblings('.eltd-portfolio-media:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });

        eltdShowHidePorfolioImageVideoType();
    }

    function eltdSetIdOnRemoveMedia(portfolio,portfolio_num){

        if(portfolio_num == undefined){
            var portfolio_num = portfolio.attr('rel');
        }else{
            var portfolio_num = portfolio_num;
        }

        portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name').split('[')[0];
            var new_name = name+"[]";
            var new_id = name+"_"+portfolio_num;
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });

    }


    function eltdSetIdOnAddPortfolio(addButton,portfolio_num){

        addButton.siblings('.eltd_portfolio_image:last').find('input[type="text"], input[type="hidden"], select').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });

        eltdShowHidePorfolioImageVideoType();
    }

    function eltdSetIdOnRemovePortfolio(portfolio,portfolio_num){

        if(portfolio_num == undefined){
            var portfolio_num = portfolio.attr('rel');
        }else{
            var portfolio_num = portfolio_num;
        }

        portfolio.find('input[type="text"], select').each(function(){
            var name = $(this).attr('name').split('[')[0];
            var new_name = name+"[]";
            var new_id = name+"_"+portfolio_num;
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });

    }

    function eltdShowHidePorfolioImageVideoType(){

        $('.eltd-portfoliovideotype').each(function(i){

            var $selected = $(this).val();

            if($selected == "self"){
                $(this).parent().parent().parent().find('.eltd-video-id-holder').hide();
                $(this).parent().parent().parent().parent().find('.eltd-media-uploader').show();
                $(this).parent().parent().parent().find('.eltd-video-self-hosted-path-holder').show();
            }else{
                $(this).parent().parent().parent().find('.eltd-video-id-holder').show();
                $(this).parent().parent().parent().parent().find('.eltd-media-uploader').hide();
                $(this).parent().parent().parent().find('.eltd-video-self-hosted-path-holder').hide();
            }
        });
    }

    function eltdInitMediaUploaderAdded(addButton) {

        addButton.siblings('.eltd-portfolio-media:last').find('.eltd-media-uploader').each(function(){
            var fileFrame;
            var uploadUrl;
            var uploadHeight;
            var uploadWidth;
            var uploadImageHolder;
            var attachment;
            var removeButton;

            //set variables values
            uploadUrl           = $(this).find('.eltd-media-upload-url');
            uploadHeight        = $(this).find('.eltd-media-upload-height');
            uploadWidth        = $(this).find('.eltd-media-upload-width');
            uploadImageHolder   = $(this).find('.eltd-media-image-holder');
            removeButton        = $(this).find('.eltd-media-remove-btn');

            if (uploadImageHolder.find('img').attr('src') != "") {
                removeButton.show();
                eltdInitMediaRemoveBtn(removeButton);
            }

            $(this).on('click', '.eltd-media-upload-btn', function() {
                //if the media frame already exists, reopen it.
                if (fileFrame) {
                    fileFrame.open();
                    return;
                }

                //create the media frame
                fileFrame = wp.media.frames.fileFrame = wp.media({
                    title: $(this).data('frame-title'),
                    button: {
                        text: $(this).data('frame-button-text')
                    },
                    multiple: false
                });

                //when an image is selected, run a callback
                fileFrame.on( 'select', function() {
                    attachment = fileFrame.state().get('selection').first().toJSON();
                    removeButton.show();
                    eltdInitMediaRemoveBtn(removeButton);
                    //write to url field and img tag
                    if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
                        uploadUrl.val(attachment.url);
                        if (attachment.sizes.thumbnail)
                            uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
                        else
                            uploadImageHolder.find('img').attr('src', attachment.url);
                        uploadImageHolder.show();
                    } else if (attachment.hasOwnProperty('url')) {
                        uploadUrl.val(attachment.url);
                        uploadImageHolder.find('img').attr('src', attachment.url);
                        uploadImageHolder.show();
                    }

                    //write to hidden meta fields
                    if(attachment.hasOwnProperty('height')) {
                        uploadHeight.val(attachment.height);
                    }

                    if(attachment.hasOwnProperty('width')) {
                        uploadWidth.val(attachment.width);
                    }
                    $('.eltd-input-change').addClass('yes');
                });

                //open media frame
                fileFrame.open();
            });
        });

        function eltdInitMediaRemoveBtn(btn) {
            btn.on('click', function() {
                //remove image src and hide it's holder
                btn.siblings('.eltd-media-image-holder').hide();
                btn.siblings('.eltd-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.eltd-media-meta-fields').find('input[type="hidden"]').each(function(e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }



    function eltdInitAjaxForm() {
        $('#eltd_top_save_button').click( function() {
            $('.eltd_ajax_form').submit();
            if ($('.eltd-input-change.yes').length) {
                $('.eltd-input-change.yes').removeClass('yes');
            }
            $('.eltd-changes-saved').addClass('yes');
            setTimeout(function(){$('.eltd-changes-saved').removeClass('yes');}, 3000);
            return false;
        });
        $(document).delegate(".eltd_ajax_form", "submit", function (a) {
            var b = $(this);
            var c = {
                action: "search_and_go_elated_save_options"
            };
            jQuery.ajax({
                url: ajaxurl,
                cache: !1,
                type: "POST",
                data: jQuery.param(c, !0) + "&" + b.serialize()
//            ,
//            success: function(data, textStatus, XMLHttpRequest){
//                alert(data);
//            }
            }), a.preventDefault(), a.stopPropagation();
        });
    }

    function eltdInitDatePicker() {
        $( ".eltd-input.datepicker" ).datepicker( { dateFormat: "MM dd, yy" });
    }
    function eltdInitSelectPicker() {
        $(".eltd-selectpicker").selectpicker();
    }

	function eltdShowHidePostFormats(){
        $('input[name="post_format"]').each(function(){
            var id = $(this).attr('id');
            if(id !== '' && id !== undefined) {
                var metaboxName = id.replace(/-/g, '_');
                $('#eltd-meta-box-'+ metaboxName +'_meta').hide();
            }
        });
        
        var selectedId = $("input[name='post_format']:checked").attr("id");
        if(selectedId !== '' && selectedId !== undefined) {
            var selected = selectedId.replace(/-/g, '_');
            $('#eltd-meta-box-' + selected + '_meta').fadeIn();
        }

        $("input[name='post_format']").change(function() {
            eltdShowHidePostFormats();
        });
	}

    function eltdPageTemplatesMetaBoxDependency(){
        if($('#page_template').length) {
            var selected = $('#page_template').val();
            var template_name_parts = selected.split("-");

            if (template_name_parts[0] !== 'blog') {
                $('#eltd-meta-box-blog-meta').hide();
            } else {
                $('#eltd-meta-box-blog-meta').show();
            }
            $('select[name="page_template"]').change(function () {
                eltdPageTemplatesMetaBoxDependency();
            });
        }
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

    function eltdCustomFieldIconsDependency() {
        var iconSelect = $('.eltd_custom_field_icon_pack');
        if (iconSelect.length) {
            iconSelect.each(function(){
                var field = $(this),
                    selected = field.val(),
                    holder = field.parents('.eltd-page-form-section').first();
                console.log(selected);
                holders = holder.siblings('.eltd-icon-collection');
                holders.each(function(){
                   if ( $(this).hasClass( selected ) ) {
                       $(this).fadeIn(300);
                   } else {
                       $(this).fadeOut(300);
                   }
                });
            });
        }

        iconSelect.change(function(){
            eltdCustomFieldIconsDependency();
        });

    }

	
})(jQuery);
