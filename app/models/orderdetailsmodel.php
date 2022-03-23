<?php

namespace CAFETERIA\MODELS;

class OrderdetailsModel extends Model 
{
    protected static $tableName='orderDetailsUsers';
    protected static $primaryKey='id';
    protected static $tableSchema=
        [

            'productname' =>self::DATA_TYPE_STR,
             'quantity'  => self::DATA_TYPE_INT,
             'imgUrl' =>self::DATA_TYPE_STR,
             'totalprice' =>self::DATA_TYPE_DECIMAL,
             'id' =>self::DATA_TYPE_INT

        ];

}

?>