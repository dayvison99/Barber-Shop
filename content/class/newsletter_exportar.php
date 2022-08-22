<?php
require("../../config/start.php");

$dados = $bd->select(array('id', 'nome', 'email'), 'newsletter' , array('status = 1', 'excluido = 0'), array('id'), 'ASC', 1000000);

$linha = "codigo;nome;email";

foreach ($dados as $key => $value) {
	$linha .= "\r\n".$value['id'].";".$value['nome'].";".$value['email'].";";
}

$name = sprintf('newsletter_exporta_%s.csv', date('d-m-Y'));

// pre(PL_PATH.'/public/downloads/');
// exit();

$fd = fopen(PL_PATH.'/public/downloads/' . $name, 'w+');
fwrite($fd,$linha);
fpassthru($fd);

// Configuramos os headers que serão enviados para o browser
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$name.'"');
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');

// Envia o arquivo para o cliente
readfile(PL_PATH.'/public/downloads/' . $name);

fclose($fd);
unlink(PL_PATH.'/public/downloads/' . $name);

// pre($linha);
// exit();