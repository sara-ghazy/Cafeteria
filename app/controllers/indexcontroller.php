<?php
namespace CAFETERIA\CONTROLLERS;
use CAFETERIA\MODELS\ProductModel;
use CAFETERIA\MODELS\UserModel;


class IndexController extends AbstractController
{
    function defaultAction()
    {
        $this->data['products']=ProductModel::getAll();
        $this->data['users']=UserModel::getAll();
        if(isset($_POST['submit']))
        {
            if(isset($_SESSION["shopping_cart"]))
            {
                $itemsId=array_column($_SESSION['shopping_cart'],'itemId');
                if(!in_array($_GET['id'],$itemsId))
                {
                    $count=count($_SESSION['shopping_cart']);
                    $item=[
                        "itemId"        =>$_GET['id'],
                        "itemName"      =>$_POST['hidden_name'],
                        "itemPrice"    =>$_POST['hidden_price'],
                        "itemQuantity" =>$_POST['quantity']
                    ];
                    $_SESSION['shopping_cart'][$count]=$item;


                }
                else
                {
                    echo "<script>alert('item already added')</script>";
                    echo "<script>window.location='/'</script>";
                }


            }else
            {
                $itemArray=array(
                    "itemId"        =>$_GET['id'],
                    "itemName"      =>$_POST['hidden_name'],
                    "itemPrice"    =>$_POST['hidden_price'],
                    "itemQuantity" =>$_POST['quantity']
                );
                $_SESSION['shopping_cart'][0]=$itemArray;

            }

        }
        if(isset($_GET['action']))
        {
            if ($_GET['action']=='delete')
            {
                foreach ($_SESSION['shopping_cart'] as $item=>$value)
                {
                    if($value['itemId']==$_GET['id'])
                    {
                        unset($_SESSION['shopping_cart'][$item]);
                        echo "<script>window.location=/</script>";
                    }
                }
            }
        }
        $this->_view();
    }

}