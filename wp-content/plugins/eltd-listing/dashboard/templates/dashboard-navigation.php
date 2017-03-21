<div class="eltd-listing-dashboard-nav-holder clearfix">
	<ul class="eltd-listing-dashboard-nav clearfix">
		<?php
			do_action('search_and_go_elated_dashboard_menu_items');
		?>
		<li>
			<span class="eltd-dashboard-menu-icon lnr lnr-exit"></span>
			<a href="<?php echo wp_logout_url( home_url('/') ); ?>">
				<?php esc_html_e( 'Log out', 'eltd_listing' ); ?>
			</a>
		</li>
	</ul>
</div>