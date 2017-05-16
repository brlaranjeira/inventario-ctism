<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/15/17
 * Time: 4:00 PM
 */

require_once ('lib/Usuario.php');
require_once ('lib/Paginas.php');
require_once("dao/TipoEquipamento.php");
Paginas::forcaSeguranca();

$tipos = TipoEquipamento::getAll();
$ret = '[';
for ($i=0; $i<sizeof($tipos);$i++) {
    $ret .= $i == 0 ? '' : ',';
    $elm = [];
    $elm ['label'] = $tipos[$i]->getNome();
    $elm ['value'] = $tipos[$i]->getNome();
    $elm['id'] = $tipos[$i]->getId();
    $elm['desc'] = $tipos[$i]->getDescricao();
    $elm['imgpath'] = $tipos[$i]->getImagePath();
    $ret .= json_encode($elm);
}
$ret .= ']';
echo $ret;