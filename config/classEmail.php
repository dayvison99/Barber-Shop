<?php

class Email{

	public function enviar($email_dest='', $nome_dest='', $assunto='', $mensagem = ''){

		// use PHPMailer\PHPMailer\PHPMailer;

		/* Inclui a classe do phpmailer */				
		// require("../../public/PHPMailer/src/Exception.php");
		require ('../public/PHPMailer/src/PHPMailer.php');
		// require ('../public/PHPMailer/src/SMTP.php');

		$mail = new PHPMailer;                              // Passing `true` enables exceptions

		try {
			$mail->setLanguage('pt_br', '/optional/path/to/language/directory/');
			//Server settings
			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'in-v3.mailjet.com';                    // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = '2aea39a418f3ee8cb1307142a5ecba07'; // SMTP username
			$mail->Password = 'e27f9114c7d3d8811ca3acb3660c9f09'; // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('paulo@ecommercenet.com.br', 'Projeto Loja');
			$mail->addAddress($email_dest, $nome_dest);     // Add a recipient
			// $mail->addAddress('ellen@example.com');               // Name is optional
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->addAttachment('');    // Optional name

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Recuperacao de Senha';
			$mail->Body    = 'Simplesmente um teste de recuperacao de sernha <b>YES!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			return true;
		} catch (Exception $e) {
			return 'Message could not be sent. Mailer Error: <br />'. $mail->ErrorInfo;
		}

	}

}