<?php
require("../../config/start.php");

// pre($_POST);
// exit();

if (!empty($_POST)) {

	$sqli = $bd->update_status($_POST['tabela'], $_POST['id']);

	if($sqli){

		$dados = array(
					'return' => true,
					'msg'    => "Dado alterado com Sucesso!"
					);
		echo json_encode($dados);
		exit;
	}else{
		echo json_encode($sqli->error_list);
		exit;
	}

}else{

	$dados = array(
				'return' => false,
				'msg'    => "Houve um erro ao atualizar!"
				);
	echo json_encode($dados);
	exit;
}