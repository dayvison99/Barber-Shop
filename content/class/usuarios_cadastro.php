<?php
require("../../config/start.php");

// pre($_POST);
// exit();

if (!empty($_POST)) {

	//campos com validção simples
	$campos = array('nome','usuario','senha_anterior');
	
	foreach($campos as $campo){
		if(isset($_POST[$campo])){
			$$campo = $_POST[$campo];
		}else{
			$$campo = "";
		}
	}

	//campos com validção especifica
	if(isset($_POST['tipo_usuario'])){
		$tipo_usuario = $_POST['tipo_usuario'];
	}else{
		$tipo_usuario = 1;
	}

	//campos com validção especifica
	if(isset($_POST['senha'])){
		$senha = md5($_POST['senha']);
	}else{
		$senha = "";
	}

	if(isset($_POST['data_cadastro'])){
		$data_cadastro = $_POST['data_cadastro'];
	}else{
		$data_cadastro = date("Y-m-d H:i:s");
	}

	if(isset($_POST['ultima_atualizacao'])){
		$ultima_atualizacao = $_POST['ultima_atualizacao'];
	}else{
		$ultima_atualizacao = date("Y-m-d H:i:s");
	}

	if(isset($_POST['status'])){
		$status = $_POST['status'];
	}else{
		$status = "1";
	}

	if(isset($_POST['excluido'])){
		$excluido = $_POST['excluido'];
	}else{
		$excluido = "0";
	}
	
	$sqli = $bd->conexao();
	
	if (mysqli_connect_errno()) {
	    printf("Falha na conexao: %s\n", mysqli_connect_error());
	    exit();
	}

	$query = "INSERT INTO usuarios VALUES (NULL, '$nome', $tipo_usuario, '$usuario', '$senha', '$senha_anterior', '$data_cadastro', '$ultima_atualizacao', '$status', '$excluido')";

	// pre($query);
	// exit();

	$sqli->query($query);

	if(!$sqli->connect_errno){

		if($_POST['salvar'] == 'continuar'){
			header("location:".PL_PATH_ADMIN.'/usuarios_edita/'.$url);
		}else{
			header("location:".PL_PATH_ADMIN.'/usuarios');
		}
	}else{
		echo $sqli->error;
		pre($sqli->error_list);
		exit;
	}

}else{

	header("location:".PL_PATH_ADMIN.'/usuarios');
}