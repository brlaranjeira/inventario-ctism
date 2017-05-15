<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 2:39 PM
 */

require_once ("lib/Usuario.php");

$usuario = Usuario::restoreFromSession();

?>
<div class="row" id="div-header">
    <div class="col-xs-12">Olá, <?=$usuario->getFullName()?> <a href="logout.php">(sair)</a></div>
    <div class="col-xs-12"><a href="main.php">Página Inicial</a></div>
</div>
<div id="div-alert" class="alert">
    <strong id="div-alert-title"></strong>
    <span id="div-alert-span"></span>
</div>