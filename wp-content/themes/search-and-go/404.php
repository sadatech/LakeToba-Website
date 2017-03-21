<?php get_header(); ?>

<?php search_and_go_elated_get_title(); ?>

	<div class="eltd-container">
		<?php do_action( 'search_and_go_elated_after_container_open' ); ?>
		<div class="eltd-container-inner eltd-404-page">
			<div class="eltd-page-not-found">
				<h2>
					<?php if ( search_and_go_elated_options()->getOptionValue( '404_title' ) ) {
						echo esc_html( search_and_go_elated_options()->getOptionValue( '404_title' ) );
					} else {
						esc_html_e( 'Page you are looking is not found', 'search-and-go' );
					} ?>
				</h2>
				<h4>
					<?php if ( search_and_go_elated_options()->getOptionValue( '404_text' ) ) {
						echo esc_html( search_and_go_elated_options()->getOptionValue( '404_text' ) );
					} else {
						esc_html_e( 'The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'search-and-go' );
					} ?>
				</h4>
				<?php
				$params = array();
				if ( search_and_go_elated_options()->getOptionValue( '404_back_to_home' ) ) {
					$params['text'] = search_and_go_elated_options()->getOptionValue( '404_back_to_home' );
				} else {
					$params['text'] = "Back to Home Page";
				}
				$params['link']   = esc_url( home_url( '/' ) );
				$params['target'] = '_self';
				echo search_and_go_elated_execute_shortcode( 'eltd_button', $params ); ?>
			</div>
		</div>
		<?php do_action( 'search_and_go_elated_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>