<?php
namespace CAFETERIA\LIB;
class FrontController
{

    const NOT_FOUND_CONTROLLER='CAFETERIA\CONTROLLERS\\NotFoundController';
    const NOT_FOUND_ACTION='notFoundAction';
    private $_controller='index';
    private $_action='default';
    private $_params=[];
    private $_session;
    public function __construct(SessionManager $session)
    {
        $this->_session=$session;
        $this->_parseUrl();
    }
    private function _parseUrl()
{

    $url=explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),3);
    if(isset($url[0])&&$url[0]!='')
    {
        $this->_controller=$url[0];
    }
    if(isset($url[1])&&$url[1]!='')
    {
        $this->_action=$url[1];
    }
    if(isset($url[2])&&$url[2]!='')
    {
        $this->_params=explode('/',$url[2]);
    }
}
public function dispatch()
{
   $controllerClassName='CAFETERIA\CONTROLLERS\\'.ucfirst($this->_controller).'Controller';
   $actionName=$this->_action.'Action';
   if(!class_exists($controllerClassName))
   {
       $controllerClassName=self::NOT_FOUND_CONTROLLER;
       $this->_controller=self::NOT_FOUND_CONTROLLER;
   }
    if(!isset($_SESSION['users']))
    {
        if($this->_controller != 'auth' && $this->_action != 'login') {
            header('location:/auth/login');
        }
    }else
    {
        if($this->_controller == 'auth' && $this->_action == 'login') {
            header('location:/');
        }
    }
   $controller=new $controllerClassName();
   if(!method_exists($controller,$actionName))
   {
       $this->_action=$actionName=self::NOT_FOUND_ACTION;
   }

    $controller->setController($this->_controller);
    $controller->setAction($this->_action);
    $controller->setParams($this->_params);
    $controller->setSession($this->_session);
    $controller->$actionName();

}
}