<?php
require_once(__DIR__ . "/class/funcoes/controle_exibir.php");
use Model\ControleExibir as ControleExibir;

$exibir = new ControleExibir();

$sqli = $bd->conexao();
$query = "SELECT qt_produtos FROM faturas_configuracao WHERE id = 1";
$qt_produtos = $sqli->query($query);
$qt_produtos = $qt_produtos->fetch_array();


$query = "SELECT COUNT(id) FROM produtos WHERE excluido = 0 AND tipo = 1";
$total_produtos = $sqli->query($query);
$total_produtos = $total_produtos->fetch_array();

if ($total_produtos > $qt_produtos) {
	header("location:" . PL_PATH_ADMIN . '/produtos');
}

require("layout/topo.php");
require("layout/menu.php");

$query_orcamento = "SELECT orcamento FROM design WHERE (id = 1)";
$dados_orcamento = $sqli->query($query_orcamento);
$dados_orcamento = $dados_orcamento->fetch_array();

$itensUserCardapioForm = [
	'nome' => true,
	'sku' => true,
	'status' => true,
	'valor' => true,
	'categorias' => true,

	'imagens' => true,
];

$itensUserCardapioTabs = [
	'dados-gerais' => true,
	'imagens' => true,
];

$inputExibir = $exibir->defineElementosUi($itensUserCardapioForm);
$tabsExibir = $exibir->defineElementosUi($itensUserCardapioTabs);

?>

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo PL_PATH_ADMIN ?>/public/bower_components/select2/dist/css/select2.css">

