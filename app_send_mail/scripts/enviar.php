<?php 
	require "mensagem.php";
	include "../bibliotecas/Exception.php";
	require "../bibliotecas/PHPMailer.php";
	require "../bibliotecas/OAuth.php";
	require "../bibliotecas/POP3.php";
	require "../bibliotecas/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	try{
		$para = explode(",", $_POST['para']);
		$mensagem = new Mensagem($_POST['de'], $para, $_POST['assunto'], $_POST['msg']);
		$mail = new PHPMailer(true);                          // Passing `true` enables exceptions
		try {
			//Server settings
			$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'exemple@email.com';                 // SMTP username
			$mail->Password = 'password';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom($mensagem->__get('de'));
			foreach ($mensagem->__get('para') as $key) {
				$mail->addAddress($key);
			}
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $mensagem->__get('assunto');
			$mail->Body = $mensagem->__get('msg');
			$mail->send();
			header('Location: ../index.php?result=sucesso');
		}catch (Exception $e) {
			header('Location: ../index.php?result=falha');
		}
	}catch (Error $e) {
		header('Location: ../index.php?result=falha');
	}

 ?>