<?php
/* Template Name: [ Criar Personagem ] */
include_once 'includes/config.php'; // loads config variables
include_once 'includes/functions.php';

    $status_limit = 9;

    $dados = "";

    if(!empty($_POST) and (isset($_POST["make-char"]))) {

        $acc_id = $_SESSION["usuario"]->account_id;

        $string = str_replace($letters_char, "", $_POST["char_name"]);

        if ( ( strlen( round( $string ) ) >= 6 ) || ( strlen( round( $string ) ) <= 20  ) ):

            $name = $string;

            $flag = MakesearchChar($con, $name);

            if (!$flag ):
                // Estilo de cabelo
                if( ( round( $_POST["hair"] ) >= 0 ) || ( round( $_POST["hair"] ) <= 11 ) ) :
                    $hair = $_POST["hair"];
                else: 
                    $msg .= "Estilo de cabelo incorreto ;";
                endif;

                // Cor de cabelo
                if( ( round( $_POST["hair_color"] ) >= 0 ) || ( round( $_POST["hair_color"] ) <= 11 ) ) :
                    $hair = $_POST["hair_color"];
                else: 
                    $msg .= "Estilo de cabelo incorreto ;";
                endif;

                if( ( round( $_POST["char_str"] ) <= 9 ) || ( round( $_POST["char_str"] ) >= 1 ) ) :
                    $str = $_POST["char_str"];
                else: 
                    $msg .= "Status Força deve ser Maior que 0 e menor que 10 ;";
                endif;

                if( ( round( $_POST["char_agi"] ) <= 9 ) || ( round( $_POST["char_agi"] ) >= 1 ) ) :
                    $agi = $_POST["char_agi"];
                else: 
                    $msg .= "Status Agilidade deve ser Maior que 0 e menor que 10 ;";
                endif;

                if( ( round( $_POST["char_vit"] ) <= 9 ) || ( round( $_POST["char_vit"] ) >= 1 ) ) :
                    $vit = $_POST["char_vit"];
                    $max_hp = (40 * (100 + $vit)/100);
                else: 
                    $msg .= "Status Vitalidade deve ser Maior que 0 e menor que 10 ;";
                endif;

                if( ( round( $_POST["char_inte"] ) <= 9 ) || ( round( $_POST["char_inte"] ) >= 1 ) ) :
                    $int = $_POST["char_inte"];
                    $max_sp = (11 * (100 + $int)/100);
                else: 
                    $msg .= "Status Inteligência deve ser Maior que 0 e menor que 10 ;";
                endif;

                if( ( round( $_POST["char_dex"] ) <= 9 ) || ( round( $_POST["char_dex"] ) >= 1 ) ) :
                    $dex = $_POST["char_dex"];
                else: 
                    $msg .= "Status Destreza deve ser Maior que 0 e menor que 10 ;";
                endif;

                if( ( round( $_POST["char_luk"] ) <= 9 ) || ( round( $_POST["char_luk"] ) >= 1 ) ) :
                    $luk = $_POST["char_luk"];
                else: 
                    $msg .= "Status Sorte deve ser Maior que 0 e menor que 10 ;";
                endif;

                if(!$msg):

                    $last_map = "new_1-1";
                    $mapa_x = 53;
                    $mapa_y = 111;
                    // calculando o que sobra de pontos de status
                    $stats_final = ( $stats_points - ( $str + $agi + $vit + $int + $dex + $luk ) );
                    $dados = make_char($con, $acc_id, $name, $slot, $stats_points, $str, $agi, $vit, $int, $dex, $luk, $max_hp, $max_sp, $stats_final, $last_map, $mapa_x, $mapa_y);
                else:
                    $dados = implode(';',$msg);
                endif;

            else:

                $dados = "O nome ja está sendo usado por outro personagem, por favor escolha um nome diferente.";
            
            endif;

        else:

            $msg .= "O nome do Personagem deve conter entre 6 e 20 Caractéres ;";

        endif;

    }


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
                            <form action="" name="make-char"  method="post">
                                <input type="hidden" name="hair" value="1" class="hair">
                                <input type="hidden" name="hair_color" value="1" class="hair_color">
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
                                                        <?php for ($j = 1; $j <= $qtd_cabelos; $j++ ) :?>
                                                            <?php $current = "current"; ?>
                                                            <?php if ( ($_SESSION["usuario"]->sex == "F") && ( $j ==36 ) ): ?>
                                                                <?php $fix = "fix-f-36" ?>
                                                            <?php else: ?>
                                                                <?php $fix = "" ?>
                                                            <?php endif; ?>
                                                            <li class="<?php if($j == 1 ){echo $current;}; ?>">
                                                                <img src="<?php bloginfo(template_url) ?>/images/cabelos/<?php echo $_SESSION["usuario"]->sex; ?>/cabelo-<?php echo $j;?>.gif" class="<?php echo $fix; ?>" alt=""/>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </li>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>

                                    <div class="obj-char">
                                        <img src="<?php bloginfo(template_url) ?>/images/novice/charsim_<?php echo $_SESSION["usuario"]->sex; ?>.png" border="0" title="char thumbnail">
                                        <label>
                                            <input type="text" name="char_name" minlength="6" maxlength="20" required="required" class="char-name"  value="">
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
                                        points="310,530 175,460 175,304 306,229 436,304 436,455"
                                        id="poligon"/>
                                    </svg>

                                </fieldset>

                                <fieldset class="stats-make">
                                    <label id="stat_str">
                                        <input type="text" name="char_str" required value="5">
                                    </label>
                                    <label id="stat_agi">
                                        <input type="text" name="char_agi" required value="5">
                                    </label>
                                    <label id="stat_vit">
                                        <input type="text" name="char_vit" required value="5">
                                    </label>
                                    <label id="stat_inte">
                                        <input type="text" name="char_inte" required value="5">
                                    </label>
                                    <label id="stat_dex">
                                        <input type="text" name="char_dex" required value="5">
                                    </label>
                                    <label id="stat_luk">
                                        <input type="text" name="char_luk" required value="5">
                                    </label>
                                </fieldset>

                                <fieldset class="btns clearfix">
                                
                                   <input type="submit" name="make-char" class="btn" value="Criar">
                                </fieldset>
                            </form>
                        </div>

                    <?php else : ?>

                        <h3 class="logued-error">Precisa se logar para ver o conteudo da pagina</h3>
                        
                    <?php endif;?>
                </div>

                <div class="box-footer">
                    <?php echo $dados; ?>
                </div>
            <?php endwhile;?>
        </div>
    </article>

    <aside class="right">
        <?php include( get_template_directory() . '/includes/vote.php' ); ?>
    </aside>
</section>




<?php get_footer(); ?>