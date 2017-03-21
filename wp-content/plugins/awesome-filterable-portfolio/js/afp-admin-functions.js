/* MEDIA UPLOADER */
jQuery(document).ready(function($){

	$('#thumbnail').click(function (e) {
		e.preventDefault();
		var thumb = wp.media({
			title:    'Upload Thumbnail',
			multiple: false
		}).open().on('select', function (e) {
			var thumb_url = thumb.state().get('selection').first().toJSON().url;
			$('#thumbnail_adr').val(thumb_url);
			showCurrentImage();
		});
		return false;
	});

	$('#image').click(function (e) {
		e.preventDefault();
		var image = wp.media({
			title:    'Upload Image',
			multiple: false
		}).open().on('select', function (e) {
			var image_url = image.state().get('selection').first().toJSON().url;
			$('#image_adr').val(image_url);
			$('#thumbnail_adr').val('');
			showCurrentImage();
		});
		return false;
	});

	/**
	 * Show current image in item form
	 */
	var showCurrentImage = function () {
		var src = $('#image_adr').val();
		src && $('#js-image-container').empty().append(
			'<a class="afp-item-form-image-preview" href="' +
			src +
			'" target="_blank"><img src="'+src+'" /></a>'
		);
	};
	showCurrentImage();
});

/* DATEPICKER */
jQuery(document).ready(function($){
	$('#date').datepicker({ showAnim: 'fadeIn' });
});

