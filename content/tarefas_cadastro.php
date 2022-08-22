<div class="wrapper">

    <?php 
    require("layout/topo.php");
    require("layout/menu.php");
	require_once(__DIR__ . "/class/funcoes/controle_exibir.php");
	use Model\ControleExibir as ControleExibir;

	$exibir = new ControleExibir();

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

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<form class="form-horizontal" action="<?php echo PL_PATH_CLASS.'/tarefas_cadastro.php'?>" method="post" id="form_cliente">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        <span class="pull-left" style="margin-right: 10px">Cadastro</span>
	      </h1>

	      <div class="pull-right">
		      <button type="button" class="btn btn-success btn-xs btn_submit_form" name="salvar" value="salva" onclick="submit_form('salva');"><i class="fa fa-floppy-o"></i> Salvar</button>
		      
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
	              <li i <?php if(empty($_GET['tela'])) echo 'class="active"'?>>
	              	<a href="#tab_1" data-toggle="tab">Dados </a>
	              </li>
	              
	            </ul>
	            <div style="clear: both;"></div>
	            <div class="tab-content">
	                <div class="tab-pane <?php if(empty($_GET['tela'])) echo 'active'?>" id="tab_1">

	                    <div class="form-group">
	                      <label for="nome" class="col-sm-2 control-label">Nome</label>

	                      <div class="col-sm-10">
	                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
	                      	<input type="hidden" name="url">
	                      </div>
	                    </div>
						<div class="form-group">
	                      <label for="nome" class="col-sm-2 control-label">Idade</label>

	                      <div class="col-sm-10">
	                        <input type="text" class="form-control" id="idade" placeholder="Idade" name="idade">
	                      	<input type="hidden" name="url">
	                      </div>
	                    </div>
						<div class="form-group">
		                      <label for="data_nascimento" class="col-sm-2 control-label">Data de Contratação</label>

		                      <div class="col-sm-10">
		                        <input type="text" class="form-control" id="data_contratacao" name="data_contratacao" placeholder="Data de contratação" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
		                      </div>
		                    </div>
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

	                    <div style="clear: both;"></div>

	                </div>
		            
	            
	            <!-- /.tab-pane -->
	            </div>
	            <!-- /.tab-content -->
	          </div>
	          <!-- nav-tabs-custom -->
	        </div>


	      </div>
	      <!-- /.row -->

	    </section>
	</form>
  </div>

    <?php require("layout/rodape.php") ?>

    <!-- Select2 -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- CK Editor -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/ckeditor/ckeditor.js"></script>

	<script type="text/javascript" src="<?php echo PL_PATH_ADMIN ?>/public/js/maskMoney.js"></script>

	<!-- InputMask -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	
	<script src="<?php echo PL_PATH_ADMIN ?>/public/validate/jquery.validate.js"></script>

	<script src="<?php echo PL_PATH_ADMIN ?>/public/js/funcoes_produtos.js"></script>
	
	<script src="<?php echo PL_PATH_ADMIN ?>/public/js/funcoes_clientes.js?v=2"></script>


    <script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2();

		//Datemask dd/mm/yyyy
    	// $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    	$('[data-mask]').inputmask()
	})
	</script>

	

</div>
<!-- ./wrapper -->