<?php

namespace CAFETERIA\MODELS;

class ProductModel extends Model
{
    public $name;
    public $price;
    public $imgUrl;
    public $catId;

    protected static $tableName='product';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        'name'    =>self::DATA_TYPE_STR,
        'price'   =>self::DATA_TYPE_DECIMAL,
        'imgUrl'  =>self::DATA_TYPE_STR,
        'catId'   =>self::DATA_TYPE_INT
    ];
}