<?php

session_start();
use mf\router\Router;

// Require autoload
require_once ("vendor/autoload.php");
require_once ("app/src/mf/utils/ClassLoader.php");
$loader = new mf\utils\ClassLoader('app/src');
$loader->register();


// initialisation connection
$config = parse_ini_file('conf/config.ini');
$db = new Illuminate\Database\Capsule\Manager();
$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();

// Définition des routes
$router = new Router();
$router->addRoute('home','/home/','\presentapp\control\PresentController', 'viewPresent');
$router->addRoute('signup','/signup/','\presentapp\control\PresentController', 'viewSignUp');
$router->addRoute('check_signup',   '/check_signup/','\presentapp\control\PresentController','checkSignup', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('form','/form/','\presentapp\control\PresentController', 'viewForm');
$router->addRoute('liste','/liste/','\presentapp\control\PresentController', 'viewListe');
$router->addRoute('addliste','/addliste/','\presentapp\control\PresentController', 'viewaddListe');
$router->addRoute('addItem','/addItem/','\presentapp\control\PresentController', 'addItem');
$router->addRoute('login','/login/','\presentapp\control\PresentController', 'viewLogin');
$router->addRoute('check_login','/check_login/','\presentapp\control\PresentController', 'check_login');
$router->addRoute('logout','/logout/','\presentapp\control\PresentController', 'logout');
$router->addRoute('default', 'DEFAULT_ROUTE','\presentapp\control\PresentController', 'viewPresent', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('item','/item/','\presentapp\control\PresentController','viewItem', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
$router->run();


