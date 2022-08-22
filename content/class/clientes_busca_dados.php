<?php
require("../../config/start.php");

// $_POST['campo'] = 'email';
// $_POST['value'] = 'liveira@gmail.com';

// echo json_encode($_POST);
// exit();

if (!empty($_POST)) {

	$email = $_POST['email'];
	$cpf   = $_POST['cpf'];
	$cnpj  = $_POST['cnpj'];
	$tipo_pessoa  = $_POST['tipo_pessoa'];

	$sqli = $bd->conexao();

	if($tipo_pessoa == 1){

		$query = "SELECT email, cpf FROM clientes WHERE email = '$email' OR cpf = '$cpf'";
		$result = $sqli->query($query);
		$result = $result->fetch_array();

		if(($result['email'] == $email) && ($result['cpf'] == $cpf)){

			$dados = array(
						'return' => true,
						'email'  => true,
						'cpf'    => true,
						'cnpj'   => false
						);
			echo json_encode($dados);
			exit;

		}else if(($result['email'] == $email) && ($result['cpf'] != $cpf)){

			$dados = array(
						'return' => true,
						'email'  => true,
						'cpf'    => false,
						'cnpj'   => false
						);
			echo json_encode($dados);
			exit;
		}else if(($result['email'] != $email) && ($result['cpf'] == $cpf)){

			$dados = array(
						'return' => true,
						'email'  => false,
						'cpf'    => true,
						'cnpj'   => false
						);
			echo json_encode($dados);
			exit;
		}else if(($result['email'] != $email) && ($result['cpf'] != $cpf)){

			$dados = array(
						'return' => true,
						'email'  => false,
						'cpf'    => false,
						'cnpj'   => false
						);
			echo json_encode($dados);
			exit;
		}
	}else{

		$query = "SELECT email, cnpj FROM clientes WHERE email = '$email' OR cnpj = '$cnpj'";
		$result = $sqli->query($query);
		$result = $result->fetch_array();

		if(($result['email'] == $email) && ($result['cnpj'] == $cnpj)){

			$dados = array(
						'return' => true,
						'email'  => true,
						'cpf'    => false,
						'cnpj'   => true
						);
			echo json_encode($dados);
			exit;

		}else if(($result['email'] == $email) && ($result['cnpj'] != $cnpj)){

			$dados = array(
						'return' => true,
						'email'  => true,
						'cpf'    => false,
						'cnpj'   => false
						);
			echo json_encode($dados);
			exit;
		}else if(($result['email'] != $email) && ($result['cnpj'] == $cnpj)){

			$dados = array(
						'return' => true,
						'email'  => false,
						'cpf'    => false,
						'cnpj'   => true
						);
			echo json_encode($dados);
			exit;
		}else if(($result['email'] != $email) && ($result['cnpj'] != $cnpj)){

			$dados = array(
						'return' => true,
						'email'  => false,
						'cpf'    => false,
						'cnpj'   => false
						);
			echo json_encode($dados);
			exit;
		}
	}
}else{

	$dados = array(
				'return' => false,
				'msg'    => "Houve um erro ao buscar o cliente!"
				);
	echo json_encode($dados);
	exit;
}