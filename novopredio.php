<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/12/17
 * Time: 10:35 AM
 */

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
require_once("dao/Predio.php");
$predio = new Predio(null,$nome,$descricao);
if (!$predio->save()) {
    header('HTTP/1.1 500 Erro Interno.');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERRO!')));
} else {
    echo $predio->asJSON();
}

