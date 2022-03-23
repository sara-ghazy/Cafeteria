<?php

namespace CAFETERIA\MODELS;

class CreateOrderModel extends Model
{
    public $userId;
    public $totalPrice;
    public $id;
    protected static $tableName='orders';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        "userId"       => self::DATA_TYPE_INT,
        "totalPrice"   =>self::DATA_TYPE_DECIMAL,
        "id"           =>self::DATA_TYPE_INT
    ];

}