<?php if ( has_post_thumbnail() ) { ?>
	<div class="eltd-listing-image eltd-listing-part" >
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('full', array( 'itemprop' => 'image' ) ); ?>
		</a>
	</div>
<?php }