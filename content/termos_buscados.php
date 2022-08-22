<div class="wrapper">

    <?php 
    require("layout/topo.php");
    require("layout/menu.php");

    $pag = '';
    if(isset($_GET['pag'])){
        $pag = $_GET['pag'];
    }

    $dados = $pagination->createLinks(array('id', 'termo', 'quantidade'), 'termos_buscados','', array('quantidade'), 'DESC', 20, 0, $pag,'' );
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            	<span class="pull-left" style="margin-right: 10px">Termos Buscados</span>
            </h1>
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
                                        <th style="width: 30px" class="no-sort">Ordem</th>
                                        <th class="no-sort">Termo</th>
                                        <th style="width: 130px" class="no-sort">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($dados['dados'] as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $value['termo'];?></td>
                                        <td><?php echo $value['quantidade'];?></td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix no-border">
                            <?php
                            if(!empty($dados['paginas'])){
                            ?>
                                <ul class="pagination pagination-sm inline">
                                    <?php echo $dados['paginas'];?>
                                </ul>
                            <?php
                            }
                            ?>
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