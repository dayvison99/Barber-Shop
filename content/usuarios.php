<div class="wrapper">

	<?php 
	require("layout/topo.php");
	require("layout/menu.php");
	
	$dados = $bd->select(array('id', 'nome','tipo_usuario', 'usuario', 'status'), 'usuarios' ,array('excluido = 0'), array('id'), 'DESC');
	?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			<span class="pull-left" style="margin-right: 10px">Usuários</span>
			</h1>
			<div class="pull-right">
				<a href="<?php echo PL_PATH_ADMIN; ?>/usuarios_cadastro" class="btn btn-success ">
					<div class="icon">
						<i class="fa fa-plus"></i> Cadastrar
					</div>
				</a>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12" style="margin-top: 10px;">

					<?php if(isset($_GET['msg'])){?>
						<div class="alert alert-<?php echo $_GET['status']?> alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<p><i class="icon fa fa-check"></i> <?php echo $_GET['msg'];?></p>
						</div>
					<?php } ?>

					<div class="box box-default">
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th style="width: 30px" class="no-sort">Cod.</th>
										<th class="no-sort">Nome</th>
										<th class="no-sort">Usuário</th>
										<th style="width: 120px" class="no-sort">Tipo</th>
										<th style="width: 30px" class="no-sort">Status</th>
										<th style="width: 30px" class="no-sort"></th>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($dados as $key => $value) {
										if($value['status'] == 1){
											$small_class = "label-success";
											$small_text  = "Ativo";
											$href_class  = "text-yellow";
											$href_text   = "Desativar";
										}else{
											$small_class = "label-warning";
											$small_text  = "Inativo";
											$href_class  = "text-green";
											$href_text   = "Ativar";
										}
									?>
									<tr id="dado_lista<?php echo $value['id'];?>">
										<td><?php echo $value['id']?></td>
										<td><a href="<?php echo PL_PATH_ADMIN .'/usuarios_edita/'. $value['id'];?>"><?php echo $value['nome']?></a></td>
										<td><?php echo $value['usuario']?></td>
										<td>
											<?php
											if($value['tipo_usuario'] == 1){
												echo "Administrador";
											}else if($value['tipo_usuario'] == 2){
												echo "Financeiro";
											}else if($value['tipo_usuario'] == 3){
												echo "Vendas";
											}else if($value['tipo_usuario'] == 4){
												echo "Estoque";
											}
											?>
										</td>
										<td  class="label_status">
											<small class="label <?php echo $small_class;?>"><?php echo $small_text;?></small>
											<span id="value_status" style="display: none;"><?php echo $value['status']?></span>
										</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
													Ações <i class="fa fa-caret-down"></i>
												</button>
												<ul class="dropdown-menu">
													<li><a href="<?php echo PL_PATH_ADMIN .'/usuarios_edita/'. $value['id'];?>"><i class="fa fa-pencil"></i> Editar</a></li>
													<li class="li_status">
														<a href="javascript:void(0);" class="<?php echo $href_class; ?> link_status" onclick="status('usuarios',<?php echo $value['id'];?>);"><i class="fa fa-check-circle-o"></i> <?php echo $href_text; ?></a>
													</li>
													<li>
														<a href="javascript:void(0);" class="text-red" onclick="deleta('usuarios',<?php echo $value['id'];?>);"><i class="fa fa-times"></i> Excluir</a>
													</li>
												</ul>
											</div>
										</td>
									</tr>
									<?php 
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

				</div>
				<!-- ./col -->

			</div>
			<!-- /.row -->

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<?php require("layout/rodape.php") ?>

</div>
<!-- ./wrapper -->