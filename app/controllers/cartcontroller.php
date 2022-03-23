<?php
namespace CAFETERIA\CONTROLLERS;
use CAFETERIA\MODELS\ProductModel;
use CAFETERIA\MODELS\CreateOrderModel;
use CAFETERIA\MODELS\CreateOrderDetailsModel;
use CAFETERIA\LIB\DATABASE\DatabaseHandler;
use CAFETERIA\MODELS\OrderdetailsModel;



class CartController extends AbstractController
{
    function defaultAction()
    {
        
       


        $products=ProductModel::getAll();
        $this->data['products']=$products;
     
            ///add to cart
              if(isset($_POST['add']))
              {
                 $idprod=(int)$_GET['id'];
                 $allid="";
                 if(!empty($_SESSION['cart']))
                $allid=array_column($_SESSION['cart'],'id');
                if(empty($_SESSION['cart'])||!in_array($idprod,$allid))
                {
                    $product=array(
                        "id"        =>$idprod,
                        "name"      =>$_POST['name'],
                        "price"    =>$_POST['price'],
                        "quantity" =>$_POST['quantity']
                    );
        
                   array_push($_SESSION['cart'],$product);

                }
               

              header("location:/cart");
                exit;
           
               }


        ///remove product from cart

        if(isset($_POST['cancel']))
        {
            $idprod=(int)$_GET['id'];
               foreach ($_SESSION['cart'] as $key=>$value)
                {
                    if($value['id']==$idprod)
                    {
                        unset($_SESSION['cart'][$key]);
                        header("location:/cart");
                         exit;
                    }
                }

        }

         ///search product

        if(isset($_POST['search']))
        {
            $name=$_POST['searchProduct'];
            $this->data['search']=$name;
            $this->searchProduct($name);

        }

        ///confirm data
        if(isset($_POST['confirm']))
        {
            $this->confirm();

        }


        ///select lates order
     
         
 $sql="SELECT * FROM orders WHERE id= (SELECT MAX(id) FROM orders WHERE userId=".$_SESSION['login']['id'].")";
        
    
         $stmt=DatabaseHandler::factory()->prepare($sql);
         if($stmt->execute())
         {
            $obj=$stmt->fetchAll(\PDO::FETCH_CLASS);
             $order=array_shift($obj);
             
             $this->data['dateoflastorder']=$order->created_at;

             ///orderdetails
             $orderdetails=OrderdetailsModel::getAllByKey($order->id);
            
             $this->data['latestorder']=$orderdetails;
             
         }
        
     


        $this->_view();
}





function searchProduct($search)
{

    $sql="SELECT *FROM `product` WHERE `name` LIKE '%".$search."%'";
    $products=ProductModel::sql($sql);
    $this->data['products']=$products;


}

function confirm()
{
     

    $totalprice=$_SESSION['totalprice'];
    $order=new CreateOrderModel();
    $order->userId=$_SESSION['login']['id'];
    $order->totalPrice=$totalprice;

    if($order->save())
    {
     
    foreach($_SESSION['cart'] as $product)
    {
    
        $orderdetails=new CreateOrderDetailsModel();
        $orderdetails->orderId=$order->id;
        $orderdetails->productId=$product["id"];
        $orderdetails->quantity=$product['quantity'];
        $orderdetails->save();
        
    }

     $_SESSION['cart']=array();
    header("location:/cart");
    exit;
    }
   
}




}

