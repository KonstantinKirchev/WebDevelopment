<?php
/**
 * Created by PhpStorm.
 * User: Emil
 * Date: 9/23/2015
 * Time: 5:01 PM
 */

namespace core;


class app {
    private $db;

    private $user = null;

    private $buildingsRepository = null;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function isLogged() {
        return isset($_SESSION['id']);
    }

    /**
     * @param $username
     * @return bool
     */
    public function userExists($username) {
        $result = $this->db->prepare("select id from users where username = ?");
        $result->execute([$username]);

        return $result->rowCount() > 0;
    }

    public function register($username, $password) {
        if ($this->userExists($username)) {
            throw new \Exception("User already registered");
        }

        $result = $this->db->prepare("insert into users (username, password, gold, food) values (?, ?, ?, ?);");
        $result->execute([$username, password_hash($password, PASSWORD_DEFAULT), USER::GOLD_DEFAULT, USER::FOOD_DEFAULT]);

        if ($result->rowCount() > 0) {
            $userId = $this->db->lastId();

            $this->db->query("insert into users_buildings (user_id, building_id, level_id) select $userId, id, 0 from buildings");
            $this->login($username, $password);
            return true;
        }

        throw new \Exception('Cannot register user!');
    }

    public function login($username, $password) {
        $result = $this->db->prepare("select * from users where username = ?");
        $result->execute($username);

        if ($result->rowCount() == 0) {
            throw new \Exception("Invalid username!");
        }

        $userRow = $result->fetch();

        if ($userRow["password"] == password_hash($password, PASSWORD_DEFAULT)) {
            session_id($userRow["id"]);
            session_start();
            header("Location: profile_page.php");
        }
    }

    public function getUserInfo($id) {
        $result = $this->db->prepare("select id, username, password, gold, food from users where id = ?");
        $result->execute([$id]);

        return $result->fetch();
    }

    /**
     * @return user|null
     */
    public function createUserFromInfo() {
        if ($this->isLogged()) {
            $info = $this->getUserInfo($_SESSION["id"]);
            $user = new user($info["username"], $info["password"], $info["id"], $info["gold"], $info["food"]);

            if ($this->user == null) {
                $this->user = $user;
            }
        }

        return $this->user;
    }

    public function createBuildings()
    {
        if ($this->buildingsRepository == null) {
            $this->buildingsRepository = new BuildingsRepository($this->db, $this->user);
        }

        return $this->buildingsRepository;
    }
} 