<?php
$icon_html = search_and_go_elated_icon_collections()->renderIcon($icon, $icon_pack);
?>

<div class="eltd-message-icon-holder">
	<div class="eltd-message-icon">
		<div class="eltd-message-icon-inner">
			<?php
				print $icon_html;
			?>			
		</div> 
	</div>	 
</div>

