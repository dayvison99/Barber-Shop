<?php
require("../../config/start.php");

// pre($_POST);
// exit();

if (!empty($_POST)) {

	//campos com validção simples
	$campos = array('nome', 'razao_social', 'cnpj', 'i_estadual', 'i_municipal', 'telefone_1', 'telefone_2', 'email', 'cep', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'pais', 'meta_title', 'meta_descricao', 'meta_keys', 'informacao_loja_fechada', 'valor_min');
	
	foreach($campos as $campo){
		if(isset($_POST[$campo])){
			$$campo = addslashes($_POST[$campo]);
		}else{
			$$campo = "";
		}
	}

	if((isset($_POST['whatsapp'])) && (!empty($_POST['whatsapp']))){
		if($_POST['whatsapp'] == 'on')
			$whatsapp = 1;
		else
			$whatsapp = 0;
	}else{
		$whatsapp = 0;
	}

	if((isset($_POST['data_fundacao'])) && (!empty($_POST['data_fundacao']))){
		$data_fundacao = datetime_bd($_POST['data_fundacao']);
	}else{
		$data_fundacao = date("Y-m-d H:i:s");
	}

	if(isset($_POST['ultima_atualizacao'])){
		$ultima_atualizacao = $_POST['ultima_atualizacao'];
	}else{
		$ultima_atualizacao = date("Y-m-d H:i:s");
	}

	// if((isset($_POST['horario_abertura'])) && (!empty($_POST['horario_abertura']))){
	// 	$horario_abertura = $_POST['horario_abertura'];
	// }else{
	// 	$horario_abertura = '00:00:00';
	// }

	// if((isset($_POST['horario_fechamento'])) && (!empty($_POST['horario_fechamento']))){
	// 	$horario_fechamento = $_POST['horario_fechamento'];
	// }else{
	// 	$horario_fechamento = '00:00:00';
	// }

	// if((isset($_POST['dias_fechado'])) && (!empty($_POST['dias_fechado']))){
	// 	$dias_fechado = '';
	// 	foreach ($_POST['dias_fechado'] as $key => $value) {
	// 		$dias_fechado .= $value."-";
	// 	}
	// 	$dias_fechado = substr($dias_fechado, 0, -1);
	// }else{
	// 	$dias_fechado = '';
	// }

	$sqli = $bd->conexao();

	if( isset($_POST['dia']) && !empty($_POST['dia'])){
		$query = "TRUNCATE TABLE setup_horarios";
		$sqli->query($query);

		foreach ($_POST['dia'] as $key => $value) {
			$horario_abertura = $_POST['horario_abertura'][$key];
			$horario_fechamento = $_POST['horario_fechamento'][$key];

			$query = "INSERT INTO setup_horarios (dia, horario_abertura, horario_fechamento, ultima_atualizacao) VALUES ('$value', '$horario_abertura', '$horario_fechamento', '$ultima_atualizacao')";
			$sqli->query($query);
		}
	}else{
		$query = "TRUNCATE TABLE setup_horarios";
		$sqli->query($query);
	}

	if(isset($_POST['sac_id']) && !empty($_POST['sac_id'])){
		
		$query = "SELECT id FROM setup_sac WHERE id = ".$_POST['sac_id'];

		$result = $sqli->query($query);
		// $result = $result->fetch_array();

		if($result->num_rows != 0){
			$query = "UPDATE setup_sac SET telefone ='".$_POST['sac_telefone']."', telefone2 ='".$_POST['sac_telefone2']."', mensagem ='".$_POST['sac_mensagem']."', email='".$_POST['sac_email']."' WHERE id = ". $_POST['sac_id'];
			$sqli->query($query);

		}else{
			$query = "INSERT INTO setup_sac(telefone, telefone2, mensagem, email) VALUES ('".$_POST['sac_telefone']."', '".$_POST['sac_telefone2']."','".$_POST['sac_mensagem']."', '".$_POST['sac_email']."')";
			$sqli->query($query);
		}

	}else{
		$query = "INSERT INTO setup_sac(telefone, telefone2, mensagem, email) VALUES ('".$_POST['sac_telefone']."', '".$_POST['sac_telefone2']."','".$_POST['sac_mensagem']."', '".$_POST['sac_email']."')";
			$sqli->query($query);
	}
    $qvm = "SELECT * FROM min_value WHERE id=1";
    $min_value = $sqli->query($qvm);
    if($min_value->num_rows != 0){
        $qvm_upd = "UPDATE min_value SET val='$valor_min' WHERE id=1";
        $sqli->query($qvm_upd);
    }

	$query = "SELECT id FROM setup WHERE id = 1";

	$result = $sqli->query($query);
	// $result = $result->fetch_array();

	if($result->num_rows != 0){
		
		$query = "UPDATE setup SET nome='$nome', razao_social='$razao_social', cnpj='$cnpj', i_estadual='$i_estadual', i_municipal='$i_municipal', data_fundacao='$data_fundacao', telefone_1='$telefone_1', telefone_2='$telefone_2', whatsapp='$whatsapp', email='$email', cep='$cep', rua='$rua',numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade', estado='$estado', pais='$pais', meta_title='$meta_title', meta_descricao='$meta_descricao', meta_keys='$meta_keys', ultima_atualizacao='$ultima_atualizacao', informacao_loja_fechada='$informacao_loja_fechada' WHERE id = 1";
		$sqli->query($query);

		// pre($query);
		// pre($sqli);
		// exit();

		if($sqli->connect_errno){

			echo $sqli->error;
			pre($sqli->error_list);
			exit;

		}else{

			header("location:".PL_PATH_ADMIN.'/setup');
		}

	}else{

		$query = "INSERT INTO setup (nome, razao_social, cnpj, i_estadual, i_municipal, data_fundacao, telefone_1, telefone_2, whatsapp, email, cep, rua, numero, complemento, bairro, cidade, estado, pais, meta_title, meta_descricao, meta_keys, informacao_loja_fechada, ultima_atualizacao) VALUES ('$nome', '$razao_social', '$cnpj', '$i_estadual', '$i_municipal', '$data_fundacao', '$telefone_1', '$telefone_2', '$whatsapp', '$email', '$cep', '$rua', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$pais', '$meta_title', '$meta_descricao', '$meta_keys', '$informacao_loja_fechada', '$ultima_atualizacao')";
		
		// pre($query);
		// exit();

		$sqli->query($query);

		if($sqli->connect_errno){

			echo $sqli->error;
			pre($sqli->error_list);
			exit;

		}else{

			header("location:".PL_PATH_ADMIN.'/setup');
		}
	}	

}else{

	header("location:".PL_PATH_ADMIN.'/setup');
}