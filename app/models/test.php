<?php

namespace  CAFETERIA\MODELS;

class Test extends Model
{
   public $name;

   protected static $tableName='test';
   protected static $primaryKey='id';
   protected static $tableSchema=
       [
           'name'      =>self::DATA_TYPE_STR,
       ];
}