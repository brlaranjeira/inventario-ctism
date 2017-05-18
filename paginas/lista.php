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

$todos = Equipamento::getAll();


?>







<? include __DIR__ . '/fragments/footer.php'; ?>
</body>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery-2.2.1.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery-ui.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery.mask.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/bootstrap/bootstrap.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/inventario.js"></script>
<script type="application/javascript" language="javascript" src="../js/lista.js"></script>
</html>
