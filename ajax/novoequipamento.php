<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/16/17
 * Time: 3:58 PM
 */
require_once(__DIR__ . '/../dao/Equipamento.php');
require_once(__DIR__ . '/../ConfigClass.php');

$id = isset($_POST['id']) ? $_POST['id'] : null;
$sala = $_POST['sala'];
$container = isset($_POST['container']) ? $_POST['container'] : null;
$responsavel = $_POST['responsavel'];
$idtipoeqpt = $_POST['idtipoeqpt'];
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$patrimonio = isset($_POST['patrimonio']) ? $_POST['patrimonio'] : null;
$numserie = isset($_POST['numserie']) ? $_POST['numserie'] : null;
$estado = $_POST['estado'];
$observacao = isset($_POST['observacao']) ? $_POST['observacao'] : null;
if ($_FILES['foto']['size'] == 0) {
    $fotoOk = true;
} else {
    $nomeArq = strval(time(null)) . '.' . end(explode('.',$_FILES['foto']['name']));
    $moveu = move_uploaded_file($_FILES['foto']['tmp_name'],__DIR__ . '/../' . ConfigClass::diretorioImagens . '/' . $nomeArq);
    $fotoOk = $moveu;
}
if ($fotoOk) {
    //$id, $sala, $container, $responsavel, $tipo, $descricao, $patrimonio, $numserie, $estado, $obs, $foto
    $equipamento = new Equipamento($id,$sala,$container,$responsavel,$idtipoeqpt,$descricao,$patrimonio,$numserie,$estado,$observacao,$nomeArq);
    $equipamento->save();
    echo $equipamento->asJSON();
    $a = 1;
}