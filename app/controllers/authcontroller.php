<?php

namespace CAFETERIA\CONTROLLERS;


use CAFETERIA\MODELS\UserModel;

class AuthController extends AbstractController
{

    public function loginAction()
    {

           if($_SERVER['REQUEST_METHOD']=='POST')
            {

                $email=$this->filterString($_POST['email']);
                $password=$this->filterString($_POST['password']);
              
                if(empty($email)||empty($password))
                {
                    $this->data['invalid']='* email and password are required';

                }else{
                $user=UserModel::login($email,$password);
                if($user)
                {
                     $_SESSION['login']=$user;
                     $_SESSION['cart']=array();
                    header('location:/order');
                }else
                {
                    $this->data['invalid']='* invalid email or password';
                }
            }
            }
        $this->_view();
    }
    public function logoutAction()
    {
        unset($_SESSION['login']);
        header("location:/auth/login");
        exit;
    }
    public function notfoundAction()
    {
       $this->redirect('location:/auth/login');
    }
}