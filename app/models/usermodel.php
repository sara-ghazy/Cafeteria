<?php

namespace CAFETERIA\MODELS;
use CAFETERIA\LIB\DATABASE\DatabaseHandler;

class UserModel extends Model
{
    public $name;
    public $email;
    public $password;
    public $id;

    protected static $tableName='user';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        "name"     =>self::DATA_TYPE_STR,
        "email"    =>self::DATA_TYPE_STR,
        "password" =>self::DATA_TYPE_STR,
        "id" =>self::DATA_TYPE_INT,
        "imgUrl" =>self::DATA_TYPE_STR,
        "ext" =>self::DATA_TYPE_INT,
        "room" =>self::DATA_TYPE_INT
    ];

    public static function login($email,$password)
    {
        $sql="select * from `user` where email='".$email."' and password='".$password."'";
        $stmt=DatabaseHandler::factory()->prepare($sql);
        if($stmt->execute())
        {
            $user=$stmt->fetchall(\PDO::FETCH_ASSOC);
            return array_shift($user);
        }
        return false;

    }
}