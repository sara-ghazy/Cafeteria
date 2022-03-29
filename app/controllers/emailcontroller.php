<?php

namespace CAFETERIA\CONTROLLERS;
use CAFETERIA\MODELS\EmailModel;


class EmailController extends AbstractController
{


    public function defaultAction()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
           $test= EmailModel::sendEmail($_POST['email']);
           if($test)
           {
               header("location:/auth/login");
               exit;
           }
           
        }

        $this->_view();
    }


}