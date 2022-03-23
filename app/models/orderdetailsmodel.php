<?php

namespace CAFETERIA\MODELS;

class OrderDetailsModel extends  Model
{
    public $quantity;
    public $productId;
    public $orderId;

    protected static $tableName='orderDetails';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        "quantity"   =>self::DATA_TYPE_INT,
        "productId"  =>self::DATA_TYPE_INT,
        "orderId"    =>self::DATA_TYPE_INT
    ];

    public static function getOrderDetails($orderId)
    {
        $sql="select product.name,orDerdetails.quantity,product.imgUrl
              from product inner join orDerdetails 
             on product.id=orderDetails.productId and orDerdetails.orderId='".$orderId."' group by product.name ";
        return self::getGroup($sql);
    }
}