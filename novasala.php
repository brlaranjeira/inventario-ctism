<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/12/17
 * Time: 3:13 PM
 */

$predio = $_POST['predio'];
$nro = $_POST['nro'];
$descricao = $_POST['descricao'];
require_once ('Sala.php');
$sala = new Sala(null,$predio,$nro,$descricao);
if (!$sala->save()) {
    header('HTTP/1.1 500 Erro Interno.');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERRO!')));
} else {
    echo $sala->asJSON();
}