<div class="wrapper">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<form class="form-horizontal" action="<?php echo PL_PATH_CLASS . '/produtos_cadastro.php' ?>" method="post" enctype="multipart/form-data" id="form">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<span class="pull-left" style="margin-right: 10px">Produtos - Cadastrar</span>
				</h1>

				<div class="pull-right">
					<button type="submit" class="btn btn-success btn-xs" name="salvar" value="salva"><i class="fa fa-floppy-o"></i> Salvar</button>
					<button type="submit" class="btn btn-success btn-xs" name="salvar" value="continuar">Salvar e continuar</button>
				</div>
			</section>
			<div style="clear: both;"></div>
			<!-- Main content -->
			<section class="content">
				<div class="row">

					<div class="col-md-12">
						<!-- Custom Tabs (Pulled to the right) -->
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs pull-left">
								<?php if ($exibir->devoExibirElementoUi('dados-gerais', $tabsExibir)) : ?>
									<li <?php if (empty($_GET['tela'])) echo 'class="active"' ?>>
										<a href="#tab_1" data-toggle="tab">Dados Gerais</a>
									</li>
								<?php endif; ?>

								<?php if ($exibir->devoExibirElementoUi('informacoes', $tabsExibir)) : ?>
									<li <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "informacoes")) echo 'class="active"' ?>>
										<a href="#tab_2" data-toggle="tab">Informações</a>
									</li>
								<?php endif; ?>

								<?php if ($exibir->devoExibirElementoUi('imagens', $tabsExibir)) : ?>
									<li <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "imagens")) echo 'class="active"' ?>>
										<a href="#tab_3" data-toggle="tab">Imagens</a>
									</li>
								<?php endif; ?>
								<?php if ($exibir->devoExibirElementoUi('relacionados', $tabsExibir)) : ?>
									<li <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "relacionados")) echo 'class="active"' ?>>
										<a href="#tab_5" data-toggle="tab">Relacionados</a>
									</li>
								<?php endif; ?>

								<?php if ($exibir->devoExibirElementoUi('adicionais', $tabsExibir)) : ?>
									<li <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "adicionais")) echo 'class="active"' ?>>
										<a href="#tab_6" data-toggle="tab">Adicionais</a>
									</li>
								<?php endif; ?>

								<?php if ($exibir->devoExibirElementoUi('opcoes', $tabsExibir)) : ?>
									<li <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "opcoes")) echo 'class="active"' ?>>
										<a href="#tab_7" data-toggle="tab">Opções</a>
									</li>
								<?php endif; ?>

								<?php if ($exibir->devoExibirElementoUi('seo', $tabsExibir)) : ?>
									<li <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "buscadores")) echo 'class="active"' ?>>
										<a href="#tab_8" data-toggle="tab"> SEO (Buscadores)</a>
									</li>
								<?php endif; ?>
							</ul>
							<div style="clear: both;"></div>
							<div class="tab-content">
								<div class="tab-pane <?php if (empty($_GET['tela'])) echo 'active' ?>" id="tab_1">
									<?php if ($exibir->devoExibirElementoUi('nome', $inputExibir)) : ?>
										<div class="form-group">
											<label for="nome" class="col-sm-2 control-label">Nome <span class="text-red">*</span></label>

											<div class="col-sm-10">
												<input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('sku', $inputExibir)) : ?>
										<div class="form-group">
											<label for="sku" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Código único do produto" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span> Código <span class="text-red">*</span></label>

											<div class="col-sm-10">
												<input type="text" class="form-control" id="sku" placeholder="Código" name="sku">
											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('status', $inputExibir)) : ?>
										<div class="form-group">
											<label for="status" class="col-sm-2 control-label">Status</label>

											<div class="col-sm-10">
												<select name="status" class="form-control" id="status">
													<option value="1">Ativado</option>
													<option value="0">Desativado</option>
												</select>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('valor', $inputExibir)) : ?>
										<div class="form-group">
											<label for="valor" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Valor original do produto (DE)" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span> Valor <small>(de)</small></label>

											<div class="col-sm-10">
												<div class="input-group">
													<div class="input-group-addon">
														R$
													</div>
													<input type="text" class="form-control money" id="valor" placeholder="Valor" name="valor">
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('url', $inputExibir)) : ?>
										<div class="form-group">
											<label for="url" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="O campo URL é gerado automaticamente, caso queira uma url especifica informe ela, se caso existir será editada para não ocorrer erros" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span> Url</label>

											<div class="col-sm-10">
												<input type="text" class="form-control" id="url" placeholder="Url" name="url">
												<small>Deixe vazio para gerar automaticamente.</small>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('categorias', $inputExibir)) : ?>
										<div class="form-group">
											<label for="nome" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Cadastre e adcione as categorias para o produto" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span> Categoria</label>

											<div class="col-sm-10">
												<div class="input-group col-sm-12">

													<div class="col-sm-1" style="padding-left: 0">
														<span class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-default">
															+
														</span>
													</div>

													<div class="modal fade" id="modal-default" style="display: none;">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span></button>
																	<h4 class="modal-title">Adicionar Categoria</h4>
																</div>
																<div class="modal-body">
																	<div class="form-group">
																		<label for="nome_cat" class="col-sm-2 control-label">Nome</label>

																		<div class="col-sm-10">
																			<input type="text" class="form-control" id="nome_cat" placeholder="Nome Categoria">
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
																	<button type="button" class="btn btn-primary" onclick="adiciona_categoria()">Salvar</button>
																</div>
															</div>
														</div>
													</div>

													<select class="form-control select2 col-sm-10" multiple="multiple" data-placeholder="Selecione a Categoria" name="categorias[]" style="width: 91.67%" id="categoria_select">
														<?php
														$dados = $bd->select(array('id', 'nome'), 'categorias', array('status = 1', 'excluido = 0'), array('ordem'), 'DESC', 1000);

														foreach ($dados as $key => $value) {

															$subCat = "SELECT id, nome FROM categorias_sub WHERE id_categoria = " . $value['id'] . " AND status = 1 AND excluido = 0";
															$sqli = $bd->conexao();
															$subCat = $sqli->query($subCat);

															if ($subCat->num_rows == 0) {
														?>
																<option value="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
															<?php
															} else {
															?>
																<optgroup label="<?php echo $value['nome'] ?>">
																	<?php
																	foreach ($subCat as $key => $subcategoria) {
																	?>
																		<option value="<?php echo $value['id'] . '-' . $subcategoria['id'] ?>"><?php echo $subcategoria['nome'] ?></option>
																	<?php
																	}
																	?>
																</optgroup>
														<?php
															}
														}
														?>
													</select>


												</div>

											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('estoque', $inputExibir)) : ?>
										<div class="form-group">
											<label for="estoque" class="col-sm-2 control-label">Qtd. Estoque</label>

											<div class="col-sm-10">
												<input type="number" class="form-control" id="estoque" placeholder="Qtd. Estoque" name="estoque">
											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('disponibilidade', $inputExibir)) : ?>
										<div class="form-group">
											<label for="disponibilidade" class="col-sm-2 control-label">Disponibilidade</label>

											<div class="col-sm-10">
												<select name="disponibilidade" class="form-control" id="disponibilidade">
													<option value="1">Em estoque</option>
													<option value="0">Fora de Estoque</option>
												</select>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('retirar_ingredientes', $inputExibir)) : ?>
										<div class="form-group">
											<label for="url" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Marque essa opção para habilitar o cliente de retirar algum ingrediente do produto" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span>Retirar Ingredientes</label>

											<div class="col-sm-10">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="retirar_ingredientes" id="retirar_ingredientes" value="1"> Sim
													</label>
												</div>
											</div>
										</div>
									<?php endif; ?>


								<?php 
								if($_SESSION['idPlano']==7):
									if ( $exibir->devoExibirElementoUi('valida_cardapio', $inputExibir)) : ?>
										<div class="form-group">
											<label for="url" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Marque essa opção para habilitar produto no cardápio" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span>Inserir no Cardápio de Mesa</label>

											<div class="col-sm-10">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="valida_cardapio" id="valida_cardapio" value="1"> Sim
													</label>
												</div>
											</div>
										</div>
									<?php endif;
									if ( $exibir->devoExibirElementoUi('valida_delivery', $inputExibir)) : ?>
										<div class="form-group">
											<label for="url" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Marque essa opção para habilitar produto no cardápio" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span>Inserir no Delivery</label>

											<div class="col-sm-10">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="valida_delivery" id="valida_delivery" value="1"> Sim
													</label>
												</div>
											</div>
										</div>
									<?php endif; 
									endif; 
								 	
									?>
									

									<div style="clear: both;"></div>

								</div>

								<div class="tab-pane <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "informacoes")) echo 'active' ?>" id="tab_2">
								<!--
									<div class="form-group">
										<label for="imagens" class="col-sm-2 control-label"></label>
										<div class="col-sm-10">
											<div class='btn-group'>
												<a class='btn btn-primary' title='Inserir Imagem' data-toggle='modal' data-target='#modal-imagens'><i class="fa fa-picture-o"></i> Galeria de Imagens</a>
											</div>
										</div>
									</div>
								-->

									<div class="form-group">
										<label for="descricao" class="col-sm-2 control-label">Descrição</label>

										<div class="col-sm-10">
											<textarea class="textarea" id="descricao" name="descricao" placeholder="Descrição"></textarea>
										</div>
									</div>

									<div style="clear: both;"></div>
								</div>

								<div class="tab-pane <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "imagens")) echo 'active' ?>" id="tab_3">

									<div class="alert" style="display: none" id="mensagem_imagem">
										<p class="dado_msg"></p>
									</div>

									<?php if ($exibir->devoExibirElementoUi('imagens', $inputExibir)) : ?>
										<div class="form-group">
											<label for="largura" class="col-sm-2 control-label">Imagens</label>

											<div class="col-sm-10">

												<div class="input-group">
													<span class="btn btn-default btn-file input-group-addon">
														Pesquisar <i class="fa fa-search"></i> <input type="file" id="imgInp">
													</span>
													<input type="text" class="form-control" readonly>
												</div>
												<p class="help-block">
													Tamanho máximo imagens: 1000 x 1000px
													<br />
													Formatos permitidos de imagens: .gif, .bmp, .png, .jpg, .jpeg
												</p>

											</div>

											<div style="clear: both;"></div>
										</div>
									<?php endif; ?>

									<?php if ($exibir->devoExibirElementoUi('carousel', $inputExibir)) : ?>
										<div class="form-group">
											<label for="carousel" class="col-sm-2 control-label"><span class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Marque essa opção para desabilitar o Carrossel de imagens nos produtos" style="padding: 0px; margin-top: -5px"><i class="fa fa-question-circle"></i></span>Retirar Carrossel</label>

											<div class="col-sm-10">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="carousel" id="carousel" value="1"> Sim
													</label>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<div style="clear: both;"></div>

									<table id="table_imagem" class="table table-bordered table-striped table-hover" style="display: none">
										<thead>
											<tr>
												<th style="width: 80px">Imagem</th>
												<th>Título</th>
												<th style="width: 50px">Ordem</th>
												<th style="width: 50px">Status</th>
												<th style="width: 30px"></th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
									<div style="clear: both;"></div>
								</div>

								<div class="tab-pane <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "relacionados")) echo 'active' ?>" id="tab_5">

									<div class="alert" style="display: none" id="mensagem_relacionados">
										<p class="dado_msg"></p>
									</div>
									<div class="form-group">
										<label for="nome" class="col-sm-2 control-label">Buscar Produtos</label>

										<div class="col-sm-10">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Digite o nome do produto..." id="busca_produto_relacionado">
												<div class="input-group-addon" style="padding: 0">
													<a href="javascript:void(0);" id="busca_produto" class="btn btn-flat" style="height: 32px;" onclick="busca_produto_relacionado()"><i class="fa fa-search"></i></a>
												</div>
											</div>
											<small>Busque e adcione os produtos que estarão relacionados a esse!</small>
										</div>
									</div>
									<div style="clear: both;"></div>
									<hr>

									<div id="lista_produtos_relacionados"></div>

									<div style="clear: both;"></div>

									<div class="col-sm-12" id="produtos_relacionados" style="display: none">
										<h3>Produtos Relacionados</h3>
										<table id="table_relacionado" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th style="width: 30px" class="no-sort">Cod.</th>
													<th class="no-sort">Nome</th>
													<th style="width: 80px" class="no-sort">Ações</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>

									<div style="clear: both;"></div>

								</div>

								<div class="tab-pane <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "adicionais")) echo 'active' ?>" id="tab_6">

									<div class="col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="adicionais">Adicionais</label>
												<select class="form-control" id="adicionais_nome" style="width: 100%">
													<option id="attr0">Selecione...</option>
													<?php
													$dados = $bd->select(array('id', 'nome'), 'adicionais', array('status = 1', 'excluido = 0'), '', '', 1000);
													foreach ($dados as $key => $value) {
													?>
														<option value="<?php echo $value['nome'] ?>" attr-id="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
									</div>

									<div class="col-sm-2" style="padding-top: 25px;">
										<button type="button" class="btn btn-block btn-success" onclick="linhaAdicional();"><i class="fa fa-plus"></i> Adicionar</button>
									</div>

									<div style="clear: both;"></div>
									<hr>

									<div style="clear: both;"></div>

									<div class="col-sm-12" id="produtos_adicionais" style="display: none">
										<h3>Adicionais</h3>
										<table id="table_adicionais" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th style="width: 30px" class="no-sort">Cod.</th>
													<th class="no-sort">Nome</th>
													<th style="width: 80px" class="no-sort">Ordem</th>
													<th style="width: 80px" class="no-sort">Ações</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>

									<div style="clear: both;"></div>
								</div>

								<div class="tab-pane <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "opcoes")) echo 'active' ?>" id="tab_7">

									<div class="col-sm-3">
										<div class="form-group">
											<div class="col-sm-12">
												<label for="adicionais">Opções</label>
												<select class="form-control" id="itens_nome" style="width: 100%">
													<option id="attr0">Selecione...</option>
													<?php
													$dados = $bd->select(array('id', 'nome'), 'itens', array('status = 1', 'excluido = 0'), '', '', 1000);
													foreach ($dados as $key => $value) {
													?>
														<option value="<?php echo $value['nome'] ?>" attr-id="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
									</div>

									<div class="col-sm-2" style="padding-top: 25px;">
										<button type="button" class="btn btn-block btn-success" onclick="linhaItem();"><i class="fa fa-plus"></i> Adicionar</button>
									</div>

									<div style="clear: both;"></div>
									<hr>

									<div style="clear: both;"></div>

									<div class="col-sm-12" id="produtos_itens" style="display: none">
										<h3>Itens</h3>
										<table id="table_adicionais" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th style="width: 30px" class="no-sort">Cod.</th>
													<th class="no-sort">Nome</th>
													<th style="width: 120px" class="no-sort">Ordem</th>
													<th style="width: 80px" class="no-sort">Ações</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>

									<div style="clear: both;"></div>

								</div>

								<div class="tab-pane <?php if ((!empty($_GET['tela'])) && ($_GET['tela'] == "buscadores")) echo 'active' ?>" id="tab_8">

									<div class="form-group">
										<label for="meta_title" class="col-sm-2 control-label">Meta Título</label>

										<div class="col-sm-10">
											<input type="text" class="form-control" id="meta_title" placeholder="Meta Título" name="meta_title">
										</div>
									</div>
									<div class="form-group">
										<label for="meta_descricao" class="col-sm-2 control-label">Meta Descrição</label>

										<div class="col-sm-10">
											<textarea class="form-control" id="meta_descricao" placeholder="Meta Descrição" rows="3" name="meta_descricao"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="meta_keys" class="col-sm-2 control-label">Palavras Chaves</label>

										<div class="col-sm-10">
											<input type="text" class="form-control" id="meta_keys" placeholder="Palavras Chaves" name="meta_keys">
											<small>Informe as palavras para busca separadas por vírgula (,).</small>
										</div>
									</div>

									<div style="clear: both;"></div>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- nav-tabs-custom -->
					</div>

				</div>

			</section>
		</form>
	</div>

	<?php require("layout/rodape.php") ?>

	<script>
		var path_upload = '<?php echo PL_PATH_IMAGES_UPLOAD; ?>'
	</script>

	<!-- Select2 -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- CK Editor -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/ckeditor/ckeditor.js"></script>

	<script type="text/javascript" src="<?php echo PL_PATH_ADMIN ?>/public/js/maskMoney.js"></script>

	<!-- InputMask -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.extensions.js"></script>

	<script src="<?php echo PL_PATH_ADMIN ?>/public/js/funcoes_produtos.js"></script>

	<script type="text/javascript" src="<?php echo PL_PATH_ADMIN ?>/public/js/jquery.validate.min.js"></script>

	<script>
		$("#form").validate({
			rules: {
				nome: {
					required: true
				},
				sku: {
					required: true
				}
			}
		});

		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2();

			// CKEDITOR.replace('descricao_resumida');
			CKEDITOR.replace('descricao');
			// CKEDITOR.replace('especificacoes');
			// CKEDITOR.replace('garantia');

			$(".money").maskMoney({
				symbol: '',
				showSymbol: false,
				thousands: '.',
				decimal: ',',
				symbolStay: true
			});

			$(".value").maskMoney({
				symbol: '',
				showSymbol: false,
				thousands: '',
				decimal: '.',
				symbolStay: true,
				precision: 3,
			});

			$('[data-mask]').inputmask();
		})
	</script>

	<div class="modal fade" id="modal-imagens">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Inserir Imagem</h4>
				</div>
				<div class="modal-body">
					<table id="produtos_table" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th style="width: 30px" class="no-sort">#</th>
								<th style="width: 30px" class="no-sort">Imagem</th>
								<th class="no-sort">link</th>
								<th style="width: 100px" class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$path = PL_PATH . "/uploads/" . PASTA_UPLOAD . "/imagens_produtos/";
							$types = array('png', 'jpg', 'jpeg', 'gif');
							$dir = new DirectoryIterator($path);
							foreach ($dir as $key => $value) {
								$ext = strtolower($value->getExtension());

								if (in_array($ext, $types)) {
							?>
									<tr>
										<td><?php echo $key + 1; ?></td>
										<td>
											<img src="<?php echo PL_PATH_IMAGES_UPLOAD . 'imagens_produtos/' . $value; ?>" width="30px">
										</td>
										<td>
											<textarea class="copytext-<?php echo $key + 1 ?>" style="width: 100%;border: 0;"><?php echo PL_PATH_IMAGES_UPLOAD . 'imagens_produtos/' . $value; ?></textarea>
										</td>
										<td>
											<button class="copybtn-<?php echo $key + 1; ?> btn btn-primary pull-right" data-dismiss="modal">
												<i class="fa fa-files-o"></i> Copiar link
											</button>
										</td>
									</tr>
									<script type="text/javascript">
										//COPY LINK IMG
										var copyTextareaBtn = document.querySelector('.copybtn-<?php echo $key + 1; ?>');

										copyTextareaBtn.addEventListener('click', function(event) {
											var copyTextarea = document.querySelector('.copytext-<?php echo $key + 1; ?>');
											copyTextarea.select();

											try {
												var successful = document.execCommand('copy');
												var msg = successful ? 'successful' : 'unsuccessful';
												alert('copiado');
											} catch (err) {
												alert('erro');
											}
										});
									</script>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>

		</div>

	</div>
</div>