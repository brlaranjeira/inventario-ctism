<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/18/17
 * Time: 5:48 PM
 */


require_once(__DIR__.'/../lib/Usuario.php');
require_once(__DIR__.'/../lib/Paginas.php');
require_once(__DIR__.'/../dao/Predio.php');
require_once(__DIR__.'/../dao/Sala.php');
require_once(__DIR__.'/../dao/Container.php');
require_once(__DIR__.'/../dao/Equipamento.php');
Paginas::forcaSeguranca();
?>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../css/jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="../css/inventario.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/lista.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
<?
include __DIR__ . '/fragments/header.php';

$equipamentos = Equipamento::getAll();
if (sizeof($equipamentos) <= 0) {
    echo 'Nenhum equipamento cadastrado';
    die();
}
?>
<table class="table table-striped table-hover">
    <thead><tr>
        <th>Patrimônio</th>
        <th>Responsável</th>
        <th>Tipo de Equipamento</th>
        <th>Prédio/Sala/Contêiner</th>
        <th>Descrição</th>
        <th>Estado</th>
    </tr></thead>
    <tbody>
    <?
    foreach ($equipamentos as $equipamento) {
        ?> <tr>
            <td><?=$equipamento->getPatrimonio()?></td>
            <td><?=$equipamento->getResponsavel()->getFullName()?></td>
            <td><?=$equipamento->getTipo()->getDescricao()?></td>
            <td><?
                echo 'Prédio ' . $equipamento->getSala()->getPredio()->getNome();
                echo ', Sala' . $equipamento->getSala()->getNro();
                $con = $equipamento->getContainer();
                if ($equipamento->getContainer() !== null ) {
                    echo ', Contêiner ' . $equipamento->getContainer()->getCod();
                }
            ?></td>
            <td><?=$equipamento->getDescricao()?></td>
            <td><?=$equipamento->getEstado()->getDescricao()?></td>
        </tr> <?
    }
    ?>
    </tbody>







<? include __DIR__ . '/fragments/footer.php'; ?>
</body>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery-2.2.1.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery-ui.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery.mask.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/bootstrap/bootstrap.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/inventario.js"></script>
<script type="application/javascript" language="javascript" src="../js/lista.js"></script>
</html>
