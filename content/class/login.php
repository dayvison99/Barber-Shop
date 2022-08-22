<?php

require("../../config/start.php");

if (!empty($_POST)) {

	$sqli = $bd->conexao();
	
	if (mysqli_connect_errno()) {
	    printf("Falha na conexao: %s\n", mysqli_connect_error());
	    exit();
	}

	$query = "SELECT id, tipo_usuario, nome, usuario, senha FROM usuarios WHERE usuario = '".$_POST['login']."' AND excluido = 0 AND status = 1";

	$retorno = $sqli->query($query);
	$retorno = $retorno->fetch_array();

	// pre($retorno);
	// exit();

	if(!empty($retorno)){
		
		//$pass = md5($_POST['senha']);

		if($retorno['senha'] == md5($_POST['senha'])){

			

			// Inicia a sessão
			// session_start();

			$_SESSION['PL_USER'] = array(
										'id'      => $retorno['id'] ,
										'tipo'    => $retorno['tipo_usuario'],
										'nome'    => $retorno['nome'],
										'usuario' => $retorno['usuario'],
	
										
										);

			

			header("location:".PL_PATH_ADMIN."/tarefas");
		}else{
			header("location:".PL_PATH_ADMIN."/login/&log=".$_POST['login']."&msg=Login ou senha incorretos!&status=error");
		}

	}else{
		header("location:".PL_PATH_ADMIN."/login/&log=".$_POST['login']."&msg=Login ou senha incorretos!&status=error");
	}

}else{
	header("location:".PL_PATH_ADMIN."/login/&msg=Login ou senha incorretos!&status=error");
}