<?php
    //===================== Configurações VItáis para o painel =========================
    //
    //
    //
    // Variaveis para conexao
    $host="localhost"; // Host localhost ou 127.0.0.1 ou seu host
    $database="ragnarok"; // Banco de dados do Servidor
    $user="ragnarok";   // Usuário de acesso ao banco de dados do servidor
    $userpass="ragnarok";   // Senha do Usuário de acesso ao bando de dados do servidor
    $con = new PDO("mysql:host=$host;dbname=$database"
        ,$user
        ,$userpass,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
    );
    // Mapa de inicio do personagem ( Mudar de acordo com os critérios do servidor)
    $mapa = 'new_1-1';
    $mapa_x = 53;
    $mapa_y = 111;
    $level_admin = 80; // Aqui o level de ADMIN ( group_id ) do administrador
    $stats_points = 48; // Quantia de pontos de Status o personagem tem para usar ao criar o personagem
    $qtd_cabelos = 45; // quantia de estilos de cabelo do seu servidor (OBS: ficar atento as imagens pois podem não corresponder as mesmas imagens do seu servidor)
    
    //
    // =================================================================================

    // =================================================================================
    
    // ================== Configuração de envio de emails com senha ====================
    //
    //
    //
    // Recomendo a todos usarem um email do Gmail mesmo, pois é muito bom e vai ser uma coisa a menos pra pesar na banda do servidor
    // Outro detalhe, é preciso habilitar Aplicativos menos seguros, https://support.google.com/accounts/answer/6010255?hl=pt-BR, e configurar o SMTP do email a ser usado
    $pagina_recuperacao = 'recuperar-senha';
    $assunto = 'Recuperação de Senha';
    $seu_email      =   'email_servidor@gmail.com';
    $seu_nome       =   'Nome do Servidor'; // Esse nome é usado no Title do Header, nos rights do footer e no corpo do E-mail
    $sua_senha      =   'Senha_do_email_acima';
    /* Se for do Gmail o servidor é: smtp.gmail.com */
    $host_do_email  =   'smtp.gmail.com'; // deixar como está caso use Gmail
    /* Porta da conexão */
    $sua_porta  = "465";
    //
    //
    //
    // =================================================================================
    // ============== Escape de caracteres que podem prejudicar o Servidor =============
    //
    //                                  Evitando Merda
    $letters_char =array("<", "°", ">", "'",  "\"", "\\",  "/", "(", ")", ";","`", "¿","", "=", "?", ":", "-", "%");
    $letters =array("<", "Ã", "°", ">", "'",  "\"", "\\",  "/", "(", ")", ";","`", "¿", "ð","","Â", " ", "=", "?", ":", "%" );
    //
    // ========================== Fim das configurações vitais =========================
    // ============================= Configurações Extras ==============================
    //
    //
    // Daqui para baixo são configurações extras, não vai afetar o funcionamento do Painel em si;
    //
    //
    //================================ Suporte Pass MD5 ================================
    //
    // MD5 Pass, suporte para login e modificação de senha
    // true ou false
    $md5 = false;
    /*  Tabela da recuperação de senha deve ser inserida no BD do emulador
    
        CREATE TABLE `passchange` (
          `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
          `hash` varchar(255) NOT NULL,
          `email` varchar(255) NOT NULL,
          `data_change` datetime(6) NOT NULL,
          `change_validate` tinyint(1) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    */
    //
    // ================================================================================
    // ============================= maldito vote points ==============================
    //
    // 
    // true or falsedoacao/
    $vote_points = true;
    // Aqui os links dos tops que seu servidor foi cadastrado
    //
    $points_per_click = 3;
    //
    //
        if ($vote_points) {
            // Tempo de votação 24 Horas
            $tempo = 24; // equivalente a 24 horas
            
            /* Tabela SQL do vote por pontos
            CREATE TABLE `vote_point` (
            `account_id` int(11) NOT NULL default '0',
            `point` int(11) NOT NULL default '0',
            `last_vote1` int(11) NOT NULL default '0',
            `last_vote2` int(11) NOT NULL default '0',
            `last_vote3` int(11) NOT NULL default '0',
            `date` text NOT NULL,
            PRIMARY KEY (`account_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
            */

            $link_array = array(
                1 => "http://www.topservers200.com/in.php?id=15873",
                2 => "http://www.topragnarok.com.br/index.php?s=vote&id=22134",
                3 => "http://www.topragnarok100.com.br/votar/rgcrashers",
            );

            $links = $link_array;
        }
    //
    //
    // ===============================================================================
    // ======================= Aplicação externa MVP Timer ===========================
    // MVP Timer
    // true or false
    // marca o Time de MVP morto
    $mvp_timer = true;
    $mvp_link ="http://ragnarokmvp.com.br/";
    //
    //
    // ===============================================================================
    // =========================== Aplicação Pague Seguro ============================
    //
    // == Recomendável ler a documentação do pague seguro antes de habilitar isso aqui
    //
    // Pagueseguro app
    // true or false
    //
    $pagueseguro = true;
    //
    /*
        CREATE TABLE `doacao` (
          `account_id` int(11) UNSIGNED NOT NULL,
          `data` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          `valor` int(11) NOT NULL,
          `Rops` int(11) NOT NULL,
          `estado` int(11) UNSIGNED NOT NULL DEFAULT '0',
          `transaction_id` varchar(100) NOT NULL DEFAULT '',
          `email` varchar(39) NOT NULL DEFAULT ''
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    */
    // ===============================================================================
    // Token gerado pelo pague seguro
    $token ='XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
    //
    // Endereço de Site sem a barra no final 
    $site = "http://seu.site.com.br"; // Seu endereço de site onde ficará instalado o wordpress,( geralmente abre-se a pasta do wordpress pega tudo o que tem dentro e deixa solto no www )
    //
    // a poha da moeda brasileira
    $moeda ='BRL';
    //
    // tipo de tranzação 
    $type =1; // Não mexer é a tranzação, para saber mais a respeito consulte a documentação do pagueseguro
    //
    // Seu email do pague seguro
    $pgemail = 'seu_email@provedor.com.br'; // Email da sua conta do pagueseguro
    //
    // Default 1, equivale ao numero de produtos comprados, deixar 1 para não ser multiplicado pelo valor;
    // Caso queira mexer ou transformar em planos, use um select com valores pré estabelecidos
    $qtd = 1; // Não mexer, é referente a 1 produto, no caso é a oação ou venda, será apenas 1 venda por vez
    //
    // Quantos ROPs ou Cash por Real
    $rops_por_real = 1000 ; // quantos Rops irá ganhar a cada 1 real
    //
    // O que está vendendo é Cash ou Rops ..
    $id_do_item = 1; // Não mexer é o ID do produto
    $desc_do_item = 'Rops'; // Nome do Produto vai aparecer na hora do pagamento
    //
    // ===============================================================================
    //
    // Caso queira usar Planos com valores fixos habilite 
    // valor boleano, true ou false, ( Default False )
    // Configure as variaveis com o valor que desejar
    //
    $planos = false;
    $plano1 = 15.00;
    $plano2 = 25.00;
    $plano3 = 35.00;
    //
    // ===============================================================================
    //
    //
    //
    // ===============================================================================

?>