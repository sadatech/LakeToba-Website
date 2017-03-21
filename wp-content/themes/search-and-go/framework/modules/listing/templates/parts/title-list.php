<?php
$subtitle = get_post_meta( get_the_ID(), 'eltd_listing_subtitle', true );
?>
<div class="eltd-listing-title-holder">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_title('<h3 class="eltd-listing-title" itemprop="name">', '</h3>'); ?>
	</a>
</div>