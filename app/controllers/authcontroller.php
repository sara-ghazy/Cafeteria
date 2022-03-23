<?php

namespace CAFETERIA\CONTROLLERS;


use CAFETERIA\MODELS\AdminModel;

class AuthController extends AbstractController
{

    public function loginAction()
    {

        if($_SERVER['REQUEST_METHOD']=='POST')
            {

                $email=$this->filterString($_POST['email']);
                $password=$this->filterString($_POST['password']);
                $user=AdminModel::authenticate($email,$password);
                if($user)
                {
                    $this->session->users=$user;
                    header('location:/');
                }else
                {
                    $this->data['invalid']='invalid email or password';
                }
            }
        $this->_view();
    }
    public function logoutAction()
    {
        $this->session->kill();
        header("location:/auth/login");
    }
    public function notfoundAction()
    {
        header("location:/auth/login");
    }
}