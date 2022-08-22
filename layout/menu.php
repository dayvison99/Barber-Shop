

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">Menu</li>

			<li class="treeview <?php if (($dados[0] == 'produtos') || ($dados[0] == 'produtos_cadastro') || ($dados[0] == 'produtos_edita') || ($dados[0] == 'categorias') || ($dados[0] == 'categorias_cadastro') || ($dados[0] == 'categorias_edita') || ($dados[0] == 'adicionais') || ($dados[0] == 'adicionais_cadastro') || ($dados[0] == 'adicionais_edita') || ($dados[0] == 'produtos_pacote') || ($dados[0] == 'produtos_pacote_cadastro') || ($dados[0] == 'produtos_pacote_edita') || ($dados[0] == 'produtos_cadastro_imagens') || ($dados[0] == 'itens') || ($dados[0] == 'itens_cadastro') || ($dados[0] == 'itens_edita')) echo 'active'; ?>">

					<a href="javascript:void(0)">
						<i class="fa fa-file-text-o"></i> <span>Funcionários</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
				<ul class="treeview-menu">
					<li class="<?php if (($dados[0] == 'tarefas') || ($dados[0] == 'tarefas_cadastro') || ($dados[0] == 'tarefas_edita') || ($dados[0] == 'clientes_detalhes')) echo 'active'; ?>">
						<a href="<?php echo PL_PATH_ADMIN; ?>/tarefas">
							<i class="fa fa-users"></i> <span>Cadastro</span>
						</a>
					</li>
				</ul>
			</li>
			


			
				<li class="<?php if ($dados[0] == 'usuarios') echo 'active'; ?>">
					<a href="<?php echo PL_PATH_ADMIN; ?>/usuarios">
						<i class="fa fa-user-o"></i> <span>Usuários</span>
					</a>
				</li>
			

		</ul>
	</section>
	<!-- /.sidebar -->
</aside>