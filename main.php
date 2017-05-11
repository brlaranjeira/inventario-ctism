<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 11:42 AM
 */

require_once ("lib/Usuario.php");
require_once ("lib/Paginas.php");
require_once ("ConfigClass.php");
$usuario = Usuario::restoreFromSession();
if ($usuario == null) {
    header('Location: login.php');
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
    <? include 'header.php'; ?>
    <div class="row">
    <?
        $paginas = Paginas::getAllowedPages($usuario);
        foreach ($paginas as $pagina) { ?>
            <div class="col-xs-12 text-center">
                <a class="" href="<?=$pagina['id']?>.php"><?=$pagina['nome']?></a>
            </div>
        <? } ?>
    </div>
    <? include 'footer.php';?>
</body>
</html>



