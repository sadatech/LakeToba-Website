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