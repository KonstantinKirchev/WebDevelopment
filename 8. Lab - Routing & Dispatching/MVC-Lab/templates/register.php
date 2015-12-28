<form action="" method="post">
    <input type="text" name="username" />
    <input type="password" name="password" />
    <input type="submit" value="Register" />
</form>

<?php
//require_once 'index.php';

if (isset($_POST['username'], $_POST['password'])) {
    try {
        $factory = new \core\drivers\DriverFactory();
        $driver = null;
        $app = new \core\app($factory->create($driver, "root", "", "mmorpg_app", "localhost:8080"));
        $user = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['password']);
        $app->register($user, $pass);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    header("templates\\login.php");
}