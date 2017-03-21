<?php

$tags = wp_get_post_terms(get_the_ID(), 'listing-item-tag');

if(is_array($tags) && count($tags)) : ?>

	<div class="eltd-listing-tags-holder eltd-listing-part">

		<h5 class="eltd-listing-tags-title">
			<?php esc_html_e('Tags', 'search-and-go'); ?>
		</h5>


		<?php foreach($tags as $tag) {

			$tag_link = get_term_link($tag->term_id, 'listing-item-tag');

			?>

			<a href="<?php echo esc_url($tag_link); ?>"  title="<?php echo esc_attr($tag->name)?>">

				<?php echo esc_attr($tag->name)?>

			</a>

		<?php }
	?>
	</div>

<?php endif; ?>

	
