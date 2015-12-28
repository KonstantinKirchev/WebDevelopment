<?php
namespace core\drivers;

abstract class DriverAbstract
{
    protected $user;
    protected $pass;
    protected $dbName;
    protected $host;

    public function __construct($user, $pass, $dbname, $host = null)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->host = $host;
    }

    /**
     * @return string
     */

    public abstract function getDsn();
}