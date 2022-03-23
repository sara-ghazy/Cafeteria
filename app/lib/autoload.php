<?php

namespace CAFETERIA\LIB;

class Autoload
{
    public static function autoload($className)
    {

        $className=str_replace('CAFETERIA','',$className);
        $className=APP_PATH.$className.'.php';
        $className=strtolower($className);
        $className=str_replace('\\','/',$className);
        if (file_exists($className))
        {
            require_once $className;
        }

    }

}

spl_autoload_register(__NAMESPACE__.'\Autoload::autoload');