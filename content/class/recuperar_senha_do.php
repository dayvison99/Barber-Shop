<?php

require("../../config/start.php");

// pre($_POST);
// exit();

if(!empty($_POST)){

	$sqli = $bd->conexao();
	
	if (mysqli_connect_errno()) {
		printf("Falha na conexao: %s\n", mysqli_connect_error());
		exit();
	}

	$query = "SELECT id, id_usuario, email FROM usuarios_recuperar_senha WHERE hash_recuperacao ='".$_POST['cod']."'";

	$retorno = $sqli->query($query);
	$retorno = $retorno->fetch_array();

	if(!empty($retorno)){
		$query = "UPDATE usuarios_recuperar_senha SET data_recuperacao='".date('Y-m-d H:i:s')."',status=1 WHERE id = ". $retorno['id'];
		$sqli->query($query);

		$query = "SELECT senha FROM usuarios WHERE id ='".$retorno['id_usuario']."'";

		$retorno2 = $sqli->query($query);
		$retorno2 = $retorno2->fetch_array();

		$query = "UPDATE usuarios SET senha='".md5($_POST['senha'])."',senha_anterior='".$retorno2['senha']."', ultima_atualizacao='".date('Y-m-d H:i:s')."' WHERE id = ". $retorno['id'];
		$sqli->query($query);

		header("location:".PL_PATH_ADMIN."/login.php&msg=Sua senha foi alterada! realize um novo login.&status=success");

	}else{
		header("location:".PL_PATH_ADMIN."/login.php&msg=Desculpe, mas não foi possível trocar a senha.&status=warining");
	}

}else{
	header("location:".PL_PATH_ADMIN."/login.php&msg=Desculpe, mas não foi possível trocar a senha.&status=warining");
}