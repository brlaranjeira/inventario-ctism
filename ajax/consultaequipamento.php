<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/19/17
 * Time: 1:14 PM
 */

require_once (__DIR__.'/../dao/Equipamento.php');
$equipamento = Equipamento::getByParam('patrimonio',$_REQUEST['patrimonio']);
if (isset($equipamento)) {
    echo $equipamento->asJSON();
}