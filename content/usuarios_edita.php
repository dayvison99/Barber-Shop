<?php 
require("layout/topo.php");
require("layout/menu.php");

$dados_url = explode('/', $_GET['get']);

$sqli = $bd->conexao();
$query ="SELECT * FROM usuarios WHERE (id = '".$dados_url[1]."') AND (excluido = 0)";
$result = $sqli->query($query);

if($result->num_rows == 0){
	//header("location: ".PL_PATH_ADMIN.'/produtos');
}
$result = $result->fetch_array();

?>
<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<form class="form-horizontal" action="<?php echo PL_PATH_CLASS.'/usuarios_edita.php'?>" method="post" id="form_usuario">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			<span class="pull-left" style="margin-right: 10px"><small>Usuários - Editar</small> <?php if(!empty($result['nome'])) echo $result['nome']; ?></span>
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

				<div class="box box-primary">

					<div class="box-body">

						<input type="hidden" name="id" value="<?php echo !empty($result['id']) ? $result['id'] : '';?>">
			 
						<div class="form-group">
							<label for="nome" class="col-sm-2 control-label">Nome</label>

							<div class="col-sm-10">
								<input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="<?php echo !empty($result['nome']) ? $result['nome'] : '';?>">
							</div>
						</div>
			 
						<div class="form-group">
							<label for="usuario" class="col-sm-2 control-label">E-mail</label>

							<div class="col-sm-10">
								<input type="text" class="form-control" id="usuario" placeholder="E-mail" name="usuario" value="<?php echo !empty($result['usuario']) ? $result['usuario'] : '';?>" disabled=''>
							</div>
						</div>
			 			
						<div class="form-group">
							<label for="nome" class="col-sm-2 control-label">Tipo de usuário</label>

							<div class="col-sm-10">
								<select id="tipo_usuario" class="form-control" name="tipo_usuario">
									<option value="" <?php echo ($result['tipo_usuario'] == '') ? 'selected=""' : '';?> disabled="">Selecione...</option>
									<option value="1" <?php echo ($result['tipo_usuario'] == 1) ? 'selected=""' : '';?>>Administrador</option>
									<!-- <option value="2"<?php echo ($result['tipo_usuario'] == 2) ? 'selected=""' : '';?>>Financeiro</option> -->
									<option value="3"<?php echo ($result['tipo_usuario'] == 3) ? 'selected=""' : '';?>>Vendas</option>
									<!-- <option value="4"<?php echo ($result['tipo_usuario'] == 4) ? 'selected=""' : '';?>>Estoque</option> -->
								</select>
							</div>
						</div>
						
			 
						<div class="form-group">
							<label for="senha" class="col-sm-2 control-label">Senha</label>

							<div class="col-sm-10">
								<input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
							</div>
						</div>
			 
						<div class="form-group">
							<label for="rep_senha" class="col-sm-2 control-label">Repetir Senha</label>

							<div class="col-sm-10">
								<input type="password" class="form-control" id="rep_senha" placeholder="Repetir Senha" name="rep_senha">
							</div>
						</div>

						<div style="clear: both;"></div>
					</div>
				</div>
	
		  </div>
		  <!-- /.row -->

		</section>
	</form>
  </div>

	<?php require("layout/rodape.php") ?>

	<script src="<?php echo PL_PATH_ADMIN ?>/public/validate/jquery.validate.js"></script>

	<script src="<?php echo PL_PATH_ADMIN ?>/public/js/funcoes_usuarios.js"></script>

</div>
<!-- ./wrapper -->