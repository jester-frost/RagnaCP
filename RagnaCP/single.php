<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage RagnaCP
 * @since RagnaCP1.0
 */
include_once 'includes/config.php'; // loads config variables
include_once 'includes/functions.php';
$resumo = get_the_excerpt();
get_header(); ?>

<section class="conteudo">
	    <aside class="left">
	    	<?php include( get_template_directory() . '/includes/menu-left.php' ); ?>
	    </aside>

	    <article>
	        <div class="box">
				<h3 class="box-title"><?php the_title(); ?></h3>
	            
	            <div class="spacer">
	            	<?php if($resumo){ ?>

	                    <h4><?php echo $resumo; ?></h4>

	                <?php }; ?>

		            <?php if ( $_SESSION["usuario"] ) : ?>

		                <?php the_content(); ?>

		            <?php endif;?>

						<?php
						// Start the loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							//get_template_part( 'content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						// End the loop.
						endwhile;
						?>
						

	            </div>

				<div class="box-footer">
					<div id="comments" class="comments-area">
					
		

					</div>

				</div>
			</div>

	    </article>

	    <aside class="right">
	    	<?php include( get_template_directory() . '/includes/vote.php' ); ?>
	    </aside>
	</section>

<?php get_footer(); ?>
