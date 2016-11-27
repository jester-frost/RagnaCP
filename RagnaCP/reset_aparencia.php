<?php

/* Template Name: [ Resetar aparencia ] */

include_once 'includes/functions.php';
require "includes/config.php";

if ( $_SESSION["usuario"] ) :

    $usuario = $_SESSION["usuario"];

    switch ($_GET['modo']) {
        case 'reset_hair':
            $char_id = preg_replace('/[^[:alnum:]_]/', '',$_GET['char_id']);
            // Aqui voce chama a funcao que valida se o usuario pode ver o id
            $search_character_query = $con->prepare("SELECT * FROM `char` WHERE char_id=$char_id");
            $search_character_query->execute();
            $char_account_id = $search_character_query->fetchAll(PDO::FETCH_OBJ);

            foreach ($char_account_id as $acc) {
                $char_id_conta = $acc->account_id;
            }
            if ($usuario->account_id == $char_id_conta){
                // Aqui voce chama a funcao que reseta a posicao
                $dados = resetar_cabelo($con, $char_id);
                // redireciona mantendo a URL limpa
                // wp_redirect( get_permalink()); exit;

            }else {
                $dados = "Não foi possivel processar a requisição ";
            }
        break;
        case 'reset_equip':
            $char_id = preg_replace('/[^[:alnum:]_]/', '',$_GET['char_id']);
            // Aqui voce chama a funcao que valida se o usuario pode ver o id
            $search_character_query = $con->prepare("SELECT * FROM `char` WHERE char_id=$char_id");
            $search_character_query->execute();
            $char_account_id = $search_character_query->fetchAll(PDO::FETCH_OBJ);

            foreach ($char_account_id as $acc) {
                $char_id_conta = $acc->account_id;
            }
            if ($usuario->account_id == $char_id_conta){
                // Aqui voce chama a funcao que reseta a posicao
                $dados = resetar_equip($con, $char_id);
                // redireciona mantendo a URL limpa
                // wp_redirect( get_permalink()); exit;

            }else {
                $dados = "Não foi possivel processar a requisição ";
            }
        break;
    }

$resumo = get_the_excerpt();
endif;
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
                
                    <?php

                        $user = $_SESSION['usuario'];
                        $account_id = $user->account_id;

                        $search_character_query = $con->prepare("SELECT * FROM `char` WHERE account_id=$account_id");
                        $search_character_query->execute();

                        $char = $search_character_query->fetchAll(PDO::FETCH_OBJ);
                            $html .= "<h4> Personagens</h4>";
                            $html .= '<ul class="char-reset-aparence">';
                            
                        foreach ($char as $c) {
                            $html .= "<li><div class='reset-char'>";
                            $html .= '<h4>Aparência de  <strong>'. $c->name .'</strong> </h4><div>';
                            $html .= '<table><thead><tr>';
                            $html .= '<th>Penteado / Cor </th> <th>Cor da Roupa </th></tr></thead><tbody><tr>';
                            $html .= '<td>'. $c->hair .' / ' . $c->hair_color . '</td><td> '. $c->clothes_color .' </td></tr>';
                            $html .= '<tr><td class="bt"><a href="?modo=reset_hair&char_id='. $c->char_id .'" class="btn" >Aparência </a></td></tr></tbody></table>';
                            $html .= '<table><thead><tr>';
                            $html .= '<th>Cabeça Topo</th><th>Cabeça Meio</th><th>Cabeça Baixo</th> <th>Arma</th> <th>Escudo</th> <th>Capa</th> <th></th></tr><tbody><tr>';
                            $html .= '<td>'. $c->head_top . '</td><td> '. $c->head_mid .' </td></td><td> '. $c->head_bottom .' </td><td> '. $c->weapon .' </td><td> '. $c->shield .' </td><td> '. $c->robe .' </td><td></td></tr><tr><td class="bt"><a href="?modo=reset_equip&char_id='. $c->char_id .'"  class="btn">Equipamento</a></td></tr></tbody>';
                            $html .= '</table></div>';
                            $html .= '</div></li>';
                        }
                            $html .= '</ul>';
                            echo $html;

                    ?>
                </div>
                <?php else : ?>

                    <div class="spacer">
                        <h3 class="logued-error">Precisa se logar para ver o conteudo da pagina</h3>
                    </div>
                
                <?php endif;?>


                <div class="box-footer">
                    <div class="error-msg">
                        <?php echo "<p class='error'>" . $dados . "</p>";?>
                    </div>
                </div>

            <?php endwhile;?>

        </div>
    </article>

    <aside class="right">
        <?php include( get_template_directory() . '/includes/vote.php' ); ?>
    </aside>
</section>




<?php get_footer(); ?>