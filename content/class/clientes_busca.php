<?php
require("../../config/start.php");

// echo json_encode($_POST);
// exit();

// $_POST['id'] = 1;

if (!empty($_POST)) {

	$id = $_POST['id'];

	$sqli = $bd->conexao();

	$query = "SELECT id, nome, tipo_pessoa, razao_social, url, cpf, rg, cnpj, i_estadual, i_municipal, sexo, data_nascimento, data_fundacao, telefone_1, telefone_2, email, cep, rua, numero, complemento, bairro, cidade, estado, pais  FROM clientes WHERE id = $id";


	$result = $sqli->query($query);
	$result = $result->fetch_array();
	
	if ($sqli->connect_errno) {
		echo json_encode($sqli->error_list);
		exit();
	}else{
			
		//pre($result);
		// pre($values);
		// exit();

		$dados = array(
					'return' => true,
					'dado'   => $result
					);
		echo json_encode($dados);
		exit;
	}

}else{

	$dados = array(
				'return' => false,
				'msg'    => "Houve um erro ao buscar o cliente!"
				);
	echo json_encode($dados);
	exit;
}