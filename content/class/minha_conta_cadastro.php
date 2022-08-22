<?php
require("../../config/start.php");

function buscaDadosArquivo()
{
	$arquivo      = fopen(VCARDAPIO_CONFIG_FILE, 'r');
	$conteudo_arquivo = fgets($arquivo, 1024);

	// Fecha arquivo aberto
	fclose($arquivo);

	$dados_arquivo = explode('&', $conteudo_arquivo);
	$dados_bd = explode(';', $dados_arquivo[1]);

	return $dados_bd;
}

function defineConstantes()
{
	$constantes = [];
	try {
		$dados_bd = buscaDadosArquivo();
	} catch (\Exception $e) {
		return $constantes;
	}

	$constantes['HOST_SERVER'] = $dados_bd[0];
	$constantes['USER_SERVER'] = $dados_bd[1];
	$constantes['PASS_SERVER'] = $dados_bd[2];
	$constantes['DB_SERVER'] = $dados_bd[3];
	return $constantes;
}

function isPlanoCardapio()
{
	if (!empty($_SESSION['PL_USER']) && !empty($_SESSION['PL_USER']['plano_id']) && $_SESSION['PL_USER']['plano_id'] == 1) { // Usuário com Plano Cardápio
		return true;
	} else { // Usuário Comum
		return false;
	}
}

if (isPlanoCardapio()) {
	$constantes = defineConstantes();
	$bd = new Banco($constantes);
	$sqli = $bd->conexao();
} else {
	$sqli   = $bd->conexao();
}

if (!empty($_POST)) {

	if (mysqli_connect_errno()) {
		printf("Falha na conexao: %s\n", mysqli_connect_error());
		exit();
	}

	if (isPlanoCardapio()) {
		$query = "SELECT senha FROM restaurantes WHERE id = " . $_POST['id'];
	} else {
		$query = "SELECT senha FROM usuarios WHERE id = " . $_POST['id'];
	}

	$result = $sqli->query($query);
	$result = $result->fetch_array();

	if ($result['senha'] == md5($_POST['senha_atual'])) {

		if (isPlanoCardapio()) {
			$query = "UPDATE restaurantes SET nome='" . $_POST['nome'] . "', senha='" . md5($_POST['nova_senha']) . "' WHERE id = " . $_POST['id'];
		} else {
			$query = "UPDATE usuarios SET nome='" . $_POST['nome'] . "', ultima_atualizacao='" . date('Y-m-d H:i:s') . "', senha='" . md5($_POST['nova_senha']) . "', senha_anterior='" . md5($_POST['senha_atual']) . "' WHERE id= " . $_POST['id'];
		}

		$sqli->query($query);

		if (!$sqli->connect_errno) {
			$dados = array(
				'return' => true,
				'msg'    => "Os dados foram alterados com sucesso!"
			);
			echo json_encode($dados);
			exit;
		} else {
			$dados = array(
				'return' => false,
				'msg'    => "Desculpa, ocorreu um erro ao alterar os dados!"
			);
			echo json_encode($dados);
			exit;
		}
	} else {
		$dados = array(
			'return' => false,
			'msg'    => "A senha atual está incorreta!"
		);
		echo json_encode($dados);
		exit;
	}
} else {
	$dados = array(
		'return' => false,
		'msg'    => "Não foi possível alterar os dados!"
	);
	echo json_encode($dados);
	exit;
}
