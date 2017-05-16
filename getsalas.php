<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 5:20 PM
 */

require_once ('lib/Usuario.php');
require_once ('lib/Paginas.php');
require_once("dao/Predio.php");
Paginas::forcaSeguranca();
$idPredio = $_REQUEST['idpredio'];
$predio = Predio::getById($idPredio);
$salas = $predio->getSalas();
$ret = '[';
for ($i = 0; $i < sizeof($salas); $i++) {
    $ret .= $i != 0 ? ',' : '';
    $ret .= $salas[$i]->asJSON();
}
$ret .= ']';
echo $ret;