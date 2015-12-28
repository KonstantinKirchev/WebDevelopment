<?php
namespace core\drivers;

class MySQLDriver extends DriverAbstract
{
    public function getDsn() {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;

        return $dsn;
    }
}