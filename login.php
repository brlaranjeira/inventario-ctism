<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/9/17
 * Time: 3:07 PM
 */

require_once ('lib/LDAP/ldap.php');
require_once ('lib/Usuario.php');
require_once ('lib/Grupos.php');
$msg = '';
if (!empty($_POST)) {
    $ldap = new ldap();
    if ($ldap->auth($_POST['usr'],$_POST['pw'])) {
        $usuario = new Usuario($_POST['usr'],true);
        $grupoOk = $usuario->hasGroup(array(Grupos::PROFESSORES,Grupos::FUNCIONARIOS));
        if ($grupoOk) {
            session_start();
            $usuario->saveToSession();
            header('Location: main.php');
        } else {
            $msg = 'Usuário nao autorizado.';
        }
    } else {
        $msg = 'Usuário inexistente ou senha incorreta.';
    }

}
?>
    <html>
    <head>
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"/>
    </head>
    <body>
    <div class="jumbotron">
        <h2>Inventário CTISM</h2>
    </div>
    <div class="container-fluid">
        <form id="form-login" action="login.php" method="post">
            <? if (strlen($msg) > 0) { ?>
                <div class="alert alert-danger">
                    <strong><?=$msg?></strong>
                </div>
            <? } ?>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="usr">Usuário:</label>
                    <input class="form-control" type="text" name="usr"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="pw">Senha:</label>
                    <input class="form-control" type="password" name="pw"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <button type="submit" class="form-control btn btn-info">Entrar</button>
                </div>
            </div>

        </form>
    </div>
    </body>
    <? include 'footer.php'; ?>
    </html>