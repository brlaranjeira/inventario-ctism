<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/16/17
 * Time: 3:58 PM
 */
require_once ('dao/Equipamento.php');
require_once ('ConfigClass.php');


error_reporting(E_ALL);
$sala = $_POST['sala'];
$container = isset($_POST['container']) ? $_POST['container'] : null;
$responsavel = $_POST['responsavel'];
$idtipoeqpt = $_POST['idtipoeqpt'];
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$patrimonio = isset($_POST['patrimonio']) ? $_POST['patrimonio'] : null;
$numserie = isset($_POST['numserie']) ? $_POST['numserie'] : null;
$estado = $_POST['estado'];
$observacao = isset($_POST['observacao']) ? $_POST['observacao'] : null;
$nomeArq = strval(time(null)) . '.' . end(explode('.',$_FILES['foto']['name']));
$moveu = move_uploaded_file($_FILES['foto']['tmp_name'],ConfigClass::diretorioImagens . '/' . $nomeArq);
if ($moveu) {
    //$id, $sala, $container, $responsavel, $tipo, $descricao, $patrimonio, $numserie, $estado, $obs, $foto
    $equipamento = new Equipamento(null,$sala,$container,$responsavel,$idtipoeqpt,$descricao,$patrimonio,$numserie,$estado,$observacao,$nomeArq);
    $equipamento->save();
}