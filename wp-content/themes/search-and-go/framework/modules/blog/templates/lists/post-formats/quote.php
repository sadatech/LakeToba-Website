<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltd-post-content"  style="background-image: url(' <?php echo search_and_go_elated_kses_img($params['quote_image'][0]); ?> ')">
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner">
				<div class="eltd-post-title">
					
					<span class="eltd-post-quote-holder">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php echo esc_html(get_post_meta(get_the_ID(), "eltd_post_quote_text_meta", true)); ?>
						</a>
					</span>	
					
					<span class="eltd-post-quote-author">
						<?php esc_html_e('by', 'search-and-go'); ?>
						<span>
							<?php the_title(); ?>
						</span>						
					</span>
					
				</div>
			</div>
		</div>
	</div>
	<div class="eltd-quote-bottom-section">
		<div class="eltd-post-info eltd-left-section">
			<?php search_and_go_elated_post_info(array('category' => 'yes')) ?>
		</div>
		<div class="eltd-post-info eltd-right-section">
			<?php search_and_go_elated_post_info(array('date' => 'yes', 'author' => 'yes')) ?>
		</div>
	</div>
</article>