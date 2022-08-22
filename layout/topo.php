<?php
require_once(__DIR__ . "/../content/class/funcoes/controle_exibir.php");

use Model\ControleExibir as ControleExibir;

$exibir = new ControleExibir();
$itensUserCardapioHeader = [
    'abrir-loja' => false,
    'ir-para-loja' => false,
];

$linksExibir = $exibir->defineElementosUi($itensUserCardapioHeader);
?>

<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo PL_PATH_ADMIN; ?>/tarefas" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <?php
            $nome_loja = explode(' ', NOME_LOJA);
            echo '<b>' . substr($nome_loja[0], 0, 1) . '</b>';
            if (!empty($nome_loja[1]))
                echo  substr($nome_loja[1], 0, 1);
            ?>
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <?php
            echo '<b>' . $nome_loja[0] . '</b> ';
            if (!empty($nome_loja[1]))
                echo $nome_loja[1];
            ?>
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Menu</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo PL_PATH_ADMIN; ?>/public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php if (!empty($_SESSION['PL_USER'])) {
                                                    echo $_SESSION['PL_USER']['nome'];
                                                } ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo PL_PATH_ADMIN; ?>/public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>

                                <?php
                                if (!empty($_SESSION['PL_USER'])) {
                                    echo $_SESSION['PL_USER']['nome'] . ' - ';

                                    if ($_SESSION['PL_USER']['tipo'] == 1) {
                                        echo "Administrador";
                                    } 
                                }

                                ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo PL_PATH_CLASS . '/logout.php' ?>" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<style type="text/css">
    .pull-middle {
        float: none;
        display: inline-block;
        margin-left: 21px;
    }
</style>