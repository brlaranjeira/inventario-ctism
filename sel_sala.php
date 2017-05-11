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
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
<?
include 'header.php';
?>
<form id="form-sala" method="post" action="">
    <div class="row">
        <div class="form-group col-md-6 col-xs-12">
            <label for="predio">Prédio</label>
            <select class="form-control" name="predio" id="predio">
                <option>SELECIONAR</option>
                <?
                require_once ("Predio.php");
                $predios = Predio::getAll();
                foreach ($predios as $predio) {
                    ?><option value ="<?=$predio->getId()?>"><?=$predio->getNome()?> [<?=$predio->getDescricao()?>]</option><?
                }
                ?>
            </select>
        </div>
    </div>
</form>
<? include 'footer.php'; ?>
</body>
</html>