(function($) {
    "use strict";

    window.eltd = {};
    eltd.modules = {};

    eltd.scroll = 0;
    eltd.window = $(window);
    eltd.document = $(document);
    eltd.windowWidth = $(window).width();
    eltd.windowHeight = $(window).height();
    eltd.body = $('body');
    eltd.html = $('html, body');
    eltd.htmlEl = $('html');
    eltd.menuDropdownHeightSet = false;
    eltd.defaultHeaderStyle = '';
    eltd.minVideoWidth = 1500;
    eltd.videoWidthOriginal = 1280;
    eltd.videoHeightOriginal = 720;
    eltd.videoRatio = 1280/720;

    eltd.eltdOnDocumentReady = eltdOnDocumentReady;
    eltd.eltdOnWindowLoad = eltdOnWindowLoad;
    eltd.eltdOnWindowResize = eltdOnWindowResize;
    eltd.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltd.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(eltd.body.hasClass('eltd-dark-header')){ eltd.defaultHeaderStyle = 'eltd-dark-header';}
        if(eltd.body.hasClass('eltd-light-header')){ eltd.defaultHeaderStyle = 'eltd-light-header';}

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
        eltd.windowWidth = $(window).width();
        eltd.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
        eltd.scroll = $(window).scrollTop();
    }



    //set boxed layout width variable for various calculations

    switch(true){
        case eltd.body.hasClass('eltd-grid-1300'):
            eltd.boxedLayoutWidth = 1350;
            break;
        case eltd.body.hasClass('eltd-grid-1200'):
            eltd.boxedLayoutWidth = 1250;
            break;
        case eltd.body.hasClass('eltd-grid-1000'):
            eltd.boxedLayoutWidth = 1050;
            break;
        case eltd.body.hasClass('eltd-grid-800'):
            eltd.boxedLayoutWidth = 850;
            break;
        default :
            eltd.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    eltd.modules.common = common;

    common.eltdIsTouchDevice = eltdIsTouchDevice;
    common.eltdDisableSmoothScrollForMac = eltdDisableSmoothScrollForMac;
    common.eltdFluidVideo = eltdFluidVideo;
    common.eltdPreloadBackgrounds = eltdPreloadBackgrounds;
    common.eltdPrettyPhoto = eltdPrettyPhoto;
    common.eltdCheckHeaderStyleOnScroll = eltdCheckHeaderStyleOnScroll;
    common.eltdInitParallax = eltdInitParallax;
    //common.eltdSmoothScroll = eltdSmoothScroll;
    common.eltdEnableScroll = eltdEnableScroll;
    common.eltdDisableScroll = eltdDisableScroll;
    common.eltdWheel = eltdWheel;
    common.eltdKeydown = eltdKeydown;
    common.eltdPreventDefaultValue = eltdPreventDefaultValue;
    common.eltdOwlSlider = eltdOwlSlider;
    common.eltdInitSelfHostedVideoPlayer = eltdInitSelfHostedVideoPlayer;
    common.eltdSelfHostedVideoSize = eltdSelfHostedVideoSize;
    common.eltdInitBackToTop = eltdInitBackToTop;
    common.eltdBackButtonShowHide = eltdBackButtonShowHide;
    common.eltdSmoothTransition = eltdSmoothTransition;

    common.eltdOnDocumentReady = eltdOnDocumentReady;
    common.eltdOnWindowLoad = eltdOnWindowLoad;
    common.eltdOnWindowResize = eltdOnWindowResize;
    common.eltdOnWindowScroll = eltdOnWindowScroll;
    common.eltdInitAudioPlayer = eltdInitAudioPlayer;
    common.eltdInitLoginRegisterForm = eltdInitLoginRegisterForm;
    common.eltdUserLogin = eltdUserLogin;
    common.eltdUserLostPassword = eltdUserLostPassword;
    common.eltdAjaxResponseMessageHtml = eltdAjaxResponseMessageHtml;
    common.eltdInitLoginCheckboxStyle = eltdInitLoginCheckboxStyle;
    common.eltdInitClaimListingModal = eltdInitClaimListingModal;
    common.eltdInitClaimListing = eltdInitClaimListing;
    common.eltdInitHovers = eltdInitHovers;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdIsTouchDevice();
        eltdDisableSmoothScrollForMac();
        eltdFluidVideo();
        eltdPreloadBackgrounds();
        eltdPrettyPhoto();
        eltdInitElementsAnimations();
        eltdInitAnchor().init();
        eltdInitVideoBackground();
        eltdInitVideoBackgroundSize();
        eltdSetContentBottomMargin();
        //eltdSmoothScroll();
        eltdOwlSlider();
        eltdInitSelfHostedVideoPlayer();
        eltdSelfHostedVideoSize();
        eltdInitAudioPlayer();
        eltdInitBackToTop();
        eltdBackButtonShowHide();
        eltdInitLoginRegisterForm();
        eltdUserLogin();
        eltdUserLostPassword();
        eltdInitLoginCheckboxStyle();
        eltdInitClaimListingModal();
        eltdInitClaimListing();
        eltdInitHovers();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        eltdCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right
        eltdInitParallax();
        eltdSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdInitVideoBackgroundSize();
        eltdSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
        
    }

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function eltdIsTouchDevice() {
        if(Modernizr.touch && !eltd.body.hasClass('eltd-no-animations-on-touch')) {
            eltd.body.addClass('eltd-no-animations-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function eltdDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && eltd.body.hasClass('eltd-smooth-scroll')) {
            eltd.body.removeClass('eltd-smooth-scroll');
        }
    }

	function eltdFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    /**
     * Init Owl Carousel
     */
    function eltdOwlSlider() {

        var sliders = $('.eltd-owl-slider');

        if (sliders.length) {
            sliders.each(function(){

                var slider = $(this);
                slider.owlCarousel({
                    singleItem: true,
                    transitionStyle: 'fade',
                    navigation: true,
                    autoHeight: true,
                    pagination: false,
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ]
                });

            });
        }

    }


    /*
     *	Preload background images for elements that have 'eltd-preload-background' class
     */
    function eltdPreloadBackgrounds(){

        $(".eltd-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('eltd-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('eltd-preload-background'); }); //make sure that eltd-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function eltdPrettyPhoto() {
        /*jshint multistr: true */
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    /*
     *	Check header style on scroll, depending on row settings
     */
    function eltdCheckHeaderStyleOnScroll(){

        if($('[data-eltd_header_style]').length > 0 && eltd.body.hasClass('eltd-header-style-on-scroll')) {

            var waypointSelectors = $('.eltd-full-width-inner > .wpb_row.eltd-section, .eltd-full-width-inner > .eltd-parallax-section-holder, .eltd-container-inner > .wpb_row.eltd-section, .eltd-container-inner > .eltd-parallax-section-holder, .eltd-portfolio-single > .wpb_row.eltd-section');
            var changeStyle = function(element){
                (element.data("eltd_header_style") !== undefined) ? eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(element.data("eltd_header_style")) : eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(''+eltd.defaultHeaderStyle);
            };

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'down') { changeStyle($(this.element)); }
            }, { offset: 0});

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'up') { changeStyle($(this.element)); }
            }, { offset: function(){
                return -$(this.element).outerHeight();
            } });
        }
    }

    /*
     *	Start animations on elements
     */
    function eltdInitElementsAnimations(){

        var touchClass = $('.eltd-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.eltd-grow-in, .eltd-fade-in-down, .eltd-element-from-fade, .eltd-element-from-left, .eltd-element-from-right, .eltd-element-from-top, .eltd-element-from-bottom, .eltd-flip-in, .eltd-x-rotate, .eltd-z-rotate, .eltd-y-translate, .eltd-fade-in, .eltd-fade-in-left-x-rotate'),
            clasess,
            animationClass,
            animationData;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
				$(this).appear(function() {
					animationData = $(this).data('animation');
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						$(this).addClass(animationClass+'-on');
					}
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }

    }


/*
 **	Sections with parallax background image
 */
function eltdInitParallax(){

    if($('.eltd-parallax-section-holder').length){
        $('.eltd-parallax-section-holder').each(function() {

            var parallaxElement = $(this);
            if(parallaxElement.hasClass('eltd-full-screen-height-parallax')){
                parallaxElement.height(eltd.windowHeight);
                parallaxElement.find('.eltd-parallax-content-outer').css('padding',0);
            }
            var speed = parallaxElement.data('eltd-parallax-speed')*0.4;
            parallaxElement.parallax("50%", speed);
        });
    }
}

