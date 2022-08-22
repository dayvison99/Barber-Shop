<?php

require("../../config/start.php");

// pre($_POST);
// exit();

use PHPMailer\PHPMailer\PHPMailer;

// /* Inclui a classe do phpmailer */
require("../../public/PHPMailer/src/Exception.php");
require ('../../public/PHPMailer/src/PHPMailer.php');
require ('../../public/PHPMailer/src/SMTP.php');

$mail = new PHPMailer;                              // Passing `true` enables exceptions

// pre($_POST);
// exit();

if (!empty($_POST)) {

	$sqli = $bd->conexao();
	
	if (mysqli_connect_errno()) {
		printf("Falha na conexao: %s\n", mysqli_connect_error());
		exit();
	}

	// $email = str_replace('%40', '@', $_POST['login']);

	$query = "SELECT id, usuario, nome FROM usuarios WHERE usuario ='".$_POST['login']."' AND excluido = 0 AND status = 1";

	$retorno = $sqli->query($query);
	$retorno = $retorno->fetch_array();

	if(!empty($retorno)){

		$cript = uniqid(mt_rand(), true);

		$codigo = md5($cript);

		$query = "INSERT INTO usuarios_recuperar_senha (id_usuario, email, hash_recuperacao, data_envio) VALUES (".$retorno['id'].", '".$retorno['usuario']."', '$codigo', '".date("Y:m:d H:i:s")."')";
		$sqli->query($query);
		
		require("../../config/classMontaEmail.php");
		$email = new MontaEmail;

		$link = PL_PATH_ADMIN . "/recuperar_senha_troca&id=" .$retorno['id'] ."&cod=". $codigo;

		$conteudo_email = $email->recupera_senha(array('nome' => $retorno['nome'], 'link' => $link ));

		//Server settings
		$mail->SMTPDebug = 1;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'in-v3.mailjet.com';                    // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = '2aea39a418f3ee8cb1307142a5ecba07'; // SMTP username
		$mail->Password = 'e27f9114c7d3d8811ca3acb3660c9f09'; // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		$mail->IsHTML(true);
		$mail->CharSet = 'utf-8';
		$mail->Debugoutput = '';

		//Recipients
		$mail->setFrom('paulo@ecommercenet.com.br', 'Projeto Loja');
		$mail->addAddress($retorno['usuario'], $retorno['nome']);     // Add a recipient

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Recuperação de Senha';
		$mail->Body    = $conteudo_email;

		// pre('foi até aqui');
		// exit();

		if($mail->send()){

			$dados = array(
					'return' => true,
					'msg' => 'E-mail enviado com sucesso, confira sua caixa de entrada!'
					);
			echo json_encode($dados);
			exit;
		}else{
			
			$dados = array(
					'return' => false,
					'msg' => 'Houve um erro ao enviar o e-mail! Confira o email digitado ou tente novamente mais tarde.'
					);
			echo json_encode($dados);
			exit;
		}


	}else{
		$dados = array(
				'return' => false,
				'msg'    => "Houve um erro ao enviar o e-mail! Confira o email digitado ou tente novamente mais tarde."
				);
		echo json_encode($dados);
		exit;
	}

}else{
	$dados = array(
				'return' => false,
				'msg'    => "Houve um erro ao enviar o e-mail! Confira o email digitado ou tente novamente mais tarde."
				);
		echo json_encode($dados);
		exit;
}