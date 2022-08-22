<div class="wrapper">

    <?php 
    require("layout/topo.php");
    require("layout/menu.php");

    $pag = '';
    if(isset($_GET['pag'])){
        $pag = $_GET['pag'];
    }

    if(isset($_GET['busca']) && isset($_GET['nome'])){
        $busca = array("nome LIKE '%".$_GET['nome']."%'", "excluido = 0");
    }else{
        $busca = array('excluido = 0'); 
    }

    $campos = array('busca','nome');

    $return_page = '';
    foreach ($campos as $dado) {
        if(!empty($_GET[$dado]))
            $return_page .= "&$dado=".$_GET[$dado];
    }

    $dados = $pagination->createLinks(array('id', 'nome','descricao','data_cadastro', 'ultima_atualizacao', 'status'), 'tarefas', $busca, array('id'), array('DESC'), 20, 0, $pag, $return_page);

    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <span class="pull-left" style="margin-right: 10px">Funcionarios</span>
            </h1>
            <div class="pull-right">
                <a href="<?php echo PL_PATH_ADMIN; ?>/tarefas_cadastro" class="btn btn-success ">
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

                        <div class="alert" style="display: none" id="mensagem_retorno">
                            <p class="dado_msg"></p>
                        </div>

                            <form action="javascript:void(0)" onsubmit="document.location = '<? echo PL_PATH_ADMIN; ?>/tarefas&busca='+$('#busca').val()+'&nome='+$('#nome').val(); return false;" method="get" enctype="multipart/form-data">

                                <h4 class="col-xs-12" style="margin-top: 0">Buscar Tarefas</h4>
                                <div class="form-group col-xs-8">
                                    <div class="col-xs-6" style="padding-left: 0">
                                        <div class="input-group" style="width: 100%">
                                            <input type="hidden" name="busca" value="cliente" id="busca">
                                            <input type="text" class="form-control" placeholder="Nome do tarefa" name="nome" value="<?php echo isset($_GET['nome']) ? $_GET['nome'] : NULL;?>" id="nome">
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>

                                <div class="pull-right">
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

                                <div style="clear: both;"></div>
                            </form>

                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30px" class="no-sort">Cod.</th>
                                        <th style="width: 100px" class="no-sort">Nome</th>
                                        <th style="width: 300px" class="no-sort">Idade</th>
                                        <th style="width: 100px" class="no-sort">Dt. Cadastro</th>
                                        <th style="width: 30px" class="no-sort">Status</th>
                                        <th style="width: 30px" class="no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if(!empty($dados['dados'])){
                                    foreach ($dados['dados'] as $key => $value) {
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
                                        <td>
                                            <a href="<?php echo PL_PATH_ADMIN.'/tarefas_edita/'.$value['id']?>">
                                                <?php
                                                echo $value['nome'];
                                                ?>
                                            </a>
                                        </td>
                                        <td><?php echo $value['descricao']?></td>
                                        <td><?php echo convert_data($value['data_cadastro'])?></td>
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
                                                    <li><a href="<?php echo PL_PATH_ADMIN.'/tarefas_edita/'.$value['id']?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    
                                                    <li class="li_status">
                                                        <a href="javascript:void(0);" class="<?php echo $href_class; ?> link_status" onclick="status('tarefas',<?php echo $value['id'];?>);"><i class="fa fa-check-circle-o"></i> <?php echo $href_text; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="text-red" onclick="deleta('tarefas',<?php echo $value['id'];?>);"><i class="fa fa-times"></i> Excluir</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix no-border">
                            <div class="pull-right">
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