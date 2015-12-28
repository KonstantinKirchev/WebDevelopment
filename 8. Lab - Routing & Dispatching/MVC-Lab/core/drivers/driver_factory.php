<?php
namespace core\drivers;

include 'driver_abstract.php';
include 'mysql_driver.php';

class DriverFactory
{
    public static function create($driver, $user, $pass, $dbName, $host) {
        $driver = new MySQLDriver($user, $pass, $dbName, $host);
        return $driver;
    }
}