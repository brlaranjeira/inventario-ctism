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
include 'header.php';

session_start();
if (!isset($_SESSION['ctism_inventario_sala'])) {
    header('Location: sel_sala.php');
}
if (!isset($_SESSION['ctism_inventario_responsavel'])) {
    header('Location: sel_resp.php');
}

$sala = Sala::getById($_SESSION['ctism_inventario_sala']);
$container = isset($_SESSION['ctism_inventario_container']) ? Container::getById($_SESSION['ctism_inventario_container']) : null;
$resp = new Usuario($_SESSION['ctism_inventario_responsavel']);

?>
<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <strong>Cadastrando em:</strong>
    </div>
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <?
        echo 'Prédio ' . $sala->getPredio()->getNome() . ', Sala ' . $sala->getNro();
        if (isset($container)) {
            echo ', Container ' . $container->getCod();
        }
        ?>
        (<a href="sel_sala.php">Trocar</a>)
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <strong>Responsável selecionado:</strong>
    </div>
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <?=$resp->getFullName()?> (<a href="sel_resp.php">Trocar</a>)
    </div>
</div>