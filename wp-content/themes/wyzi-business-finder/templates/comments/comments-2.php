<div id="comments" class="comment-wrapper">
<?php
if ( have_comments() ) : ?>
	<h3><?php echo sprintf( esc_html__( 'Comments (%d)', 'wyzi-business-finder' ), get_comments_number() );?></h3>
	<ul class="comment-list">
	    <?php wp_list_comments( array( 'style' => 'ul', 'short_ping' => true, 'avatar_size' => 90 ) ); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<div class="nav-previous float-left"><?php
				previous_comments_link( '<i class="fa fa-angle-left"></i> ' . esc_html__( 'Older Comments', 'wyzi-business-finder' ) ); ?></div>
			<div class="nav-next float-right">
				<?php next_comments_link( esc_html__( 'Newer Comments', 'wyzi-business-finder' ) . ' <i class="fa fa-angle-right"></i>' ); ?>
			</div>
		</nav>

	<?php endif; ?>

<?php endif;?>

<?php if ( comments_open() ) : ?>
	<?php
	global $commenter;
	$user_logged_in = is_user_logged_in();
	$comment_field = '<div class="input-box comment-form-message"><label for="comment">' . esc_html__( 'COMMENT', 'wyzi-business-finder' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>' . ( $user_logged_in ?  '' : '</div>');
	$comment_args = array(
		'title_reply' => esc_html__( 'Leave a comment', 'wyzi-business-finder' ),
		'comment_notes_before' => '',
		'cancel_reply_link' => esc_html__( 'Cancel', 'wyzi-business-finder' ),
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="row"><div class="col-sm-4 col-xs-12"><label for="author">' . esc_html__( 'Name', 'wyzi-business-finder' ) . ' <span>*</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></div>',
			'email'  => '<div class="col-sm-4 col-xs-12"><label for="email">' . esc_html__( 'Email Address', 'wyzi-business-finder' ) . ' <span>*</span></label><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></div>',
			'url'  => '<div class="col-sm-4 col-xs-12"><label for="url">' . esc_html__( 'Website', 'wyzi-business-finder' ) . '</label><input id="website" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
			)
		),
		'comment_field' => $comment_field,
		'comment_notes_after' => '<button type="submit" class="action-btn btn-rounded bg-dark-grey btn-hover-blue">' . esc_html__( 'submit', 'wyzi-business-finder' ) . '</button>',
	);

	comment_form( $comment_args ); ?>


<?php elseif ( get_comment_pages_count() > 0 ) :?>
<div id="comment-form" class="comment-form-area margin-top-50 fix">
	<h3 class="no-comments">
		<?php esc_html_e( 'Comments are closed.', 'wyzi-business-finder' ); ?>
	</h3>
</div>
<?php endif; ?>
</div>