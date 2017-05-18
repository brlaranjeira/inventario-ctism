<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/15/17
 * Time: 9:36 AM
 */


require_once(__DIR__ . "/../lib/Usuario.php");
require_once(__DIR__ . "/../lib/Grupos.php");
require_once(__DIR__ . '/../lib/Usuario.php');
require_once(__DIR__ . '/../lib/Paginas.php');
Paginas::forcaSeguranca();
?>
<?


if (sizeof($_POST) > 0) {
    session_start();
    $_SESSION['ctism_inventario_responsavel'] = $_POST['responsavel'];
    header('Location: cadastrar.php');
}
?>

<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/inventario.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/sel_sala.css">
    <title><?=ConfigClass::sysName?></title>
</head>
<body>
<? include __DIR__ . '/paginas/fragments/header.php'; ?>
    <div class="container-fluid">
        <form id="form-responsavel" method="post" action="">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="responsavel">Responsável</label>
                        <select class="form-control" name="responsavel" id="responsavel">
                            <?
                            $usuarios = Usuario::getAllFromGroup(array(Grupos::FUNCIONARIOS,Grupos::PROFESSORES));
                            foreach ($usuarios as $usuario) {
                                ?> <option value="<?=$usuario->getUid()?>"><?=$usuario->getFullName()?></option> <?
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-xs-12">
                    <button type="submit" class="form-control btn btn-info btn-block">Selecionar</button>
                </div>
            </div>
        </form>
    </div>
</body>


<? include __DIR__ . '/../paginas/fragments/footer.php'; ?>
</body>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery-2.2.1.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/jquery/jquery.mask.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/bootstrap/bootstrap.min.js"></script>
<script type="application/javascript" language="javascript" src="../js/inventario.js"></script>
</html>
