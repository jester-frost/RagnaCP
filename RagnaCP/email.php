<?php
    /* Template Name: [ Recuperar Senha ] */
    include("includes/phpmailer_functions.php");
    if(!empty($_POST) and (isset($_POST["enviar"]))) {

    $email = str_replace($letters, "", $_POST["email"]);
    $dados = enviar_email($email);

    }else{

    }
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

                        <?php the_content(); ?>
                    
                </div>
                <form action="" method="post" name="recupera-senha" class="email">
                    <label>
                        <span class="label-content">E-mail</span>
                        <input class="ipt" name="email" type="text" required="required">
                    </label>
                    <div class="box-footer">
                        <div class="error-msg">
                            <?php echo "<p class='error'>" . $dados . "</p>";?>
                        </div>
                        <input type="submit" value="Enviar" class="btn" name="enviar">
                    </div>
                </form>
                
            <?php endwhile;?>
        </div>
    </article>

    <aside class="right">
    	<?php include( get_template_directory() . '/includes/vote.php' ); ?>
    </aside>
</section>




<?php get_footer(); ?>