(function($) {
    "use strict";

    var header = {};
    eltd.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.eltdInitMobileNavigation = eltdInitMobileNavigation;
    header.eltdMobileHeaderBehavior = eltdMobileHeaderBehavior;
    header.eltdSetDropDownMenuPosition = eltdSetDropDownMenuPosition;
    header.eltdDropDownMenu = eltdDropDownMenu;

    header.eltdOnDocumentReady = eltdOnDocumentReady;
    header.eltdOnWindowLoad = eltdOnWindowLoad;
    header.eltdOnWindowResize = eltdOnWindowResize;
    header.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdHeaderBehaviour();
        eltdInitMobileNavigation();
        eltdMobileHeaderBehavior();
        eltdSetDropDownMenuPosition();
        eltdDropDownMenu();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        eltdSetDropDownMenuPosition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdDropDownMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
        
    }



    /*
     **	Show/Hide sticky header on window scroll
     */
    function eltdHeaderBehaviour() {

        var header = $('.eltd-page-header');
        var stickyHeader = $('.eltd-sticky-header');
        var fixedHeaderWrapper = $('.eltd-fixed-wrapper');

        var headerMenuAreaOffset = $('.eltd-page-header').find('.eltd-fixed-wrapper').length ? $('.eltd-page-header').find('.eltd-fixed-wrapper').offset().top : null;

        var stickyAppearAmount;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-up'):
                eltd.modules.header.behaviour = 'eltd-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight + eltdGlobalVars.vars.eltdStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        eltd.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                    }else {
                        eltd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-down-up'):
                eltd.modules.header.behaviour = 'eltd-sticky-header-on-scroll-down-up';
                stickyAppearAmount = eltdPerPageVars.vars.eltdStickyScrollAmount !== 0 ? eltdPerPageVars.vars.eltdStickyScrollAmount : eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight;
                eltd.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic
                
                var headerAppear = function(){
                    if(eltd.scroll < stickyAppearAmount) {
                        eltd.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                    }else{
                        eltd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case eltd.body.hasClass('eltd-fixed-on-scroll'):
                eltd.modules.header.behaviour = 'eltd-fixed-on-scroll';
                var headerFixed = function(){
                    if(eltd.scroll < headerMenuAreaOffset){
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom',0);}
                    else{
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    function eltdInitMobileNavigation() {
        var navigationOpener = $('.eltd-mobile-header .eltd-mobile-menu-opener');
        var navigationHolder = $('.eltd-mobile-header .eltd-mobile-nav');
        var dropdownOpener = $('.eltd-mobile-nav .mobile_arrow, .eltd-mobile-nav h4, .eltd-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('eltd-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('eltd-opened');
                        }
                    }

                });
            });
        }

        $('.eltd-mobile-nav a, .eltd-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function eltdMobileHeaderBehavior() {
        if(eltd.body.hasClass('eltd-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.eltd-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('eltd-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('eltd-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.eltd-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);

                    //if(adminBar.length) {
                    //    mobileHeader.find('.eltd-mobile-header-inner').css('top', adminBarHeight);
                    //}
                }

                docYScroll1 = $(document).scrollTop();
            });
        }

    }


    /**
     * Set dropdown position
     */
    function eltdSetDropDownMenuPosition(){

        var menuItems = $(".eltd-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = eltd.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(eltd.body.hasClass('boxed')){
                menuItemFromLeft = eltd.boxedLayoutWidth  - (menuItemPosition - (browserWidth - eltd.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });

    }


    function eltdDropDownMenu() {

        var menu_items = $('.eltd-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });
                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if(!$(this).hasClass('wide_background')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = (eltd.windowWidth - 2 * (eltd.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', eltd.windowWidth);

                        }
                    }
                }

                if(!eltd.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(eltd.body.hasClass('eltd-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 200, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 0, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('eltd-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('eltd-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.eltd-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which == 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        eltd.menuDropdownHeightSet = true;
    }

})(jQuery);