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
    echo 'lalala';
}

?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sel_sala.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
<?
include 'header.php';
?>
<form id="form-sala" method="post" action="">
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10">
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
        <div class="col-xs-offset-1 col-xs-10 ">
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
        <div class="col-xs-offset-1 col-xs-10">
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
        <div class="col-xs-offset-1 col-xs-10">
            <button type="submit" class="btn btn-success btn-block">Selecionar Sala/Container</button>
        </div>
    </div>
</form>


<div id="modal-add-predio" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Novo Prédio</h4>
            </div>
            <div class="modal-body">
                Novo prédio
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-add-sala" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nova Sala</h4>
            </div>
            <div class="modal-body">
                Nova sala
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-add-container" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Novo Container</h4>
            </div>
            <div class="modal-body">
                Novo container
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<? include 'footer.php'; ?>
</body>
<script type="application/javascript" language="javascript" src="js/jquery/jquery-2.2.1.min.js"></script>
<script type="application/javascript" language="javascript" src="js/jquery/jquery.mask.min.js"></script>
<script type="application/javascript" language="javascript" src="js/bootstrap/bootstrap.min.js"></script>
<script type="application/javascript" language="javascript" src="js/sel_sala.js"></script>
</html>