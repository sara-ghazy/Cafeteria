<?php

namespace CAFETERIA\CONTROLLERS;

use CAFETERIA\MODELS\ChecksModel;
use CAFETERIA\MODELS\UserModel;

class ChecksController extends AbstractController
{
    public function defaultAction()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
               if($_POST['user']!='all')
               {
                   $usersDetails=ChecksModel::filterChecks($_POST['dateFrom'],$_POST['dateTo'],$_POST['user']);
               }
               else
               {
                   $usersDetails=ChecksModel::filterChecks($_POST['dateFrom'],$_POST['dateTo']);
               }
               $this->data['old']=$_POST;

        }else{
            $usersDetails=ChecksModel::allUsersDetails();
        }
        $totalPrices=[];
        foreach ($usersDetails as $user=> $orders)
        {
            $totalPrice=0;
            foreach ($orders as $order)
            {
                $totalPrice+=$order['totalPrice'];
            }
            $totalPrices[]=$totalPrice;
        }
        $this->data['usersDetails']=$usersDetails;
        $this->data['totalPrices']=$totalPrices;
        $this->data['users']=UserModel::getAll();
        $this->_view();
    }

    public function ordersDetailsAction()
    {
        $id=$_GET['id'];
        $orderDetails=ChecksModel::getOrderDetails($id);
        $orderDetails=json_encode($orderDetails);
        print_r($orderDetails);

    }
}