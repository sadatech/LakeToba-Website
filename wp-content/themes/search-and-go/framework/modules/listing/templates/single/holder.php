<div class="eltd-container">
    <?php if ( $overlapping_content ) { ?>
    <div class="eltd-overlapping-content">
    <?php } ?>
        <div class="eltd-container-inner clearfix">
            <div <?php search_and_go_elated_class_attribute($holder_class); ?>>
                <?php if(post_password_required()) {
                    echo get_the_password_form();
                } else {
                    //load proper listing template
                    search_and_go_elated_get_module_template_part('templates/single/single', 'listing', $listing_template);
                } ?>
            </div>
        </div>
    <?php if ( $overlapping_content ) { ?>
    </div>
    <?php } ?>
</div>