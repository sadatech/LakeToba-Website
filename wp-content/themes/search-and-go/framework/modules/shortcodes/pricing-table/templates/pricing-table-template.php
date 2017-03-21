<div <?php search_and_go_elated_class_attribute($pricing_table_classes)?>>
	<div class="eltd-price-table-inner">
		<?php if($active == 'yes'){ ?>
			<div class="eltd-active-text">
				<span class="eltd-active-text-inner">
					<?php echo esc_attr($active_text) ?>
				</span>
			</div>
		<?php } ?>	
		<ul>
			<li class="eltd-table-title">
				<h5 class="eltd-title-content"><?php echo esc_html($title) ?></h5>
			</li>
			<li class="eltd-table-prices">
				<div class="eltd-price-in-table">

				    <?php if($price !== ''){ ?>
						<span class="eltd-price">
						    <?php echo esc_attr($price)?>
						</span>

					    <span class="eltd-value">
						    <?php echo esc_attr($currency) ?>
					    </span>

					    <span class="eltd-mark">
						    <?php echo esc_attr($price_period)?>
						</span>

				    <?php }?>
				    
				</div>	
			</li>
			<li class="eltd-table-content">
				<?php
					$content = preg_replace('#^<\/p>|<p>$#', '', $content);
					echo do_shortcode($content);
				?>
			</li>
			<?php 
			if($show_button == "yes" && $button_text !== ''){
				$data_params = '';
				if($button_id !== ''){
					$data_params .= 'data-button-package-id = '.$button_id.' ';
				}
				if($package_duration !== ''){
					$data_params .= 'data-package-duration = '.$package_duration.' ';
				}
				?>
				<li class="eltd-price-button" <?php print $data_params?> >
					<?php
					$button_params = array(
						'link' => $link,
						'type' => 'solid',
						'text' => esc_html($button_text, 'search-and-go' ),
						'icon_pack' => 'font_elegant',
						'fe_icon' => 'arrow_carrot-right'
					);
					if ( $active !== 'yes' ) {
						$button_params['background_color'] = '#4c4c4c';
						$button_params['border_color'] = '#4c4c4c';
						$button_params['hover_color'] = '#4c4c4c';
						$button_params['hover_border_color'] = '#4c4c4c';
					}
					echo search_and_go_elated_get_button_html( $button_params ); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>