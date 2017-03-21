<div class="eltd-post-info-date">
	
	<?php if(!search_and_go_elated_post_has_title()) { ?>
	<a href="<?php the_permalink() ?>">
		<?php } ?>

		<?php the_time(get_option('date_format')); ?>

		<?php if(!search_and_go_elated_post_has_title()) { ?>
	</a>
	<?php } ?>
	
</div>