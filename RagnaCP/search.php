<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage RagnaCP
 * @since RagnaCP 1.0
 */
include_once 'includes/config.php'; // loads config variables
include_once 'includes/functions.php';
get_header(); ?>

<section class="conteudo limit">
		<aside class="left">
	    	<?php include( get_template_directory() . '/includes/menu-left.php' ); ?>
	    </aside>


	    <article id="post-<?php the_ID(); ?>" >

			<div class="box">
				<h3 class="box-title"><?php printf( __( 'Resultados encontrados para: %s', 'ragna' ), get_search_query() ); ?></h3>
				<?php if ( have_posts() ) : ?>

			<?php
				// Start the loop.
				while ( have_posts() ) : the_post(); ?>

					<?php
					/*
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', 'search' );

				// End the loop.
				endwhile;

				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', 'ragna' ),
					'next_text'          => __( 'Next page', 'ragna' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ragna' ) . ' </span>',
				) );

				// If no content, include the "No posts found" template.
				else :
					$html .= '
						<div class="box box-inner">
							<h3 class="box-title">Não foram encontrados resultados, procure novamente. </h3>
						
							<form role="search" method="get" id="searchform" class="searchform" action="">
									<input type="text" value="" name="s" class="ipt" id="s">
									<input type="submit" id="searchsubmit" class="btn" value="Pesquisar">
							</form>
						</div>
						';
					echo $html;

				endif;
			?>


				<div class="box-footer">
				</div>
			</div>
	        
	    </article>

	    <aside class="right">
	    	<?php include( get_template_directory() . '/includes/vote.php' ); ?>
	    </aside>
	</section>


<?php get_footer(); ?>