/*
 **	Anchor functionality
 */
var eltdInitAnchor = eltd.modules.common.eltdInitAnchor = function() {

    /**
     * Set active state on clicked anchor
     * @param anchor, clicked anchor
     */
    var setActiveState = function(anchor){

        $('.eltd-main-menu .eltd-active-item, .eltd-mobile-nav .eltd-active-item, .eltd-vertical-menu .eltd-active-item, .eltd-fullscreen-menu .eltd-active-item').removeClass('eltd-active-item');
        anchor.parent().addClass('eltd-active-item');

        $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-vertical-menu a, .eltd-fullscreen-menu a').removeClass('current');
        anchor.addClass('current');
    };

    /**
     * Check anchor active state on scroll
     */
    var checkActiveStateOnScroll = function(){

        $('[data-eltd-anchor]').waypoint( function(direction) {
            if(direction === 'down') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltd-anchor")+"']"));
            }
        }, { offset: '50%' });

        $('[data-eltd-anchor]').waypoint( function(direction) {
            if(direction === 'up') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltd-anchor")+"']"));
            }
        }, { offset: function(){
            return -($(this.element).outerHeight() - 150);
        } });

    };

    /**
     * Check anchor active state on load
     */
    var checkActiveStateOnLoad = function(){
        var hash = window.location.hash.split('#')[1];

        if(hash !== "" && $('[data-eltd-anchor="'+hash+'"]').length > 0){
            //triggers click which is handled in 'anchorClick' function
            $("a[href='"+window.location.href.split('#')[0]+"#"+hash).trigger( "click" );
        }
    };

    /**
     * Calculate header height to be substract from scroll amount
     * @param anchoredElementOffset, anchorded element offest
     */
    var headerHeihtToSubtract = function(anchoredElementOffset){

        if(eltd.modules.header.behaviour == 'eltd-sticky-header-on-scroll-down-up') {
            (anchoredElementOffset > eltd.modules.header.stickyAppearAmount) ? eltd.modules.header.isStickyVisible = true : eltd.modules.header.isStickyVisible = false;
        }

        if(eltd.modules.header.behaviour == 'eltd-sticky-header-on-scroll-up') {
            (anchoredElementOffset > eltd.scroll) ? eltd.modules.header.isStickyVisible = false : '';
        }

        var headerHeight = eltd.modules.header.isStickyVisible ? eltdGlobalVars.vars.eltdStickyHeaderTransparencyHeight : eltdPerPageVars.vars.eltdHeaderTransparencyHeight;

        return headerHeight;
    };

    /**
     * Handle anchor click
     */
    var anchorClick = function() {
        eltd.document.on("click", ".eltd-main-menu a, .eltd-vertical-menu a, .eltd-fullscreen-menu a, .eltd-btn, .eltd-anchor, .eltd-mobile-nav a", function() {
            var scrollAmount;
            var anchor = $(this);
            var hash = anchor.prop("hash").split('#')[1];

            if(hash !== "" && $('[data-eltd-anchor="' + hash + '"]').length > 0 /*&& anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]*/) {

                var anchoredElementOffset = $('[data-eltd-anchor="' + hash + '"]').offset().top;
                scrollAmount = $('[data-eltd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                setActiveState(anchor);

                eltd.html.stop().animate({
                    scrollTop: Math.round(scrollAmount)
                }, 1000, function() {
                    //change hash tag in url
                    if(history.pushState) { history.pushState(null, null, '#'+hash); }
                });
                return false;
            }
        });
    };

    return {
        init: function() {
            if($('[data-eltd-anchor]').length) {
                anchorClick();
                checkActiveStateOnScroll();
                $(window).load(function() { checkActiveStateOnLoad(); });
            }
        }
    };

};

/*
 **	Video background initialization
 */
