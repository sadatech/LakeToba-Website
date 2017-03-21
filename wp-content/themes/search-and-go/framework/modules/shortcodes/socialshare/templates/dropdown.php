<div class="eltd-social-share-holder eltd-dropdown">
	<a href="javascript:void(0)" target="_self" class="eltd-social-share-dropdown-opener">
		<?php
		echo search_and_go_elated_icon_collections()->renderIcon( 'ion-android-share-alt', 'ion_icons' );
		?>
		<span class="eltd-social-share-title"><?php esc_html_e('Share', 'search-and-go') ?></span>
	</a><!--
	--><div class="eltd-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				print $net;
			} ?>
		</ul>
	</div>
</div>