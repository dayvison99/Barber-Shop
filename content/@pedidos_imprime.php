<?php
$dados_url = explode('/', $_GET['get']);

$sqli = $bd->conexao();
$query ="SELECT * FROM pedidos WHERE (id = ".$dados_url[1].")";
$dados_pedidos = $sqli->query($query);

$dados_pedidos = $dados_pedidos->fetch_array();

$id = $dados_pedidos['id'];

$query = "SELECT * FROM pedidos_clientes WHERE (id_pedido = ".$id.")";
$dados_clientes = $sqli->query($query);
$dados_clientes = $dados_clientes->fetch_array();

$query ="SELECT * FROM pedidos_produto WHERE (id_pedido = ".$id.")";
$dados_produtos = $sqli->query($query);

$query ="SELECT * FROM setup WHERE id = 1";
$setup = $sqli->query($query);
$setup = $setup->fetch_array();

$query ="SELECT * FROM design WHERE id = 1";
$design = $sqli->query($query);
$design = $design->fetch_array();


if(!empty($dados_produtos)){
	$total    = 0;
	foreach ($dados_produtos as $key => $value) {

		if(($value['desconto'] < $value['valor']) && $value['desconto'] != "0.00"){
			$total    = $total + ($value['desconto'] * $value['quantidade']);
		}else{
			$total    = $total + ($value['valor'] * $value['quantidade']);
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo PL_PATH_ADMIN; ?>/public/img/favicon.ico"/>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>
			<?php
			if(isset($_GET['pagina'])){
				echo $_GET['pagina'] . ' | Imprime Pedido '.NOME_LOJA;
			}else{
				echo "Imprime Pedido ".NOME_LOJA;
			}
			?>
		</title>
		<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link rel="stylesheet" href="<?php echo PL_PATH_ADMIN ?>/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo PL_PATH_ADMIN ?>/public/bower_components/font-awesome/css/font-awesome.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo PL_PATH_ADMIN ?>/public/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
	  page. However, you can choose any other skin. Make sure you
	  apply the skin class to the body tag so the changes take effect. -->
	<link rel="stylesheet" href="<?php echo PL_PATH_ADMIN ?>/public/css/skins/skin-blue.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	  var base_url = '<?php echo PL_PATH_ADMIN; ?>';
	</script>

	<style type="text/css">
		body{
			width: 80%;
			margin: 0 auto;
		}
		table, th, td {
		   border: 0;
		}

		table .border {
		   border: 1px solid #afafaf;
		}
		table .bgcolor{
			/*background: url('<?php echo PL_PATH_ADMIN ?>/public/img/back_gray.png') repeat #ccc;*/
		}

		@media print {
			body{
				width: 100%;
				margin: 0 auto;
			}
			.botao_imprime{
				visibility: hidden;
			}
			
			table, th, td {
			   border: 0;
			}

			table .border {
			   border: 1px solid #afafaf;
			}
			table .bgcolor{
				/*background: url('<?php echo PL_PATH_ADMIN ?>/public/img/back_gray.png') repeat #ccc;*/
			}
		}

	</style>

	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	</head>

	<body class="hold-transition" onload="window.print()">
		<form>
		<table style="width:100%" border="0" cellspacing="0">
			<tr class="border">
				<td colspan="1" align="center">
					<img src="<?php echo PL_PATH_IMAGES_UPLOAD.'design/'.$design['logo'];?>" width="80">
				</td>
				<td colspan="9">
					<?php echo $setup['razao_social']; ?><br />
					CNPJ <?php echo $setup['cnpj']; ?><br />
					<?php echo $setup['rua'].','.$setup['numero'].' '.$setup['complemento'].'- '.$setup['bairro'].' - '.$setup['cidade'].'/'.$setup['estado']; ?>
				</td> 
				<td colspan="2">
					<?php echo $setup['telefone_1']; ?><br />
					<?php echo $setup['email']; ?>
				</td>
			</tr>

			<tr>
				<td colspan="12">
					<span style="float: left; height: 5px"></span>
				</td>
			</tr>

			<tr class="border bgcolor">
				<td colspan="12" align="center">
					<span style="font-size: 16px; padding: 5px 0; float: left; width: 100%;">
						<strong>
							PEDIDO Nº <?php echo $id ." - ". convert_data($dados_pedidos['data']); ?>
						</strong>
					</span>
				</td>
			</tr>

			<tr>
				<td colspan="12">
					<span style="float: left; height: 5px"></span>
				</td>
			</tr>

			<tr class="border bgcolor">
				<td colspan="12" class="bgcolor" border="1" bordercolor="#afafaf">
					<span style="font-size: 16px; padding: 5px 0; float: left; width: 100%;">
						<strong>
							DADOS DO CLIENTE
						</strong>
					</span>
				</td>
			</tr>

			<tr>
				<td colspan="12">
					<table style="width:100%" border="0" cellspacing="0">
						<tr>
							<td colspan="1" class="border" style="border-right: 0">
								Nome: <?php echo $dados_clientes['nome'];?>
							</td>
							<td colspan="5" class="border" style="border-left: 0">
								CNPJ/CPF: <?php echo (!empty($dados_clientes['cpf']) ? $dados_clientes['cpf'] : "");?>
							</td>
						</tr>
						<tr>
							<td colspan="1" class="border" style="border-right: 0">
								Endereço: <?php echo $dados_pedidos['rua'].', '.$dados_pedidos['numero'].' '.$dados_pedidos['complemento'].' - '.$dados_pedidos['bairro'] .', '. $dados_pedidos['cidade'] .' - '. $dados_pedidos['estado'];?>
							</td>
							<td colspan="5" class="border" style="border-left: 0">
								CEP: <?php echo $dados_pedidos['cep'];?>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="border" style="border-right: 0">
								Telefone: <?php echo $dados_clientes['telefone_1'];?>
							</td>
							<td colspan="3" class="border" style="border-left: 0">
								E-mail: <?php echo $dados_clientes['email'];?>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="12">
					<span style="float: left; height: 5px"></span>
				</td>
			</tr>

			<tr class="border bgcolor">
				<td colspan="12" class="bgcolor" border="1" bordercolor="#afafaf">
					<span style="font-size: 16px; padding: 5px 0; float: left; width: 100%;">
						<strong>
							DADOS DO PAGAMENTO
						</strong>
					</span>
				</td>
			</tr>

			<tr>
				<td colspan="12">
					<table style="width:100%" border="0" cellspacing="0">
						<tr>
							<td colspan="3" class="border">
								<strong>
									VENCIMENTO
								</strong>
							</td>
							<td colspan="2" class="border">
								<strong>
									VALOR
								</strong>
							</td>
							<td colspan="4" class="border">
								<strong>
									FORMA DE PAGAMENTO
								</strong>
							</td>
							<td colspan="3" class="border">
								<strong>
									OBSERVAÇÃO
								</strong>
							</td>
						</tr>

						<tr>
							<td colspan="3" class="border">
								12/01/2019
							</td>
							<td colspan="2" class="border">
								R$ <?php echo number_format($total, 2, ',', '.'); ?>
							</td>
							<td colspan="4" class="border">
								Boleto
							</td>
							<td colspan="3" class="border">
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="12">
					<span style="float: left; height: 5px"></span>
				</td>
			</tr>

			<tr class="border bgcolor">
				<td colspan="12" class="bgcolor" border="1" bordercolor="#afafaf">
					<span style="font-size: 16px; padding: 5px 0; float: left; width: 100%;">
						<strong>
							PRODUTOS
						</strong>
					</span>
				</td>
			</tr>

			<tr>
				<td colspan="12">
					<table style="width:100%" border="0" cellspacing="0">
						<tr>
							<td colspan="1" class="border">
								<strong>COD</strong>
							</td>
							<td colspan="5" class="border">
								<strong>NOME</strong>
							</td>
							<td colspan="2" align="right" class="border">
								<strong>QTD.</strong>
							</td>
							<td colspan="2" align="right" class="border">
								<strong>V. UNIT.</strong>
							</td>
							<td colspan="2" align="right" class="border">
								<strong>SUB TOTAL</strong>
							</td>
						</tr>

						<?php
						if(!empty($dados_produtos)){
							$subtotal = 0;
							$total    = 0;
							foreach ($dados_produtos as $key => $value) {

								if(($value['desconto'] < $value['valor']) && $value['desconto'] != "0.00"){

									$valor_produto            = $value['desconto'];
									$valor_produto_quantidade = ($value['desconto'] * $value['quantidade']);

									$subtotal = $subtotal + $valor_produto;
									$total    = $total + ($valor_produto * $value['quantidade']);

								}else{

									$valor_produto            = $value['valor'];
									$valor_produto_quantidade = ($value['valor'] * $value['quantidade']);

									$subtotal = $subtotal + $valor_produto;
									$total    = $total + ($valor_produto * $value['quantidade']);
								}
						?>
								<tr>
									<td colspan="1" class="border">
										<?php echo $value['id_produto']; ?>
									</td>
									<td colspan="5" class="border">
										<?php echo $value['nome']; ?>
									</td>
									<td colspan="2" align="right" class="border">
										<?php echo $value['quantidade']; ?>
									</td>
									<td colspan="2" align="right" class="border">
										R$ <?php echo number_format($valor_produto, 2, ',', '.'); ?>
									</td>
									<td colspan="2" align="right" class="border">
									R$ <?php echo number_format($valor_produto_quantidade, 2, ',', '.'); ?>
									</td>
								</tr>
						<?php
							}
						}else{
						?>
							<tr>
								<td colspan="1" class="border"></td>
								<td colspan="5" class="border"></td>
								<td colspan="2" class="border"></td>
								<td colspan="2" class="border"></td>
								<td colspan="2" class="border"></td>
							</tr>
						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr class="border bgcolor">
				<td colspan="12" align="right">
					<span style="font-size: 16px; padding: 5px 0; float: left; width: 100%;">
						<strong>
							TOTAL: R$ <?php echo number_format($total, 2, ',', '.'); ?>
						</strong>
					</span>
				</td>
			</tr>

			<tr>
				<td colspan="12">
					<span style="float: left; height: 30px"></span>
				</td>
			</tr>

		</table>

		<div class="text-center botao_imprime">
			<span>Clique no bot&atilde;o para imprimir a p&aacute;gina</span><br />
			<input type="button" name="imprimir" value="Imprimir" onclick="window.print();">
		</div>

		</form>

	</body>
</html>