<?php
require("../../config/start.php");

// pre($_POST);
// exit();

if (!empty($_POST)) {

	//campos com validação simples
	$campos = array('nome','idade');
	
	foreach($campos as $campo){
		if(isset($_POST[$campo])){
			$$campo = $_POST[$campo];
		}else{
			$$campo = "";
		}
	}
	if(isset($_POST['data_contratacao'])){
		$valor = explode('/',$_POST['data_contratacao']);
		$data_contratacao = $valor[2]."-".$valor[1]."-".$valor[0];
	}else{
		$data_contratacao = date("Y-m-d");
	}

	if(isset($_POST['ultima_atualizacao'])){
		$ultima_atualizacao = $_POST['ultima_atualizacao'];
	}else{
		$ultima_atualizacao = date("Y-m-d H:i:s");
	}

	$status = 1; // status 1 = ativo 0 = inativo

	$excluido = 0; // 0 = não excluido 1 = excluido
	
	$sqli = $bd->conexao();
	
	if (mysqli_connect_errno()) {
	    printf("Falha na conexao: %s\n", mysqli_connect_error());
	    exit();
	}

	$query = "INSERT INTO tarefas VALUES (NULL, '$nome', '$idade', '$data_contratacao', '$ultima_atualizacao', '$status', '$excluido')";

	// pre($query);
	// exit();

	$sqli->query($query);

	if(!$sqli->connect_errno){

		$id_produto = $sqli->insert_id;


		if (!empty($_POST['categorias'])) {

			foreach ($_POST['categorias'] as $value) {

				$cat = explode('-', $value);

				if(empty($cat[1]))
					$cat[1] = 0;

				// pre($cat);
				// exit();

				$query = "INSERT INTO produtos_categorias (id_produto, id_categoria, id_subcategoria) VALUES ($id_produto,".$cat[0].",".$cat[1].")";
				$sqli->query($query);
			}
		}

		if($_POST['salvar'] == 'continuar'){
			header("location:".PL_PATH_ADMIN.'/tarefas_edita/'.$url);
		}else{
			header("location:".PL_PATH_ADMIN.'/tarefas');
		}
	}else{
		echo $sqli->error;
		pre($sqli->error_list);
		exit;
	}

}else{

	header("location:".PL_PATH_ADMIN.'/tarefas');
}