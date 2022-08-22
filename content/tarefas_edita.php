<?php
require("layout/topo.php");
require("layout/menu.php");

$dados_url = explode('/', $_GET['get']);

$sqli = $bd->conexao();
$query ="SELECT * FROM tarefas WHERE (id_tarefa = '".$dados_url[1]."') AND (excluido = 0)";
$result = $sqli->query($query);

if($result->num_rows == 0){
	//header("location: ".PL_PATH_ADMIN.'/produtos');
}

$result = $result->fetch_array();

$id = $result['id_tarefa'];
?>
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<form class="form-horizontal" action="<?php echo PL_PATH_CLASS.'/tarefas_edita.php'?>" method="post" id="form_cliente">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        <span class="pull-left" style="margin-right: 10px"><small>Clientes - Editar</small> <?php if(!empty($result['nome'])) echo $result['nome']; ?></span>
	      </h1>

	      <div class="pull-right">
		      <button type="submit" class="btn btn-success btn-xs btn_submit_form" name="salvar" value="salva"><i class="fa fa-floppy-o"></i> Salvar</button>
		      
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
	              <li class="active"><a href="#tab_1" data-toggle="tab">Dados</a></li>
	            </ul>
	            <div style="clear: both;"></div>
	            <div class="tab-content">
	                <div class="tab-pane active" id="tab_1">

	                	<input type="hidden" name="id_tarefa" value="<?php echo $id; ?>">

	                    <div class="form-group">
	                      <label for="nome" class="col-sm-2 control-label">Nome</label>

	                      <div class="col-sm-10">
	                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="<?php echo !empty($result['nome']) ? $result['nome'] : ''?>">
	                        
	                        <input type="hidden" name="url" value="<?php echo !empty($result['url']) ? $result['url'] : ''?>">
	                      </div>
	                    </div>

	                  
	                    <div class="form-group">
	                      <label for="descricao" class="col-sm-2 control-label">Descrição</label>

	                      <div class="col-sm-10">
	                        <textarea class="form-control" rows="3" id="descricao" placeholder="Descrição" name="descricao"><?php echo !empty($result['descricao']) ? $result['descricao'] : ''?></textarea>
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
	      <!-- /.row -->

	    </section>
	</form>
  </div>

    <?php require("layout/rodape.php") ?>

    <!-- Select2 -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- InputMask -->
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo PL_PATH_ADMIN ?>/public/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	
	<script src="<?php echo PL_PATH_ADMIN ?>/public/validate/jquery.validate.js"></script>
	
	<script src="<?php echo PL_PATH_ADMIN ?>/public/js/funcoes_clientes.js"></script>

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