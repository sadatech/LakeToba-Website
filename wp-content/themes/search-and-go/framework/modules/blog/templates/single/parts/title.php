<?php
if ( isset( $title_tag ) ) {
	$title_tag = $title_tag;
} else {
	$title_tag = 'h2';
}
$link_href = '';

if ( isset( $link_attr ) && $link_attr !== '' ) {
	$link_href = $link_attr;
}
?>

<<?php echo esc_attr( $title_tag ); ?> class="eltd-post-title">
<?php if ( $link_href !== '' ) {
	echo '<a href="' . esc_url( $link_href ) . '">';
}
the_title();
if ( $link_href !== '' ) {
	echo '</a>';
} ?>
</<?php echo esc_attr( $title_tag ); ?>>