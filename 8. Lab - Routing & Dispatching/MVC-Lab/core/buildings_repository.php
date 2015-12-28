<?php
/**
 * Created by PhpStorm.
 * User: Emil
 * Date: 9/23/2015
 * Time: 11:06 PM
 */

namespace core;


class BuildingsRepository
{
    /**
     * @var Database
     */
    private $db;

    /**
     * @var User
     */
    private $user;

    public function __construct(Database $db, User $user) {
        $this->db = $db;
        $this->user = $user;
    }

    public function getUser() {
        return $this->user;
    }
} 