function eltdInitVideoBackground(){

    $('.eltd-section .eltd-video-wrap .eltd-video').mediaelementplayer({
        enableKeyboard: false,
        iPadUseNativeControls: false,
        pauseOtherPlayers: false,
        // force iPhone's native controls
        iPhoneUseNativeControls: false,
        // force Android's native controls
        AndroidUseNativeControls: false
    });

    //mobile check
    if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
        eltdInitVideoBackgroundSize();
        $('.eltd-section .eltd-mobile-video-image').show();
        $('.eltd-section .eltd-video-wrap').remove();
    }
}

    /*
     **	Calculate video background size
     */
    function eltdInitVideoBackgroundSize(){

        $('.eltd-section .eltd-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.eltd-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.eltd-section').outerHeight();
            eltd.minVideoWidth = eltd.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / eltd.videoWidthOriginal;
            var scaleV = sectionHeight / eltd.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * eltd.videoWidthOriginal < eltd.minVideoWidth) {scale = eltd.minVideoWidth / eltd.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * eltd.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * eltd.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function eltdSetContentBottomMargin(){
        var uncoverFooter = $('.eltd-footer-uncover');

        if(uncoverFooter.length){
            $('.eltd-content').css('margin-bottom', $('.eltd-footer-inner').height());
        }
    }

	/*
	** Initiate Smooth Scroll
	*/
	//function eltdSmoothScroll(){
	//
	//	if(eltd.body.hasClass('eltd-smooth-scroll')){
	//
	//		var scrollTime = 0.4;			//Scroll time
	//		var scrollDistance = 300;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll
	//
	//		var mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");
	//
	//		var smoothScrollListener = function(event){
	//			event.preventDefault();
	//
	//			var delta = event.wheelDelta / 120 || -event.detail / 3;
	//			var scrollTop = eltd.window.scrollTop();
	//			var finalScroll = scrollTop - parseInt(delta * scrollDistance);
	//
	//			TweenLite.to(eltd.window, scrollTime, {
	//				scrollTo: {
	//					y: finalScroll, autoKill: !0
	//				},
	//				ease: Power1.easeOut,
	//				autoKill: !0,
	//				overwrite: 5
	//			});
	//		};
	//
	//		if (!$('html').hasClass('touch') && !mobile_ie) {
	//			if (window.addEventListener) {
	//				window.addEventListener('mousewheel', smoothScrollListener, false);
	//				window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
	//			}
	//		}
	//	}
	//}

    function eltdDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', eltdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = eltdWheel;
        document.onkeydown = eltdKeydown;

        if(eltd.body.hasClass('eltd-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function eltdEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', eltdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(eltd.body.hasClass('eltd-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function eltdWheel(e) {
        eltdPreventDefaultValue(e);
    }

    function eltdKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                eltdPreventDefaultValue(e);
                return;
            }
        }
    }

    function eltdPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function eltdInitSelfHostedVideoPlayer() {

        var players = $('.eltd-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function eltdSelfHostedVideoSize(){

		$('.eltd-self-hosted-video-holder .eltd-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.eltd-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / eltd.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}
    
    function eltdInitAudioPlayer() {

        var players = $('audio.eltd-blog-audio, audio.eltd-listing-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
        
    }

    function eltdToTopButton(a) {

        var b = $("#eltd-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function eltdBackButtonShowHide(){
        eltd.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { eltdToTopButton('off'); } else { eltdToTopButton('on'); }
        });
    }

    function eltdInitBackToTop(){
        var backToTopButton = $('#eltd-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            eltd.html.animate({scrollTop: 0}, eltd.window.scrollTop()/3, 'linear');
        });
    }

    function eltdSmoothTransition() {
        var loader = $('body > .eltd-smooth-transition-loader.eltd-mimic-ajax');
        if (loader.length) {
            loader.fadeOut(500);
            $(window).bind("pageshow", function(event) {
                if (event.originalEvent.persisted) {
                    loader.fadeOut(500);
                }
            });

            $('a').click(function(e) {
                var a = $(this);
                if (
                    e.which == 1 && // check if the left mouse button has been pressed
                    a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
					(typeof a.data('rel') === 'undefined') && //Not pretty photo link
                    (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                    !a.hasClass('eltd-like') && //Not like link
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                    (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                ) {
                    e.preventDefault();
                    loader.addClass('eltd-hide-spinner');
                    loader.fadeIn(500, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }

    function eltdAjaxResponseMessageHtml(response){

        //div in which will be placed response
        var ajaxResponseHolder = $('.eltd-listing-ajax-response-holder');

        //Locate template for info window and insert data from marker options (via underscore)

        var ajaxResponseTemplate = _.template( $('.eltd-listing-ajax-response').html() );

        var messageClass;

        if(response.status === 'success'){
            messageClass = 'eltd-listing-ajax-succes';
        }

        else if(response.status === 'error'){
            messageClass = 'eltd-listing-ajax-error';
        }

        var templateData = {
            messageTypeClass : messageClass,
            message : response.message
        };

        var ajaxResponseContent = ajaxResponseTemplate( templateData );

        //append ajax response message
        ajaxResponseHolder.html(ajaxResponseContent);

    }

    /**
     * Login user
     */
    function eltdUserLogin(){
        $('.eltd-login-form').on('submit',function(e) {
            e.preventDefault();
            var nonceField = $(this).find('.eltd-login-button-holder input[type="hidden"]').first();
            var nonce = nonceField.val();

            var ajaxData = {
                action: 'search_and_go_elated_user_login',
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
                    eltdAjaxResponseMessageHtml(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
            return false;
        });
    }

    function eltdUserLostPassword() {

        var lostPassForm = $('.eltd-lost-password-form');
        lostPassForm.submit(function(e){
            e.preventDefault();
            var data = {
                action : 'search_and_go_elated_user_lost_password',
                user_login : lostPassForm.find('.eltd-user-login-field').val()
            };
            $.ajax({
                type : 'POST',
                data : data,
                url : ElatedAjaxUrl,
                success : function (data) {
                    var response = JSON.parse(data);
                    eltdAjaxResponseMessageHtml(response);
                }
            });
        });

    }

    function eltdInitLoginRegisterForm() {

        var loginHolder = $('.eltd-login-register-holder'),
            loginOpener = $('.eltd-login-opener'),
            actionBtn = $('.eltd-login-action-btn'),
            loginTitle = $('.eltd-login-title'),
            sections = $('.widget-section');

        //Init opening login modal
        loginOpener.click(function(e){
            e.preventDefault();
            loginHolder.fadeIn(300);
            loginHolder.addClass('opened');
        });

        //Init closing login modal
        loginHolder.click(function(e){
            if ( loginHolder.hasClass( 'opened' ) ) {
                loginHolder.fadeOut(300);
                loginHolder.removeClass('opened');
                //Reset widget to display login on open
                setTimeout(function () {
                    sections.removeAttr('style');
                }, 500);
            }
        });
        $(".eltd-login-content").click(function(e) {
            e.stopPropagation();
        });
        // on esc too
        $(window).on('keyup', function(e){
            if ( loginHolder.hasClass( 'opened' ) && e.keyCode == 27 ) {
                loginHolder.fadeOut(300);
                loginHolder.removeClass('opened');
                //Reset widget to display login on open
                setTimeout(function () {
                    sections.removeAttr('style');
                }, 500);
            }
        });

        actionBtn.click(function(e){
            e.preventDefault();
            var dataEl = $(this).data('el'),
                dataTitle = $(this).data('title');
            var element = $(this).closest('.eltd-login-content').find(dataEl);
            if ( ! element.is(':visible') ) {
                loginTitle.html(dataTitle);
                element.siblings(':not(.eltd-login-title)').hide();
                element.show();
            }
        });

    }

    function eltdInitLoginCheckboxStyle() {

        var checkbox = $('.eltd-login-remember-me-checkbox');
        checkbox.click(function (){
            $(this).toggleClass('active');
            var checkbox = $(this).next();
            checkbox.prop( 'checked', !checkbox.prop( 'checked' )).change();
        });

    }

    function eltdInitClaimListingModal() {

        var claimHolder = $('.eltd-listing-claim'),
            claimModalHolder = $('.eltd-claim-holder');

        if ( claimHolder.length ) {
            var claimOpener = claimHolder.find('.user-logged-in');
            claimOpener.click(function(e){
                e.preventDefault();
                claimModalHolder.fadeIn(300);
                claimModalHolder.addClass('opened');
            });
            //Init closing login modal
            claimModalHolder.click(function(e){
                if ( claimModalHolder.hasClass( 'opened' ) ) {
                    claimModalHolder.fadeOut(300);
                    claimModalHolder.removeClass('opened');
                }
            });
            $(".eltd-claim-content").click(function(e) {
                e.stopPropagation();
            });
            // on esc too
            $(window).on('keyup', function(e){
                if ( claimModalHolder.hasClass( 'opened' ) && e.keyCode == 27 ) {
                    claimModalHolder.fadeOut(300);
                    claimModalHolder.removeClass('opened');
                }
            });
        }

    }

    function eltdInitClaimListing() {

        var form = $('.eltd-claim-listing-form'),
            claimHolder = $('.eltd-listing-claim'),
            claimModalHolder = $('.eltd-claim-holder');
        if ( form.length ) {
            form.find('select').select2({
                minimumResultsForSearch: Infinity,
                placeholder: ''
            });
            form.submit(function(e){
                e.preventDefault();
                var ajaxData = {
                    action: 'search_and_go_elated_claim_listing',
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
                        eltdAjaxResponseMessageHtml(response);
                        claimHolder.remove();
                        setTimeout(function(){
                            claimModalHolder.fadeOut(300);
                        }, 2000);
                    }
                });
                return false;
            })
        }
    }

    function eltdInitHovers() {
        var items = $('.eltd-listing-basic-item-holder, .eltd-listing-list-item, .eltd-info-window, .eltd-blog-list-item');
        if (items.length) {
            items.each(function(){
                var thisItem = $(this),
                    link = thisItem.find('a:not(.eltd-listing-item-category-icon):not(.eltd-listing-whislist):not(.eltd-post-info-author-link):not(.eltd-post-info-category a)');
                link.mouseenter(function(){
                    thisItem.addClass('eltd-item-hovered');
                });
                link.mouseleave(function(){
                    thisItem.removeClass('eltd-item-hovered');
                });
            });
        }
    }

})(jQuery);



(function($) {
    'use strict';

    var ajax = {};

    eltd.modules.ajax = ajax;

    var animation = {};
    ajax.animation = animation;

    ajax.eltdFetchPage = eltdFetchPage;
    ajax.eltdInitAjax = eltdInitAjax;
    ajax.eltdHandleLinkClick = eltdHandleLinkClick;
    ajax.eltdInsertFetchedContent = eltdInsertFetchedContent;
    ajax.eltdInitBackBehavior = eltdInitBackBehavior;
    ajax.eltdSetActiveState = eltdSetActiveState;
    ajax.eltdReinitiateAll = eltdReinitiateAll;
    ajax.eltdHandleMeta = eltdHandleMeta;

    ajax.eltdOnDocumentReady = eltdOnDocumentReady;
    ajax.eltdOnWindowLoad = eltdOnWindowLoad;
    ajax.eltdOnWindowResize = eltdOnWindowResize;
    ajax.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitAjax();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        eltdHandleAjaxFader();
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


    var loadedPageFlag = true; // Indicates whether the page is loaded
    var firstLoad = true; // Indicates whether this is the first loaded page, for back button functionality
    animation.type = null;
    animation.time = 500; // Duration of animation for the content to be changed
    animation.simultaneous = true; // False indicates that the new content should wait for the old content to disappear, true means that it appears at the same time as the old content disappears
    animation.loader = null;
    animation.loaderTime = 500;

    /**
     * Fetching the targeted page
     */
    function eltdFetchPage(params, destinationSelector, targetSelector) {

        function setDefaultParam(key,value) {
            params[key] = typeof params[key] !== 'undefined' ? params[key] : value;
        }

        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.eltd-content';
        targetSelector = typeof targetSelector !== 'undefined' ? targetSelector : '.eltd-content';
        
        // setting default ajax parameters
        params = typeof params !== 'undefined' ? params : {};

        setDefaultParam('url', window.location.href);
        setDefaultParam('type', 'POST');
        setDefaultParam('success', function(response) {
            var jResponse = $(response);

            var meta = jResponse.find('.eltd-meta');
            if (meta.length) { eltdHandleMeta(meta); }

            var new_content = jResponse.find(targetSelector);
            if (!new_content.length) {
                loadedPageFlag = true;
                return false;
            }
            else {
                eltdInsertFetchedContent(params.url, new_content, destinationSelector);
            }
        });

        // setting data parameters
        setDefaultParam('ajaxReq', 'yes');
        //setDefaultParam('hasHeader', eltd.body.find('header').length ? true : false);
        //setDefaultParam('hasFooter', eltd.body.find('footer').length ? true : false);

        $.ajax({
            url: params.url,
            type: params.type,
            data: {
                ajaxReq: params.ajaxReq
                //hasHeader: params.hasHeader,
                //hasFooter: params.hasFooter
            },
            success: params.success
        });
    }

    function eltdHandleAjaxFader() {
        if (animation.loader.length) {
            animation.loader.fadeOut(animation.loaderTime);
            $(window).bind("pageshow", function(event) {
                if (event.originalEvent.persisted) {
                    animation.loader.fadeOut(animation.loaderTime);
                }
            });
        }
    }

    function eltdInitAjax() {
        eltd.body.removeClass('page-not-loaded'); // Might be necessary for ajax calls
        animation.loader = $('body > .eltd-smooth-transition-loader.eltd-ajax');
        if (animation.loader.length) {

            if(eltd.body.hasClass('woocommerce') || eltd.body.hasClass('woocommerce-page')) {
                return false;
            }
            else {
                eltdInitBackBehavior();
                $(document).on('click', 'a[target!="_blank"]:not(.no-ajax):not(.no-link)', function(click) {
                    var link = $(this);

                    if(click.ctrlKey == 1) { // Check if CTRL key is held with the click
                        window.open(link.attr('href'), '_blank');
                        return false;
                    }

                    if(link.parents('.eltd-ptf-load-more').length){ return false; } // Don't initiate ajax for portfolio load more link

                    if(link.parents('.eltd-blog-load-more-button').length){ return false; } // Don't initiate ajax for blog load more link

                    if(link.parents('eltd-post-info-comments').length){ // If it's a comment link, don't load any content, just scroll to the comments section
                        var hash = link.attr('href').split("#")[1];  
                        $('html, body').scrollTop( $("#"+hash).offset().top );  
                        return false;  
                    }

                    if(window.location.href.split('#')[0] == link.attr('href').split('#')[0]){ return false; } //  If the link leads to the same page, don't use ajax

                    if(link.closest('.eltd-no-animation').length === 0){ // If no parents are set to no-animation...

                        if(document.location.href.indexOf("?s=") >= 0){ // Don't use ajax if currently on search page
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-admin") >= 0){ // Don't use ajax for wp-admin
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-content") >= 0){ // Don't use ajax for wp-content
                            return true;
                        }

                        if(jQuery.inArray(link.attr('href').split('#')[0], eltdGlobalVars.vars.no_ajax_pages) !== -1){ // If the target page is a no-ajax page, don't use ajax
                            document.location.href = link.attr('href');
                            return false;
                        }

                        if((link.attr('href') !== "http://#") && (link.attr('href') !== "#")){ // Don't use ajax if the link is empty
                            //disableHashChange = true;

                            var url = link.attr('href');
                            var start = url.indexOf(window.location.protocol + '//' + window.location.host); // Check if the link leads to the same domain
                            if(start === 0){
                                if(!loadedPageFlag){ return false; } //if page is not loaded don't load next one
                                click.preventDefault();
                                click.stopImmediatePropagation();
                                click.stopPropagation();
                                if (!link.is('.current')) {
                                    eltdHandleLinkClick(link);
                                }
                            }

                        }else{
                            return false;
                        }
                    }
                });
            }
        }
    }

    function eltdInitBackBehavior() {
        if (window.history.pushState) {
            /* the below code is to override back button to get the ajax content without reload*/
            $(window).bind('popstate', function() {
                "use strict";

                var url = location.href;
                if (!firstLoad && loadedPageFlag) {
                    loadedPageFlag = false;
                    eltdFetchPage({
                        url: url
                    });
                }
            });
        }
    }

    function eltdHandleLinkClick(link) {
        loadedPageFlag = false;
        animation.loader.fadeIn(animation.loaderTime);
        eltdFetchPage({
            url: link.attr('href')
        });
    }

    function eltdSetActiveState(url) {
        var me = $("nav a[href='"+url+"'], .widget_nav_menu a[href='"+url+"']");

        $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-mobile-nav h4, .eltd-vertical-menu a, .popup_menu a, .widget_nav_menu a').removeClass('current').parent().removeClass('eltd-active-item');
        //$('.main_menu a, .mobile_menu a, .mobile_menu h4, .vertical_menu a, .popup_menu a').parent().removeClass('active');
        $('.widget_nav_menu ul.menu > li').removeClass('current-menu-item');

        me.each(function() {
            var me = $(this);

            if(me.closest('.second').length === 0){
                me.parent().addClass('eltd-active-item');
            }else{
                me.closest('.second').parent().addClass('eltd-active-item');
            }

            if(me.closest('.eltd-mobile-nav').length > 0){
                me.closest('.level0').addClass('eltd-active-item');
                me.closest('.level1').addClass('eltd-active-item');
                me.closest('.level2').addClass('eltd-active-item');
            }

            if(me.closest('.widget_nav_menu').length > 0){
                me.closest('.widget_nav_menu').find('.menu-item').addClass('current-menu-item');
            }


            //$('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-vertical-menu a, .popup_menu a').removeClass('current');
            me.addClass('current');
        });
    }

    /**
     * Reinitialize all functions
     *
     * @param modulesToExclude - array of modules to exclude from reinitialization
     */
    function eltdReinitiateAll( modulesToExclude ) {
        $(document).off(); // Remove all event handlers before reinitialization
        $(window).off();
        eltd.body.off().find('*').off(); // Remove all event handlers before reinitialization

        eltd.eltdOnDocumentReady(); // Trigger all functions upon new page load
        eltd.eltdOnWindowLoad(); // Trigger all functions upon new page load
        $(window).resize(eltd.eltdOnWindowResize); // Reassign handles for resize and scroll events
        $(window).scroll(eltd.eltdOnWindowScroll); // Reassign handles for resize and scroll events

        var defaultModules = ['common', 'ajax', 'header', 'title', 'shortcodes', 'woocommerce', 'portfolio', 'blog', 'like'];
        var modules = [];

        if ( typeof modulesToExclude !== 'undefined' && modulesToExclude.length ) {
            defaultModules.forEach(function(key) {
                if (-1 === modulesToExclude.indexOf(key)) {
                    modules.push(key);
                }
            }, this);
        } else {
            modules = defaultModules;
        }

        for (var i=0; i<modules.length; i++) {
            if (typeof eltd.modules[modules[i]] !== 'undefined') {
                eltd.modules[modules[i]].eltdOnDocumentReady(); // Trigger all functions upon new page load
                eltd.modules[modules[i]].eltdOnWindowLoad(); // Trigger all functions upon new page load
                $(window).resize(eltd.modules[modules[i]].eltdOnWindowResize); // Reassign handles for resize and scroll events
                $(window).scroll(eltd.modules[modules[i]].eltdOnWindowScroll); // Reassign handles for resize and scroll events
            }
        }
    }

    function eltdHandleMeta(meta_data) {
        // set up title, meta description and meta keywords
        var newTitle = meta_data.find(".eltd-seo-title").text();
        var pageTransition = meta_data.find(".eltd-page-transition").text();
        var newDescription = meta_data.find(".eltd-seo-description").text();
        var newKeywords = meta_data.find(".eltd-seo-keywords").text();
        if (typeof pageTransition !== 'undefined') {
            animation.type = pageTransition;
        } 
        if ($('head meta[name="description"]').length) {
            $('head meta[name="description"]').attr('content', newDescription);
        } else if (typeof newDescription !== 'undefined') {
            $('<meta name="description" content="'+newDescription+'">').prependTo($('head'));
        } 
        if ($('head meta[name="keywords"]').length) {
            $('head meta[name="keywords"]').attr('content', newKeywords);
        } else if (typeof newKeywords !== 'undefined') {
            $('<meta name="keywords" content="'+newKeywords+'">').prependTo($('head'));
        } 
        document.title = newTitle;

        var newBodyClasses = meta_data.find(".eltd-body-classes").text();
        var myArray = newBodyClasses.split(',');
        eltd.body.removeClass();
        for(var i=0;i<myArray.length;i++){
            if (myArray[i] !== "eltd-page-not-loaded"){
                eltd.body.addClass(myArray[i]);
            }
        }

        if($("#wp-admin-bar-edit").length > 0){
            // set up edit link when wp toolbar is enabled
            var pageId = meta_data.find("#eltd-page-id").text();
            var old_link = $('#wp-admin-bar-edit a').attr("href");
            var new_link = old_link.replace(/(post=).*?(&)/,'$1' + pageId + '$2');
            $('#wp-admin-bar-edit a').attr("href", new_link);
        }
    }

    function eltdInsertFetchedContent(url, new_content, destinationSelector) {
        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.eltd-content';
        var destination = eltd.body.find(destinationSelector);
        
        new_content.height(destination.height()).css({'position': 'absolute', 'opacity': 0, 'overflow': 'hidden'}).insertBefore(destination);
       
        new_content.waitForImages(function() {
            if (url.indexOf('#') !== -1) {
                $('<a class="eltd-temp-anchor eltd-anchor" href="'+url+'" style="display: none"></a>').appendTo('body');
            }
            eltdReinitiateAll();

            if (animation.type == "fade") {
                destination.stop().fadeTo(animation.time, 0, function() {
                    destination.remove();
                    if (window.history.pushState) {
                        if(url!==window.location.href){
                            window.history.pushState({path:url},'',url);
                        }

                        //does Google Analytics code exists on page?
                        if(typeof _gaq !== 'undefined') {
                            //add new url to Google Analytics so it can be tracked
                            _gaq.push(['_trackPageview', url]);
                        }
                    } else {
                        document.location.href = window.location.protocol + '//' + window.location.host + '#' + url.split(window.location.protocol + '//' + window.location.host)[1];
                    }
                    eltdSetActiveState(url);
                    eltd.body.animate({scrollTop: 0}, animation.time, 'swing');
                });
                setTimeout(function() {
                    new_content.css('position','relative').height('').stop().fadeTo(animation.time, 1, function() {
                        loadedPageFlag = true;
                        firstLoad = false;
                        animation.loader.fadeOut(animation.loaderTime, function() {
                            var anch = $('.eltd-temp-anchor');
                            if (anch.length) {
                                anch.trigger('click').remove();
                            }
                        });
                    });
                }, !animation.simultaneous * animation.time);
            }
        });
    }


})(jQuery);

// Load the SDK asynchronously
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if ( typeof eltdSocialVars !== 'undefined' ) {
    var facebookAppId = eltdSocialVars.social.facebookAppId;
}
if ( facebookAppId ) {
    window.fbAsyncInit = function() {
        FB.init({
            appId      : facebookAppId,
            cookie     : true,  // enable cookies to allow the server to access
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.5' // use version 2.5
        });

        window.FB = FB;
    };
}

(function($) {
    "use strict";

    var facebook = {};
    eltd.modules.facebook = facebook;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdOnDocumentReady() {}

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdOnWindowLoad() {
        eltdInitFacebookLogin();
        eltdInitGooglePlusLogin();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function eltdOnWindowResize() {}

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdOnWindowScroll() {}

    function eltdInitFacebookLogin() {

        var loginForm = $('.eltd-facebook-login-holder');
        loginForm.submit(function(e){
            e.preventDefault();
            window.FB.login( function( response ) {
                eltdFacebookCheckStatus( response );
            }, {scope: 'email, public_profile'} );
        });

    }

    function eltdFacebookCheckStatus( response ) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            eltdGetFacebookUserData();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    // After login is successful get user data
    function eltdGetFacebookUserData() {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', { 'fields': 'id, name, email, link, picture' }, function(response) {
            var nonceField = $('.eltd-facebook-login-holder input[type="hidden"]').first();
            var nonce = nonceField.val();
            response.nonce = nonce;
            response.image = response.picture.data.url;
            var data = {
                action : 'search_and_go_elated_check_facebook_user',
                response : response
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedAjaxUrl,
                success: function(data) {
                    var response;
                    response = JSON.parse(data);
                    // append ajax response html
                    eltd.modules.common.eltdAjaxResponseMessageHtml(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

        });
    }

    function eltdInitGooglePlusLogin() {

        if ( typeof eltdSocialVars !== 'undefined' ) {
            var clientId = eltdSocialVars.social.googleClientId;
        }
        if ( clientId ) {
            gapi.load('auth2', function(){
                window.auth2 = gapi.auth2.init({
                    client_id: clientId
                });
                eltdInitGooglePlusLoginButton();
            });
        } else {
            var loginForm = $('.eltd-google-login-holder');
            loginForm.submit(function(e) {
                e.preventDefault();
            });
        }

    }

    function eltdInitGooglePlusLoginButton() {

        var loginForm = $('.eltd-google-login-holder');
        loginForm.submit(function(e) {
            e.preventDefault();
            window.auth2.signIn();
            eltdSignInCallback();
        });

    }

    function eltdSignInCallback() {
        var signedIn = window.auth2.isSignedIn.get();
        if ( signedIn ) {
            var currentUser = window.auth2.currentUser.get(),
                profile = currentUser.getBasicProfile(),
                nonceField = $('.eltd-google-login-holder input[type="hidden"]').first(),
                nonce = nonceField.val(),
                userData = {
                    id : profile.getId(),
                    name : profile.getName(),
                    email : profile.getEmail(),
                    image : profile.getImageUrl(),
                    link : 'https://plus.google.com/' + profile.getId(),
                    nonce : nonce
                },
                data = {
                    action : 'search_and_go_elated_check_google_user',
                    response : userData
                };
            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedAjaxUrl,
                success: function(data) {
                    var response;
                    response = JSON.parse(data);
                    // append ajax response html
                    eltd.modules.common.eltdAjaxResponseMessageHtml(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        }
    }

})(jQuery);
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
(function($) {
    "use strict";

    var title = {};
    eltd.modules.title = title;

    title.eltdParallaxTitle = eltdParallaxTitle;

    title.eltdOnDocumentReady = eltdOnDocumentReady;
    title.eltdOnWindowLoad = eltdOnWindowLoad;
    title.eltdOnWindowResize = eltdOnWindowResize;
    title.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdParallaxTitle();
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
    

    /*
     **	Title image with parallax effect
     */
    function eltdParallaxTitle(){
        if($('.eltd-title.eltd-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.eltd-title.eltd-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.eltd-title.eltd-has-parallax-background.eltd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(eltd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(eltd.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});
            });

        }
    }

})(jQuery);

var j = jQuery.noConflict();
function CustomMarker( options ) {
    this.latlng = new google.maps.LatLng({lat: options.position.lat, lng: options.position.lng});
    this.setMap(options.map);
    this.templateData = options.templateData;
    this.markerData = {
        pin : options.markerPin
    };
}


CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {

    var self = this;

    var div = this.div;

    if (!div) {

        div = this.div = document.createElement('div');
        var title = this.templateData.title,
            title = title.toLowerCase(),
            title = title.replace(/ /g,'-');
        div.className = 'eltd-map-marker-holder';
        div.setAttribute("id", title);

        var markerInfoTemplate = _.template( j('.eltd-info-window-template').html() );
        markerInfoTemplate = markerInfoTemplate( self.templateData );

        var markerTemplate = _.template( j('.eltd-marker-template').html() );
        markerTemplate = markerTemplate( self.markerData );

        j(div).append(markerInfoTemplate);
        j(div).append(markerTemplate);

        div.style.position = 'absolute';
        div.style.cursor = 'pointer';

        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
    }

    var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

    if (point) {
        div.style.left = (point.x) + 'px';
        div.style.top = (point.y) + 'px';
    }
};

CustomMarker.prototype.remove = function() {
    if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
    }
};

CustomMarker.prototype.getPosition = function() {
    return this.latlng;
};
(function($) {
    "use strict";

    var maps = {};
    eltd.modules.maps = maps;
    eltd.modules.maps.eltdInitMultipleListingMap = eltdInitMultipleListingMap;
    eltd.modules.maps.eltdGoogleMaps = {};

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    function eltdOnDocumentReady() {

    }

    function eltdOnWindowLoad() {

        eltdInitSingleListingMap();
        eltdInitMultipleListingMap();
        eltdInitMobileMap();
    }

    function eltdOnWindowResize() {}

    function eltdOnWindowScroll() {}

    function eltdInitSingleListingMap() {
        var mapHolder = $('#eltd-listing-single-map');
        if ( mapHolder.length ) {
            eltd.modules.maps.eltdGoogleMaps.getDirectoryItemAddress({
                mapHolder: 'eltd-listing-single-map'
            });
        }
    }

    function eltdInitMultipleListingMap() {
        var mapHolder = $('#eltd-listing-multiple-map-holder');
        if ( mapHolder.length ) {
            eltd.modules.maps.eltdGoogleMaps.getDirectoryItemsAddresses({
                mapHolder: 'eltd-listing-multiple-map-holder',
                hasFilter: true
            });
        }
    }

    eltd.modules.maps.eltdGoogleMaps = {

        //Object varibles
        mapHolder : {},
        map : {},
        markers : {},
        radius : {},

        /**
         * Returns map with single address
         *
         * @param options
         */
        getDirectoryItemAddress : function( options ) {
            /**
             * use eltdMapsVars to get variables for address, latitude, longitude by default
             */
            var defaults = {
                location : eltdSingleMapVars.single.location,
                type : eltdSingleMapVars.single.listingType,
                zoom : 16,
                mapHolder : '',
                draggable : eltdMapsVars.global.draggable,
                mapTypeControl : eltdMapsVars.global.mapTypeControl,
                scrollwheel : eltdMapsVars.global.scrollable,
                streetViewControl : eltdMapsVars.global.streetViewControl,
                zoomControl : eltdMapsVars.global.zoomControl,
                title : eltdSingleMapVars.single.title,
                content : '',
                styles: eltdMapsVars.global.mapStyle,
                markerPin : eltdSingleMapVars.single.markerPin,
                featuredImage : eltdSingleMapVars.single.featuredImage,
                itemUrl : eltdSingleMapVars.single.itemUrl
            };
            var settings = $.extend( {}, defaults, options );

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;

            //Get map holder
            var mapHolder = document.getElementById( settings.mapHolder );

            //Initialize map
            var map = new google.maps.Map( mapHolder, {
                zoom : settings.zoom,
                draggable : settings.draggable,
                mapTypeControl : settings.mapTypeControl,
                scrollwheel : settings.scrollwheel,
                streetViewControl : settings.streetViewControl,
                zoomControl : settings.zoomControl
            });

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //Try to locate by latitude and longitude
            if ( typeof settings.location !== 'undefined' ) {
                var latLong = {
                    lat : parseFloat(settings.location.latitude),
                    lng : parseFloat(settings.location.longitude)
                };
                //Set map center to location
                map.setCenter(latLong);
                //Add marker to map

                var templateData = {
                    title : settings.title,
                    address : settings.location.address,
                    featuredImage : settings.featuredImage,
                    itemUrl : settings.itemUrl
                };

                var customMarker = new CustomMarker({
                    map : map,
                    position : latLong,
                    templateData : templateData,
                    markerPin : settings.markerPin
                });

                this.initMarkerInfo();

            }

        },

        /**
         * Returns map with multiple addresses
         *
         * @param options
         */
        getDirectoryItemsAddresses : function( options ) {

            var defaults = {
                geolocation : false,
                mapHolder : 'eltd-listing-multiple-map-holder',
                addresses : eltdMultipleMapVars.multiple.addresses,
                draggable : eltdMapsVars.global.draggable,
                mapTypeControl : eltdMapsVars.global.mapTypeControl,
                scrollwheel : eltdMapsVars.global.scrollable,
                streetViewControl : eltdMapsVars.global.streetViewControl,
                zoomControl : eltdMapsVars.global.zoomControl,
                zoom : 16,
                styles: eltdMapsVars.global.mapStyle,
                radius : 50, //radius for marker visibility, in km
                hasFilter : false
            };
            var settings = $.extend({}, defaults, options );

            //Get map holder
            var mapHolder = document.getElementById( settings.mapHolder );

            //Initialize map
            var map = new google.maps.Map( mapHolder, {
                zoom : settings.zoom,
                draggable : settings.draggable,
                mapTypeControl : settings.mapTypeControl,
                scrollwheel : settings.scrollwheel,
                streetViewControl : settings.streetViewControl,
                zoomControl : settings.zoomControl
            });

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;
            this.map = map;
            this.radius = settings.radius;

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //If geolocation enabled set map center to user location
            if ( navigator.geolocation && settings.geolocation ) {
                this.centerOnCurrentLocation();
            }

            //Filter addresses, remove items without latitude and longitude
            var addresses = [],
                addressesLength = settings.addresses.length;
            for ( var i = 0; i < addressesLength; i++ ) {
                var location = settings.addresses[i].location;
                if ( location.latitude !== '' && location.longitude !== '' ) {
                    addresses.push(settings.addresses[i]);
                }
            }

            //Center map and set borders of map
            this.setMapBounds( addresses );

            //Add markers to the map
            this.addMultipleMarkers( addresses );

            if ( settings.hasFilter ) {
                this.initMapFilter();
            }

        },

        /**
         * Add multiple markers to map
         */
        addMultipleMarkers : function( markersData ) {

            var map = this.map;

            var markers = [];
            //Loop through markers
            var len = markersData.length;
            for ( var i = 0; i < len; i++ ) {

                var latLng = {
                    lat: parseFloat(markersData[i].location.latitude),
                    lng: parseFloat(markersData[i].location.longitude)
                };

                //Custom html markers
                //Insert marker data into info window template
                var templateData = {
                    title : markersData[i].title,
                    address : markersData[i].location.address,
                    featuredImage : markersData[i].featuredImage,
                    itemUrl : markersData[i].itemUrl
                };

                var customMarker = new CustomMarker({
                    position : latLng,
                    map : map,
                    templateData : templateData,
                    markerPin : markersData[i].markerPin
                });

                markers.push(customMarker);

            }

            this.markers = markers;

            //Init map clusters ( Grouping map markers at small zoom values )
            this.initMapClusters();

            //Init marker info
            this.initMarkerInfo();

            //Init visible circle area around center of map
            var that = this;
            google.maps.event.addListener(map, 'idle', function(){
                var visibleRadius = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0,
                    strokeWeight: 0,
                    fillColor: '#FF0000',
                    fillOpacity: 0,
                    map: map,
                    center: map.getCenter(),
                    radius: that.radius * 1000 //in meters
                });
                //Display only markers in circle
                //that.refreshCircleAreaMarkers( visibleRadius.getBounds() );
            });

        },

        /**
         * Set map bounds for Map with multiple markers
         *
         * @param addressesArray
         */
        setMapBounds : function( addressesArray ) {

            var bounds = new google.maps.LatLngBounds();
            for ( var i = 0; i < addressesArray.length; i++ ) {
                bounds.extend( new google.maps.LatLng( parseFloat(addressesArray[i].location.latitude), parseFloat(addressesArray[i].location.longitude) ) );
            }

            this.map.fitBounds( bounds );

        },

        /**
         * Init map clusters for grouping markers on small zoom values
         */
        initMapClusters : function() {

            //Activate clustering on multiple markers
            var markerClusteringOptions = {
                minimumClusterSize: 2,
                maxZoom: 12,
                styles : [{
                    width: 50,
                    height: 60,
                    url: '',
                    textSize: 12
                }]
            };
            var markerClusterer = new MarkerClusterer(this.map, this.markers, markerClusteringOptions);

        },

        initMarkerInfo : function() {

            $(document).off('click', '.eltd-map-marker');
            $(document).on('click', '.eltd-map-marker', function() {
                var self = $(this),
                    markerHolders = $('.eltd-map-marker-holder'),
                    infoWindows = $('.eltd-info-window'),
                    markerHolder = self.parent('.eltd-map-marker-holder'),
                    infoWindow = self.siblings('.eltd-info-window');

                if ( markerHolder.hasClass('active') ) {
                    markerHolder.removeClass( 'active' );
                    infoWindow.fadeOut(0);
                } else {
                    markerHolders.removeClass('active');
                    infoWindows.fadeOut(0);
                    markerHolder.addClass('active');
                    infoWindow.fadeIn(300);
                }

            });

        },
        /**
         * Info Window for displaying data on map markers
         *
         * @returns {google.maps.InfoWindow}
         */
        addInfoWindow : function() {

            var contentString = '';
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });
            return infoWindow;

        },

        /**
         * If geolocation enabled center map on users current position
         */
        centerOnCurrentLocation : function() {
            var map = this.map;
            navigator.geolocation.getCurrentPosition(
                function(position){
                    var center = {
                        lat : position.coords.latitude,
                        lng : position.coords.longitude
                    };
                    map.setCenter(center);
                }
            );
        },

        /**
         * Refresh area for visible markers
         *
         * @param circleArea
         */
        refreshCircleAreaMarkers : function( circleArea ) {

            var length = this.markers.length;
            for ( var i = 0; i < length; i++ ) {
                if ( circleArea.contains( this.markers[i].getPosition() ) ) {
                    this.markers[i].setVisible(true);
                } else {
                    this.markers[i].setVisible(false);
                }
            }

        },

        /**
         * Initialize filter on map
         */
        initMapFilter : function() {

            var that = this,
                select = $('#listing-type-select, #listing-category-select, #listing-location-select').select2(),
                type = $('#listing-type-select'),
                category = $('#listing-category-select'),
                location = $('#listing-location-select'),
                preloader = $('.eltd-listing-list-preloader');

            select.on('select2:select', function(){

                preloader.fadeIn(200);
                var data = {
                    action : 'search_and_go_elated_filter_listing_items',
                    listingType : type.val(),
                    listingCategory : category.val(),
                    listingLocation : location.val()
                };

                $.ajax({
                    type: 'POST',
                    data: data,
                    url: ElatedAjaxUrl,
                    success: function(data) {
                        var data = JSON.parse(data),
                            markers = data.mapData;
                        that.renderPageCotnent(data.contentData);
                        that.getDirectoryItemsAddresses({
                            addresses: markers,
                            mapHolder: that.mapHolder
                        });
                        preloader.fadeOut(200);
                    }
                });

            });

        },

        /**
         * Remove old page content and append new one
         *
         * @param data
         */
        renderPageCotnent : function ( data ) {

            var contentHolder = $('.eltd-listing-list-with-map .eltd-listing-list-items');
            if ( contentHolder.length ) {
                contentHolder.empty();
                contentHolder.append( data );
            }

        }

    };

    function eltdInitMobileMap() {

        var mapOpener = $('.eltd-listing-view-larger-map a'),
            mapOpenerIcon = mapOpener.children('i'),
            mapHolder = $('.eltd-map-holder');
        if (mapOpener.length) {
            mapOpener.click(function(e){
                e.preventDefault();
                if (mapHolder.hasClass('eltd-fullscreen-map')) {
                    mapHolder.removeClass('eltd-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-minus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-plus');
                } else {
                    mapHolder.addClass('eltd-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-plus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-minus');
                }
                eltd.modules.maps.eltdGoogleMaps.getDirectoryItemsAddresses();
            });
        }

    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    eltd.modules.shortcodes = shortcodes;

    shortcodes.eltdInitCounter = eltdInitCounter;
    shortcodes.eltdInitProgressBars = eltdInitProgressBars;
    shortcodes.eltdInitCountdown = eltdInitCountdown;
    shortcodes.eltdInitMessages = eltdInitMessages;
    shortcodes.eltdInitMessageHeight = eltdInitMessageHeight;
    shortcodes.eltdInitTestimonials = eltdInitTestimonials;
    shortcodes.eltdInitCarousels = eltdInitCarousels;
    shortcodes.eltdInitPieChart = eltdInitPieChart;
    shortcodes.eltdInitPieChartDoughnut = eltdInitPieChartDoughnut;
    shortcodes.eltdInitBlogListMasonry = eltdInitBlogListMasonry;
    shortcodes.eltdCustomFontResize = eltdCustomFontResize;
    shortcodes.eltdInitImageGallery = eltdInitImageGallery;
    shortcodes.eltdShowGoogleMap = eltdShowGoogleMap;
    shortcodes.eltdInitListingFeatureList = eltdInitListingFeatureList;
    shortcodes.eltdInitListingPackageShortcode = eltdInitListingPackageShortcode;
    shortcodes.eltdInitListingPackagePayment = eltdInitListingPackagePayment;

    shortcodes.eltdOnDocumentReady = eltdOnDocumentReady;
    shortcodes.eltdOnWindowLoad = eltdOnWindowLoad;
    shortcodes.eltdOnWindowResize = eltdOnWindowResize;
    shortcodes.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitCounter();
        eltdInitProgressBars();
        eltdInitCountdown();
        eltdIcon().init();
        eltdInitMessages();
        eltdInitMessageHeight();
        eltdInitTestimonials();
        eltdInitCarousels();
        eltdInitPieChart();
        eltdInitPieChartDoughnut();
        eltdButton().init();
        eltdInitBlogListMasonry();
        eltdCustomFontResize();
        eltdInitImageGallery();
        eltdShowGoogleMap();
        eltdSocialIconWidget().init();
        eltdInitIconList().init();
        eltdInitListingFeatureList();
        eltdInitReservationForm();
        eltdInitListingSearchAutocomplete();
	    eltdInitListingPackageShortcode();
        eltdInitListingPackagePayment();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
         eltdInitListingFeatureList();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdInitBlogListMasonry();
        eltdCustomFontResize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
        
    }

    

    /**
     * Counter Shortcode
     */
    function eltdInitCounter() {

        var counters = $('.eltd-counter');


        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parent().addClass('eltd-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }

    }
    
    /*
    **	Horizontal progress bars shortcode
    */
    function eltdInitProgressBars(){
        
        var progressBar = $('.eltd-progress-bar');
        
        if(progressBar.length){
            
            progressBar.each(function() {
                
                var thisBar = $(this);
                
                thisBar.appear(function() {
                    eltdInitToCounterProgressBar(thisBar);
                    if(thisBar.find('.eltd-floating.eltd-floating-inside') !== 0){
                        var floatingInsideMargin = thisBar.find('.eltd-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.eltd-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.eltd-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.eltd-floating-inside').css('margin-bottom',-(floatingInsideMargin)+'px');
                    }
                    var percentage = thisBar.find('.eltd-progress-content').data('percentage'),
                        progressContent = thisBar.find('.eltd-progress-content'),
                        progressNumber = thisBar.find('.eltd-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 1500);

                });
            });
        }
    }

    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function eltdInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.eltd-progress-content').data('percentage'));
        var percent = progressBar.find('.eltd-progress-number .eltd-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.eltd-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }
    
    /*
    **	Function to close message shortcode
    */
    function eltdInitMessages(){
        var message = $('.eltd-message');
        if(message.length){
            message.each(function(){
                var thisMessage = $(this);
                thisMessage.find('.eltd-close').click(function(e){
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }
    
    /*
    **	Init message height
    */
    function eltdInitMessageHeight(){
       var message = $('.eltd-message.eltd-with-icon');
       if(message.length){
           message.each(function(){
               var thisMessage = $(this);
               var textHolderHeight = thisMessage.find('.eltd-message-text-holder').height();
               var iconHolderHeight = thisMessage.find('.eltd-message-icon-holder').height();
               
               if(textHolderHeight > iconHolderHeight) {
                   thisMessage.find('.eltd-message-icon-holder').height(textHolderHeight);
               } else {
                   thisMessage.find('.eltd-message-text-holder').height(iconHolderHeight);
               }
           });
       }
    }

    /**
     * Countdown Shortcode
     */
    function eltdInitCountdown() {

        var countdowns = $('.eltd-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px'
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var eltdIcon = eltd.modules.shortcodes.eltdIcon = function() {
        //get all icons on page
        var icons = $('.eltd-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('eltd-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.eltd-icon-animation-holder').addClass('eltd-icon-animation-show');
                }, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.eltd-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var eltdSocialIconWidget = eltd.modules.shortcodes.eltdSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.eltd-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function eltdInitTestimonials(){

        var testimonial = $('.eltd-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                thisTestimonial.appear(function() {
                    thisTestimonial.css('visibility','visible');
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

                var interval = 5000;
                var controlNav = true;
                var directionNav = false;
                var animationSpeed = 600;
                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }
                
                thisTestimonial.owlCarousel({
                    singleItem: true,
                    autoPlay: false,
                    navigation: directionNav,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: controlNav,
                    slideSpeed: animationSpeed,
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function eltdInitCarousels() {

        var carouselHolders = $('.eltd-carousel-holder'),
            carousel,
            numberOfItems,
            navigation;

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                carousel = $(this).children('.eltd-carousel');
                numberOfItems = carousel.data('items');
                navigation = (carousel.data('navigation') == 'yes') ? true : false;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                carousel.owlCarousel({
                    autoPlay: 3000,
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: true,
                    navigation: navigation,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });

            });
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function eltdInitPieChart() {

        var pieCharts = $('.eltd-pie-chart-holder, .eltd-pie-chart-with-icon-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.eltd-percentage, .eltd-percentage-with-icon'),
                    barColor = '#1ab5c1',
                    trackColor = '#eee',
                    lineWidth = 3,
                    size = percentageHolder.data('size') ? percentageHolder.data('size') : 145;

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.eltd-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /**
     * Init Pie Chart shortcode
     */
    function eltdInitPieChartDoughnut() {

        var pieCharts = $('.eltd-pie-chart-doughnut-holder, .eltd-pie-chart-pie-holder');

        pieCharts.each(function(){

            var pieChart = $(this),
                canvas = pieChart.find('canvas'),
                chartID = canvas.attr('id'),
                chart = document.getElementById(chartID).getContext('2d'),
                data = [],
                jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

            for (var i = 1; i<=10; i++) {

                var chartItem,
                    value = jqChart.data('value-' + i),
                    color = jqChart.data('color-' + i);
                
                if (typeof value !== 'undefined' && typeof color !== 'undefined' ) {
                    chartItem = {
                        value : value,
                        color : color
                    };
                    data.push(chartItem);
                }

            }

            if (canvas.hasClass('eltd-pie')) {
                new Chart(chart).Pie(data,
                    {segmentStrokeColor : 'transparent'}
                );
            } else {
                new Chart(chart).Doughnut(data,
                    {segmentStrokeColor : 'transparent'}
                );
            }

        });

    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var eltdButton = eltd.modules.shortcodes.eltdButton = function() {
        //all buttons on the page
        var buttons = $('.eltd-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };
    
    /*
    **	Init blog list masonry type
    */
    function eltdInitBlogListMasonry(){
        var blogList = $('.eltd-blog-list-holder.eltd-masonry .eltd-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                thisBlogList.animate({opacity: 1});
                thisBlogList.isotope({
                    itemSelector: '.eltd-blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.eltd-blog-list-masonry-grid-sizer',
                        gutter: '.eltd-blog-list-masonry-grid-gutter'
                    }
                });
            });

        }
    }

	/*
	**	Custom Font resizing
	*/
	function eltdCustomFontResize(){
		var customFont = $('.eltd-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (eltd.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (eltd.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (eltd.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (eltd.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (eltd.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && eltd.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && eltd.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function eltdShowGoogleMap(){

        if($('.eltd-google-map').length){
            $('.eltd-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "eltd-map-"+ uniqueId;

                eltdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function eltdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'eltd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Elated Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'eltd-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('eltd-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            eltdInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function eltdInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function eltdInitImageGallery() {

        var galleries = $('.eltd-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.eltd-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                gallery.owlCarousel({
                    singleItem: true,
                    autoPlay: autoplay * 1000,
                    navigation: navigation,
                    transitionStyle : animation, //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: pagination,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }

    }

    /**
     * List object that initializes list with animation
     * @type {Function}
     */
    var eltdInitIconList = eltd.modules.shortcodes.eltdInitIconList = function() {
        var iconList = $('.eltd-animate-list');

        /**
         * Initializes icon list animation
         * @param list current list shortcode
         */
        var iconListInit = function(list) {
            setTimeout(function(){
                list.appear(function(){
                    list.addClass('eltd-appeared');
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            },30);
        };

        return {
            init: function() {
                if(iconList.length) {
                    iconList.each(function() {
                        iconListInit($(this));
                    });
                }
            }
        };
    };
    
    function eltdInitListingFeatureList(){
        var featureLists = $('.eltd-listing-feat-list-holder');
        if(featureLists.length) {
            featureLists.each(function() {
                var thisList = $(this);
                var size = thisList.find('.eltd-listing-feat-list-holder-sizer').width();
                
                eltdInitListingFeature(thisList);
                eltdResizeListingFeature(size,thisList);
                
                $(window).resize(function(){
                    eltdInitListingFeature(thisList);
                    size = thisList.find('.eltd-listing-feat-list-holder-sizer').width();
                    eltdResizeListingFeature(size,thisList);
                });
                
            });
        }
    }
    
    function eltdInitListingFeature(container){
        
        container.waitForImages(function(){
           
            container.animate({opacity: 1});

            container.isotope({
                itemSelector: 'article',
                masonry: {
                    columnWidth: '.eltd-listing-feat-list-holder-sizer'
                }
            });
        });
            
    }
    
    
    function eltdResizeListingFeature(size,container){
       
        var listingFeatureElement = container.find('article');
        listingFeatureElement.css('height', size);
        eltd.modules.common.eltdInitParallax();
    }

    function eltdInitReservationForm() {

        var reservationForm = $('.eltd-listing-item-booking');
        if (reservationForm.length) {
            var selectFields = reservationForm.find('select');
            selectFields.select2({
                minimumResultsForSearch: Infinity
            });
            var dateField = reservationForm.find('.eltd-ot-date');
            dateField.each(function() {
                $(this).datepicker({
                    prevText: '<span class="arrow_carrot-left"></span>',
                    nextText: '<span class="arrow_carrot-right"></span>'
                });
            });
        }

    }


    function eltdInitListingSearchAutocomplete() {

        var listingSearchHolder = $('.eltd-listing-search-holder');
        if ( listingSearchHolder.length ) {

            var keywordsInput = listingSearchHolder.find('#keywords'),
                locationInput = listingSearchHolder.find('#location'),
                categoryInput = listingSearchHolder.find('#category');

            keywordsInput.autocomplete({
                source: eltdGlobalVars.vars.postTitles,
                appendTo: $('.eltd-listing-search-field.keywords')
            });
            locationInput.select2();
            categoryInput.select2();
        }

    }
    
    function eltdInitListingPackageShortcode(){
	
	var container = $('.eltd-listing-packages-wrapper');
	var packages = container.find('.eltd-price-table');

    if(packages.length){
        packages.each(function(){
            var thisPackage = $(this);
            var button = thisPackage.find('.eltd-price-button');
            button.on('click', function(){
                var thisButton = $(this);
                eltdListingTakeFreePackage(thisButton);
            });
        })
    }

    }
    
    function eltdListingTakeFreePackage(container){
	
        var fullPackageId = container.data('button-package-id');
        var packageDuration;
        if (typeof container.data('package-duration') !== 'undefined' && container.data('package-duration') !== false) {
            packageDuration = container.data('package-duration');
        }
        var packageId = fullPackageId.replace('eltd-package-id-', '');

        if(packageDuration !== '' && packageDuration !== 'undefined'){
            var ajaxData = {
                packageID : packageId,
                packageDuration: packageDuration,
                action: 'eltd_listing_take_free_package',
            }
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: ElatedAjaxUrl,
                success: function (data) {
                    var response = $.parseJSON(data);
                    var responseHtml =  response.html;
                    setTimeout(function(){
                        container.html(responseHtml);
                    },300)

                }
            });
        }


    }

    function eltdInitListingPackagePayment(){

        var container = $('.eltd-listing-packages-wrapper');
        var packages = container.find('.eltd-price-table');
        var forms = container.find('.eltd-listing-package-payment-form form');

        if(packages.length){
            packages.each(function(){
                var thisPackage = $(this);
                var button = thisPackage.find('.eltd-price-button');
                button.on('click', function(){
                    var thisButton = $(this);
                    var buttonID = thisButton.data('button-package-id');
                    if(forms.length){
                        forms.each(function(){
                            var thisForm = $(this);
                            if(thisForm.attr('id') === buttonID){
                                thisForm.submit();
                            }
                        })
                    }
                });
            })
        }
    }


})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function () {
        eltdInitQuantityButtons();
        eltdInitSelect2();
    });

    function eltdInitQuantityButtons() {

        $(document).on( 'click', '.eltd-quantity-minus, .eltd-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.parent().siblings('.eltd-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('eltd-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            inputField.trigger( 'change' );

        });

    }

    function eltdInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

    }


})(jQuery);