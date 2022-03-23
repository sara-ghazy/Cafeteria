<?php

namespace CAFETERIA\CONTROLLERS;
use CAFETERIA\MODELS\OrderModel;
use CAFETERIA\MODELS\OrderdetailsModel;
use CAFETERIA\LIB\DATABASE\DatabaseHandler;


class OrderController extends AbstractController
{
    function defaultAction()
    {
  
        $this->data['order']=OrderModel::getAllByKey($_SESSION['login']['id']);
       
        $arr=array();

        foreach($this->data['order'] as $row)
        {
        
          array_push($arr,OrderdetailsModel::getAllBykey($row->id));
          
        }

        $this->data['orderdetails']=$arr;


        ///search using date

        $this->data['st']='';
        $this->data['from']='';
        $this->data['to']='';
        if(isset($_POST['search']))
        {
          $from=$_POST['from'];
          $to=$_POST['to'];
          $this->data['from']=$from;
          $this->data['to']=$to;

         
          $sql="SELECT *FROM `orderUsers` WHERE (DATE(`created_at`)>='$from' and DATE(`created_at`)<='$to')";
         
          $this->data['order']=OrderModel::sql($sql);
          $arr=array();
      
           foreach($this->data['order'] as $row)
           {
           
             array_push($arr,OrderdetailsModel::getAllBykey($row->id));
             
           }

           $this->data['orderdetails']=$arr;
           

        }



        ////////////cancel order
        if(isset($_POST['cancel']))
        {
          $orderid=$_GET['orderid'];
          $sql="DELETE FROM `orders` WHERE `id`=$orderid";
          $stmt=DatabaseHandler::factory()->prepare($sql);
          if($stmt->execute())
          {
    
            header("location:/order");
            exit;
          }
          

        }


        
        $this->_view();

    }


}



?>