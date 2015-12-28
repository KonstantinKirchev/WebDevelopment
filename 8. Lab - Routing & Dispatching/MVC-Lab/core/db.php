<?php
namespace core;

class Database
{
    private static $inst = array();
    public $db;

    private function __construct(\PDO $instance) {
        $this->db = $instance;
    }

    public static function getInstance($instanceName = 'default') {
        if (!isset(self::$inst[$instanceName])) {
            throw new \Exception('Instance with that name was not set');
        }

        return self::$inst[$instanceName];
    }

    public static function setInstance($instanceName, $driver, $user, $pass, $dbName, $host = null) {
        $driver = drivers\DriverFactory::create($driver, $user, $pass, $dbName, $host);
        $pdo = new \PDO($driver->getDsn(), $user, $pass);
        self::$inst[$instanceName] = new self($pdo);
    }

    public function prepare($statement, array $driverOptions = []) {
        $statement = $this->db->prepare($statement, $driverOptions);

        return new Statement($statement);
    }

    public function query($query) {
        $this->db->query($query);
    }

    public function lastId($name = null) {
        return $this->db->lastInsertId($name);
    }
}

class Statement
{
    public $stmt;

    public function __construct(\PDOStatement $stmt) {
        $this->stmt = $stmt;
    }

    public function fetch($fetchStyle = \PDO::FETCH_ASSOC) {
        return $this->stmt->fetch($fetchStyle);
    }

    public function fetchAll($fetchStyle = \PDO::FETCH_ASSOC) {
        return $this->stmt->fetchAll($fetchStyle);
    }

    public function bindParam($parameter, $variable, $dataType = \PDO::PARAM_STR, $length, $driverOptions) {
        return $this->stmt->bindParam($parameter, $variable, $dataType, $length, $driverOptions);
    }

    public function execute(array $inputParams) {
        return $this->stmt->execute($inputParams);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }
}