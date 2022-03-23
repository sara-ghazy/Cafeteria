<?php

namespace CAFETERIA\MODELS;

class AdminModel extends Model
{
    public $name;
    public $email;
    public $password;

    protected static $tableName='admin';
    protected static $primaryKey='id';
    protected static $tableSchema=[
        "name"     =>self::DATA_TYPE_STR,
        "email"    =>self::DATA_TYPE_STR,
        "password" =>self::DATA_TYPE_STR
    ];

    public static function authenticate($email,$password)
    {
        $sql="select * from admin where email='".$email."' and password='".$password."'";
        $user=self::sql($sql);
        if($user){
            return $user;
        }
        return false;

    }
}