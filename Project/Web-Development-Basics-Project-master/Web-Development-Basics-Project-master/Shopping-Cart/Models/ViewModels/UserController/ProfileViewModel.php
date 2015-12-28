<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/24/15
 * Time: 8:52 PM
 */

namespace Models\ViewModels\UserController;


class ProfileViewModel
{
    private $username;
    private $isAdmin;
    private $isEditor;
    private $isModerator;
    private $balance;

    function __construct($username, $isAdmin, $balance, $isEditor, $isModerator)
    {
        $this->username = $username;
        $this->isAdmin = $isAdmin;
        $this->isEditor = $isEditor;
        $this->isModerator = $isModerator;
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function getIsEditor()
    {
        return $this->isEditor;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getIsModerator(){
        return $this->isModerator;
    }
}