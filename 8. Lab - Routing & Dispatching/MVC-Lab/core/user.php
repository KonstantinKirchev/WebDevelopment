<?php
/**
 * Created by PhpStorm.
 * User: Emil
 * Date: 9/23/2015
 * Time: 4:54 PM
 */

namespace core;


class user {
    private $id;
    private $user;
    private $pass;
    private $gold;
    private $food;

    const GOLD_DEFAULT = 1500;
    const FOOD_DEFAULT = 1500;

    public function __construct($user, $pass, $id = null, $gold = null, $food = null) {
        $this->user = $user;
        $this->pass = $pass;
        $this->id = $id;
        $this->gold = $gold;
        $this->food = $food;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->user;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getGold() {
        return $this->gold;
    }

    public function getFood() {
        return $this->food;
    }
} 