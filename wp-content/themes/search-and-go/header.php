<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php if (!search_and_go_elated_is_ajax_request()) search_and_go_elated_wp_title(); ?>
    <?php
    /**
     * @see search_and_go_elated_header_meta() - hooked with 10
     * @see eltd_user_scalable - hooked with 10
     */
    ?>
	<?php if (!search_and_go_elated_is_ajax_request()) do_action('search_and_go_elated_header_meta'); ?>

	<?php if (!search_and_go_elated_is_ajax_request()) wp_head(); ?>
</head>

<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">

<?php 
if((!search_and_go_elated_is_ajax_request()) && search_and_go_elated_options()->getOptionValue('smooth_page_transitions') == "yes") {
    $ajax_class = search_and_go_elated_options()->getOptionValue('smooth_pt_true_ajax') === 'no' ? 'eltd-mimic-ajax' : 'eltd-ajax';
?>
<div class="eltd-smooth-transition-loader <?php echo esc_html($ajax_class); ?>">
    <div class="eltd-st-loader">
        <div class="eltd-st-loader1">
            <?php search_and_go_elated_loading_spinners(); ?>
        </div>
    </div>
</div>
<?php } ?>

<div class="eltd-wrapper">
    <div class="eltd-wrapper-inner">
        <?php if (!search_and_go_elated_is_ajax_request()) search_and_go_elated_get_header(); ?>
        <?php if ((!search_and_go_elated_is_ajax_request()) && search_and_go_elated_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='eltd-back-to-top'  href='#'>
                <span class="eltd-icon-stack">
                     <?php
                        search_and_go_elated_icon_collections()->getBackToTopIcon('font_elegant');
                        search_and_go_elated_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                </span>
            </a>
        <?php } ?>

        <div class="eltd-content" <?php search_and_go_elated_content_elem_style_attr(); ?>>
            <?php if(search_and_go_elated_is_ajax_enabled()) { ?>
            <div class="eltd-meta">
                <?php do_action('search_and_go_elated_ajax_meta'); ?>
                <span id="eltd-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
                <div class="eltd-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
            </div>
            <?php } ?>
            <div class="eltd-content-inner">