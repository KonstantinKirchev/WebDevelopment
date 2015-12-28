<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index
 *
 * @author gatakka
 */
namespace Controllers;
use GF\App;

class Index extends \GF\DefaultController{
    public function index2(){        

        $view=  \GF\View::getInstance();
        $view->username='gatakka1111';
        $view->appendToLayout('body','admin.index');
        $view->appendToLayout('body2','index');
        $view->display('layouts.admin.default',array('c'=>array(1,2,3,4,8)),false);        
    }
}

