<?php
	require("PHPMailer-master/PHPMailerAutoload.php");

 	function enviar_email($con, $email, $host_do_email, $sua_porta, $seu_email, $sua_senha){

 		$dados=array(':email'=>$email);
 		include("config.php");
		$search_email_query = $con->prepare("SELECT * FROM login WHERE email=:email");
		$search_email_query->execute($dados);
		$usuario=$search_email_query->fetchall(PDO::FETCH_OBJ);

		if ($usuario) {
			$mensagem = "<table>";
			foreach ($usuario as $us) {
				$i = $i+1;
				$mensagem .= '<tr>' . $i . '° Conta.</tr>';
				$mensagem .= '<tr></tr>';
				$mensagem .= '<tr> <td>Login: ' . $us->userid . '</td></tr>';
				$mensagem .= '<tr> <td>Senha: ' . $us->user_pass . '</td></tr>';
				$mensagem .= '<tr></tr>';
				$mensagem .= '<tr></tr>';
			}
			$mensagem .= "</table>";
			
		    /* Inclui a classe do phpmailer */              
		    
		    $mail = new PHPMailer();
		    /* Cria uma Instância da classe */

		    /* Configura os destinatários (pra quem vai o email) */
			$mail->AddAddress($email);

		    $mail->IsSMTP();
		    /* Define o endereço do servidor de envio */
		    $mail->Host = $host_do_email;
		    /* Utilizar autenticação SMTP */ 
		    $mail->SMTPAuth = true;
		    /* Protocolo da conexão */
		    $mail->SMTPSecure = "ssl";
		    /* Porta da conexão */
		    $mail->Port = $sua_porta;
		    /* Email ou usuário para autenticação */
		    $mail->Username = $seu_email;
		    /* Senha do usuário */
		    $mail->Password = $sua_senha;
		     
		    /* Configura os dados do remetente do email */
		    $mail->From = $seu_email; // Seu e-mail
		    $mail->FromName = $seu_nome; // Seu nome
		     
		    /* Configura a mensagem */
		    $mail->IsHTML(true); // Configura um e-mail em HTML
		     
		    /*   
		     * Se tiver problemas com acentos, modifique o charset
		     * para ISO-8859-1  
		     */
		    $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
		     
		    /* Configura o texto e assunto */
		    $mail->Subject  = $assunto; // Assunto da mensagem
		    $mail->Body = $mensagem; // A mensagem em HTML
		    $mail->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro
		     
		    /* Configura o anexo a ser enviado (se tiver um) */
		    //$mail->AddAttachment("foto.jpg", "foto.jpg");  // Insere um anexo
		     
		    /* Envia o email */
		    $email_enviado = $mail->Send();
		     
		    /* Limpa tudo */
		    $mail->ClearAllRecipients();
		    $mail->ClearAttachments();
		     
		    /* Mostra se o email foi enviado ou não */

	        $msg = "Email enviado!";

		} else {
	        $msg = "Não foi possível enviar o e-mail.<br /><br />";
	        $msg .= "<b>Email não encontrado. </b> <br />" . $mail->ErrorInfo;
	    }
	    return $msg;
 	}
?>