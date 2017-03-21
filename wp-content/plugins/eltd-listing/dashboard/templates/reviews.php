<div class="eltd-user-review">
	<h2><?php echo get_comment_meta( $comment->comment_ID, 'eltd_comment_title', true ); ?></h2>
	<p class="eltd-review-text"><?php echo esc_html($comment->comment_content); ?></p>
	<p class="eltd-review-rating"><?php echo get_comment_meta( $comment->comment_ID, 'eltd_rating', true ); ?></p>
</div>