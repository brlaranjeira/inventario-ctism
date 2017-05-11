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
            $msg = 'usuário nao autorizado.';
        }
    } else {
        $msg = 'usuário inexistente ou senha incorreta.';
    }

}
?>
    <html>
    <head>
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"/>
    </head>
    <body>
    <form id="form-login" action="login.php" method="post">
        <?php
            if (isset($msg)) {
                echo $msg . '<br/>';
            }
        ?>
        <label>Usuário:</label>
        <input type="text" name="usr"/>
        <label>Senha:</label>
        <input type="password" name="pw"/>
        <input type="submit">
    </form>
    </body>
    </html>