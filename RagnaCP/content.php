<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage RagnaCP
 * @since RagnaCP 1.0
 */
?>

	    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
					endif;
				?>
			<div class="box">
				<h3 class="box-title">Post</h3>

				<div class="spacer">
					<?php
						/* translators: %s: Name of current post */
						the_content( sprintf(
							__( 'Continue Lendo %s', 'twentyfifteen' ),
							the_title( '<span class="screen-reader-text">', '</span>', false )
						) );

						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );
					?>
				</div>

				<?php
					// Author bio.
					if ( is_single() && get_the_author_meta( 'description' ) ) :
						get_template_part( 'author-bio' );
					endif;
				?>
				<div class="box-footer">

					<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link"> ', ' </span>' ); ?>
				</div>
			</div>
</div>
