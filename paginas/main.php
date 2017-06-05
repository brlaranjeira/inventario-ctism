<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 11:42 AM
 */

require_once (__DIR__."/../lib/Usuario.php");
require_once (__DIR__."/../lib/Paginas.php");
require_once (__DIR__."/../ConfigClass.php");
$usuario = Usuario::restoreFromSession();
if ($usuario == null) {

    header('Location: ../login.php');
}
?>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
    <? include __DIR__ . '/fragments/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
        <?
            $paginas = Paginas::getAllowedPages($usuario);
            foreach ($paginas as $pagina) { ?>
                <div class="col-xs-12 text-center">
                    <a class="" href="./<?=$pagina['id']?>.php"><?=$pagina['nome']?></a>
                </div>
            <? } ?>
        </div>
    </div>
    <? include __DIR__ . '/fragments/footer.php'; ?>
</body>
</html>



