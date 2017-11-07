<?php
use mf\router\Router;

// Require autoload
require_once ("vendor/autoload.php");
require_once ("app/src/mf/utils/ClassLoader.php");

$loader = new mf\utils\ClassLoader('app/src');
$loader->register();

// Connection à la base
$config = parse_ini_file('conf/config.ini');
$db = new Illuminate\Database\Capsule\Manager();

// initialisation connection
$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

// Définition des routes
$router = new Router();
$router->addRoute('home','/home/','\presentapp\control\PresentController', 'viewPresent');
$router->addRoute('form','/form/','\presentapp\control\PresentController', 'viewForm');
$router->addRoute('login','/form/','\presentapp\control\PresentController', 'viewLogin');
$router->addRoute('check_login','/form/','\presentapp\control\PresentController', 'check_login');
$router->addRoute('default', 'DEFAULT_ROUTE','\presentapp\control\PresentController', 'viewPresent');
$router->run();