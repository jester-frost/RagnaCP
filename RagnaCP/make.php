<?php
/* Template Name: [ Criar Personagem ] */
include_once 'includes/config.php'; // loads config variables
include_once 'includes/functions.php';
$resumo = get_the_excerpt();
get_header();
?>

<section class="conteudo limit">
    <aside class="left">
    	<?php include( get_template_directory() . '/includes/menu-left.php' ); ?>
    </aside>

    <article>

		<div class="box">
            <?php while ( have_posts() ) : the_post();?>
                <h3 class="box-title"><?php the_title(); ?></h3>
                
                <div class="spacer">

                    <?php if($resumo){ ?>

                        <h4><?php echo $resumo; ?></h4>

                    <?php }; ?>

                    <?php if ( $_SESSION["usuario"] ) : ?>

                        <?php the_content(); ?>

                    <div class="char_make">
                        <form action="" name="create-char" method="POST">
                                <fieldset class="char-appearance">

                                    <div class="cabelos">

                                        <div class="char-arrows">
                                            <a href="" class="arrow arrow-left"></a>
                                            <a href="" class="arrow arrow-top"></a>
                                            <a href="" class="arrow arrow-right"></a>
                                        </div>

                                        <ul class="cor">
                                            <?php for ($i = 1; $i <= 12; $i++)  :?>
                                                <?php $active = "active"; ?>
                                                <li class="cor-<?php echo $i;?> <?php if($i == 1 ){echo $active;}; ?>">
                                                    <ul class="estilo">
                                                        <?php for ($j = 1; $j <= 27; $j++ ) :?>
                                                            <?php $current = "current"; ?>
                                                            <li class="<?php if($j == 1 ){echo $current;}; ?>">
                                                                <img src="<?php bloginfo(template_url) ?>/images/cabelos/<?php echo $_SESSION["usuario"]->sex; ?>/cabelo-<?php echo $j;?>.gif" alt=""/>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </li>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>

                                    <div class="obj-char">
                                        <img src="<?php bloginfo(template_url) ?>/images/novice/charsim_<?php echo $_SESSION["usuario"]->sex; ?>.png" border="0" title="char thumbnail">
                                        <label for="">
                                            <input type="text" name="char-name" placeholder="Nome " class="char-name">
                                        </label>
                                    </div>

                                    
                                </fieldset>

                                <fieldset class="char-stats">

                                    <div class="buttons">
                                        <a href="" class="button btnstr"></a>
                                        <a href="" class="button btnagi"></a>
                                        <a href="" class="button btnvit"></a>
                                        <a href="" class="button btnint"></a>
                                        <a href="" class="button btndex"></a>
                                        <a href="" class="button btnluk"></a>
                                    </div>
                                    

                                    <svg x="0px" y="0px" viewBox="0 0 612 792" id="object">
                                        <polygon 
                                        points="306,531 175,455 175,304 306,229 436,304 436,455"
                                        id="poligon"/>
                                    </svg>

                                </fieldset>

                                <fieldset class="stats-make">
                                    <label id="stat_str"><input type="number" value="5"></label>
                                    <label id="stat_agi"><input type="number" value="5"></label>
                                    <label id="stat_vit"><input type="number" value="5"></label>
                                    <label id="stat_inte"><input type="number" value="5"></label>
                                    <label id="stat_dex"><input type="number" value="5"></label>
                                    <label id="stat_luk"><input type="number" value="5"></label>
                                </fieldset>

                                <fieldset class="btns clearfix">
                                
                                   <input type="submit" name="create-char" class="btn" value="Criar">
                                </fieldset>
                            </form>
                        </div>

                    <?php else : ?>

                        <h3 class="logued-error">Precisa se logar para ver o conteudo da pagina</h3>
                        
                    <?php endif;?>
                </div>

                <div class="box-footer">
                    
                </div>
            <?php endwhile;?>
		</div>
    </article>

    <aside class="right">
    	<?php include( get_template_directory() . '/includes/vote.php' ); ?>
    </aside>
</section>




<?php get_footer(); ?>