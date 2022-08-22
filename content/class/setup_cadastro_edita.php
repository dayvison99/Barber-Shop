<?php
require("../../config/start.php");

if (!empty($_POST)) {
	//campos com validção simples
	$campos = array('pessoa_juridica', 'cpf', 'data_nascimento', 'sexo', 'telefone');
	
	foreach($campos as $campo){
		if(isset($_POST[$campo])){
			$$campo = addslashes($_POST[$campo]);
		}else{
			$$campo = "";
		}
	}

	$sqli = $bd->conexao();

	$query = "SELECT id FROM config_cadastro WHERE id = 1";

	$result = $sqli->query($query);
	// $result = $result->fetch_array();

	if($result->num_rows != 0){
		
		$query = "UPDATE config_cadastro SET pessoa_juridica='$pessoa_juridica', cpf='$cpf', data_nascimento='$data_nascimento', sexo='$sexo', telefone='$telefone' WHERE id = 1";
		$sqli->query($query);

		// pre($query);
		// pre($sqli);
		// exit();

		if($sqli->connect_errno){

			echo $sqli->error;
			pre($sqli->error_list);
			exit;

		}else{

			header("location:".PL_PATH_ADMIN.'/setup_cadastro');
		}

	}	

}else{

	header("location:".PL_PATH_ADMIN.'/setup_cadastro');
}