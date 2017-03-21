<?php do_action('search_and_go_elated_before_site_logo'); ?>

<div class="eltd-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php search_and_go_elated_inline_style($logo_styles); ?>>
        <img class="eltd-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','search-and-go'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="eltd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('dark logo','search-and-go'); ?>o"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="eltd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('light logo','search-and-go'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('search_and_go_elated_after_site_logo'); ?>