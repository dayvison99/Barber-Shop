<?php
require("../../config/start.php");

// pre($_POST);
// exit();
$dados = '';

if (!empty($_POST)) {

	$id = $_POST['id'];

	if((isset($_POST['nome'])) && (!empty($_POST['nome']))){
		$dados .= "nome='".$_POST['nome']."',";
	}

	if((isset($_POST['tipo_usuario'])) && (!empty($_POST['tipo_usuario']))){
		$dados .= "tipo_usuario=".$_POST['tipo_usuario'].",";
	}

	if((isset($_POST['usuario'])) && (!empty($_POST['usuario']))){
		$dados .= "usuario='".$_POST['usuario']."',";
	}

	if((isset($_POST['senha'])) && (!empty($_POST['senha']))){
		$dados .= "senha='".md5($_POST['senha'])."',";
	}

	if((isset($_POST['ultima_atualizacao'])) && (!empty($_POST['ultima_atualizacao']))){
		$dados .= "ultima_atualizacao='".$_POST['ultima_atualizacao']."',";
	}

	// pre($dados);
	// exit;

	$sqli = $bd->conexao();
	
	if (mysqli_connect_errno()) {
	    printf("Falha na conexao: %s\n", mysqli_connect_error());
	    exit();
	}

	$dados = substr($dados, 0, -1);
	
	$query = "UPDATE usuarios SET $dados WHERE id = $id";

	// echo $query;
	// exit();

	$sqli->query($query);

	// pre($sqli);

	if(!$sqli->connect_errno){

		if($_POST['salvar'] == 'continuar'){
			header("location:".PL_PATH_ADMIN.'/usuarios_edita/'.$id);
		}else{
			header("location:".PL_PATH_ADMIN.'/usuarios');
		}
	}else{
		echo $sqli->error;
		pre($sqli->error_list);
		exit;
	}

	// printf ("New Record has id %d.\n", $sqli->insert_id);

}else{

	header("location:".PL_PATH_ADMIN.'/usuarios');
}