<?php
namespace CAFETERIA;
use CAFETERIA\LIB\DATABASE\CategoryModel;
use CAFETERIA\LIB\DATABASE\DatabaseHandler;
use CAFETERIA\LIB\DATABASE\PDODatabaseHandler;
use CAFETERIA\LIB\DATABASE\TestModel;
use CAFETERIA\LIB\FrontController;
use CAFETERIA\MODELS\Test;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!defined('DS'))
{
    define('DS',DIRECTORY_SEPARATOR);
}
session_start();
require_once '..'.DS.'app'.DS.'config.php';
require_once APP_PATH.DS.'lib'.DS.'autoload.php';
$frontController=new FrontController();
$frontController->dispatch();