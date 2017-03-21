<button type="submit" <?php search_and_go_elated_inline_style($button_styles); ?> <?php search_and_go_elated_class_attribute($button_classes); ?> <?php echo search_and_go_elated_get_inline_attrs($button_data); ?> <?php echo search_and_go_elated_get_inline_attrs($button_custom_attrs); ?>>
    <span class="eltd-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo search_and_go_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>