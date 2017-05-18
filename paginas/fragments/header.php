<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 2:39 PM
 */

require_once(__DIR__ . '/../../lib/Usuario.php');

$usuario = Usuario::restoreFromSession();

?>
<div class="page-header">
    <h4>Olá, <?=$usuario->getFullName()?><small>&nbsp;(<a href="../../logout.php">sair</a>)</small></h4>
    <h5><a href="../../main.php">Página Inicial</a></h5>
</div>
<div id="div-alert" class="alert">
    <strong id="div-alert-title"></strong>
    <span id="div-alert-span"></span>
</div>