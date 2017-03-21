<?php if ( search_and_go_elated_options()->getOptionValue('enable_listing_item_comments') == 'yes' ) { ?>

	<div class="eltd-listing-comments eltd-listing-part">
		<?php comments_template('', true); ?>
	</div>

<?php } ?>

