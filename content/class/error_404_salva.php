<?php
require("../../config/start.php");

// pre($_POST);
// exit();

if (!empty($_POST)) {

	$sqli = $bd->conexao();

	$query = "SELECT * FROM paginas WHERE url = 'error-404'";
	$page  = $sqli->query($query);
	$page  = $page->fetch_array();
	
	if(empty($page)){

		$url  = "error-404";
		$data = date("Y-m-d H:i:s");
		
		if(isset($_POST['nome'])){
			$nome = $_POST['nome'];
		}else{
			$nome = '';
		}

		if(isset($_POST['conteudo'])){
			$conteudo = $_POST['conteudo'];
		}else{
			$conteudo = '';
		}

		$sqli = $bd->conexao();
		
		if (mysqli_connect_errno()) {
		    printf("Falha na conexao: %s\n", mysqli_connect_error());
		    exit();
		}

		$query = "INSERT INTO paginas VALUES (NULL, '$nome', '$url', '$conteudo', '$data', '$data', 0, 1, 0)";

		// pre($query);
		// exit();

		$sqli->query($query);

		if(!$sqli->connect_errno){
			header("location:".PL_PATH_ADMIN.'/error_404');
		}else{
			echo $sqli->error;
			pre($sqli->error_list);
			exit;
		}

	}else{

		$dados = '';

		if((isset($_POST['nome'])) && (!empty($_POST['nome']))){
			$dados .= "nome='".$_POST['nome']."',";
		}else{
			$dados .= "nome='',";
		}

		if((isset($_POST['conteudo'])) && (!empty($_POST['conteudo']))){
			$dados .= "conteudo='".$_POST['conteudo']."',";
		}else{
			$dados .= "conteudo='',";
		}

		$dados .= "ultima_atualizacao='".date('Y-m-d H:i:s')."',";
		
		$dados .= "url='error-404',";
		
		if (mysqli_connect_errno()) {
		    printf("Falha na conexao: %s\n", mysqli_connect_error());
		    exit();
		}

		$dados = substr($dados, 0, -1);
		
		$query = "UPDATE paginas SET $dados WHERE id = " . $_POST['id'];

		// echo $query;
		// exit();

		$sqli->query($query);

		// pre($sqli);

		if(!$sqli->connect_errno){

			header("location:".PL_PATH_ADMIN.'/error_404');
			
		}else{
			echo $sqli->error;
			pre($sqli->error_list);
			exit;
		}
	}

}else{

	header("location:".PL_PATH_ADMIN.'/error_404');
}