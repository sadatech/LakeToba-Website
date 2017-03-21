<?php

$post_type = isset($_GET['type']) ? $_GET['type'] : null;
if ( $post_type && locate_template( 'search-' . $post_type . '.php' ) ) {

get_template_part( 'search', $post_type );

} else {

	global $wp_query;

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }

	if(search_and_go_elated_options()->getOptionValue('blog_page_range') != ""){
		$blog_page_range = esc_attr(search_and_go_elated_options()->getOptionValue('blog_page_range'));
	} else{
		$blog_page_range = $wp_query->max_num_pages;
	}

	$sidebar = search_and_go_elated_sidebar_layout();
	get_header();
	search_and_go_elated_get_title();

	?>

	<div class="eltd-container">
		<?php do_action('search_and_go_elated_after_container_open'); ?>
		<div class="eltd-container-inner clearfix">
			<div class="eltd-container">
				<?php do_action('search_and_go_elated_after_container_open'); ?>
				<div class="eltd-container-inner" >
					<div class="eltd-blog-holder eltd-blog-type-standard">
						<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="eltd-post-content">
									<div class="eltd-post-text">
										<div class="eltd-post-text-inner">
											<h2>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											</h2>
											<?php
											search_and_go_elated_read_more_button();
											?>
										</div>
									</div>
								</div>
							</article>
						<?php endwhile; ?>
							<?php
							if(search_and_go_elated_options()->getOptionValue('pagination') == 'yes') {
								search_and_go_elated_pagination($wp_query->max_num_pages, $blog_page_range, $paged);
							}
							?>
						<?php else: ?>
							<div class="entry">
								<p><?php esc_html_e('No posts were found.', 'search-and-go'); ?></p>
							</div>
						<?php endif; ?>
					</div>
					<?php do_action('search_and_go_elated_before_container_close'); ?>
				</div>
			</div>
		</div>
		<?php do_action('search_and_go_elated_before_container_close'); ?>
	</div>
	<?php get_footer();

}