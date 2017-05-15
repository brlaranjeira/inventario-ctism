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
}
if (!isset($_SESSION['ctism_inventario_responsavel'])) {
    header('Location: sel_resp.php');
}

$sala = Sala::getById($_SESSION['ctism_inventario_sala']);
$predio = $sala->getPredio();
$container = isset($_SESSION['ctism_inventario_container']) ? Container::getById($_SESSION['ctism_inventario_container']) : null;
$resp = new Usuario($_SESSION['ctism_inventario_responsavel']);

?>
<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <div class="form-group">
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
                <div class="input-group">
                    <input id="tipoeqpt" name="tipoeqpt" type="text" class="form-control">
                    <input id="idtipoeqpt" type="hidden" name="idtipoeqpt"/>
                    <span id="span-novo-tipo" class="input-group-addon"><i class="fa fa-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
</form>

<? include 'footer.php'; ?>
</body>
<script type="application/javascript" language="javascript" src="js/jquery/jquery-2.2.1.min.js"></script>
<script type="application/javascript" language="javascript" src="js/jquery/jquery-ui.min.js"></script>
<script type="application/javascript" language="javascript" src="js/jquery/jquery.mask.min.js"></script>
<script type="application/javascript" language="javascript" src="js/bootstrap/bootstrap.min.js"></script>
<script type="application/javascript" language="javascript" src="js/inventario.js"></script>
<script type="application/javascript" language="javascript" src="js/cadastrar.js"></script>
</html>