<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 15:16
 */
use mf\router\Router;

// Require autoload
require_once ("vendor/autoload.php");
require_once ("app/src/mf/utils/ClassLoader.php");

$loader = new mf\utils\ClassLoader('app/src');
$loader->register();

$router = new Router();
$router->addRoute('home','/home/','\tweeterapp\control\TweeterController', 'viewHome');

echo "cadeaux";