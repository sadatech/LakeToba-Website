<div class="eltd-comment-holder clearfix" id="comments">
	<div class="eltd-comment-number">
		<div class="eltd-comment-number-inner">
			<h5><?php
				if ( is_singular('listing-item')) {
					comments_number( esc_html__('No Reviews','search-and-go'), '1'.esc_html__(' Review ','search-and-go'), '% '.esc_html__(' Reviews ','search-and-go'));
				} else {
					comments_number( esc_html__('No Comments','search-and-go'), '1'.esc_html__(' Comment ','search-and-go'), '% '.esc_html__(' Comments ','search-and-go'));
				}
				?>
			</h5>
		</div>
	</div>
<div class="eltd-comments">
<?php if ( post_password_required() ) : ?>
				<p class="eltd-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'search-and-go' ); ?></p>
			</div></div>
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>

	<ul class="eltd-comment-list">
		<?php
		if ( is_singular('listing-item')) {
			wp_list_comments(array( 'callback' => 'search_and_go_elated_rating'));
		} else {
			wp_list_comments(array( 'callback' => 'search_and_go_elated_comment'));
		}
		?>
	</ul>


<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'search-and-go'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div></div>
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( 'Post a Comment','search-and-go' ),
	'title_reply_to' => esc_html__( 'Post a Reply to %s','search-and-go' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply','search-and-go' ),
	'label_submit' => esc_html__( 'Publish','search-and-go' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Write your comment here...','search-and-go' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<input id="author" name="author" placeholder="'. esc_html__( 'Your full name','search-and-go' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /><!--',
		'url' => '--><input id="email" name="email" placeholder="'. esc_html__( 'E-mail address','search-and-go' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /><!--',
		'email' => '--><input id="url" name="url" type="text" placeholder="'. esc_html__( 'Website','search-and-go' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />'
		 )
	)
);
if ( is_singular('listing-item')) {
	$args['comment_field'] = '<textarea id="comment" placeholder="'.esc_html__( 'Your Experience','search-and-go' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
	$args['fields'] = apply_filters( 'comment_form_default_fields', array(
			'author' => '<input id="author" name="author" placeholder="'. esc_html__( 'Your full name','search-and-go' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /><!--',
			'url' => '--><input id="email" name="email" placeholder="'. esc_html__( 'E-mail address','search-and-go' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />',
		)
	);
}

 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="eltd-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
 <div class="eltd-comment-form <?php if ( is_user_logged_in() ) { echo 'logged-in'; } ?>">
	<?php comment_form($args); ?>
</div>
								
							


