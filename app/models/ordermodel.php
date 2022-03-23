<?php

namespace CAFETERIA\MODELS;

class OrderModel extends Model 
{
  /*public $status;
    public $id;
    public $name;
    public $room;
    public $ext;
    public $created_at;
    public $updated_at;*/

    protected static $tableName='orderUsers';
    protected static $primaryKey='userid';
    protected static $tableSchema=
        [
         'created_at'      =>self::DATA_TYPE_STR,
            'name'      =>self::DATA_TYPE_STR,
            'room'      =>self::DATA_TYPE_INT,
            'ext'      =>self::DATA_TYPE_INT,
            'status'      =>self::DATA_TYPE_BOOL,
            'id'     =>self::DATA_TYPE_INT,
            'userid' => self::DATA_TYPE_INT,
            'updated_at' => self::DATA_TYPE_STR
        ];

}

?>