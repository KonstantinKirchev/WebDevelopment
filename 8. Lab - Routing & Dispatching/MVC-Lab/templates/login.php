<form action="" method="post">
    <input type="text" name="username" />
    <input type="password" name="password" />
    <input type="submit" value="Login" />
</form>

<?php

if (isset($_POST['username'], $_POST['password'])) {
    try {
        $user = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['password']);
        $app->login($user, $pass);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}