/* OPTIONS PAGE */
jQuery(document).ready(function ($) {
	$('#js-afp-options-form').each(function () {

		var form = $(this);
		var heightTr = $('#afp-options-form-height');
		var cropCheck = $('#cropThumbnails');

		var updateHeightVisible = function () {
			if (cropCheck.is(':checked')) {
				heightTr.show();
			}
			else {
				heightTr.hide();
			}
		};

		updateHeightVisible();
		cropCheck.on('change', updateHeightVisible);
	});
});