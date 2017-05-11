<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 3:16 PM
 */
require_once ('lib/Usuario.php');
require_once ('lib/Paginas.php');
Paginas::forcaSeguranca();
include 'header.php';

session_start();
if (!isset($_SESSION['session_sala'])) {
    header('Location: sel_sala.php');
}