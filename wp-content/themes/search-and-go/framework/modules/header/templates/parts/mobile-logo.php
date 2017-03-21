<?php do_action('search_and_go_elated_before_mobile_logo'); ?>

<div class="eltd-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php search_and_go_elated_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('mobile logo','search-and-go'); ?>"/>
    </a>
</div>

<?php do_action('search_and_go_elated_after_mobile_logo'); ?>