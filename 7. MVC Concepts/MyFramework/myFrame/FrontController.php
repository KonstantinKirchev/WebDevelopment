<?php

namespace myFrame;


use myFrame\Routers\IRouter;

class FrontController
{
    private static $_instance = null;
    private $namespace = null;
    private $controller = null;
    private $method = null;
    private $router = null;

    private function __construct()
    {

    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter(IRouter $router)
    {
        $this->router = $router;
    }

    public function dispatch()
    {
        if($this->router == null){
            throw new \Exception('Invalid router found', 500);
        }
        $_uri = $this->router->getURI();
        $routes = \myFrame\App::getInstance()->getConfig()->routes;
        $_routeController = null;

        if(is_array($routes) && count($routes) > 0){
            foreach ($routes as $key => $value) {
                if(strpos($_uri, $key) === 0 && ($_uri == $key || strpos($_uri, $key.'/') === 0) && $value['namespace']){
                    $this->namespace = $value['namespace'];
                    $_uri = substr($_uri, strlen($key) + 1);
                    $_routeController = $value;
                    break;
                }
            }

        }else{
            throw new \Exception('Default route missing', 500);
        }

        if($this->namespace == null && $routes['*']['namespace']){
            $this->namespace = $routes['*']['namespace'];
            $_routeController = $routes['*'];
        }else if($this->namespace == null && !$routes['*']['namespace']){
            throw new \Exception('Default route missing', 500);
        }

        $_params = explode('/', $_uri);

        if ($_params[0]) {
            $this->controller = strtolower($_params[0]);

            if ($_params[1]) {
                $this->method = strtolower($_params[1]);
            }else{
                $this->method = $this->getDefaultMethod();
            }
        }else{
            $this->controller = $this->getDefaultController();
            $this->method = $this->getDefaultMethod();
        }

        if(is_array($_routeController) && $_routeController['controllers']){
            if($_routeController['controllers'][$this->controller]['methods'][$this->method]){
                $this->method = strtolower($_routeController['controllers'][$this->controller]['methods'][$this->method]);
            }
            if(isset($_routeController['controllers'][$this->controller]['to'])){
                $this->controller = strtolower($_routeController['controllers'][$this->controller]['to']);
            }
        }

        $f = $this->namespace.'\\'. ucfirst($this->controller);
        $newController = new $f();
        $newController->{$this->method}();
        //var_dump($newController);


//        $controller = $a->getController();
//        $method = $a->getMethod();
//
//        if($controller == null){
//            $controller = $this->getDefaultController();
//        }
//
//        if($method == null){
//            $method = $this->getDefaultMethod();
//        }
//
//        echo $controller . '<br/>' . $method;
    }

    public function getDefaultController()
    {
        $controller = \myFrame\App::getInstance()->getConfig()->app['default_controller'];
        if($controller){
            return strtolower($controller);
        }
        return 'index';
    }

    public function getDefaultMethod()
    {
        $method = \myFrame\App::getInstance()->getConfig()->app['default_method'];
        if($method){
            return strtolower($method);
        }
        return 'index';
    }

    /**
     * @return \myFrame\FrontController
     */
    public static function getInstance()
    {
        if(self::$_instance == null){
            self::$_instance = new \myFrame\FrontController();
        }

        return self::$_instance;
    }
}