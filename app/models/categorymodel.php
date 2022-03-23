<?php

namespace CAFETERIA\MODELS;

use CAFETERIA\MODELS\Model;

class CategoryModel extends Model
{
    public $name;

    protected static $tableName='category';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        "name"=>self::DATA_TYPE_STR
    ];

}