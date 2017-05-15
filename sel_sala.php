<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 3:16 PM
 */

require_once ('lib/Usuario.php');
require_once ('lib/Paginas.php');
Paginas::forcaSeguranca();
?>
<?

if (sizeof($_POST) > 0) {
    session_start();
    $_SESSION['ctism_inventario_sala'] = $_POST['sala'];
    if (isset($_POST['container'])) {
        $_SESSION['ctism_inventario_container'] = $_POST['container'];
    }
    header('Location: cadastrar.php');
}

?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/inventario.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sel_sala.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
<?
include 'header.php';
?>
<div id="div-alert" class="alert">
    <strong id="div-alert-title">Success!</strong>
    <span id="div-alert-span">This alert box could indicate a successful or positive action.</span>
</div>
<form id="form-sala" method="post" action="">
    <div class="row">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <div class="form-group">
                <label for="predio">Prédio</label>
                <div class="input-group">
                    <select class="form-control" name="predio" id="predio">
                        <option value="">SELECIONAR</option>
                        <?
                        require_once ("Predio.php");
                        $predios = Predio::getAll();
                        foreach ($predios as $predio) {
                            ?><option value ="<?=$predio->getId()?>"><?=$predio->getNome()?> [<?=$predio->getDescricao()?>]</option><?
                        }
                        ?>
                    </select>
                    <span id="span-add-predio" class="span-add input-group-addon" data-toggle="modal" data-target="#modal-add-predio" ><i class="glyphicon glyphicon-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row hidden" id="row-salas">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <div class="form-group">
                <label for="sala">Sala</label>
                <div class="input-group">
                    <select class="form-control" name="sala" id="sala"></select>
                    <span id="span-add-sala" class="span-add input-group-addon" data-toggle="modal" data-target="#modal-add-sala"><i class="glyphicon glyphicon-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row hidden" id="row-containers">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <div class="form-group">
                <label for="container">Container</label>
                <div class="input-group">
                    <select class="form-control" name="container" id="container"></select>
                    <span id="span-add-container" class="span-add input-group-addon" data-toggle="modal" data-target="#modal-add-container"><i class="glyphicon glyphicon-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row hidden" id="row-submit">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <button type="submit" class="btn btn-success btn-block">Selecionar</button>
        </div>
    </div>
</form>


<div id="modal-add-predio" class="modal-add modal fade" role="dialog">
    <form id="form-novo-predio">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Novo Prédio</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="predio-nome">Nome</label>
                                <input type="text" name="predio-nome" id="predio-nome" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="predio-descricao">Descrição</label>
                                <input type="text" name="predio-descricao" id="predio-descricao" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button id="btn-novo-predio" type="button" class="btn btn-info">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div id="modal-add-sala" class="modal-add modal fade" role="dialog">
    <form id="form-nova-sala">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nova Sala</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="sala-nro">Número/Código</label>
                                <input type="text" name="sala-nro" id="sala-nro" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="sala-descricao">Descrição</label>
                                <input type="text" name="sala-descricao" id="sala-descricao" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button id="btn-nova-sala" type="button" class="btn btn-info">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="modal-add-container" class="modal-add modal fade" role="dialog">
    <form id="form-novo-container">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Novo Container</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="container-nro">Número/Código</label>
                                <input type="text" name="container-nro" id="container-nro" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="container-descricao">Descrição</label>
                                <input type="text" name="container-descricao" id="container-descricao" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button id="btn-novo-container" type="button" class="btn btn-info">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</div>


<? include 'footer.php'; ?>
</body>
<script type="application/javascript" language="javascript" src="js/jquery/jquery-2.2.1.min.js"></script>
<script type="application/javascript" language="javascript" src="js/jquery/jquery.mask.min.js"></script>
<script type="application/javascript" language="javascript" src="js/bootstrap/bootstrap.min.js"></script>
<script type="application/javascript" language="javascript" src="js/inventario.js"></script>
<script type="application/javascript" language="javascript" src="js/sel_sala.js"></script>
</html>