(function($){

    $(document).ready(function() {
        eltdInitMediaUploader();
        eltdInitIconSelectDependency();
    });

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

    function eltdInitIconSelectDependency() {

        var iconPack = $('#icon_pack'),
            holders = $('.term-icons-wrap .icon-collection');

        var checkDependency = function() {
            holders.each(function(){
                var value = iconPack.val(),
                    holder = $(this);
                if ( holder.hasClass( value ) ) {
                    holder.fadeIn(300);
                } else {
                    holder.fadeOut(300);
                }
            });
        };
        checkDependency();

        iconPack.change( function() {
            checkDependency();
        });

    }

})(jQuery);
