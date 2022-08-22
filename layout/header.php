<head>

    <?php
    $sqli   = $bd->conexao();
    $query  = "SELECT * FROM design WHERE id = 1";
    $result = $sqli->query($query);
    $result = $result->fetch_array();

    $img_logo = '';
    $img_ico  = PL_PATH_ADMIN .'/public/img/favicon.ico';

    if(!empty($result)){
        if(!empty($result['logo'])){
            $img_logo = PL_PATH_IMAGES_UPLOAD.'design/'.$result['logo'];
        }

        if(!empty($result['ico'])){
            $img_ico  = PL_PATH_IMAGES_UPLOAD.'design/'.$result['ico'];
        }
    }
    ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $img_ico ?>"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php
        if(isset($_GET['pagina'])){
            echo $_GET['pagina'] . ' | Admin '.NOME_LOJA;
        }else{
            echo "Admin ".NOME_LOJA;
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
    
    <!-- jQuery 3 -->
    <script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/jquery-ui/jquery-ui.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
      var base_url = '<?php echo PL_PATH_ADMIN; ?>';
      var img_ico  = '<?php echo $img_ico?>';
      var img_logo = '<?php echo $img_logo?>';
    </script>

    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo PL_PATH_ADMIN ?>/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Notification -->
    <!-- <link rel="stylesheet" href="<?php echo PL_PATH_ADMIN ?>/public/css/web-notification.css"> -->
    <script src="<?php echo PL_PATH_ADMIN ?>/public/js/web-notification.js"></script>
  
    <!-- Minhas Folhas de Estilo -->
    <link rel="stylesheet" href="<?php echo PL_PATH_ADMIN ?>/public/css/style.css">
    
    <!-- Load -->
    <script src="<?php echo PL_PATH_ADMIN ?>/public/js/load.js"></script>
    
    <script src="<?php echo PL_PATH_ADMIN ?>/public/js/funcoes.js"></script>

    <!-- Notificacao Novo Pedido -->
    <!-- <script src="<?php echo PL_PATH_ADMIN ?>/public/js/notificacao_pedido.js"></script> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">