<?php
require("../../config/start.php");

// pre($_POST);
// exit();
$dados = '';

if (!empty($_POST)) {

	$id = $_POST['id_tarefa'];

	if((isset($_POST['nome'])) && (!empty($_POST['nome']))){
		$dados .= "nome='".$_POST['nome']."',";
	}


	if((isset($_POST['descricao'])) && (!empty($_POST['descricao']))){
		$dados .= "descricao='".$_POST['descricao']."',";
	}

	$dados .= "ultima_atualizacao='".date("Y-m-d H:i:s")."',"; 

	$sqli = $bd->conexao();
	
	if (mysqli_connect_errno()) {
	    printf("Falha na conexao: %s\n", mysqli_connect_error());
	    exit();
	}

	$dados = substr($dados, 0, -1);
	
	$query = "UPDATE tarefas SET $dados WHERE id_tarefa = $id";

	// echo $query;
	// exit();

	$sqli->query($query);

	// pre($sqli);

	if(!$sqli->connect_errno){


		if($_POST['salvar'] == 'continuar'){
			header("location:".PL_PATH_ADMIN.'/clientes_edita/'.$url);
		}else{
			header("location:".PL_PATH_ADMIN.'/clientes');
		}
	}else{
		echo $sqli->error;
		pre($sqli->error_list);
		exit;
	}

	// printf ("New Record has id %d.\n", $sqli->insert_id);

}else{

	header("location:".PL_PATH_ADMIN.'/clientes');
}