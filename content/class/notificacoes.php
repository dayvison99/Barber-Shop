<?php 
require("../../config/start.php");

use PHPMailer\PHPMailer\PHPMailer;

$notificationcode = $_POST['notificationCode'];

$email_pagseguro = 'paulohenrique_ms@hotmail.com';
$token_pagseguro = "9FAE2F2EE73047639B3F309EE94AF113";

$data = array('token' => $token_pagseguro, 'email' => $email_pagseguro);

$data = http_build_query($data);

$url = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/".$notificationcode."?".$data;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);

$xml = simplexml_load_string(curl_exec($curl));

curl_close($curl);

$reference = $xml->reference;

$status = $xml->status;

$sqli = $bd->conexao();

$today = date('Y-m-d');

$today_time = date('Y-m-d h:i:s');

// $query = "INSERT INTO teste (`texto`) values ('".$xml->code."')";

// pre($query);

// $sqli->query($query);

if($status == 3){
	$query = "UPDATE pagamentos set `status`=".$status.", `data_pagamento` = '".$today_time."' where `id_fatura`=".$reference;
}else {
	$query = "UPDATE pagamentos set `status`=".$status." where `id_fatura`=".$reference;
}

$sqli->query($query);

if($status == 3 ){
	$query = "UPDATE faturas set `status`=".$status.", `data_pagamento` = '".$today_time."', `ultima_atualizacao`= ".$today_time." where `id`=".$reference;
} else {
	$query = "UPDATE faturas set `status`=".$status.", `ultima_atualizacao`= '".$today_time."' where `id`=".$reference;
}

$sqli->query($query);

$query = "SELECT * FROM setup_loja";

$result = $sqli->query($query);

$result = $result->fetch_array();

$sqli->close();

$cnpj = $result['loja_cnpj'];

$loja_status = $result['status_loja'];

$sqli_venda  = new mysqli('localhost', 'root', '', 'vendao5_vendaonlineagora');

$query = "UPDATE faturas_lojas  set `status_pagamento`=".$status.", `status_loja`= ".$loja_status." where `loja_cnpj`='".$cnpj."'";

$sqli_venda->query($query);



// /* Inclui a classe do phpmailer */
require("../../public/PHPMailer/src/Exception.php");

require('../../public/PHPMailer/src/PHPMailer.php');

require('../../public/PHPMailer/src/SMTP.php');

$mail = new PHPMailer; // Passing `true` enables exceptions

require("../../config/classMontaEmail.php");

$email = new MontaEmail;

//Status possiveis da fatura

//1-Aguardando pagamento 
//2-Em análise 
//3-Paga 
//4-Disponível 
//5-Em disputa 
//6-Devolvida 
//7-Cancelada 
//8-Debitado 
//9-Retenção temporária

$statusFatura = '<h3>Aguardando Pagamento</h3>';

if($status == 1){

	$statusFatura = '<h3>Aguardando pagamento</h3>';

} else if($status == 2){

	$statusFatura = '<h3>Em análise</h3>';

} else if($status == 3){

	$statusFatura = '<h3>Paga</h3>';

} else if($status == 4){

	$statusFatura = '<h3>Disponível</h3>';

} else if($status == 5){

	$statusFatura = '<h3>Em disputa</h3>';

} else if($status == 6){

	$statusFatura = '<h3>Devolvida</h3>';

} else if($status == 7){

	$statusFatura = '<h3>Cancelada</h3>';

} else if($status == 8){

	$statusFatura = '<h3>Debitado</h3>';

} else if($status == 9){

	$statusFatura = '<h3>Retenção temporária</h3>';

}

$mensagem = 'Sua fatura teve seu status alterado!';

$conteudo_email = $email->fatura_atualizada($statusFatura);

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
$mail->setFrom('pedrocamara@ecommercenet.com.br', 'Projeto Loja');
$mail->addAddress($result['email_pagamento'], 'Loja Virtual');     // Add a recipient

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Alteração de Fatura';
$mail->Body    = $conteudo_email;

$mail->send();