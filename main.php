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


// Définition des routes
$router = new Router();
$router->addRoute('home','/home/','\presentapp\control\PresentController', 'viewPresent');
$router->addRoute('form','/form/','\presentapp\control\PresentController', 'viewForm');
$router->addRoute('default', 'DEFAULT_ROUTE','\presentapp\control\PresentController', 'viewPresent', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
$router->run();

// Connection à la base
$config = parse_ini_file('conf/config.ini');
$db = new Illuminate\Database\Capsule\Manager();

// initialisation connection
$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();

<<<<<<< HEAD
<<<<<<< HEAD
// modification
//saluuuut
=======
// modification
//saluuuut
>>>>>>> formulaire
=======
// modification
//saluuuut
>>>>>>> 274d0f1056f3983b6ff77f3a118977ebdd7e8e54
