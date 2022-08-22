<?php
require("../../config/start.php");

// pre($_POST);
// exit();

if (!empty($_POST)) {

	$sqli = $bd->delete($_POST['tabela'], $_POST['id']);

	if($sqli){

		$dados = array(
					'return' => true,
					'msg'    => "Dado excluido com Sucesso!"
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
				'msg'    => "Houve um erro ao excluir!"
				);
	echo json_encode($dados);
	exit;
}