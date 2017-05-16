<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 3:16 PM
 */
require_once ('lib/Usuario.php');
require_once ('lib/Paginas.php');
require_once ('Predio.php');
require_once ('Sala.php');
require_once ('Container.php');
Paginas::forcaSeguranca();

?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="css/inventario.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sel_sala.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
<?
include 'header.php';

session_start();
if (!isset($_SESSION['ctism_inventario_sala'])) {
    header('Location: sel_sala.php');
    die();
}
if (!isset($_SESSION['ctism_inventario_responsavel'])) {
    header('Location: sel_resp.php');
    die();
}

$sala = Sala::getById($_SESSION['ctism_inventario_sala']);
$predio = $sala->getPredio();
$container = isset($_SESSION['ctism_inventario_container']) ? Container::getById($_SESSION['ctism_inventario_container']) : null;
$resp = new Usuario($_SESSION['ctism_inventario_responsavel']);

?>
<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <div class="form-group">
            <label>Prédio/Sala/Contêiner</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="false"></i></span>
                <span  class="form-control"  >
                    <?
                    echo 'Prédio ' . $predio->getNome() . ', sala ' . $sala->getNro();
                    if (isset($container)) {
                        echo ', container ' . $container->getCod();
                    }
                    ?>
                </span>
                <a href="sel_sala.php" class="input-group-addon"><i class="fa fa-exchange"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <div class="form-group">
            <label>Responsável</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="false"></i></span>
                <span  class="form-control">
                    <?=$resp->getFullName()?>
                </span>
                <a href="sel_resp.php" class="input-group-addon"><i class="fa fa-exchange"></i></a>
            </div>
        </div>
    </div>
</div>

<form id="form-cadastro-equipamento" method="post" action="novoequipamento.php">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <div class="form-group">
                <label for="tipoeqpt">Tipo de equipamento</label>
                <div class="input-group">
                    <input id="tipoeqpt" name="tipoeqpt" type="text" class="form-control">
                    <input id="idtipoeqpt" type="hidden" name="idtipoeqpt"/>
                    <span id="span-add-tipoeqpt" class="span-add input-group-addon" data-toggle="modal" data-target="#modal-add-tipoeqpt"><i class="fa fa-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            PATRIMONIO
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            NUM SERIE
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            DESCRICAO
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            OBS
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            FOTO
        </div>
    </div>
    -->
</form>


<div id="modal-add-tipoeqpt" class="modal-add modal fade" role="dialog">
    <form id="form-novo-tipoeqpt" enctype="multipart/form-data" method="post" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Novo tipo de equipamento</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="container-nro">Nome</label>
                                <input type="text" name="tipoeqpt-nome" id="tipoeqpt-nome" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="container-descricao">Descrição</label>
                                <input type="text" name="tipoeqpt-descricao" id="tipoeqpt-descricao" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="container-nro">Imagem</label>
                                <input type="file" capture="camera" accept="image/*" name="tipoeqpt-img" id="tipoeqpt-img" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button id="btn-novo-tipoeqpt" type="submit" class="btn btn-info">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<? include 'footer.php'; ?>
</body>
<script type="application/javascript" language="javascript" src="js/jquery/jquery-2.2.1.min.js"></script>
<script type="application/javascript" language="javascript" src="js/jquery/jquery-ui.min.js"></script>
<script type="application/javascript" language="javascript" src="js/jquery/jquery.mask.min.js"></script>
<script type="application/javascript" language="javascript" src="js/bootstrap/bootstrap.min.js"></script>
<script type="application/javascript" language="javascript" src="js/inventario.js"></script>
<script type="application/javascript" language="javascript" src="js/cadastrar.js"></script>
</html>