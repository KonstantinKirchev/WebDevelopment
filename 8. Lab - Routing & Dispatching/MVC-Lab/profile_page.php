<?php
if (!$app->isLogged()) {
    header("Location: login.php");
    header("templates\\profile.php");
}