(function($) {
    "use strict";


    var blog = {};
    eltd.modules.blog = blog;

    blog.eltdOnDocumentReady = eltdOnDocumentReady;
    blog.eltdOnWindowLoad = eltdOnWindowLoad;
    blog.eltdOnWindowResize = eltdOnWindowResize;
    blog.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {
        eltdInitBlogMasonry();
        eltdInitBlogMasonryLoadMore();
        eltdInitBlogLoadMore();
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

    function eltdInitBlogMasonry() {

        if($('.eltd-blog-holder.eltd-blog-type-masonry').length) {

            var container = $('.eltd-blog-holder.eltd-blog-type-masonry');

            container.isotope({
                itemSelector: 'article',
                resizable: false,
                masonry: {
                    columnWidth: '.eltd-blog-masonry-grid-sizer',
                    gutter: '.eltd-blog-masonry-grid-gutter'
                }
            });

            container.waitForImages(function(){
                container.css({'visibility':'visible'});
                container.animate({'opacity':1},600);
            });

            var filters = $('.eltd-filter-blog-holder');
            $('.eltd-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.eltd-active').removeClass('eltd-active');
                filter.addClass('eltd-active');
                container.isotope({filter: selector});
                return false;
            });
        }
    }

    function eltdInitBlogMasonryLoadMore() {

        if($('.eltd-blog-holder.eltd-blog-type-masonry').length) {

            var container = $('.eltd-blog-holder.eltd-blog-type-masonry');

            if(container.hasClass('eltd-masonry-pagination-infinite-scroll')) {
                container.infinitescroll({
                        navSelector: '.eltd-blog-infinite-scroll-button',
                        nextSelector: '.eltd-blog-infinite-scroll-button a',
                        itemSelector: 'article',
                        loading: {
                            finishedMsg: eltdGlobalVars.vars.eltdFinishedMessage,
                            msgText: eltdGlobalVars.vars.eltdMessage
                        }
                    },
                    function(newElements) {
                        container.append(newElements).isotope('appended', $(newElements));
                        eltd.modules.blog.eltdInitAudioPlayer();
                        eltd.modules.common.eltdOwlSlider();
                        eltd.modules.common.eltdFluidVideo();
                        setTimeout(function() {
                            container.isotope('layout');
                        }, 400);
                    }
                );
            } else if(container.hasClass('eltd-masonry-pagination-load-more')) {
                var i = 1;
                $('.eltd-blog-load-more-button a').on('click', function(e) {
                    e.preventDefault();

                    var button = $(this);

                    var link = button.attr('href');
                    var content = '.eltd-masonry-pagination-load-more';
                    var anchor = '.eltd-blog-load-more-button a';
                    var nextHref = $(anchor).attr('href');
                    $.get(link + '', function(data) {
                        var newContent = $(content, data).wrapInner('').html();
                        nextHref = $(anchor, data).attr('href');
                        container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        eltd.modules.blog.eltdInitAudioPlayer();
                        eltd.modules.common.eltdOwlSlider();
                        eltd.modules.common.eltdFluidVideo();
                        setTimeout(function() {
                            $('.eltd-masonry-pagination-load-more').isotope('layout');
                        }, 400);
                        if(button.parent().data('rel') > i) {
                            button.attr('href', nextHref); // Change the next URL
                        } else {
                            button.parent().remove();
                        }
                    });
                    i++;
                });
            }
        }
    }
    function eltdInitBlogLoadMore(){
        var blogHolder = $('.eltd-blog-holder.eltd-blog-load-more:not(.eltd-blog-type-masonry)');
        
        if(blogHolder.length){
            blogHolder.each(function(){
                var thisBlogHolder = $(this);
                var nextPage;
                var maxNumPages;
                
                var loadMoreButton = thisBlogHolder.find('.eltd-load-more-ajax-pagination .eltd-btn');
                maxNumPages =  thisBlogHolder.data('max-pages');                
                
                loadMoreButton.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    var loadMoreDatta = getBlogLoadMoreData(thisBlogHolder);
                    nextPage = loadMoreDatta.nextPage;
                    
                    if(nextPage <= maxNumPages){
                        var ajaxData = setBlogLoadMoreAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: ElatedAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisBlogHolder.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml =  response.html;
                                thisBlogHolder.waitForImages(function(){    
                                    thisBlogHolder.find('article:last').after(responseHtml); // Append the new content 
                                    setTimeout(function() {               
                                        eltd.modules.blog.eltdInitAudioPlayer();
                                        eltd.modules.common.eltdOwlSlider();
                                        eltd.modules.common.eltdFluidVideo();
                                    },400);
                                });
                            }
                        });
                    }
                    
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                    
                });
            });
        }
    }
    function getBlogLoadMoreData(container){
        
        var returnValue = {};
        
        returnValue.nextPage = '';
        returnValue.number = '';
        returnValue.category = '';
        returnValue.blogType = '';
        returnValue.archiveCategory = '';
        returnValue.archiveAuthor = '';
        returnValue.archiveTag = '';
        returnValue.archiveDay = '';
        returnValue.archiveMonth = '';
        returnValue.archiveYear = '';
        
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('post-number') !== 'undefined' && container.data('post-number') !== false) {                    
            returnValue.number = container.data('post-number');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('blog-type') !== 'undefined' && container.data('blog-type') !== false) {                    
            returnValue.blogType = container.data('blog-type');
        }
        if (typeof container.data('archive-category') !== 'undefined' && container.data('archive-category') !== false) {                    
            returnValue.archiveCategory = container.data('archive-category');
        }
        if (typeof container.data('archive-author') !== 'undefined' && container.data('archive-author') !== false) {                    
            returnValue.archiveAuthor = container.data('archive-author');
        }
        if (typeof container.data('archive-tag') !== 'undefined' && container.data('archive-tag') !== false) {                    
            returnValue.archiveTag = container.data('archive-tag');
        }
        if (typeof container.data('archive-day') !== 'undefined' && container.data('archive-day') !== false) {                    
            returnValue.archiveDay = container.data('archive-day');
        }
        if (typeof container.data('archive-month') !== 'undefined' && container.data('archive-month') !== false) {                    
            returnValue.archiveMonth = container.data('archive-month');
        }
        if (typeof container.data('archive-year') !== 'undefined' && container.data('archive-year') !== false) {                    
            returnValue.archiveYear = container.data('archive-year');
        }
        
        return returnValue;
        
    }
    
    function setBlogLoadMoreAjaxData(container){
        
        var returnValue = {
            action: 'search_and_go_elated_blog_load_more',
            nextPage: container.nextPage,
            number: container.number,
            category: container.category,
            blogType: container.blogType,
            archiveCategory: container.archiveCategory,
            archiveAuthor: container.archiveAuthor,
            archiveTag: container.archiveTag,
            archiveDay: container.archiveDay,
            archiveMonth: container.archiveMonth,
            archiveYear: container.archiveYear
        };
        
        return returnValue;
    }



})(jQuery);