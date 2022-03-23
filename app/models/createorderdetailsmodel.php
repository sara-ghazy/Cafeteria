<?php

namespace CAFETERIA\MODELS;

class CreateOrderDetailsModel extends  Model
{
    public $quantity;
    public $productId;
    public $orderId;

    protected static $tableName='orderDetails';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        "quantity"   =>self::DATA_TYPE_INT,
        "productId"  =>self::DATA_TYPE_INT,
        "orderId"    =>self::DATA_TYPE_INT,
        "id"       =>self::DATA_TYPE_INT
    ];
}