<?php
/**
 * Related posts template
 *
 * @package wyz
 */

?>
<div class="related-posts">
	<h3 class="single-post-title"><?php esc_html_e( 'Related Stories', 'wyzi-business-finder' );?></h3>
	<?php
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if ( $tags ) {
		$tag_ids = array();
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->term_id;
		}
		$args = array(
			'tag__in' => $tag_ids,
			'post__not_in' => array( $post->ID ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => 1,
		);

		$query = new wp_query( $args );
		$p_c = 1;?>

		<div class="eql-dist related-posts-body">

			<?php while ( $query->have_posts() ) {

				$query->the_post(); ?>
				 
				<div id="related-post-<?php echo $p_c++;?>" class="related-post">
					<a rel="external" href="<?php the_permalink()?>"><?php the_post_thumbnail( array( 150, 100 ) ); ?><br />
						<h4 class="wyz-title"><?php esc_html( the_title() ); ?></h4>
					</a>
					<div class="wyz-text-container">
						<p><?php echo wp_kses_post( substr( get_the_content(), 0, 30 ) ) . '<span class="read-more-cont"><a class="read-more highlight uppercase" href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'read more', 'wyzi-business-finder' ) . '</a></span>'; ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php }
	wp_reset_postdata();
	?>
</div>
