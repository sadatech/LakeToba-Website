<div class="eltd-related-posts-holder">
	<?php if ( $related_posts && $related_posts->have_posts() ) : ?>
		<div class="eltd-related-posts-title">
			<h3><?php esc_html_e( 'Related Posts', 'search-and-go' ); ?></h3>
		</div>
		<div class="eltd-related-posts-inner clearfix">
			<?php while ( $related_posts->have_posts() ) :
				$related_posts->the_post();
				$related_post_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
				?>
				<div class="eltd-related-post">

					<?php if ( has_post_thumbnail() ) {	?>
						<a href="<?php the_permalink(); ?> ">
							<div class="eltd-related-post-image"  style="background-image: url(' <?php echo search_and_go_elated_kses_img($related_post_image[0]); ?> ')">
							</div>
						</a>
					<?php } ?>

					<div class="eltd-related-post-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title( '<h5>', '</h5>' ); ?></a>
					</div>
					<div class="eltd-related-post-excerpt">
						<?php search_and_go_elated_excerpt(4); ?>
					</div>
				</div>
				<?php
			endwhile; ?>
		</div>
	<?php endif;
	wp_reset_postdata();
	?>
</div>