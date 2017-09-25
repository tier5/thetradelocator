<?php

if ( have_comments() ) : ?>
<!-- Comment List -->
<div id="comments" class="comment-list margin-bottom-50 margin-top-50 fix">
	<h3><?php esc_html_e( 'Comments', 'wyzi-business-finder' );?></h3>
	<h5 class="comments-title">
		<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'wyzi-business-finder' ), number_format_i18n( get_comments_number() ), esc_html( get_the_title() ) ); ?>
	</h5>
	<div class="comment-list">
		<?php wp_list_comments( array( 'style' => 'div', 'short_ping' => true, 'avatar_size' => 72 ) ); ?>
	</div>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<div class="nav-previous float-left"><?php
				previous_comments_link( '<i class="fa fa-angle-left"></i> ' . esc_html__( 'Older Comments', 'wyzi-business-finder' ) ); ?></div>
			<div class="nav-next float-right">
				<?php next_comments_link( esc_html__( 'Newer Comments', 'wyzi-business-finder' ) . ' <i class="fa fa-angle-right"></i>' ); ?>
			</div>
		</nav>

	<?php endif; ?>
	
</div>

<?php endif;?>

<?php if ( comments_open() ) : ?>

<div id="comment-form" class="comment-form-area margin-top-50 fix">
		<?php
		global $commenter;
		$comment_args = array(
			'title_reply' => esc_html__( 'post a comment', 'wyzi-business-finder' ),
			'comment_notes_before' => '',
			'cancel_reply_link' => esc_html__( 'Cancel', 'wyzi-business-finder' ),
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="input-three"><div class="input-box comment-form-author"><label for="author">' . esc_html__( 'Name', 'wyzi-business-finder' ) . ' <span>*</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></div>',
				'email'  => '<div class="input-box comment-form-email"><label for="email">' . esc_html__( 'Email Address', 'wyzi-business-finder' ) . ' <span>*</span></label><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></div>',
				'url'  => '<div class="input-box comment-form-website"><label for="url">' . esc_html__( 'Website', 'wyzi-business-finder' ) . '</label><input id="website" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
				)
			),
			'comment_field' => '<div class="input-box comment-form-message"><label for="comment">' . esc_html__( 'COMMENT', 'wyzi-business-finder' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
			'comment_notes_after' => '<button type="submit" class="wyz-button orange icon">' . esc_html__( 'submit', 'wyzi-business-finder' ) . ' <i class="fa fa-angle-right"></i></button>',
			); ?>
			
		
		<?php comment_form( $comment_args ); ?>
</div>

<?php elseif ( get_comment_pages_count() > 0 ) :?>
<div id="comment-form" class="comment-form-area margin-top-50 fix">
	<h3 class="no-comments">
		<?php esc_html_e( 'Comments are closed.', 'wyzi-business-finder' ); ?>
	</h3>
</div>
<?php endif;
