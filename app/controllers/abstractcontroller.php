<?php

namespace CAFETERIA\CONTROLLERS;



use CAFETERIA\LIB\FilterInput;

use CAFETERIA\LIB\FrontController;

class AbstractController
{

    private $controller;
    private $action;
    protected $params=[];
    protected $data=[];

    use FilterInput;

    public  function setController($controller)
    {
        $this->controller=$controller;
    }
    public  function setAction($action)
    {
        $this->action=$action;
    }
    public  function setParams($params)
    {
        $this->params=$params;
    }
    public function notFoundAction()
    {
        $this->_view();
    }
    protected function _view()
    {
        if($this->controller==FrontController::NOT_FOUND_CONTROLLER)
        {
            require APP_PATH.DS.'views/notfound/notfound.view.php';
        }
        elseif ($this->action==FrontController::NOT_FOUND_ACTION)
        {
            require APP_PATH.DS.'views/notfound/noview.view.php';
        }elseif ($this->controller=='auth')
        {
            extract($this->data);
            require APP_PATH.DS.'template/head.php';
            require APP_PATH . DS . 'views/auth/login.view.php';
        }
        else
        {
            extract($this->data);
            require APP_PATH.DS.'template/head.php';
            require APP_PATH.DS.'template/header.php';
            require APP_PATH.DS.'views/'.$this->controller.DS.$this->action.'.view.php';
            require APP_PATH.DS.'template/footer.php';

        }

    }
}