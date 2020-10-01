<?php
	/* Namespace alias. */
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	// charset
	header('Content-type: text/html; charset=UTF-8');
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');

	$email_business = 'contato@agenciapublikando.com.br';

	$name = filter_input(INPUT_POST , 'nome');
	$msg = filter_input(INPUT_POST , 'message');
	$contato = filter_input(INPUT_POST , 'contato');
	$email = filter_input(INPUT_POST , 'email', FILTER_VALIDATE_EMAIL);

	$body = "Mensagem: <br>" . $msg . "<br>--<br> contato: " . $contato;

	$email_smtp = 'contato@agenciapublikando.com.br';
	$pass_smtp = 'cHVibGlrQG5kby4yMDIw'; //'publik@ndo.2020';

	send_email($email_business, $email_smtp, $pass_smtp, "PUBLIKANDO - formulario", 'Agencia Publikando', $body, $email, $name);

	// parametros - email da empresa, template email, email e senha do smtp(ssl para enviar email seguro para a caixa de entrada), assunto, titulo, mensagem, destinatario e add os dados que for necessario
	function send_email($email_business, $email_smtp, $pass_smtp, $subject, $title, $body, $email_usu, $nome_usu){
		// utf-8
		header('Content-Type: text/html; charset=utf-8');
		date_default_timezone_set("Brazil/East"); // default time zone
		// verifica a versao do php para o charset
		if (PHP_VERSION_ID < 50600) {
			iconv_set_encoding('input_encoding', 'UTF-8');
			iconv_set_encoding('output_encoding', 'UTF-8');
			iconv_set_encoding('internal_encoding', 'UTF-8');
		}else{
			ini_set('default_charset', 'UTF-8');
		}

		/* Exception class. */
		require 'Exception.php';
		/* PHPMailer class. */
		require 'PHPMailer.php';
		/* SMTP class, needed if you want to use SMTP. */
		require 'SMTP.php';
		$mail = new PHPMailer(TRUE);
		$message = $body . "<br> Nome: " . $nome_usu . "<br>Email: " . $email_usu;
		// incorpora um arquivo html como corpo do email
		try{
			$mail->setFrom($email_business, 'formulario - Publikando');
			$mail->addAddress($email_business, 'Nos');
			$subject = utf8_decode($subject);
			$mail->Subject = $subject;
			$mail->isHTML(TRUE);
			$mail->Body = $message;

			/* SMTP parameters. */
			$mail->isSMTP();
			$mail->SMTPDebug = false;
			$mail->Debugoutput = 'html';
			// $mail->Host = 'smtp.gmail.com';
			$mail->Host = 'mail.agenciapublikando.com.br';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = $email_smtp;
			$mail->Password = base64_decode($pass_smtp);

			/* Finally send the mail. */
			$mail->send();
			
			//header('location: ../../index.php');
			// echo "foi normal !!!";
		}catch(Exception $e){
			// se der erro, envia o email usando funcao mail nativa php
			//echo $e->errorMessage();
			// cabecalho
			$headers = array("MIME-Version: 1.1","From: ".$email_business."","Content-type: text/html; charset=iso-8859-1","Reply-To: The Sender <".$email_business.">","Return-Path: The Sender <".$email_business.">","Organization: Sender Organization","X-Priority: 3","X-Mailer: PHP". phpversion());
			$headers = implode("\r\n", $headers);
			try{
				mail($email_business, $subject, $message, $headers);	
				
				// echo "foi nativo !!1";
				//header('location: ../../index.php');
			}catch(Exception $e){
				// se nao enviar tambem, retorna
				echo $e->errorMessage();
				
				//header('location: ../../index.php');
				// echo "Error1231";
			} // segundo try
		} // primeiro try
	}