<div <?php post_class( 'blog-item-wide the-post the-post-search' );?>>

	<?php if ( has_post_thumbnail() ) {?>
	<div class="image"><a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail( 'large' );?></a></div>
	<?php }?>
	<!-- Content -->
	<div class="content">
		<!-- Head -->
		<div class="head fix">
			<div class="meta float-left">
				<div class="date"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_time( get_option( 'date_format' ) );?></a></div>
				<div class="author"><?php echo sprintf( esc_html__( 'By: %s', 'wyzi-business-finder' ), get_the_author_posts_link() );?></div>
			</div>
			<div>
				<h3 class="title"><a href="<?php echo esc_url( get_permalink() );?>"><?php esc_html( the_title() );?></a></h3>
				<div class="blog-meta-data">
					<span class="blog-meta"><i class="fa fa-comment" aria-hidden="true"></i><a href="<?php echo ( esc_url( get_permalink() ) . ( 'on' == wyz_get_option( 'sticky-menu') ? ( 0 == get_comments_number() ? '#respond' : '#comments' ) : '' ) );?>"><?php comments_number();?></a></span>
					<?php if ( has_category() ) {?>
					<span class="blog-meta"><i class="fa fa-folder-open" aria-hidden="true"></i><?php echo get_the_category_list( ', ', '', get_the_ID() );?></span>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
			global $post;
			$pos = strpos( $post->post_content, '<!--more-->' );
			if ( $pos ) {
				the_excerpt();
			} else {
				if ( is_search() || is_category() ||is_tag() ) {
					echo strip_shortcodes( get_the_excerpt() );
				} else {
					the_content();
				}
			} ?>
		<?php wyz_link_pages()?>
		<!-- Footer -->
		<div class="footer fix">
			<!-- Tags -->
			<div class="tags">
				<?php the_tags( '' );?>
			</div>
		</div>
	</div>
</div>
