<?php
require("config/start.php");
?>
<!DOCTYPE html>
<html>
<?php

// pre($_SESSION);
// pre($_SESSION['PL_USER']);

if (isset($_GET['get']) && isset($_SESSION['PL_USER']) && !empty($_SESSION['PL_USER'])) {

	if (isset($_GET['get'])) {
		$dados = explode('/', $_GET['get']);
	} else {
		$dados[0] = 'home';
	}

	$pag_vendedor = array('pedidos', 'pedidos_visualiza', 'pedidos_imprime', 'clientes', 'clientes_cadastro', 'clientes_edita', 'clientes_detalhes', 'produtos', 'produtos_cadastro', 'produtos_edita', 'produtos_cadastro_imagens', 'categorias', 'categorias_cadastro', 'categorias_edita', 'adicionais', 'adicionais_cadastro', 'adicionais_edita', 'itens', 'itens_cadastro', 'itens_edita');

	if ($_SESSION['PL_USER']['tipo'] == 3 && !in_array($dados[0], $pag_vendedor)) {
		require("layout/header.php");
		require("content/pedidos.php");
		require("layout/footer.php");
		exit;
	}

	if (($dados[0] != "login") && ($dados[0] != "recuperar_senha") && ($dados[0] != "recuperar_senha_troca") && ($dados[0] != "cadastrar_loja") && ($dados[0] != "contratar") && ($dados[0] != "pedidos_imprime") && ($dados[0] != "imprimir_cardapio") && ($dados[0] != "qrcode")) {

		require("layout/header.php");

		if (file_exists("content/" . $dados[0] . ".php")) {
			require("content/" . $dados[0] . ".php");
		} else {
			require("content/404.php");
		}

		require("layout/footer.php");
	} else {

		if (file_exists("content/" . $dados[0] . ".php")) {
			require("content/" . $dados[0] . ".php");
		} else {
			require("content/404.php");
		}
	}
} else if (isset($_GET['get']) &&  isset($_SESSION['PL_USER']) && empty($_SESSION['PL_USER'])) {

	$dados = explode('/', $_GET['get']);

	if (($dados[0] == "login") || ($dados[0] == "recuperar_senha") || ($dados[0] == "recuperar_senha_troca") || ($dados[0] == "cadastrar_loja") || ($dados[0] == "contratar") || ($dados[0] == "pedidos_imprime")) {
		require("content/" . $dados[0] . ".php");
	} else {
		require("content/login.php");
	}
} else {
	require("content/login.php");
}

?>

</html>