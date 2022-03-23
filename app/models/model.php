<?php
namespace  CAFETERIA\MODELS;
use CAFETERIA\LIB\DATABASE\DatabaseHandler;
use CAFETERIA\LIB\PDODataBaseHandler;
abstract class Model
{
const DATA_TYPE_BOOL=\PDO::PARAM_BOOL;
const DATA_TYPE_INT=\PDO::PARAM_INT;
const DATA_TYPE_STR=\PDO::PARAM_STR;
const DATA_TYPE_DECIMAL='decimal';

private function buildNameParameterSql()
{
    $namedParam='';
    foreach (static::$tableSchema as $columnName => $type)
    {
        $namedParam .=$columnName.'=:'.$columnName.', ';
    }
    return trim($namedParam,', ');
}
private function prepareValue(\PDOStatement &$stmt)
{
 foreach (static::$tableSchema as $columnName => $type)
 {

     if($type=='decimal')
     {
         $sanitizedValue=filter_var($this->$columnName,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
         $stmt->bindValue(":{$columnName}",$sanitizedValue);
     }else
     {
         $stmt->bindValue(":{$columnName}",$this->$columnName,$type);
     }
 }
}
private function create()
{
    $sql='insert into '.static::$tableName.' set '.self::buildNameParameterSql();
    $stmt=DatabaseHandler::factory()->prepare($sql);
    $this->prepareValue($stmt);
    if ($stmt->execute())
    {
        $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
        return true;
    }
    return false;

}
private function update()
{
    $sql='update '.static::$tableName.' set '.self::buildNameParameterSql().' where '.static::$primaryKey.' ="'.$this->{static::$primaryKey}.'"';
    $stmt=DatabaseHandler::factory()->prepare($sql);
    $this->prepareValue($stmt);
    return $stmt->execute();
}
public function save()
{
 return $this->{static::$primaryKey}===null?self::create():self::update();
}
public function delete()
{
    $sql='delete from '.static::$tableName.' where '.static::$primaryKey.'='.$this->{static::$primaryKey};
    $stmt=DatabaseHandler::factory()->prepare($sql);
    return $stmt->execute();
}
public static function getAll()
{
    $sql='select * from '.static::$tableName;
    $stmt=DatabaseHandler::factory()->prepare($sql);
    if ($stmt->execute())
        return $stmt->execute()?$stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class()):false;
}
public static function getByKey($key)
{
    $sql='select * from '.static::$tableName.' where '.static::$primaryKey.'='.$key;
    $stmt=DatabaseHandler::factory()->prepare($sql);
    if($stmt->execute())
    {
        $obj=$stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class());
       return $obj? array_shift($obj):false;
    }
    return false;
}


public static function getAllByKey($key)
{
    $sql='select * from '.static::$tableName.' where '.static::$primaryKey.'='.$key;
    $stmt=DatabaseHandler::factory()->prepare($sql);
    if($stmt->execute())
    {
         return $obj=$stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class());
        //return $obj? array_shift($obj):false;
    }
    return false;
}




public static function sql($sql)
{

    $stmt=DatabaseHandler::factory()->prepare($sql);

    if ($stmt->execute())
    {
        return $obj=$stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class());
        //return $arr=$stmt->fetchall(\PDO::FETCH_ASSOC);
       // return array_shift($arr);
    }
    return false;
}

}
