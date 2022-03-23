<?php
if(!defined('DS'))
{
    define('DS',DIRECTORY_SEPARATOR);
}
//global paths
define('APP_PATH',realpath(dirname(__FILE__)));
define('VIEW_PATH',APP_PATH.'/views');

//database configuration
defined('DATABASE_HOST_NAME')       ?null:define('DATABASE_HOST_NAME','localhost');
defined('DATABASE_USER_NAME')       ?null:define('DATABASE_USER_NAME','sara');
defined('DATABASE_PASSWORD')        ?null:define('DATABASE_PASSWORD','saraghazy');
defined('DATABASE_DB_NAME')         ?null:define('DATABASE_DB_NAME','cafeteria');
defined('DATABASE_PORT_NUMBER')     ?null:define('DATABASE_PORT_NUMBER',3306);
defined('DATABASE_CONN_DRIVER')     ?null:define('DATABASE_CONN_DRIVER',1);


// Session configuration
defined('SESSION_NAME')     ? null : define ('SESSION_NAME', '_CAFETERIA_SESSION');
defined('SESSION_LIFE_TIME')     ? null : define ('SESSION_LIFE_TIME', 0);
defined('SESSION_SAVE_PATH')     ? null : define ('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'sessions');