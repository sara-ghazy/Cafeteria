<?php

namespace CAFETERIA\MODELS;

use CAFETERIA\LIB\DATABASE\DatabaseHandler;

class ChecksModel extends Model
{
    public static function filterChecks($dateFrom,$dateTo,$user='')
    {
        if(!empty($user))
        {
            $sql="select user.name,user.id ,orders.created_at,orders.id as orderId,totalPrice from orders inner join user on
            user.id=orders.userId and user.id=".$user." and  orders.created_at between '".$dateFrom." 00-00-00' and '".$dateTo." 23-59-00' group by orders.id order by user.id";
        }else
        {
            $sql="select user.name,user.id ,orders.created_at,orders.id as orderId,totalPrice from orders inner join user on
        user.id=orders.userId and orders.created_at between '".$dateFrom." 00-00-00' and '".$dateTo." 23-59-00' group by orders.id order by user.id";
        }

        $stmt=DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchall(\PDO::FETCH_GROUP);
        return $res;

    }
    public static function allUsersDetails()
    {
        $sql="select user.name,user.id ,orders.created_at,orders.id as orderId,totalPrice from orders inner join user on
        user.id=orders.userId  group by orders.id order by user.id";
        $stmt=DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchall(\PDO::FETCH_GROUP);
        return $res;

    }

    public static function getOrderDetails($id)
    {
        $sql='select product.name,product.price,orderDetails.quantity from product inner join orderDetails inner join orders on product.id=orderDetails.productId and orders.id=orderDetails.orderId and orders.id='.$id;
        $stmt=DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        $res=$stmt->fetchall(\PDO::FETCH_ASSOC);
        return $res;
    }

}