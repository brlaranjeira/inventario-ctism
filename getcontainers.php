<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 6:50 PM
 */

require_once ('lib/Usuario.php');
require_once ('lib/Paginas.php');
require_once ("Sala.php");
Paginas::forcaSeguranca();

$idSala = $_REQUEST['idsala'];
$sala = Sala::getById($idSala);
$containers = $sala->getContainers();
$ret = '[';
for($i=0;$i<sizeof($containers);$i++) {
    $ret .= $i != 0 ? ',' : '';
    $ret .= $containers[$i]->asJSON();
}
$ret .= ']';
echo $ret;