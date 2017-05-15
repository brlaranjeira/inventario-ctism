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
if (!isset($_SESSION['ctism_inventario_sala'])) {
    header('Location: sel_sala.php');
}
if (!isset($_SESSION['ctism_inventario_responsavel'])) {
    header('Location: sel_responsavel.php');
}