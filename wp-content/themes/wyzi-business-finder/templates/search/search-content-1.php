<div class="sin-blog the-post the-post-search">
	
	<!-- Blog Content -->
	<div class="content">
		<h2 class="title"><a href="<?php echo esc_url( get_permalink() );?>"><?php esc_html( the_title() );?></a></h2>
		<!-- Blog Meta -->
		<div class="blog-meta-data fix">
			<span class="blog-meta"><i class="fa fa-calendar" aria-hidden="true"></i><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_time( get_option( 'date_format' ) );?></a></span>
			<span class="blog-meta"><i class="fa fa-user" aria-hidden="true"></i><?php the_author_posts_link();?></span>
			<span class="blog-meta"><i class="fa fa-comment" aria-hidden="true"></i><a href="<?php echo ( esc_url( get_permalink() ) . ( 'on' == wyz_get_option( 'sticky-menu') ? ( 0 == get_comments_number() ? '#respond' : '#comments' ) : '' ) );?>"><?php comments_number();?></a></span>
			<?php if ( has_category() ) {?>
				<span class="blog-meta"><i class="fa fa-folder-open" aria-hidden="true"></i><?php echo get_the_category_list( ', ', '', get_the_ID() );?></span>
			<?php }
			if ( has_tag() ) {?>
			<span class="blog-meta"><i class="fa fa-tag" aria-hidden="true"></i><?php the_tags( '' );?></span>
			<?php }?>
		</div>
		<?php if ( has_post_thumbnail() ) {?>
			<!-- Blog Image -->
			<a class="blog-img-search" href="<?php echo esc_url( get_permalink() );?>" class="blog-image"><?php the_post_thumbnail( 'large' );?></a>
			<?php }?>
		<p>
			
			<?php
			global $post;
			$pos = strpos( $post->post_content, '<!--more-->' );
			if ( $pos ) {
				the_excerpt();
			} else {
				echo strip_shortcodes( get_the_excerpt() );
			} ?>
		</p>
		<div style="clear:both;"></div>
			<?php wyz_link_pages()?>
	</div>
</div>
