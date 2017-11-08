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
if(isset($_SESSION['user_login'])){

    // si la personne est connecter
    $router->addRoute('check_addliste',   '/check_addliste/','\presentapp\control\PresentController','checkaddliste', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
    $router->addRoute('supprliste',   '/supprliste/','\presentapp\control\PresentController','viewSupprliste', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
    //$router->addRoute('form','/form/','\presentapp\control\PresentController', 'viewForm');
    $router->addRoute('liste','/liste/','\presentapp\control\PresentController', 'viewListe');
    $router->addRoute('addliste','/addliste/','\presentapp\control\PresentController', 'viewaddListe');
    $router->addRoute('addItem','/addItem/','\presentapp\control\PresentController', 'addItem');
    $router->addRoute('viewAddItem','/ViewAddItem/','\presentapp\control\PresentController', 'viewAddItem');
    $router->addRoute('logout','/logout/','\presentapp\control\PresentController', 'logout');
    $router->addRoute('listeItem','/listeItem/','\presentapp\control\PresentController', 'viewListeItem');
    $router->addRoute('item','/item/','\presentapp\control\PresentController','viewItem', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);

    $router->addRoute('default', 'DEFAULT_ROUTE','\presentapp\control\PresentController', 'viewPresent', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);

} else {

    // sinon pas connecter
    $router->addRoute('signup','/signup/','\presentapp\control\PresentController', 'viewSignUp');
    $router->addRoute('listeItem','/listeItem/','\presentapp\control\PresentController', 'viewListeItem');
    $router->addRoute('check_signup',   '/check_signup/','\presentapp\control\PresentController','checkSignup', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);
    $router->addRoute('login','/login/','\presentapp\control\PresentController', 'viewLogin');
    $router->addRoute('reserverMessageItem','/reserverMessageItem/','\presentapp\control\PresentController', 'viewReserverItem');
    $router->addRoute('reserverItem','/reserverItem/','\presentapp\control\PresentController', 'reserverItem');
    $router->addRoute('check_login','/check_login/','\presentapp\control\PresentController', 'check_login');
    $router->addRoute('default', 'DEFAULT_ROUTE','\presentapp\control\PresentController', 'viewPresent', presentapp\auth\PresentAuthentification::ACCESS_LEVEL_NONE);

}

$router->run();
