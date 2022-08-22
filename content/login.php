<?php 
require("layout/login/header.php") ?>
<body class="hold-transition login-page">
	
	<div class="login-box">
		<div class="login-logo">
			<a href="<?php echo PL_PATH_ADMIN; ?>">
				<?php 
	            $nome_loja = explode(' ', NOME_LOJA);
	            echo '<b>'.$nome_loja[0].'</b> ';
	            if(!empty($nome_loja[1]))
	                echo $nome_loja[1];
	            ?>
			</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Faça o login para entrar no painel</p>

			<?php
			if (!empty($_GET['status'])) {
			?>
				<div class="alert alert-<?php echo $_GET['status']?>" id="msg_retorno">
					<p class="dado_msg"><?php echo $_GET['msg'] ?></p>
				</div>
			<?php } ?>

			<form action="<?php echo PL_PATH_CLASS.'/login.php'?>" method="post">
				<div class="form-group has-feedback">
					<input type="email" class="form-control" placeholder="Login" name="login" id="login" value="<?php echo !empty($_GET['log']) ? $_GET['log'] : '';?>">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Senha" name="senha" id="senha">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<!-- /.col -->
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<hr>

			

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script src="<?php echo PL_PATH_ADMIN?>/public/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo PL_PATH_ADMIN?>/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		<?php if (empty($_GET['log'])){ ?>
			window.onload = function(){ document.getElementById('login').focus();}
		<?php }else{?>
			window.onload = function(){ document.getElementById('senha').focus();}
		<?php }?>

	</script>

</body>

<?php require("layout/login/footer.php");?>