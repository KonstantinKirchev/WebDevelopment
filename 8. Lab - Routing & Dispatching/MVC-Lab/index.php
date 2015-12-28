<?php
session_start();

spl_autoload_register(function($class) {
    $classPath = str_replace("\\", "/", $class);
    require_once $classPath . '.php';
});

require_once 'core/app.php';

core\Database::setInstance(
    config\DatabaseConfig::DB_INSTANCE,
    config\DatabaseConfig::DB_DRIVER,
    config\DatabaseConfig::DB_USER,
    config\DatabaseConfig::DB_PASS,
    config\DatabaseConfig::DB_NAME,
    config\DatabaseConfig::DB_HOST
);

$app = new core\app(
    core\Database::getInstance(config\DatabaseConfig::DB_INSTANCE)
);

function loadTemplate($templateName, $data = null) {
    require_once 'templates/' . $templateName . '.php';
}