<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/16/17
 * Time: 10:57 AM
 */

require_once ('TipoEquipamento.php');
require_once ('ConfigClass.php');

$nome = $_POST['tipoeqpt-nome'];
$descricao = $_POST['tipoeqpt-descricao'];

$nomeArq = strval(time(null)) . '.' . end(explode('.',$_FILES['tipoeqpt-img']['name']));

$moveu = move_uploaded_file($_FILES['tipoeqpt-img']['tmp_name'],ConfigClass::diretorioImagens . '/' . $nomeArq);
if ($moveu) {
    $novo = new TipoEquipamento(null,$nome,$descricao,$nomeArq);
    if ($novo->save()) {
        echo 'foi';
    } else {
        //err
    }
}
//err

//$tipo = new TipoEquipamento(null,)