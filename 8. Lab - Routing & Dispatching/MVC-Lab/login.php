<?php
require_once 'index.php';

if (isset($_POST['username'], $_POST['password'])) {
    try {
        $user = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['password']);
        $app->login($user, $pass);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    header("templates\\login.php");
}