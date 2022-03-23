<?php

namespace CAFETERIA\MODELS;

class OrdersModel extends Model
{
    public $userId;
    public $totalPrice;
    public $status='processing';

    protected static $tableName='orders';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        "userId"       => self::DATA_TYPE_INT,
        "totalPrice"   =>self::DATA_TYPE_DECIMAL,
        "status"      => self::DATA_TYPE_STR
    ];

}