<?php
/**
 * Created by PhpStorm.
 * User: brlaranjeira
 * Date: 5/11/17
 * Time: 2:45 PM
 */

session_start();
session_destroy();
session_commit();
header('Location: login.php');