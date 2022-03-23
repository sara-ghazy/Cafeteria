<?php
if(!defined('DS'))
{
    define('DS',DIRECTORY_SEPARATOR);
}
//global paths
define('APP_PATH',realpath(dirname(__FILE__)));
define('VIEW_PATH',realpath(dirname(__FILE__)).'/views');

//database configuration
defined('DATABASE_HOST_NAME')       ?null:define('DATABASE_HOST_NAME','localhost');
defined('DATABASE_USER_NAME')       ?null:define('DATABASE_USER_NAME','sara');
defined('DATABASE_PASSWORD')        ?null:define('DATABASE_PASSWORD','saraghazy');
defined('DATABASE_DB_NAME')         ?null:define('DATABASE_DB_NAME','cafeteria');
defined('DATABASE_PORT_NUMBER')     ?null:define('DATABASE_PORT_NUMBER',3306);
defined('DATABASE_CONN_DRIVER')     ?null:define('DATABASE_CONN_DRIVER',1);