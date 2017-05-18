<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/12/17
 * Time: 4:36 PM
 */

$sala = $_REQUEST['sala'];
$nro = $_REQUEST['nro'];
$descricao = $_REQUEST['descricao'];

require_once(__DIR__ . '/../dao/Container.php');
$container = new Container(null,$sala,$nro,$descricao);
if ($container->save()) {
    echo $container->asJSON();
} else {
    header('HTTP/1.1 500 Erro Interno.');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERRO!')));
}