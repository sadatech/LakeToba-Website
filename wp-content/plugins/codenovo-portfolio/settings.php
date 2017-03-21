<?php

?>
<?php
$plugin_path =  CODENOVO_PLUGIN_DIR;
?>

<div class="cd-wrapper">
	<h2>Portfolio Settings</h2>
	<div class="div-wrapper">
    <div class="inside">
		<form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
            	<div class="filtering">
                    <h3>Set your Filtering Option</h3><br/> you can set your Filtering Style
                </div>
				<table class="form-table">
                    <tr>
                        <th>
                            <label for="cd_pf_animation">Show Filter Navigation:</label>
                        </th>
                        <td>
                            <select name="cd_pf_animation" id="cd_pf_animation">
                                <option value="1" <?php if(get_option('cd_pf_animation') == 1)echo "selected='selected'";?>>Yes</option>
                                <option value="2" <?php if(get_option('cd_pf_animation') == 2)echo "selected='selected'";?>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cd_pf_column">No of Column:</label></th>
                        <td>
                            <select name="cd_pf_column" id="cd_pf_column">
                                <option value="0" <?php if(get_option('cd_pf_column') == 0)echo 'selected';?> >
                                    Select Column Number
                                </option>
                                <option value="2" <?php if(get_option('cd_pf_column') == 2)echo 'selected';?> >
                                    2 Columns
                                </option>
                                <option value="3" <?php if(get_option('cd_pf_column') == 3)echo 'selected';?> >
                                    3 Columns
                                </option>
                                <option value="4" <?php if(get_option('cd_pf_column') == 4)echo 'selected';?> >
                                    4 Columns
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label>"Show All" button Text:</label></th>
                        <td>
                            <input type="text" name="cd_pf_effect" placeholder="Show All" value="<?php if(get_option('cd_pf_effect')!='')echo get_option('cd_pf_effect');?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cd_pf_easing">Easing:</label></th>
                        <td>
                            <select name="cd_pf_easing" id="cd_pf_easing">
                                <option value="easeInSine" <?php if(get_option('cd_pf_easing') == "easeInSine")echo 'selected';?> >easeInSine</option>
                                <option value="easeOutSine" <?php if(get_option('cd_pf_easing') == "easeOutSine")echo 'selected';?> >easeOutSine</option>
                                <option value="easeInOutSine" <?php if(get_option('cd_pf_easing') == "easeInOutSine")echo 'selected';?> >easeInOutSine</option>
                                <option value="easeInQuad" <?php if(get_option('cd_pf_easing') == "easeInQuad")echo 'selected';?> >easeInQuad</option>
                                <option value="easeOutQuad" <?php if(get_option('cd_pf_easing') == "easeOutQuad")echo 'selected';?> >easeOutQuad</option>
                                <option value="easeInOutQuad" <?php if(get_option('cd_pf_easing') == "easeInOutQuad")echo 'selected';?> >easeInOutQuad</option>
                                <option value="easeInCubic" <?php if(get_option('cd_pf_easing') == "easeInCubic")echo 'selected';?> >easeInCubic</option>
                                <option value="easeOutCubic" <?php if(get_option('cd_pf_easing') == "easeOutCubic")echo 'selected';?> >easeOutCubic</option>
                                <option value="easeInOutCubic" <?php if(get_option('cd_pf_easing') == "easeInOutCubic")echo 'selected';?> >easeInOutCubic</option>
                                <option value="easeInBack" <?php if(get_option('cd_pf_easing') == "easeInBack")echo 'selected';?> >easeInBack</option>
                                <option value="easeOutBack" <?php if(get_option('cd_pf_easing') == "easeOutBack")echo 'selected';?> >easeOutBack</option>
                                <option value="easeInOutBack" <?php if(get_option('cd_pf_easing') == "easeInOutBack")echo 'selected';?> >easeInOutBack</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
						<th><label for="cd_pf_duration">Duration (milliseconds):</label></th>
						<td><input id="cd_pf_duration" name="cd_pf_duration" type="text" placeholder="1000" value="<?php if(get_option('cd_pf_duration')!='')echo get_option('cd_pf_duration');?>"  /></td>
					</tr>
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="page_options" value="cd_pf_animation,cd_pf_column,cd_pf_effect,cd_pf_duration,cd_pf_easing" />
					<tr>
						<td><p class="submit"><input class="button button-primary submit_button" type="submit" name="Submit" value="<?php _e('Update Options') ?>" /></p></td>
					</tr>
				</table>
		</form>
        </div>
        <div class="right_section">

            <h3 class="title"><span>Shortcode</span></h3>
            <div class="title-description">
                <p>Insert in post/page editor or widgets - <strong>[codenovo-portfolio]</strong></p>
            </div>

            <h3 class="title"><span>PHP Function</span></h3>
            <div class="title-description">
                <p>Insert in template php files - <strong>codenovo_portfolio();</strong></p>
            </div>

            <h3 class="title"><span>Featured Image Size</span></h3>
            <div class="title-description">
                <p>Please keep in mind that to make your page look amazing you need to provide <strong style="font-size: 16px;">same size featured image</strong> for all portfolio items</p>
            </div>

            <h3 class="title"><span>About <span>Version <b><?php echo codenovo_get_version(); ?></b></span></span></h3>
            <div class="title-description">
                <p>
                     Codenovo Portfolio Plugin by Codenovo Private Limited. If you have any issue regarding the plugin then
                     let us know here: <a href="mailto:info@codenovo.com">info@codenovo.com.</a>
                </p>
                <p>
                     Codenovo started its journey as a privately owned software company focusing on bringing new ideas in
                     the software industry. Our goal is to develop customized, efficient and reliable business solutions
                     using cutting edge technologies. We sprint in discovering new technologies, architectures, methodologies
                     exploring the potentialities. Codenovo  is a web development company, build from simple html sites to
                     complex ecommerce sites, mobile websites, responsive designs, all kinds of php development, joomla,
                     wordpress and magento.
                </p>
                <p>
                    Check our recent work and contact us if you feel we are good at our field.
                </p>
            </div>

        </div>
	</div>
	</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        <?php if(get_option('cd_pf_animation') == "false"){ ?>
            jQuery('.animation-option').slideUp('slow');
        <?php } ?>
        jQuery('#cd_pf_animation').change(function(){
            if( jQuery('#cd_pf_animation').val() == 'true'){
                jQuery('.animation-option').slideDown('slow');
            }
            else{
                jQuery('.animation-option').slideUp('slow');
            }
        })
    })
</script>
