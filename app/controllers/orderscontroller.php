<?php

namespace CAFETERIA\CONTROLLERS;

use CAFETERIA\LIB\Helper;
use CAFETERIA\MODELS\OrderDetailsModel;
use CAFETERIA\MODELS\OrdersModel;
use CAFETERIA\MODELS\ViewOrderdetailsModel;
use CAFETERIA\MODELS\ViewOrderModel;

class OrdersController extends AbstractController
{
    use Helper;

    function defaultAction()
    {
        $this->data['orders']=ViewOrderModel::getAll();
        $arr=[];
        foreach($this->data['orders'] as $row)
        {
            array_push($arr,ViewOrderdetailsModel::getAllBykey($row->id));
        }
        $this->data['orderdetails']=$arr;

        ///upadte status of order

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $st=$_POST['st'];
            $id=$_POST['id'];
            $data=OrdersModel::getByKey($id);
            $data->status=$st;
            $data->save();
            header("location:/orders");
            exit();
        }
        $this->_view();
    }

    public function addAction()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $userId=$this->filterInt($_POST['user']);
            if($userId)
            {
                $totalPrice=$_SESSION['totalPrice'];
                $productsDetails=[];
                foreach ($_SESSION['shopping_cart'] as $item=>$value)
                {
                    $productsDetails[]=array($value['itemId'],$value['itemQuantity']);
                    $productsId[]=$value['itemId'];
                }
                $order=new OrdersModel();
                $order->userId=$userId;
                $order->totalPrice=$totalPrice;
                if($order->save())
                {
                    foreach ($productsDetails as $item)
                    {
                        $orderDetails=new OrderDetailsModel();
                        $orderDetails->orderId=$order->id;
                        $orderDetails->productId=$item[0];
                        $orderDetails->quantity=$item[1];
                        $orderDetails->save();
                    }
                }
                unset($_SESSION['shopping_cart']);
                header("location:/");

            }
        }
    }

}