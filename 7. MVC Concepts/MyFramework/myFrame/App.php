<?php

namespace myFrame;

include_once 'Loader.php';

class App
{
    private static $_instance = null;
    private $_config = null;
    private $router = null;

    /**
     * @var \myFrame\FrontController
     */
    private $_frontController = null;

    private function __construct()
    {
        \myFrame\Loader::registerNamespace('myFrame', dirname(__FILE__).DIRECTORY_SEPARATOR);
        \myFrame\Loader::registerAutoLoad();
        $this->_config = \myFrame\Config::getInstance();
        if($this->_config->getConfigFolder() == null){
            $this->setConfigFolder('../config');
        }
    }

    public function getConfigFolder()
    {
        return $this->_configFolder;
    }

    public function setConfigFolder($path)
    {
        $this->_config->setConfigFolder($path);
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }


    /**
     * @return \myFrame\Config
     */
    public function getConfig()
    {
        return $this->_config;
    }

    public function run()
    {
        if($this->_config->getConfigFolder() == null){
            $this->setConfigFolder('../config');
        }
        $this->_frontController = \myFrame\FrontController::getInstance();
        if($this->router instanceof \myFrame\Routers\IRouter){
            $this->_frontController->setRouter($this->router);
        } else if($this->router=='JsonRPCRouter'){
            $this->_frontController->setRouter(new \myFrame\Routers\DefaultRouter());
        }else if($this->router=='CLIRouter'){
            $this->_frontController->setRouter(new \myFrame\Routers\DefaultRouter());
        }else{
            $this->_frontController->setRouter(new \myFrame\Routers\DefaultRouter());
        }
        $this->_frontController->dispatch();
    }

    /**
     * @return \myFrame\App
     */
    public static function getInstance()
    {
        if(self::$_instance == null){
            self::$_instance = new \myFrame\App();
        }

        return self::$_instance;
    }
}